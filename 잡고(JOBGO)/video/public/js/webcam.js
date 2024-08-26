const socket = io('/', {transports: ['polling']});
const videoGrid = document.getElementById("video-grid");
const myVideo = document.createElement("video");
myVideo.setAttribute("id",users);
myVideo.muted = true;
const peers = {};
//피어서버에 접속하기 위함 node.js에 router를 설정
var peer = new Peer(undefined, {
  path: "/peerjs",
  host: "/",
  port: "3000",
});
let myVideoStream;//자신 비디오를 스트리밍 하기 위함
try {
  //미디어를 설정하기 위함
  navigator.mediaDevices
    .getUserMedia({ audio: true, video: true })
    .then((stream) => {
      myVideoStream = stream;//자기 자신 스트리밍 설정
	  console.log(myVideoStream);
      addVideoStream(myVideo, stream);//비디오 추가하기
	  
      peer.on("call", (call) => {//피어서버에서 call응답을 받으면
        call.answer(stream);
        const video = document.createElement("video");
		//스트리밍 실행을 할 때
        call.on("stream", (userVideoStream) => {
          addVideoStream(video, userVideoStream);//스트리밍을 추가하기
        });
      });
	  //유저가 접속을 하게 되면
      socket.on("user-connected", (userId,usersId) => {
        setTimeout(connectToNewUser,1000,userId,stream,usersId);//이거를 넣어야 함 여기서 새로운 유저 비디오가 생성이 됨
      });
    });
} catch (error) {
  alert(error);
}
//새로운 유저가 들어오게 되면 비디오 생성하기
const connectToNewUser = (userId, stream, usersId) => {
  const call = peer.call(userId, stream);
  const video = document.createElement("video");
  video.setAttribute("id",usersId);
  try{
	  call.on("stream", (userVideoStream) => {
		addVideoStream(video, userVideoStream);
	  });
	  console.log(call);
  }catch(error){
	alert(error);
  }
};
peer.on("open", (id) => {
  socket.emit("join-room", ROOM_ID, id, users);
});
//유저가 화면에 나가게 되면 비디오는 삭제가 되게
socket.on("user-disconnected",(userId,usersId)=>{
	const video=document.querySelector("#"+usersId);
	const videos = document.getElementsByTagName("video");
	try{
		video.remove();
		console.log(videos.length);
		for(let i=0;i < videos.length;i++){
			console.log(videos[i].getAttribute("id"));
			if(videos[i].getAttribute("id")==undefined){
				videos[i].remove();
			}
		}
	}catch(error){
		for(let i=0;i < videos.length;i++){
			console.log(videos[i].getAttribute("id"));
			if(videos[i].getAttribute("id")==undefined){
				videos[i].remove();
			}
		}
	}
	
});
//비디오 스트리밍 추가하기
const addVideoStream = (video, stream) => {
  video.srcObject = stream;
  video.addEventListener("loadedmetadata", () => {
    video.play();
  });
  videoGrid.append(video);
};
