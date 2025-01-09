<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


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

<?php /*?><!-- Mirae Log Analysis Script Ver 1.0   -->
<script TYPE="text/javascript">
var mi_adkey = "nkzek";
var mi_script = "<scr"+"ipt "+"type='text/javascr"+"ipt' src='http://log1.toup.net/mirae_log.js?t="+(new Date().getTime())+"' async='true'></scr"+"ipt>"; 
document.writeln(mi_script);
</script>
<!-- Mirae Log Analysis Script END  -->
<!--NAVER SCRIPT-->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script> 
<script type="text/javascript"> 
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_26563a0c5861";
if (!_nasa) var _nasa={};
wcs.inflow();
wcs_do(_nasa);
</script>
<!--NAVER SCRIPT END-->
<?php */?></body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>