<?php
$pid = "point";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <point-main mb_id="<?=$member['mb_id']?>"></point-main>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/point");
$jl->componentLoad("/item");
?>


<?php
include_once("./app_tail.php");
?>