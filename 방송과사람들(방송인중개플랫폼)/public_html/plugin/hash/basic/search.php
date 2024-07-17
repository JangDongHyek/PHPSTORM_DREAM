<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL;?>/hash/style.css">


<nav id="navtoggle">
    <div class="hd_title">
        <a href="javascript:history.back();" class="btn_close"><i class="fa-regular fa-arrow-left"></i><span class="sound_only">닫기</span></a>
        <p class="title">검색</p> 
    </div>
    <div class="scroll">
    	<div id="hash_sch">
        	<p class="title"><strong>어떤 전문가</strong>를<br />찾고 계신가요?</p>
		<div class="hd_sch">
			<input type="text" placeholder="검색어를 입력해주세요.">
			<button type="submit"></button>
			<!--<a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_sch.svg"></a>-->
		</div>
        </div>
    </div>
</nav>

<script>
$(document).ready(function() {
	// 모바일 트리메뉴 .gnb .d1 h3를 클릭
	$("#navtoggle .mgnb_1dli .mgnb_1da").click(function(){
		var dp = $(this).siblings("ul.mgnb_2dul").css("display");
		if(dp=="none"){
			$("#navtoggle .mgnb_1dli .mgnb_1da").removeClass("on");
			$(this).addClass("on");
			$("#navtoggle .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			$(this).siblings("ul.mgnb_2dul").slideDown(500);
			}
		if(dp=="block"){
			$("#navtoggle .mgnb_1dli .mgnb_1da").removeClass("on");
			$("#navtoggle .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			}
		return false;
	});
});
</script>