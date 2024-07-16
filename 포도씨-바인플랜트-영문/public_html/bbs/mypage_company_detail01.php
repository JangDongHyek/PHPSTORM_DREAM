<?
include_once('./_common.php');

$g5['title'] = 'Request My RFQs';
include_once('./_head.php');

if(empty($idx)) {
    alert('It is not the right path.');
}

loginCheck($member['mb_id'], '기업');

// 기업의뢰 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = {$idx} ");

// 견적기한
$date = $ci['ci_deadline_date']; // 2013-07-14 09:14:00
$todate = date("Y-m-d", time());
$dday = ( strtotime($date) - strtotime($todate) ) / 86400;

// 상태
if($ci['ci_state'] == 'Processing Submission') {$class = 'wait';}
else if($ci['ci_state'] == 'Quotation Under Review') { $class = 'check'; }
else if($ci['ci_state'] == 'Transaction Complete') { $class = 'select'; }
else if($ci['ci_state'] == 'Agreement Incomplete') { $class = 'no'; }
else if($ci['ci_state'] == 'Deadline') { $class = 'finish'; }

// 견적 수
$cnt2 = selectCount('g5_company_estimate', 'company_inquiry_idx', $idx);
// 선택된 견적이 있는지 확인
$selection = selectCount('g5_company_estimate', 'company_inquiry_idx', $idx, 'ce_selection', 'Y');
if($cnt2 > 0) { $msg = 'selected'; } else { $msg = 'received'; }

