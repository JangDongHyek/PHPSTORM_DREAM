<?php
$pid = "rental_equip";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">

    <div id="rental">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental'"><i class="fa-solid fa-arrow-left"></i> 대관 신청 메인</button>
        <div class="slogan">
            <h6>영상장비 / 음향장비 / 야외행사 비품</h6>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./equip_form'">신청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-regular fa-business-time"></i> 교회비품 예약현황</h6>

            <rental-equip-list admin="<?=$is_admin?>"></rental-equip-list>

        </div>
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