<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');

// 23.05.08 래벨2인 회원들 카드등록후 사용가능하게 wc
if($member['mb_id'] != "test01"){
	if ($member['mb_level'] == 2 && !$member['billKey']){
		alert("카드등록을 완료해야 이용가능합니다.", G5_HTTP_BBS_URL.'/card_info_form.php','error');
	}
}


?>
<style>
	#add_footer {
	    text-align: center;
    padding: 20px 0;
    background: #FFF;}
	#add_footer p{padding-bottom:5px}

    #mb_service .clean.car .bx{
        display:flex;
        justify-content:center;
    }
    #mb_service .clean.car .bx .mg{
        width:70%;
        height: auto;
    }
</style>

	<div id="mb_main">
        <!--메인슬라이더 시작-->
        <div id="visual">
              <!-- Swiper -->
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/mvisual01.jpg" /></div>
                  <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/mvisual02.jpg" /></div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
        </div><!--visual-->
          <!-- Initialize Swiper -->
          <script>
            var swiper = new Swiper('.swiper-container', {
              spaceBetween: 0,
              centeredSlides: true,
              autoplay: {
                delay: 5000,
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
          
          <div id="mb_service">
			 <div class="clean car">
                 <h2 class="title cf"><span>국내 1등</span><strong>출장세차 서비스</strong></h2>
                 <h3>언제 어디서나 세차를 쉽고 빠르게!</h3>
                 <!--<div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=3"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate03.png"></div><div class="tx">단기세차<span>1회</span></div></a></div>-->
                 <div class="bx cf">
                 	<div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=3"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate03.png"></div><div class="tx">단기 세차<span>1회성</span></div></a></div>
                     <div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=5"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate07.png"></div><div class="tx">실내 세차<span>1회성</span></div></a></div>
                    <div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=4"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate02.png"></div><div class="tx">기업 세차</div></a></div>
                 </div>
                 <div class="bx cf">
                 	<div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=1"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate01.png"></div><div class="tx">한달만서비스 받아보기<!-- 정기 세차<span>월4회</span> --></div></a></div>
                    <div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=2"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate02.png"></div><div class="tx">정기 세차<span>매월관리</span></div></a></div>
                 </div>
                 <!--<div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=3"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate03.png"></div><div class="tx">기업세차<span>월/4회</span></div></a></div>-->
                 <div class="bx cf">
                     <div class="tx" style="margin:0"><i class="fas fa-car-wash"></i> 작업진행 프로세스 안내</div> 
                 </div>
             </div><!--clean-->
             
			 <div class="clean home">
                 <h2 class="title cf"><span>국내 1등</span><strong>청소 서비스</strong></h2>
                 <h3>출장세차에 이어 클리닝 서비스까지 한번에!</h3>
                 <div class="bx cf">
                 	<div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_clean_part.php?ct=1"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate04.png"></div><div class="tx">입주청소</div></a></div>
                    <div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_clean_part.php?ct=2"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate05.png"></div><div class="tx">이사청소</div></a></div>
                 </div>
             </div><!--clean-->
             
          </div><!--mb_service-->          
          
		  <!-- 임시하단 추가 220510 -->
			<div id="add_footer">
				<p><b>출세왕</b></p>
				<p>대표자 : 김홍규</p>
				<p>부산광역시 강서구 영강길 31, 2층(명지동)</p>
				<p>사업자 등록번호 : 174-67-00420</p>
				<p>대표번호 : 010-6610-3103</p>
				<p>대표이메일 : gimhonggyu88@hanmail.net</p>
				<p>팩스 : 000-0000</p>
				<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">이용약관</a><span class="line"></span><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a></p>
			</div>

    </div><!--#mb_main-->
    
    
    
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>