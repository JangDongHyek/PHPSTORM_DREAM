<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = 'Mypage';
include_once('./_head.php');

/** 기업 - 마이페이지 - 메인 **/

loginCheck($member['mb_id'], $member['mb_category']);
?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

</style>

    <div id="area_mypage">
		<div class="inr v3">
			<div id="mypage_wrap">
				<?php include_once('./mypage_cinfo.php'); ?>
				<div class="mypage_cont">
					<div class="box">
                        <?php
                        // 삭제자료
                        $noshow = sql_fetch(" select group_concat(idx separator ',') as noshow from g5_company_inquiry where find_in_set('{$member['mb_id']}', noshow) ")['noshow'];
                        $sql_search = " and mb_id = '{$member['mb_id']}' and del_yn is null ";
                        if(!empty($noshow)) { $sql_search .= " and idx not in ({$noshow}) "; }
                        // 나의 견적의뢰 개수
                        $cnt = sql_fetch(" select count(*) as cnt from g5_company_inquiry where 1=1 {$sql_search} ")['cnt'];
                        // 나의 견적의뢰 리스트
                        $rlt = sql_query(" select * from g5_company_inquiry where 1=1 {$sql_search} order by idx desc limit 4 ");
                        ?>
						<h3>RFQ Sent<i class="blue"><?=number_format($cnt)?></i></h3>
						<a href="<?=G5_BBS_URL?>/mypage_company01.php" class="btn_more">MORE +</a>
                        <?php
                        if($cnt > 0) {
                        ?>
                        <div class="area_cont">
                            <!-- 목록 4개 -->
                            <ul class="list_receive">
                                <?php
                                while($row = sql_fetch_array($rlt)) {
                                    $podosea = false;
                                    if(!empty($row['podosea']) && empty($row['pass_yn'])) { $podosea = true; } // 포도씨에 의뢰했고 && 포도씨에서 타기업에 의뢰를 전달하지 않았을 경우 (ajax.mypage_company01.php 동일 소스 존재)

                                    // 견적기한 D-DAY
                                    $date = $row['ci_deadline_date'];
                                    $todate = date("Y-m-d", time());
                                    $dday = ( strtotime($date) - strtotime($todate) ) / 86400;

                                    $class = '';
                                    if($row['ci_state'] == 'Processing Submission') { $class = 'wait'; }
                                    else if($row['ci_state'] == 'Quotation Under Review') { $class = 'check'; }
                                    else if($row['ci_state'] == 'Transaction Complete') { $class = 'select'; }
                                    else if($row['ci_state'] == 'Agreement Incomplete') { $class = 'no'; }
                                    else if($row['ci_state'] == 'Deadline') { $class = 'finish'; }
                                ?>
                                <li>
                                    <i class="<?=$class?>"><em></em><?=$row['ci_state']?></i>
                                    <a href="<?php echo G5_BBS_URL ?>/mypage_company_detail01.php?idx=<?=$row['idx']?>">
                                        <div class="top">
                                            <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
                                            <?php if($dday == 0 && $row['ci_state'] == 'Processing Submission') { // 금일이 의뢰마감일 && Processing Submission(접수대기) 상태 ?>
                                            <span class="dday on" onclick="state_modal('<?=$row['idx']?>', 'dday', '<?=$cnt2?>', '<?=$selection?>');"><em class="blink">D-day</em></span>
                                            <?php } else if($dday > 0) { ?>
                                            <span class="dday">D - <?=$dday?></span>
                                            <?php } ?>
                                        </div>

                                        <!--의뢰제목-->
                                        <h3><?=$row['ci_subject']?></h3>

                                        <!--견적보낸사람들 프로필-->
                                        <ul class="list_profile">
                                            <?php if($podosea) { ?>
                                            <li class="nodata podo">This is a request from podosea.</li>
                                            <?php } else {
                                                // 견적 수
                                                $cnt2 = selectCount('g5_company_estimate', 'company_inquiry_idx', $row['idx']);
                                                // 견적 리스트
                                                $rlt2 = sql_query(" select ce.*, mb.mb_category from g5_company_estimate as ce left join g5_member as mb on mb.mb_id = ce.mb_id where company_inquiry_idx = '{$row['idx']}' order by idx desc limit 6 ");
                                                $i = 0;
                                                while($row2 = sql_fetch_array($rlt2)) {
                                                    $i++;
                                            ?>
                                            <li>
                                                <div class="area_profile basic">
                                                    <?php if($cnt2 > 6 && $i == 6) { ?>
                                                    <div class="area_add">
                                                        <span>+<?=$cnt2 - 6?></span>
                                                    </div>
                                                    <?php } ?>
                                                    <?php echo getProfileImg($row2['mb_id'], $row2['mb_category']); ?>
                                                </div>
                                            </li>
                                            <?php
                                                }
                                            }
                                            if($i == 0) {
                                            ?>
                                            <li class="nodata">There is no Quotation Received.</li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <!-- //목록 4개 -->
                        </div>
                        <?php
                        }
                        else {
                        ?>
                        <div class="nodata" style="text-align: center;">There is no registered contents.</div>
                        <?php
                        }
                        ?>
					</div>
					<div class="box">
                        <?php
                        // 삭제자료
                        $noshow = sql_fetch(" select group_concat(idx separator ',') as noshow from g5_company_estimate where find_in_set('{$member['mb_id']}', noshow) ")['noshow'];
                        $sql_search = " and ce.mb_id = '{$member['mb_id']}' ";
                        if(!empty($noshow)) { $sql_search .= " and ce.idx not in ({$noshow}) "; }
                        // 견적 수
                        $cnt = sql_fetch(" select count(*) as cnt from g5_company_estimate as ce left join g5_company_inquiry as ci on ci.idx = ce.company_inquiry_idx where 1=1 {$sql_search} ")['cnt'];
                        $rlt = sql_query(" select ce.*, ci.ci_state from g5_company_estimate as ce left join g5_company_inquiry as ci on ci.idx = ce.company_inquiry_idx where 1=1 {$sql_search} order by ce.idx desc limit 4 ");
                        ?>
						<h3>Quote Sent<i class="blue"><?=number_format($cnt)?></i></h3>
						<a href="<?=G5_BBS_URL?>/mypage_company02.php" class="btn_more">MORE +</a>
                        <?php
                        if($cnt > 0) {
                        ?>
                        <div class="area_cont">
                            <!-- 목록 4개 -->
                            <ul class="list_send">
                                <?php
                                while($row = sql_fetch_array($rlt)) {
                                    $class = '';
                                    if($row['ci_state'] == 'Processing Submission') { $class = 'wait'; }
                                    else if($row['ci_state'] == 'Quotation Under Review') { $class = 'check'; }
                                    else if($row['ci_state'] == 'Transaction Complete') { $class = 'select'; }
                                    else if($row['ci_state'] == 'Agreement Incomplete') { $class = 'no'; }
                                    else if($row['ci_state'] == 'Deadline') { $class = 'finish'; }
                                ?>
                                <li>
                                    <i class="<?=$class?>"><?=$row['ci_state']?></i>
                                    <a href="<?php echo G5_BBS_URL ?>/mypage_company_detail02.php?idx=<?=$row['idx']?>">
                                        <div class="top">
                                            <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>

                                            <!-- 견적보내기 페이지 고객님께 드릴 말씀 -->
                                            <h3><?=$row['ce_contents']?></h3>
                                        </div>
                                        <div class="price">
                                            <label>Quote proposal amount</label>
                                            <span><?=number_format($row['total_cost']).' '.$row['ce_unit']?></span>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <!-- //목록 4개 -->
                        </div>
                        <?php
                        }
                        else {
                        ?>
                        <div class="nodata" style="text-align: center;">There is no registered contents.</div>
                        <?php
                        }
                        ?>
					</div>
                    <!-- 프로필업데이트5 - 해시태그를 기준으로 함 -->
					<!--<div class="box">
                        <h3>Personalized information</h3>
						<div class="box_cont">
							<ul class="tabs">
								<li class="active" rel="tab1"><span>Help Me</span></li>
							</ul>
                            <div class="tab_container">
                                <div id="tab1" class="tab_content">
                                    <?php /*if(!empty($member['mb_hashtag'])) { */?>
                                    <div id="help_list">
                                        <ul class="list helpme">
                                        <?php
/*                                        $tag_search = tagSearch('he_hashtag', $member['mb_hashtag']); // 검색컬럼, 검색태그
                                        $hashtag = str_replace(',','|',$member['mb_hashtag']); // 해시태그
                                        $sql = " select * from g5_helpme where {$tag_search} and del_yn is null order by idx desc limit 4 ";
                                        $result = sql_query($sql);

                                        $array = explode('|', $hashtag);
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
                                            */?>
                                            <li>
                                                <div class="left noimg">
                                                    <a href="<?php /*=G5_BBS_URL*/?>/help_view.php?idx=<?php /*=$row['idx']*/?>">
                                                        <h3><i><?php /*=number_format($row['he_bunker'])*/?></i><?php /*=$row['he_subject']*/?></h3>
                                                        <span><?php /*=strip_tags($row['he_contents'])*/?></span>
                                                    </a>
                                                    <ul class="tag">
                                                        <?php /*=$hashtag*/?>
                                                    </ul>
                                                    <div class="list_info">
                                                        <span class="reply">Answers<em><?php /*=number_format($he_a_count)*/?></em></span>
                                                        <span class="view">Views <em><?php /*=number_format($he_v_count)*/?></em></span>
                                                        <span class="data">2021.05.21</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
/*                                            }
                                            if($i==0) {
                                            */?>
                                            <div class="nodata">No personalized information suggested.</div>
                                            <?php
/*                                            }
                                            */?>
                                        </ul>
                                    </div>
                                    <?php /*} else { */?>
                                    <div class="nodata">No personalized information suggested.</div>
                                    <?php /*} */?>
                                </div>
                            </div>
						</div>
					</div>-->
				</div>
				<!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_cmenu.php'); ?>
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
});

</script>
