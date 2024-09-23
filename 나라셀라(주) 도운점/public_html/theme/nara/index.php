<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper">
	<!--메인슬라이더 시작-->
	<div id="visual" class="wow fadeInUp animated">
		<div class="area_txt">
			
				<h1 class="animate__animated animate__fadeIn animate__delay-0s">
				도운 <span>萄韻,</span><br>취향에 온전히 <br>집중할 수 있는 공간
				</h1>
			<h3 class="animate__animated animate__fadeIn animate__delay-1s">
				각자 개인의 취향에 집중하면서도<br>
그것에서 피어난 이야기들을 다른 이들과<br>
공유 할 수 있는 사교적 공간을 제공합니다.
			</h3>
		</div>
		<ul class="sliderbx">
			<li class="mv01"></li>
			<li class="mv02"></li>
			<li class="mv03"></li>
			<li class="mv04"></li>
			<li class="mv05"></li>
			<li class="mv06"></li>
		</ul>
		<!--.sliderbx-->
		
		<div class="scrolldown">
			<a href="#about">
				<i class="icon"></i>
				<i class="txt">SCROLL</i>
			</a>
		</div>
	</div><!-- //visual -->
	
</div><!--  #idx_wrapper -->
 <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />


<div id="content" class="">
	<div class="dowoon_sec">
		
		<div class="inr openNav">
			<div class="dw1">
				<h3>DOWOON CLASS</h3>
				<h4>도운 클래스</h4>
				  <div class="swiper mySwiper">
					<div class="swiper-wrapper">
                          <div class="swiper-slide">
                              <div class="txt">
                                  <h5>매달 메이커와 만나는 와인 세미나와<br>
                                        다양한 원데이클래스가 진행됩니다. </h5>
                                  <p>*기업 맞춤형 특강 문의</p>
                              </div>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/dc1.jpg">
                          </div>
                          <div class="swiper-slide">
                              <div class="txt">
                                  <h5>매달 메이커와 만나는 와인 세미나와<br>
                                        다양한 원데이클래스가 진행됩니다. </h5>
                                  <!--h6></h6-->
                                  <p>*기업 맞춤형 특강 문의</p>
                              </div>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/dc2.jpg">
                          </div>
                          <div class="swiper-slide">
                              <div class="txt">
                                  <h5>매달 메이커와 만나는 와인 세미나와<br>
                                        다양한 원데이클래스가 진행됩니다. </h5>
                                  <p>*기업 맞춤형 특강 문의</p>
                              </div>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/dc3.jpg">
                          </div>
                          <div class="swiper-slide">
                              <div class="txt">
                                  <h5>매달 메이커와 만나는 와인 세미나와<br>
                                        다양한 원데이클래스가 진행됩니다. </h5>
                                  <p>*기업 맞춤형 특강 문의</p>
                              </div>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/dc4.jpg">
                          </div>
                          <div class="swiper-slide">
                              <div class="txt">
                                  <h5>매달 메이커와 만나는 와인 세미나와<br>
                                        다양한 원데이클래스가 진행됩니다. </h5>
                                  <!--h6></h6-->
                                  <p>*기업 맞춤형 특강 문의</p>
                              </div>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/dc5.jpg">
                          </div>
                          <div class="swiper-slide">
                              <div class="txt">
                                  <h5>매달 메이커와 만나는 와인 세미나와<br>
                                        다양한 원데이클래스가 진행됩니다. </h5>
                                  <p>*기업 맞춤형 특강 문의</p>
                              </div>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/dc6.jpg">
                          </div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				  </div>

				  <!-- Swiper JS -->
				  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

				  <!-- Initialize Swiper -->
				  <script>
					var swiper = new Swiper(".mySwiper", {
					  navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					  }, 
						autoplay : {  
						  delay : 3000,  
						  disableOnInteraction : false,  
						},
					});
				  </script>
				<div class="btn-wrap">
					<button type="button" class="buttonbg2" onclick="location.href='<?php echo G5_URL ?>/event2.php'">클래스 신청</button>
				
				</div>
			</div>
			<div class="dw2">
				<h3>DOWOON HALL</h3>
				<h4>도운 홀</h4>
				  <div class="swiper mySwiper2">
					<div class="swiper-wrapper">
					  <div class="swiper-slide">
						  <div class="txt">
							  <h5>도운 홀은</h5>
							  <p>
                                  와인 교육부터 와이너리 행사까지 <br>
                                  다양한 공간대여 · 행사가 가능한 Open Space 입니다.
                              </p>
						  </div>
						<img src="<?php echo G5_THEME_IMG_URL ?>/main/dh1.jpg">
					  </div>
					  <div class="swiper-slide">
						  <div class="txt">
							  <h5>도운 홀은</h5>
                              <p>
                                  와인 교육부터 와이너리 행사까지 <br>
                                  다양한 공간대여 · 행사가 가능한 Open Space 입니다.
                              </p>
						  </div>
						<img src="<?php echo G5_THEME_IMG_URL ?>/main/dh2.jpg">
					  </div>
					  <div class="swiper-slide">
						  <div class="txt">
							  <h5>도운 홀은</h5>
                              <p>
                                  와인 교육부터 와이너리 행사까지 <br>
                                  다양한 공간대여 · 행사가 가능한 Open Space 입니다.
                              </p>
						  </div>
						<img src="<?php echo G5_THEME_IMG_URL ?>/main/dh3.jpg">
					  </div>
					</div>
					<div class="swiper-button-next2"></div>
					<div class="swiper-button-prev2"></div>
				  </div>
				
				  <!-- Initialize Swiper -->
				  <script>
					var swiper = new Swiper(".mySwiper2", {
					  navigation: {
						nextEl: ".swiper-button-next2",
						prevEl: ".swiper-button-prev2",
					  },
						autoplay : {  
						  delay : 3000,  
						  disableOnInteraction : false,  
						},
					});
				  </script>
				<div class="btn-wrap">
					<button type="button" class="buttonbg1" onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=floor2'">대관 소개</button>
					<button type="button" class="buttonbg2" onclick="location.href='<?php echo G5_URL ?>/event2.php'">클래스 신청</button>
				
				</div>
			</div>
			<div class="dw3">
				<h3>DOWOON SPACE</h3>
				<h4>도운 스페이스</h4>
				
				  <div class="swiper mySwiper3">
					<div class="swiper-wrapper">
					  <div class="swiper-slide">
						  <div class="txt">
							<h5>도운 스페이스는</h5>
							  <p>
                                  엄선된 와인 교육과 식사를 제공하며<br>
                                  키친을 활용한 대여·행사가 가능한 Private Space 입니다.
                              </p>
						  </div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/ds1.jpg">
					  </div>
					  <div class="swiper-slide">
						  <div class="txt">
                              <h5>도운 스페이스는</h5>
                              <p>
                                  엄선된 와인 교육과 식사를 제공하며<br>
                                  키친을 활용한 대여·행사가 가능한 Private Space 입니다.
                              </p>
						  </div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/ds2.jpg">
					  </div>
					  <div class="swiper-slide">
						  <div class="txt">
                              <h5>도운 스페이스는</h5>
                              <p>
                                  엄선된 와인 교육과 식사를 제공하며<br>
                                  키친을 활용한 대여·행사가 가능한 Private Space 입니다.
                              </p>
						  </div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/ds3.jpg">
					  </div>
					  <div class="swiper-slide">
						  <div class="txt">
							<h5>도운 스페이스는</h5>
							  <p>
                                  엄선된 와인 교육과 식사를 제공하며<br>
                                  키친을 활용한 대여·행사가 가능한 Private Space 입니다.
                              </p>
						  </div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/ds4.jpg">
					  </div>
					  <div class="swiper-slide">
						  <div class="txt">
                              <h5>도운 스페이스는</h5>
                              <p>
                                  엄선된 와인 교육과 식사를 제공하며<br>
                                  키친을 활용한 대여·행사가 가능한 Private Space 입니다.
                              </p>
						  </div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/ds5.jpg">
					  </div>
					  <div class="swiper-slide">
						  <div class="txt">
                              <h5>도운 스페이스는</h5>
                              <p>
                                  엄선된 와인 교육과 식사를 제공하며<br>
                                  키친을 활용한 대여·행사가 가능한 Private Space 입니다.
                              </p>
						  </div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/ds6.jpg">
					  </div>
					</div>
					<div class="swiper-button-next2"></div>
					<div class="swiper-button-prev2"></div>
				  </div>
				  <!-- Initialize Swiper -->
				  <script>
					var swiper = new Swiper(".mySwiper3", {
					  navigation: {
						nextEl: ".swiper-button-next2",
						prevEl: ".swiper-button-prev2",
					  },
						autoplay : {  
						  delay : 3000,  
						  disableOnInteraction : false,  
						},
					});
				  </script>
				<div class="btn-wrap">
					<button type="button" class="buttonbg1" onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=floor6'">대관 소개</button>
					<button type="button" class="buttonbg2" onclick="location.href='<?php echo G5_URL ?>/event6.php'">클래스 신청</button>
				
				</div>
			</div>
		</div>
	</div>

	<div class="notice_sec">
		<div class="inr openNav">
			<?php echo latest("theme/gallery", "notice", 4, 60); ?>
		</div>
	</div>


</div>



<?php
include_once(G5_PATH.'/tail.php');
?>
