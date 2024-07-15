<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 나의의뢰';
include_once('./_head.php');

// ** 견적마감일 지난 접수대기 건은 자동 마감 처리
$sql = " select * from g5_company_inquiry where ci_state = '접수대기' and ci_deadline_date < date_format(now(), '%Y-%m-%d') ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    if($row['ci_deadline_date'] < date('Y-m-d')) { // 금일이 견적마감일 이후면 마감 처리
        $sql = " update g5_company_inquiry set ci_state = '마감' where idx = {$row['idx']}; ";
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
$cnt_wait = sql_fetch(" {$sql_select} {$sql_search} and ci_state = '접수대기' ")['cnt'];
$cnt_check = sql_fetch("{$sql_select} {$sql_search} and ci_state = '견적검토중' ")['cnt'];
$cnt_select = sql_fetch(" {$sql_select} {$sql_search} and ci_state = '거래완료' ")['cnt'];
$cnt_no = sql_fetch("{$sql_select} {$sql_search} and ci_state = '미체결' ")['cnt'];
$cnt_finish = sql_fetch(" {$sql_select} {$sql_search} and ci_state = '마감' ")['cnt'];
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
						<li class="active">마감순</li>
						<li>최신순</li>
						<li>금액순</li>
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

<!-- 상태 마감일때 나오는 모달 -->
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
						<h2>의뢰 마감일까지 <span class="msg" style="font-size: unset !important;">접수</span>된 견적이 없습니다. <br>동일조건으로 견적기한을 연장하시겠습니까?</h2>
						
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
<!-- 상태 마감일때 나오는 모달 -->

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

<input type="hidden" id="orderby" name="orderby" value="<?=$orderby?>">
<input type="hidden" id="page" name="page" value="1">
<input type="hidden" id="mode" name="mode" value="a">
<div id="area_mypage" class="company help">
    <div class="inr v3">
        <div id="mypage_wrap">
            <?php include_once('./mypage_cinfo.php'); ?>
            <div class="mypage_cont">
                <div class="box">
                    <h3>나의의뢰</h3>
                    <ul id="snb">
                        <li><a class="active" href="<?php echo G5_BBS_URL ?>/mypage_company01.php">요청 의뢰</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/mypage_company02.php">보낸 견적</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/mypage_company03.php">받은 의뢰</a></li>
                        <!--<li><a href="<?php echo G5_BBS_URL ?>/mypage_company04.php">매물리스트</a></li>-->
                    </ul>
                    <div class="box_cont">
                        
						<ul class="tabs">
                            <li class="active" rel="tab1"><span>전체</span><em><?=number_format($cnt_a)?></em></li>
                            <li rel="tab2"><span>접수대기</span><em><?=number_format($cnt_wait)?></em></li>
                            <li rel="tab3"><span>견적검토중</span><em><?=number_format($cnt_check)?></em></li>
                            <li rel="tab4"><span>거래완료</span><em><?=number_format($cnt_select)?></em></li>
                            <li rel="tab5"><span>미체결</span><em><?=number_format($cnt_no)?></em></li>
                            <li rel="tab6"><span>마감</span><em><?=number_format($cnt_finish)?></em></li>
                        </ul>
                        
						<div class="top_filter">
							<div class="box_left">
								<ul class="sort_list">
									<li class="selected"><span>마감순</span></li>
									<li><span>최신순</span></li>
									<li><span>금액순</span></li>
								</ul>	
								<div class="msort_list">
									<span data-toggle="modal" data-target="#listModal02">마감순</span>
								</div>
							</div>
                            <!--<button type="button" onclick="$('#search').val('');mypage_company01_list();">초기화</button>-->
                            <div class="box_sch">
								<form name="fsearchbox">
								  <input type="text" placeholder="검색하기" id="search" name="search" value="<?=$search?>">
								  <button type="button" onclick="mypage_company01_list();"></button>
								</form>
							</div>
						</div>
						
						<div class="tab_container">
							<input type="checkbox" class="all_chk" name="all_chk" id="all_chk" onclick="allChk();"><label for="all_chk" class="chk">모두선택</label>

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
							<input type="button" value="선택삭제" onclick="myInquiryDelete('company01');">
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