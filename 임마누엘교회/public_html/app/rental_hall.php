<?php
$pid = "rental_hall";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="rental">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental'"><i class="fa-solid fa-arrow-left"></i> 대관 신청 메인</button>
        <div class="slogan">
            <h6>예루살렘성전 / 베들레헴성전 / IMC 카페 및 ROOM / 찬양대실
                식당 ROOM / 유치부실 / 영아부실 / 학생찬양대실 / 지하체육관</h6>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./hall_form'">신청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-regular fa-tombstone"></i> 본당 예약현황</h6>

        <rental-hall-list></rental-hall-list>

        </div>
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