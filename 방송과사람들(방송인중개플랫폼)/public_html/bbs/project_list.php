<? 
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_list";
$pid = "project_list";
?>
    <div id="nav_area">
        <nav id="gnb">
            <h2>메인메뉴</h2>
            <ul id="gnb_1dul">
                <li class="gnb_1dli all_menu">
                    <a class="gnb_1da">
                        <i class="fa-light fa-bars"></i> 전체메뉴
                    </a>
                    <ul class="gnb_2dul">
                        <li class="gnb_2dli">
                            <a class="gnb_2da">프로젝트</a>
                            <div class="gnb_2dli_list" style="display: none;">
                                <ul class="gnb_2dul ver02" style="display: none;">
                                    <li class="gnb_2dli"><a class="gnb_2da">전체 프로젝트</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <span class="main-category">프로젝트</span>
            <div class="menu-container">
                <div id="target_scroll" class="menu-wrapper">
                    <ul id="gnb_1dul" class="menu">
                        <li class="gnb_1dli single_menu">
                            <a class="gnb_1da">전체<span></span></a>
                        </li>
                    </ul>
                </div>
                <button class="scroll-button left-button end">
                    <i class="fa-light fa-angle-left"></i>
                </button>
                <button class="scroll-button right-button">
                    <i class="fa-light fa-angle-right"></i>
                </button>
            </div>
        </nav>
    </div>

    <!--서브 상단 배너-->
<div class="swiper subSwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/visual01.jpg">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/visual01.jpg">
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>
<script>
    var swiper = new Swiper('.subSwiper', {
        spaceBetween: 0,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
<!--//서브 상단 배너-->

<div id="area_project">
    <project-list></project-list>
</div>

<?
$jl->vueLoad("area_project",["summernote"]);
$jl->componentLoad("project");
$jl->componentLoad("external");
?>

<?php
include_once('./_tail.php');
?>