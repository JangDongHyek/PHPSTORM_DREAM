//상하단바로가기 버튼
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 0) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});	



//메인슬라이드시작
$(function(){ // 실행시작
	
	 $(".main_slider").slidesjs({
	   width:817,
	   height:430,
	   navigation : {
		 active : true, // 좌우버튼사용하면 true, 아니면 false
		 effect : "fade" // 좌우버튼 사용시 발생되는 효과지정.
	   }, pagination : {
		 active : true,
		 effect : "fade"
	   }, play : {
		 active : true,
		 effect : "fade",
		 auto : true ,
		 interval: 2000
	   }, effect: {
		 slide: {
		 speed:1000 
		  },
		 fade : {
				speed : 1000,
				auto : true,
				crossfade: true
		 } 
	   }
	 })
}) // 실행끝
//메인슬라이드끝





