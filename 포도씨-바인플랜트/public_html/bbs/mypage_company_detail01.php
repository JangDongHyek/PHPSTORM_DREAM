<?
include_once('./_common.php');

$g5['title'] = '나의견적요청';
include_once('./_head.php');

/**  기업 - 마이페이지 - 기업의뢰 - 내가 요청한 의뢰 상세 **/

//if($private) {
//    $member['mb_id'] = 'vineplant';
//}

if(empty($idx)) {
    alert('올바른 경로가 아닙니다.');
}

loginCheck($member['mb_id'], '기업');

// 기업의뢰 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = {$idx} ");

// 견적기한
$date = $ci['ci_deadline_date']; // 2013-07-14 09:14:00
$todate = date("Y-m-d", time());
$dday = ( strtotime($date) - strtotime($todate) ) / 86400;

// 상태
if($ci['ci_state'] == '접수대기') {$class = 'wait';}
else if($ci['ci_state'] == '견적검토중') { $class = 'check'; }
else if($ci['ci_state'] == '거래완료') { $class = 'select'; }
else if($ci['ci_state'] == '미체결') { $class = 'no'; }
else if($ci['ci_state'] == '마감') { $class = 'finish'; }

// 견적 수
$cnt2 = selectCount('g5_company_estimate', 'company_inquiry_idx', $idx);
// 선택된 견적이 있는지 확인
$selection = selectCount('g5_company_estimate', 'company_inquiry_idx', $idx, 'ce_selection', 'Y');
if($cnt2 > 0) { $msg = '선택'; } else { $msg = '접수'; }

