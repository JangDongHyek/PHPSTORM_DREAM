

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


//와우js
$(document).ready(function(){
	new WOW().init();
});


//헤드 스크롤반응
$(document).ready(function(){
		// 스크롤이 발생 될 때
		$(window).scroll(function(){
			var sct = $(window).scrollTop();
			if(sct>=70){
				// #header에 클래스on이 추가됨.
				$("#hd").addClass("on");
				};
			// 만약 sct의 값이 150미만이면
			if(sct<=70){
				$("#hd").removeClass("on");
				}
		}); //스크롤이벤트끝
});

