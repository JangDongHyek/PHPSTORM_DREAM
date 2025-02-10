<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH . '/shop.head.php');
?>


    <!-- 메인 배너 -->
    <!--<div id="main_box">
        <div id="mainbanner">
            <div class="container"><? /*php echo display_banner('메인', 'mainbanner.10.skin.php'); */?></div>
        </div>
    </div>-->
    <!--#main_box-->

    <div class="cate_icon">
        <ul>
            <li>
                <a href="<?php echo G5_URL ?>/shop/list.php?ca_id=20">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon03.svg"></p>
                    <p>골프용품</p>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/shop/list.php?ca_id=2070">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon02.svg"></p>
                    <p>골프공</p>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/shop/list.php?ca_id=60">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon01.svg"></p>
                    <p>골프클럽</p>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/shop/list.php?ca_id=30">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon04.svg"></p>
                    <p>골프패션</p>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/shop/list.php?ca_id=a0">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon05.svg"></p>
                    <p>기획전</p>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/shop/listtype.php?type=4">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon09.svg"></p>
                    <p>인기상품</p>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/shop/list.php?ca_id=b0">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon06.svg"></p>
                    <p>할인상품</p>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=event">
                    <p class="icon"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/cate_icon08.svg"></p>
                    <p>이벤트</p>
                </a>
            </li>
        </ul>
    </div>


    <div id="joop_box_wrap" class="box1">

        <!--추천상품-->
        <div id="idx_best">
            <div class="container">
                <div style="position:relative">
                    <h2 class="h2_st">이 상품은 어떠세요?</h2>
                    <div class="swiper-container hotSlide">
                        <?php
                        $list = new item_list();
                        $list->set_list_mod(8);
                        $list->set_list_row(1);
                        $list->set_img_size(275, 275);
                        $list->set_list_skin(G5_SHOP_SKIN_PATH . '/list.20.skin.php');
                        //$list->set_view('it_icon', true);
                        $list->set_view('it_img', true);
                        $list->set_view('it_name', true);
                        $list->set_view('it_price', true);
                        //$list->set_view('sns', true);
                        echo $list->run();
                        ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>


                </div>
            </div>
        </div>

    </div><!--#joop_box_wrap-->


    <div class="bn">
        <div id="brand_bn1"><a href="<?php echo G5_URL; ?>/shop/list.php?ca_id=40">
                <div class="txt_wrap">
                    <div class="area_txt">
                        <span>이용후기 등록하고 선물 받아세요!</span>
                        <h3>예성코리아에서 구매한 제품으로 멋진 후기를 남겨주신분들께 추첨을 통해 선물을 보내드립니다.</h3>
                        <button type="button">후기등록하기 <i class="far fa-chevron-right"></i></button>
                    </div>
                    <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/bn2img.png"></div>
                </div>
            </a>
        </div>
    </div>


<?php ?>
    <div id="idx_container">
        <div id="idx_rec">
            <div class="inr">
                <div class="idx_rec_box">
                    <h2>New Item</h2>
                    <p>새로 입고된 신제품!</p>
                    <?php
                    $list = new item_list();
                    $list->set_type(3);
                    $list->set_list_mod(4);
                    $list->set_list_row(2);
                    $list->set_img_size(350, 350);
                    $list->set_list_skin(G5_SHOP_SKIN_PATH . '/list.10.skin.php');
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

        <div class="bn">
            <div id="brand_bn">
                <div class="txt_wrap">
                    <div class="area_txt">
                        <!--<img src="<?php /*echo G5_THEME_IMG_URL; */ ?>/main/volvik_logo.png">-->
                        <h3>여성 초보 골퍼를 위한 풀세트 <em class="bold">SALE</em></h3>
                        <span>여성 골퍼를 위한 풀세트</span>
                        <button type="button" onclick="location.href='<?php echo G5_SHOP_URL; ?>/list.php?ca_id=6020'">
                            상품 보러 가기 <i class="far fa-chevron-right"></i></button>
                    </div>
                    <div class="area_img1"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/bn1img1.png"></div>
                </div>
                <!--<div class="inr">
                        <img src="<?php /*echo G5_THEME_IMG_URL; */ ?>/main/bn1.png">
                    </div>-->
            </div>
        </div>

        <div id="idx_new">
            <div class="inr">
                <div class="idx_new_box">
                    <h2>BEST Item</h2>
                    <p>FIND THE BEST FOR YOUR GAME!</p>
                    <?php
                    $list = new item_list();
                    //					$list->set_category('30', 1);
                    $list->set_type(2);
                    $list->set_list_mod(4);
                    $list->set_list_row(2);
                    $list->set_img_size(350, 350);
                    $list->set_list_skin(G5_SHOP_SKIN_PATH . '/list.10.skin.php');
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


    <!--<div class="inr bn"><a href="<?php /*echo G5_BBS_URL; */ ?>/register_form.php">
	<div id="brand_bn2" class="">
		<div class="txt_wrap">
			<div class="area_txt">
				<span>아직 GOLD X 회원이 아니신가요?</span>
				<h3>추천인 입력시 <em class="bold">포인트 적립</em></h3>
				<button type="button" onClick="location.href='<?php /*echo G5_BBS_URL; */ ?>/register_form.php'">회원가입 GO <i class="far fa-chevron-right"></i></button>
			</div>
		</div>
	</div></a>
