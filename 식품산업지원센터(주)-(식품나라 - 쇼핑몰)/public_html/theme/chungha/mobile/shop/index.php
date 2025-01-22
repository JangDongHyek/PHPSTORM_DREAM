<?php
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
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


<!-- 신상품  -->  


				
<div id="idx_new">
	<div class="inr">
		<div class="idx_new_box">
			<h2><strong><span class="color">제품</span>소개</strong></h2>
			
		 <a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=10"><div class="mainbuttons">제품보기</div></a> 
		
					
			<?php
			$list = new item_list(); 
			$list->set_category('10', 1);
			$list->set_type(4);
			$list->set_list_mod(1); 
			$list->set_list_row(8);
			$list->set_img_size(310, 310); 
			$list->set_list_skin(G5_SHOP_SKIN_PATH.'/main.10.skin.php'); 
			$list->set_view('it_img', true); 
			//$list->set_view('it_id', true); 
			$list->set_view('it_name', true); 
			$list->set_view('it_basic', true); 
//            $list->set_view('it_cust_price', true); 
			$list->set_view('it_price', true); 
//            $list->set_view('it_icon', true); 
//			$list->set_view('sns', true); 
			echo $list->run(); 
			?>
		</div> 
	</div>
</div>

<div id="column_wrap">
	<div class="inr">
	
	<div class="left">
	<article>
		<div class="img_wrap">
			<img src="<?php echo G5_THEME_IMG_URL; ?>/main/cal01.png" alt="">
		</div>
		<div class="tit_wrap">
			<h1>
				<strong>장어 이런 분에게 <span class="color">추천</span>드립니다!</strong>
			</h1>
			<p>
				몸에도 좋고 맛도 좋고 건강식품 영양만점 장어<br>
				살아있는 바다장어를 통째로 고아낸 단백질 식품입니다.
			</p>
		</div>
		<ul class="recipe_wrap">
			<li>
				<span class="num">1</span>
				바쁜 아침 <strong>간편한 식사</strong>를 원하시는 분
			</li>
			<li>
				<span class="num">2</span>
				체력보충이 중요한 <strong>운동선수 & 수험생</strong>
			</li>
			<li>
				<span class="num">3</span>
				영양이 필요한 <strong>어르신</strong>
			</li>
			<li>
				<span class="num">4</span>
				수술 또는 출산 후 <strong>기력회복</strong>이 필요하신 분들
			</li>
	
		</ul>
	</article>
	</div>
	<div class="right">
		<article>
			<div class="img_wrap">
				<img src="<?php echo G5_THEME_IMG_URL; ?>/main/cal02.png" alt="">
			</div>
			<div class="tit_wrap">
				<h1>
					<strong>이제 <span class="color">들깨 장어탕</span>을 간편하게</strong>
				</h1>
				<p>
					영양적 가치가 높은 장어을 먹기위해 화학물질을 전혀 사용하지 않고<br>
					비린내 없이 특별하게 개발된 기술로 가공합니다.
				</p>
			</div>
			<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=10" class="btn_more">제품소개 보기</a>
		</article>
		
		<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company" class="banner info01">
			<div class="tit_wrap">
				<h1><strong>식품산업지원센터는 최선을 다합니다</strong></h1>
				<p>식품산업의 질적/양적 향상에 가장 필요한 정보와 기술을 제공합니다.</p>
			</div>
			<div class="more_view">회사소개 바로가기</div>
			<div class="ic">
				<img src="<?php echo G5_THEME_IMG_URL; ?>/common/ic_computer.svg">
			</div>
		</a>
		
		<a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="banner info02">
			<div class="tit_wrap">
				<h1><strong>주문상태가 궁금하다면?</strong></h1>
				<p>주문배송 조회를 해보세요</p>
			</div>
			<div class="more_view">주문배송조회 바로가기</div>
			<div class="ic">
				<img src="<?php echo G5_THEME_IMG_URL; ?>/common/ic_truck.svg">
			</div>
		</a>
	</div>
	
	</div>
</div>

<div class="reviewSlide" id="reviewSection">
	<div class="inr">
		<h2><strong class="bold">생생한 <span class="color">구</span>매후기</strong></h2>
	</div>
		<div class="swiper-container revw_slide">		
			<div class="swiper-wrapper">
                <?
                $g5_shop_item_use_model = new JlModel("g5_shop_item_use");
                $reviews = $g5_shop_item_use_model->where("is_confirm",1)->get(array(
                        "page" => 1,
                        "limit" => 5,
                ));

                $g5_shop_item_model = new JlModel("g5_shop_item");

                foreach($reviews['data'] as $r) {
                    $product = $g5_shop_item_model->where("it_id",$r['it_id'])->get()['data'][0];
                ?>
				<div class="swiper-slide">
					<div class="left">
						<p class="pname">
							<a href="<?php echo G5_URL; ?>/shop/item.php?it_id=<?=$r['it_id']?>">
							<?=$r['is_subject']?>
							</a>
						</p>
						<div class="price"><?=number_format($product['it_price'])?>원</div>
						<div class="t_box">
							<p><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=<?=$r['it_id']?>"><?=$r['is_content']?></a></p>
						</div>
						<p class="starBox"><span class="star_<?=$r['is_score']?>"></span><span><?=$r['is_score']?>.0</span></p>
						<p class="idBox">itfor***</p>
					</div>
					<div class="right imgBox">
						<img src="<?=G5_URL."/data/item/".$product['it_img1']?>" alt="">
					</div>
				</div>
                <?}?>
			</div>		
			
		</div>
</div>

<script>

		//REVIEW
	  var swiper = new Swiper(".revw_slide", {
			slidesPerView :3,
        	centeredSlides: true,
			spaceBetween: 70,
			loop:true,
			autoplay: {
				  delay: 6000,
				  disableOnInteraction: false,
			},
			 scrollbar: {
			  el: ".swiper-scrollbar",
			  hide: true,
			},

			breakpoints: {
			  768: {
				slidesPerView: 1,
			  },
			  1280: {
				slidesPerView: 2,
        		centeredSlides: true,
				spaceBetween: 20,
			  },
			},
	  });
</script>

<!--
<ul class="sns_wrap">
    <li><a href="tel:055-246-0849"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_call.png"></a></li>
    <li><a onclick="alert('준비중입니다');"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_kakao.png"></a></li>
    <li><a href="https://blog.naver.com/a110141" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_blog.png"></a></li>
    <li><a href="http://www.instagram.com/hestiagagu.gallery" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_insta.png"></a></li>
</ul>
-->


<div class="ft_info">
<div class="inr">
	<div id="newft">
<!--
		<div class="telBox">
			<h4>고객센터 및 상담문의</h4>
			<p class="telN">010-8514-5236</p>
			<p class="txt">평일,주말 AM09:00 ~ PM18:00</p>
		</div>
		<div class="accBox">
			<h4>입금계좌</h4>
				<div class="account">

				<p>농협은행 : <span class="accnum">307-0757-2378-71</span></p>
				</div>
				<span class="txt">예금주 : 헤스티아 가구 박준혁</span>

		</div>
-->
		<div class="notiBox">
			<h4>공지사항</h4>
			<!--  사진 최신글2 { -->
				<?php
				// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
				// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
				// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
				echo latest('theme/shop_basic','notice',  1, 50);
				?>
		</div>
	</div>
	<!-- /newft -->

</div>
</div>

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>