<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');
include_once(G5_THEME_MOBILE_PATH.'/head.php');
include_once("../../../class/Lib.php");

$jl = new JL();
//신규 재능 상품
$sql = "select * from new_item order by i_idx desc limit 8";
$new_result = sql_query($sql);

$big_ctg = ctg_list(0);
?>

<div id="wrapper">

	<div class="area_visual">
		<div class="visual_wrap">
			<div class="area_obj"><img src="<?php echo G5_IMG_URL ?>/app/main_obj.png"></div>
			<div class="area_txt">
				<h3>다양한 분야의 방송 <br>전문가를 확인해보세요!</h3>
				<span>고객님께 딱 맞는 전문가들이 기다리고 있습니다.</span>
			</div>	
		</div>			
	</div>

	<div id="content">
		<div class="inr cate">
                    <ul id="cate_list" class="v2">
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=20">
                                <div class="area_icon"></div>
                                <h3>영상·사진·음향 제작</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=21">
                                <div class="area_icon"></div>
                                <h3>방송 디자인·편집</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=22">
                                <div class="area_icon"></div>
                                <h3>방송마케팅</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=23">
                                <div class="area_icon"></div>
                                <h3>방송·배우·연기</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=24">
                                <div class="area_icon"></div>
                                <h3>모델</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=25">
                                <div class="area_icon"></div>
                                <h3>방송 스태프</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=26">
                                <div class="area_icon"></div>
                                <h3>방송·시나리오·작가</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=27">
                                <div class="area_icon"></div>
                                <h3>뷰티·패션</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=28">
                                <div class="area_icon"></div>
                                <h3>MC·행사·이벤트</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=29">
                                <div class="area_icon"></div>
                                <h3>레슨</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=30">
                                <div class="area_icon"></div>
                                <h3>심리상담</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=31">
                                <div class="area_icon"></div>
                                <h3>기타</h3>
                            </a>
                        </li>
                    </ul>
                <!--<ul id="cate_list" class="v2">
                    <?php /*for ($i = 0; $i< count($big_ctg); $i++){
                        if ($big_ctg[$i]['c_idx'] == 1){
                            $tag = '<i class="fa-duotone fa-tv-retro"></i><i class="fa-light fa-tv-retro"></i>';
                        }else if ($big_ctg[$i]['c_idx'] == 2){
                            $tag = '<i class="fa-duotone fa-chalkboard-user"></i><i class="fa-light fa-chalkboard-user"></i>';
                        }else if ($big_ctg[$i]['c_idx'] == 3){
                            $tag = '<i class="fa-duotone fa-money-check-dollar-pen"></i><i class="fa-light fa-money-check-dollar-pen"></i>';
                        }*/?>
                        <li>
                            <a href="<?php /*echo G5_BBS_URL; */?>/item_list.php?ctg=<?/*=$big_ctg[$i]["c_idx"]*/?>">
                                <div class="area_icon"></div>
                                <h3><?/*=$big_ctg[$i]["c_name"]*/?></h3>
                            </a>
                            <div class="small_cate">
                                <?php
