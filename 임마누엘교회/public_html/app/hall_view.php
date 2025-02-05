<?php
$pid = "hall_view";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");

?>
<div id="app">
    <div id="rental" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_hall'"><i class="fa-solid fa-arrow-left"></i> 본당 대관 목록</button>
        <rental-hall-view primary="<?=$_GET['idx']?>" mb_no="<?=$member['mb_no']?>" admin="<?=$is_admin?>"></rental-hall-view>
    </div>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/rental/hall");
$jl->componentLoad("/item");
?>

<?php
include_once("./app_tail.php");
?>