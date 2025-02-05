<?php
$pid = "hall_view";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="rental" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_lecture'"><i class="fa-solid fa-arrow-left"></i> 교육관 대관 목록</button>
        <rental-lecture-view primary="<?=$_GET['idx']?>" mb_no="<?=$member['mb_no']?>" admin="<?=$is_admin?>"></rental-lecture-view>
    </div>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/rental/lecture");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>