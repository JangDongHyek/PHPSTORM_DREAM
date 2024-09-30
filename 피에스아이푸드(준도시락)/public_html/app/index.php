<?php
$pid = "index";
include_once("./app_head.php");

// 팝업레이어 추가
include G5_BBS_PATH.'/newwin.inc.php';
?>

<div id="idx_container">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeInUp animated">
        <ul class="sliderbx">
            <li class="mv01"><!--<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual01.jpg" alt="" /></div>--></li>
            <li class="mv02"><!--<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual02.jpg" alt="" /></div>--></li>
        </ul>
        <!--.sliderbx-->
        <div class="area_txt">
            <p class="wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">소중한 한끼를<br />즐거움과 휴식으로 채워드리는</p>
            <h3 class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.8s">준도시락</h3>
            <a class="wow fadeInUp animated" data-wow-delay="1.2s" data-wow-duration="0.8s" href="<?php echo G5_URL ?>/app/guide.php"><span>도시락<br />주문하기</span></a>
        </div>
    </div><!-- //visual -->
</div>
<?php
include_once ("./app_tail.php");
?>
