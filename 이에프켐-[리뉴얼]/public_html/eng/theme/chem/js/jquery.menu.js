//pc 메인메뉴
$(document).ready(function() {	
	$('.gnb_1dli').hover(function() {
		$('ul.gnb_2dul', this).slideDown(400);
		$('ul.gnb_2dul', this).css('display','block');
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul.gnb_2dul', this).slideUp(400);
		$('ul.gnb_2dul', this).css('display','none');
		$(this).children('a:first').removeClass("hov");		
	});
});

$(document).ready(function() {
	//모바일 좌측메뉴 해쉬태그
	$(function (){
		hashload();
		//해쉬태그 레이어 슬라이드
		$(window).hashchange(function(){
			var hashTag = location.hash;
			hashAjax(hashTag);
	
		}).hashchange();
	});
	
});

// mobile 해쉬메뉴
$(document).ready(function() {
	$(".mobile_open").click(function() {
		$("#mobile_menu,.page_cover,html").addClass("open");
		window.location.hash = "#open";
	});
	
	window.onhashchange = function() {
		if (location.hash != "#open") {
		$("#mobile_menu,.page_cover,html").removeClass("open");
		}
	};
});

//mobile 해쉬메뉴 > 메뉴
$(document).ready(function() {
	$("#mobile_menu .mgnb_1dli .mgnb_1da").click(function(){
		var dp = $(this).siblings("ul.mgnb_2dul").css("display");
		if(dp=="none"){
			$("#mobile_menu .mgnb_1dli .mgnb_1da").removeClass("on");
			$(this).addClass("on");
			$("#mobile_menu .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			$(this).siblings("ul.mgnb_2dul").slideDown(500);
			}
		if(dp=="block"){
			$("#mobile_menu .mgnb_1dli .mgnb_1da").removeClass("on");
			$("#mobile_menu .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			}
		return false;
	});
});

