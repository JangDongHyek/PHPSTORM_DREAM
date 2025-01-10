<?php
$pid = "hall_view";
include_once("./app_head.php");

?>
    <div id="rental" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_lecture'"><i class="fa-solid fa-arrow-left"></i> 교육관 대관 목록</button>
        <div class="box_radius box_white table">
            <h6>전민웅 집사</h6>
            <p>연락처 | 010-0000-0000</p>
            <hr>
            <p><b class="icon icon_gray">장소/시간 </b> <br><i class="fa-solid fa-booth-curtain txt_blue"></i> 2층 (식당 ROOM6) <br><i class="fa-solid fa-clock txt_blue"></i> 10~11, 11~12시 </p>
            <p><b class="icon icon_gray">사용날짜</b> 24.09.01 </p>
            <p><b class="icon icon_gray">신청부서</b> - </p>
            <p><b class="icon icon_gray">사용목적</b> -</p>
            <p><b class="icon icon_gray">음식섭취</b> 유</p>
            <p><b class="icon icon_gray">특이사항</b></p>
            <p>-</p>
            <button class="btn btn_large btn_gray2" type="button">예약 취소</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>