</div> -->

<?php
    if($_SERVER['REMOTE_ADDR'] == "183.103.22.103"){
?>
    <div class="reviewSlide">

        <h3>REVIEW</h3>
        <p class="title">제품 이용후기</p>


        <div class="inr">
            <div class="swiper-container revw_slide">
                <div class="swiper-wrapper">
                    <?php
                    $sql="select *,a.mb_id from `g5_shop_item_use` a join `g5_shop_item` b on (a.it_id=b.it_id) where a.is_confirm = '1' order by a.is_id desc limit 0, 15";
                    $result=sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $star = get_star($row['is_score']);
                        $row2 = sql_fetch(" select it_name,it_price,it_id from {$g5['g5_shop_item_table']} where it_id = '{$row['it_id']}' ");
                    ?>
                    <div class="swiper-slide">
                        <p class="pname"><a href="<?php echo G5_SHOP_URL?>/item.php?it_id=<?php echo $row2[it_id]?>">
                                <?=$row[is_subject]?>
                            </a></p>
                        <span class="imgBox"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 70, 70); ?></span>
                        <p class="starBox"><span class="star_<?php echo $star?>"></span><span><?php echo $star?></span></p>
                        <div class="t_box">
                            <p><a href="<?php echo G5_SHOP_URL?>/item.php?it_id=<?php echo $row2[it_id]?>"<?php echo $row[is_content]?></a></p>
                        </div>
                        <p class="idBox"><?php echo substr($row[mb_id],0,strlen($row[mb_id])-3)?>***</p>
                    </div>
                    <?php }?>
                </div>
                <?php
                    if($i==0){
                ?>
                <div style="text-align: center">현재 제품 이용후기가 없습니다.</div>
                <?php }?>

            </div>
            <?php
            if($i!=0){
            ?>
            <div class="idx_best_box">
                <div class="swiper-button-next2"></div>
                <div class="swiper-button-prev2"></div>
            </div>
            <?php }?>
        </div>
    </div>
