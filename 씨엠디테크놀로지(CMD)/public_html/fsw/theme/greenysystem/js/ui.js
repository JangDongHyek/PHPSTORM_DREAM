


//패밀리사이트
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

// 제품소개 EHS 탭
$(document).ready(function(){
	$(".ehs .tab h3").click(function(){
		$(".ehs .tab").removeClass("on");
		$(this).parent().addClass("on");
	});
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
});

// 탭메뉴
$(document).ready(function(){
	$(".as .tab h3").click(function(){
		$(".as .tab").removeClass("on");
		$(this).parent().addClass("on");
	});
});

//사업영역 탭패널

$(document).ready(function(){
$(function(){
	//탭타이틀에 맞춰서 해당 패널을 제외한 나머지 패널 숨기기
	//$("ul.tap li a.selected").attr("href")
	$("ul.panel li:not("+$("ul.tab li a.selected").attr("href")+")").hide();
	$("ul.tab li a").click(function(){
		//모든 seclected클래스를 제거
		$("ul.tab li a").removeClass("selected");
		//내가 클릭한 대상에만 selected클래스 넣기
		$(this).addClass("selected");
		//모든 패널을 숨김
		$("ul.panel li").hide();
		//$("ul.panel li").slideUp("normal");
		//$("ul.panel li").fadeOut();
		//내가 클릭한 타이틀과 연결된 패널을 열기
		$($(this).attr("href")).show();
		//$($(this).attr("href")).slideDown("fast");
		//$($(this).attr("href")).fadeIn();
		return false;
		})
})
});
