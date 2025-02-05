<?php
$pid = "rental_bus";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">

    <div id="rental">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental'"><i class="fa-solid fa-arrow-left"></i> 대관 신청 메인</button>
        <div class="slogan">
            <h6>1호버스(31인승) / 5호버스(24인승)</h6>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./bus_form'">신청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-solid fa-bus"></i> 버스 예약현황</h6>
            <rental-bus-list admin="<?=$is_admin?>"></rental-bus-list>
        </div>
    </div>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/rental/bus");
$jl->componentLoad("/item");
?>

<?php
include_once("./app_tail.php");
?>