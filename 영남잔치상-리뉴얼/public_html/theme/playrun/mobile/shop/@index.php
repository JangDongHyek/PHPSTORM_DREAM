<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

  
<!-- 메인 배너 --> 
<div id="main_box">
    <div id="mainbanner">
        <div class="container"><?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?></div>
    </div>
</div>
<!--#main_box-->

<div id="area_brand">
    <div class="inr">
        <h2>브랜드</h2>
		<ul class="list_brand">
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=10">헤스티아</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=20">레몬트리</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=30">팀버가든</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=40">양성국 가구</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=50">더클라우스</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=60">리즈가구</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=70">슬리핑 덕</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=80">안토니오소파</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=90">코알라침대</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=a0">더목가구</a></li>
			<li><a href="<?php echo G5_MSHOP_URL; ?>/list.php?ca_id=b0">우드슬랩</a></li>
		</ul>
    </div>
</div>

<div id="area_brand">
    <div class="inr">
        <h2>카테고리</h2>
		<ul class="list_category">
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate01.jpg"></div>
					<h3>이층침대, 벙커침대</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate02.jpg"></div>
					<h3>키즈가구</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate03.jpg"></div>
					<h3>쇼파</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate04.jpg"></div>
					<h3>침대프레임</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate05.jpg"></div>
					<h3>식탁</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate06.jpg"></div>
					<h3>거실장</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate07.jpg"></div>
					<h3>소파테이블</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate08.jpg"></div>
					<h3>장식장</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate09.jpg"></div>
					<h3>서랍장</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate10.jpg"></div>
					<h3>장롱,시스템장</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate11.jpg"></div>
					<h3>서재가구</h3>
				</a>
			</li>
			<li>	
				<a href="">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_cate12.jpg"></div>
					<h3>주문제작 싱크대</h3>
				</a>
			</li>
		</ul>
    </div>
</div>

