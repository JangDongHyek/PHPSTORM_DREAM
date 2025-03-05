<?php
include_once('./_common.php');
include_once('../jl/JlConfig.php');

$g5['title'] = '기도요청';
include_once('./admin.head.php');
?>
<div id="bo_list">
    <div id="app" class="tbl_head01 tbl_wrap">
        <bbs-prayer-list></bbs-prayer-list>
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
