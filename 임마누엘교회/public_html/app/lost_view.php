<?php
$pid = "lost_view";
include_once("./app_head.php");

?>
    <div id="rental" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./lost'"><i class="fa-solid fa-arrow-left"></i> 분실 목록</button>
        <div class="box_radius box_white table">
            <h6>전민웅</h6>
            <p>연락처 | 010-0000-0000</p>
            <hr>
            <p><b class="icon icon_gray">장소/시간 </b> <br><i class="fa-solid fa-booth-curtain txt_blue"></i> 24.01.01 <br><i class="fa-solid fa-clock txt_blue"></i> 11:00 </p>
            <p><b class="icon icon_gray">품목</b> - </p>
            <p><b class="icon icon_gray">특징</b> - </p>
            <p><b class="icon icon_gray">보관장소</b> - </p>

            <img src="<?php echo G5_THEME_IMG_URL ?>/common/noimg.png" alt="">
            <img src="<?php echo G5_THEME_IMG_URL ?>/common/noimg.png" alt="">
            <img src="<?php echo G5_THEME_IMG_URL ?>/common/noimg.png" alt="">

            <button class="btn btn_large btn_blue" type="button">찾았어요</button>
            <button class="btn w100 btn_line" type="button">수정하기</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>