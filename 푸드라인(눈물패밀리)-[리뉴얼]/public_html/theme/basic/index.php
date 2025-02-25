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
#gnb_1dul > li.gnb_1dli:nth-child(1) a.gnb_1da{ color:#DC000C !important;   transition:all 1s  !important;}
#gnb_1dul > li.gnb_1dli:nth-child(1) span{ display:block !important;  transition:all 1s  !important; width:100% !important}
</style>
<section id="visual">
    <div class="swiper swiperVisual">
        <div class="swiper-wrapper">
            <div class="swiper-slide v1">
                <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>정직하고 확실하게</p>
                            <p>안심배달 가이드 푸드<span class="txtRed">라</span>인</p>
                        </h3>
                        <a class="btnArrow" href="<?php echo G5_URL ?>/delivery_list.php">바로 문의하기</a>
                    </div>
                    <!--<div class="imgMark">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/visual_mark.svg">
                    </div>-->
                </div>
            </div>
            <div class="swiper-slide v2">
                <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>정직하고 확실하게</p>
                            <p>안심배달 가이드 푸드<span class="txtRed">라</span>인</p>
                        </h3>
                        <a class="btnArrow" href="<?php echo G5_URL ?>/delivery_list.php">바로 문의하기</a>
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
    <section class="idx_service">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE SERVICE</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s">사장님이 믿고 맡기는 푸드<span class="txtRed">라</span>인</p>
                <p class="wow fadeInUp" data-wow-delay="0.5s">신뢰와 안심, 그리고 항상 더 나은 서비스</p>
            </h3>
        </div>
        <div class="contsArea">
            <div class="swiper swiperService">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea wow fadeInDown" data-wow-delay="0.3s">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/service01.png">
                                </div>
                                <div class="txtArea wow fadeInDown" data-wow-delay="0.4s">
                                    <h4>쉽고 간편한 POS</h4>
                                    <p>다양한 운영정책 설정이 가능하여<br>
                                        배달대행 배송사와 가맹점, 라이더가 원하는대로<br>
                                        옵션화된 운영을 지원합니다.</p>
                                    <!--<div class="btnAera flex aiC">
                                        <a class="btnBlack" href="https://d33dv3xdfnvg35.cloudfront.net/client/foodline/shop_pc.msi" target="_blank">사장님 프로그램 <i class="fa-light fa-arrow-down-to-line"></i></a>
                                        <a class="btnRed" href="../basic/down/푸드라인가맹점가이드.pdf">사용설명서 <i class="fa-light fa-arrow-down-to-line"></i></a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                        <!--<div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea">
                                    <img src="<?php /*echo G5_THEME_IMG_URL */?>/main/service01.png">
                                </div>
                                <div class="txtArea">
                                    <h4>배달 접수도 쉽고 빠르게</h4>
                                    <p>매장 업무에만 집중할 수 있도록!<br>
                                        주문, 배달 진행 상황과 매출까지 쉽게<br>
                                        확인할 수 있는 단순하고 똑똑한 프로그램</p>
                                    <div class="btnAera flex aiC">
                                        <a class="btnBlack">사장님 프로그램 <i class="fa-light fa-arrow-down-to-line"></i></a>
                                        <a class="btnRed">사용설명서 <i class="fa-light fa-arrow-down-to-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="grid">
                                <div class="imgArea">
                                    <img src="<?php /*echo G5_THEME_IMG_URL */?>/main/service01.png">
                                </div>
                                <div class="txtArea">
                                    <h4>배달 접수도 쉽고 빠르게</h4>
                                    <p>매장 업무에만 집중할 수 있도록!<br>
                                        주문, 배달 진행 상황과 매출까지 쉽게<br>
                                        확인할 수 있는 단순하고 똑똑한 프로그램</p>
                                    <div class="btnAera flex aiC">
                                        <a class="btnBlack">사장님 프로그램 <i class="fa-light fa-arrow-down-to-line"></i></a>
                                        <a class="btnRed">사용설명서 <i class="fa-light fa-arrow-down-to-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="swiper-scrollbar wow fadeInRight" data-wow-delay="0.6s"></div>
                </div>

        </div>
        <!--<div class="line">
            <div class="wow fadeInDownBig" animation-duration="1s" data-wow-delay="0s"></div>
            <div class="wow fadeInRightBig" animation-duration="1s" data-wow-delay="0.5s"></div>
        </div>-->
    </section>

    <section class="idx_review">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE SERVICE</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인 앱 스토리</h3>
        </div>
        <!-- Swiper -->
        <div class="swiper swiperReview wow fadeInUp" data-wow-delay="0.5s">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/seller_review01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>FOODLINE Program</span>
                            <p>푸드라인 프로그램</p>
                            <div>본사 내의 개발팀과 실무진들이 직접 배달대행사 운영하며 함께 개발하고 있는 프로그램 입니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/seller_review02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Orderlist Design</span>
                            <p>오더리스트 디자인</p>
                            <div>편리한 콜 배차를 위해 오더리스트 디자인 4가지 선택 할 수 있어요. 본인에게 맞는 디자인으로 선택해서 운행 가능해요.
									</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/seller_review03.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Easy with Core Features</span>
                            <p>핵심 기능으로 간편하게</p>
                            <div>쉬운 화면구성 쉬우면서도 다양한 기능설정 앞으로 유익한 기능으로 최적화 진행중에 있어요.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/seller_review04.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Custom Updates</span>
                            <p>맞춤형 업데이트</p>
                            <div>맞춤형 디자인으로 글자 크기 부터 색상까지 한눈에 보이는 디자인으로 맞춤설정 여러 피드백과 니즈에 맞춰 상시 업데이트 되고 있습니다.
									</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/seller_review02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>카페 자영업 사장님</span>
                            <p>Question Mark Cafe 후기</p>
                            <div>서비스를 이용한 경험은 전반적으로 매우 만족스러웠습니다. 우선 푸드라인 서비스 도입 이전에는 고객들께서 매장 방문 혹은 테이크아웃을 통해 주문을 하셨는데, 이제 라이더 서비스를 통해 배달 옵션을 제공함으로써 고객들에게 더 많은 편의를 제공할 수 있게 되었습니다. 주문량이 이전보다 상당히 늘어나고, 특히 주변 사무실이나 학교 등에서 많은 주문이 들어와 활성화된 모습이 눈에 띕니다.</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>

        <!--<div class="text-center wow fadeInDown" data-wow-delay="0.6s">
            <a class="btnRed">후기 더보기 <i class="fa-light fa-plus"></i></a>
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

            //서비스
            var swiper = new Swiper(".swiperService", {
                scrollbar: {
                    //el: ".swiper-scrollbar",
                    //hide: false,
                },
                //mousewheel: {
                    //enabled: true,
                //},
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