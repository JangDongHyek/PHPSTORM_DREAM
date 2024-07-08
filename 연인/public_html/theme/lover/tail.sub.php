<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


<style>
#loader_wrap {display: none; position: fixed; top: 0; left: 0; bottom: 0; width: 100%; height: 100%; padding-top: 50%;}
#loader_wrap .loader, #loader_wrap .loader:before, #loader_wrap .loader:after {background: #ac9dd4; -webkit-animation: load1 1s infinite ease-in-out; animation: load1 1s infinite ease-in-out; width: 1em; height: 4em;}
#loader_wrap .loader {color: #ac9dd4; text-indent: -9999em; margin: 88px auto; position: relative; font-size: 11px; -webkit-transform: translateZ(0); -ms-transform: translateZ(0); transform: translateZ(0); -webkit-animation-delay: -0.16s; animation-delay: -0.16s; z-index: 10;}
#loader_wrap .loader:before, #loader_wrap .loader:after {position: absolute; top: 0; content: '';}
#loader_wrap .loader:before {left: -1.5em; -webkit-animation-delay: -0.32s; animation-delay: -0.32s;}
#loader_wrap .loader:after {left: 1.5em;}
@-webkit-keyframes load1 {
  0%, 80%, 100% {box-shadow: 0 0; height: 4em;}
  40% {box-shadow: 0 -2em; height: 5em;
  }
}
@keyframes load1 {
  0%, 80%, 100% {box-shadow: 0 0; height: 4em;  }
  40% {box-shadow: 0 -2em; height: 5em;}
}
#loader_wrap .txt {text-align: center; z-index: 10; position: relative;}
#loader_wrap .txt span {font-size: 1.5em; font-weight: bold; display: inline-block;}
#loader_wrap .bg {position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #DDD; opacity: 0.7;}

.loader2 {text-align:center; margin-top:40px;}
.loader2 img{width:146px; border-radius:4px;}

</style>

<div id="loader_wrap">
	<div class="txt"><span><? echo ($w == "")? "회원가입" : "회원수정"; ?> 처리 중입니다</span></div>
	<!--div class="loader">Loading...</div-->
	<div class="loader2"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/loading.gif"></div>
	<div class="bg"></div>
</div>


<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>