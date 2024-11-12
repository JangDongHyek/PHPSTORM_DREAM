<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');

$sql="select * from g5_write_movie m left outer join g5_board_file f on f.wr_id=m.wr_id where f.bo_table='movie' and m.wr_2 = 't'";
$result2=sql_query($sql);
$tempMovieArr=array();
while($row2=sql_fetch_array($result2)){
    if(empty($row2['wr_1'])){
        continue;
    }

    $item_no = explode(",",$row2['wr_1']);

    for($i=0; $i<count($item_no); $i++){
        $tempMovieArr[$item_no[$i]][] = G5_DATA_URL."/file/movie/".$row2[bf_file];
    }
}
?>

<?php /*?><script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script><?php */?>

    <div id="main_prod_wrap">
        <div class="main_prod">
            <div class="main_prod_in">
                <?php
                $list_mod = 3;     // 가로 이미지수
                $list_row = 1;     // 이미지줄 수, Query를 직접 지정하기 때문에 이미지줄 수는 적용되지 않음
                $img_width = 500;  // 이미지 폭
                $img_height = 300; // 이미지 높이
                $skin = G5_MSHOP_SKIN_PATH.'/main.10.skin.php'; // 스킨
                $sql = " select * from {$g5['g5_shop_item_table']} where it_use = '1' and it_type1='1' order by it_order, it_id desc ";
                $list = new item_list($skin, $list_mod, $list_row, $img_width, $img_height);
                $list->set_query($sql);
                $list->set_view('it_img', true);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_basic', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', false);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
            </div><!--.main_prod_in-->
        </div>
        <!--.main_prod-->

        <a class="btn_mprod" href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=10">참여하기 더보기 <i class="fal fa-chevron-right"></i></a>
    </div>
    <!--#main_prod_wrap-->


    <div id="main_chart">
        <div class="bxslider">
            <?php
            $sql="select * from g5_write_funding";
            $result=sql_query($sql);
            while($row=sql_fetch_array($result)){
                ?>
                <div class="cf">

                    <div class="mc_title">
                        <div class="mct"><?=$row[wr_subject]?></div>
                        <div class="mcd"><?=date("Y년 m월 d일")?> 기준</div>
                    </div><!--.mc_title-->
                    <div class="mc_number">
                        <div class="mcn"><a class="counter" data-count="<?=number_format(intval($row[wr_content]))?>"><?=number_format(intval($row[wr_content]))?></a><span><?=mb_substr($row[wr_content],-1)?></span></div>
                    </div><!--.mc_number-->
                    <div class="mc_updown">
                        <dl>
                            <dt>전월대비<span>(%)</span></dt>
                            <dd class="mc_up counter" data-count="<?=$row[wr_1]?>"><i class="fas fa-caret-up"></i> <?=$row[wr_1]?></dd>
                        </dl>
                        <dl>
                            <dt>등락률<span>(%)</span></dt>
                            <dd class="mc_down counter" data-count="<?=$row[wr_2]?>"><i class="fas fa-sort-down"></i> <?=$row[wr_2]?></dd>
                        </dl>
                    </div><!--.mc_updown-->
                </div>
            <?php }?>
            <?/* <div class="cf">
      	<div class="mc_title">
        	<div class="mct">평균수익률</div>
            <div class="mcd">2020년 11월 30일 기준</div>
        </div><!--.mc_title-->
        <div class="mc_number">
        	<div class="mcn">127<span>%</span></div>
        </div><!--.mc_number-->
        <div class="mc_updown">
        	<dl>
            	<dt>전월대비<span>(%)</span></dt>
                <dd class="mc_up"><i class="fas fa-caret-up"></i> +4.95</dd>
            </dl>
        	<dl>
            	<dt>등락률<span>(%)</span></dt>
                <dd class="mc_same">-</dd>
            </dl>
        </div><!--.mc_updown-->
      </div>
      <div class="cf">
      	<div class="mc_title">
        	<div class="mct">당첨자</div>
            <div class="mcd">2020년 11월 30일 기준</div>
        </div><!--.mc_title-->
        <div class="mc_number">
        	<div class="mcn">12<span>명</span></div>
        </div><!--.mc_number-->
        <div class="mc_updown">
        	<dl>
            	<dt>전월대비<span>(%)</span></dt>
                <dd class="mc_up"><i class="fas fa-caret-up"></i> +4.95</dd>
            </dl>
        	<dl>
            	<dt>등락률<span>(%)</span></dt>
                <dd class="mc_same">-</dd>
            </dl>
        </div><!--.mc_updown-->
      </div>*/?>
        </div><!--.bxslider-->
    </div> <!--#main_chart-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="<?=G5_JS_URL?>/jquery.counterup.min.js"></script>
    <script>
        $(document).ready(function(){
            // 카운터 초기화 함수
            function initializeCounter() {
                $('.counter').each(function() {
                    var $this = $(this);
                    var countTo = $this.attr('data-count');
                    $this.text(countTo);
                    $this.counterUp({
                        delay: 10,
                        time: 1000
                    });
                });
            }

            // 초기 카운터 설정
            initializeCounter();

            // bxSlider 설정
            $('.bxslider').bxSlider({
                auto: true,
                autoControls: true,
                stopAutoOnClick: true,
                pager: true,
                slideWidth: 1200,
                speed: 10,
                mode: 'fade', // 'horizontal', 'vertical', 'fade'
                pause: 3000,
                onSlideAfter: function(){
                    // 슬라이드 전환 후 카운터 재설정
                    initializeCounter();
                }
            });
        });


    </script>


    <div id="mbanner">
        <!-- Swiper -->
        <div class="swiper-container">
            <!--pc-->
            <div class="swiper-wrapper ">
                <div class="swiper-slide"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mbanner01.jpg" alt="" class="pc_swipe" />
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mban01.jpg" alt="" class="mo_swipe"/></a></div>
                <div class="swiper-slide"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=ad">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mbanner02.jpg" alt="" class="pc_swipe" />
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mban02.jpg" alt="" class="mo_swipe"/></a></div>
                <div class="swiper-slide"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=item">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mbanner03.jpg" alt="" class="pc_swipe" />
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mban03.jpg" alt="" class="mo_swipe"/></a></div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div><!--#mbanner-->
    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>


    <div id="main_bbs">
        <div class="mb_title"><span>Social Goodness</span>소셜굿니스 소식</div>
        <div class="mb_cont">
            <?php
            // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
            echo latest('theme/gallery', 'notice', 6, 20);

            ?>
        </div>
    </div><!--#main_bbs-->





    <div class="container">


<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>