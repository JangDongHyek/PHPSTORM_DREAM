const path = require('path'); // Node.js의 기본 모듈로 경로 작업에 사용
const http = require('http'); // Node.js의 기본 모듈로 HTTP 서버 생성에 사용
const https = require('https'); // Node.js의 기본 모듈로 HTTPS 서버 생성에 사용
const fs = require('fs'); // 파일 시스템 모듈
const express = require('express'); // 웹 서버 프레임워크
const socketIO = require('socket.io'); // 실시간 양방향 통신을 위한 라이브러리
const { pool } = require('./db'); // DB 연결
const { setMessage, setMessageRead } = require('./chatService');

// 사용자 정의 모듈 가져오기
const { generateMessage, generateLocationMessage } = require('./public/utils/message'); // 메시지 생성 함수
const { isRealString } = require('./public/utils/isRealString'); // 입력 문자열 유효성 검사 함수
const { Users } = require('./public/utils/users'); // 사용자 관리 클래스

const publicPath = path.join(__dirname, 'public'); // 정적 파일 경로 설정
const options = {
    key: fs.readFileSync('/etc/httpd/conf/ssl.key/itforone_com.key'), // 개인 키 파일 경로
    cert: fs.readFileSync('/etc/httpd/conf/ssl.crt/itforone_com.crt') // 인증서 파일 경로
};

const port = process.env.PORT || 3150; // 서버 포트 설정 (환경 변수 또는 기본값 3150 사용)
const httpsPort = process.env.HTTPS_PORT || 3151;
let app = express(); // Express 애플리케이션 생성
let httpsServer = https.createServer(options, app); // HTTPS 서버 생성
let httpServer = http.createServer(app); // HTTP 서버 생성

// HTTPS 서버에 Socket.IO를 연결
let io = socketIO(httpsServer, {
    cors: {
        origin: "https://itforone.com", // 클라이언트의 출처
        methods: ["GET", "POST"],
        allowedHeaders: ["my-custom-header"],
        credentials: true
    }
});

// HTTP 요청을 HTTPS로 리디렉션
httpServer.on('request', (req, res) => {
    res.writeHead(301, { "Location": `https://${req.headers.host}${req.url}` });
    res.end();
});

let users = new Users(); // 사용자 관리 인스턴스 생성

app.use(express.static(publicPath)); // 정적 파일 제공 (public 디렉토리)

// uploads 디렉토리를 정적 파일로 제공
app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

// Socket.IO 연결 이벤트 핸들러
io.on('connection', (socket) => {
    console.log("A new user just connected"); // 클라이언트가 연결되었음을 알림

    // 클라이언트가 특정 방에 참여하는 이벤트 처리
    socket.on('join', (params, callback) => {
        // 이름과 방 이름이 유효한지 확인
        if (!isRealString(params.name) || !isRealString(params.room)) {
            return callback('Name and room are required'); // 유효하지 않을 경우 에러 메시지 반환
        }

        socket.join(params.room); // 클라이언트를 지정된 방에 추가
        users.removeUser (socket.id); // 기존에 같은 ID로 참여한 사용자가 있으면 제거
        users.addUser (socket.id, params.name, params.room); // 새로운 사용자 추가

        // 현재 방의 사용자 목록 업데이트
        io.to(params.room).emit('updateUsersList', users.getUserList(params.room));
    });

    // 클라이언트가 메시지를 생성할 때 이벤트 처리
    socket.on('createMessage', async (message, callback) => {
        let user = users.getUser (socket.id); // 현재 사용자 정보 가져오기

        // 사용자와 메시지 텍스트가 유효한 경우에만 메시지 브로드캐스트
        if (user && isRealString(message.text)) {
            try {
                let idx = await setMessage(user, message);
                io.to(user.room).emit('newMessage', generateMessage(user.name, message.text));
            } catch (error) {
                console.error('Failed to insert message:', error);
            }
        }
        callback('This is the server:');
    });

    // 읽음 확인 이벤트
    socket.on('markAsRead', async (message) => {
        const user = users.getUser (socket.id);
        try {
            await setMessageRead(message.mbRoom, message.mbNo );
            io.to(user.room).emit('readConfirmation', { mbNo: message.mbNo });
        } catch (error) {
            console.log(error);
        }
    });

    // 파일 업로드 처리
    socket.on('uploadFile', (fileData) => {
        const { name, data, mbNo, mbRoom } = fileData;
        let user = users.getUser(socket.id);

        // File save path setup
        const uploadDir = path.join(__dirname, 'uploads', mbRoom);

        // Generate a unique filename if a file with the same name already exists
        let uniqueName = name;
        let counter = 1;
        while (fs.existsSync(path.join(uploadDir, uniqueName))) {
            uniqueName = `${name}_${counter}`;
            counter++;
        }

        const filePath = path.join(uploadDir, uniqueName);

        // Create upload directory if it doesn't exist
        if (!fs.existsSync(uploadDir)) {
            fs.mkdirSync(uploadDir, { recursive: true });
        }

        // Save the file
        fs.writeFile(filePath, Buffer.from(data, 'base64'), async (err) => {
            if (err) {
                console.error('Error saving file:', err);
                socket.emit('fileUploadError', { message: 'File upload failed' });
                return;
            }
            console.log('File saved:', uniqueName);

            // Notify the client about the successful upload
            socket.emit('fileUploadSuccess', { name: uniqueName, mbNo, mbRoom });

            // Create a URL for the uploaded image
            const imageUrl = `../node-chat/uploads/${mbRoom}/${uniqueName}`; // 절대 경로로 수정

            const message = {
                from: user.name,
                mbNo: mbNo,
                text: `<img src="${imageUrl}" alt="Image" class="uploaded-image" onerror="this.onerror=null; this.src='../node-chat/public/img/icon_file.png';" style="width: 100%" onclick="downloadImage('${imageUrl}')" />`,
                createdAt: new Date().getTime(),
                readStatus: false
            };
            await setMessage(user, message);
            // Emit a new message event to notify others in the room
            io.to(mbRoom).emit('newMessage', message);
        });
    });

    // 클라이언트가 연결을 끊을 때 이벤트 처리
    socket.on('disconnect', () => {
        let user = users.removeUser (socket.id); // 연결이 끊어진 사용자 제거

        // 사용자가 유효한 경우 방에 있는 다른 사용자에게 알림
        if (user) {
            io.to(user.room).emit('updateUsersList', users.getUserList(user.room)); // 사용자 목록 업데이트
        }
    });
});

// 서버 시작
httpServer.listen(port, () => {
    console.log(`Server is up on port ${port}`); // 서버가 실행 중임을 알림
});

httpsServer.listen(httpsPort, () => {
    console.log(`HTTPS Server is up on port ${httpsPort}`); // HTTPS 서버가 실행 중임을 알림
});