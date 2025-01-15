<?php
$pid = "index";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");

$site_model = new JlModel("site_setting");
$site_setting = $site_model->orderBy("idx","DESC")->get()['data'][0];

?>
<div id="index">
    <div class="slogan">
        <h5>창립 50주년<br>2025 IMC 표어</h5>
        <h5><?=nl2br($site_setting['imc'])?></h5>
    </div>
    <div class="flex gap10">
        <div class="week">
            <span>금주의 설교</span>
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/<?=$jl->extractYoutube($site_setting['main_youtube'])?>?controls=0" frameborder="0" allowfullscreen="" allow="accelerometer;
    autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
        </div>
        <div class="btn_wrap">
            <button class="btn" type="button"onclick="location.href='./video'"><i class="fa-brands fa-youtube"></i> 설교영상</button>
            <button class="btn blue" type="button" onclick="location.href='./prayer'"><i class="fa-duotone fa-hands-praying"></i> 기도요청</button>
            <button class="btn" type="button" onclick="location.href='./note'"><i class="fa-duotone fa-notebook"></i> 결단노트</button>
        </div>
    </div>
    <div class="grid grid3 v1 gap10">
        <button class="btn" type="button" onclick="window.open('https://www.youtube.com/channel/UC8XsX2FEj61FL20MlTDjV8g/featured')"><img src="<?php echo G5_URL ?>/app/img/icon1.png" alt="임마누엘 교회"> 예배 생방송</button>
        <button class="btn" type="button" onclick="location.href='./class'"><img src="<?php echo G5_URL ?>/app/img/icon2.png" alt="임마누엘 교회"> 속회방</button>
        <button class="btn" type="button" onclick="location.href='./union'"><img src="<?php echo G5_URL ?>/app/img/icon3.png" alt="임마누엘 교회"> 공동체</button>
        <button class="btn" type="button" onclick="window.open('https://www.bskorea.or.kr/bible/korbibReadpage.php')"><img src="<?php echo G5_URL ?>/app/img/icon4.png" alt="임마누엘 교회"> 성경읽기</button>
        <button class="btn" type="button" onclick="window.open('https://www.bskorea.or.kr/prog/read3_1.php')"><img src="<?php echo G5_URL ?>/app/img/icon5.png" alt="임마누엘 교회"> 묵상QT</button>
        <button class="btn" type="button" onclick="window.open('http://origin.imc.or.kr/wp-login.php')"><img src="<?php echo G5_URL ?>/app/img/icon6.png" alt="임마누엘 교회"> 성경필사</button>
    </div>
    <div class="grid grid3 v2 gap10">
        <button class="btn" type="button"><i class="fa-duotone fa-circle-p"></i> 나의 포인트</button>
        <button class="btn" type="button" onclick="location.href='../bbs/content.php?co_id=sub01_08'"><i class="fa-duotone fa-solid fa-hand-holding-heart"></i> 온라인 헌금</button>
        <button class="btn" type="button" onclick="window.open('<?php echo G5_URL ?>')"><i class="fa-duotone fa-solid fa-tv"></i> 홈페이지</button>
    </div>
</div>

<?php
include_once("./app_tail.php");
?>