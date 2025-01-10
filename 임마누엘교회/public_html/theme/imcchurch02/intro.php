<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
?>


<style>
    html{
        overflow: hidden;
    }
</style>
<div id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="intro_slider">
        <!--
        <div class="area_txt">
        </div>
-->
        <ul class="sliderbx">
            <li class="mv01"></li>
            <li class="mv02"></li>
            <li class="mv03"></li>
            <li class="mv04"></li>
            <li class="mv05"></li>
        </ul>

        <a href="./index2.php" id="btn-main">
            <div class="icon">
                홈페이지 들어가기
                <i class="fa-solid fa-arrow-right"></i>
            </div>
<!--
            <div class="txt">
            </div>
-->
        </a>
    </div>
    <!-- //visual -->
</div><!--  #idx_wrapper -->



<?php
include_once(G5_PATH."/tail.sub.php");
?>