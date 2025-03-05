<?php
include_once('./_common.php');
include_once('../jl/JlConfig.php');

$g5['title'] = '기도요청';
include_once('./admin.head.php');
?>
<div id="bo_v">
    <div>
        <h1 id="bo_v_title">
            기도요청이 등록이 접수되었습니다.</h1>
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
