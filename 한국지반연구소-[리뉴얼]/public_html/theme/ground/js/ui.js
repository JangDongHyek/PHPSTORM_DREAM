//////패밀리사이트
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
/*$(document).ready(function(){
		// 스크롤이 발생 될 때
		$(window).scroll(function(){
			var sct = $(window).scrollTop();
			if(sct>=80){
				// #header에 클래스on이 추가됨.
				$("#hd").addClass("on");
				};
			// 만약 sct의 값이 150미만이면
			if(sct<=80){
				$("#hd").removeClass("on");
				}
		}); //스크롤이벤트끝
});
//*/




/* header */
$(document).ready(function(){
	/* *********** header *********** */
	/* $('#header .gnb_wrap>ul').on('mouseenter',function(){

    });
    $('#header .gnb_wrap>ul').on('mouseleave',function(){

    }); */


	//스크롤시 header bg 흰색
	$(window).scroll(function () {
		var $scrollTop = $(this).scrollTop();
		var $logoImg = $('.logo img');
		//console.log($scrollTop);

		//nav 나타나게
		if ($scrollTop > 1) {
			$('#header').addClass('white');
			$logoImg.attr('src', 'https://dreamforone.kr:443/~hankukjiban_re/theme/ground/img/common/logo_color.png');
			$('#topm li a').css({'color': '#6e6e6e'});
		} else {
			$('#header').removeClass('white');
			$logoImg.attr('src', 'https://dreamforone.kr:443/~hankukjiban_re/theme/ground/img/common/logo.png');
			$('#topm li a').css({'color': '#eee'});
		}
	});


	/* 오른쪽 사이드메뉴 */
	$(document).on('click', '.all_menu_btn', function(){
		$('.hd_all_menu').addClass('open');
	});
	$(document).on('click', '.hd_all_close a', function(){
		$('.hd_all_menu').removeClass('open');
	});


	$(document).on('click', '.hd_tab_menu li a', function(e){
		e.preventDefault();

		$(this).addClass('active').parent('li').siblings().find('a').removeClass('active');

		var tabmenuIndex = $(this).parent('li').index();
		//console.log(tabmenuIndex);
		var tabCont = $('.hd_tab');

		tabCont.eq(tabmenuIndex).addClass('active').siblings('div').removeClass('active');
	});




	$(document).on('click', '.hd_tab>ul>li>a', function(e){
		//e.preventDefault();

		if($(this).hasClass('on')){
			$(this).removeClass('on');
		}else{
			$(this).addClass('on').parent('li').siblings().find('a').removeClass('on');
		}

		$(".react-slidedown").slideUp();
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	});
});




/* 서브페이지 서브메뉴 */
// sub nav
$(document).on('click', '.sub-1item', function(e){
	if($(this).hasClass('on')){
		$('.sub-2ul').slideUp('fast');
		$('.sub-1item').removeClass('on');
	}else{
		$('.sub-2ul').slideUp('fast');
		$('.sub-1item').removeClass('on');
		$(this).addClass('on').next().slideDown('fast');
	}
});




//일반현황 탭
$(function(){
	$(".panels .pa:not("+$(".tabs .ta a.selected").attr("href")+")").hide();
	$(".tabs .ta a").click(function(){
		$(".tabs .ta a").removeClass("selected");
		$(this).addClass("selected");
		$(".panels .pa").hide();
		$($(this).attr("href")).show();
		return false;
		});
});


