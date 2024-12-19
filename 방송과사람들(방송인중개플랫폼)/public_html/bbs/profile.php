<?
include_once('./_common.php');
$g5['title'] = '전문가 정보';
include_once('./_head.php');
include_once(G5_PATH."/jl/JlConfig.php");
$name = "profile";
$pid = "profile";

?>

        <style>
            @media screen and (max-width:1024px) {
                #nav_area{display: none;}
            }
        </style>

<div id="app">
    <profile-view mb_no="<?=$_GET['mb_no']?>"></profile-view>
</div>

<?php $jl->vueLoad("app")?>
<?php $jl->componentLoad("profile");?>
<?php $jl->componentLoad("part");?>

<?
include_once('./_tail.php');
?>