<?php }?>

    <script>

        //HOT ITEM
        var swiper = new Swiper(".hotSlide", {
            spaceBetween: 40,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            slidesPerView: '3',
            navigation: {
                nextEl: ".swiper-button-next3",
                prevEl: ".swiper-button-prev3"

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

        //HOT ITEM
        var swiper = new Swiper(".hotSlide2", {
            spaceBetween: 40,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            slidesPerView: '3',
            navigation: {
                nextEl: ".swiper-button-next3",
                prevEl: ".swiper-button-prev3"

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

        //HOT ITEM
        var swiper = new Swiper(".hotSlide3", {
            spaceBetween: 40,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            slidesPerView: '3',
            navigation: {
                nextEl: ".swiper-button-next3",
                prevEl: ".swiper-button-prev3"

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
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            slidesPerView: '3',
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
    <script>
        $(document).ready(function () {

            $('ul.tabs li').click(function () {
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#" + tab_id).addClass('current');
            })

        })
    </script>
    <script>
        $(document).ready(function () {
            tab();
        })

        function tab() {
            //탭메뉴 클릭할 때 실행
            $('.tab_wrap .tit_list > li a').on('click', function (e) {
                e.preventDefault();

                //초기화
                $('.tab_wrap .tit_list > li').removeClass('active');
                $('.tab_wrap .tab_list').hide();

                //실행
                $(this).parent().addClass('active');
                var activeTab = $(this).attr('href');
                $(activeTab).show();

                //파라미터 확인
                urlParam = location.search.substr(location.search.indexOf("?") + 1);
                if (urlParam != '') {
                    urlParam = '?' + urlParam;
                }

                //파라미터 변경
                getNewUrl('tabName', urlParam); //(변경·추가할 파라미터 이름, 현재 파라미터)
                function getNewUrl(paramName, oldUrl) {
                    var newUrl;
                    var urlChk = new RegExp('[?&]' + paramName + '\\s*=');
                    var urlChk2 = new RegExp('(?:([?&])' + paramName + '\\s*=[^?&]*)')


                    if (urlChk.test(oldUrl)) { //해당 파라미터가 있을 때
                        newUrl = oldUrl.replace(urlChk2, "$1" + paramName + "=" + activeTab.substr(1));
                    } else if (/\?/.test(oldUrl)) { //해당 파라미터가 없고 다른 파라미터가 있을 때
                        newUrl = oldUrl + "&" + paramName + "=" + activeTab.substr(1);
                    } else { //파라미터가 없을 때
                        newUrl = oldUrl + "?" + paramName + "=" + activeTab.substr(1);
                    }

                    history.pushState(null, null, newUrl);
                }
            });

            //파라미터 값 검사
            function getParameter(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                    results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            var getParam = getParameter('tabName'); //선택한 탭 파라미터
            var loadChk = getParameter('loadChk'); //첫 로드 여부 체크

            if (getParam != '') { //파라미터 값이 있으면 파라미터 값 기준으로 탭메뉴 선택
                $('.tab_wrap .tit_list > li a[href="#' + getParam + '"]').parent().addClass('active');
                $('.tab_wrap .tit_list > li a[href="#' + getParam + '"]').trigger('click');

                if (loadChk == 'on') { //처음 로드되었으면 스크롤 이동
                    //탭 위치로 이동
                    var tabTop = $('.tab_wrap').offset().top;
                    $(window).scrollTop(tabTop - 100);

                    //파라미터 확인
                    var urlParam = location.search.substr(location.search.indexOf("?") + 1);
                    if (urlParam != '') {
                        urlParam = '?' + urlParam;
                    }

                    //loadChk 파라미터 값 변경
                    loadChange('loadChk', urlParam);

                    function loadChange(paramName, oldUrl) {
                        var newUrl;
                        var urlChk = new RegExp('[?&]' + paramName + '\\s*=');
                        var urlChk2 = new RegExp('(?:([?&])' + paramName + '\\s*=[^?&]*)')
                        newUrl = oldUrl.replace(urlChk2, "$1" + paramName + "=off");
                        history.pushState(null, null, newUrl);
                    }
                }
            } else { //파라미터 값이 없으면 active 클래스 기준으로 탭메뉴 선택
                var activeChk = 0;
                $('.tab_wrap .tit_list > li').each(function (i) {
                    if ($(this).hasClass('active')) {
                        $(this).addClass('active');
                        $(this).find('a').trigger('click');
                        activeChk++
                    }
                });

                //active 지정 안했을 시 첫 탭메뉴 선택
                if (activeChk == 0) {
                    $('.tab_wrap .tit_list > li:first-child a').trigger('click');
                }
            }

            //뒤로가기 탭메뉴 복구
            window.onpopstate = function (event) {
                //초기화
                $('.tab_wrap .tit_list > li').removeClass('active');
                $('.tab_wrap .tab_list').hide();
                var getParam2 = getParameter('tabName'); //선택한 탭 파라미터

                //탭메뉴 열기
                if (getParam2 != '') {
                    $('.tab_wrap .tit_list > li a[href="#' + getParam2 + '"]').parent().addClass('active');
                    $('#' + getParam2).show()
                } else {
                    $('.tab_wrap .tit_list > li:first-child').addClass('active');
                    $('.tab_wrap .tab_list:first-of-type').show();
                }
            };
        }
    </script>


<?php
include_once(G5_THEME_MSHOP_PATH . '/shop.tail.php');
?>