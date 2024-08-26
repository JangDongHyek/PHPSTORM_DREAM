const express = require("express");
const path = require("path");
const morgan = require("morgan");
const dotenv = require("dotenv");
const cors = require("cors");
const imagesToPdf = require("images-to-pdf"); //이미지를 pdf로 변환하는 모듈
var base64ToImage = require('base64-to-image');//base64를 이미지로 변환하는 모듈
const fs = require("fs");
const app = express();
const options = {
    ca: fs.readFileSync('/etc/httpd/conf/ssl.crt/AAA_CERTIFICATE_SERVICES.crt'),
    key: fs.readFileSync('/etc/httpd/conf/ssl.key/www.jobgo.ac.key'),
    cert: fs.readFileSync('/etc/httpd/conf/ssl.crt/www.jobgo.ac.crt'),
};
	//클라인트에서 서버 연결할 때 쓰임
const server = require("https").createServer(options, app);

dotenv.config();

app.set("port", 5011);
app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
     next();
   });
app.use(morgan("dev"));
app.use("/", express.static(path.join(__dirname, "public")));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));

app.use(cors());

//서버 시작
app.listen(app.get("port"), async () => {
  //이미지를 pdf 만들기
  await imagesToPdf(["./1.jpg", "./2.jpg", "./3.jpg", "./4.jpg"], "./test.pdf");
  console.log(app.get("port"), "번 포트에서 대기 중");
});

//포트번호 지정해서 서버 실행이 되게
server.listen(5010, function () {
    //console.log("서버실행");
});

//소켓 실행하기 다른 서버에 쓸수도 있기 때문에 cors는 필수
const io = require("socket.io")(server, {
  path: "/socket.io",
  cors: {
    origin: "*",
  },
});
//소켓이 연결 되었을 때
io.on("connection",  function (socket) {
  //클라이언트와 연결시키기
  socket.on("conn", function (data) {
    socket.emit("conne", { msg: "소켓이 연결되었습니다." });
  });
  //base64 데이터를 이미지로 바꾸기
  socket.on("base64toimage",async (data) => {
	  console.log(1);
	/*var imageArr= data => new Promise((resolve, reject) => {
		console.log(data);
	});
	console.log(imageArr);*/
	console.log(data.images);
	try{
		var base64Str = data.images;
		var path ='./';
		var optionalObj = {'fileName': 'pdf'+data.postNo, 'type':'png'}
		var imageInfo = await base64ToImage(base64Str,path,optionalObj);
		socket.emit("exportImage",{'image':"./pdf"+data.postNo+".png"});
	}catch(e){
		console.log(e);
	}
	



/*	if(0 < imageArr.length){
		await imagesToPdf(["./pdf0.png","./pdf1.png","./pdf2.png"], "./pdftest.pdf");
	}*/
	
/*
	var base64Str = "Add valid base64 str";
	var path ='put a valid path where you want to save the image';
	var optionalObj = {'fileName': 'imageFileName', 'type':'png'};

	base64ToImage(base64Str,path,optionalObj); 
	var imageInfo = base64ToImage(base64Str,path,optionalObj);*/
  });
  //이미지 바꾼 것을 pdf로 바꾸기
  socket.on("createPdf", async (data) => {
	  var imageArr = data.images;
	  await imagesToPdf(imageArr, "./pdftest.pdf");
	  
	  const contents=base64_encode("./pdftest.pdf");
	  //pdf파일 base64로 변경해서 보내기
	  socket.emit("savePdf",{contents:contents});
  });
});

function base64_encode(file) {
    // read binary data
    var bitmap = fs.readFileSync(file);
    // convert binary data to base64 encoded string
    return new Buffer(bitmap).toString('base64');
}
