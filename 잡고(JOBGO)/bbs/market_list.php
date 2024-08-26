<?php
global $pid;
$pid = "market_list";
$sub_id = "market_list";
include_once('./_common.php');

$g5['title'] = '마켓';
include_once('./_head.php');
?>

    <div id="banner" class="black mt0">
        <h6><b class="txt_color3">소문내기에 자신 있다면?</b></h6>
        <h6 class="txt_bold2 txt_white">마음에 드는 상품을 소문내요!</h6>
        <h6 class="txt_thin txt_white">친구가 구매할 때마다 적립!</h6>
        <button type="button" class="btn btn_black">마켓 판매 안내 <i class="fa-solid fa-right"></i></button>
    </div>

    <div id="goods">
        <!--  마켓  -->
        <div class="in">
            <div class="list">
                <?php
                for ($i = 0; $i < 2; $i++) {
                    ?>
                    <div class="thm">
                        <div class="mg">
                            <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                <div class="mg_in">
                                    <div class="over">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                    </div>
                                </div><!--상품사진-->
                            </a>
                        </div><!--mg-->
                        <div class="info">
                            <div class="heart" name="">
                                <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                            </div>
                            <div id="lecture_writer_list">
                                <div class="mb flex gap5 ai-c">
                                    <p>업체명</p>
                                </div>
                            </div>
                            <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                <div class="tit">이름</div>
                                <div class="txt_color">판매 리워드 | 판매가 5%</div>
                                <div class="price">50,000원</div>
                            </a>
                        </div>
                    </div><!--thm-->

                <?php } ?>
            </div><!--list-->
        </div><!--in-->

    </div><!--goods-->

    <nav class="pg_wrap">
        <span class="pg" id="emo_pg"></span>
    </nav>
<?php
include_once('./_tail.php');
?>