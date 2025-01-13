<?php
$pid = "prayer";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");

?>

<div id="app">
    <bbs-prayer-list></bbs-prayer-list>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/prayer");
?>

<?php
include_once("./app_tail.php");
?>