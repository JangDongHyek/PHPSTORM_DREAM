<?php
$pid = "class_list";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
    <div id="app">
        <bbs-class_report-list wr_7="<?=$_GET['wr_7']?>" mb_no="<?=$member['mb_no']?>" mb_1="<?=$member['mb_1']?>"></bbs-class_report-list>
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