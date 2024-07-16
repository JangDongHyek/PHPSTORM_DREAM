<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = 'Quotations Sent';
include_once('./_head.php');

/**  기업 - 마이페이지 - 기업의뢰 - 내가 보낸 견적 상세 **/

// 견적 정보
$ce = sql_fetch(" select * from g5_company_estimate where idx = {$idx} ");
// 의뢰 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = '{$ce['company_inquiry_idx']}' ");

$date = $ci['ci_deadline_date']; // 2013-07-14 09:14:00
$todate = date("Y-m-d", time());
$dday = (strtotime($date) - strtotime($todate)) / 86400;

if ($ce['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
    alert('It is not the right path.');
}

// 상태
if($ce['ce_state'] == 'Processing Submission') {$class = 'wait';}
else if($ce['ce_state'] == 'Quotation Under Review') { $class = 'check'; }
else if($ce['ce_state'] == 'Transaction Complete') { $class = 'select'; }
else if($ce['ce_state'] == 'Agreement Incomplete') { $class = 'no'; }
else if($ce['ce_state'] == 'Deadline') { $class = 'finish'; }
?>

<? if ($name == "cmypage") { ?>
    <body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<? } ?>

    <link rel="stylesheet" href="<?= G5_URL ?>/css/style.css?v=<?= G5_CSS_VER ?>">

    <style>
        #ft_menu {
            display: none;
        }
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
                                        <em>The contents of the order were followed exactly.</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" name="review" value="2" <?php echo in_array('2', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check02">
                                    <label for="check02">
                                        <span></span>
                                        <em>Business response is quick.</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" name="review" value="3" <?php echo in_array('3', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check03">
                                    <label for="check03">
                                        <span></span>
                                        <em>They have professionalism.</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" name="review" value="4" <?php echo in_array('4', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check04">
                                    <label for="check04">
                                        <span></span>
                                        <em>The quality of the product or service is excellent.</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" name="review" value="5" <?php echo in_array('5', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check05">
                                    <label for="check05">
                                        <span></span>
                                        <em>Etc</em>
                                    </label>
                                    <textarea id="review_etc" name="review_etc" <?=$readonly?>><?=$review['review_etc']?></textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="txt">
                            <a href="#" data-dismiss="modal">Close</a>
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
                        <h4 class="modal-title" id="appModalLabel">No transaction</h4>
                    </div>
                    <div class="modal-body">
                        <div id="star_rating">
                            <h3>We are sorry that the transaction has not been concluded.</h3>
                        </div>

                        <div class="area_check">
                            <ul class="check_list">
                                <li>
                                    <input type="checkbox" id="reason01" name="reason" value="1" <?php echo in_array('1', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason01">
                                        <span></span>
                                        <em>Uncompetitive price</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="reason02" name="reason" value="2" <?php echo in_array('2', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason02">
                                        <span></span>
                                        <em>Non-fulfillment of transaction conditions (delivery date, payment, etc.)</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="reason03" name="reason" value="3" <?php echo in_array('3', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason03">
                                        <span></span>
                                        <em>Cancel or postpone a project</em>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="reason04" name="reason" value="4" <?php echo in_array('4', $reason_) ? 'checked' : ''; ?> <?=$disabled?> >
                                    <label for="reason04">
                                        <span></span>
                                        <em>other reasons</em>
                                    </label>
                                    <textarea id="reason_etc" name="reason_etc" <?=$readonly?>><?=$reason['review_etc']?></textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="txt">
                            <a href="#" data-dismiss="modal">Close</a>
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
                        <h4 class="modal-title" id="appModalLabel">Thank you</h4>
                    </div>
                    <div class="modal-body">
                        <div class="txt">
                            <h2>Transaction review has arrived. <br>Say thank you to your buyers!</h2>
                            <textarea id="thanks" name="thanks" <?=$readonly?>><?=$thanks['review_etc']?></textarea>
                        </div>
                        <?php if($thanksCnt == 0) { ?>
                        <div class="area_btn popup">
							<div class="btn_wrap">
							<div class="bunker">
								<div class="area_icon"><img src="<?=G5_IMG_URL?>/icon_bunker.svg"></div>
								<input type="text" id="bunker" name="bunker" placeholder="Enter Bunker" onkeyup="comma_number(this);">
							</div>
                            <a class="btn_send" href="javascript:state_thanks();">Say thank you to the bunker.</a>
							</div>
                        </div>
                        <?php } else { ?>
                        <div class="txt">
                            <a href="#" data-dismiss="modal">Close</a>
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
            <h2 class="title">Quotations Sent</h2>
            <div id="mypage_wrap">
                <div class="area_cont">
                    <ul class="list_send">
                        <li>
                            <div class="top">
                                <i class="<?=$class?>"><?=$ce['ce_state']?></i>

                                <span class="data"><?=str_replace(',','.',substr($ce['wr_datetime'],0,10))?></span>

								<div class="company_box">
									<div class="cinfo">
										<div class="cinfo_wrap">
											<div class="area_photo">
											<?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
											</div>
										</div>
										<div class="id">
                                        <?php if(!$is_admin) { ?><i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><?php } ?><span><?=getNickOrId($member['mb_id'])?></span></a>
										</div>
										<div class="area_star">
											<span>company rating <i><?=companyScore($member['mb_id'], 'Y')?></i></span>
											<div class="img_star v<?=companyScore($member['mb_id'])?>">
												<span></span>
												<span></span>
												<span></span>
												<span></span>
												<span></span>
											</div>
										</div>
									</div>
									<div class="cinfo v2">
										<p>Company address</p>
                                        <h1><?=$member['mb_addr2'].' '.$member['mb_addr1']?></h1>
                                        <p>Company Tel</p>
                                        <h1><a href="TEL:<?=$member['mb_company_tel']?>"><?=$member['mb_company_tel']?></a></h1>
                                        <p>Company introduction</p>
                                        <h1><?=$member['mb_company_introduce']?></h1>
									</div>
								</div>

								<!--RFQ title -->
                        		<div class="area_box">
									<h3><em><?=$ci['ci_category']?></em><!-- 카테고리 -->
									<?=$ci['ci_subject']?></h3> <!-- 제목 -->
								</div>

                                <p class="quotation" style="padding: 0px;margin: 0px;">Quotation Date : <?=$ci['ci_deadline_date']?></p>

								<!--total cost-->
                                <h3>Quotations Proposal Price</h3>
								<div class="input_wrap total_cost">
                                    <p>
                                        <!--총금액-->
                                        <?=number_format($ce['total_cost'])?>
                                        <!--단위-->
                                        <span><?=$ce['ce_unit']?></span>
                                    </p>
								</div>

								<table class="table v2 scroll">
                                    <colgroup>
                                        <col width="1%">
                                        <col width="*">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="12%">
                                        <col width="12%">
                                    </colgroup>
									<thead>
									  <tr>
										<th>NO.</th>
										<th>DESCRIPTION</th>
										<th>REFERENCE</th>
										<th>PART NO.</th>
										<th>QUANTITY</th>
										<th>UoM</th>
										<th>QUANTITY OFFERED</th>
										<th>UoM</th>
										<th>UNIT COST</th>
										<th>LINE COST</th>
									  </tr>
									</thead>
									<tbody>
                                    <?php
                                    $contentRlt = sql_query("SELECT A.*, B.quantity_offered, B.uom AS eUom, B.unit_cost, B.line_cost 
                                                                  FROM g5_company_inquiry_content AS A 
                                                                  LEFT JOIN g5_company_estimate_content AS B ON A.idx = B.inquiry_content_idx AND B.mb_id = '{$member['mb_id']}'  
                                                                  WHERE A.inquiry_idx = '{$ce['company_inquiry_idx']}'
                                                                  ORDER BY A.idx");
                                    for ($k=1; $content=sql_fetch_array($contentRlt); $k++) {
                                    ?>
                                    <tr>
                                        <td><?=$k?></td>
                                        <td><span><?=$content['description']?></span></td>
                                        <td><span><?=$content['reference']?></span></td>
                                        <td><span><?=$content['part_no']?></span></td>
                                        <td><span><?=number_format($content['quantity'])?></span></td>
                                        <td><span><?=$content['uom']?></span></td>
                                        <td><span><?=number_format($content['quantity_offered'])?></span></td>
                                        <td><span><?=$content['eUom']?></span></td>
                                        <td><span><?=number_format($content['unit_cost'])?></span></td>
                                        <td><span><?=number_format($content['line_cost'])?></span></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="8"></td>
                                        <td>TOTAL COST</td>
                                        <td><?= number_format($ce['total_cost']) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td> VAT</td>
                                        <td>
                                            <input type="checkbox" id="vat_type1" name="vat" value="VAT" <?=$ce['vat_include_yn'] == 'Y'? 'checked' : ''?> disabled>
                                            <label for="vat_type1">
                                                <span></span>
                                                <em>INCLUDED</em>
                                            </label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="vat_type2" name="vat" value="VAT" <?=$ce['vat_include_yn'] == 'N'? 'checked' : ''?> disabled>
                                            <label for="vat_type2">
                                                <span></span>
                                                <em>EXCLUDED</em>
                                            </label>
                                        </td>
                                    </tr>
									</tbody>
								</table>

                                <!-- 기한 -->
                                <h3>Vaild To</h3>
                                <div><?=$ce['ce_valid_date']?></div>

                                <!-- 견적보내기 페이지 고객님께 드릴 말씀 -->
                                <h3>Remark</h3>
                        		<div class="area_box"><?=nl2br($ce['ce_contents'])?></div>

                                <!-- 첨부파일 -->
                                <h3>Attachment</h3>
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
                                <a href="#" class="btn_review" data-toggle="modal" data-target="#reviewModal"><span>Check out transaction reviews</span></a><!-- 기업리뷰페이지로 연결-->
                                <a href="#" class="btn_review v2" data-toggle="modal" data-target="#thanksModal"><span><?php echo $thanksCnt > 0 ? 'Completion of thank you note' : 'Send thank you'; ?></span></a>
                                <!-- //의뢰자가 거래후기 보내면 나타나는 버튼-->
                                <?php
                                }
                                if($ce['ce_state'] == 'Agreement Incomplete') {
                                ?>
                                <!-- 의뢰자가 미체결 사유 작성 시 나타나는 버튼-->
                                <a href="#" class="btn_review" data-toggle="modal" data-target="#noModal"><span>Check the reason for Agreement Incomplete</span></a>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
				<div class="area_detail">
                   <a href="<?=G5_BBS_URL?>/estimate.php?idx=<?=$ci['idx']?>&ce_idx=<?=$ce['idx']?>&w=u">Edit Quotation</a>
				</div>
            </div>


            <div class="mypage_box">
                <div id="help_list">
                    <h4>Client request<a class="btn_link" href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$ci['idx']?>">More +</a></h4>
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
                                            <li><em>Deadline</em><?=$ci['ci_deadline_date']?></li>
                                            <li class="period"><span><?php echo $dday >= 0 ? $dday.'days left' : 'Deadline'; ?></span></li><!-- 견적남은기간 -->
                                        </ul>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>

					<div class="area_btn">
                        <a class="btn_list" href="<?=G5_BBS_URL?>/mypage_company02.php"><span>List</span></a>
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
        swal('Please enter a thank you note.');
        is_post = false;
        return false;
    }

    if($('#bunker').val() == '' || $('#bunker').val() == 0) {
        swal('Please enter the bunker.');
        is_post = false;
        return false;
    }

    if($('#bunker').val() < 100) {
        swal('The minimum bunker is 100 bunkers.');
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
                swal('BUNKER is not enough.');
                is_post = false;
            }
            else {
                swal('Sent a thank you message.')
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
