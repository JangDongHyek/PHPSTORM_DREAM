<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once("../jl/JlConfig.php");
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<div id="app">
    <div class="slogan">
        <h5>이와 같이 성령도 우리의 연약함을 도우시나니 우리는 마땅히 기도할 바를 알지 못하나<br class="hidden-xs">
            오직 성령이 말할 수 없는 탄식으로 우리를 위하여 친히 간구하시느니라 <span>롬 8:26</span></h5>
        <button type="button" class="btn btn_color btn-large" onclick="location.href='./write.php?bo_table=prayer'">기도요청하기</button>
    </div>
    <bbs-prayer-list></bbs-prayer-list>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/prayer");
$jl->componentLoad("/item");
?>
