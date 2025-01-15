<?php
$pid = "video_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <bbs-video-input mb_no="<?=$member['mb_no']?>"></bbs-video-input>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/video");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>