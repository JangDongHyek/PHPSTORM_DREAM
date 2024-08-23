<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
    <!--main_w-->
    <div class="mobile-none">
        <div class="jb-box">
            <a name="main">
                <div class="arrow-position">
                    <div class="arrow-down">
                        <a href="#about">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </a>
            <video muted playsinline autoplay loop class="rounded-bottom-3">
                <source src="<?php echo G5_THEME_URL ?>/movie/kme_movie.mp4" type="video/mp4">
                <div>Your browser does not support the video tag.</div>
            </video>
            <!-- <div class="movie-text-position">
                <p class=" fs-0_5">Global Service Network
                    <br>Best Products
                </p>
                <p class="mt-4 fs-3">(주)KME는 품질과 고객만족을<br />최우선으로 생각하는 기업입니다.</p>
            </div> -->
        </div>
    </div>

    <!--main_m-->
    <div class="w-100 web-none" style="position: relative;">
        <div class="slide-text-position px-3 text-light" style="text-shadow: 1px 1px 10px black;">
            <div class="lh-1" style="font-size: calc(1.2rem + 1.0vw) !important;">Global Service Network</div>
            <div class="lh-1 fw-bold" style="font-size: calc(2.1rem + 1.6vw) !important;">Best Products</div>
        </div>
        <div id="kme_carousel" class="carousel slide w-100" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#kme_carousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#kme_carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#kme_carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#kme_carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <div class="w-100">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_main/slide_01_m.webp" class="img-fluid">
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="w-100">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_main/slide_02_m.webp" class="img-fluid">
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="w-100">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_main/slide_03_m.webp" class="img-fluid">
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="w-100">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_main/slide_04_m.webp" class="img-fluid">
                    </div>
                </div>
            </div>
            <div>
                <button class="carousel-control-prev" type="button" data-bs-target="#kme_carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#kme_carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 회사소개 -->
    <div class="py-lg-5 py-0">
        <div class="d-flex flex-column align-items-center container-lg">
            <div class="w-100 text-center">
                <div class="title-font pt-5 lh-sm">KME Co., Ltd</div>
                <div class="contents-sub-title py-4">The best quality, best service, new product development under a
                    management<br class="mobile-none"> philosophy make our customer higher satisfied.
                </div>
            </div>
            <div class="w-100">
                <div class="d-flex align-items-center justify-content-center pb-5 pt-4">
                    <div class="d-flex flex-column align-items-center me-0 me-lg-5 fs-icon-width">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greetings" target="_self"
                           class="d-flex flex-column align-items-center justify-content-center text-center circle-kme">
                            <i class="bi bi-chat-square-text fs-icon"></i>
                            <div class="fs-6_5 d-none d-lg-block">Greetings</div>
                        </a>
                        <div class="fs-6_5 d-block d-lg-none">Greetings</div>
                    </div>
                    <div class="d-flex flex-column align-items-center me-0 me-lg-5 fs-icon-width">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=history" target="_self"
                           class="d-flex flex-column align-items-center justify-content-center text-center circle-kme">
                            <i class="bi bi-calendar-check fs-icon"></i>
                            <div class="fs-6_5 d-none d-lg-block">History</div>
                        </a>
                        <div class="fs-6_5 d-block d-lg-none">History</div>
                    </div>
                    <div class="d-flex flex-column align-items-center me-0 me-lg-5 fs-icon-width">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=organization" target="_self"
                           class="d-flex flex-column align-items-center justify-content-center text-center circle-kme">
                            <i class="bi bi-people fs-icon"></i>
                            <div class="fs-6_5 d-none d-lg-block">Organization</div>
                        </a>
                        <div class="fs-6_5 d-block d-lg-none">Organization</div>
                    </div>
                    <div class="d-flex flex-column align-items-center fs-icon-width">
                        <a href="<?php echo G5_THEME_IMG_URL ?>/KME_COMPANY_PROFILE.pdf" target="_blank"
                           class="d-flex flex-column align-items-center justify-content-center text-center circle-kme">
                            <i class="bi bi-file-earmark-pdf fs-icon"></i>
                            <div class="fs-6_5 d-none d-lg-block">Introduction</div>
                        </a>
                        <div class="fs-6_5 d-block d-lg-none">Introduction</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--사업분야-->
    <div class="d-flex align-items-center justify-content-center main-business-img py-0 py-lg-5 border img-media-75">
        <div class="contents_container py-5 px-3 px-lg-0 text-center">
            <div class="w-100 text-center">
                <div class="title-font lh-sm text-light">BUSINESS FIELD*</div>
                <div class="contents-sub-title pt-3 pb-5 text-light">
                    KME's endless pursuit challenges and<br class="mobile-none"> technological development would be
                    stepping stones to a bright future!
                </div>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="d-lg-flex align-items-center justify-content-center w-100">
                    <a class="w-100 me-0 me-lg-2" href="<?php echo G5_BBS_URL ?>/content.php?co_id=marine" target="_self">
                        <div class="updown-slide business-box main-business-sub-img01 reveal text-start">
                            <div class="fs-5">01</div>
                            <div class="d-flex align-items-center justify-content-between fs-4 fw-bold lh-1">
                                MARINE<i class="bi bi-chevron-right fs-6 ms-4"></i>
                            </div>
                        </div>
                    </a>
                    <a class="w-100 me-0 me-lg-2" href="<?php echo G5_BBS_URL ?>/content.php?co_id=offshore" target="_self">
                        <div class="updown-slide business-box main-business-sub-img02 reveal text-start">
                            <div class="fs-5">02</div>
                            <div class="d-flex align-items-center justify-content-between fs-4 fw-bold lh-1">
                                OFFSHORE<i class="bi bi-chevron-right fs-6 ms-4"></i>
                            </div>
                        </div>
                    </a>
                    <a class="w-100 me-0 me-lg-2" href="<?php echo G5_BBS_URL ?>/content.php?co_id=cruise" target="_self">
                        <div class="updown-slide business-box main-business-sub-img03 reveal text-start">
                            <div class="fs-5">03</div>
                            <div class="d-flex align-items-center justify-content-between fs-4 fw-bold lh-1">
                                CRUISE<i class="bi bi-chevron-right fs-6 ms-4"></i>
                            </div>
                        </div>
                    </a>
                    <a class="w-100" href="<?php echo G5_BBS_URL ?>/content.php?co_id=special" target="_self">
                        <div class="updown-slide business-box main-business-sub-img04 reveal text-start">
                            <div class="fs-5">04</div>
                            <div class="d-flex align-items-center justify-content-between fs-4 fw-bold lh-1">
                                SPECIAL SHIPS<i class="bi bi-chevron-right fs-6 ms-4"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 제품소개 -->
    <div class="d-flex align-items-center justify-content-center main-products-img py-0 py-lg-5">
        <div class="contents_container py-5 px-3 px-lg-0 text-center">
            <div class="hr-sect">
                <div>
                    <div class="title-font lh-sm text-kme">PRODUCTS*</div>
                    <div class="contents-sub-title pt-3 pb-5">
                        For ships, plants, and offshore facilities.
                    </div>
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="me-0 me-lg-2 w-100 product-box-border updown-slide reveal">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=off_lighting" class="product-txt-box" target="_self">
                        <img class="main-products-sub-img01 product-img-box">
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <div class="lh-1 py-2">ELECTRIC<br class="mobile-none"> EQUIPMENT</div>
                        </div>
                    </a>
                </div>
                <div class="me-0 me-lg-2 w-100 product-box-border updown-slide reveal">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=heli_helideck" class="product-txt-box" target="_self">
                        <img class="main-products-sub-img02 product-img-box">
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <div class="lh-1 py-2">HELIDECK LIGHTING &<br class="mobile-none"> NAVI. AIDS SYSTEM</div>
                        </div>
                    </a>
                </div>
                <div class="me-0 me-lg-2 w-100 product-box-border updown-slide reveal">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=heat_pipe" class="product-txt-box" target="_self">
                        <img class="main-products-sub-img03 product-img-box">
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <div class="lh-1 py-2">ELECTRIC HEAT<br class="mobile-none"> TRACING SYSTEM</div>
                        </div>
                    </a>
                </div>
                <div
                    class="align-items-center justify-content-center me-0 me-lg-2 w-100 product-box-border updown-slide reveal">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=acco_laboratory" class="product-txt-box" target="_self">
                        <img class="main-products-sub-img04 product-img-box">
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <div class="lh-1 py-2">ACCOMMODATION EQUIPMENT</div>
                        </div>
                    </a>
                </div>
                <div class="w-100 product-box-border updown-slide reveal">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=ut_high" class="product-txt-box" target="_self">
                        <img class="main-products-sub-img05 product-img-box">
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <div class="lh-1 py-2">UNIT<br class="mobile-none"> TOILET</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!--등록된 조선소-->
    <div class="d-flex align-items-center justify-content-center main-shipyard-img pb-5">
        <div class="contents_container pb-0 pb-lg-5 px-3 px-lg-0 text-center">
            <div class="hr-sect">
                <div>
                    <div class="title-font lh-sm text-kme">REGISTERED SHIPYARD*</div>
                    <div class="contents-sub-title pt-3 pb-5">
                        KME works with world-class companies.
                    </div>
                </div>
            </div>
            <!--웹-->
            <div class="mobile-none">
                <div class="d-lg-flex">
                    <a href="http://www.samsungshi.com/kor/default.aspx" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/1_samsung_logo.webp" class="w-100"></a>
                    <a href="https://www.hanwha.co.kr/business/manufacture/hanwhaocean.do" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/3_dsme_logo.webp" class="w-100"></a>
                    <a href="https://www.hhi.co.kr/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/5_Hyundai_logo.webp" class="w-100"></a>
                    <a href="https://www.hshi.co.kr/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/2_Hyundai_samho_logo.webp" class="w-100"></a>
                    <a href="https://www.hd-hmd.com/main/main.jsp" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 mb-2 w-100 bg-white shipyard-updown-slide">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/6_Hyundai_mipo_logo.webp" class="w-100">
                    </a>
                </div>
                <div class="d-lg-flex">
                    <a href="https://www.hjsc.co.kr/main/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/7_hanjin_logo.webp" class="w-100"></a>
                    <a href="http://www.hsgsd.co.kr/kor/main/main.jsp" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/4_sungdong_logo.webp" class="w-100"></a>
                    <a href="http://www.daesunship.co.kr/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/8_daesun_logo.webp" class="w-100"></a>
                    <a href="http://www.kangnamship.co.kr/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/011_kangnam_logo.webp" class="w-100">
                    </a>
                    <a href="http://www.asiashipbuilding.co.kr/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/012_asiajosun_logo.webp" class="w-100"></a>
                </div>
                <div class="d-lg-flex">
                    <a href="http://yuilship.co.kr/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/013_yuil_logo.webp" class="w-100"></a>
                    <a href="http://hankookmade.com/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/015_hankook_logo.webp" class="w-100"></a>
                    <a href="https://www.modec.com/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/014_modec_logo.webp" class="w-100"></a>
                    <a href="https://www.seatrium.com/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 me-2 mb-2 w-100 bg-white shipyard-updown-slide"><img
                            src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/9_seatrium_logo.webp" class="w-100"></a>
                    <a href="https://sskzvezda.ru/" target="_blank"
                       class="d-flex align-items-center justify-content-center border p-2 mb-2 w-100 bg-white shipyard-updown-slide">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/010_zvezda_logo.webp" class="w-100">
                    </a>
                </div>
            </div>
            <!--모바일-->
            <div class="web-none">
                <div class="d-lg-flex">
                    <div class="d-flex w-100">
                        <a href="http://www.samsungshi.com/kor/default.aspx" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/1_samsung_logo.webp" class="img-fluid w-100"></a>
                        <a href="https://www.hanwha.co.kr/business/manufacture/hanwhaocean.do" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/3_dsme_logo.webp" class="img-fluid w-100"></a>
                    </div>
                    <div class="d-flex w-100">
                        <a href="https://www.hhi.co.kr/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/5_Hyundai_logo.webp" class="img-fluid w-100"></a>
                        <a href="https://www.hshi.co.kr/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/2_Hyundai_samho_logo.webp" class="img-fluid w-100"></a>
                    </div>
                    <div class="d-flex w-100">
                        <a href="https://www.hd-hmd.com/main/main.jsp" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/6_Hyundai_mipo_logo.webp" class="img-fluid w-100">
                        </a>
                        <a href="https://www.hjsc.co.kr/main/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/7_hanjin_logo.webp" class="img-fluid w-100"></a>
                    </div>
                </div>
                <div class="d-lg-flex">
                    <div class="d-flex w-100">
                        <a href="http://www.hsgsd.co.kr/kor/main/main.jsp" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/4_sungdong_logo.webp" class="img-fluid w-100"></a>
                        <a href="http://www.daesunship.co.kr/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/8_daesun_logo.webp" class="img-fluid w-100"></a>
                    </div>
                    <div class="d-flex w-100">
                        <a href="http://www.kangnamship.co.kr/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/011_kangnam_logo.webp" class="img-fluid w-100">
                        </a>
                        <a href="http://www.asiashipbuilding.co.kr/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/012_asiajosun_logo.webp" class="img-fluid w-100"></a>
                    </div>
                    <div class="d-flex w-100">
                        <a href="http://yuilship.co.kr/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/013_yuil_logo.webp" class="img-fluid w-100"></a>
                        <a href="http://hankookmade.com/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/015_hankook_logo.webp" class="img-fluid w-100"></a>
                    </div>
                </div>
                <div class="d-lg-flex">
                    <div class="d-flex w-100">
                        <a href="https://www.modec.com/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/014_modec_logo.webp" class="img-fluid w-100"></a>
                        <a href="https://www.seatrium.com/" target="_blank"
                           class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light"><img
                                src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/9_seatrium_logo.webp" class="img-fluid w-100"></a>
                    </div>
                    <div class="d-flex w-100">
                        <div
                            class="d-flex align-items-center justify-content-center border shipyard-updown-slide p-3 w-100 bg-light">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/bg_shipyard/010_zvezda_logo.webp" class="img-fluid w-100">
                        </div>
                        <div class="d-flex align-items-center justify-content-center p-3 w-100 mobile-none">
                            <div class="img-fluid w-100"></div>
                        </div>
                    </div>
                    <div class="w-100">
                    </div>
                </div>
            </div>
            <!--납품 횟 수-->
            <div
                class="container-lg d-lg-flex align-items-center justify-content-center border py-3 mt-3 mt-lg-1 reveal bg-kme">
                <div class="pb-3 pb-lg-0">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/bg_business/shipbuilding.svg" class="img-fluid" style="width: 30px;">
                        <div class="ms-3 fs-5 text-light">
                            Ship Material Delivery
                        </div>
                    </div>
                </div>
                <div class="d-flex ms-0 ms-lg-5 text-light">
                    <div style="width: 120px;">
                        <div class="fs-6_5">~ 2015</div>
                        <div id="" class="fs-5">90841</div>
                    </div>
                    <div style="width: 120px;">
                        <div class="fs-6_5">~ 2020</div>
                        <div id="" class="fs-5">137,114</div>
                    </div>
                    <div style="width: 120px;">
                        <div class="fs-6_5">~ present</div>
                        <div id="count" class="fw-bold fs-5 text-warning"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KME 소식 -->
    <div class="main-notice-img">
        <div class="d-flex align-items-center justify-content-center container-lg py-5">
            <div class="contents_container pb-5 py-0 py-lg-5 text-center">
                <div class="text-center">
                    <div class="w-100 text-center">
                        <div class="title-font lh-sm text-li">KME NEWS</div>
                        <div class="contents-sub-title pt-3 pb-5">
                            Check out the KME news.
                        </div>
                    </div>
                    <?php echo latest("theme/webzine", "news", 3, 25); ?>
                    <div class="pt-4 pt-lg-5">
                        <a class="" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=news" target="_self">
                            <button type="button" class="btn btn-outline-dark px-5 py-3">See More</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://gcore.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>


    <!--카운트-->
    <script>
        let countBox = document.querySelector('#count');
        let count = 0;
        let num = 170156;

        let counting = setInterval(function () {
            if (count >= num) {
                count = num;
                clearInterval(counting);
            } else {
                count += 1315;
            }
            countBox.innerHTML = new Intl.NumberFormat().format(count);
        }, 100);
    </script>





<?php
include_once(G5_PATH.'/tail.php');
?>