$(window).load(function(){
	browserCheck();
});

$(document).ready(function() {
	subHeader();
	NoticeSlider();
	//subbg();
	scrollFixed();
	workTab();
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

//sub visual nav
$(window).load(function(){
	if($(".sub_nav section").length > 0){
		var lnbLeft = $('section .dd > dd > a.on').offset().left;
		$('.sub_nav section #left').animate( { scrollLeft : lnbLeft }, 1000 );
	}
});

function subbg(){
	if(!($('.area_business').length > 0)) return;	
	var bg = $('.area_business');
	var body = $('body');
	var scrollTop = bg.offset().top;

	$(window).scroll(function(){		
		var winTop = $(window).scrollTop();
		if(winTop >= scrollTop - 1000){
			body.addClass('on');			
		}else{
			body.removeClass('on');			
		}			
	});	
}



//$(window).scroll(function() {
	//console.log('스크롤 Y 값 보기', $(window).scrollTop());
//});

function scrollFixed(){
	 var fixedBG = 800;
	 var fixedTitle = 1300;
	 var offTitle = 2600;
	  
	  $(window).scroll(function() {
		var scrollY = $(this).scrollTop();
		var body = $('body');
		var titleEl = $('.area_business .title');
		 if ( scrollY >= fixedBG ) {
				body.addClass('on');
		   }
		   else {
				body.removeClass('on');
		   }
		if (scrollY >= fixedTitle ) {
				titleEl.addClass('on');
			} else {
				titleEl.removeClass('on');
			}
		if (scrollY >= offTitle) {
			titleEl.addClass('off')
		} else {
			titleEl.removeClass('off');
		}
	  });
}
		

//subHeader
function subHeader(){
	if(($('#visual').length > 0)) return;
	$('#hd').attr('data-show','active');
	$('#footer').attr('data-show','active');
}

//visual notice animation
$(function(){
	setTimeout(function(){
		$('.area_notice').addClass('active');			
	}, 200);  	
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


//scroll down
$(document).ready(function(){
	$('.scrolldown').click (function() {
		  $('html, body').animate({scrollTop: $('#content').offset().top }, 'slow');
		  return false;
	});
});


function NoticeSlider(){
	if(!($('.area_notice').length > 0)) return;
	$('.area_notice .list').bxSlider({
		auto:true,
		mode:'vertical',
		controls:false,
		pager:false,
		pause:6000,
		speed:1000,
	});
}


//work tab
function workTab(){
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


//business slide
//$(function(){
//	$('.area_photo .list').bxSlider({
//		auto:true,
//		mode:'fade',
//		controls:true,
//		pager:true,
//		pause:4000,
//		speed:1000,
//	});
//});

//$(document).ready(function() {
//	//scroll event
//	window.onscroll = function() {historyAni()};
//
//	function historyAni() {
//		var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
//		var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
//		var scrolled = (winScroll / height) * 100;
//		document.getElementById("historyLine").style.height = scrolled - 3 + "%";
//	}
//});