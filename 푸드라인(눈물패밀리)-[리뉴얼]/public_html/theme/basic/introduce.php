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
#gnb_1dul > li.gnb_1dli:nth-child(4) a.gnb_1da{ color:#DC000C !important;   transition:all 1s  !important;}
#gnb_1dul > li.gnb_1dli:nth-child(4) span{ display:block !important;  transition:all 1s  !important; width:100% !important}
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
            <div class="swiper-slide introduce_v1">
            <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>푸드라인은 어떤 경영철학을</p>
                            <p>가지고<span class="txtRed"> 있는가?</span></p>
                        </h3>
                        <a class="btnArrow" href="<?php echo G5_URL ?>/delivery_list.php">상점제휴 문의하기</a>
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
    <section class="idx_service" class="wow fadeInDownBig" data-wow-delay="0.3s">
        <!--<div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE SERVICE</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s">사장님이 믿고 맡기는 푸드<span class="txtRed">라</span>인</p>
                <p class="wow fadeInUp" data-wow-delay="0.5s">신뢰와 안심, 그리고 항상 더 나은 서비스</p>
            </h3>
        </div>-->
        <div class="area_marin">
                <!--회사소개--> 
                <div class="area_img wow fadeInRight" data-wow-delay="0.3s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_company.jpg"></div>
                <div class="area_txt wow fadeInLeft" data-wow-delay="0.8s">
                    <div class="area_txt_wrap">
                        <h3>프리미엄 배달대행 전문기업<br><span class="check">푸드라인</span></h3>
                        <p>
                        푸드라인은 차별화된 기술을 기반으로 고객에게 필요한 맞춤 배송을
                        제공하는 배달 서비스로 시작했습니다. 우리는 빠르고 안전한 배송과
                        고객중심의 서비스를 만들기 위해 노력합니다.<br>
                        이제는 혁신적인 기술력과 선도적인 서비스를 바탕으로
                        새로운 유통 시장을 열고 로컬 커머스의 뛰어난 경험들을 만들고자 합니다.<br>
                        감사합니다.
                        </p>
                        <div class="cust">
                           <dl>
                                <dt>전화상담</dt>
                                <dd>
                                    <span class="tel">박주용 상무이사 <p>010-5373-7716</p><br>
                                        장우영 상무이사 <p>010-4132-1665</p></span>
                                    <br><span>평일09시~20시 일/공휴일 휴무</span></dd>
                           </dl>
                           <dl>
                                <dt>메일상담</dt>
                                <dd><span class="tel">foodline99@naver.com</span></dd>
                           </dl>
                        </div>
                        <a class="area_btn" href="<?php echo G5_URL ?>/delivery_list.php">상점제휴 문의 바로가기<i></i></a>
                    </div>
                </div>

        </div>
        <!--<div class="line">
            <div class="wow fadeInDownBig" animation-duration="1s" data-wow-delay="0s"></div>
            <div class="wow fadeInRightBig" animation-duration="1s" data-wow-delay="0.5s"></div>
        </div>-->
    </section>


    <section class="imgBgArea" style="background:#f8f8f8">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">LINE</span> IDENTITY</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인은 체인점 전문 업체<br /> 눈물패밀리가 운영하는 배달대행 업체 입니다.</h3>
        </div>
        <div class="imgAreasubBg" style="background-image: url('./theme/basic/img/sub/introduce_bg.jpg')"></div>
    </section>


    <!--<section class="idx_review">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">LINE</span> STORY</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인 스토리</h3>
        </div>
        <div class="swiper swiperReview wow fadeInUp" data-wow-delay="0.5s">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </section>-->
    <section class="idx_overview wow fadeInDown" data-wow-delay="0.3s">
        <div class="inr">
            <div class="text">
                <div class="line wow fadeInLeft" data-wow-delay="0.4s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/foodline.png">
                </div>
                <h4>
                    <p class="wow fadeInLeft" data-wow-delay="0.5s">언제나, 정직하게 모두를 위한 기회 실현이</p>
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
    </script>

<?php
include_once(G5_PATH.'/tail.php');
?>