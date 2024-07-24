$(window).load(function(){
	browserCheck();
});

$(document).ready(function() {
	menuTab();
	subHeader();
	roomSlider();
});

//browser check
function browserCheck(){
	var agent = navigator.userAgent.toLowerCase();

	if (agent.indexOf("msie") > -1 || agent.indexOf("trident") > -1) {
		$('body').addClass('ie');
	} else if ( agent.search( "edge/" ) > -1 ){
		$('body').addClass('ie_edge');
	} else {

	}
}


//헤드 스크롤반응
$(document).ready(function(){
		// 스크롤이 발생 될 때
		$(window).scroll(function(){
			var sct = $(window).scrollTop();
			if(sct>=130){
				// #header에 클래스on이 추가됨.
				$("#hd").addClass("on");
				};
			// 만약 sct의 값이 150미만이면
			if(sct<=130){
				$("#hd").removeClass("on");
				}
		}); //스크롤이벤트끝
});

//subHeader
function subHeader(){
	if(($('#visual').length > 0)) return;
	$('#hd').attr('data-show','active');
	$('#footer').attr('data-show','active');
}


//sub visual nav
$(window).load(function(){
	if($("#hd .gnb").length > 0){
		var lnbLeft = $('#hd .gnb ul > li > a.on').offset().left;
		$('#hd .gnb > div').animate( { scrollLeft : lnbLeft }, 1000 );
	}
});

//work tab
function menuTab(){
    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		}
    });
}


////패밀리사이트
$(document).ready(function(){
	$(".fs dt").click(function(){
		$(".fs dd").toggle();
	});
	$(".fs dd").click(function(){
		$(this).hide();
	});
});


//내용 탭패널
$(function(){
	$("ul.panel li:not("+$("ul.tab li a.selected").attr("href")+")").hide();
	$("ul.tab li a").click(function(){
		$("ul.tab li a").removeClass("selected");
		$(this).addClass("selected");
		$("ul.panel li").hide();
		$($(this).attr("href")).show();
		return false;
		})
})

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




function roomSlider(){
	if(!($('.swiper-container').length > 0)) return;
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 3,
		spaceBetween: 30,
		loop : true,
		autoplay : { 
			delay : 3000, 
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
      },
		breakpoints: {
			1500: {
				slidesPerView: 3,
				spaceBetween: 50,
			},
			1300: {
				slidesPerView: 3,
				spaceBetween: 40,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
			767: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			550: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			300: {
				slidesPerView: 1,
				spaceBetween:0,
			},
		}
    });
}