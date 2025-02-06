<?php
$pid = "lost_view";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="rental" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./lost'"><i class="fa-solid fa-arrow-left"></i> 분실 목록</button>

        <bbs-lost-view primary="<?=$_GET['idx']?>" mb_no="<?=$member['mb_no']?>" admin="<?=$is_admin?>"></bbs-lost-view>
    </div>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/lost");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>