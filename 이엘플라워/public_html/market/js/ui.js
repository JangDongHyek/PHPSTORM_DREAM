//상하단바로가기 버튼
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});	



//메인슬라이드시작
$(function(){ // 실행시작
	
	 $(".main_slider").slidesjs({
	   width:2000,
	   height:480,
	   navigation : {
		 active : true, // 좌우버튼사용하면 true, 아니면 false
		 //effect : "fade" // 좌우버튼 사용시 발생되는 효과지정.
	   }, pagination : {
		 active : true,
		 //effect : "fade"
	   }, play : {
		 active : true,
		// effect : "fade",
		 auto : true ,
		 interval: 3000
	   }, effect: {
		 slide: {
		 speed:1000 
		  },
		 fade : {
				speed : 2500,
				crossfade: true
		 } 
	   }
	 })
}) // 실행끝
//메인슬라이드끝





