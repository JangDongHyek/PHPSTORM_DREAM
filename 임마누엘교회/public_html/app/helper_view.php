<?php
$pid = "helper_view";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="helper" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./helper'"><i class="fa-solid fa-arrow-left"></i> 도우미 목록</button>
        <bbs-helper-view primary="<?=$_GET['primary']?>" mb_no="<?=$member['mb_no']?>"></bbs-helper-view>
    </div>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/helper");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>