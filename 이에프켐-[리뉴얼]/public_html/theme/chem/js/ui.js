$(document).ready(function() {
	browserCheck();
	subHeader();
	layerPopup();
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

//subHeader
function subHeader(){
	if(($('#visual').length > 0)) return;
	$('#hd').attr('data-show','active');
	$('#footer').attr('data-show','active');
}

var main = function() { //메뉴 토글


};

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

$(document).ready(function() {
	//scroll event
	window.onscroll = function() {historyAni()};

	function historyAni() {
		var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
		var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
		var scrolled = (winScroll / height) * 100;
		document.getElementById("historyLine").style.height = scrolled - 3 + "%";
	}
});


//scroll custom
$(window).scroll( function(){

	$('.history > li').each( function(i){
		
		var bottom_of_object = $(this).offset().top + $(this).outerHeight()/3;
		var bottom_of_window = $(window).scrollTop() + $(window).height();
		
		if( bottom_of_window > bottom_of_object ){                
			$(this).addClass("active");	                    
		}
		else{
				$(this).removeClass('active');
			}		
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

//layer popup
function layerPopup(){
	var videoEmbed = $('.popupBox > div').html();
	$('.area_certificate a').on('click',function(){
		var videoSrc = $(this).find('img').attr('src');		
		$('.popupBox > div').html(videoEmbed);
		$('.popLayer').addClass('active');
		$('#layerPopup img').attr('src', videoSrc);		
		return false;
	});

	//popup
	if($('.popupBox').length > 0){
		$(document).mouseup(function(e){
			var container = $('.popLayer');
			if(container.has(e.target).length === 0){
				$('.popLayer').removeClass('active');
				$('.popupBox > div').html('');
			}
		});
		$(document).on('click','.popLayer a.close',function(){			
			$('.popLayer').removeClass('active');
			$('.popupBox > div').html('');
			return false;
		});
	}
}

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
