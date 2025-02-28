<? 
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_list";
$pid = "project_list";
?>
    <div id="nav_area">
        <head-category-new category1_idx="<?=$_GET['category1_idx']?>" category2_idx="<?=$_GET['category2_idx']?>"></head-category-new>
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
    <project-list category1_idx="<?=$_GET['category1_idx']?>" category2_idx="<?=$_GET['category2_idx']?>"
                  mb_no="<?=$member['mb_no']?>"
    ></project-list>
</div>

<?
$jl->vueLoad("nav_area");
$jl->vueLoad("area_project",["summernote"]);
$jl->componentLoad("project");
$jl->componentLoad("external");
$jl->componentLoad("inc");
$jl->componentLoad("item");
?>

<?php
include_once('./_tail.php');
?>