if($ci['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
    alert('It is not the right path.');
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
                        <li class="active li_wait">Processing Submission</li>
                        <li class="li_check">Quotation Under Review</li>
                        <li class="li_select">Transaction Complete</li>
                        <li class="li_no">Agreement Incomplete</li>
                        <li class="li_finish hide">Deadline</li>
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
                    <h4 class="modal-title" id="appModalLabel">No transaction</h4>
                </div>
                <div class="modal-body">
                    <div id="star_rating">
                        <h3>We are sorry that the transaction <br>has not been concluded.</h3>
						<span class="writer">
						Please tell us why the deal was not closed for the supplier <br>who submitted the quote.<br>
						(Select from the following, duplicate selection possible)
						</span>
                    </div>
                    <!--star_rating-->

                    <div class="area_check">
                        <ul class="check_list">
                            <li>
                                <input type="checkbox" id="reason01" name="reason" value="1">
                                <label for="reason01">
                                    <span></span>
                                    <em>Uncompetitive price</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="reason02" name="reason" value="2">
                                <label for="reason02">
                                    <span></span>
                                    <em>Non-fulfillment of transaction conditions (delivery date, payment, etc.)</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="reason03" name="reason" value="3">
                                <label for="reason03">
                                    <span></span>
                                    <em>Cancel or postpone a project</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="reason04" name="reason" value="4">
                                <label for="reason04">
                                    <span></span>
                                    <em>other reasons</em>
                                </label>
                                <textarea id="reason_etc" name="reason_etc"></textarea>
                            </li>
                        </ul>
                    </div>
                    <div class="area_btn popup">
                        <a class="btn_send writer" href="javascript:state_no();">Confirm</a>
                    </div>
                    <div class="txt" style="display: none;">
                        <a href="javascript:void(0);" data-dismiss="modal">Close</a>
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
                    <h4 class="modal-title" id="appModalLabel">Ttransaction review <?php echo $reviewCnt > 0 ? '' : 'Send'; ?></h4>
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
                        <?php echo $reviewCnt > 0 ? '' : '<h2>Please select a star rating.</h2>'; ?>
					</div>
					<!--star_rating-->

					<div class="area_check">
						<ul class="check_list">
							<li>
								<input type="checkbox" name="review" value="1" <?php echo in_array('1', $review_) ? 'checked' : ''; ?> <?=$disabled?> id="check01">
								<label for="check01">
									<span></span>
									<em>Accurately complied with the request.</em>
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
									<em>We have the expertise.</em>
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
                    <?php if($reviewCnt == 0) { ?>
					<div class="area_btn popup col02">
					    <a class="btn_send" href="javascript:state_review();">Send a transaction review</a>
                        <a class="btn_send v2" href="javascript:companyReSelect('<?=$idx?>');">Reselection of trading company</a>
					</div>
                    <?php } else { ?>
                    <div class="txt">
                        <a href="javascript:void(0);" data-dismiss="modal">Close</a>
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
                    <h4 class="modal-title" id="appModalLabel">RFQ Deadline</h4>
                </div>
                <div class="modal-body">

                    <div class="txt">
                        <h2>There is no quotation <?=$msg?> by the deadline for request. Would you like to extend the quotation period under the same conditions?</h2>

                        <!-- "네"버튼 누르면 나오는 화면 -->
                        <div class="area_data">
                            <label>Please enter the Quotation Deadline</label>
                            <input type="date" id="deadline_date" name="deadline_date">
                        </div>
                        <!-- "네"버튼 누르면 나오는 화면 -->

                    </div>

                    <div class="area_btn popup">
                        <ul class="btn_list">
                            <li><a href="javascript:state_finish('ok');">YES</a></li>
                            <li><a href="javascript:state_finish('no');">NO</a></li>
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
                    <h4 class="modal-title" id="appModalLabel">Transaction Complete</h4>
                </div>
                <div class="modal-body">

                    <div class="txt"><h2>Congratulations on the success of the transaction. <br>Please choose the partner company.</h2></div>
                    <div class="area_btn popup">
                        <ul class="btn_list">
                            <li><a href="javascript:;" class="a_select">Go to choose.</a></li>
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
                        <h2>Do you want to change the status?</h2>
                        <em>t cannot be modified when the status is changed to Agreement Incomplete.</em>
                    </div>
                    <ul class="madal_btn">
                        <li data-dismiss="modal">Cancel</li>
                        <li class="ok" onclick="state_change('<?=$idx?>', 'Agreement Incomplete');">Agreement Incomplete</li>
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
                    <h4 class="modal-title" id="appModalLabel">Thank you</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <h2>A thank you note arrived from<br>the partner company along with <em class="blue" style="color: blue;"><?=number_format($thanks['bunker'])?> bunkers.</em></h2>
                        <textarea id="thanks" name="thanks" <?=$readonly?>><?=$thanks['review_etc']?></textarea>
                    </div>
                    <div class="txt">
                        <a href="#" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  감사 인사보내기 모달 -->

<div id="area_help" class="company_write my">
    <div class="inr v3">
        <h2 class="title">Request My RFQs</h2>
        <div class="mypage_box">
            <?php if($dday == 0 && $ci['ci_state'] == 'Processing Submission') { // 금일이 의뢰마감일 && Processing Submission(접수대기) 상태 ?>
            <div class="dday" data-toggle="modal" data-target="#finishModal">
                <i>D-Day</i><p>There is no quotation <?=$msg?> by the deadline for request.</p>
            </div>
            <?php } ?>
            <div id="help_list">
                <ul class="list">
                    <li class="company">
                        <div class="title">
                            <i class="<?=$class?>" onclick="state_modal('<?=$idx?>', '<?=$ci['ci_state']?>', '<?=$cnt2?>', '<?=$selection?>');"><em></em><?=$ci['ci_state']?></i>
							<!--<a href="">-->
                                <em><?=$ci['ci_category']?></em><!-- 카테고리 --><br>
                                <h3><?=$ci['ci_subject']?></h3> <!-- 제목 -->
                            <!--</a>-->
                        </div>
                        <div class="cont">
                            <div class="list_wrap">
                                <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$ci['idx']?>">
                                    <ul class="list_text">
                                        <li><em>Maker</em><span><?=$ci['ci_maker']?></span></li><!-- 제조사 -->
                                        <li><em>Model</em><span><?=$ci['ci_model']?></span></li><!-- 의뢰국가 -->
                                        <li><em>Deadline</em><?=$ci['ci_deadline_date']?></li>
                                        <li class="period"><span><?php echo $dday >= 0 ? $dday.' days left' : 'Deadline'; ?></span></li><!-- 견적남은기간 -->
                                    </ul>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
			<div class="area_detail">
               <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$ci['idx']?>">View My RFQ Request Details</a>
			</div>
        </div>
        <div class="mypage_box">
            <h3>Please select a partner company.</h3>

            <div id="help_list">
                <?php
                // 견적 리스트
                $rlt = sql_query(" select ce.*, mb.mb_no, mb.mb_category, mb_addr1, mb_addr2, mb_company_tel, mb_company_introduce, mb_grade
                                        from g5_company_estimate as ce 
                                        left join g5_member as mb on mb.mb_id = ce.mb_id
                                        where company_inquiry_idx = '{$ci['idx']}'
                                        order by idx ");
                $i = 0;
                $selection_flag = false; // 선택된 기업이 있는지 확인 플래그
                $selection_cnt = sql_fetch("select count(*) as cnt from g5_company_estimate where company_inquiry_idx = '{$ci['idx']}' and ce_selection = 'Y' ")['cnt']; // 선택된 기업의 개수
                if($selection_cnt > 0) { $selection_flag = true; } // 선택된 기업이 있으면 true
                while ($ce = sql_fetch_array($rlt)) {
                    $i++;
                ?>
                <div class="help_question">
                    <!-- 채택된 답변 표시 아이콘-->
                    <?php if($ce['ce_selection'] == 'Y') { ?>
                    <div class="area_select">
                        <span></span>
                        <em>Select</em>
                    </div>
                    <?php } ?>
                    <div class="title">
                        <div class="area_name" onclick="userToggle('user_list_<?=$ce['idx']?>');">
                            <div class="profile" onclick="profileOpen('<?=$ce['mb_category']?>', '<?=$ce['idx']?>', '<?=$ce['mb_id']?>');"><?php echo getProfileImg($ce['mb_id'], $ce['mb_category']); ?></div> <!-- 프로필사진 -->
                            <div class="profile_info">
                                <h4 class="toggle"><?=$ce['mb_id']?></h4> <!-- 아이디 -->
                                <em class="price"><i>Estimate</i><?=number_format($ce['total_cost']).' '.$ce['ce_unit']?></em> <!-- 견적제안금액 -->
                            </div>
                            <ul class="user_list_<?=$ce['idx']?> user_list" style="top: 60px !important;left: 20px !important;">
                                <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$ce['mb_no']?>">Go to Company Homepage</a></li>
                                <li>RFQs  <em class="blue"><?=inquiryCount($ce['mb_id'])?></em></li>
                                <li>Transactions  <em class="blue"><?=completeCount($ce['mb_id'])?></em></li>
                                <li onclick="reportOpen('<?=$ce['mb_id']?>', 'g5_compamy_estimate', '<?=$ce['idx']?>')">Report</li>
                            </ul>
                        </div>

						<div style="cursor: pointer; width: calc( 100% - 350px ); text-align: right; display: flex; justify-content: right;">
                            <em class="price" ><i>Valid To <br class="visible-xs"><?=$ce['ce_valid_date']?></i></em>
                            <a class="answer_print answer_print<?=$ce['idx']?> hide" onclick="printEstimate(<?=$ce['idx']?>)" style="margin-left: unset!important;"><em>Print</em></a>

                            <?php if(!$selection_flag && $ci['ci_state'] == 'Transaction Complete') { // 거래완료 상태일 때 회사 선택 가능 ?>
                            <!-- 채택하기 버튼-->
                            <a class="answer_select" href="javascript:select_action('<?=$ce['idx']?>');"><span></span><em>Select</em></a>
                            <!-- //채택하기 버튼-->
                            <?php } ?>

                            <!-- 요약 열기 -->
                            <div data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$ce['idx']?>" aria-expanded="false" aria-controls="collapse<?=$ce['idx']?>" onclick="estimateDetail(this, '<?=$ce['idx']?>')">
                            <a class="collapsed button btn-cps" role="button" >
                                <i class="fal fa-sort-down"></i>
                            </a>
                            </div>
						</div>
                    </div>

                    <div class="area_bottom">
						<div class="panel panel-default estimatePrint<?=$ce['idx']?>">
							<div id="collapse<?=$ce['idx']?>" class="panel-collapse collapse">
								<div class="panel-body">
									 <div class="bottom">

                        				<em class="price2"><i>Valid To <?=$ce['ce_valid_date']?></i>
										<!--제안 기업 정보-->
										<div class="company_box">
											<div class="cinfo">
												<div class="cinfo_wrap">
													<div class="area_photo">
													<?php echo getProfileImg($ce['mb_id'], $ce['mb_category']); ?>
													</div>
												</div>
												<div class="id">
                                                <?php if(!$is_admin) { ?><i class="lv<?=array_search($ce['mb_grade'], $member_grade)?>"><?=$ce['mb_grade']?></i><?php } ?><span><?=getNickOrId($ce['mb_id'])?></span>
												</div>
												<div class="area_star">
													<span>company rating <i><?=companyScore($ce['mb_id'], 'Y')?></i></span>
													<div class="img_star v<?=companyScore($ce['mb_id'])?>">
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
												<h1><?=$ce['mb_addr2'].' '.$ce['mb_addr1']?></h1>
												<p>Company Tel</p>
												<h1><a href="TEL:<?=$ce['mb_company_tel']?>"><?=$ce['mb_company_tel']?></a></h1>
												<p>Company introduction</p>
												<h1><?=$ce['mb_company_introduce']?></h1>
											</div>
										</div>

										<!--RFQ title -->
										<div class="area_box">
											<h3><em><?=$ci['ci_category']?></em><!-- 카테고리 -->
											<?=$ci['ci_subject']?></h3> <!-- 제목 -->
										</div>

                                         <p class="quotation">Quotation Date : <?=$ci['ci_deadline_date']?></p>

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
												<th>QUANTITY<br/>OFFERED</th>
												<th>UoM</th>
												<th>UNIT COST</th>
												<th>LINE COST</th>
											  </tr>
											</thead>
											<tbody>
                                            <?php
                                            $contentRlt = sql_query("SELECT A.*, B.quantity_offered, B.uom AS eUom, B.unit_cost, B.line_cost 
                                                                          FROM g5_company_inquiry_content AS A 
                                                                          LEFT JOIN g5_company_estimate_content AS B ON A.idx = B.inquiry_content_idx AND B.mb_id = '{$ce['mb_id']}'  
                                                                          WHERE A.inquiry_idx = '{$idx}'
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
										<div><?=nl2br($ce['ce_contents'])?></div> <!-- 고객님께 드리는말씀 -->

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

									</div>
								</div>
							</div>
						</div>

						<div class="bottom">
						   <?php if($ce['ce_selection'] == 'Y') { // 선택한 회사만 ?>
							<a href="javascript:send_review('<?=$ce['idx']?>');" class="btn_review"><span><?php echo $reviewCnt > 0 ? 'Completed transaction review' : 'Send a transaction review'; ?></span></a>
							<?php
							$thanksCnt = selectCount("g5_company_inquiry_result", "inquiry_idx", $ci['idx'], "type", "감사인사"); // 리뷰 수
							if(!empty($thanksCnt)) { // 감사 인사 있으면 보임 ?>
							<a href="#" class="btn_review v2" data-toggle="modal" data-target="#thanksModal"><span>Check out thank you notes</span></a>
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
				<a class="btn_list" href="<?=G5_BBS_URL?>/mypage_company01.php"><span>List</span></a>
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
                    swal('A partner company has been selected.\n Please write a transaction review.')
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
            swal('Please select a star rating.');
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
                        swal('Transaction review has been sent.')
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
            swal('Please select a transaction review.');
            is_post = false;
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

    // 견적 상세보기
    const estimateDetail = (element, idx) => {
        document.querySelector(`.answer_print${idx}`).classList.add('hide');

        const expanded = element.getAttribute("aria-expanded");
        if(expanded == 'false') {
            document.querySelector(`.answer_print${idx}`).classList.remove('hide');
        }
    }

    // 견적 프린트
    let popup = '';
    const printEstimate = (idx) => {
        document.querySelector(`#collapse${idx}`).classList.add('printBox');
        document.querySelector(`#collapse${idx}`).setAttribute('onclick', 'printActive()');

        popup = window.open('', '', 'width=1200px,height=1000px,scrollbars=yes');
        popup.document.write(document.querySelector('head').innerHTML);
        popup.document.write(document.querySelector(`.estimatePrint${idx}`).innerHTML);

        popup.document.write("<script>");
        popup.document.write("function printActive() {");
        popup.document.write("print();");
        popup.document.write("}");
        popup.document.write("<\/script>");

        popup.addEventListener('beforeunload', function() {
            document.querySelector(`#collapse${idx}`).classList.remove('printBox');
            document.querySelector(`#collapse${idx}`).removeAttribute('onclick');
        });
    }
</script>

<?
include_once('./_tail.php');
?>
