<?php
$pid = "class_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <bbs-class_report-input mb_no="<?=$member['mb_no']?>" mb_1="<?=$member['mb_1']?>"
                            mb_2="<?=$member['mb_2']?>" mb_3="<?=$member['mb_3']?>" mb_name="<?=$member['mb_name']?>"
                            primary="<?=$_GET['primary']?>"
    ></bbs-class_report-input>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/class_report");
$jl->componentLoad("/item");
$jl->componentLoad("/external");
?>

<?php
include_once("./app_tail.php");
?>