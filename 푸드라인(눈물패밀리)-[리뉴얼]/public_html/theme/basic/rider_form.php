<?php
include_once(G5_PATH."/jl/JlConfig.php");
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
include_once(G5_THEME_PATH.'/head.php');
?>


<div id="idx_wrapper">
        <!--<div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE SERVICE</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s">사장님이 믿고 맡기는 푸드<span class="txtRed">라</span>인</p>
                <p class="wow fadeInUp" data-wow-delay="0.5s">신뢰와 안심, 그리고 항상 더 나은 서비스</p>
            </h3>
        </div>-->

    <div class="scontents wow fadeInDownBig" data-wow-delay="0.3s">


        <div class="scon_left">
            <div class="sub_title_wr wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h2 class="sub_title">라이더 지원</h2>
                <p class="sub_desc ">1분이면 한번에 끝!</p>
            </div>
        </div>

        <div id="app">
            <form3-input></form3-input>
        </div>


        <!--<div class="line">
            <div class="wow fadeInDownBig" animation-duration="1s" data-wow-delay="0s"></div>
            <div class="wow fadeInRightBig" animation-duration="1s" data-wow-delay="0.5s"></div>
        </div>-->
    </div>



    


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
<?
$jl->vueLoad('app');
$jl->componentLoad("form");
$jl->componentLoad("item");
?>
<?php
include_once(G5_PATH.'/tail.php');
?>