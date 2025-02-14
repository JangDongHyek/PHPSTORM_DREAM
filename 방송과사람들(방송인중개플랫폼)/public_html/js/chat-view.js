// Socket.IO 클라이언트 초기화
let socket = io('https://itforone.com:3151/');

// 메시지 목록의 가장 아래로 스크롤하는 함수
function scrollToBottom() {
    console.log('scrollToBottom');
    /*const chatView = document.getElementById('chat-view');
    chatView.scrollTop = chatView.scrollHeight;*/
    let messages = document.querySelector('#chat-view').lastElementChild;
    messages.scrollIntoView();
}

// 전역 변수로 params 선언
let params;

socket.on('connect', () => {
    let searchQuery = window.location.search.substring(1);
    params = JSON.parse('{"' + decodeURI(searchQuery).replace(/&/g, '\",\"').replace(/\+/g, ' ').replace(/=/g, '\":\"') + '\"}');

    socket.emit('join', params, function(err) {
        if (err) {
            alert(err);
            window.location.href = '/';
        } else {
            console.log('No Error');
        }
        scrollToBottom();
    });
});

// 서버와의 연결이 끊어졌을 때 실행되는 이벤트 핸들러
socket.on('disconnect', function() {
    console.log('Disconnected from server.');
});

socket.on('newMessage', function(message) {
    const formattedTime = moment(message.createdAt).format('LT');
    const templateId = message.from === params.name ? '#message-template' : '#other-message-template';
    const template = document.querySelector(templateId).innerHTML;

    const html = Mustache.render(template, {
        from: message.from,
        text: message.text, // 이미 HTML로 되어 있는 text 사용
        createdAt: formattedTime,
        readStatus: message.readStatus || ''
    });

    const div = document.createElement('div');
    div.innerHTML = html; // innerHTML을 사용하여 HTML을 삽입
    document.querySelector('#chat-view').appendChild(div);

    //scrollToBottom();
});



// 메시지 전송 버튼 클릭 이벤트 핸들러
document.querySelector('#submit-btn').addEventListener('click', function(e) {
    e.preventDefault(); // 기본 폼 제출 방지

    const messageText = document.querySelector('textarea[name="message"]').value;
    const mbNo = document.querySelector('input[name="mbNo"]').value;
    // 메시지가 비어있지 않은지 확인
    if (messageText.trim() !== '') {
        socket.emit("createMessage", {
            text: messageText,
            mbNo:mbNo
        });
        document.querySelector('textarea[name="message"]').value = '';
        scrollToBottom();
    } else {
        console.error('Message cannot be empty');
    }
});

// 읽음 확인 이벤트
socket.on('readConfirmation', (data) => {
    const mbNo = data.mbNo;

    const readElements = document.querySelectorAll('.read');

    readElements.forEach((readElement) => {
        const elementMbNo = readElement.getAttribute('data-mbno');

        if (elementMbNo !== mbNo) {
            readElement.textContent = '';
        }
    });
});

document.addEventListener('DOMContentLoaded', ()=>{

    const msgTex = document.querySelector('#msg');
    const fileInput = document.querySelector('#fileInput');

    const mbNo = document.querySelector('#mbNo').value;
    const mbRoom = document.querySelector('#mbRoom').value;

    msgTex?.addEventListener('focus',async function () {

        let message = {
            mbNo: mbNo,
            mbRoom: mbRoom
        };

        markMessageAsRead(message);
    });

    fileInput.addEventListener('change', handleUploadFile);

    setTimeout(function () {
        scrollToBottom();
    },800);

});

function markMessageAsRead(message){
    const readInfo = {
        mbRoom: message['mbRoom'],
        mbNo: message['mbNo']
    }
    socket.emit('markAsRead', readInfo);
}

function downloadImage(imageUrl) {
    const link = document.createElement('a');
    link.href = imageUrl;
    const filename = imageUrl.split('/').pop(); // 파일 이름을 URL에서 추출
    link.download = filename.split('_')[0]; // '_'를 기준으로 분리하여 첫 번째 요소를 파일 이름으로 설정
    link.click();
}

function handleUploadFile(e){
    const file = e.target.files[0];

    if (file){
        const reader = new FileReader();

        reader.onload = function(event) {
            const fileData = event.target.result; // 파일 데이터
            const fileName = file.name; // 파일 이름

            // 소켓을 통해 파일 데이터 전송
            socket.emit('uploadFile', {
                name: fileName,
                data: fileData,
                mbNo: document.querySelector('#mbNo').value,
                mbRoom: document.querySelector('#mbRoom').value
            });
        };
        // 파일 읽기 시작
        reader.readAsArrayBuffer(file); // 파일을 ArrayBuffer로 읽기
    }
}