<?php
$pid = "rental";
include_once("./app_head.php");

?>
    <div id="rental" class="main">
        <div class="grid grid2">
            <button class="btn" type="button" onclick="location.href='./rental_hall'"><i class="fa-regular fa-tombstone"></i> 본당</button>
            <button class="btn" type="button" onclick="location.href='./rental_lecture'"><i class="fa-solid fa-presentation-screen"></i> 교육관</button>
            <button class="btn" type="button" onclick="location.href='./rental_bus'"><i class="fa-solid fa-bus"></i> 버스</button>
            <button class="btn" type="button" onclick="location.href='./rental_equip'"><i class="fa-regular fa-business-time"></i> 교회비품</button>
        </div>
        <div class="guide">
            <h3 class="txt_red">• 대관신청시 유의사항</h3>
            <p>-예약취소 상황 시 반드시 취소신청을 해주시기 바랍니다.<br>
                -다음 예약을 위해 사용시간을 엄수해주시기 바랍니다.<br>
                -예약에 관한 추가문의는 2층 사무실로 문의해주세요.
            </p>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>