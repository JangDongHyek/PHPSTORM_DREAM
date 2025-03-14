<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");

$category_model = new JlModel("category");
if($_GET['category2_idx']) $target_category = $category_model->where("idx",$_GET['category2_idx'])->get()['data'][0];
else $target_category = $category_model->where("idx",$_GET['category1_idx'])->get()['data'][0];

$pid = $target_category['name'];
$g5['title'] = $target_category['name'];
include_once('./_head.php');
?>
<div id="app2">
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

<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="sort_list_mobile">
						<li class="active">최신순</li>
						<li>추천순</li>
						<li>별점순</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

    <div id="app">

        <div id="area_product">
            <product-list category1_idx="<?=$_GET['category1_idx']?>" category2_idx="<?=$_GET['category2_idx']?>" member_idx="<?=$member['mb_no']?>"></product-list>


        </div>
    </div>


    <div class="inr">
        <!--서브 하단 배너-->
        <div class="swiper subFtSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/visual01.jpg">
                </div>
            </div>
        </div>
        <!--//서브 상단 배너-->
    </div>
<?php
$jl->vueLoad("app2");
$jl->vueLoad("app");
$jl->includeDir("/component/product");
$jl->componentLoad("/inc");
include_once($jl->ROOT."/component/paging2-component.php");

include_once('./_tail.php');
?>