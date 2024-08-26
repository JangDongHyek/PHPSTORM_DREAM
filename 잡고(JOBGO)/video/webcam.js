const socket = io('https://www.jobgo.ac:3000', {transports: ['polling']});
//const videoGrid = document.getElementById("video-grid");
const myVideoDiv = document.getElementById("draggable"); //자기 자신 비디오
const youVideoDiv = document.getElementById("youVideo"); //상대편 비디오
const myVideo = document.createElement("video");
myVideo.setAttribute("id", users);
myVideo.setAttribute('playsinline', 'true'); //playsinline 설정하지 않으면 iOS에서 비디오가 전체 화면으로 열리고 화면 줄이면 비디오 멈춤

let isLoading = false;

const peers = {};
//피어서버에 접속하기 위함 node.js에 router를 설정
var peer = new Peer(undefined, {
    path: "/peerjs",
    host: "jobgo.ac",
    port: "3000",
});
let myVideoStream; //자신 비디오를 스트리밍 하기 위함

//새로운 유저가 들어오게 되면 비디오 생성하기
const connectToNewUser = (userId, stream, usersId) => {
	const videos = document.getElementsByTagName("video");
	if(videos.length >= 2) {
		try {
			clearInterval(connectedId);
			return;
		} catch (exception) {
		  // 예외 처리 코드
		}
	}

    const call = peer.call(userId, stream);
    console.log("userId " + userId);
    console.log("usersId " + usersId);
	
	var video = document.createElement("video");
    usersId=usersId.replace("@","");
    usersId=usersId.replace(".","");
    video.setAttribute("id", usersId);
    //video.muted = true;
	video.autoplay = true;
    try {
        call.on("stream", (userVideoStream) => {
            addVideoStream(video, userVideoStream);
        });
    } catch (error) {
        alert(error);
    }

	if(videos.length >= 2) {
		try {
			isLoading = true;
			clearInterval(connectedId);
		} catch (exception) {
		  // 예외 처리 코드
		}
	}

	

};


//유저가 화면에 나가게 되면 비디오는 삭제가 되게
socket.on("user-disconnected", (userId, usersId) => {

    console.log("disconnected");
    usersId=usersId.replace("@","");
    usersId=usersId.replace(".","");
    const video = document.querySelector("#" + usersId);
    const videos = document.getElementsByTagName("video");
    console.log(userId);
    console.log(usersId);
    callPageLoading(1);
    try {
        video.remove();
        console.log(videos.length);
        for (let i = 0; i < videos.length; i++) {
            console.log(videos[i].getAttribute("id"));
            if (videos[i].getAttribute("id") == undefined) {
                videos[i].remove();
            }
        }
    } catch (error) {
        for (let i = 0; i < videos.length; i++) {
            console.log(videos[i].getAttribute("id"));
            if (videos[i].getAttribute("id") == undefined) {
                videos[i].remove();
            }
        }
    }

});

//비디오 스트리밍 추가하기
const addVideoStream = (video, stream, me) => {
    video.srcObject = stream;
	video.addEventListener("loadedmetadata", () => {
		v_play();
	});    

    if (me == "my") {
        if(myVideoDiv !== null){
            myVideoDiv.innerHTML = ""; //초기화를 꼭 해줘야 함
            myVideoDiv.append(video); //자기 자신 비디오 추가
			if(video.paused){
				video.addEventListener("loadedmetadata", () => {
					v_play();
				});    
			}
            //myVideoStream.getAudioTracks()[0].enabled =true;
			video.volume = 0.0;
            video.setAttribute("style", "width:100%;height:100%");
        }
    } else {
        if(youVideoDiv !== null){
            youVideoDiv.innerHTML = ""; //초기화를 꼭 해줘야 함
            youVideoDiv.append(video); //상대편 비디오 추가
			if(video.paused){
				video.addEventListener("loadedmetadata", () => {
					v_play();
				});    
			}
			video.volume = 0.7;
            callPageLoading(0);
			
        }
    }

	const videos = document.getElementsByTagName("video");
	for (let i = 0; i < videos.length; i++) {
		videos[i].setAttribute('playsinline', 'true');
	}
};

function v_play(){
	const videos = document.getElementsByTagName("video");
	for (let i = 0; i < videos.length; i++) {
		if(videos[i].paused){
			videos[i].play();
		}
	}

}

let tempType = 'user';
let isVideoType = true;
let isAudioType = true;
let youVideoStream;