<!--
<div id="area_cate_product">
	<div class="inr">
	
		<ul class="list_cate">
			<li>
				<div class="cate">이층침대, 벙커침대</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1010', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">키즈가구</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1020', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">쇼파</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1030', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">침대프레임</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1040', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">식탁</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1050', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">거실장</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1060', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">소파테이블</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1070', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">장식장</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1080', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">서랍장</div>
				<?php
					$list = new item_list(); 
					$list->set_category('1090', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">장롱,시스템장</div>
				<?php
					$list = new item_list(); 
					$list->set_category('10a0', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">서재가구</div>
				</*?php
					$list = new item_list(); 
					$list->set_category('10b0', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				?>
			</li>
			<li>
				<div class="cate">주문제작 싱크대</div>
				</*?php
					$list = new item_list(); 
					$list->set_category('10c0', 2);
					$list->set_list_mod(1); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.30.skin.php'); 
					$list->set_view('it_img', true); 
					echo $list->run(); 
				*/?>
			</li>
		</ul>
	</div>
</div>
-->
<div id="joop_box_wrap" class="box1">  

    <!--추천상품-->
     <div id="idx_best">
        <div class="inr">
            <div style="position:relative">
                <h2 class="h2_st">가장 많이 팔리는 <em class="bold">인기상품</em></h2>
				<div class="swiper-container hotSlide">                         
					<?php
					$list = new item_list(); 
					$list->set_type(4);
					$list->set_list_mod(8); 
					$list->set_list_row(1); 
					$list->set_img_size(450, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.20.skin.php'); 
					//$list->set_view('it_icon', true); 
					$list->set_view('it_img', true); 
					$list->set_view('it_name', true); 
					$list->set_view('it_price', true); 
					//$list->set_view('sns', true); 
					echo $list->run(); 
					?>
				</div>   
				
				<!--
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
				-->

            </div> 
        </div>
    </div>

</div><!--#joop_box_wrap-->
	<div class="inr bn">
		<div id="brand_bn2">
			<div class="txt_wrap">
				<div class="area_txt">
					<h3><em class="bold">자연의 향기</em>가 나는 <em class="bold">원목가구</em></h3>
					<span>진심어린 정성을 담아 만들겠습니다.</span>
				</div>
				<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/bn_obj.png"></div>
			</div>
        </div>
    </div> 
    
    
    
	<?php ?>
	<div id="idx_container">

	   <!-- 추천 상품  -->  
		<div id="idx_rec">
			<div class="inr">
				<div class="idx_rec_box">
					<h2>이 상품은 어떠세요?</h2>
					<?php
					$list = new item_list(); 
					$list->set_type(2);
					$list->set_list_mod(8); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php'); 
					$list->set_view('it_img', true); 
					//$list->set_view('it_id', true); 
					$list->set_view('it_name', true); 
					//$list->set_view('it_basic', true); 
					//$list->set_view('it_cust_price', true); 
					$list->set_view('it_price', true); 
					$list->set_view('it_icon', true); 
					//$list->set_view('sns', true); 
					echo $list->run(); 
					?>
				</div> 
			</div>
		</div>

		<!-- 신상품  -->  
		<div id="idx_new">
			<div class="inr">
				<div class="idx_new_box">
					<h2>트린디한 <em class="bold">신제품</em></h2>
					<?php
					$list = new item_list(); 
					$list->set_type(3);
					$list->set_list_mod(8); 
					$list->set_list_row(1); 
					$list->set_img_size(410, 350); 
					$list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php'); 
					$list->set_view('it_img', true); 
					//$list->set_view('it_id', true); 
					$list->set_view('it_name', true); 
					//$list->set_view('it_basic', true); 
					//$list->set_view('it_cust_price', true); 
					$list->set_view('it_price', true); 
					$list->set_view('it_icon', true); 
					//$list->set_view('sns', true); 
					echo $list->run(); 
					?>
				</div> 
			</div>
		</div>
		
	</div>  <!--#idx_container-->  <?php ?>



    
<div class="reviewSlide">
	<p class="title">REAL REVIEW</p>
	<h3>생생한 <em class="bold">이용후기</em></h3>
	<div class="inr">
		<div class="swiper-container revw_slide">		
			<div class="swiper-wrapper">		
				<div class="swiper-slide">
					<p class="pname"><a href="#">헤리티지 원목 침대</a></p>
					<span class="imgBox"><img src="http://itforone.com/~hestiagagu/data/item/1637711185/thumb-img_product08_410x350.jpg" alt=""></span>
					<p class="starBox"><span class="star_4"></span><span>4.0</span></p>
					<div class="t_box">
						<p><a href="#">주문하고 배송도 빠르게 와서 넘 좋았구요. 직접 보기전엔 나무가시 같은게 튀어나온게 많을까봐 걱정했는데 진짜튼튼하고 가시같은 것도 없게..</a></p>
					</div>
					<p class="idBox">abcd12***</p>
				</div>		
				<div class="swiper-slide">
					<p class="pname"><a href="#">헤리티지 원목 침대</a></p>
					<span class="imgBox"><img src="http://itforone.com/~hestiagagu/data/item/1637711185/thumb-img_product08_410x350.jpg" alt=""></span>
					<p class="starBox"><span class="star_4"></span><span>4.0</span></p>
					<div class="t_box">
						<p><a href="#">주문하고 배송도 빠르게 와서 넘 좋았구요. 직접 보기전엔 나무가시 같은게 튀어나온게 많을까봐 걱정했는데 진짜튼튼하고 가시같은 것도 없게..</a></p>
					</div>
					<p class="idBox">abcd12***</p>
				</div>
				<div class="swiper-slide">
					<p class="pname"><a href="#">헤리티지 원목 침대</a></p>
					<span class="imgBox"><img src="http://itforone.com/~hestiagagu/data/item/1637711185/thumb-img_product08_410x350.jpg" alt=""></span>
					<p class="starBox"><span class="star_4"></span><span>4.0</span></p>
					<div class="t_box">
						<p><a href="#">주문하고 배송도 빠르게 와서 넘 좋았구요. 직접 보기전엔 나무가시 같은게 튀어나온게 많을까봐 걱정했는데 진짜튼튼하고 가시같은 것도 없게..</a></p>
					</div>
					<p class="idBox">abcd12***</p>
				</div>
				<div class="swiper-slide">
					<p class="pname"><a href="#">헤리티지 원목 침대</a></p>
					<span class="imgBox"><img src="http://itforone.com/~hestiagagu/data/item/1637711185/thumb-img_product08_410x350.jpg" alt=""></span>
					<p class="starBox"><span class="star_4"></span><span>4.0</span></p>
					<div class="t_box">
						<p><a href="#">주문하고 배송도 빠르게 와서 넘 좋았구요. 직접 보기전엔 나무가시 같은게 튀어나온게 많을까봐 걱정했는데 진짜튼튼하고 가시같은 것도 없게..</a></p>
					</div>
					<p class="idBox">abcd12***</p>
				</div>
			</div>		
			
		</div>
		<div class="idx_best_box">
			<div class="swiper-button-next2"></div>
			<div class="swiper-button-prev2"></div>
		</div>		
	</div>
</div>







<script>
		//HOT ITEM
	  var swiper = new Swiper(".hotSlide", {
			spaceBetween: 40,
			loop:true,
			autoplay: {
				  delay: 2500,
				  disableOnInteraction: false,
			},
			slidesPerView :'3',
			navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev"

		},
			breakpoints: {
			  450: {
				spaceBetween: 0,
				slidesPerView: 1,

			  },
			  550: {
				slidesPerView: 2,
				spaceBetween: 10,
			  },
			  768: {
				slidesPerView: 2,
				spaceBetween: 20,
			  },
			  1024: {
				slidesPerView: 2,
				spaceBetween: 30,
			  },
			  1200: {
				slidesPerView: 3,
				spaceBetween: 30,
			  },
			},
	  });


	//REVIEW
	  var swiper = new Swiper(".revw_slide", {
			spaceBetween: 30,
			loop:true,
			autoplay: {
				  delay: 2500,
				  disableOnInteraction: false,
			},
			slidesPerView :'3',
			navigation: {
			nextEl: ".swiper-button-next2",
			prevEl: ".swiper-button-prev2"

		},

			breakpoints: {
			  640: {
				slidesPerView: 1,
				spaceBetween: 20,
			  },
			  1200: {
				slidesPerView: 2,
				spaceBetween: 20,
			  },
			},
	  });


</script>


<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>