/*                                $small_ctg = ctg_list($big_ctg[$i]["c_idx"]);
                                for ($a = 0; $a< count($small_ctg); $a++){ */?>
                                    <a href="<?php /*echo G5_BBS_URL; */?>/item_list.php?ctg=<?/*=$small_ctg[$a]["c_idx"]*/?>">
                                        <?/*=$small_ctg[$a]["c_name"]*/?>
                                    </a>
                                <?php /*} */?>
                            </div>
                        </li>
                    <?php /*} */?>
                </ul>-->
        </div>
		<div class="inr">
			<section>
				<h3 class="title">실시간 인기 재능 상품</h3>
				<ul id="product_list">
					<li>
						<i class="heart on"></i>
						<a href="">
							<div class="area_img">
								<img src="<?php echo G5_IMG_URL ?>/app/img_product01.jpg">
							</div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
					<li>
						<i class="heart"></i>
						<a href="">
							<div class="area_img">
								<img src="<?php echo G5_IMG_URL ?>/app/img_product02.jpg">
							</div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
					<li>
						<i class="heart"></i>
						<a href="">
							<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/app/img_product03.jpg"></div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
					<li>
						<i class="heart"></i>
						<a href="">
							<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/app/img_product04.jpg"></div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
					<li>
						<i class="heart on"></i>
						<a href="">
							<div class="area_img">
								<img src="<?php echo G5_IMG_URL ?>/app/img_product01.jpg">
							</div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
					<li>
						<i class="heart"></i>
						<a href="">
							<div class="area_img">
								<img src="<?php echo G5_IMG_URL ?>/app/img_product02.jpg">
							</div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
					<li>
						<i class="heart"></i>
						<a href="">
							<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/app/img_product03.jpg"></div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
					<li>
						<i class="heart"></i>
						<a href="">
							<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/app/img_product04.jpg"></div>
							<div class="area_txt">
								<span>스튜디오오늘</span><!-- 업체명 -->
								<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
								<div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
								<div class="price">200,000원 ~</div> <!-- 가격 -->
							</div>
						</a>
					</li>
				</ul>
			</section>

			<?/*<section id="portfolio_area">
				<h3 class="title">인기 전문인을 찾아보세요</h3>
			
				<!-- Swiper -->
				<div class="swiper mySwiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">		
							<div class="area_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_logo01.jpg"></div>
							<div class="area_txt">
								<h4>스튜디오오늘</h4>
								<span>20회 작업</span>
								<div class="star"><i></i><em>5.0(5개)</em></div> <!-- 별점 -->
							</div>
							<a href="">포트폴리오 보기</a>
						</div>
						<div class="swiper-slide">		
							<div class="area_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_logo02.jpg"></div>
							<div class="area_txt">
								<h4>비주얼맵스</h4>
								<span>20회 작업</span>
								<div class="star"><i></i><em>5.0(5개)</em></div> <!-- 별점 -->
							</div>
							<a href="">포트폴리오 보기</a>
						</div>
						<div class="swiper-slide">		
							<div class="area_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_logo03.jpg"></div>
							<div class="area_txt">
								<h4>THE BETTER</h4>
								<span>20회 작업</span>
								<div class="star"><i></i><em>5.0(5개)</em></div> <!-- 별점 -->
							</div>
							<a href="">포트폴리오 보기</a>
						</div>
						<div class="swiper-slide">		
							<div class="area_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_logo04.jpg"></div>
							<div class="area_txt">
								<h4>구구필름</h4>
								<span>20회 작업</span>
								<div class="star"><i></i><em>5.0(5개)</em></div> <!-- 별점 -->
							</div>
							<a href="">포트폴리오 보기</a>
						</div>
						<div class="swiper-slide">
							<div class="area_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_logo01.jpg"></div>
							<div class="area_txt">
								<h4>스튜디오오늘</h4>
								<span>20회 작업</span>
								<div class="star"><i></i><em>5.0(5개)</em></div> <!-- 별점 -->
							</div>
							<a href="">포트폴리오 보기</a>
						</div>
					</div>
				</div>
		

			</section>*/?>

            <product-main-list member_idx="<?=$member['mb_no']?>"></product-main-list>
                <section>
                    <h3 class="title">프로젝트 의뢰</h3>
                    <div id="area_bn2" onclick="location.href='<?php echo G5_BBS_URL ?>/contest_list.php'">

                        <div class="txt">
                            <span>방송과 사람들에서</span>
                            <h2>프로젝트 의뢰 맡겨보세요!</h2>
                        </div>


                    </div>
                </section>


			<!--<div id="area_bn">

				<div class="obj"><img src="<?php /*echo G5_THEME_IMG_URL */?>/app/bn_obj.png"></div>
				<div class="txt">
					<span>딱 맞는 영상 제작사, 빠르게 찾고 싶다면</span>
					<h2><i class="txt_color01">방송과사람</i>에서 <i class="txt_color02">해결</i>하세요!</h2>
				</div>
				
			
			</div>-->
		</div>	

		
		
	</div>
</div>

<?php
$jl->vueLoad("content");
include_once($jl->ROOT."/component/product/product-main-list.php");
include_once(G5_PATH.'/tail.php');
?>

<script>
  var swiper = new Swiper(".mainSwiper", {
	slidesPerView: 1,
	navigation: {
	  nextEl: ".swiper-button-next",
	  prevEl: ".swiper-button-prev",
	},
  });

  var swiper = new Swiper(".mySwiper", {
		slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
          //el: ".swiper-pagination",
          clickable: true,
        },
		breakpoints: {
		950: {
			slidesPerView: 4,
			spaceBetween: 25,
		},
		768: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		550: {
			slidesPerView: 2,
			spaceBetween: 15,
		},
		400: {
			slidesPerView: 1,
			spaceBetween: 10,
		},
	}
  });




</script>