async function videoChange(type) {
    callPageLoading(1);
    if (myVideoStream != null && isVideoType) {
        try {
            myVideoStream.getVideoTracks()[0].stop();
        } catch (error) {
            console.log(error);
        }
    }

    if(document.getElementById("btn-change") !== null){
        if (type == "user") {
            document.getElementById("btn-change").setAttribute("onclick", "videoChange('environment')");//반대쪽 방향 전환
        } else {
            document.getElementById("btn-change").setAttribute("onclick", "videoChange('user')");//내 얼굴쪽에 방향 전환
        }
    }

    peer.on("open", (id) => {
        peerId = id;
        socket.emit("join-room", ROOM_ID, id, users);

    });

    try {
        //미디어를 설정하기 위함
        await navigator.mediaDevices
            .getUserMedia(
				{
				audio: {
				 echoCancellation: true,
				noiseSuppression: true
			}, 
				video: {facingMode: type}})
            .then((stream) => {
				myVideoStream = stream;//자기 자신 스트리밍 설정
				addVideoStream(myVideo, stream, 'my');//비디오 추가하기
                
				setTimeout(function() {
                    if (tempType != type) {
						isLoading  = false;
                        socket.emit("video-change", {roomId: ROOM_ID, users: users, type: type});
                        tempType = type;
                    }
					
                }, 250);

                peerCall(stream);

                //유저가 접속을 하게 되면
                socket.on("user-connected", (userId, usersId) => {
					try {
						clearInterval(connectedId);
					} catch (exception) {
					  // 예외 처리 코드
					}
					connectedId = setInterval(function() {
						if(isLoading == false) connectToNewUser(userId, stream, usersId);
					}, 2000);
					
					
                });
                socket.on("video-change", async (data) => {
					
                    if (data.users != users) {
                        let videoTrack = stream.getVideoTracks()[0];
                        location.reload();
                    }
                });

                socket.on("screenChange", (data) => {

                    console.log(data);
					console.log(myVideo.paused);
                    if (data.is_video == false) {
                        youVideoDiv.getElementsByTagName("video")[0].style.display = "none";
                        youVideoDiv.className = "loading";
						
                    } else {
                        youVideoDiv.getElementsByTagName("video")[0].style.display = "block";
                        youVideoDiv.className = "";
                    }
                });

                socket.on("audioChange", (data) => {
                    let videoTag = youVideoDiv.getElementsByTagName("video")[0];
                    console.log(data);
                    videoTag.muted = !data.is_audio;
                });



            });

    } catch (error) {
        alert(error);
    }
}

//의사가 채팅 나가기 하면 환자도 나가게
socket.on("chatExit", (data) => {
	try	{
		myVideoDiv.innerHTML = "";
		youVideoDiv.innerHTML = "";	
	} catch (e){}
    alert("진료가 종료되었습니다.");
    top.history.back();



    return;
});
function screenChange() {
        let myVideo = myVideoDiv.getElementsByTagName("video")[0];
        let videoBtn = document.getElementById("video-btn");
        let videoImg = videoBtn.getElementsByTagName("img")[0];
        if (isVideoType) {
            myVideo.style.display = "block";
            videoImg.className = "";
            myVideoDiv.className = "";

        } else {
            myVideo.style.display = "none";
            videoImg.className = "off";
            myVideoDiv.className = "loading";
        }
    socket.emit("screenChange", ROOM_ID, isVideoType);
}

function audioChange() {
        let audioBtn = document.getElementById("audio-btn");
        let audioImg = audioBtn.getElementsByTagName("img")[0];
        if (isAudioType) {
            audioImg.src = "/img/hospital/btn_treat_mic.svg";
        } else {
            audioImg.src = "/img/hospital/btn_treat_mic_off.svg";
        }
        myVideoStream.getAudioTracks()[0].enabled =isAudioType;

        //isAudioType?myVideo.stream.getAudioTracks():[];



}

function peerCall(stream) {
    peer.on("call", (call) => {//피어서버에서 call응답을 받으면
        call.answer(stream);
        const video = document.createElement("video");
        //스트리밍 실행을 할 때
        call.on("stream", (userVideoStream) => {
            youVideoStream = userVideoStream;
            addVideoStream(video, userVideoStream, 'you');//스트리밍을 추가하기

			const videos = document.getElementsByTagName("video");
			for (let i = 0; i < videos.length; i++) {
				videos[i].setAttribute('playsinline', 'true');
			}

			if(videos.length >= 2) {
				try {
					isLoading = true;
				  clearInterval(connectedId);
				} catch (exception) {
				  // 예외 처리 코드
				}
			}
			
        });
    });
	
}

//채팅 나가기
function chatExit(){

    socket.emit("chatExit",ROOM_ID);
    alert("진료가 종료되었습니다.");
    top.history.back();
}
videoChange('user');



