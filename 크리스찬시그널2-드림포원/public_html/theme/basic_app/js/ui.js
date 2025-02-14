$(document).ready(function(){
	//와우js
	new WOW().init();

		// 스크롤이 발생 될 때
		$(window).scroll(function(){
			var sct = $(window).scrollTop();
			if(sct>=150){
				// #header에 클래스on이 추가됨.
				$("#hd").addClass("on");
				};
			// 만약 sct의 값이 150미만이면
			if(sct<=150){
				$("#hd").removeClass("on");
				}
		}); //스크롤이벤트끝

	/*/패밀리사이트
	$(".fs dt").click(function(){
		$(".fs dd").toggle();
	});
	$(".fs dd").click(function(){
		$(this).hide();
	});
	
	// 게시판추출 탭
	$(".tbbs .tab h3").click(function(){
		$(".tbbs .tab").removeClass("on");
		$(this).parent().addClass("on");
	});
	*/
	
		//상하단 바로가기 버튼
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
	

	
	
	
//	회원상세뷰 토글
// 	$('.title').on('click',function(){
// 		$(this).next('.cont').slideToggle(100,'linear');
// 	});
//
	
});	
