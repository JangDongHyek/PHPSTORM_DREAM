$(document).ready(function(){
	/*/상단 검색바 on/off
        $(function () {
            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });
        });

	//탭패널
	$(function(){
		$("ul.panel li:not("+$("ul.tab li a.selected").attr("href")+")").hide();
		$("ul.tab li a").click(function(){
			$("ul.tab li a").removeClass("selected");
			$(this).addClass("selected");
			$("ul.panel li").hide();
			$($(this).attr("href")).show();
			return false;
			})
	})*/

/*/패밀리사이트
	$(".fs dt").click(function(){
		$(".fs dd").toggle();
	});
	$(".fs dd").click(function(){
		$(this).hide();
	});

// 게시판추출 탭
	$(".tbbs .tab h3").click(function(){
		$(".tbbs .tab").removeClass("on");
		$(this).parent().addClass("on");
	});

// 어업기술마당 탭
	$(".mskill .tab h3").hover(function(){
		$(".mskill .tab").removeClass("on");
		$(this).parent().addClass("on");
	});

//메인/서브 슬로건
	//메인
	$('#visual #slogan .tit').delay(500).animate({top:'280px',opacity:'1.0'}, 1000);
	$('#visual #slogan .s1').delay(1000).animate({top:'330px',opacity:'1.0'}, 1000);
	$('#visual #slogan .s2').delay(1500).animate({top:'400px',opacity:'1.0'}, 1000);
	//서브
	$('#subvisual #slogan .tit').delay(500).animate({top:'120px',opacity:'1.0'}, 1000);
	$('#subvisual #slogan .s1').delay(1000).animate({top:'160px',opacity:'1.0'}, 1000);

*/

	//상하단 바로가기 버튼
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

	//해쉬태그
	$(function (){
		hashload();
		//해쉬태그 레이어 슬라이드
		$(window).hashchange(function(){
			var hashTag = location.hash;
			hashAjax(hashTag);
	
		}).hashchange();
	});

});	
