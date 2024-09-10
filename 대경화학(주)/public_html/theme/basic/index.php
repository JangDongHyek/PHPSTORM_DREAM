<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
include_once(G5_THEME_PATH.'/head.php');
?>
<div id="idx_wrapper" xmlns="http://www.w3.org/1999/html">
    <div id="visual" class="wow fadeInDown animated">
        <div class="inr">
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="slogan">
                        <h3>We are producting
                            <strong>excellent goods</strong>
                        </h3>
                        <h4>
                            <p>탁월한 기술력과 전문성으로 믿음직한 파트너가 되어드립니다.</p>
                            <p>함께하는 협업을 통해 뛰어난 품질과 디자인을 선사해 드립니다.</p>
                        </h4>
                    </div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/santafe_mx5.png">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/palisade.png">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/g80.png">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/gv80.png">
                        </div>
                    </div>
                </div>
            <div thumbsSlider="" class="swiper mySwiper">
                <a class="link" href="<?php echo G5_BBS_URL ?>/content.php?co_id=product03">
                    <p>생산품목</p>
                    <span>더 많은 품목 <i class="fa-sharp fa-light fa-arrow-right"></i></span>
                </a>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <p>SANTAFE(MX5)</p>
                        <span>6가 유광 + 틴티드도장</span>
                    </div>
                    <div class="swiper-slide">
                        <p>PALISADE(LX2 PE)</p>
                        <span>6가 유광 + 틴티드도장</span>
                    </div>
                    <div class="swiper-slide">
                        <p>G80(RG3)</p>
                        <span>3가 백색/흑색 유광</span>
                    </div>
                    <div class="swiper-slide">
                        <p>GV80(JX1)</p>
                        <span>3가 백색 유광/무광</span>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".mySwiper", {
                    loop: true,
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true,
                    autoplay: {
                        delay: 3000, // Set the delay (in milliseconds) between slides
                        disableOnInteraction: false, // Allow manual interaction to stop autoplay
                    },
                });

                var swiper2 = new Swiper(".mySwiper2", {
                    loop: true,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper,
                    },
                    autoplay: {
                        delay: 3000, // Set the delay (in milliseconds) between slides
                        disableOnInteraction: false, // Allow manual interaction to stop autoplay
                    },
                });
            </script>
        </div>


        <div class="scrolldown">
            <a href="#content"><i>SCROLL DOWN</i>&nbsp;&nbsp;<i class="fal fa-mouse-alt" style="color:#fff"></i></a>
        </div>


    </div>

</div>
<!-- #idx_wrapper -->

<div id="content">
    <div class="idx_overview">
        <div class="inr">
            <div class="txt">
                <p class="wow fadeInUp" data-wow-delay="0.2s">Mastering automotive exterior parts<br>
                    We are  global expert in GRILLE and EMBLEM</p>
                <span class="wow fadeInDown" data-wow-delay="0.4s">탁월한 기술력과 전문성으로 믿음직한 파트너가 되어드립니다.<br>
                    함께하는 협업을 통해 뛰어난 품질과 디자인을 선사해 드립니다.</span>
            </div>
        </div>
    </div>

    <div class="idx_motto">
        <div class="inr">
            <div class="idx_title">
                <h3>Corporate Goals</h3>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=motto" class="more">자세히보기 <i class="fa-light fa-angle-right"></i></a>
            </div>
            <div class="dl_wrap">
                <dl class="wow fadeInDown" data-wow-delay="0.2s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon01.svg"></p>
                        <strong>방침</strong>
                    </dt>
                    <dd>품질혁신을 통한
                        공정불량 감소로
                        고객불만 ZERO "달성"</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.3s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon02.svg"></p>
                        <strong>품질목표</strong></dt>
                    <dd>공정 불량율 10% 감소
                        RTN 불량율 8% 감소
                        품질목표와 성과에 집중</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.4s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon03.svg"></p>
                        <strong>사업</strong></dt>
                    <dd>VISON
                        혁신경영을 통한
                        글로벌 기업으로 도약</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.5s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon04.svg"></p>
                        <strong>사훈</strong></dt>
                    <dd>인화단결
                        창의개발
                        품질만족</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.6s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon05.svg"></p>
                        <strong>경영</strong></dt>
                    <dd>전문성, 창조성, 자립성
                        중심의 지속 가능한
                        경영인프라 구축</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="idx_company">
        <div class="inr">
            <div class="idx_title">
                <h3>About DAEKYUNG</h3>
            </div>
            <div class="txt">
                <h4>자동차 외장 부품 마스터링<br>
                    GRILLE 및 EMBLEM 분야의 글로벌 전문가</h4>
                <p>대경화학주식회사는 자동차 외장 부품 분야에서 세계적인 선도 기업으로 자리매김하기 위해 노력하고 있습니다. <br>
                    우리의 비전은 혁신적이고 품질 높은 GRILLE 및 EMBLEM 제품을 통해 <br>
                    차량 외관의 디자인과 성능을 높이고, 고객들에게 더 나은 운전 경험을 제공하는 것입니다.</p>
            </div>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="more wow fadeInDown" data-wow-delay="0.8s">자세히 보기 <i class="fa-light fa-angle-right"></i></a>
        </div>
    </div>

    <div class="idx_cs">
        <div class="inr">
            <div class="banner">
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=facility'">
                        <dt>시험설비</dt>
                        <dd>최신 설비로 높은 효율과<br>
                            품질을 약속합니다.</dd>
                    </dl>
                </div>
                <div></div>
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=process'">
                        <dt>제조공정</dt>
                        <dd>대경화학은 엄격한<br>
                            제조공정 절차를 준수합니다.</dd>
                    </dl>
                </div>
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=recruit'">
                        <dt>채용안내</dt>
                        <dd>우리와 함께<br>
                            혁신적인 여정에 참여하세요!</dd>
                    </dl>
                </div>
            </div>
            <div class="latest">
                <?php echo latest('theme/basic', 'notice', 2, 100); ?>
            </div>
        </div>
    </div>

</div>


<?php
include_once(G5_PATH.'/tail.php');
?>