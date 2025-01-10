<?php
$pid = "index";
include_once("./app_head.php");

?>
<div id="index">
    <div class="slogan">
        <h5>2024 <i class="fa-solid fa-megaphone"></i><br>IMC 표어</h5>
        <h5>성령에 순종하여 · 모여서 예배하고<br>모여서 떡을떼고 · 모여서 선교하자</h5>
    </div>
    <div class="flex gap10">
        <div class="week">
            <span>금주의 설교</span>
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/hKXUcgMeRpY?controls=0" frameborder="0" allowfullscreen="" allow="accelerometer;
    autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
        </div>
        <div class="btn_wrap">
            <button class="btn" type="button"><i class="fa-brands fa-youtube"></i> 다른설교<span class="hidden-xs">보기</span></button>
            <button class="btn" type="button" onclick="location.href='./prayer'"><i class="fa-duotone fa-hands-praying"></i> 도고기도</button>
            <button class="btn" type="button" onclick="location.href='./note'"><i class="fa-duotone fa-notebook"></i> 결단노트</button>
        </div>
    </div>
    <div class="grid grid3 v1 gap10">
        <button class="btn" type="button"><img src="<?php echo G5_URL ?>/app/img/icon1.png" alt="임마누엘 교회"> 예배 생방송</button>
        <button class="btn" type="button" onclick="location.href='./class'"><img src="<?php echo G5_URL ?>/app/img/icon2.png" alt="임마누엘 교회"> 속회방</button>
        <button class="btn" type="button" onclick="location.href='./union'"><img src="<?php echo G5_URL ?>/app/img/icon3.png" alt="임마누엘 교회"> 공동체</button>
        <button class="btn" type="button"><img src="<?php echo G5_URL ?>/app/img/icon4.png" alt="임마누엘 교회"> 성경읽기</button>
        <button class="btn" type="button"><img src="<?php echo G5_URL ?>/app/img/icon5.png" alt="임마누엘 교회"> 묵상QT</button>
        <button class="btn" type="button"><img src="<?php echo G5_URL ?>/app/img/icon6.png" alt="임마누엘 교회"> 성경필사</button>
    </div>
    <div class="grid grid3 v2 gap10">
        <button class="btn" type="button"><i class="fa-duotone fa-circle-p"></i> 나의 포인트</button>
        <button class="btn" type="button"><i class="fa-duotone fa-solid fa-hand-holding-heart"></i> 온라인 헌금</button>
        <button class="btn" type="button"><i class="fa-duotone fa-solid fa-tv"></i> 홈페이지</button>
    </div>
</div>

<?php
include_once("./app_tail.php");
?>