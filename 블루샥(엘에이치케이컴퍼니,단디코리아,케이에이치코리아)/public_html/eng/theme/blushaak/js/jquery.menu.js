
//피씨버전 상단메뉴 시작
$(document).ready(function() {	
	$('#gnb .gnb_1dli').hover(function() {
		$('ul.gnb_2dul', this).slideDown(200);
		$('ul.gnb_2dul', this).css('display','block');
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul.gnb_2dul', this).slideUp(200);
		$('ul.gnb_2dul', this).css('display','none');
		$(this).children('a:first').removeClass("hov");		
	});
});
//피씨쪽 상단메뉴 끝





//모바일쪽 상단 트리메뉴 시작

        $(document).ready(function(){
            window.onload = function(){
                var wrapHeight = $('body').height();
                $('#navtoggle').css("height", wrapHeight);
            };
            $(window).resize(function() {
                var wrapHeight = $('body').height();
                $('#navtoggle, #mask').css("height", wrapHeight);
            });
            $('.nav_open').click(function(){
                var maskHeight = $('body').height();
                var maskWidth = $(window).width();
                var nav =  $('#navtoggle');
                $('#mask').css({
                    'display'	: 'block',
                    'opacity'	: 0.7,
                    'height'	: maskHeight,
                    'width'		: maskWidth
                })
                nav.css('display','block');
                nav.animate({width:"100%",right:"0" }, 200);
                $('.inner').animate({left:"0"}, 200);
            });
            $('.nav_close, #mask').click(function(){
                var nav =  $('#navtoggle');
                $('#mask').css('display','none');
                $('.inner').animate({left:"0"}, 200);
                nav.animate({
                    width		:"0",
                }, 200, function(){nav.css('display','none')});
            });
            
        
       // $(function(){
               // $("#navtoggle ul.mgnb_2dul").css("display","none");
                //$("ul.gnb_2dul:not(:first)").css("display","none");
                //$("a.gnb_1da:first").addClass("selected")
                //$("#navtoggle a.mgnb_1da").click(function(){
                   // if($("+#navtoggle ul.mgnb_2dul", this).css("display")=="none"){
                     //   $("#navtoggle ul.mgnb_2dul").show();
                      //  $("+#navtoggle ul.mgnb_2dul", this).hide();
                      //  $("#navtoggle a.mgnb_1da").removeClass("selected");
                      //  $(this).addClass("selected");				
                      //  }
                   // })
       // })
	   
		// .gnb .d1 h3를 클릭
		$(".mgnb_1dli .mgnb_1da").click(function(){
				// 내가 클릭한 h3와 짝이 되는 .d2의 display속성값을 저장
				var dp = $(this).siblings("ul.mgnb_2dul").css("display");
				// 조건문을 사용해 변수dp의 값이 none일 때와 block일 때 일어날일을 각각 지정한다.
				// 만약 변수dp가 none과 같다면
				if(dp=="none"){
					// 모든h3를 대상으로 .on 삭제
					$(".mgnb_1dli .mgnb_1da").removeClass("on");
					// 내가 클릭한 대상에게 .on클래스 추가
					$(this).addClass("on");
					// 모든 .d2가 안보이게 만든다.
					$(".mgnb_1dli ul.mgnb_2dul").slideUp(500);
					// 내가 클릭한 대상과 짝이 되는 .d2가 보여진다.
					$(this).siblings("ul.mgnb_2dul").slideDown(500);
					}
				// 만약 변수 dp가 block과 같다면
				if(dp=="block"){
					// 모든 h3대상으로 .on삭제
					$(".mgnb_1dli .mgnb_1da").removeClass("on");
					// 모든 .d2대상으로 보이지않게 한다.
					$(".mgnb_1dli ul.mgnb_2dul").slideUp(500);
					}
				// 클릭이벤트의 대상이 a태그는 아니지만, 현재 클릭되는 범위에 a태그가 있으므로
				// a태그의 링기능을 무효화 시키는 명령 추가	
				return false;
			});

        });	
//모바일쪽 상단 트리메뉴 끝




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


$(document).ready(function() {
	workTab();
});

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




