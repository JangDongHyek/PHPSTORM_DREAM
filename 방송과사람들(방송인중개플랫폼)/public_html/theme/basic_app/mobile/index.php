<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
include_once(G5_THEME_MOBILE_PATH.'/head.php');


//신규 재능 상품
$sql = "select * from new_item order by i_idx desc limit 8";
$new_result = sql_query($sql);

$pid = "index_mobile";
$big_ctg = ctg_list(0);
?>

<div id="wrapper">


    <!--메인 상단배너-->
    <div class="area_visual">
        <div class="visual_wrap">
            <div class="swiper visualSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="area_obj"><img src="<?php echo G5_IMG_URL ?>/app/main_obj.png"></div>
                        <div class="area_txt">
                            <h3>다양한 분야의 방송 <br>전문가를 확인해보세요!</h3>
                            <span>고객님께 딱 맞는 전문가들이 기다리고 있습니다.</span>
                        </div>
                    </div>
                    <div class="swiper-slide v2">
                        <div class="area_obj"><img src="<?php echo G5_IMG_URL ?>/app/main_obj2.png"></div>
                        <div class="area_txt">
                            <h3>다양한 분야의 방송 <br>전문가를 확인해보세요!</h3>
                            <span>고객님께 딱 맞는 전문가들이 기다리고 있습니다.</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_obj"><img src="<?php echo G5_IMG_URL ?>/app/main_obj3.png"></div>
                        <div class="area_txt">
                            <h3>다양한 분야의 방송 <br>전문가를 확인해보세요!</h3>
                            <span>고객님께 딱 맞는 전문가들이 기다리고 있습니다.</span>
                        </div>
                    </div>
                    <!--div class="swiper-slide">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/app/visual01.jpg">
                    </div-->
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <script>
        var swiper = new Swiper('.visualSwiper', {
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
    <!--//메인 상단배너-->
	<div id="content">
		<div class="inr cate">
                    <ul id="cate_list" class="v2">
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=20">
                                <div class="area_icon"></div>
                                <h3>영상·사진·음향 제작</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=21">
                                <div class="area_icon"></div>
                                <h3>방송 디자인·편집</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=22">
                                <div class="area_icon"></div>
                                <h3>방송마케팅</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=23">
                                <div class="area_icon"></div>
                                <h3>방송·배우·연기</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=24">
                                <div class="area_icon"></div>
                                <h3>모델</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=25">
                                <div class="area_icon"></div>
                                <h3>방송 스태프</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=26">
                                <div class="area_icon"></div>
                                <h3>방송·시나리오·작가</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=27">
                                <div class="area_icon"></div>
                                <h3>뷰티·패션</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=28">
                                <div class="area_icon"></div>
                                <h3>MC·행사·이벤트</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=29">
                                <div class="area_icon"></div>
                                <h3>레슨</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=30">
                                <div class="area_icon"></div>
                                <h3>심리상담</h3>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_list.php?category1_idx=31">
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
            <product-main-list member_idx="<?=$member['mb_no']?>" order_by_key="order_by_desc" order_by_value="review_score" title="인기 재능 상품"></product-main-list>

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


            <product-main-list member_idx="<?=$member['mb_no']?>" order_by_key="order_by_desc" order_by_value="insert_date" title="신규 재능 상품"></product-main-list>

                <section>
                    <h3 class="title">방송과 사람들 전문가 순위</h3>

                    <div class="ranking r01">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#tab1" data-toggle="tab">배우·모델</a></li>
                            <li><a href="#tab2" data-toggle="tab">방송·스태프</a></li>
                            <li><a href="#tab3" data-toggle="tab">레슨</a></li>
                        </ul>

                        <div class="tab-content">
                            <main-product-ranking :categories="[23,24]" component_id="tab1" class="active"></main-product-ranking>
                            <main-product-ranking :categories="[25]" component_id="tab2"></main-product-ranking>
                            <main-product-ranking :categories="[29]" component_id="tab3"></main-product-ranking>
                        </div>
                    </div>

                    <div class="ranking r02">
                        <ul class="nav nav-tabs" id="myTab2">
                            <li class="active"><a href="#tab4" data-toggle="tab">영상·디자인</a></li>
                            <li><a href="#tab5" data-toggle="tab">방송·마케팅</a></li>
                            <li><a href="#tab6" data-toggle="tab">MC·행사·이벤트</a></li>
                        </ul>

                        <div class="tab-content">
                            <main-product-ranking2 :categories="[20,21]" component_id="tab4" class="active"></main-product-ranking2>
                            <main-product-ranking2 :categories="[22]" component_id="tab5"></main-product-ranking2>
                            <main-product-ranking2 :categories="[28]" component_id="tab6"></main-product-ranking2>

                        </div>
                    </div>

                </section>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const ul = document.querySelector('.r02 .tab-content ul');

                        // Scroll every 3 seconds
                        setInterval(() => {
                            ul.scrollBy({
                                top: 0,
                                left: 200, // Change this value based on your item width
                                behavior: 'smooth'
                            });
                        }, 3000);
                    });
                </script>





                <section>
                    <h3 class="title">프로젝트 의뢰</h3>
                    <div id="area_bn2" onclick="location.href='<?php echo G5_BBS_URL ?>/contest_list.php'">
                        <div class="txt">
                            <span>방송과 사람들</span>
                            <h2><strong>프로젝트 의뢰</strong> 맡겨보세요!</h2>
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

