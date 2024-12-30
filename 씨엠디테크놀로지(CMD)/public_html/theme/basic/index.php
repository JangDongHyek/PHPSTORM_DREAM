<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH . '/index.php');
    return;
}

include_once(G5_THEME_PATH . '/head.php');
include_once(G5_LIB_PATH . '/thumbnail.lib.php');
?>

    <div id="idx_wrapper">
        <!--메인슬라이더 시작-->
        <div id="visual" class="wow fadeInUp animated">
            <div class="area_txt">
                <span>THE BEST OF CMD TECHNOLOGY</span>
                <h2>창의적인 기계 설계를 지향하는</h2>
                <h3>CMD TECHNOLOGY</h3>
                <p>CMD만의 혁신적이고, 차별화된 설계로<br>
                    최고의 자동화 라인 생산성과 품질을 보증 해드립니다</p>
            </div>
            <ul class="sliderbx">
                <li class="mv01"></li>
                <li class="mv02"></li>
                <li class="mv03"></li>
            </ul><!--.sliderbx-->
            <div class="bx_left">
                <div class="scrolldown">
                    <a href="#content">
                        <i class="fa-regular fa-chevron-down"></i> <span>SCROLL DOWN</span>
                    </a>
                </div>
                <div class="area_notice">
                    <?php echo latest("theme/basic", "notice", 2, 30); ?>
                </div>
            </div>
            <div class="bx_right">
                <div class="area_bn">
                    <h2>CMD ROBOTICS
                        <strong>FSW 마찰교반용접</strong></h2>
                    <a href="<?php echo G5_URL ?>/fsw/">사이트바로가기<i></i></a>
                </div>
            </div>
        </div><!-- //visual -->
    </div><!--  #idx_wrapper -->
    <!--<div class="fixed_bg"></div>-->

    <div id="content">
        <section class="area_robot">
            <div class="inr">
                <div class="idx_title">
                    <span>professional cmd technology</span>
                    <h2>혁신적이고, 차별화된 설계로<br class="hidden-xs">
                        <strong class="txt_blue">최고의 자동화 라인 생산성과 품질을 보증합니다.</strong></h2>
                    <p>고객에게 신뢰받는 기업으로 성장할 수 있도록<br class="visible-xs"> 최선을 다하겠습니다. </p>
                </div>
                <?php
                    //분류 쿼리문
                    $sql="select * from g5_write_category order by wr_id asc";
                    $result=sql_query($sql);
                    $categorys = array();
                    for($i=0;$row=sql_fetch_array($result);$i++){
                        $categorys[$i]=$row;//분류를 배열로 담기
                    }
                ?>
                <ul class="type_list">

                    <li onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=product&sca=<?php echo $categorys[0][wr_subject]?>'">
                        <div class="txt">
                            <h3><?php echo $categorys[0][wr_subject]?></h3>
                            <p>
                                <?php echo nl2br($categorys[0][wr_content]);?>
                            </p>
                            <div class="brand">
                                <span>
                                <?php
                                    echo str_replace(",","</span><span>",$categorys[0][wr_1]);
                                ?>

                            </div>
                        </div>
                        <a class="more_btn"><i class="fa-light fa-plus"></i></a>
                    </li>
                    <li onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=product&sca=<?php echo $categorys[1][wr_subject]?>'">
                        <div class="txt">
                            <h3><?php echo $categorys[1][wr_subject]?></h3>
                            <p>
                                <?php echo nl2br($categorys[1][wr_content]);?>
                            </p>
                            <div class="brand">
                                <span>
                                <?php
                                echo str_replace(",","</span><span>",$categorys[1][wr_1]);
                                ?>

                            </div>
                        </div>
                        <a class="more_btn"><i class="fa-light fa-plus"></i></a>
                    </li>
                    <li onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=product&sca=<?php echo $categorys[2][wr_subject]?>'">
                        <div class="txt">
                            <h3><?php echo $categorys[2][wr_subject]?></h3>
                            <p>
                                <?php echo nl2br($categorys[2][wr_content]);?>
                            </p>
                            <div class="brand">
                                <span>
                                <?php
                                echo str_replace(",","</span><span>",$categorys[2][wr_1]);
                                ?>

                            </div>
                        </div>
                        <a class="more_btn"><i class="fa-light fa-plus"></i></a>
                    </li>
                    <li onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=product&sca=<?php echo $categorys[3][wr_subject]?>'">
                        <div class="txt">
                            <h3><?php echo $categorys[3][wr_subject]?></h3>
                            <p>
                                <?php echo nl2br($categorys[3][wr_content]);?>
                            </p>
                            <div class="brand">
                                <span>
                                <?php
                                echo str_replace(",","</span><span>",$categorys[3][wr_1]);
                                ?>

                            </div>
                        </div>
                        <a class="more_btn"><i class="fa-light fa-plus"></i></a>
                    </li>

                </ul>

            </div>
        </section>
        <section class="area_product">
            <div class="idx_title">
                <span>S.F.A. (Smart Factory Automation)</span>
                <h2>지금 세계에서 가장 주목받고 있는 분야가<br class="hidden-xs">
                    <strong class="txt_blue">주문형 자동화 System입니다.</strong></h2>
                <p>고객에게 신뢰받는 기업으로<br class="visible-xs"> 성장할 수 있도록 최선을 다하겠습니다. </p>
            </div>

            <!--제품추출-->
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#product" aria-controls="product" role="tab" data-toggle="tab">산업용 ROBOT</a></li>
                    <li role="presentation">
                        <a href="#product02" aria-controls="product02" role="tab" data-toggle="tab">협동로봇</a>
                    </li>
                    <li role="presentation">
                        <a href="#product03" aria-controls="product03" role="tab" data-toggle="tab">주변기기/그리퍼</a>
                    </li>
                    <li role="presentation">
                        <a href="#product04" aria-controls="product04" role="tab" data-toggle="tab">PLC/통신기기</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- 산업용 로봇 제품 목록 시작 -->
                    <div role="tabpanel" class="tab-pane active" id="product">
                        <?php
                            $sql="select * from g5_write_product where ca_name='{$categorys[0]['wr_subject']}' order by wr_id desc limit 0,15";
                            $result=sql_query($sql);
                        ?>
                        <!-- Swiper -->
                        <div class="swiper productSwiper">
                            <div class="swiper-wrapper">
                                <?php
                                    for($i=0;$row=sql_fetch_array($result);$i++){
                                ?>
                                <div class="swiper-slide">
                                    <ul class="gall_con">
                                        <li class="gall_href">
                                            <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>">
                                                <div class="over"></div>
                                                <?php
                                                $thumb = get_list_thumbnail("product", $row['wr_id'], 360, 320);

                                                if ($thumb['src']) {
                                                    $img_content = '<img src="' . $thumb['src'] . '" alt="' . $thumb['alt'] . '" width="' . $board['bo_gallery_width'] . '" height="' . $board['bo_gallery_height'] . '" class="img">';
                                                } else {
                                                    $img_content = '<span style="width:' . $board['bo_gallery_width'] . 'px;line-height:' . $board['bo_gallery_height'] . 'px" class="noimg">no image</span>';
                                                }

                                                echo $img_content;
                                                ?>
                                            </a>
                                        </li>
                                        <li class="gall_text_href">
                                            <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&sca=<?php echo $categorys[0]['wr_subject']?>'&swr2=<?php echo $row[wr_2]?>"
                                               class="bo_cate_link"><?php echo $row[wr_2]?></a>
                                            <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>"
                                               class="title">
                                                <p class="t9"><?php echo $row['wr_subject']?><!-- 제목 --></p>
                                                <p class="t16"><?php echo $row[wr_1]?><!--제품코드 --></p>
                                                <p class="t7 shot">
                                                    <!--간단설명-->
                                                    <?php echo nl2br($row['wr_4']);?>
                                                </p>
                                            </a>
                                            <?php
                                                if($member[mb_id] != ""){
                                                    $sql="select * from g5_board_file where bo_table='product' and wr_id='$row[wr_id]' and bf_no='1'";
                                                    $row2=sql_fetch($sql);
                                                    if($row2[bf_no]){
                                            ?>
                                            <a class="down_btn" href="<?php echo G5_BBS_URL?>/download.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&no=1">
                                                제품 카탈로그
                                                <i class="fa-light fa-arrow-down-to-line"></i>
                                            </a>
                                            <?php }else{
                                                //제품 카탈로그이 없을 경우
                                                ?>
                                                <a class="down_btn none">
                                                    등록된 카탈로그가 없습니다
                                                </a>
                                            <?php }}?>
                                        </li>
                                    </ul>
                                </div>
                                <?php }?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <?php
                            if($i==0){?>
                            <div class="empty_list">등록된 제품이 없습니다.</div>
                        <?php
                            }
                        ?>
                        <!-- 산업용 로봇 제품 끝 -->
                    </div>
                    <div role="tabpanel" class="tab-pane" id="product02">
                        <!-- 협동로봇 제품 시작 -->
                        <?php
                        $sql="select * from g5_write_product where ca_name='{$categorys[1]['wr_subject']}' order by wr_id desc limit 0,15";
                        $result=sql_query($sql);
                        ?>
                        <!-- Swiper -->
                        <div class="swiper productSwiper">
                            <div class="swiper-wrapper">
                                <?php
                                for($i=0;$row=sql_fetch_array($result);$i++){
                                    ?>
                                    <div class="swiper-slide">
                                        <ul class="gall_con">
                                            <li class="gall_href">
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>">
                                                    <div class="over"></div>
                                                    <?php
                                                    $thumb = get_list_thumbnail("product", $row['wr_id'], 360, 320);

                                                    if ($thumb['src']) {
                                                        $img_content = '<img src="' . $thumb['src'] . '" alt="' . $thumb['alt'] . '" width="' . $board['bo_gallery_width'] . '" height="' . $board['bo_gallery_height'] . '" class="img">';
                                                    } else {
                                                        $img_content = '<span style="width:' . $board['bo_gallery_width'] . 'px;line-height:' . $board['bo_gallery_height'] . 'px" class="noimg">no image</span>';
                                                    }

                                                    echo $img_content;
                                                    ?>
                                                </a>
                                            </li>
                                            <li class="gall_text_href">
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&sca=<?php echo $categorys[1]['wr_subject']?>'&swr2=<?php echo $row[wr_2]?>"
                                                   class="bo_cate_link"><?php echo $row[wr_2]?></a>
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>"
                                                   class="title">
                                                    <p class="t9"><?php echo $row['wr_subject']?><!-- 제목 --></p>
                                                    <p class="t16"><?php echo $row[wr_1]?><!--제품코드 --></p>
                                                    <p class="t7 shot">
                                                        <!--간단설명-->
                                                        <?php echo nl2br($row['wr_4']);?>
                                                    </p>
                                                </a>
                                                <?php
                                                if($member[mb_id] != ""){
                                                    $sql="select * from g5_board_file where bo_table='product' and wr_id='$row[wr_id]' and bf_no='1'";
                                                    $row2=sql_fetch($sql);
                                                    if($row2[bf_no]){
                                                        ?>
                                                        <a class="down_btn" href="<?php echo G5_BBS_URL?>/download.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&no=1">
                                                            제품 카탈로그
                                                            <i class="fa-light fa-arrow-down-to-line"></i>
                                                        </a>
                                                    <?php }}?>
                                            </li>
                                        </ul>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <?php
                        if($i==0){?>
                            <div class="empty_list">등록된 제품이 없습니다.</div>
                            <?php
                        }
                        ?>
                        <!-- 협동로봇 제품 끝 -->
                    </div>
                    <div role="tabpanel" class="tab-pane" id="product03">
                        <!-- 주변기기/그리퍼 제품 시작 -->
                        <?php
                        $sql="select * from g5_write_product where ca_name='{$categorys[2]['wr_subject']}' order by wr_id desc limit 0,15";
                        $result=sql_query($sql);
                        ?>
                        <!-- Swiper -->
                        <div class="swiper productSwiper">
                            <div class="swiper-wrapper">
                                <?php
                                for($i=0;$row=sql_fetch_array($result);$i++){
                                    ?>
                                    <div class="swiper-slide">
                                        <ul class="gall_con">
                                            <li class="gall_href">
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>">
                                                    <div class="over"></div>
                                                    <?php
                                                    $thumb = get_list_thumbnail("product", $row['wr_id'], 360, 320);

                                                    if ($thumb['src']) {
                                                        $img_content = '<img src="' . $thumb['src'] . '" alt="' . $thumb['alt'] . '" width="' . $board['bo_gallery_width'] . '" height="' . $board['bo_gallery_height'] . '" class="img">';
                                                    } else {
                                                        $img_content = '<span style="width:' . $board['bo_gallery_width'] . 'px;line-height:' . $board['bo_gallery_height'] . 'px" class="noimg">no image</span>';
                                                    }

                                                    echo $img_content;
                                                    ?>
                                                </a>
                                            </li>
                                            <li class="gall_text_href">
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&sca=<?php echo $categorys[2]['wr_subject']?>'&swr2=<?php echo $row[wr_2]?>"
                                                   class="bo_cate_link"><?php echo $row[wr_2]?></a>
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>"
                                                   class="title">
                                                    <p class="t9"><?php echo $row['wr_subject']?><!-- 제목 --></p>
                                                    <p class="t16"><?php echo $row[wr_1]?><!--제품코드 --></p>
                                                    <p class="t7 shot">
                                                        <!--간단설명-->
                                                        <?php echo nl2br($row['wr_4']);?>
                                                    </p>
                                                </a>
                                                <?php
                                                if($member[mb_id] != ""){
                                                    $sql="select * from g5_board_file where bo_table='product' and wr_id='$row[wr_id]' and bf_no='1'";
                                                    $row2=sql_fetch($sql);
                                                    if($row2[bf_no]){
                                                        ?>
                                                        <a class="down_btn" href="<?php echo G5_BBS_URL?>/download.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&no=1">
                                                            제품 카탈로그
                                                            <i class="fa-light fa-arrow-down-to-line"></i>
                                                        </a>
                                                    <?php }}?>
                                            </li>
                                        </ul>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <?php
                        if($i==0){?>
                            <div class="empty_list">등록된 제품이 없습니다.</div>
                            <?php
                        }
                        ?>
                        <!-- 주변기기/그리퍼 제품 끝 -->
                    </div>
                    <div role="tabpanel" class="tab-pane" id="product04">
                        <!-- PLC/통신기기 제품 시작 -->
                        <?php
                        $sql="select * from g5_write_product where ca_name='{$categorys[3]['wr_subject']}' order by wr_id desc limit 0,15";
                        $result=sql_query($sql);
                        ?>
                        <!-- Swiper -->
                        <div class="swiper productSwiper">
                            <div class="swiper-wrapper">
                                <?php
                                for($i=0;$row=sql_fetch_array($result);$i++){
                                    ?>
                                    <div class="swiper-slide">
                                        <ul class="gall_con">
                                            <li class="gall_href">
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>">
                                                    <div class="over"></div>
                                                    <?php
                                                    $thumb = get_list_thumbnail("product", $row['wr_id'], 360, 320);

                                                    if ($thumb['src']) {
                                                        $img_content = '<img src="' . $thumb['src'] . '" alt="' . $thumb['alt'] . '" width="' . $board['bo_gallery_width'] . '" height="' . $board['bo_gallery_height'] . '" class="img">';
                                                    } else {
                                                        $img_content = '<span style="width:' . $board['bo_gallery_width'] . 'px;line-height:' . $board['bo_gallery_height'] . 'px" class="noimg">no image</span>';
                                                    }

                                                    echo $img_content;
                                                    ?>
                                                </a>
                                            </li>
                                            <li class="gall_text_href">
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&sca=<?php echo $categorys[3]['wr_subject']?>'&swr2=<?php echo $row[wr_2]?>"
                                                   class="bo_cate_link"><?php echo $row[wr_2]?></a>
                                                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>"
                                                   class="title">
                                                    <p class="t9"><?php echo $row['wr_subject']?><!-- 제목 --></p>
                                                    <p class="t16"><?php echo $row[wr_1]?><!--제품코드 --></p>
                                                    <p class="t7 shot">
                                                        <!--간단설명-->
                                                        <?php echo nl2br($row['wr_4']);?>
                                                    </p>
                                                </a>
                                                <?php
                                                if($member[mb_id] != ""){
                                                    $sql="select * from g5_board_file where bo_table='product' and wr_id='$row[wr_id]' and bf_no='1'";
                                                    $row2=sql_fetch($sql);
                                                    if($row2[bf_no]){
                                                        ?>
                                                        <a class="down_btn" href="<?php echo G5_BBS_URL?>/download.php?bo_table=product&wr_id=<?php echo $row[wr_id]?>&no=1">
                                                            제품 카탈로그
                                                            <i class="fa-light fa-arrow-down-to-line"></i>
                                                        </a>
                                                    <?php }}?>
                                            </li>
                                        </ul>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <?php
                        if($i==0){?>
                            <div class="empty_list">등록된 제품이 없습니다.</div>
                            <?php
                        }
                        ?>
                        <!-- 주PLC/통신기기 제품 끝 -->
                    </div>
                </div>

            </div>
            <!--제품추출-->

            <div class="text-center">
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=product&sca=<?php echo $categorys[0]['wr_subject']?>" class="more_btn">로봇제품 바로가기 <i
                            class="fa-light fa-angle-right"></i></a>
            </div>
        </section>
        <section class="area_news">
            <div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/news_img.jpg"></div>
            <div class="inr">
                <div class="title">
                    <h3>CMD NEWS</h3>
                    <p>industry news</p>
                    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=news" class="more_btn">더보기<i
                                class="fa-light fa-plus"></i></a>
                </div>
                <div class="list flex">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/news_bn.jpg" class="news_bn">
                    <?php echo latest("theme/webzine_news", "news", 1, 60); ?>
                </div>
            </div>

        </section>
        <section class="area_contact">
            <div class="inr">
                <div class="case">
                    <div class="title flex js">
                        <h3>ROBOT 적용사례</h3>
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=case" class="more_btn">더보기<i
                                    class="fa-light fa-plus"></i></a>
                    </div>
                    <?php echo latest("theme/webzine", "case", 3, 60); ?>
                </div>
                <div class="contact">
                    <div class="title flex">
                        <h3>CMD 고객센터</h3>
                        <span>평일 : 08:00 - 17:00   점심 : 12:00 ~ 13:00  휴무 : 토,일, 공휴일</span>
                    </div>
                    <div class="call">
                        <strong>055.<span class="txt_blue">905.2098</span></strong>
                        <ul>
                            <li><i class="fa-regular fa-fax"></i> Fax : 055-905-2099</li>
                            <li><i class="fa-regular fa-envelope"></i> E-mail : cmd735@daum.net</li>
                            <li><a href="https://www.youtube.com/channel/UCnI2XE3z5Ct8usW7FxQrvrw" target="_blank"><i class="fa-brands fa-youtube"></i> YOUTUBE 채널</a></li>
                        </ul>
                    </div>
                    <div class="play">
                        <div class='embed-container'>
                        <!--<img src="<?php /*echo G5_THEME_IMG_URL */?>/main/play_img.jpg">-->
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/eoUD8G34Mh4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="btn_wrap">
                        <!--<a href="<?php /*echo G5_BBS_URL */?>/board.php?bo_table=qna">온라인상담<i
                                    class="fa-regular fa-message-lines"></i></a>-->
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq">FAQ<i
                                    class="fa-regular fa-clipboard"></i></a>
                    </div>

                </div>
            </div>

        </section>

    </div>


    <script>
        //제품추출
        var swiper = new Swiper(".productSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            breakpoints: {
                1400: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                550: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>

<?php
include_once(G5_PATH . '/tail.php');
?>