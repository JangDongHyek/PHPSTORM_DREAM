//헤드 스크롤반응
$(document).ready(function(){
	// 스크롤이 발생할 때
	$(window).scroll(function(){
		var sct = $(window).scrollTop();
		if(sct >= 130){
			// #hd에 클래스 on 추가
			$("#hd").addClass("on");
		} else {
			// #hd에 클래스 on 제거
			$("#hd").removeClass("on");
		}
	}); // 스크롤 이벤트 끝
});


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
	  $('.topHd').click(function($e){
	  $('html, body').animate({scrollTop:0}); return false
    });
});


//와우js
$(document).ready(function(){
	new WOW().init();
});


//scroll down
$(document).ready(function(){
	$('.scrolldown').click (function() {
		  $('html, body').animate({scrollTop: $('#content').offset().top }, 'slow');
		  return false;
	});
});
