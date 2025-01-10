<?php
$pid = "equip_view";
include_once("./app_head.php");

?>
    <div id="rental" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_equip'"><i class="fa-solid fa-arrow-left"></i> 비품 대여 목록</button>
        <div class="box_radius box_white table">
            <h6>전민웅 집사</h6>
            <p>연락처 | 010-0000-0000</p>
            <hr>
            <p><b class="icon icon_gray">신청부서</b> - </p>
            <p><b class="icon icon_gray">행사명</b> - </p>
            <p><b class="icon icon_gray">행사장소</b> - </p>
            <p><b class="icon icon_gray">행사날짜</b> 24.09.01 </p>
            <p><b class="icon icon_gray">신청자재</b> - </p>
            <p><b class="icon icon_gray">수령인</b> - </p>
            <p><b class="icon icon_gray">수령일시</b> 09월 01일 11시 20분</p>
            <p><b class="icon icon_gray">반납인</b> - </p>
            <p><b class="icon icon_gray">반납일시</b> 09월 01일 11시 20분</p>
            <button class="btn btn_large btn_gray2" type="button">예약 취소</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>