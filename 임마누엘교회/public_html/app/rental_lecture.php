<?php
$pid = "rental_lecture";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="rental">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental'"><i class="fa-solid fa-arrow-left"></i> 대관 신청 메인</button>
        <div class="slogan">
            <h6>15층 IMC 라운지 / 13층 단체숙소 / 드림 1,2부실 / 에벤에셀홀</h6>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./lecture_form'">신청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-solid fa-presentation-screen"></i> 교육관 예약현황</h6>

            <rental-lecture-list admin="<?=$is_admin?>"></rental-lecture-list>
        </div>
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