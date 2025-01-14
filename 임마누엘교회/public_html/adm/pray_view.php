<?php
include_once('./_common.php');
include_once('../jl/JlConfig.php');

$g5['title'] = '기도요청';
include_once('./admin.head.php');
?>

<div id="bo_v" class="bo_view">
    <header>
        <h1 id="bo_v_title">
            기도요청이 등록이 접수되었습니다.</h1>
    </header>
    <div id="bo_v_top">
        <ul class="bo_v_com">
            <li><a href="./prayer_list.php" class="btn_b01">목록</a></li>
        </ul>
    </div>
<div id="app">
    <bbs-prayer-view primary="<?=$_GET['idx']?>"></bbs-prayer-view>
</div>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/prayer");
$jl->componentLoad("/item");
?>
<?php
include_once ('./admin.tail.php');
?>
