<? 
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_form";
$pid = "project_form";
?>

<div id="area_project">
    <project-input mb_no="<?=$member['mb_no']?>" primary="<?=$_GET['primary']?>"></project-input>
</div>

<?
$jl->vueLoad("area_project",["summernote"]);
$jl->componentLoad("project");
$jl->componentLoad("external");
?>

<?php
include_once('./_tail.php');
?>