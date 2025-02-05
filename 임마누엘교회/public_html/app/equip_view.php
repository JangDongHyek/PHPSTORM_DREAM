<?php
$pid = "equip_view";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

    <div id="app">

        <div id="rental" class="view">
            <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_equip'"><i class="fa-solid fa-arrow-left"></i> 비품 대여 목록</button>

            <rental-equip-view primary="<?=$_GET['idx']?>" mb_no="<?=$member['mb_no']?>" admin="<?=$is_admin?>"></rental-equip-view>
        </div>
    </div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/rental/equip");
$jl->componentLoad("/item");
?>

<?php
include_once("./app_tail.php");
?>