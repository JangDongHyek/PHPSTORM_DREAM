<?php
$pid = "bus_view";
include_once("./app_head.php");

?>
    <div id="rental" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_bus'"><i class="fa-solid fa-arrow-left"></i> 버스 대관 목록</button>
        <div class="box_radius box_white table">
            <h6>전민웅 집사</h6>
            <p>연락처 | 010-0000-0000</p>
            <hr>
            <p><b class="icon icon_gray">신청부서</b> - </p>
            <p><b class="icon icon_gray">행사명</b> - </p>
            <p><b class="icon icon_gray">탑승인원</b> - </p>
            <p><b class="icon icon_gray">신청차량</b> - </p>
            <p><b class="icon icon_gray">날짜</b> 24.09.01 </p>
            <p><b class="icon icon_gray">도착행선지</b> - </p>
            <p><b class="icon icon_gray">교회출발시간</b> 11시 20분 </p>
            <p><b class="icon icon_gray">출발행선지</b> - </p>
            <p><b class="icon icon_gray">현지출발시간</b> 11시 20분 </p>
            <p><b class="icon icon_gray">당일외출발</b> 09월 01일 11시 20분  </p>
            <p>-</p>
            <button class="btn btn_large btn_gray2" type="button">예약 취소</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>