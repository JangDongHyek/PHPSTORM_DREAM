<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 앱 메인 페이지 이동
header("location: ".APP_URL);

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>


<?php /*?><div id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeInUp animated">
        <ul class="sliderbx">
            <li class="mv01"><div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual01.jpg" alt="" /></div></li>
            <li class="mv02"><div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual02.jpg" alt="" /></div></li>
        </ul>
        <!--.sliderbx-->
        <div class="area_txt">
            <p class="wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">소중한 한끼를<br />즐거움과 휴식으로 채워드리는</p>
            <h3 class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.8s">준도시락</h3>
            <a href=""><span>도시락<br />주문하기</span></a>
        </div>
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->
<!--<div class="fixed_bg"></div>--><?php */?>



<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>