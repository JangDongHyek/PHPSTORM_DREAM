<?php
include_once("./_common.php");
include_once(G5_THEME_PATH.'./head.sub.php');

include_once('./_head.php');

?>
<style>

</style>


<div id="idx_main">
	<div class="idx_box01 idx_box"><a href="<?php echo G5_BBS_URL ?>/lesson_reser.php">
    	<div class="btit">JOY&amp;GOLF KOREA</div>
        <p>전국 최고의 프로들이 함께하는 JNGK와 골프 마스터가 되어보세요.</p>	
    	<div class="b_btn">예약하기 <i class="fas fa-angle-right"></i></div></a>
    </div><!--.idx_box01-->
	<div class="idx_box02 idx_box"><a href="<?php echo G5_BBS_URL ?>/lesson_list.php">
    	<div class="btit">RESERVATION</div>
        <p>원하는 날짜 원하는 시간에 레슨을 예약할 수 있어요.</p>	
    	<div href="<?php echo G5_BBS_URL ?>/lesson_list.php" class="b_btn">레슨정보 <i class="fas fa-angle-right"></i></div></a>
    </div><!--.idx_box02-->
	<div class="idx_box03 idx_box"><a onclick="alert('준비 중입니다');return false;">
    	<div class="btit"><strong>FAMILY</strong> Site</div>
        <p>전국의 다양한 JNGK의 아카데미와<br />센터, 프로들을 만나보세요!</p>	
    	<div class="b_btn">바로가기 <i class="fas fa-angle-right"></i></div></a>
    </div><!--.idx_box03-->
	<div class="idx_box04 idx_box"><a onclick="alert('준비 중입니다');return false;">
    	<div class="btit">CUSTOMER CENTER</div>
        <p>레슨예약 및 문의사항이 있으신가요? 전화상담으로 안내해드립니다.</p>	
    	<div class="b_btn">전화상담 <i class="fas fa-angle-right"></i></div></a>
    </div><!--.idx_box04-->
	<div class="idx_box05 idx_box"><a href="<?php echo G5_BBS_URL ?>/lesson_confirm.php">
    	<div class="btit">My LESSON</div>
        <p>현재 나의 레슨정보와 상태를 쉽게 알아볼 수 있습니다.</p>	
    	<div class="b_btn">레슨예약 확인 <i class="fas fa-angle-right"></i></div></a>
    </div><!--.idx_box05-->

</div><!--#idx_main-->

<div id="idx_roll">
  <!-- Swiper -->
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/1.jpg" /></div>
      <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/2.jpg" /></div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div><!--#idx_roll-->

<!--이미지롤링-->
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>

<div id="copy">
	COPYRIGHT(C) JNGK. ALL RIGHTS RESERVED.
</div>



<?php
include_once('./_tail.php');
?>