<!--온보딩 페이지 작업-->
<?php if (!$is_member) { ?>

    <?php if($_SERVER['REMOTE_ADDR']=="112.160.220.208"){ ?>

    <?php } else {?>
    <div id="onboarding">
        <div class="onboarding">
            <div class="onboarding-container">
                <div class="swiper onboardingSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="page">
                                <h1><span>01</span>전문가 찾기</h1>
                                <p>다양한 방송 전문가들을 확인하고, <br>간편하게 의뢰해 보세요!</p>
                                <div class="img">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/onboarding_img01.png" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="page">
                                <h1><span>02</span>전문가 등록</h1>
                                <p>방송전문가로서 나의 재능을 판매하고, <br>커리어를 쌓아가세요!</p>
                                <div class="img">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/onboarding_img02.png" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="page">
                                <h1><span>03</span>프로젝트 의뢰</h1>
                                <p>방송전문가로서 나의 재능을 판매하고, <br>커리어를 쌓아가세요!</p>
                                <div class="img">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/onboarding_img03.png" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="page">
                                <h1><span>04</span>포인트 증정</h1>
                                <p>방송과사람들 신규 가입하신 모든 분들께, <br><strong>50,000포인트</strong>를 드립니다!</p>
                                <div class="img">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/onboarding_img04.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="navigation">
                <button onclick="location.href='<?php echo G5_BBS_URL ?>/login.php'">로그인</button>
                <a class="onboarding_close">홈 화면 바로가기</a>
            </div>
        </div>
    </div>
    <?php }?>
<?php } ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper(".onboardingSwiper", {
            pagination: {
                el: ".swiper-pagination",
            },
            on: {
                slideChange: function () {
                    const closeButton = document.querySelector(".onboarding_close");
                    const navigation = document.querySelector(".navigation");

                    // Hide the navigation on all slides first
                    navigation.style.display = "none";

                    // Show the navigation only on the last slide
                    if (swiper.realIndex === swiper.slides.length - 1) {
                        navigation.style.display = "block";
                    }
                }
            }
        });

        const closeButton = document.querySelector(".onboarding_close");
        const onboardingElement = document.getElementById("onboarding");

        // Initial check when the page loads to hide or show the navigation
        if (swiper.realIndex === swiper.slides.length - 1) {
            document.querySelector(".navigation").style.display = "block";
        } else {
            document.querySelector(".navigation").style.display = "none";
        }

        closeButton.addEventListener("click", function() {
            onboardingElement.style.display = "none";
        });
    });
</script>


<?php
$jl->vueLoad("content");
include_once($jl->ROOT."/component/product/product-main-list.php");
include_once($jl->ROOT."/component/main/main-product-ranking.php");
include_once($jl->ROOT."/component/main/main-product-ranking2.php");
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