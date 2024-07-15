<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_MOBILE_PATH.'/head.php');

// 팝업레이어 추가
if (defined('_INDEX_')) {
    include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<!-- 프로필 업데이트 모달팝업 -->
<div id="basic_modal">
    <div class="modal fade" id="profileChkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">프로필 업데이트</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <div class="area_box">
                            <h3 style="font-size: 18px;margin-bottom: 10px;">프로필 업데이트 완료 후<br/>
                                바로 확인이 가능하세요!<br/>
                                잠시만 시간을 내어주시겠어요?
                            </h3>
                            <a href="<?=$profile_url?>">프로필 업데이트</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //프로필 업데이트 모달팝업 -->

<div id="wrapper">
	<div id="area_main">
		<img class="main_bg" src="<?php echo G5_THEME_IMG_URL ?>/app/main_bg.jpg">
		<div class="inr v3">
			<div class="area_txt main">
				<ul class="tabs">
                    <li class="active" rel="tab1"><span>Question</span></li>
                    <!--<li rel="tab2"><span>Quotation</span></li>-->
				</ul>
				<div class="tab_container">
					<div id="tab1" class="tab_content">
						<div class="txt">
							<span>더 이상 혼자 고민 하지 마세요</span>
							<h3 class="w">최고의 해양 전문가를 <br>지금 바로 만나보세요!</h3>
							<h3 class="m">최고의 해양 전문가를 <br>지금 바로 만나보세요!</h3>
                            <form method="get" action="<?=G5_BBS_URL?>/help_list.php">
                            <div class="main_sch">
								<input type="text" name="search" placeholder="질문을 입력해 주세요.">
								<button type="submit"></button>
							</div>
                            </form>
							<div class="btn_box"><a href="<?=G5_BBS_URL?>/help_write.php" class="btn_main">바로 질문하기!!</a></div>
						</div>
						<div class="area_img">
							<div class="swiper mainSwiper">
							  <div class="swiper-wrapper">
								<div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_obj01.png"></div>
							  </div>
							</div>
						</div>
					</div>
					<div id="tab2" class="tab_content" style="display: none;">
						<div class="txt">
							<h3>계획중인 조선해양 <br>프로젝트가 있나요?</h3>
							<span>지금 바로 의뢰하고 견적을 받으세요!</span>

                            <form method="get" action="<?=G5_BBS_URL?>/company_search.php">
							<div class="main_sch">
								<input type="text" name="search" placeholder="회사를 검색해 보세요.">
								<button type="submit"></button>
							</div>
                            </form>
							<div class="btn_box"><a href="javascript:memberCheck('<?=$member['mb_category']?>', '', 'podosea');" class="btn_main">바로 의뢰하기!!</a></div>
						</div>
						<div class="area_img">
							<div class="swiper mainSwiper">
							  <div class="swiper-wrapper">
								<div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_obj02.png"></div>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--
			<div class="area_img">
				<div class="swiper mainSwiper">
				  <div class="swiper-wrapper">
					<div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_obj01.png"></div>
					<div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_obj02.png"></div>
				  </div>
				</div>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			-->
		</div>
	</div>
	<div id="content">
		<div class="inr v4">
            <div id="helpme" class="best">
				<h3>인기 헬프미</h3>

				<div class="swiper_wrap">
					<!-- Add Arrows -->
					<div class="swiper-button-next best"></div>
					<div class="swiper-button-prev best"></div>

					<div class="swiper-container">
						<div class="swiper-wrapper">
                            <?php
                            // 인기 헬프미 - 좋아요순
                            $rlt = sql_query(" select * from g5_helpme where del_yn is null order by he_good desc, wr_datetime limit 0, 8 ");
                            $i = 0;
                            while($row = sql_fetch_array($rlt)) {
                                $i++;
                                // 조회수
                                $v_count = selectCount('g5_helpme_action', 'helpme_idx', $row['idx'], 'mode', 'view'); // 카운트 조회할 테이블명, 컬럼명, 데이터
                                // 답변수
                                $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$row['idx']}'; ")['count'];
                            ?>
                            <div class="swiper-slide list_help">
                                <a href="<?=G5_BBS_URL?>/help_view.php?idx=<?=$row['idx']?>">
                                    <i class="number"><?=sprintf('%02d', $i)?></i>
                                    <h3><?=$row['he_subject']?></h3>
                                    <span><?=strip_tags($row['he_contents'])?></span>
                                    <div class="info">
                                        <ul class="thums">
                                            <li class="good"><i></i><span><?=number_format($row['he_good'])?></span></li><!--좋아요-->
                                        </ul>
                                        <div class="list_info">
                                            <span class="view">조회수 <em><?=number_format($v_count)?></em></span>
                                            <span class="reply">답변수 <em><?=number_format($a_count)?></em></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            }
                            if($i == 0) {
                            ?>
                            <div>등록된 질문이 없습니다.</div>
                            <?php
                            }
                            ?>
						</div>
					</div>
				</div>
			</div>

			<div id="helpme" class="new" <?=$noshow_cls?>>
				<h3>답변을 기다리는 질문</h3>
				<a class="btn_more" href="<?php echo G5_BBS_URL ?>/help_list.php">더보기 +</a>
				<ul class="list">
                    <?php
                    // 답변을 기다리는 질문 - 최신순
                    $rlt = sql_query(" select * from g5_helpme where he_answer_state = '답변대기' and del_yn is null order by wr_datetime desc limit 0, 4 ");
                    $i = 0;
                    while($row = sql_fetch_array($rlt)) {
                        $i++;
                        // 조회수
                        $v_count = selectCount('g5_helpme_action', 'helpme_idx', $row['idx'], 'mode', 'view'); // 카운트 조회할 테이블명, 컬럼명, 데이터
                        // 답변수
                        $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$row['idx']}'; ")['count'];
                    ?>
                    <li class="list_help">
                        <a href="<?=G5_BBS_URL?>/help_view.php?idx=<?=$row['idx']?>">
                            <h3><?=$row['he_subject']?></h3> <!-- 제목 -->
                            <span><?=strip_tags($row['he_contents'])?></span> <!-- 내용 -->
                            <div class="info">
                                <ul class="thums">
                                    <li class="good"><i></i><span><?=number_format($row['he_good'])?></span></li><!--좋아요-->
                                </ul>
                                <div class="list_info">
                                    <span class="view">조회수 <em><?=number_format($v_count)?></em></span>
                                    <span class="reply">답변수 <em><?=number_format($a_count)?></em></span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php
                    }
                    if($i == 0) {
                    ?>
                    <li>등록된 질문이 없습니다.</li>
                    <?php
                    }
                    ?>
				</ul>
			</div>

			<div id="helpme" class="new" style="display: none;">
				<h3>최근 등록 기업의뢰</h3>
				<a class="btn_more" href="<?php echo G5_BBS_URL ?>/company_list.php">더보기 +</a>
				<ul class="list company">
                    <?php
                    // (포도씨에 직업 의뢰 건과 삭제 건 및 견적기한 지난 건은 리스트에서 제외 / 직접 의뢰 건 제외)
                    $rlt = sql_query(" select * from g5_company_inquiry where podosea != 'Y' and ci_deadline_date >= date_format(now(), '%Y-%m-%d') and ci_state = '접수대기' and target_mb_no = 0 and del_yn is null order by wr_datetime desc limit 0, 8 ");
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
                                <h3><?=$row['ci_subject']?></h3> <!-- 제목 -->
                            </div>
                            <div class="cont">
                                <ul class="list_text">
                                    <li class="text"><em>Maker</em><span><?=$row['ci_maker']?> </span></li>
                                    <li class="text"><em>Model</em><span><?=$row['ci_model']?></span></li>
                                    <li class="period"><span><?=$dday?>일 남음</span></li>
                                </ul>
                                <div class="list_info">
                                    <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span> <!-- 의뢰올린날자 -->
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php
                    }
                    if($i == 0) {
                    ?>
                    <li class="nodata">등록된 기업의뢰가 없습니다.</li>
                    <?php
                    }
                    ?>
				</ul>
			</div>
		</div>

        <?php if($reference_test) { ?>
        <div id="area_shop" class="idx">
            <div class="inr v4">
                <h3>인기 자료리스트</h3>
                <ul class="shop_list">
                    <div>
                        <ul class="list">
                            <?php
                            $rlt = sql_query(" select a.*, (select count(idx) from g5_reference_room_download where reference_idx = a.idx) as download from g5_reference_room as a where a.del_yn = 'N' order by download desc limit 8 ");
                            for($i=0; $row=sql_fetch_array($rlt); $i++) {
                                //해시태그
                                $hashtag = '';
                                if(!empty($row['rr_hashtag'])) {
                                    $tag = explode(',',$row['rr_hashtag']);
                                    for($j=0; $j<count($tag); $j++) {
                                        $hashtag .= '<li onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
                                    }
                                }
                                $thumb_img = sql_fetch("SELECT * FROM g5_reference_room_file WHERE reference_idx = '{$row['idx']}' AND mode = 'thumb' ORDER BY idx limit 1")['img_file'];
                                $thumb_src = G5_DATA_URL.'/file/reference/'.$thumb_img;

                                $rr_cls = '';
                                $mode = 'add';
                                // 찜 목록에 있음
                                $cnt = sql_fetch(" SELECT COUNT(*) AS cnt from g5_like_reference WHERE reference_idx = '{$row['idx']}' AND mb_id = '{$member['mb_id']}' ")['cnt'];
                                if($cnt > 0) {
                                    $rr_cls = 'on';
                                    $mode = 'del';
                                }

                                // 구매 수
                                $buy_count = sql_fetch(" select count(*) as cnt from g5_reference_room_sale where reference_idx = '{$row['idx']}' ")['cnt'];

                                $code = base64_encode("refer".rand(0,100).'_'.$row['idx']);
                            ?>
                            <li>
                                <a href="<?=G5_BBS_URL?>/shop_view.php?code=<?=$code?>">
                                <div class="img">
                                    <p class="img_wrap"><img src="<?=$thumb_src?>"></p>
                                    <p class="wish wish_<?=$row['idx']?> <?=$rr_cls?>" onclick="event.preventDefault();likeReference('<?=$row['idx']?>', '<?=$mode?>')"><i class="fal fa-heart"></i></p>
                                    <?php if($row['rr_is_free']=='N') { ?><p class="coin">유료</p><?php } ?>
                                </div>
                                <div class="text">
                                    <ul class="tag"><?=$hashtag?></ul>
                                    <p class="title"><?=$row['rr_subject']?></p>
                                    <?php /*if($row['rr_is_free'] == 'N') { */?><!--
                                    <p class="gray">구매 <?/*=number_format($buy_count)*/?>개</p>
                                    <?php /*} else { */?>
                                    <p class="gray">다운로드 <?/*=number_format($row['download'])*/?>회</p>
                                    --><?php /*} */?>
                                    <p class="gray">구매 <?=number_format($buy_count)?>개</p>
                                    <p class="price"><?php if($row['rr_is_free']=='N') { ?><strong><?=number_format($row['rr_price'])?></strong>원<?php } else { ?>무료<?php } ?></p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                                </a>
                            </li>
                            <?php
                            }
                            ?>
                            <!--
                            <li>
                                <div class="img">
                                    <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/tSglB1647239554.png"></p>
                                    <p class="wish"><i class="fal fa-heart"></i></p>
                                    <p class="coin">유료</p>
                                </div>
                                <div class="text">
                                    <ul class="tag"><li>#소비심리학</li></ul>
                                    <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                    <p class="gray">구매 43개</p>
                                    <p class="price"><strong>13,000</strong>원</p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                            </li>
                            <li>
                                <div class="img">
                                    <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/9cyLA1638845259.jpg"></p>
                                    <p class="wish"><i class="fal fa-heart"></i></p>
                                </div>
                                <div class="text">
                                    <ul class="tag"><li>#소비심리학</li></ul>
                                    <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                    <p class="gray">구매 43개</p>
                                    <p class="price">무료</p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                            </li>
                            <li>
                                <div class="img">
                                    <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/yoV3u1647857755.jpg"></p>
                                    <p class="wish"><i class="fal fa-heart"></i></p>
                                </div>
                                <div class="text">
                                    <ul class="tag"><li>#소비심리학</li></ul>
                                    <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                    <p class="gray">구매 43개</p>
                                    <p class="price">무료</p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                            </li>
                            <li>
                                <div class="img">
                                    <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/OHgJ71626246194.jpg"></p>
                                    <p class="wish"><i class="fal fa-heart"></i></p>
                                </div>
                                <div class="text">
                                    <ul class="tag"><li>#소비심리학</li></ul>
                                    <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                    <p class="gray">구매 43개</p>
                                    <p class="price"><strong>13,000</strong>원</p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                            </li>
                            <li>
                                <div class="img">
                                    <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/w3qHe1596459002.jpg"></p>
                                    <p class="wish"><i class="fal fa-heart"></i></p>
                                </div>
                                <div class="text">
                                    <ul class="tag"><li>#소비심리학</li></ul>
                                    <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                    <p class="gray">구매 43개</p>
                                    <p class="price"><strong>13,000</strong>원</p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                            </li>
                            <li>
                                <div class="img">
                                    <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/wFALq1648643889.jpg"></p>
                                    <p class="wish"><i class="fal fa-heart"></i></p>
                                </div>
                                <div class="text">
                                    <ul class="tag"><li>#소비심리학</li></ul>
                                    <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                    <p class="gray">구매 43개</p>
                                    <p class="price"><strong>13,000</strong>원</p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                            </li>
                            <li>
                                <div class="img">
                                    <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/Rw50y1660809646.jpg"></p>
                                    <p class="wish"><i class="fal fa-heart"></i></p>
                                    <p class="coin">유료</p>
                                </div>
                                <div class="text">
                                    <ul class="tag"><li>#소비심리학</li></ul>
                                    <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                    <p class="gray">구매 43개</p>
                                    <p class="price"><strong>13,000</strong>원</p>
                                </div>
                                <div class="review">
                                    <strong><i class="fas fa-star"></i>5.0</strong>
                                    이제 4강정도 듣고 있는데 엄청 기대됩니다.
                                </div>
                            </li>-->
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
        <?php } ?>

		<div id="area_bn">
			<div class="inr v4">
			<div class="txt">
				<h2>만나지 않고 만난것 처럼</h2>
				<span>기업홈피 + 온라인광고 + 고객상담 및 연결까지 한번에 <br>포도씨에서 지금 바로 경험해 보세요</span>
				<div class="area_btn"><a href="<?=G5_BBS_URL?>/register_company_form.php">기업회원으로 가입하기</a></div>
			</div>
			<div class="obj"><img src="<?php echo G5_THEME_IMG_URL ?>/app/bn_obj.png"></div>
			</div>
		</div>

		<div class="inr v3">
			<div id="helpme" class="company">
				<h3>포도씨 인기 기업회원을 찾아보세요!</h3>
				<a class="btn_more" href="<?php echo G5_BBS_URL ?>/company_search.php">더 많은 기업보기 +</a>

                <?php
                // 프로필 업데이트 체크
                $profile_flag = profileUpdateCheck($member['mb_id'], $member['mb_level']);

                // 거래완료 많은 순으로 10개 - 22.02.10 업체에서 다른 기업이 안보인다하여 정렬 변경 - 22.04.06 프로필 작성한 회원만 보이게
                // * 쿼리 수정 시 ajax.company_search_list.php 쿼리도 같이 수정해야하는지 확인! *
                //$rlt = sql_query(" select count(ci.idx) as cnt, ci.*, mb.mb_company_name, mb.mb_no, mb.mb_category from g5_company_inquiry as ci left join g5_member as mb on mb.mb_id = ci.mb_id where ci.ci_state = '거래완료' group by ci.mb_id order by ci.idx desc limit 10; ");
                $rlt = sql_query(" select * from g5_member where mb_category = '기업' and mb_level != 1 and mb_intercept_date = '' and mb_id not in ('com01', 'test03') order by sort is not null asc, field(mb_grade, 'Premium') desc, mb_hashtag is null asc, mb_no desc limit 10 ");
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
                                <!--<a href="<?/*=G5_BBS_URL*/?>/company.php?mb_no=<?/*=$row['mb_no']*/?>">-->
                                <a onclick="profileCheck('<?=$row['mb_no']?>', 'company', '<?=$profile_flag?>', '<?=$member['mb_id']?>')">
                                    <div class="area_logo"><?=getProfileImg($row['mb_id'], $row['mb_category'])?></div>
                                    <div class="area_name"><h4><?=$row['mb_company_name']?></h4></div>
                                </a>
                            </div>

							<?php
                            }
                            if($i == 0) {
                            ?>
                            <div class="nodata">등록된 기업회원이 없습니다.</div>
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

				<a class="btn_more02" href="<?php echo G5_BBS_URL ?>/company_search.php">더 많은 기업보기 +</a>
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
		</div>

		<div id="area_appstore">
			<div class="inr">
				<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_app02.png"></div>
				<div class="area_txt">
					<h3>지금 포도씨 앱을 다운 받으세요!</h3>
					<ul class="list_link">
						<li><a href="https://apps.apple.com/kr/app/podosea-%EC%A1%B0%EC%84%A0%ED%95%B4%EC%96%91%EC%A0%84%EB%AC%B8%ED%94%8C%EB%9E%AB%ED%8F%BC-%ED%8F%AC%EB%8F%84%EC%94%A8/id1603740332" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_apple.png"></a></li>
						<li><a href="https://play.google.com/store/apps/details?id=kr.co.itforone.podosea" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_google.png"></a></li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</div>

<?php
include_once(G5_PATH.'/tail.php');
?>
