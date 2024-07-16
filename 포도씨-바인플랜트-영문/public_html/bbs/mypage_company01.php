<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = 'My RFQs';
include_once('./_head.php');

// ** 견적마감일 지난 접수대기 건은 자동 마감 처리
$sql = " select * from g5_company_inquiry where ci_state = 'Processing Submission' and ci_deadline_date < date_format(now(), '%Y-%m-%d') ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    if($row['ci_deadline_date'] < date('Y-m-d')) { // 금일이 견적마감일 이후면 마감 처리
        $sql = " update g5_company_inquiry set ci_state = 'Deadline' where idx = {$row['idx']}; ";
        sql_query($sql);
    }
}
// ** 견적마감일 지난 접수대기 건은 자동 마감 처리

// 삭제자료
$noshow = sql_fetch(" select group_concat(idx separator ',') as noshow from g5_company_inquiry where find_in_set('{$member['mb_id']}', noshow) ")['noshow'];

// 상태별 의뢰 수
$sql_select = " select count(*) as cnt from g5_company_inquiry where 1=1 ";
$sql_search = " and mb_id = '{$member['mb_id']}' and del_yn is null ";
if(!empty($noshow)) {
    $sql_search .= " and idx not in ({$noshow}) ";
}
$cnt_a = sql_fetch(" {$sql_select} {$sql_search} ")['cnt'];
$cnt_wait = sql_fetch(" {$sql_select} {$sql_search} and ci_state = 'Processing Submission' ")['cnt'];
$cnt_check = sql_fetch("{$sql_select} {$sql_search} and ci_state = 'Quotation Under Review' ")['cnt'];
$cnt_select = sql_fetch(" {$sql_select} {$sql_search} and ci_state = 'Transaction Complete' ")['cnt'];
$cnt_no = sql_fetch("{$sql_select} {$sql_search} and ci_state = 'Agreement Incomplete' ")['cnt'];
$cnt_finish = sql_fetch(" {$sql_select} {$sql_search} and ci_state = 'Deadline' ")['cnt'];
?>

<style>
    .hide {display: none;}
</style>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<!-- 필터 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal02" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list02" class="sort_list_mobile">
						<li class="active">By Deadline</li>
						<li>By Latest</li>
						<li>By Total Payment</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!--  필터 모달 -->


<!-- 상태변경 select 모달-->
<div id="basic_modal">
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="inquiry_idx" name="inquiry_idx">
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

<!-- 상태 마감일때 나오는 모달 -->
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
						<h2>There is no quotation <span class="msg" style="font-size: unset !important;">received</span> by the deadline for request. Would you like to extend the quotation period under the same conditions?</h2>

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
<!-- 상태 마감일때 나오는 모달 -->

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
							<li><a href="javascript:;" class="a_select">Go to choose</a></li>
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
                        <em>It cannot be modified when the status is changed due to non-conclusion.</em>
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

