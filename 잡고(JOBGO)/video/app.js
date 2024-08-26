// server.js
const express = require("express");
const nunjucks = require("nunjucks");
const SocketIO = require("socket.io");
const cors = require("cors");
const path = require("path");
const fs = require("fs");
const { ExpressPeerServer } = require("peer");
const https = require('https');
const credentials = {
    ca: fs.readFileSync('/etc/httpd/conf/ssl.crt/AAA_CERTIFICATE_SERVICES.crt'),
    key: fs.readFileSync('/etc/httpd/conf/ssl.key/www.jobgo.ac.key'),
    cert: fs.readFileSync('/etc/httpd/conf/ssl.crt/www.jobgo.ac.crt'),
};
const app = express();
app.use(express.static(path.join(__dirname, "public"))); // /public을 url주소 /로 해도 바로 접근이 가능하게
app.use(
  cors({
    origin: "*",
    credentials: true,
  })
);
app.set("view engine", "html");
let viewEngine = nunjucks.configure("views", {
  express: app, //express 프레임워크 어떤 객체로 쓸 것인지
  watch: true, //렌더링 할 것인지 말 것인지
});
const indexRouter = require("./routes");
app.use("/", indexRouter);
/*const server = app.listen(3000, () => {
  console.log(3000, "번 포트에서 대기중");
});*/
const server = https.createServer(credentials,app).listen(3000,()=>{
	console.log(3000, "번 포트에서 대기중");
});


const peerServer = ExpressPeerServer(server, {
  debug: true,
});
app.use("/peerjs", peerServer);
const io = SocketIO(server, { path: "/socket.io", cors: { origin: "*" },transports: ['polling'] });
io.on("connection", (socket) => {
  socket.on("join-room", (roomId, userId,users,apptype) => {
	console.log(roomId);
	console.log(userId);
    socket.join(roomId);
    socket.to(roomId).emit("user-connected", userId, users,apptype);
    socket.on("disconnect", () => {
		console.log("disconnect");
      socket.to(roomId).emit('user-disconnected', userId, users);
    });
	socket.on("video-change", (data) => {
	  console.log(data);
	  socket.to(data.roomId).emit("video-change",{users:data.users,type:data.type});
	});

	socket.on("screenChange",(roomId,is_video) => {
		console.log("screenchange");
		socket.to(roomId).emit("screenChange",{is_video:is_video});
	});
	socket.on("audioChange",(roomId,is_audio) => {
		console.log("audiochange");
		socket.to(roomId).emit("audioChange",{is_audio:is_audio});
	});
	socket.on("chatExit",(roomId)=>{
		console.log("채팅나가기");
		socket.to(roomId).emit("chatExit");
	});

  });
  
});
