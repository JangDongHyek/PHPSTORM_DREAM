<?php
$pid = "helper_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <bbs-helper-input mb_no="<?=$member['mb_no']?>" primary="<?=$_GET['primary']?>"></bbs-helper-input>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/helper");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>