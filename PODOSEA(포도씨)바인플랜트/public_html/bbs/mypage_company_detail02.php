<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '보낸견적';
include_once('./_head.php');

/**  기업 - 마이페이지 - 기업의뢰 - 내가 보낸 견적 상세 **/

//if($private) {
//    $member['mb_id'] = 'podosea';
//}

// 견적 정보
$ce = sql_fetch(" select * from g5_company_estimate where idx = {$idx} ");
// 의뢰 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = '{$ce['company_inquiry_idx']}' ");

$date = $ci['ci_deadline_date']; // 2013-07-14 09:14:00
$todate = date("Y-m-d", time());
$dday = (strtotime($date) - strtotime($todate)) / 86400;

if ($ce['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
    alert('올바른 경로가 아닙니다.');
}

// 상태
if($ce['ce_state'] == '접수대기') {$class = 'wait';}
else if($ce['ce_state'] == '견적검토중') { $class = 'check'; }
else if($ce['ce_state'] == '거래완료') { $class = 'select'; }
else if($ce['ce_state'] == '미체결') { $class = 'no'; }
else if($ce['ce_state'] == '마감') { $class = 'finish'; }
?>

<? if ($name == "cmypage") { ?>
    <body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<? } ?>

    <link rel="stylesheet" href="<?= G5_URL ?>/css/style.css?v=<?= G5_CSS_VER ?>">

    <style>
        #ft_menu {
            display: none;
        }
        h3 {word-break: break-word;}
    </style>

    <!-- 거래후기 모달 -->
    <div id="basic_modal">
        <!-- Modal -->
        <div class="modal fade review" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close""><span></span><span></span></button>
                        <?php
                        $disabled = '';
                        $readonly = '';
                        $reviewCnt =
                        $reviewCnt = selectCount("g5_company_inquiry_result", "inquiry_idx", $ci['idx'], "type", "거래후기"); // 리뷰 수
                        if($reviewCnt > 0) { // 리뷰가 있으면 조회만 가능
                            $disabled = 'disabled';
                            $readonly = 'readonly';
                            $review = sql_fetch(" select * from g5_company_inquiry_result where inquiry_idx = '{$ci['idx']}' and type = '거래후기' ");
                            $review_ = explode(',', $review['review']);
                        }
                        ?>
                        <h4 class="modal-title" id="appModalLabel">거래 후기</h4>
                    </div>
                    <div class="modal-body">
                        <div id="star_rating">
                            <p class="star_rating">
                                <?php
                                for($i=1; $i<=5; $i++) {
                                ?>
                                <a href="#" name="score_<?=$i?>" <?php echo $i <= $review['star_score'] ? 'class="on"' : ''; ?>><i class="fas fa-star"></i></a>
                                <?php
                                }
                                ?>
                            </p>
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
                        <div class="txt">
                            <a href="#" data-dismiss="modal">닫기</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--basic_modal-->
    <!-- 거래후기 모달팝업 -->

    <!-- 미체결 선택시 나오는 모달 -->
    <div id="basic_modal">
        <!-- Modal -->
        <div class="modal fade review" id="noModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();"><span></span><span></span></button>
                        <?php
                        $disabled = '';
                        $readonly = '';
                        $reasonCnt = selectCount("g5_company_inquiry_result", "inquiry_idx", $ci['idx'], "type", "미체결"); // 리뷰 수
                        if($reasonCnt > 0) {
                            $disabled = 'disabled';
                            $readonly = 'readonly';
                            $reason = sql_fetch(" select * from g5_company_inquiry_result where inquiry_idx = '{$ci['idx']}' and type = '미체결' ");
                            $reason_ = explode(',', $reason['review']);
                        }
                        ?>
                        <h4 class="modal-title" id="appModalLabel">거래 미체결</h4>
                    </div>
                    <div class="modal-body">
                        <div id="star_rating">
                            <h3>거래가 미체결되어 아쉽습니다.</h3>
                        </div>

                        <div class="area_check">
                            <ul class="check_list">
                                <li>
                                    <input type="checkbox" id="reason01" name="reason" value="1" <?php echo in_array('1', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason01">
                                        <span></span>
                                        <em>가격 경쟁력 미달</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="reason02" name="reason" value="2" <?php echo in_array('2', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason02">
                                        <span></span>
                                        <em>거래조건 불충족 (납기, 결제등)</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="reason03" name="reason" value="3" <?php echo in_array('3', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason03">
                                        <span></span>
                                        <em>프로젝트 취소 또는 연기</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="reason04" name="reason" value="4" <?php echo in_array('4', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason04">
                                        <span></span>
                                        <em>기타사유</em>
                                    </label>
                                    <textarea id="reason_etc" name="reason_etc" <?=$readonly?>><?=$reason['review_etc']?></textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="txt">
                            <a href="#" data-dismiss="modal">닫기</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 미체결 선택시 나오는 모달 -->

    <!-- 감사 인사보내기 모달 -->
    <div id="basic_modal">
        <!-- Modal -->
        <div class="modal fade review" id="thanksModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span></span><span></span></button>
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
                            <h2>거래후기가 도착했습니다. <br>구매자에게 감사인사를 전하세요!</h2>
                            <textarea id="thanks" name="thanks" <?=$readonly?>><?=$thanks['review_etc']?></textarea>
                        </div>
                        <?php if($thanksCnt == 0) { ?>
                        <div class="area_btn popup">
							<div class="btn_wrap">
							<div class="bunker">
								<div class="area_icon"><img src="<?=G5_IMG_URL?>/icon_bunker.svg"></div>
								<input type="text" id="bunker" name="bunker" placeholder="벙커입력" onkeyup="comma_number(this);">
							</div>
                            <a class="btn_send" href="javascript:state_thanks();">벙커로 감사 전달하기</a>
							</div>
                        </div>
                        <?php } else { ?>
                        <div class="txt">
                            <a href="#" data-dismiss="modal">닫기</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  감사 인사보내기 모달 -->

    <div id="area_help" class="company_write send my">
        <div class="inr v3">
            <h2 class="title">보낸 견적</h2>
            <div id="mypage_wrap">
                <div class="area_cont">
                    <ul class="list_send">
                        <li>
                            <div class="top">
                                <i class="<?=$class?>"><?=$ce['ce_state']?></i>

                                <span class="data"><?=str_replace(',','.',substr($ce['wr_datetime'],0,10))?></span>

                                <!-- 견적보내기 페이지 고객님께 드릴 말씀 -->
                                <h3><?=nl2br($ce['ce_contents'])?></h3>

                                <!-- 첨부파일 -->
                                <ul class="list_file">
                                    <?php
                                    $file_rlt = sql_query(" select * from g5_company_estimate_img where company_estimate_idx = '{$ce['idx']}' order by idx ");
                                    while($file = sql_fetch_array($file_rlt)) {
                                    ?>
                                    <li><a href="javascript:fileDownload('company_estimate', '<?=$file['img_file']?>', '<?=$file['img_source']?>')"><?=$file['img_source']?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                                <!-- //첨부파일 -->

                                <?php
                                if($reviewCnt > 0 && $ce['ce_selection'] == 'Y') {
                                ?>
                                <!-- 의뢰자가 거래후기 보내면 나타나는 버튼-->
                                <a href="#" class="btn_review" data-toggle="modal" data-target="#reviewModal"><span>거래 후기 확인하기</span></a><!-- 기업리뷰페이지로 연결-->
                                <a href="#" class="btn_review v2" data-toggle="modal" data-target="#thanksModal"><span>감사 인사 <?php echo $thanksCnt > 0 ? '작성 완료' : '보내기'; ?></span></a>
                                <!-- //의뢰자가 거래후기 보내면 나타나는 버튼-->
                                <?php
                                }
                                if($ce['ce_state'] == '미체결') {
                                ?>
                                <!-- 의뢰자가 미체결 사유 작성 시 나타나는 버튼-->
                                <a href="#" class="btn_review" data-toggle="modal" data-target="#noModal"><span>미체결 사유 확인하기</span></a>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="price">
                                <label>견적제안금액</label>
                                <span><?=number_format($ce['ce_offer_price']).$ce['ce_unit']?></span>
                            </div>
                        </li>
                    </ul>
                </div>
				<div class="area_detail">
                   <a href="<?=G5_BBS_URL?>/estimate.php?idx=<?=$ci['idx']?>&ce_idx=<?=$ce['idx']?>&w=u">견적 수정하기</a>
				</div>
            </div>

			
            <div class="mypage_box">
                <div id="help_list">
                    <h4>의뢰인 요청<a class="btn_link" href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$ci['idx']?>">자세히보기 +</a></h4>
                    <ul class="list">
                        <li class="company">
                            <div class="title">
                                <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?= $ci['idx'] ?>">
                                    <em><?=$ci['ci_category']?></em><!-- 카테고리 -->
                                    <h3><?=$ci['ci_subject']?></h3> <!-- 제목 -->
                                </a>
                            </div>
                            <div class="cont">
                                <div class="list_wrap">
                                    <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?= $ci['idx'] ?>">
                                        <ul class="list_text">
                                            <li><em>Maker</em><span><?=$ci['ci_maker']?></span></li><!-- 제조사 -->
                                            <li><em>Model</em><span><?=$ci['ci_model']?></span></li><!-- 모델 -->
                                            <li><em>마감일</em><?=$ci['ci_deadline_date']?></li>
                                            <li class="period"><span><?php echo $dday >= 0 ? $dday.'일 남음' : '마감'; ?></span></li><!-- 견적남은기간 -->
                                        </ul>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>

					<div class="area_btn">
                        <a class="btn_list" href="<?=G5_BBS_URL?>/mypage_company02.php"><span>목록</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
// 감사 인사 작성
var is_post = false;
function state_thanks() {
    if(is_post) {
        is_post = false;
    }
    is_post = true;

    if($('#thanks').val() == '' || $('#thanks').val().length == 0) {
        swal('감사 인사를 입력해 주세요.');
        is_post = false;
        return false;
    }

    if($('#bunker').val() == '' || $('#bunker').val() == 0) {
        swal('벙커를 입력해 주세요.');
        is_post = false;
        return false;
    }

    if($('#bunker').val() < 100) {
        swal('최소 벙커는 100벙커 입니다.');
        is_post = false;
        return false;
    }
    var bunker = $('#bunker').val().replace(/,/gi, ''); // 콤마제거

    $.ajax({
        url : g5_bbs_url + "/ajax.inquiry_review.php",
        data: {idx: '<?=$ci['idx']?>', etc: $('#thanks').val(), estimate_idx: '<?=$ce['idx']?>', mode: 'thanks', bunker: bunker},
        type: 'POST',
        success : function(data) {
            if(data == 'no_bunker') {
                swal('BUNKER가 부족합니다.');
                is_post = false;
            }
            else {
                swal('감사 인사를 전달하였습니다.')
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
</script>

<?
include_once('./_tail.php');
?>