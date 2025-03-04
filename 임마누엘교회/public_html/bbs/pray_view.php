<?
include_once('./_common.php');
include_once("../jl/JlConfig.php");
include_once(G5_THEME_PATH.'/head.php');
include_once(G5_BBS_PATH.'/board_head.php');

$g5['title'] = '기도 상세';
?>
    <link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/skin/board/prayer/style.css?v=1">
<div id="bo_v">
    <div id="sub_title">
        기도 상세
    </div>
    <div id="app">
        <bbs-prayer-view primary="<?=$_GET['idx']?>" mb_no="<?=$member['mb_no']?>" mb_1="<?=$member['mb_1']?>"></bbs-prayer-view>
    </div>

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <ul class="text_right">
            <li><a href="javascript:history.back();" class="btn_b01">목록</a></li>
        </ul>
    </div>
</div>
<style>
    #sub_title {display: none}
    #bo_v #sub_title {display: block}
</style>
<?

$jl->vueLoad('app',["swal"]);
$jl->componentLoad("/bbs/prayer");
$jl->componentLoad("/item");


include_once(G5_BBS_PATH.'/board_tail.php');

include_once(G5_PATH.'/tail.php');
?>