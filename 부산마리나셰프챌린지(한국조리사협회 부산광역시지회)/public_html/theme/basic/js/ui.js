/*/패밀리사이트
$(document).ready(function(){
	$(".fs dt").click(function(){
		$(".fs dd").toggle();
	});
	$(".fs dd").click(function(){
		$(this).hide();
	});
});

// 게시판추출 탭
$(document).ready(function(){
	$(".tbbs .tab h3").click(function(){
		$(".tbbs .tab").removeClass("on");
		$(this).parent().addClass("on");
	});
});

// 어업기술마당 탭
$(document).ready(function(){
	$(".mskill .tab h3").hover(function(){
		$(".mskill .tab").removeClass("on");
		$(this).parent().addClass("on");
	});
});

//메인/서브 슬로건
$(document).ready(function(){
	//메인
	$('#visual #slogan .tit').delay(500).animate({top:'280px',opacity:'1.0'}, 1000);
	$('#visual #slogan .s1').delay(1000).animate({top:'330px',opacity:'1.0'}, 1000);
	$('#visual #slogan .s2').delay(1500).animate({top:'400px',opacity:'1.0'}, 1000);
	//서브
	$('#subvisual #slogan .tit').delay(500).animate({top:'120px',opacity:'1.0'}, 1000);
	$('#subvisual #slogan .s1').delay(1000).animate({top:'160px',opacity:'1.0'}, 1000);
});

// 제품소개 EHS 탭
$(document).ready(function(){
	$(".ehs .tab h3").click(function(){
		$(".ehs .tab").removeClass("on");
		$(this).parent().addClass("on");
	});
});*/

//상하단 바로가기 버튼
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
