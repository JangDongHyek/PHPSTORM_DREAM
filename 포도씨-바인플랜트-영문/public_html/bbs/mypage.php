<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = 'Mypage';
include_once('./_head.php');

/** 일반 - 마이페이지 - 메인 **/

loginCheck($member['mb_id'], $member['mb_category']);
?>

<? if($name=="mypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="mypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
    .area_box .tag > li {
        display: inline-block;
        font-size: 12px;
        font-weight: 400;
        color: #5d89eb !important;
        margin: 0 3px 0 0;
        padding: 3px 7px;
        border: 1px solid #5d89eb;
        word-break: break-word;
        box-sizing: border-box;
        border-radius: 50px;
        line-height: 1em;
    }
</style>

    <div id="area_mypage">
		<div class="inr v3">

			<div id="area_my">
				<div class="myinfo">
					<!--<div class="lv_label lv1">
						<div class="txt">
							<h3>엑스<br>퍼트</h3>
						</div>
					</div>-->
					<div class="top_box first_box">
						<div class="box_wrap">
						<div class="myinfo_wrap">
							<div class="area_photo">
                            <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
							</div>
						</div>
						<div class="location"><span><?=$member['mb_si']?></span></div>
						<div class="id">
                            <i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><span><?=getNickOrId($member['mb_id'])?></span><a class="btn_arrow" href=""></a>
						</div>
						<div class="area_intro">
                            <?php if(!empty($member['mb_introduce'])) { ?>
							<p><?=$member['mb_introduce']?></p>
                            <?php } else { ?>
                            <div class="nodata"><p>No introduction written.</p></div>
                            <?php } ?>
						</div>
						<div class="area_nm">
							<em>My Podosea sea miles </em> <span class="blue"><?=number_format($member['mb_grade_point'])?>NM</span>
						</div>

						<div class="ranking">Bunker Ranking : <span class="blue"><?=getRanking($member['mb_id'])?></span>th</div>
						<!--
						<div class="area_lv">
							<div class="lv">
								<div class="lv_bar p50 lv1"></div>
							</div>
							<span class="left">Lv.1</span>
							<span class="right">Lv.2</span>
						</div>
						-->
						</div>
					</div>
					<div class="top_box second_box">
						<div class="area_box">
							<h3>Work experience</h3>
                            <?php if(!empty($member['mb_career'])) { ?>
                            <ul class="myinfo_list">
                                <?php
                                $mb_career = explode(',',$member['mb_career']);
                                for($k=0; $k<count($mb_career); $k++) {
                                ?>
                                <li><?=$mb_career[$k]?></li>
                                <?php } ?>
                            </ul>
                            <?php } else { ?>
                            <div class="nodata"><p>No registered work experience.</p></div>
                            <?php } ?>
						</div>
						<div class="area_box">
							<h3>Education and major</h3>
                            <?php if(!empty($member['mb_education'])) { ?>
							<ul class="myinfo_list">
                                <?php
                                $mb_education = explode(',',$member['mb_education']);
                                for($k=0; $k<count($mb_education); $k++) {
                                ?>
                                <li><?=$mb_education[$k]?></li>
                                <?php } ?>
							</ul>
                            <?php } else { ?>
                            <div class="nodata"><p>No registered education and major.</p></div>
                            <?php } ?>
						</div>
						<div class="area_box">
							<h3>Skills and/or certifications</h3>
							<?php if(!empty($member['mb_tech'])) { ?>
							<ul class="myinfo_list">
                                <?php
                                $mb_tech = explode(',',$member['mb_tech']);
                                for($k=0; $k<count($mb_tech); $k++) {
                                ?>
                                <li><?=$mb_tech[$k]?></li>
                                <?php } ?>
                            </ul>
                            <?php } else { ?>
                            <div class="nodata"><p>No registered skills and/or certifications.</p></div>
                            <?php }?>
						</div>
                        <div class="area_box">
                            <!--<h3>관심 키워드</h3>-->
                            <?php
                            if(!empty($member['mb_keyword'])) {
                                $tag = explode(',',$member['mb_keyword']);
                                for($i=0; $i<count($tag); $i++) {
                                    $hashtag .= '<li>'.$tag[$i].'</li>';
                                }
                                //echo '<ul class="tag">'.$hashtag.'</ul>';
                            }
                            ?>
                        </div>
					</div>
					<div class="top_box third_box">
						<div class="box_wrap02">
						<ul class="my_qna">
                            <?php
                            // 질문수
                            $q_count = sql_fetch(" select count(*) as count from g5_helpme where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
                            // 답변수
                            $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
                            // 채택된 답변수
                            $s_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$member['mb_id']}' and an_selection = 'Y' and del_yn is null; ")['count'];
                            ?>
                            <li><a href="<?=G5_BBS_URL?>/mypage_help.php"><?=number_format($q_count)?><em>Question</em></a></li>
							<li><a href="<?=G5_BBS_URL?>/mypage_help.php"><?=number_format($a_count)?><em>Answer</em></a></li>
							<li><a href="<?=G5_BBS_URL?>/mypage_help.php"><?=number_format($s_count)?><em>Chosen answer</em></a></li>
						</ul>
						<div class="area_bunker">
							<h3>Bunker</h3>
							<span><?=number_format($member['mb_bunker']+$member['mb_bunker_bonus'])?></span>
						</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="mypage_wrap">
		
				<div class="mypage_cont">
					<div class="box">
						<h3>My question<!--<i class="blue"><?/*=$q_count*/?></i>--></h3>
						<a href="<?=G5_BBS_URL?>/mypage_help.php" class="btn_more">More +</a>
						<div class="box_cont">
							<div class="table_wrap">
								<ul class="tbl_hd tbl">
                                    <li class="type w2">Category</li>
                                    <li class="subject w35">Subject</li>
                                    <li class="select w1">Best Answer</li>
                                    <li class="select w1">Great Answer</li>
                                    <li class="reply w1">Answers</li>
                                    <li class="data w15">Date</li>
								</ul>

								<!-- 목록 최대 5개 최신순-->
								<ul class="tbl_cont_wrap">
                                    <li class="tbl_cont">
                                    <?php
                                    $sql = " select * from g5_helpme where mb_id = '{$member['mb_id']}' and del_yn is null order by idx desc limit 5 ";
                                    $result = sql_query($sql);
                                    for ($i=0; $row=sql_fetch_array($result); $i++) {
                                        // 답변수
                                        $an_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = {$row['idx']} and del_yn is null")['count'];
                                        // 나의질문 - 채택정보
                                        $best_flag = 'Not Chosed';
                                        $great_flag = 'Not Chosed';
                                        if(!empty($row['he_best'])) { $best_flag = 'Chosen '; }
                                        if(!empty($row['he_great'])) { $great_flag = 'Chosen '; }
                                        if(!empty($row['he_selection'])) {// 마감됐을 때 - 우수답변 선택 안하고 마감했다면
                                            if(empty($row['he_great'])) { $great_flag = '-'; }
                                        }
                                    ?>
                                    <a href="<?=G5_BBS_URL?>/help_view.php?idx=<?=$row['idx']?>">
                                        <ul class="tbl_list tbl">
                                            <li class="type w2"><?=$row['he_category']?></li>
                                            <li class="subject w35"><?=$row['he_subject']?></li>
                                            <li class="select w1"><div class="reply">Best Answer</div><?=$best_flag?></li>
                                            <li class="select w1"><div class="reply">Great Answer</div><?=$great_flag?></li>
                                            <li class="reply w1"><div class="reply">Answers</div><?=number_format($an_count)?></li>
                                            <li class="data w15"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></li>
                                        </ul>
                                    </a>
                                    <?php
                                    }
                                    if($i==0) {
                                    ?>
                                    <ul class="tbl_list tbl">
                                        <li class="nodata" style="text-align: center;">No uploaded content.</li>
                                    </ul>
                                    <?php
                                    }
                                    ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="box">
						<h3>My answer<!--<i class="blue"><?/*=$a_count*/?></i>--></h3>
						<a href="<?=G5_BBS_URL?>/mypage_help.php" class="btn_more">More +</a>
						<div class="box_cont">
							<div class="table_wrap">
								<ul class="tbl_hd tbl">
                                    <li class="type w2">Category</li>
                                    <li class="subject w35">Subject</li>
                                    <li class="select w1">Best Answer</li>
                                    <li class="select w1">Great Answer</li>
                                    <li class="reply w1">Ansers</li>
                                    <li class="data w15">Date</li>
								</ul>
								<ul class="tbl_cont_wrap">
									<li class="tbl_cont">
                                        <?php
                                        $sql = " select he.*, an.an_selection, an.mb_id as an_mb_id, an.an_best, an.an_great, an.wr_datetime from g5_helpme as he left join g5_helpme_answer as an on an.helpme_idx = he.idx where an.mb_id = '{$member['mb_id']}' and he.del_yn is null order by an.helpme_idx desc limit 5 ";
                                        $result2 = sql_query($sql);
                                        for($i=0; $row=sql_fetch_array($result2); $i++) {
                                            // 답변수
                                            $an_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = {$row['idx']} and del_yn is null")['count'];

                                            // 나의답변 - 채택여부확인
                                            $best_flag = 'Not Chosed';
                                            $great_flag = 'Not Chosed';
                                            if(!empty($row['an_best'])) { $best_flag = 'Chosen ';  }
                                            if(!empty($row['an_great'])) { $great_flag = 'Chosen '; }
                                            if(!empty($row['he_selection'])) {// 마감됐을 때 - 우수답변 선택 안하고 마감했다면
                                                if(empty($row['he_great'])) { $great_flag = '-'; }
                                            }
                                        ?>
                                        <a href="<?=G5_BBS_URL?>/help_view.php?idx=<?=$row['idx']?>">
                                            <ul class="tbl_list tbl">
                                                <li class="type w2"><?=$row['he_category']?></li>
                                                <li class="subject w35"><?=$row['he_subject']?></li>
                                                <li class="select w1"><div class="reply">Best answer</div><?=$best_flag?></li>
                                                <li class="select w1"><div class="reply">Great Answer</div><?=$great_flag?></li>
                                                <li class="reply w1"><div class="reply">Answers</div><?=number_format($an_count)?></li>
                                                <li class="data w15"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></li>
                                            </ul>
                                        </a>
                                        <?php
                                        }
                                        if($i==0) {
                                        ?>
                                        <ul class="tbl_list tbl">
                                            <li class="nodata" style="text-align: center;">No uploaded content</li>
                                        </ul>
                                        <?php
                                        }
                                        ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="box">
                        <!-- 프로필업데이트5 - 관심키워드를 기준으로 함 -->
						<h3>Personalized information</h3>
						<div class="box_cont">
							<ul class="tabs">
								<li class="active" rel="tab1"><span>Help Me</span></li>
							</ul>
							<div class="tab_container">
								<div id="tab1" class="tab_content">
                                    <?php if(!empty($member['mb_keyword'])) { ?>
                                    <div id="help_list">
										<ul class="list helpme">
                                            <?php
                                            $tag_search = tagSearch('he_hashtag', $member['mb_keyword']); // 검색컬럼, 검색태그
                                            $keyword = str_replace(',','|',$member['mb_keyword']); // 관심키워드
                                            $sql = " select * from g5_helpme where {$tag_search} and del_yn is null order by idx desc limit 4 ";
                                            $result = sql_query($sql);

                                            $array = explode('|', $keyword);
                                            for($i=0; $row=sql_fetch_array($result); $i++) {
                                                $he_a_count = selectCount('g5_helpme_answer', 'helpme_idx', $row['idx']); // 답변수
                                                $he_v_count = selectCount('g5_helpme_action', 'helpme_idx', $row['idx'], 'mode', 'view'); // 조회수

                                                $hashtag = '';
                                                if(!empty($row['he_hashtag'])) {
                                                    $tag = explode(',',$row['he_hashtag']);
                                                    for($j=0; $j<count($tag); $j++) {
                                                        $sch_class = '';
                                                        if(in_array($tag[$j], $array)) { // $array 배열에 해당 태그가 있으면
                                                            $sch_class = " class='sch_word' ";
                                                        }
                                                        $hashtag .= '<li '.$sch_class.'>'.$tag[$j].'</li>';
                                                    }
                                                }
                                            ?>
                                            <li>
                                                <div class="left noimg">
                                                    <a href="<?=G5_BBS_URL?>/help_view.php?idx=<?=$row['idx']?>">
                                                        <h3><i><?=number_format($row['he_bunker'])?></i><?=$row['he_subject']?></h3>
                                                        <span><?=strip_tags($row['he_contents'])?></span>
                                                    </a>
                                                    <ul class="tag">
                                                        <?=$hashtag?>
                                                    </ul>
                                                    <div class="list_info">
                                                        <span class="reply">Answers <em><?=number_format($he_a_count)?></em></span>
                                                        <span class="view">Views <em><?=number_format($he_v_count)?></em></span>
                                                        <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                            }
                                            ?>
										</ul>
									</div>
                                    <?php } else { ?>
                                    <div class="nodata">No recommended personalized information.</div>
                                    <?php } ?>
								</div>
								<div id="tab2" class="tab_content">
                                    <?php if(!empty($member['mb_keyword'])) { ?>
                                    <ul class="career_list">
                                        <?php
                                        $tag_search = tagSearch('mb_hashtag', $member['mb_keyword']); // 검색컬럼, 검색태그
                                        $tag_search2 = tagSearch('cr_hashtag', $member['mb_keyword']); // 검색컬럼, 검색태그
                                        $keyword = str_replace(',','|',$member['mb_keyword']); // 관심키워드

                                        // 채용공고를 올린 기업의 해시태그와 채용공고의 해시태그를 기준으로 검색
                                        $sql = " select cr.*, mb.mb_category, mb.mb_company_name from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id where ({$tag_search} or {$tag_search2}) and (date_format(now(), '%Y-%m-%d') <= cr.cr_eddate or cr_always = 'Y') and cr_state is null order by idx desc limit 4 ";
                                        $result = sql_query($sql);

                                        for($i=0; $row=sql_fetch_array($result); $i++) {
                                            // 채용공고 D-DAY
                                            $date = $row['cr_eddate'];
                                            $todate = date("Y-m-d", time());
                                            $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
                                        ?>
                                        <li>
                                            <a href="<?=G5_BBS_URL?>/career_view.php?idx=<?=$row['idx']?>">
                                                <div class="top">
                                                    <div class="company_logo"><?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?></div>
                                                    <span><?=$row['mb_company_name']?></span>
                                                    <h3><?=$row['cr_subject']?></h3>
                                                </div>
                                                <div class="bottom">
                                                    <span><?=$recruit_salary[$row['cr_work_salary']]?></span><!-- 연봉 -->
                                                    <em><?=!empty($row['cr_always']) ? '상시채용' : 'D - '.$dday; ?></em><!-- 남은기간 -->
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        if($i==0) {
                                        ?>
                                        <div class="nodata">No recommended personalized information.</div>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <?php } else { ?>
                                    <div class="nodata">No recommended personalized information.</div>
                                    <?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include_once('./mypage_menu.php'); ?> 
			</div>			
		</div>
	</div>

<?
include_once('./_tail.php');
?>

<script>

$(document).ready(function() {
    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		}
    });

    var min_height = $('.second_box').innerHeight();
    $('.first_box').css('min-height', min_height);
    $('.third_box').css('min-height', min_height);

    // 소개글 길어지면 스타일 깨져서 추가
    if($('.first_box').innerHeight() >= 300) {
        $('.first_box').css('min-height', 'auto');
        $('.box_wrap').addClass('hauto');
    }
});

</script>