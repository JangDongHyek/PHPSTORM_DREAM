<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

        </div><!--//inr-->
    </div><!--//container-->
</div><!--//wrapper-->

<!-- } 콘텐츠 끝 -->

<hr>
    <section class="area_site">
        <div class="inr">
            <div class="flex">
                <div class="title">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site_icon.png"><strong>관련사이트</strong>
                    <div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
                <div class="swiper siteSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site01.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site02.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site03.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site04.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site05.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site06.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site01.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site02.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site03.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site04.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site05.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_site06.jpg"></div>
                    </div>

                </div>
            </div>
            <script>
                var swiper = new Swiper(".siteSwiper", {
                    slidesPerView: 2,
                    spaceBetween: 30,
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        1400: {
                            slidesPerView: 6,
                            spaceBetween: 20,
                        },
                        992: {
                            slidesPerView: 5,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 15,
                        },
                        550: {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        },
                    },

                });
            </script>
        </div>
    </section>

	<div id="footer">
        <div class="ft_top">
            <ul class="ft_menu">
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=fsw_company">FSW소개</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=fsw_product">제품안내</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=fsw_faq">고객지원</a></li>
            </ul>
            <div class="ft_btn">
                <a class="ka" href="javascript:alert('준비중입니다.')"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_icon_ch.svg"> 카카오 채널톡</a>
            </div>
        </div>
        <div class="info">
            <div class="logo">
                <a class="white" href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" alt="<?php echo $config['cf_title']; ?>"></a>
            </div><!--#logo-->
            <div>
                <address>
                    <h1><?php echo $config['cf_title']; ?></h1>
                    <div>
                        <p><?php echo $config['cf_2_subj']; ?></p>
                        <span><?php echo $config['cf_2']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_3_subj']; ?></p>
                        <span><?php echo $config['cf_3']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_4_subj']; ?></p>
                        <span><?php echo $config['cf_4']; ?></span>
                    </div>
                    <br>
                    <div class="first">
                        <p><?php echo $config['cf_5_subj']; ?></p>
                        <span><?php echo $config['cf_5']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_6_subj']; ?></p>
                        <span><?php echo $config['cf_6']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_7_subj']; ?></p>
                        <span><?php echo $config['cf_7']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_8_subj']; ?></p>
                        <span><?php echo $config['cf_8']; ?></span>
                    </div>
                </address>
                <div class="copy">
                    <p>COPYRIGHT(C) 2023 <strong>CMD TECHNOLOGY.</strong> ALL RIGHTS RESERVED.
                        <?php if ($is_member) {  ?>
                            <?php if ($is_admin) {  ?>
                            <?php }  ?>
                        <a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fa-solid fa-unlock-alt"></i></a>
                        <?php } else {  ?>
                        <a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fa-solid fa-lock-alt"></i></a>
                        <?php } ?>
                    </p>

                </div>
            </div>
            <!--<div class="scrolltop">
                <a href="#hd" class="goHd">
                    <i class="icon"></i>
                    <i class="txt">TOP</i>
                </a>
            </div>-->
        </div>
	</div><!--#footer-->

    

    




<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>