if($ci['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
    alert('올바른 경로가 아닙니다.');
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft_menu{display:none;}
</style>

<!-- 상태변경 select 모달-->
<div id="basic_modal">
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="inquiry_idx" name="inquiry_idx" value="<?=$idx?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <ul id="sort_list">
                        <li class="active li_wait">접수대기</li>
                        <li class="li_check">견적검토중</li>
                        <li class="li_select">거래완료</li>
                        <li class="li_no">미체결</li>
                        <li class="li_finish hide">마감</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 상태변경 select 모달-->

<!-- 미체결 선택시 나오는 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade review" id="noModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">거래 미체결</h4>
                </div>
                <div class="modal-body">
                    <div id="star_rating">
                        <h3>거래가 미체결되어 아쉽습니다.</h3>
                        <span class="writer">
                    견적을 제출한 공급자를 위해 거래가 성사되지 않은 사유를 알려주세요.<br>
                    (아래중 선택, 중복선택 가능)
                    </span>
                    </div>
                    <!--star_rating-->

                    <div class="area_check">
                        <ul class="check_list">
                            <li>
                                <input type="checkbox" id="reason01" name="reason" value="1">
                                <label for="reason01">
                                    <span></span>
                                    <em>가격 경쟁력 미달</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="reason02" name="reason" value="2">
                                <label for="reason02">
                                    <span></span>
                                    <em>거래조건 불충족 (납기, 결제등)</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="reason03" name="reason" value="3">
                                <label for="reason03">
                                    <span></span>
                                    <em>프로젝트 취소 또는 연기</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="reason04" name="reason" value="4">
                                <label for="reason04">
                                    <span></span>
                                    <em>기타사유</em>
                                </label>
                                <textarea id="reason_etc" name="reason_etc"></textarea>
                            </li>
                        </ul>
                    </div>
                    <div class="area_btn popup">
                        <a class="btn_send writer" href="javascript:state_no();">확인</a>
                    </div>
                    <div class="txt" style="display: none;">
                        <a href="javascript:void(0);" data-dismiss="modal">닫기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 미체결 선택시 나오는 모달 -->

<!-- 거래후기 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade review" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();"><span></span><span></span></button>
                    <?php
                    $disabled = '';
                    $readonly = '';
                    $reviewCnt = selectCount("g5_company_inquiry_result", "inquiry_idx", $idx, "type", "거래후기"); // 리뷰 수
                    if($reviewCnt > 0) { // 리뷰가 있으면 조회만 가능
                        $disabled = 'disabled';
                        $readonly = 'readonly';
                        $review = sql_fetch(" select * from g5_company_inquiry_result where inquiry_idx = '{$idx}' and type = '거래후기' ");
                        $review_ = explode(',', $review['review']);
                    }
                    ?>
                    <h4 class="modal-title" id="appModalLabel">거래 후기 <?php echo $reviewCnt > 0 ? '' : '보내기'; ?></h4>
                </div>
                <div class="modal-body">
					<div id="star_rating">
						<p class="star_rating">
							<?php
							for($i=1; $i<=5; $i++) {
                            ?>
                            <a href="javascript:;" name="score_<?=$i?>" <?php echo $i <= $review['star_score'] ? 'class="on"' : ''; ?>><i class="fas fa-star"></i></a>
                            <?php
							}
							?>
						</p>
                        <?php echo $reviewCnt > 0 ? '' : '<h2>별점을 선택해 주세요.</h2>'; ?>
					</div>
					<!--star_rating-->

					<div class="area_check">
						<ul class="check_list">
							<li>
								<input type="checkbox" name="review" value="1" <?php echo in_array('1', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check01">
								<label for="check01">
									<span></span>
									<em>의뢰 내용을 정확히 준수하였습니다.</em>
								</label>
							</li>	
							<li>
								<input type="checkbox" name="review" value="2" <?php echo in_array('2', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check02">
								<label for="check02">
									<span></span>
									<em>업무 대응이 신속합니다.</em>
								</label>
							</li>	
							<li>
								<input type="checkbox" name="review" value="3" <?php echo in_array('3', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check03">
								<label for="check03">
									<span></span>
									<em>전문성을 갖추고 있습니다.</em>
								</label>
							</li>	
							<li>
								<input type="checkbox" name="review" value="4" <?php echo in_array('4', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check04">
								<label for="check04">
									<span></span>
									<em>제품 또는 서비스의 품질이 우수합니다.</em>
								</label>
							</li>
							<li>
								<input type="checkbox" name="review" value="5" <?php echo in_array('5', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check05">
								<label for="check05">
									<span></span>
									<em>기타</em>
								</label>
								<textarea id="review_etc" name="review_etc" <?=$readonly?>><?=$review['review_etc']?></textarea>
							</li>
						</ul>
					</div>
                    <?php if($reviewCnt == 0) { ?>
					<div class="area_btn popup col02">
					    <a class="btn_send" href="javascript:state_review();">거래 후기 보내기</a>
                        <a class="btn_send v2" href="javascript:companyReSelect('<?=$idx?>');">거래 회사 재선택</a>
					</div>
                    <?php } else { ?>
                    <div class="txt">
                        <a href="javascript:void(0);" data-dismiss="modal">닫기</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 거래후기 모달팝업 -->

<!-- 마감일에 나오는 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade review" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">의뢰 마감</h4>
                </div>
                <div class="modal-body">

                    <div class="txt">
                        <h2>의뢰 마감일까지 <?=$msg?>된 견적이 없습니다. <br>동일조건으로 견적기한을 연장하시겠습니까?</h2>

                        <!-- "네"버튼 누르면 나오는 화면 -->
                        <div class="area_data">
                            <label>견적기한을 입력해 주세요</label>
                            <input type="date" id="deadline_date" name="deadline_date">
                        </div>
                        <!-- "네"버튼 누르면 나오는 화면 -->

                    </div>

                    <div class="area_btn popup">
                        <ul class="btn_list">
                            <li><a href="javascript:state_finish('ok');">네</a></li>
                            <li><a href="javascript:state_finish('no');">아니오</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 마감일에 나오는 모달 -->

<!-- 거래완료 선택시 나오는 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="selectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">거래 완료</h4>
                </div>
                <div class="modal-body">

                    <div class="txt"><h2>거래 성사를 축하드립니다. <br>거래 상대 회사를 선택해주세요</h2></div>
                    <div class="area_btn popup">
                        <ul class="btn_list">
                            <li><a href="javascript:;" class="a_select">선택하러가기</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 거래완료 선택시 나오는 모달 -->

<!-- 미체결 선택 시 알림 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="noConrirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="txt confirm">
                        <h2>상태를 변경하시겠습니까?</h2>
                        <em>미체결로 상태 변경 시 수정할 수 없습니다.</em>
                    </div>
                    <ul class="madal_btn">
                        <li data-dismiss="modal">취소</li>
                        <li class="ok" onclick="state_change('<?=$idx?>', '미체결');">미체결</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 미체결 선택 시 알림 모달 -->

<!-- 감사 인사보내기 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade review" id="thanksModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <?php
                    $readonly = '';
                    $thanksCnt = selectCount("g5_company_inquiry_result", "inquiry_idx", $ci['idx'], "type", "감사인사"); // 리뷰 수
                    if($thanksCnt > 0) {
                        $readonly = 'readonly';
                        $thanks = sql_fetch(" select * from g5_company_inquiry_result where inquiry_idx = '{$ci['idx']}' and type = '감사인사' ");
                    }
                    ?>
                    <h4 class="modal-title" id="appModalLabel">감사 인사</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <h2>거래 상대 회사에서 <em class="blue"><?=number_format($thanks['bunker'])?>벙커</em>와 함께 <br>감사인사가 도착했습니다.</h2>
                        <textarea id="thanks" name="thanks" <?=$readonly?>><?=$thanks['review_etc']?></textarea>
                    </div>
                    <div class="txt">
                        <a href="#" data-dismiss="modal">닫기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  감사 인사보내기 모달 -->

<div id="area_help" class="company_write my">
    <div class="inr v3">
        <h2 class="title">요청 의뢰</h2>
        <div class="mypage_box">
            <?php if($dday == 0 && $ci['ci_state'] == '접수대기') { // 금일이 의뢰마감일 && 접수대기 상태 ?>
            <div class="dday" data-toggle="modal" data-target="#finishModal">
                <i>D-Day</i><p>의뢰 마감일까지 <?=$msg?>된 견적이 없습니다.</p>
            </div>
            <?php } ?>
            <div id="help_list">
                <ul class="list">
                    <li class="company">
                        <div class="title">
                            <!--<a href="">-->
                                <em><?=$ci['ci_category']?></em><!-- 카테고리 -->
                                <h3><?=$ci['ci_subject']?></h3> <!-- 제목 -->
                            <!--</a>-->
                            <i class="<?=$class?>" onclick="state_modal('<?=$idx?>', '<?=$ci['ci_state']?>', '<?=$cnt2?>', '<?=$selection?>');"><em></em><?=$ci['ci_state']?></i>
                        </div>
                        <div class="cont">
                            <div class="list_wrap">
                                <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$ci['idx']?>">
                                    <ul class="list_text">
                                        <li><em>Maker</em><span><?=$ci['ci_maker']?></span></li><!-- 제조사 -->
                                        <li><em>Model</em><span><?=$ci['ci_model']?></span></li><!-- 의뢰국가 -->
                                        <li><em>마감일</em><?=$ci['ci_deadline_date']?></li>
                                        <li class="period"><span><?php echo $dday >= 0 ? $dday.'일 남음' : '마감'; ?></span></li><!-- 견적남은기간 -->
                                    </ul>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
			<div class="area_detail">
               <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$ci['idx']?>">나의 견적 요청 자세히보기</a>
			</div>
        </div>
        <div class="mypage_box">
            <h3>거래 상대 회사를 선택해주세요.</h3>

            <div id="help_list">
                <?php
                // 견적 리스트
                $rlt = sql_query(" select ce.*, mb.mb_no, mb.mb_category from g5_company_estimate as ce left join g5_member as mb on mb.mb_id = ce.mb_id where company_inquiry_idx = '{$ci['idx']}' order by idx ");
                $i = 0;
                $selection_flag = false; // 선택된 기업이 있는지 확인 플래그
                $selection_cnt = sql_fetch("select count(*) as cnt from g5_company_estimate where company_inquiry_idx = '{$ci['idx']}' and ce_selection = 'Y' ")['cnt']; // 선택된 기업의 개수
                if($selection_cnt > 0) { $selection_flag = true; } // 선택된 기업이 있으면 true
                while ($row = sql_fetch_array($rlt)) {
                    $i++;
                ?>
                <div class="help_question">
                    <!-- 채택된 답변 표시 아이콘-->
                    <?php if($row['ce_selection'] == 'Y') { ?>
                    <div class="area_select">
                        <span></span>
                        <em>선택</em>
                    </div>
                    <?php } ?>
                    <div class="title">
                        <div class="area_name" onclick="userToggle('user_list_<?=$row['idx']?>');">
                        <div class="profile" onclick="profileOpen('<?=$row['mb_category']?>', '<?=$row['idx']?>', '<?=$row['mb_id']?>');"><?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?></div> <!-- 프로필사진 -->
                        <div class="profile_info">
                            <h4 class="toggle"><?=$row['mb_id']?></h4> <!-- 아이디 -->
                            <em class="price"><i>견적</i><?=number_format($row['ce_offer_price']).$row['ce_unit']?></em> <!-- 견적제안금액 -->
                        </div>
                        <ul class="user_list_<?=$row['idx']?> user_list" style="top: 60px !important;left: 20px !important;">
                            <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$row['mb_no']?>">기업홈피로 이동</a></li>
                            <li>의뢰건수 <em class="blue"><?=inquiryCount($row['mb_id'])?></em>건</li>
                            <li>거래건수 <em class="blue"><?=completeCount($row['mb_id'])?></em>건</li>
                            <li onclick="reportOpen('<?=$row['mb_id']?>', 'g5_compamy_estimate', '<?=$row['idx']?>')">신고하기</li>
                        </ul>
                        </div>

                        <?php if(!$selection_flag && $ci['ci_state'] == '거래완료') { // 거래완료 상태일 때 회사 선택 가능 ?>
                        <!-- 채택하기 버튼-->
                        <a class="answer_select" href="javascript:select_action('<?=$row['idx']?>');"><span></span><em>선택<em class="mhide">하기</em></em></a>
                        <!-- //채택하기 버튼-->
                        <?php } ?>
                    </div>

                    <div class="area_bottom">
                        <div class="bottom">
                            <span style="word-break: break-word;"><?=nl2br($row['ce_contents'])?></span> <!-- 고객님께 드리는말씀 -->

                            <!-- 첨부파일 -->
                            <ul class="list_file">
                                <?php
                                $file_rlt = sql_query(" select * from g5_company_estimate_img where company_estimate_idx = '{$row['idx']}' order by idx ");
                                while($file = sql_fetch_array($file_rlt)) {
                                ?>
                                <li><a href="javascript:fileDownload('company_estimate', '<?=$file['img_file']?>', '<?=$file['img_source']?>')"><?=$file['img_source']?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                            <!-- //첨부파일 -->
                            <?php if($row['ce_selection'] == 'Y') { // 선택한 회사만 ?>
                            <a href="javascript:send_review('<?=$row['idx']?>');" class="btn_review"><span>거래 후기 <?php echo $reviewCnt > 0 ? '작성 완료' : '보내기'; ?></span></a>
                            <?php
                            $thanksCnt = selectCount("g5_company_inquiry_result", "inquiry_idx", $ci['idx'], "type", "감사인사"); // 리뷰 수
                            if(!empty($thanksCnt)) { // 감사 인사 있으면 보임 ?>
                            <a href="#" class="btn_review v2" data-toggle="modal" data-target="#thanksModal"><span>감사 인사 확인하기</span></a>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        
			 <!--<div class="area_detail">
               <a href="<?php /*echo G5_BBS_URL */?>/company_view.php?idx=<?/*=$ci['idx']*/?>">자세히보기</a>
                <a href="<?php echo G5_BBS_URL ?>/mypage_company01.php">목록</a>
            </div>-->

			<div class="area_btn">         
				<a class="btn_list" href="<?=G5_BBS_URL?>/mypage_company01.php"><span>목록</span></a>
			</div>
		</div>
    </div>
</div>

<script type="text/javascript" src="./js/mypage_company.js?v=<?=G5_JS_VER?>" charset="utf-8"></script>
<script>
    var star_score = 0;
    $(function() {
        // 별점 선택
        $( ".star_rating a" ).click(function() {
            if('<?=$reviewCnt?>' == 0) {
                $(this).parent().children("a").removeClass("on");
                $(this).addClass("on").prevAll("a").addClass("on");
                var score = $(this).attr('name').split('_');
                $('#score').val(score[1]);
                star_score = score[1];
                return false;
            }
        });
        
       if('<?=$reviewCnt?>' > 0) {
           $('#reviewModal .modal-header .close').attr('onclick', '');
       } 
    });

    // 견적 선택하기
    function select_action(es_idx) {
        esti_idx = es_idx;
        $.ajax({
            url: g5_bbs_url + '/ajax.estimate_select.php',
            type: 'POST',
            data: {estimate_idx: es_idx, idx: '<?=$idx?>'},
            success: function(data) {
                if(data) {
                    swal('거래 상대 회사가 선택되었습니다.\n거래 후기를 작성해 주세요.')
                    .then(() => {
                        $('#reviewModal').modal('show');
                    });
                }
            },
        });
    }
    
    // 거래 후기 보내기 (리뷰)
    var esti_idx; // 젼적idx
    function send_review(idx) {
        esti_idx = idx;
        $('#reviewModal').modal('show');
    }

    // 거래 후기 작성
    var is_post = false;
    function state_review() {
        if(is_post) {
            return false;
        }
        is_post = true;

        // 별점 체크
        if(star_score == 0) {
            swal('별점을 선택해 주세요.');
            is_post = false;
            return false;
        }

        // 전체 체크 순회
        var checkFlag = false;
        var value = '';
        $("input:checkbox[name=review]").each(function() {
            if(this.checked) {
                checkFlag = true;
                value += this.value + ',';
            }
        });
        value = value.slice(0,-1);

        if(checkFlag) {
            $.ajax({
                url : g5_bbs_url + "/ajax.inquiry_review.php",
                data: {idx: '<?=$idx?>', checked: value, etc: $('#review_etc').val(), estimate_idx: esti_idx, star_score: star_score, mode: 'select'},
                type: 'POST',
                success : function(data) {
                    if(data) {
                        swal('거래 후기를 전송하였습니다.')
                        .then(()=>{
                            location.reload();
                        });
                    }
                },
                error : function(err) {
                    swal(err.status);
                }
            });
        }
        else {
            swal('거래 후기를 선택해 주세요.');
            return false;
        }
    }

    // 거래 회사 재선택
    function companyReSelect(idx) {
        $.ajax({
            url : g5_bbs_url + "/ajax.inquiry_review.php",
            data: {idx: idx, mode: 'reselect'},
            type: 'POST',
            success : function(data) {
                if(data) {
                    location.reload();
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
</script>

<?
include_once('./_tail.php');
?>