<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<script>
	function checkVisible( element, check = 'above' ) {
    const viewportHeight = $(window).height(); // Viewport Height
    const scrolltop = $(window).scrollTop(); // Scroll Top
    const y = $(element).offset().top;
    const elementHeight = $(element).height();   
    
    // 반드시 요소가 화면에 보여야 할경우
    if (check == "visible") 
    	return ((y < (viewportHeight + scrolltop)) && (y > (scrolltop - elementHeight)));
        
    // 화면에 안보여도 요소가 위에만 있으면 (페이지를 로드할때 스크롤이 밑으로 내려가 요소를 지나쳐 버릴경우)
    if (check == "above") 
    	return ((y < (viewportHeight + scrolltop)));
	}

	// 리소스가 로드 되면 함수 실행을 멈출지 말지 정하는 변수
	let isVisible = false;

	// 이벤트에 등록할 함수
	const func = function () {
		if ( !isVisible && checkVisible('#area_youtube') ) {
			document.getElementById( 'youtube' ).setAttribute( 'src', 'https://www.youtube.com/embed/AD7p86IqPt4?rel=0&amp;autoplay=1&mute=1&amp;loop=1;playlist=AD7p86IqPt4' );
			//alert("엘리먼트 보임 !!");
			isVisible = true;
		}

		// 만일 리소스가 로드가 되면 더이상 이벤트 스크립트가 있을 필요가 없으니 삭제
		isVisible && window.removeEventListener('scroll', func);
	}

	// 스크롤 이벤트 등록
	window.addEventListener('scroll', func);
