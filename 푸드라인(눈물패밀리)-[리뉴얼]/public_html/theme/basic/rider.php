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
#gnb_1dul > li.gnb_1dli:nth-child(2) a.gnb_1da{ color:#DC000C !important;   transition:all 1s  !important;}
#gnb_1dul > li.gnb_1dli:nth-child(2) span{ display:block !important;  transition:all 1s  !important; width:100% !important}
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
            <div class="swiper-slide rider_v1">
            <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>보다 안정적인 라이더 수입 보장!</p>
                            <p>푸드<span class="txtRed">라</span>인</p>
                        </h3>
                        <a class="btnArrow" href="<?php echo G5_URL ?>/rider_form.php">라이더 지원하기</a>
                    </div>
                    <!--<div class="imgMark">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/visual_mark.svg">
                    </div>-->
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
    <section class="area_leader">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE leadership</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인이 원하는 리더쉽이란?</p>
            </h3>
        </div>
        <div class="contsArea">
            <div class="swiper swiperLeader">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea wow fadeInDown" data-wow-delay="0.3s">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_leader01.jpg">
                                </div>
                                <div class="txtArea wow fadeInDown" data-wow-delay="0.4s">
                                    <h4>고객 서비스 의식</h4>
                                    <h5>Customer Service Awareness</h5>
                                    <p>라이더 인재 리더쉽은 항상 고객 서비스 의식을 갖고 있어야 합니다. 이는 친절한 태도, 정확한 배송 및 시간 준수 등을 통해 고객 만족도를 높이는 데 기여합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_leader02.jpg">
                                </div>
                                <div class="txtArea">
                                    <h4>효율적인 배송 관리</h4>
                                    <h5>Efficient Delivery Management</h5>
                                    <p>리더쉽은 라이더들이 주문을 더 효율적으로 관리하고 배달하는 데 도움이 되어야 합니다. 이는 최적의 경로 선택, 신속한 서비스, 주문 처리의 정확성 등을 포함합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_leader03.jpg">
                                </div>
                                <div class="txtArea">
                                    <h4>문제 해결 능력</h4>
                                    <h5>Problem-Solving Skills</h5>
                                    <p>리더쉽은 라이더들이 발생할 수 있는 문제에 대처하는 능력을 의미합니다. 예를 들어, 교통 혼잡, 날씨 악화 등의 상황에서 신속하게 대응하고 문제를 해결할 수 있는 능력이 필요합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_leader04.jpg">
                                </div>
                                <div class="txtArea">
                                    <h4>협업과 소통</h4>
                                    <h5>Collaboration and Communication</h5>
                                    <p>라이더 인재 리더쉽은 팀 내에서의 협업과 효과적인 소통을 강조합니다. 팀원들과의 원활한 의사소통은 서비스 품질을 향상시키고 업무 효율성을 증진시킵니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_leader05.jpg">
                                </div>
                                <div class="txtArea">
                                    <h4>기술적 능력과 습득력</h4>
                                    <h5>Technical Proficiency and Adaptability</h5>
                                    <p>배달 서비스는 기술 중심의 업종이므로 리더쉽은 최신 기술을 습득하고 활용할 수 있는 능력을 갖추어야 합니다. 이는 배송 앱의 이해, GPS 활용, 문제 해결을 위한 기술 도구 활용 등을 포함합니다.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination wow fadeInRight" data-wow-delay="0.6s"></div>
                </div>

        </div>
        <!--<div class="line">
            <div class="wow fadeInDownBig" animation-duration="1s" data-wow-delay="0s"></div>
            <div class="wow fadeInRightBig" animation-duration="1s" data-wow-delay="0.5s"></div>
        </div>-->
    </section>

    <section class="idx_overview wow fadeInDown" data-wow-delay="0.3s">
        <div class="inr">
            <div class="text">
                <div class="line wow fadeInLeft" data-wow-delay="0.4s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/foodline.png">
                </div>
                <h4>
                    <p class="wow fadeInLeft" data-wow-delay="0.5s">언제나, 정직하게 모두를 위한 기회 실현</p>
                    <p class="txtRed wow fadeInRight" data-wow-delay="0.6s">푸드라인이 열어가겠습니다.</p>
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

            //리더쉽
            var swiper = new Swiper(".swiperLeader", {
                direction: "vertical", // 수직 슬라이드로 변경된 부분
                scrollbar: {
                    el: ".swiper-scrollbar",
                    hide: false,
                },
                mousewheel: {
                    enabled: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '">' + (index + 1) + "</span>";
                    },
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
    </script>

<?php
include_once(G5_PATH.'/tail.php');
?>