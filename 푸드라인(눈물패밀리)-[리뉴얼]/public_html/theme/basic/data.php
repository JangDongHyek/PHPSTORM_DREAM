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
    display: none;
	}
#visual{display: none;}
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
                        <img src="<?php /*echo G5_THEME_IMG_URL */?>/main/visual_mark.svg">
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
                        <img src="<?php /*echo G5_THEME_IMG_URL */?>/main/visual_mark.svg">
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
    <section class="idx_data" class="wow fadeInDownBig" data-wow-delay="0.3s">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE program download</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s"><span class="txtRed">푸드라인</span> 프로그램 다운로드</p>
            </h3>
        </div>
        <div class="contsArea">
            <div class="grid">
                <div class="a_ver">
                    <h2>version <strong>A</strong></h2>
                    <div class="txt">※스마트폰, 콜센터, 가맹점 관리 프로그램</div>
                    <a href="http://qtec.kr/foodline/" target="_blank">다운로드 바로가기 <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class="b_ver">
                    <h2>version <strong>B</strong></h2>
                    <div class="down_wrap">
                        <a href="https://d33dv3xdfnvg35.cloudfront.net/client/foodline/admin_app.apk" download>
                            <p><i class="fa-duotone fa-mobile"></i> 관리자앱 - v1.2.93</p>
                            <button>다운로드 <i class="fa-light fa-arrow-down-to-line"></i></button>
                        </a>
                        <a href="https://d33dv3xdfnvg35.cloudfront.net/client/foodline/admin_pc.msi" download>
                            <p><i class="fa-duotone fa-desktop"></i> 관리자PC - v1.2.42</p>
                            <button>다운로드 <i class="fa-light fa-arrow-down-to-line"></i></button>
                        </a>
                        <a href="https://d33dv3xdfnvg35.cloudfront.net/client/foodline/shop_app.apk" download>
                            <p><i class="fa-duotone fa-mobile"></i> 상점앱 - v1.9.64</p>
                            <button>다운로드 <i class="fa-light fa-arrow-down-to-line"></i></button>
                        </a>
                        <a href="https://d33dv3xdfnvg35.cloudfront.net/client/foodline/shop_pc.msi" download>
                            <p><i class="fa-duotone fa-desktop"></i> 상점PC - v1.2.6</p>
                            <button>다운로드 <i class="fa-light fa-arrow-down-to-line"></i></button>
                        </a>
                        <a href="https://d33dv3xdfnvg35.cloudfront.net/client/foodline/rider_app.apk" download>
                            <p><i class="fa-duotone fa-mobile"></i> 기사앱 - v1.3.24</p>
                            <button>다운로드 <i class="fa-light fa-arrow-down-to-line"></i></button>
                        </a>
                    </div>
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
        });
    </script>

<?php
include_once(G5_PATH.'/tail.php');
?>