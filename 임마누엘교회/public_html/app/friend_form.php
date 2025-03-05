<?php
$pid = "friend_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <bbs-friend-input mb_no="<?=$member['mb_no']?>" primary="<?=$_GET['primary']?>"></bbs-friend-input>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/friend");
$jl->componentLoad("/item");
$jl->componentLoad("/external");
?>
<?php
include_once("./app_tail.php");
?>