<input type="hidden" id="orderby" name="orderby" value="<?=$orderby?>">
<input type="hidden" id="page" name="page" value="1">
<input type="hidden" id="mode" name="mode" value="a">
<div id="area_mypage" class="company help">
    <div class="inr v3">
        <div id="mypage_wrap">
            <?php include_once('./mypage_cinfo.php'); ?>
            <div class="mypage_cont">
                <div class="box">
                    <h3>My RFQs</h3>
                    <ul id="snb">
                        <li><a class="active" href="<?php echo G5_BBS_URL ?>/mypage_company01.php">RFQ Sent</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/mypage_company02.php">Quote Sent</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/mypage_company03.php">RFQ Received</a></li>
                        <!--<li><a href="<?php echo G5_BBS_URL ?>/mypage_company04.php">매물리스트</a></li>-->
                    </ul>
                    <div class="box_cont">

						<ul class="tabs">
                            <li class="active" rel="tab1"><span>All</span><em><?=number_format($cnt_a)?></em></li>
                            <li rel="tab2"><span>Processing Submission</span><em><?=number_format($cnt_wait)?></em></li>
                            <li rel="tab3"><span>Quotation Under Review</span><em><?=number_format($cnt_check)?></em></li>
                            <li rel="tab4"><span>Transaction Complete</span><em><?=number_format($cnt_select)?></em></li>
                            <li rel="tab5"><span>Agreement Incomplete</span><em><?=number_format($cnt_no)?></em></li>
                            <li rel="tab6"><span>Deadline</span><em><?=number_format($cnt_finish)?></em></li>
                        </ul>

						<div class="top_filter">
							<div class="box_left">
								<ul class="sort_list">
									<li class="selected"><span>By Deadline</span></li>
									<li><span>By Latest</span></li>
									<li><span>By Total Payment</span></li>
								</ul>
								<div class="msort_list">
									<span data-toggle="modal" data-target="#listModal02">By Deadline</span>
								</div>
							</div>
                            <!--<button type="button" onclick="$('#search').val('');mypage_company01_list();">초기화</button>-->
                            <div class="box_sch">
								<form name="fsearchbox">
								  <input type="text" placeholder="Search" id="search" name="search" value="<?=$search?>">
								  <button type="button" onclick="mypage_company01_list();"></button>
								</form>
							</div>
						</div>

						<div class="tab_container">
							<input type="checkbox" class="all_chk" name="all_chk" id="all_chk" onclick="allChk();"><label for="all_chk" class="chk">Select all</label>

                            <div id="tab1" class="tab_content"> <!--전체-->
                                <div class="area_cont">
                                    <ul class="list_receive com01_a"></ul>
                                </div>
                            </div>
                            <div id="tab2" class="tab_content hide"> <!--접수대기-->
                                <div class="area_cont">
                                    <ul class="list_receive com01_wait"></ul>
                                </div>
                            </div>
                            <div id="tab3" class="tab_content hide"> <!--견적검토중-->
                                <div class="area_cont">
                                    <ul class="list_receive com01_check"></ul>
                                </div>
                            </div>
                            <div id="tab4" class="tab_content hide"> <!--거래완료-->
                                <div class="area_cont">
                                    <ul class="list_receive com01_select"></ul>
                                </div>
                            </div>
                            <div id="tab5" class="tab_content hide"> <!--미체결-->
                                <div class="area_cont">
                                    <ul class="list_receive com01_no"></ul>
                                </div>
                            </div>
                            <div id="tab6" class="tab_content hide"> <!--마감-->
                                <div class="area_cont">
                                    <ul class="list_receive com01_finish"></ul>
                                </div>
                            </div>
                        </div>

                        <div id="paging"></div>

						<!-- 삭제버튼 -->
						<div class="btn_box">
							<input type="button" value="Delete Selected" onclick="myInquiryDelete('company01');">
						</div>
					</div>
                </div>
            </div>
            <?php include_once('./mypage_cmenu.php'); ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="./js/mypage_company.js?v=<?=G5_JS_VER?>" charset="utf-8"></script>
<script>
$(document).ready(function() {
    mypage_company01_list(); // 리스트

    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn();
            $("#" + activeTab).removeClass('hide');

            if(activeTab == 'tab1') {
                $('#mode').val('a');
            } else if(activeTab == 'tab2') {
                $('#mode').val('wait'); // 접수대기
            } else if(activeTab == 'tab3') {
                $('#mode').val('check'); // 견적검토중
            } else if(activeTab == 'tab4') {
                $('#mode').val('select'); // 거래완료
            } else if(activeTab == 'tab5') {
                $('#mode').val('no'); // 미체결
            } else if(activeTab == 'tab6') {
                $('#mode').val('finish'); // 마감
            }

            mypage_company01_list(); // 리스트
		}
    });

    // 마감순/최신순/금액순 (웹)
    $(".sort_list li").click(function () {
        click_event('sort_list', $(this), 'selected', 'orderby');
    });

    // 마감순/최신순/금액순 (모바일)
    $(".sort_list_mobile li").click(function () {
        click_event('sort_list_mobile', $(this), 'active', 'orderby');

        $('.msort_list span').text($(this)[0]['innerText']);
        $('#listModal02').modal('hide');
    });
});

// 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
function click_event(object, element, class_name, column) {
    $('.' + object + ' li').removeClass(class_name);
    element.addClass(class_name);
    $('#' + column).val(element[0]['innerText']);

    mypage_company01_list(); // 리스트
}

// 리스트
function mypage_company01_list(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    $.ajax({
        url : g5_bbs_url + "/ajax.mypage_company01.php",
        data: {page : $('#page').val(), mode : $('#mode').val(), search : $('#search').val(), orderby : $('#orderby').val()},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data) {
                $('.com01_'+$('#mode').val()).html(data);

                // 페이징 처리 -- 하단에 페이지 표시
                ajaxGetPaging();
            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}

// 페이징 처리 -- 페이지 클릭 시 동작 이벤트
function get_page(page) {
    mypage_company01_list(page);
}
</script>

<?
include_once('./_tail.php');
?>
