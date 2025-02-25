<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
include_once(G5_THEME_PATH.'/head.php');
?>
<style>
#gnb_1dul > li.gnb_1dli:nth-child(5) a.gnb_1da{ color:#DC000C !important;   transition:all 1s  !important;}
#gnb_1dul > li.gnb_1dli:nth-child(5) span{ display:block !important;  transition:all 1s  !important; width:100% !important}
.imgArea{ top:160px !important}
.imgArea iframe{width: 100vw;
    height: 130vh;
    min-height: 100vh;
    min-width: 177.77vh;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%) scale(1.2);
    z-index: -2;
    display: block;
	top:100px;
    display: none;;
	}
</style>
<section id="visual">
    <div class="swiper swiperVisual">
        <div class="swiper-wrapper">
            <!--<div class="swiper-slide v1">
                <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>정직하고 확실하게</p>
                            <p>배달로 길을 이어주는</p>
                            <p>푸드<span class="txtRed">라</span>인</p>
                        </h3>
                        <a class="btnArrow">바로 문의하기</a>
                    </div>
                    <div class="imgMark">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/visual_mark.svg">
                    </div>
                </div>
            </div>-->
            <div class="swiper-slide recruit_v1">
            <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>푸드라인이</p>
                            <p>원하는</p>
                            <p><span class="txtRed">인재상</span>이란?</p>
                        </h3>
                        <a class="btnArrow">푸드라인에 합류하기</a>
                    </div>
                    <div class="imgMark">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/visual_mark.svg">
                    </div>
            </div>
            <div class="imgArea">
                <iframe src="https://player.vimeo.com/video/893091940?h=2e3d197aa2?muted=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;autopause=0&amp;background=1" width="100%" height="350" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
            </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!--<div class="swiper-pagination"></div>-->
    </div>

    <!-- Initialize Swiper -->


</section>

