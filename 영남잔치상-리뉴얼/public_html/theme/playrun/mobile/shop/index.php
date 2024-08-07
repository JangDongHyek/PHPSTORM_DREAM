<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

    <style>
        .sct_10 .sct_img {
            height: 100px;
        }
        @media (max-width: 980px){

            .sct_10 .sct_img {
                width: 100%;
                /*height: 80px;*/
            }
            img.mbanner{ width:100%}
        }
    </style>



    <section class="newSection flexBox pcVer">
        <div id="area_brand" class="leftBox">
            <?php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
        </div>

        <div><img src="<?php echo G5_THEME_IMG_URL; ?>/main/m_banner01.jpg" alt="" class="mbanner"></div>

        <!--<div class="tel01">
            <p class="t">영남잔치상 대표전화</p>
            <div class="num"><span class="grn">1688</span>.7892</div>
            <p>FAX : 051-528-0225</p>
            <p>youngnam784@naver.com</p>
        </div>-->
        <div class="mr_banner"><img src="<?php echo G5_THEME_IMG_URL ?>/r_banner/01.png" alt=""></div>
    </section>
    <section class="newSection flexBox mainVer">
        <div class="leftBox">
            <div id="left_menu">
                <p class="tit">상품목록</p>
                <?php
                $sql="select * from g5_shop_category where length(ca_id)='2' and ca_id!='e0'  order by ca_order asc";
                $result=sql_query($sql);

                ?>
                <ul>
                    <?php
                    for($i=0;$row=sql_fetch_array($result);$i++){
                        ?>
                        <li><a href="<?php echo G5_SHOP_URL?>/list.php?ca_id=<?php echo $row[ca_id]?>"><?php echo $row[ca_name]?></a></li>
                    <?php }?>
                    <!--<li><a href="#Link">명절차례상</a></li>
                    <li><a href="#Link">시제음식</a></li>
                    <li class="line"><a href="#Link">추가/맞춤음식</a></li>
                    <li><a href="#Link">고사음식</a></li>
                    <li><a href="#Link">뒷풀이음식</a></li>
                    <li><a href="#Link">행사대행</a></li>
                    <li class="line"><a href="#Link">행사용품</a></li>
                    <li><a href="#Link">이바지음식</a></li>
                    <li><a href="#Link">집들이음식</a></li>
                    <li><a href="#Link">행사도시락</a></li>
                    <li class="line"><a href="#Link">출장뷔페</a></li>-->
                </ul>
            </div>
            <!-- /left_menu -->
            <div class="left_latest">
                <div class="latest_box ver1">
                    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gall01" class="tit">고사 행사갤러리</a>
                    <?php
                    echo latest('theme/gallery', 'gall01', 10, 25);
                    ?>

                </div>
                <div class="latest_box ver2">
                    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gall02" class="tit">잔치음식 갤러리</a>
                    <?php
                    echo latest('theme/gallery', 'gall02', 10, 25);
                    ?>

                </div>
                <div class="latest_box ver3">
                    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=review" class="tit">제사후기 갤러리</a>
                    <?php
                    echo latest('theme/gallery', 'review', 10, 25);
                    ?>
                </div>

                <!--<div class="latest_box ver3">
				<a href="<?php /*echo G5_BBS_URL */?>/board.php?bo_table=qa" >
					<p class="tit">온라인 견적의뢰</p>
					<p class="txt">미리 예상금액을 산출하고<br>싶으시면 온라인 문의로<br>견적을 받아보세요</p>
				</a>
			</div>-->
                <div class="latest_box ver4">
                    <p class="tit">영남잔치상<span>BLOG</span></p>
                    <p class="txt">구매후기 & 포트폴리오<br>데일리 이벤트를 확인하세요</p>
                    <a href="https://blog.naver.com/youngnam784" title='영남잔치상 블로그 바로가기' target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/right_blog.png" alt=""></a>
                </div>
            </div>
            <!-- /left_latest -->
        </div>
        <!-- /leftBox -->
        <div class="mainBox">
            <dl class="m_menu">
                <dd>
                    <?php if ($is_member) { ?>
                        <a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a>
                    <?php } else { ?>
                        <a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a>
                    <?php } ?>
                </dd>
                <dd>
                    <?php if ($is_member) { ?>
                        <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"> 정보수정</a>
                    <?php } else { ?>
                        <a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a>
                    <?php } ?>
                </dd>
                <dd>
                    <a href="<?php echo G5_SHOP_URL ?>/mypage.php">마이페이지</a>
                </dd>
                <dd onclick="pro_open();" class="btn_pro">
                    <a onclick="pro_open();" class="btn_pro">최근본상품</a>
                </dd>
            </dl>
            <div class="pro_wrap">
                <div class="pro_list"><?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?></div>
                <a onclick="pro_close();" class="btn_close"><i class="fal fa-times"></i></a>
            </div>
            <script>
                pro_close();
                function pro_open(){
                    $('.btn_pro').click(function(){
                        $('.pro_wrap').show();
                    })
                }
                function pro_close(){
                    $('.pro_wrap').hide();
                }
            </script>
            <div class="main_slide"><?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?></div>

            <div class="main_top_bnr flexBox">
                <section onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=review'" style="cursor:pointer">
                    <div class="s_bnr">
                        <p class="t">제사음식 재구매율 1위</p>
                        <p class="s">지식인 평가 1위</p>
                        <p><i>#제사</i><i>#제사상</i><i>#제사음식</i></p>
                        <!--<p class="t">제사음식 생생한 리뷰</p>-->
                        <!--<p class="t">제사음식 생생한 리뷰</p>
                        <p class="s">재구매율·만족도 1위</p>-->
                        <!--<p><i>#제사</i><i>#시제</i><i>#묘제</i><i>#성묘상</i><i>#삼우제</i><i>#49제</i><i>#장례상</i></p>-->
                    </div>
                </section>
                <section onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=gall01'" style="cursor:pointer">
                    <div class="s_bnr">
                        <p class="t">행사실적 NO.1</p>
                        <p class="s">기원제/고사행사 갤러리</p>
                        <p><span>#고사 #고사상 #안전기원제 <!--<br />#이전고사 #발전기원제--></span></p>
                    </div>
                </section>
                <section onclick="location.href='../shop/list.php?ca_id=40'" style="cursor:pointer">
                    <div class="s_bnr">
                        <p class="t">프리미엄 명품</p>
                        <p class="s">이바지·행사음식 갤러리</p>
                        <p><i>#큰상</i><i>#이바지음식</i><i>#신행반찬</i><i>#집들이음식 </i><i>#행사도시락</i></p>
                    </div>
                </section>
            </div>

            <div class="main_prd">

                <!-- /prd_wrap -->
                <div class="prd_wrap">
                    <h4>제사음식</h4>
                    <div class="swiper-container prd_slide">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <?php
                        $list = new item_list();
                        $list->set_category('10', 1);
                        $list->set_list_mod(8);
                        $list->set_list_row(1);
                        $list->set_img_size(300, 200);
                        $list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php');
                        $list->set_view('it_img', true);
                        $list->set_view('it_name', true);
                        $list->set_view('it_price', true);
                        echo $list->run();
                        ?>

                    </div>
                </div>
                <div class="prd_wrap">
                    <h4>명절차례상</h4>
                    <div class="swiper-container prd_slide">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <?php
                        $list = new item_list();
                        $list->set_category('20', 1);
                        $list->set_list_mod(8);
                        $list->set_list_row(1);
                        $list->set_img_size(300, 200);
                        $list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php');
                        $list->set_view('it_img', true);
                        $list->set_view('it_name', true);
                        $list->set_view('it_price', true);
                        echo $list->run();
                        ?>

                    </div>
                </div>
                <div class="prd_wrap">
                    <h4>기원제 고사음식</h4>
                    <div class="swiper-container prd_slide">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <?php
                        $list = new item_list();
                        $list->set_category('80', 1);
                        $list->set_list_mod(8);
                        $list->set_list_row(1);
                        $list->set_img_size(300, 200);
                        $list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php');
                        $list->set_view('it_img', true);
                        $list->set_view('it_name', true);
                        $list->set_view('it_price', true);
                        echo $list->run();
                        ?>

                    </div>
                </div>
                <div class="prd_wrap">
                    <h4>이바지음식</h4>
                    <div class="swiper-container prd_slide">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <?php
                        $list = new item_list();
                        $list->set_category('40', 1);
                        $list->set_list_mod(8);
                        $list->set_list_row(1);
                        $list->set_img_size(300, 200);
                        $list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php');
                        $list->set_view('it_img', true);
                        $list->set_view('it_name', true);
                        $list->set_view('it_price', true);
                        echo $list->run();
                        ?>

                    </div>
                </div>
                <div class="prd_wrap">
                    <h4>행사도시락</h4>
                    <div class="swiper-container prd_slide">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <?php
                        $list = new item_list();
                        $list->set_category('50', 1);
                        $list->set_list_mod(8);
                        $list->set_list_row(1);
                        $list->set_img_size(300, 200);
                        $list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php');
                        $list->set_view('it_img', true);
                        $list->set_view('it_name', true);
                        $list->set_view('it_price', true);
                        echo $list->run();
                        ?>

                    </div>
                </div>
                <!-- /prd_wrap -->

            </div>
        </div>
        <!-- /mainBox -->
        <div class="rightBox">
            <?php
            include_once('inc/right_box.php');
            ?>


        </div>
        <!-- /rightBox -->
    </section>

    <!--<section class="newSection main_f">
	<div class="img">
		<img src="<?php echo G5_THEME_IMG_URL ?>/common/main_f.jpg" alt="">
	</div>
	<div class="txtB">
		<div class="tit">영남잔치상 음식의 특징
			<p class="grn2">6가지 정성</p>
		</div>
		<ul class="ul_list">
			<li><i>01.</i>영남잔시창 직원들의 <b class="grn2">마음가짐</b></li>
			<li><i>02.</i><b class="grn2">30여년 전통</b>으로 정성이 가득 담긴 음식</li>
			<li><i>03.</i>믿을 수 있는<b class="grn2">건강한 식재료 사용 및 보관</b></li>
			<li><i>04.</i>최신 조리 시설 보유 및 <b class="grn2">철저한 위생관리 시스템</b></li>
			<li><i>05.</i>100% <b class="grn2">당일조리</b> 및 안전한 포장상태</li>
			<li><i>06.</i>전국 <b class="grn2">안전한 배송</b> 서비스</li>
		</ul>
	</div>
</section>-->
    <!-- 마지막 -->








    <div id="idx_container">







    <script>
        $('#intro03 ul').slick({
            slidesToShow: 1,
            arrows:false,
            autoplay:true,
            autoplaySpeed:5000,
            infinite:true,
            variableWidth: true,
            centerMode: false,
        });
    </script>



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
                nextEl: ".hotSlide .swiper-button-next",
                prevEl: ".hotSlide .swiper-button-prev"

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
            spaceBetween: 20,
            loop:false,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            slidesPerView :'3',
            scrollbar: {
                el: ".swiper-scrollbar",
                hide: true,
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

    <!-- <ul class="sns_wrap">
    <li><a href="tel:055-246-0849"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_call.png"></a></li>
    <li><a onclick="alert('준비중입니다');"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_kakao.png"></a></li>
    <li><a href="https://blog.naver.com/a110141" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_blog.png"></a></li>
    <li><a href="http://www.instagram.com/hestiagagu.gallery" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/sns_insta.png"></a></li>
</ul> -->


<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>