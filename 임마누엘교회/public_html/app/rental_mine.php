<?php
$pid = "rental_mine";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
    <div id="app">
        <div id="rental" class="mine">
            <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental'"><i class="fa-solid fa-arrow-left"></i> 대관 메인</button>
            <rental-mine mb_no="<?=$member['mb_no']?>"></rental-mine>
        </div>

    </div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/rental");
$jl->componentLoad("/rental/hall/rental-hall-my-list.php");
$jl->componentLoad("/rental/bus/rental-bus-my-list.php");
$jl->componentLoad("/rental/equip/rental-equip-my-list.php");
$jl->componentLoad("/rental/lecture/rental-lecture-my-list.php");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>