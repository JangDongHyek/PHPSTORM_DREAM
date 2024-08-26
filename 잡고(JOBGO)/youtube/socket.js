const SocketIO = require("socket.io");
const moment = require('moment');
const schedule = require("node-schedule");
require("dotenv").config();
module.exports = (server, app) => {
  const io = SocketIO(server, { path: "/socket.io", cors: { origin: "*" } });

  app.set("io", io);

  const play = io.of("/play"); //http://도메인/service 접근
  const banner = io.of("/banner");
  //음원 관련 소켓통신
  play.on("connection", (socket) => {
	 console.log("JEJE 음원 접속");

	 socket.on("play_request",(data) => {
		 console.log(data);
		 play.emit("play_request",data);
	 });
	 socket.on("requestPlay",(data) => {
		 console.log(data);
		 let date =new Date();
		 date.setMinutes(date.getMinutes() + 2);

		 let date2=moment(date).format("YYYY-MM-DD HH:mm:ss");	 
		 schedule.scheduleJob(date2,()=>{
			console.log(data);
			 play.emit("removeList",data);
		 });
	 });
	 socket.on("refresh",(data)=>{
		 play.emit("refresh",data);
	 });
    //관리자 소켓 연결시키기
    /*let adminId = "";
    socket.on("adminJoin", (data) => {
      console.log(`socket : 소켓연결`);
      adminId = data.user_id;
      socket.join(adminId);
    });
    //고객이 서비스 신청을 하면 관리자모드에서 확인할 수 있게
    socket.on("serviceSend", (data) => {
      socket.to(adminId).emit(data);
    });
    socket.on("disconnect", () => {
      console.log("접속해제");
      socket.leave(adminId);
    });*/
  });
  //배너 소켓통신
  banner.on("connection", (socket) => {
	 socket.on("banner",(data)=>{
		 console.log('배너소켓통신: ', data);
		
		 if(data.is_play=='true'){
			banner.emit("bannerAdd",data);
		 }else{
			banner.emit("bannerRemove",data);
		 }
	 });
  });
};
