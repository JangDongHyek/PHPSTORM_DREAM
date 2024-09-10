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
                            <p>We will be a reliable partner that offers excellent technologies and expertise.</p>
                            <p>We present outstanding qualities and designs achieved through collaboration.</p>
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
                <a class="link" href="<?php echo G5_BBS_URL ?>/content.php?co_id=product03_eng">
                    <p>Produced Items</p>
                    <span>More Items <i class="fa-sharp fa-light fa-arrow-right"></i></span>
                </a>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <p>SANTAFE(MX5)</p>
                        <span>Hexavalent Gloss + Tinted Coating</span>
                    </div>
                    <div class="swiper-slide">
                        <p>PALISADE(LX2 PE)</p>
                        <span>Hexavalent Gloss + Tinted Coating</span>
                    </div>
                    <div class="swiper-slide">
                        <p>G80(RG3)</p>
                        <span>Trivalent White/Black Gloss</span>
                    </div>
                    <div class="swiper-slide">
                        <p>GV80(JX1)</p>
                        <span>Trivalent White Gloss/Matt</span>
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
                <span class="wow fadeInDown" data-wow-delay="0.4s">Company Introduction
We will be a reliable partner that offers excellent technologies and expertise.
</span>
            </div>
        </div>
    </div>

    <div class="idx_motto">
        <div class="inr">
            <div class="idx_title">
                <h3>Corporate Goals</h3>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=motto_eng" class="more">See Details <i class="fa-light fa-angle-right"></i></a>
            </div>
            <div class="dl_wrap">
                <dl class="wow fadeInDown" data-wow-delay="0.2s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon01.svg"></p>
                        <strong>Policy</strong>
                    </dt>
                    <dd>To “attain” zero customer complaints by reducing process defects through quality innovation</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.3s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon02.svg"></p>
                        <strong>Quality Goal</strong></dt>
                    <dd>To reduce the process defect rate by 10%, reduce the RTN defect rate by 8%, and focus on quality goals and performances</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.4s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon03.svg"></p>
                        <strong>Business</strong></dt>
                    <dd>VISON
                        Taking a leap as a global company through VISON innovative management</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.5s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon04.svg"></p>
                        <strong>Company Motto</strong></dt>
                    <dd>Unity of People, Creative Development, Quality Satisfaction</dd>
                </dl>
                <dl class="wow fadeInDown" data-wow-delay="0.6s">
                    <dt>
                        <p class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/motto_icon05.svg"></p>
                        <strong>Management</strong></dt>
                    <dd>Building sustainable business infrastructures centered on professionality, creativity, and independence</dd>
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
                <h4>Automotive Exterior Parts Mastering<br>
                    Global experts in the fields of grille and emblem</h4>
                <p>Daekyung Chemical Co., Ltd. strives to become the world’s leading company in the field of automotive exterior parts.<br>
                    Our vision is to improve the design and performance of car exteriors and provide an even better driving experience to our customers through our innovative and high-quality grille and emblem products.
                </p>
            </div>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company_eng" class="more wow fadeInDown" data-wow-delay="0.8s">See Details <i class="fa-light fa-angle-right"></i></a>
        </div>
    </div>

    <div class="idx_cs">
        <div class="inr">
            <div class="banner">
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=facility_eng'">
                        <dt>Testing Facilities</dt>
                        <dd>Our cutting-edge facilities promise high efficiency and quality.</dd>
                    </dl>
                </div>
                <div></div>
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=process_eng'">
                        <dt>Manufacturing Process</dt>
                        <dd>Daekyung Chemical observes a strict manufacturing process.</dd>
                    </dl>
                </div>
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=recruit_eng'">
                        <dt>Recruitment Information</dt>
                        <dd>Join our journey to innovation!</dd>
                    </dl>
                </div>
            </div>
            <div class="latest">
                <?php echo latest('theme/basic', 'notice_eng', 2, 100); ?>
            </div>
        </div>
    </div>

</div>


<?php
include_once(G5_PATH.'/tail.php');
?>