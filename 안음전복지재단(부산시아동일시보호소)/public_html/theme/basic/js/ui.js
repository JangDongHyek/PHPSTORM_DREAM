//////패밀리사이트
//$(document).ready(function(){
//	$(".fs dt").click(function(){
//		$(".fs dd").toggle();
//	});
//	$(".fs dd").click(function(){
//		$(this).hide();
//	});
//});
//
//
////내용 탭패널
$(document).ready(function(){
	$("ul.panels li:not("+$("ul.tabs li a.selected").attr("href")+")").hide();
	$("ul.tabs li a").click(function(){
		$("ul.tabs li a").removeClass("selected");
		$(this).addClass("selected");
		$("ul.panels li").hide();
		$($(this).attr("href")).show();
		return false;
	 });
});

//상하단바로가기 버튼
//$(document).ready(function(){
//	$("#gobtn").hide();
//	 
//	// fade in #back-top
//	$(function () {
//		$(window).scroll(function () {
//			if ($(this).scrollTop() > 50) {
//				$('#gobtn').fadeIn();
//			} else {
//				$('#gobtn').fadeOut();
//			}
//		});
//	});
//	
//	   $('.goHd').click(function($e){
//	   $('html, body').animate({scrollTop:0}); return false
//	 });
//});


//와우js
$(document).ready(function(){
	new WOW().init();
});


//헤드 스크롤반응
//$(document).ready(function(){
//		// 스크롤이 발생 될 때
//		$(window).scroll(function(){
//			var sct = $(window).scrollTop();
//			if(sct>=70){
//				// #header에 클래스on이 추가됨.
//				$("#hd").addClass("on");
//				};
//			// 만약 sct의 값이 150미만이면
//			if(sct<=70){
//				$("#hd").removeClass("on");
//				}
//		}); //스크롤이벤트끝
//});
//


//메인 메뉴 애니메이션 시작
		$(document).ready(function(){
			$('#Main_header_wrap').animate({
				 width:'100%',
				 height:'90px',
				 opacity:'1', 
			     },1000);	
		});	
		
//메인 메뉴 애니메이션 끝


//메인 메뉴 내려오는 시작
$(document).ready(function(){
	$('#Main_menu a').on('mouseenter', function(){
		$('#Main_dropdown_wrap').slideDown();

		$('#Main_dropdown_wrap').mouseleave(function(){
			$('#Main_dropdown_wrap').slideUp();
		});
	});

});
//메인 메뉴 내려오는 끝
