<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

$search = $_REQUEST['search'];
if ($search == "")  $search = "date";

include_once(G5_THEME_PATH.'/head.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

?>
    <div id="idx_wrapper">
        <div id="visual" class="main wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">

            <!-- Swiper -->
            <div class="swiper mainSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide1.png" onclick="location.href='<?php echo G5_BBS_URL ?>/campaign_exp_list.php'"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide4.png" onclick="location.href='<?php echo G5_BBS_URL ?>/campaign_exp_list.php'"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide2.png" onclick="location.href='<?php echo G5_BBS_URL ?>/compete_list.php'"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide3.png" onclick="location.href='<?php echo G5_BBS_URL ?>/market_list.php'"></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <script>
                var swiper = new Swiper(".mainSwiper", {
                    pagination: {
                        el: ".swiper-pagination",
                        type: "fraction",
                    },
                    autoplay: {
                        delay: 25000,
                        disableOnInteraction: false,
                    },
                });
            </script>
        </div><!-- //visual -->
    </div><!--  #idx_wrapper -->

    <!--메인 재능상품 1차 카테고리(아이콘) 영역-->
    <div id="main_item">
        <div class="in cf">
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/campaign_sns_list.php">
                    <i class="fa-light fa-camera-polaroid"></i>
                    <h2>SNS 포스팅</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/campaign_design_list.php">
                    <i class="fa-light fa-object-group"></i>
                    <h2>디자인</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/campaign_exp_list.php">
                    <i class="fa-light fa-calendar-star"></i>
                    <h2>체험단</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인" tooltip="기존 거래는 여기서!">
                    <i class="fa-light fa-icons"></i>
                    <h2>재능거래</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/compete_list.php">
                    <i class="fa-light fa-boombox"></i>
                    <h2>공모전</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/market_list.php">
                    <i class="fa-light fa-store"></i>
                    <h2>마켓</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/job_list.php">
                    <i class="fa-light fa-address-card"></i>
                    <h2>구인구직</h2>
                </a>
            </div>
        </div><!--in-->
    </div><!--main_item-->
    <div id="banner" class="gray">
        <h6><b class="txt_color2">트렌디한 청년인력을 찾고있나요?</b></h6>
        <h6 class="txt_bold2 txt_color2">잡고가 소개시켜드려요!</h6>
        <h6 class="txt_thin">#체험단 #SNS #디자인</h6>
        <button type="button" class="btn btn_white txt_color2" onclick="location.href='./new_campaign.php'">협업문의 <i class="fa-solid fa-right"></i></button>
    </div>



    <div id="goods">
        <!--  캠페인  -->
        <div class="in section_area">
            <h2 class="title">함께 할 청년 <strong>여기 여기 모여라</strong></h2>
            <div class="list">
                <?php
                for ($i = 0; $i < 4; $i++) {
                ?>
                <div class="thm">
                    <div class="mg">
                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php">
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
                                <div class="count">
                                    <b class="txt_color">0</b>/5
                                </div>
                                <p>모집중</p>
                            </div>
                        </div>
                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php">
                            <div class="tit">이름</div>
                            <div class="txt_color">기업명</div>
                        </a>
                    </div>
                </div><!--thm-->

                <?php } ?>
            </div><!--list-->
        </div><!--in-->

    </div><!--goods-->

    <div id="banner" class="black">
        <h6><b class="txt_color3">대학생에게 필요한 ○○</b></h6>
        <h6 class="txt_bold2 txt_white">용돈, 알바, 대외활동!</h6>
        <h6 class="txt_thin txt_white">잡고가 함께 해요</h6>
        <button type="button" class="btn btn_black" onclick="location.href='<?php echo G5_URL ?>/new_cpn_service.php'">새로워진 잡고 <i class="fa-solid fa-right"></i></button>
    </div>

    <div id="idx_wrapper" class="mb25">
        <div id="visual">
            <ul class="sliderbx">

                <?php //관리자: 상단배너관리에서 넣은 이미지 불러오기
                echo banner('top'); ?>


            </ul><!--.sliderbx-->
        </div><!-- //visual -->
    </div>

    <div id="goods">
        <!--  재능거래 (구.인기재능)  -->
        <div class="in section_area">
            <h2 class="title">내가 가진 능력으로 <strong>재능거래</strong></h2>
            <div class="list">
                <?php
                //리스트 쿼리(code_use => 카테고리 사용중인것만 데이터 표출)
                $sql = "SELECT ta.*,
                    (select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay
                    , (select COUNT(*) idx from new_like li where ta.ta_idx = li.ta_idx) li_cnt
                    ,(select count(*) from new_payment_review pr where ta.ta_idx = pr.ta_idx) as review_count
            FROM {$g5['talent_table']} as ta
            left join new_code as cd2 on cd2.code_idx = ta.ta_category2
            left join new_code as cd3 on cd3.code_idx = ta.ta_category3
            where cd2.code_use = '1' and cd3.code_use = '1' and ta_imsi = 'N' and ta.wr_datetime >= '".date("Y-m-d H:i:s", strtotime(G5_TIME_YMDHIS." -5 months"))."'
            order by li_cnt desc, review_count desc limit 8 ";
                $result = sql_query($sql);


                for ($i = 0;  $row = sql_fetch_array($result); $i++){
                    //ios 스토어업데이트를 위해 추가한 신고..
                    $sql = "select count(*) cnt from new_report where mb_id = '{$member["mb_no"]}' and r_p_idx= '{$row['ta_idx']}' ";
                    $report_cnt = sql_fetch($sql)["cnt"];
                    if ($report_cnt > 0){
                        continue;
                    }

                    include(G5_BBS_PATH."/li_content.php")
                    ?>

                <?php } ?>
            </div><!--list-->
        </div><!--in-->

    </div><!--goods-->


    <div id="idx_wrapper">
        <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
            <ul class="sliderbx">

                <?php //관리자: 하단배너관리에서 넣은 이미지 불러오기
                echo banner('btm'); ?>


            </ul><!--.sliderbx-->
        </div><!-- //visual -->
    </div>

<?php /*{?>

    <div id="idx_wrapper">

        <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
            <ul class="sliderbx">

                <?php //관리자: 하단배너관리에서 넣은 이미지 불러오기
                echo banner('top'); ?>

            </ul><!--.sliderbx-->
        </div><!-- //visual -->

        <!--메인슬라이더 시작-->
        <?php /* <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
        <ul class="sliderbx">
        	<li class="mv01">
            	<div id="mg">
                	<div class="a wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.5s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img1_01.png"></div>
                    <div class="b wow fadeInRightBig animated" data-wow-delay="0.2s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img1_02.png"></div>
                    <div class="c wow bounceInUp animated" data-wow-delay="1s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img1_03.png"></div>
                </div>
                <div id="slogan">
                    <div class="txt01 wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong>재능있는 청년</strong> <?php echo $config['cf_title']; ?>에 다 모였다!</div>
                    <div class="txt02 wow fadeInDown animated" data-wow-delay="1.5s" data-wow-duration="0.8s">내가 원하는 재능을</div>
                    <div class="txt03 wow fadeInUp animated" data-wow-delay="2s" data-wow-duration="0.8s">가장 쉽고 빠르게</div>
                </div>
            </li>
        	<li class="mv02">
            	<div id="mg">
                	<div class="d wow fadeInLeft animated" data-wow-delay="0.2s" data-wow-duration="0.5s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_01.png"></div>
                    <div class="e wow fadeInRightBig animated" data-wow-delay="0.6s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_02.png"></div>
                    <div class="f wow bounceInDown animated" data-wow-delay="1s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_03.png"></div>
                    <div class="g wow bounceInUp animated" data-wow-delay="1.4s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_04.png"></div>
                    <div class="h wow bounceInUp animated" data-wow-delay="1.8s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_05.png"></div>
                </div>
                <div id="slogan">
                    <div class="txt02 wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="0.8s">어떤 <strong>수업</strong>을<br />찾으시나요?</div>
                    <div class="txt01 wow fadeInUp animated" data-wow-delay="1.5s" data-wow-duration="0.8s">각 분야의 재능 전문가가 알려드려요.</div>
                </div>
            </li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->  ?>
    </div><!--  #idx_wrapper -->

    <!--메인 재능상품 1차 카테고리(아이콘) 영역-->
    <div id="main_item">
        <div class="in cf">
            <?php $code = common_code('ctg','code_ctg','json');
            for ($i = 0; $i <count($code); $i++){
                $code2 = common_code($code[$i]['idx'],'code_p_idx','json');
//            $code3 = common_code($code2[0]['idx'],'code_p_idx','json');

                if ($i == 0 ){
                    $number = 3;
                }else if ($i > 5){
                    $number = $i+2;

                    if ($i == 8){
                        $number = 12;
                    }
                    if ($i == 9){
                        $number = 11;
                    }

                }else if ($i > 2 ){
                    $number = $i+1;
                }else{
                    $number = $i;
                }

                if ($i != 8 && $i != 9){
                    $number = '0'."".$number;
                }

                ?>
                <div class="item">
                    <a href="<?php echo G5_BBS_URL; ?>/category_list.php?category=<?=$code[$i]['name']?>">
                        <div class="ico">
                            <div class="l"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate<?=$number?>.png"></div>
                            <div class="r"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate<?=$number?>_on.png"></div>
                        </div>
                        <h2><?=$code[$i]['name']?></h2>
                    </a>
                </div>
            <?php } ?>
            <? /*<div class="item">
            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=video_lecture">
                <div class="ico">
                    <div class="l"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate10.png"></div>
                    <div class="r"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate10_on.png"></div>
                </div>
                <h2>재능강의</h2>
            </a>
        </div>
        <div class="item">
            <a href="<?php echo G5_BBS_URL; ?>/contest_list.php">
                <div class="ico">
                    <div class="l"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate07.png"></div>
                    <div class="r"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate07_on.png"></div>
                </div>
                <h2>공모전</h2>
            </a>
        </div> ?>

        </div><!--in-->
    </div><!--main_item-->





<div id="goods">
<!--  인기재능  -->
    <div class="in section_area">
        <h2 class="title">회원들의 <strong>인기</strong> 서비스</h2><!--회원들이 많이 검색하고 찾아본 상품들이 추출될 예정-->
        <div class="list cf">
            <?php
            //리스트 쿼리(code_use => 카테고리 사용중인것만 데이터 표출)
            $sql = "SELECT ta.*,
                    (select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay
                    , (select COUNT(*) idx from new_like li where ta.ta_idx = li.ta_idx) li_cnt
                    ,(select count(*) from new_payment_review pr where ta.ta_idx = pr.ta_idx) as review_count
            FROM {$g5['talent_table']} as ta
            left join new_code as cd2 on cd2.code_idx = ta.ta_category2
            left join new_code as cd3 on cd3.code_idx = ta.ta_category3
            where cd2.code_use = '1' and cd3.code_use = '1' and ta_imsi = 'N' and ta.wr_datetime >= '".date("Y-m-d H:i:s", strtotime(G5_TIME_YMDHIS." -5 months"))."'
            order by li_cnt desc, review_count desc limit 8 ";
            $result = sql_query($sql);


            for ($i = 0;  $row = sql_fetch_array($result); $i++){
                //ios 스토어업데이트를 위해 추가한 신고..
                $sql = "select count(*) cnt from new_report where mb_id = '{$member["mb_no"]}' and r_p_idx= '{$row['ta_idx']}' ";
                $report_cnt = sql_fetch($sql)["cnt"];
                if ($report_cnt > 0){
                    continue;
                }

                include(G5_BBS_PATH."/li_content.php")
                ?>

            <?php } ?>
        </div><!--list-->
    </div><!--in-->

	<div class="in">
        <h2 class="title">신규 <strong>재능</strong> 서비스</h2><!--회원들이 많이 검색하고 찾아본 상품들이 추출될 예정-->
        <div class="list cf">
            <?php
            //리스트 쿼리(code_use => 카테고리 사용중인것만 데이터 표출)
            $sql = "SELECT ta.*,
                    (select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay
                    FROM {$g5['talent_table']} as ta
            left join new_code as cd2 on cd2.code_idx = ta.ta_category2
            left join new_code as cd3 on cd3.code_idx = ta.ta_category3
            where cd2.code_use = '1' and cd3.code_use = '1' and ta_imsi = 'N' 
            order by ta.wr_datetime desc limit 8 ";

            $result = sql_query($sql);

            for ($i = 0;  $row = sql_fetch_array($result); $i++){
                //ios 스토어업데이트를 위해 추가한 신고..(test@naver.com만 나오게 했음. limit 깨져도 상관쓰지말기.)
                $sql = "select count(*) cnt from new_report where mb_id = '{$member["mb_no"]}' and r_p_idx= '{$row['ta_idx']}' ";
                $report_cnt = sql_fetch($sql)["cnt"];
                if ($report_cnt > 0){
                    continue;
                }

                include(G5_BBS_PATH."/li_content.php")
                ?>

            <?php } ?>
        </div><!--list-->
    </div><!--in-->
</div><!--goods-->



	 <?php /*
 <!-- 뼈살동 추가 0621 -->
 <div class="in Ver2">
		<h2 class="title">뼈 · 살 · 동 <span>뼈와 살이 되는 동영상</span></h2><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=video_lecture" title="뼈와 살이 되는 동영상 바로가기" class="more">MORE</a>
		<div class="list">
            <?php $sql = "select * from g5_write_video_lecture order by wr_id desc limit 5";
            $result = sql_query($sql);
            for ($i = 0;  $row = sql_fetch_array($result); $i++){
                $mb = get_member($row['mb_id']);
                ?>

			<div class="thm">
				<div class="mg">
                    <a href="<?= G5_BBS_URL."/board.php?bo_table=video_lecture&wr_id=".$row['wr_id'] ?>"><p class="youtube_icon"><i class="fab fa-youtube"></i></p>
						<div class="mg_in">
							<div class="over">
                                <?php
                                $thumb = get_list_thumbnail($board['bo_table'], $row['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
                                if($thumb['src']) {
                                    $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'" class="img">';
                                } else {
                                    $youtube_key = substr($row['wr_link1'],-11,11);

                                    if($youtube_key){
                                        $img_content = '<img src="https://img.youtube.com/vi/'.$youtube_key.'/mqdefault.jpg" alt="'.$thumb['alt'].'" width="100%" height="100%"">';
                                    }else{
                                        $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;line-height:'.$board['bo_gallery_height'].'px" class="noimg">no image</span>';
                                    }
                                }

                                echo $img_content;
                                ?>
<!--							   <iframe  src="https://www.youtube.com/embed/hp7TJRksIC8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
							</div>
						</div><!--영상-->
					</a>
				</div><!--mg-->
                <a href="<?= G5_BBS_URL."/board.php?bo_table=video_lecture&wr_id=".$row['wr_id'] ?>">
				<div class="info">
					<div id="lecture_writer_list">
						<div class="mb">
							<div class="photo">
                                <?php
                                $mb_dir = substr($row['mb_id'],0,2);
                                $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$row['mb_id'].'.jpg';
                                if (file_exists($icon_file)) {
                                    $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$row['mb_id'].'.jpg';
                                    echo '<img src="'.$icon_url.'" class="p_img" alt="">';
                                }else{
                                    echo '<img src="'.G5_THEME_IMG_URL.'/sub/default.png" alt="">';
                                }
                                ?>
                            </div>
							<div class="mb_info">
								<p><?= $mb['mb_nick'] ?></p>
							</div>
						</div>
					</div>
                    <div class="tit"><?= $row['wr_subject'] ?></div>
				</div>
                </a>

			</div>
        <?php } ?>


		</div>
		
	</div> 
	<!-- /in 뼈상동 끝 -->


</div><!--goods-->


<!--공모전 추출-->
<? /*<div id="m_contest">

    <!--왼쪽 신규 공모전-->
    <div id="m_con_left">
          
                    <div class="m_con_goods">
                        <div class="in">
                            <h2 class="title"><strong>신규</strong> 공모전 <span class="m_con_more">더보기</span></h2>
                            <div class="list cf">
                                <?php
                                $sql = "select * from new_competition order by cp_idx desc limit 6";
                                $result = sql_query($sql);
                                for ($i = 0; $row = sql_fetch_array($result); $i++){ ?>
                                <div class="thm">

                                        <div class="mg">
                                            <div class="heart" name="heart_div_<?=$row['cp_idx']?>_com">
                                                <?php
                                                $like_sql = "select li_idx from {$g5['like_table']} where ta_idx = '{$row['cp_idx']}' and li_table = 'competition' and mb_id = '{$member['mb_id']}' ";
                                                $like_row = sql_fetch($like_sql);
                                                if (isset($like_row['li_idx'])){ ?>
                                                    <button type="button" onclick="like_chk('off','<?=$row['cp_idx']?>_com','competition','main')" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                                                <?php }else{ ?>
                                                    <button type="button" onclick="like_chk('on','<?=$row['cp_idx']?>_com','competition','main')" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                                                <?php } ?>
                                            </div>
                                            <a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$row['cp_idx']?>">
                                            <div class="mg_in"><div class="over">
                                                    <?php $sql = "select * from {$g5['board_file_table']} where wr_id = {$row['cp_idx']} and bo_table = 'competition_main' ";
                                                    $img = sql_fetch($sql);
                                                    $img_file = G5_DATA_PATH.'/file/competition_main/'.$img['bf_file'];
                                                    if (file_exists($img_file) && $img['bf_file'] != ""){
                                                        echo '<img src="'. G5_DATA_URL.'/file/competition_main/'.$img['bf_file'].'">';
                                                    }else{
                                                        // echo '<img src="'. G5_THEME_IMG_URL.'/main/heart_on.png">';
                                                        echo "<div class='no_img'>로고 이미지가 없습니다.</div>";
                                                    }
                                                    ?>
                                                </div></div><!--상품사진-->
                                            </a>
                                        </div><!--mg-->
                                    <a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$row['cp_idx']?>">

                                    <div class="info">
                                            <div class="tit"><?=$row['cp_title']?></div><!--상품제목(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                            <div class="rate cf">
                                                <div class="star"><span><i class="fas fa-user-friends"></i> <?= comp_apply_cnt($row['cp_idx']);?>명 참여</span></div>
                                            </div>
                                        </div>
                                    </a>


                                </div>
                                <?php } ?>
                            </div><!--list-->
                        </div><!--in-->
                    </div>
          
    </div>

    <!--오른쪽 진행중인 공모전-->
    <div id="m_con_right">
          <h2 class="title"><strong>진행중인</strong> 공모전 
              <span class="m_con_filter">
                       <div class="mbtn_gr">
                            <ul>
                                <li><a href="javascript:ing_competition('price')" name = "a_ing" id="price_a">상금 순</a></li>
                                <li><a href="javascript:ing_competition('date')" name = "a_ing" id="date_a">마감임박 순</a></li>
                            </ul>
                       </div>
              </span>
          </h2>
                     <div id="m_con_ing">
                            <div class="in">
                                <div class="rev cf" id="ing_div">

                                </div><!--rev-->
                            </div><!--in-->
                            <div class="m_con_img_more"><a href="<?=G5_BBS_URL?>/contest_list.php">진행중인 공모전 더 보기</a></div>
                        </div>          
    </div>
</div>
<!--//공모전 추출-->

<div id="idx_wrapper">
    <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
          <ul class="sliderbx">
                
                <?php //관리자: 하단배너관리에서 넣은 이미지 불러오기
                echo banner('btm'); ?>
    
                
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div>

<div class="hidden-lg hidden-md"><div class="b_margin100"></div></div>

<!--<div id="event">-->
<!--	<div class="in">-->
<!--    	<h2 class="title"><img src="--><?php //echo G5_THEME_IMG_URL ?><!--/main/event_banner01.png" title="회원가입이벤트"></h2>-->
<!--        <div class="mg"><img src="--><?php //echo G5_THEME_IMG_URL ?><!--/main/event_banner02.png" title="회원가입이벤트"></div>-->
<!--    </div>-->
<!--</div>-->
 ?>


<?php }*/?>

    <!--인기카테고리 추출 스크립트(pc화면용)-->
    <script>
        $('.slide-box').each(function(){
            $(this).slick({
                slidesToShow:5,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
                accessibility: true,
                arrows: true,
                prevArrow: $(this).parents('.slide-wrap').find('.btn-prev'),
                nextArrow: $(this).parents('.slide-wrap').find('.btn-next'),
                speed: 300,
                autoplay: false,
                autoplaySpeed: 1000,
                responsive: [  // 반응형일때 원하는 사이즈에서 보여지는 갯수 조절함
                    {
                        breakpoint: 990,
                        settings: {
                            slidesToShow: 3,
                        }
                    }
                ]

            })
        })

        //bx메인슬라이더시작
        $(document).ready(function(){
            $('.sliderbx').bxSlider({
                responsive : true,            // 반응형
                mode : 'fade',           // 'horizontal', 'vertical', 'fade'
                pager : false,                 // 페이지버튼 사용유무
                Controls : false,              // 좌우버튼 사용유무
                auto : true,                  // 자동재생
                pause : 5000,                  // 자동재생간격
                speed : 1000,                  // 이미지전환속도
                autoControls : false,          // 재생버튼 사용
                autoHover: true,
                autoControlsCombine : true,   // 플레이, 스탑버튼 교차
            });
        });


        function open_tab(f,type) {
            // 새탭으로 띄우기 = 1
            var link = $('#'+f.id).data('link');

            if (type == 1){
                window.open(link);
            }else{
                window.location = link
            }
        }
    </script>

<script>

    $(document).ready(function () {
        ing_competition('date');
    });

    function ing_competition(search) {
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.competition.php",
            data: {
                "mode" : "ing_competition",
                "search": search

            },
            dataType: "html",
            success: function(data) {
                $('[name = "a_ing"]').removeClass("current");
                $("#"+search+'_a').addClass("current");
                $('#ing_div').html(data);

            }
        });
    }
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>