</script>
<div id="wrapper">
	<div id="area_main">
		<div class="inr v3">
			<div class="area_txt main">
				<ul class="tabs">
					<li class="active" rel="tab2"><span>Quotation</span></li>
				</ul>
				<div class="tab_container">
					<div id="tab2" class="tab_content">
						<div class="txt">
							<h3>Do you have any <br>upcoming marine project? </h3>
							<span>Podosea will help you to find <br>the right companies for your projects.</span>

                            <form method="get" action="<?=G5_BBS_URL?>/company_search.php">
							<div class="main_sch">
								<input type="text" name="search" placeholder='Search "Engine", "Ship Repair"'>
								<button type="submit"></button>
							</div>
                            </form>
							<div class="btn_box"><a href="javascript:memberCheck('<?=$member['mb_category']?>');" class="btn_main">Request now!!</a></div>
						</div>
						<div class="area_img">
							<div class="imb_box01"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_tab02_01.jpg"></div>
							<div class="imb_box02"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_tab02_02.jpg"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="content">
        <!--div class="inr v4">
            <div id="helpme" class="new">
                <h3>Recently registered RFQs</h3>
                <a class="btn_more" href="<?php echo G5_BBS_URL ?>/company_list.php">See More</a>
                <ul class="list company">
                    <?php
                    // (포도씨에 직업 의뢰 건과 삭제 건 및 견적기한 지난 건은 리스트에서 제외 / 직접 의뢰 건 제외)
                    $rlt = sql_query(" select * from g5_company_inquiry where podosea != 'Y' and ci_deadline_date >= date_format(now(), '%Y-%m-%d') and ci_state = 'Processing Submission' and target_mb_no = 0 and del_yn is null order by wr_datetime desc limit 0, 8 ");
                    $i = 0;
                    while($row = sql_fetch_array($rlt)) {
                        $i++;
                        $date = $row['ci_deadline_date'];
                        $todate = date("Y-m-d", time());
                        $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
                    ?>
                    <li class="list_help">
                        <?php if($member['mb_level'] == 3 || $is_admin) { ?>
                        <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$row['idx']?>">
                        <?php } else { ?>
                        <a onclick="memberCheck('<?=$member['mb_category']?>');">
                            <?php } ?>
                            <div class="title">
                                <em><?=$row['ci_category']?></em><!-- 카테고리 -->
                                <!--h3><?=$row['ci_subject']?></h3> <!-- 제목 -->
                            <!--/div>
                            <div class="cont">
                                <ul class="list_text">
                                    <li class="text"><em>Maker</em><span><?=$row['ci_maker']?> </span></li>
                                    <li class="text"><em>Model</em><span><?=$row['ci_model']?></span></li>
                                    <li class="period"><span><?=$dday?> days left</span></li>
                                </ul>
                                <div class="list_info">
                                    <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span> <!-- 의뢰올린날자 -->
                                <!--/div>
                            </div>
                        </a>
                    </li>
                    <?php
                    }
                    if($i == 0) {
                    ?>
                    <li class="nodata">There is no registered company request.</li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div-->

        <div id="area_bn">
			<div class="inr v4">
			<div class="txt">
				<h2>Experience Podosea's all-in-one package</h2>
				<span>Homepage + Online Advertisement + Communication Tools</span>
				<div class="area_btn"><a href="<?=G5_BBS_URL?>/register_company_form.php">Sign up as Podosea Member</a></div>
			</div>
			<div class="obj"><img src="<?php echo G5_THEME_IMG_URL ?>/app/bn_obj.png"></div>
			</div>
		</div>

		<div class="inr v3">
			<div id="helpme" class="company">
				<h3>Search for Podosea Popular Members!</h3>
				<a class="btn_more" href="<?php echo G5_BBS_URL ?>/company_search.php">See More Companies</a>

                <?php
                // 거래완료 많은 순으로 10개 - 22.02.10 업체에서 다른 기업이 안보인다하여 정렬 변경 - 22.04.06 프로필 작성한 회원만 보이게
                $rlt = sql_query(" select * from g5_member where mb_category = '기업' and mb_level != 1 and mb_intercept_date = '' and mb_id not in ('test01', 'test02', 'test03') order by sort is not null asc, field(mb_grade, 'Premium') desc, mb_hashtag is null asc, mb_no desc limit 10 ");
                ?>
				<div class="swiper_wrap">
					<!-- Add Arrows -->
					<div class="swiper-button-next best"></div>
					<div class="swiper-button-prev best"></div>

					<div class="swiper-container">
						<div class="swiper-wrapper">
                            <?php
                            $i=0;
                            while($row=sql_fetch_array($rlt)) {
                                $i++;
                            ?>
                            <div class="swiper-slide list_help">
                                <a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$row['mb_no']?>">
                                    <div class="area_logo"><?=getProfileImg($row['mb_id'], $row['mb_category'])?></div>
                                    <div class="area_name"><h4><?=$row['mb_company_name']?></h4></div>
                                </a>
                            </div>

							<?php
                            }
                            if($i == 0) {
                            ?>
                            <div class="nodata">There are no registered corporate members.</div>
                            <?php
                            }
                            ?>
							<!--<div class="swiper-slide list_help">
								<a href="">
									<div class="area_logo"><img src="<?php /*echo G5_THEME_IMG_URL */?>/app/img_logo02.jpg"></div>
									<div class="area_name"><h4>현대중공업</h4></div>
								</a>
							</div>
							<div class="swiper-slide list_help">
								<a href="">
									<div class="area_logo"><img src="<?php /*echo G5_THEME_IMG_URL */?>/app/img_logo03.jpg"></div>
									<div class="area_name"><h4>삼성중공업</h4></div>
								</a>
							</div>
							<div class="swiper-slide list_help">
								<a href="">
									<div class="area_logo"><img src="<?php /*echo G5_THEME_IMG_URL */?>/app/img_logo04.jpg"></div>
									<div class="area_name"><h4>한국조선해양</h4></div>
								</a>
							</div>
							<div class="swiper-slide list_help">
								<a href="">
									<div class="area_logo"><img src="<?php /*echo G5_THEME_IMG_URL */?>/app/img_logo01.jpg"></div>
									<div class="area_name"><h4>한국조선해양</h4></div>
								</a>
							</div>-->
						</div>
					</div>
				</div>

				<a class="btn_more02" href="<?php echo G5_BBS_URL ?>/company_search.php">See more companies +</a>
			</div>

			<div id="area_notice">
				<h3>NOTICE</h3>
				<div class="list">
                    <?php
                    $notice = sql_fetch("select * from g5_write_notice order by wr_id desc limit 1");
                    ?>
					<a href="<?=G5_BBS_URL?>/board.php?bo_table=notice&wr_id=<?=$notice['wr_id']?>">
						<span><?=$notice['wr_subject']?></span>
						<em><?=str_replace('-','.',$notiec['wr_datetime'])?></em>
					</a>
				</div>
			</div>
			<div id="area_youtube">
				<div class="iframe">
					<iframe id="youtube" width="100%" src="https://www.youtube.com/embed/AD7p86IqPt4?rel=0&amp;playlist=AD7p86IqPt4" frameborder="0"></iframe>
				</div>
			</div>
			
		</div>
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.php');
?>
