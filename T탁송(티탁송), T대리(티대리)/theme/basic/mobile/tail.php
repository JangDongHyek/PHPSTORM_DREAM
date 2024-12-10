<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>

<!-- 로딩바 -->
<style>
#page_loader {text-align: center; position: fixed; width: 100%; top: 50%; margin-top: -110px; display: none;}
#page_loader div, #page_loader div:after {border-radius: 50%; width: 10em; height: 10em;}
#page_loader div {margin: 60px auto; font-size: 10px; position: relative; text-indent: -9999em; border-top: 1.1em solid rgba(23,23,23, 0.2); border-right: 1.1em solid rgba(23,23,23, 0.2); border-bottom: 1.1em solid rgba(23,23,23, 0.2); border-left: 1.1em solid #171717; -webkit-transform: translateZ(0); -ms-transform: translateZ(0); transform: translateZ(0); -webkit-animation: load8 1.1s infinite linear; animation: load8 1.1s infinite linear;}
@-webkit-keyframes load8 {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg);
  }
}
@keyframes load8 {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
</style>

<div id="page_loader"><div>Loading...</div></div>



<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>