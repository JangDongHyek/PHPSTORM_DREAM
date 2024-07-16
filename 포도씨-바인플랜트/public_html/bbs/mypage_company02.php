<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 나의의뢰';
include_once('./_head.php');

// 삭제자료
$noshow = sql_fetch(" select group_concat(idx separator ',') as noshow from g5_company_estimate where find_in_set('{$member['mb_id']}', noshow) ")['noshow'];

// 상태별 견적 수
$sql_select = " select count(*) as cnt from g5_company_estimate as ce left join g5_company_inquiry as ci on ce.company_inquiry_idx = ci.idx where 1=1 ";
$sql_search = " and ce.mb_id = '{$member['mb_id']}' and del_yn is null ";
if(!empty($noshow)) {
    $sql_search .= " and ce.idx not in ({$noshow}) ";
}
$cnt_a = sql_fetch("{$sql_select} {$sql_search} ")['cnt'];
$cnt_wait = sql_fetch("{$sql_select} {$sql_search} and ci_state = '접수대기' ")['cnt'];
$cnt_check = sql_fetch("{$sql_select} {$sql_search} and ci_state = '견적검토중' ")['cnt'];
$cnt_select = sql_fetch("{$sql_select} {$sql_search} and ci_state = '거래완료' ")['cnt'];
$cnt_no = sql_fetch("{$sql_select} {$sql_search} and ci_state = '미체결' ")['cnt'];
$cnt_finish = sql_fetch("{$sql_select} {$sql_search} and ci_state = '마감' ")['cnt'];
?>

<? if ($name == "cmypage") { ?>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<? } ?>

<link rel="stylesheet" href="<?= G5_URL ?>/css/style.css?v=<?= G5_CSS_VER ?>">

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
                        <li><a href="<?php echo G5_BBS_URL ?>/mypage_company01.php">요청 의뢰</a></li>
                        <li><a class="active" href="<?php echo G5_BBS_URL ?>/mypage_company02.php">보낸 견적</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/mypage_company03.php">받은 의뢰</a></li>
                        <!--<li><a href="<?php echo G5_BBS_URL ?>/mypage_company03.php">매물리스트</a></li>-->
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
							<div class="box_sch">
                                <form name="fsearchbox" onsubmit="return searchChk();">
                                    <input type="text" placeholder="검색하기" id="search" name="search" value="<?=$search?>">
                                    <button type="button" onclick="mypage_company02_list();"></button>
                                </form>
							</div>
						</div>

                        <div class="tab_container">
                            <input type="checkbox" class="all_chk" id="all_chk" onclick="allChk();"><label for="all_chk" class="chk">모두선택</label>

                            <div id="tab1" class="tab_content"> <!--전체-->
                                <div class="area_cont">
                                    <ul class="list_send com02_a"></ul>
                                </div>
                            </div>
                            <div id="tab2" class="tab_content hide"> <!--접수대기-->
                                <div class="area_cont">
                                    <ul class="list_send com02_wait"></ul>
                                </div>
                            </div>
                            <div id="tab3" class="tab_content hide"> <!--견적검토중-->
                                <div class="area_cont">
                                    <ul class="list_send com02_check"></ul>
                                </div>
                            </div>
                            <div id="tab4" class="tab_content hide"> <!--거래완료-->
                                <div class="area_cont">
                                    <ul class="list_send com02_select"></ul>
                                </div>
                            </div>
                            <div id="tab5" class="tab_content hide"> <!--미체결-->
                                <div class="area_cont">
                                    <ul class="list_send com02_no"></ul>
                                </div>
                            </div>
                            <div id="tab6" class="tab_content hide"> <!--마감-->
                                <div class="area_cont">
                                    <ul class="list_send com02_finish"></ul>
                                </div>
                            </div>
                        </div>

                        <div id="paging"></div>

						<!-- 삭제버튼 -->
						<div class="btn_box">
                            <input type="button" value="선택삭제" onclick="myInquiryDelete('company02');">
						</div>
                    </div>
                </div>
            </div>
            <?php include_once('./mypage_cmenu.php'); ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    mypage_company02_list(); // 리스트

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

            mypage_company02_list(); // 리스트
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

    mypage_company02_list(); // 리스트
}

// 리스트
function mypage_company02_list(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    $.ajax({
        url : g5_bbs_url + "/ajax.mypage_company02.php",
        data: {page : $('#page').val(), mode : $('#mode').val(), search : $('#search').val(), orderby : $('#orderby').val()},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data) {
                $('.com02_'+$('#mode').val()).html(data);

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
    mypage_company02_list(page);
}
</script>

<?
include_once('./_tail.php');
?>