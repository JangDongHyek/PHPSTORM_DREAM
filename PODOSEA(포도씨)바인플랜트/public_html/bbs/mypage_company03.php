<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 나의의뢰';
include_once('./_head.php');

/** 특정 기업을 대상으로 한 의뢰 - 내가 받은 의뢰 **/
?>

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
                        <li><a href="<?php echo G5_BBS_URL ?>/mypage_company02.php">보낸 견적</a></li>
                        <li><a class="active" href="<?php echo G5_BBS_URL ?>/mypage_company03.php">받은 의뢰</a></li>
                    </ul>
                    <div class="box_cont">
                       
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
                                    <button type="button" onclick="mypage_company03_list();"></button>
                                </form>
							</div>
						</div>

						<div class="tab_container">
                            <input type="checkbox" class="all_chk"  id="all_chk" onclick="allChk();"><label for="all_chk" class="chk">모두선택</label>

                            <div id="tab1" class="tab_content">
                                <div id="help_list" class="inquiry03">
                                    <ul class="list full receive_inquiry"></ul>
                                </div>
                            </div>
                        </div>

                        <div id="paging"></div>

						<!-- 삭제버튼 -->
                        <div class="btn_box">
                            <input type="button" value="선택삭제" onclick="myInquiryDelete('company03');">
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
    mypage_company03_list(); // 리스트

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

    mypage_company03_list(); // 리스트
}

// 리스트
function mypage_company03_list(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    $.ajax({
        url : g5_bbs_url + "/ajax.mypage_company03.php",
        data: {page : $('#page').val(), mode : $('#mode').val(), search : $('#search').val(), orderby : $('#orderby').val()},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data) {
                $('.receive_inquiry').html(data);

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
    mypage_company03_list(page);
}
</script>

<?
include_once('./_tail.php');
?>