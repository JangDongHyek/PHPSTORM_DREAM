<?php
$pid = "class_noti";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="class">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
        <bbs-class-list></bbs-class-list>
    </div>
</div>
<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/class");
$jl->componentLoad("/item");
$jl->componentLoad("/external");
?>
<?php
include_once("./app_tail.php");
?>