<div id="idx_wrapper">
    <section class="idx_service" class="wow fadeInDownBig" data-wow-delay="0.3s">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE RECRUIT</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s">푸드라인은 <span class="txtRed">이런 분들과 </span>함께 하고 싶습니다.</p>
                <p class="wow fadeInUp" data-wow-delay="0.5s">차별화된 푸드라인 패밀리 정신 입니다.</p>
            </h3>
        </div>
        <div class="contsArea">
            <div class="mbanner_list">
                                        <ul>
                                            <li class="wow fadeInDown" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInDown;">
                                                 <div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/recruit_img01.jpg" class="imgWidth" alt=""></div>
                                                 <p class="tit text-center t_margin20">PARTNERSHIP</p>
                                                 <p class="cont text-center">다양한 프랜차이즈와 법인 기업과의 제휴로 라이더분들의 안정적인 수입 확보가 가능합니다. </p>
                                            </li>
                                            <li class="wow fadeInDown" data-wow-delay="1s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInDown;">
                                                 <div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/recruit_img02.jpg" class="imgWidth" alt=""></div>
                                                 <p class="tit text-center t_margin20">POSSIBLE</p>
                                                 <p class="cont text-center">오토바이 리스, 렌탈등의 바이크 지원을 받지 않으셔도 푸드라인 라이더 활동이 가능합니다.</p>
                                            </li>
                                            <li class="wow fadeInDown" data-wow-delay="1.3s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInDown;">
                                                 <div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/recruit_img01.jpg" class="imgWidth" alt=""></div>
                                                 <p class="tit text-center t_margin20">PARTNERSHIP</p>
                                                 <p class="cont text-center">다양한 프랜차이즈와 법인 기업과의 제휴로 라이더분들의 안정적인 수입 확보가 가능합니다. </p>
                                            </li>
                                            <li class="wow fadeInDown" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInDown;">
                                                 <div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/recruit_img02.jpg" class="imgWidth" alt=""></div>
                                                 <p class="tit text-center t_margin20">POSSIBLE</p>
                                                 <p class="cont text-center">오토바이 리스, 렌탈등의 바이크 지원을 받지 않으셔도 푸드라인 라이더 활동이 가능합니다.</p>
                                            </li>
                                        </ul>
              </div>
        </div>
        <div class="line">
            <div class="wow fadeInDownBig" animation-duration="1s" data-wow-delay="0s"></div>
            <div class="wow fadeInRightBig" animation-duration="1s" data-wow-delay="0.5s"></div>
        </div>
    </section>

    <section class="idx_review" style="background:#f8f8f8">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE FAQ</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인이 궁금하세요?</h3>
            <div class="cus"><i class="fa-solid fa-user-headset"></i> 채용관련 문의전화 <strong>1588-1971</strong></div>
        </div>
        
        <!-- FAQ -->
        <div class="shipFaq">
            <dl>
                <dt class=""><a href="">
                    <span class="tit">Q. 면접 복장(or 출근 복장)은 어떻게 되나요?</span>
                    </a> 
                </dt>
                <dd style="display: none;">
                    <span class="sub_tit">
                        면접 혹은 출근 시에는 비즈니스 캐주얼을 권장 드립니다. <br />정장을 입고 면접을 참석한다거나 출근하지 않습니다.
                    </span>
                </dd>
                
                <dt><a href="">
                    <span class="tit">Q. 면접 프로세스는 어떻게 진행되나요?</span>
                    </a> 
                </dt>
                <dd style="">
                    <span class="sub_tit">
                        지원하시는 직무별로 상이하게 적용됩니다. 채용파트 1500-0000으로 문의해주세요.
                    </span>
                </dd>                
                <dt class=""><a href="">
                    <span class="tit">Q. 면접 복장(or 출근 복장)은 어떻게 되나요?</span>
                    </a> 
                </dt>
                <dd style="display: none;">
                    <span class="sub_tit">
                        면접 혹은 출근 시에는 비즈니스 캐주얼을 권장 드립니다. <br />정장을 입고 면접을 참석한다거나 출근하지 않습니다.
                    </span>
                </dd>
                
                <dt><a href="">
                    <span class="tit">Q. 면접 프로세스는 어떻게 진행되나요?</span>
                    </a> 
                </dt>
                <dd style="">
                    <span class="sub_tit">
                        지원하시는 직무별로 상이하게 적용됩니다. 채용파트 1500-0000으로 문의해주세요.
                    </span>
                </dd> 
            </dl>
        </div>
        

        <div class="text-center wow fadeInDown" data-wow-delay="0.6s">
            <a class="btnRed">채용 관련 문의하기 <i class="fa-light fa-plus"></i></a>
        </div>
    </section>
    <section class="idx_overview wow fadeInDown" data-wow-delay="0.3s">
        <div class="inr">
            <div class="text">
                <div class="line wow fadeInLeft" data-wow-delay="0.4s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/foodline.png">
                </div>
                <h4>
                    <p class="wow fadeInLeft" data-wow-delay="0.5s">언제나, 어디서나 푸드라인이</p>
                    <p class="txtRed wow fadeInRight" data-wow-delay="0.6s">배달로 길을 이어드립니다.</p>
                </h4>
                <div class="conts wow fadeInLeft" data-wow-delay="0.7s">
                    편리하고 효율적인 시스템과 전문적인 컨설팅을 통해 <br>
                    최상의 서비스를 약속드립니다. <br>
                    라이더와 가맹점 모두가 상생하는 미래, 푸드라인이 만듭니다.
                </div>
            </div>
        </div>
    </section>
</div>
    <script>
        // Initialize Swiper when the DOM is ready
        document.addEventListener('DOMContentLoaded', function () {
            //메인
            var mySwiper = new Swiper('.swiperVisual', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 6000, // milliseconds
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            //서비스
            var swiper = new Swiper(".swiperService", {
                scrollbar: {
                    el: ".swiper-scrollbar",
                    hide: false,
                },
                mousewheel: {
                    enabled: true,
                },
            });

            //리뷰
            var swiper = new Swiper(".swiperReview", {
                slidesPerView: 1,
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                loop: true, // Enable looping
                autoplay: {
                    delay: 3000, // Set the delay in milliseconds
                    disableOnInteraction: false, // Allow manual navigation while autoplay is active
                },
                breakpoints: {
                    // When window width is <= 768px, set slidesPerView to 1
                    1200: {
                        slidesPerView: 3,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                },
            });
        });
		//FAQ 답변 열고닫기
		$('.shipFaq dt').click(function(){
			if($('+dd',this).is(':hidden')){
				$('.shipFaq dt').removeClass('on').next().slideUp('fast');
				$(this).toggleClass('on').next().slideDown('fast');
			} else {
				$(this).toggleClass('on').next().slideUp('fast');
			}
			return false;
		});
    </script>

<?php
include_once(G5_PATH.'/tail.php');
?>