$(window).load(function(){
	browserCheck();
});

$(document).ready(function() {
	subHeader();
	gallerySlider();
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


//subHeader
function subHeader(){
	if(($('#visual').length > 0)) return;
	$('#hd').attr('data-show','active');
	$('#footer').attr('data-show','active');
}


//sub visual nav
$(window).load(function(){
	if($("section").length > 0){
		var lnbLeft = $('section .dd > dd > a.on').offset().left;
		$('section #left').animate( { scrollLeft : lnbLeft }, 1000 );
	}
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


$(document).ready(function(){
  $('.pop_list').bxSlider({
	  responsive : true,            // 반응형
	  mode : 'horizontal',           // 'horizontal', 'vertical', 'fade'
	  pager : true,                 // 페이지버튼 사용유무
	  Controls : true,              // 좌우버튼 사용유무
	  auto : true,                  // 자동재생
	  pause : 7000,                  // 자동재생간격
	  speed : 1000,                  // 이미지전환속도
	  autoControls : false,          // 재생버튼 사용
	  //autoControlsCombine : true,   // 플레이, 스탑버튼 교차
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


//와우js
$(document).ready(function(){
	new WOW().init();
});

function gallerySlider(){
	if(!($('.swiper-container').length > 0)) return;
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 1,
		spaceBetween: 30,
		loop : true,
		autoplay : { 
			delay : 5000, 
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
      },
    });
}