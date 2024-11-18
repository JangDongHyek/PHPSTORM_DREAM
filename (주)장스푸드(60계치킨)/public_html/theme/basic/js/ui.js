$(document).ready(function(){
	//와우js
	new WOW().init();

		// 스크롤이 발생 될 때
		$(window).scroll(function(){
			var sct = $(window).scrollTop();
			if(sct>=180){
				// #header에 클래스on이 추가됨.
				$("#hd").addClass("on");
				};
			// 만약 sct의 값이 150미만이면
			if(sct<=180){
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

	 //메뉴소개 페이지 팝업
	$(".btnlist li").click(function(){
		var idx = $(this).index();
		var tg = $(".popup li").eq(idx);
		$(".popup li").hide();
		$(".bg").show();
		$(".popup").fadeIn();
		tg.fadeIn();
	});
	$(".close").click(function(){
		$(".popup").fadeOut();
		$(".bg").fadeOut();
	});
	

});	

//아이프레임
/*$(function() {
	$('iframe').load(function() {
		$(this).css("height", $(this).contents().find("body").height() + "px");
	});
});*/
