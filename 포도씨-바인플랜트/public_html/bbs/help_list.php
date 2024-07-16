<?php
include_once('./_common.php');

$g5['title'] = '헬프미';
include_once('./_head.php');

//loginCheck($member['mb_id'], $member['mb_category']);

// 검색 (검색어 입력)
$sql_search = "";
if(!empty($search)) {
    $sql_search .= " and (he_subject like '%{$search}%' or he_contents like '%{$search}%' or he_hashtag like '%{$search}%') ";
}

// 헬프미 리스트
$sql = " select * from g5_helpme where 1=1 {$sql_search} {$sql_orderby} ";
$result = sql_query($sql);

// 채택하지 않은 답변 - 있으면 알림창 (하루에 한번 - 임시)
$cnt = sql_fetch(" select count(*) as cnt from g5_helpme_answer as an left join g5_helpme as he on he.idx = an.helpme_idx where he.mb_id = '{$member['mb_id']}' and he.he_answer_state = '답변대기' and an.an_selection is null and he.del_yn is null ")['cnt'];
$no_select_flag = false;
if($cnt > 0) {
    $today = date('Y-m-d');
    $cnt2 = sql_fetch(" select count(*) as cnt from g5_flag where mb_id = '{$member['mb_id']}' and date_format(wr_datetime, '%Y-%m-%d') = '{$today}' ")['cnt']; // 오늘 알림창 띄웠는지 확인
    if($cnt2 == 0) { // 띄운적 없으면
        sql_query(" insert into g5_flag set mb_id = '{$member['mb_id']}', wr_datetime = '".G5_TIME_YMDHIS."' "); // 알림창 확인용 DB INSERT
        $no_select_flag = true; // 채택하지 않은 답변 있음
    }
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<?php include_once('./category_modal.php'); ?>

<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="sort_list_mobile">
						<li class="active">인기순</li>
						<li>최신순</li>
						<li>벙커순</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

<!-- 채택 되지 않은 답변 알림 확인 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="noSelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="txt confirm">
                        <h2>채택되지 않은 답변이 있습니다.</h2>
                    </div>
                    <ul class="madal_btn">
                        <li data-dismiss="modal">확인</li>
                        <?php
                        if($member['mb_level'] == 2) { $url = "./mypage_help.php"; }
                        else { $url = "./mypage_chelp.php"; }
                        ?>
                        <li class="ok" onclick="location.href='<?=$url?>'">마이페이지</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 채택 되지 않은 답변 알림 확인 모달 -->

<div id="area_help">
	<div class="inr">
	<div id="top_bn">
		<div class="txt">
			<h2>헬프미</h2>
			<span>조선, 해양 관련 어떤 것이든 물어보세요!</span>
		</div>
		<img src="<?php echo G5_IMG_URL ?>/bn_obj.png">
	</div>
	<div id="help_warp">
		<?php include_once('./left_menu.php'); ?> 
		<div id="help_list">
            <input type="hidden" id="orderby" name="orderby" value="<?=$orderby?>">
            <input type="hidden" id="state" name="state" value="<?=$state?>">
            <input type="hidden" id="category" name="category" value="<?=$category?>">
            <input type="hidden" id="date" name="date" value="<?=$date?>">
            <input type="hidden" id="sch_tag" name="sch_tag" value="<?=$sch_tag?>">
            <input type="hidden" id="page" name="page" value="1">
			
			<div class="top_filter">
				<ul class="tabs">
                    <li style="visibility: hidden;">&nbsp;</li>
					<li class="active" rel="tab1"><span>답변대기</span></li>
					<li rel="tab2"><span>답변완료</span></li>
				</ul>
				<ul class="sort_list">
					<li class="selected"><span>인기순</span></li>
					<li><span>최신순</span></li>
					<li><span>벙커순</span></li>
				</ul>
				<div class="msort_list">
					<span data-toggle="modal" data-target="#listModal">인기순</span>
				</div>
			</div>
			<div class="mbox_cate">
				<span data-toggle="modal" data-target="#cateModal"><i></i>카테고리 선택</span>
			</div>
			<div class="tab_container">
				<div id="tab1" class="tab_content">
					<ul class="list helpme">
					</ul>
                </div>
				<div id="tab2" class="tab_content">
                    <ul class="list helpme"></ul>
				</div>

                <div id="paging"></div>
			</div>
		</div>
		<?php
        if($is_member) { // 로그인 안하면 숨김
            if ($member['mb_category'] == '일반') {
                include_once('./myinfo.php');
            } else {
                include_once('./myinfo_company.php');
            }
        } else {
        ?>
        <div id="area_my">
            <div class="area_write">
                <a href="<?php echo G5_BBS_URL ?>/help_write.php"><span>질문하기</span></a>
            </div>
        </div>
        <?php
        }
        ?>
	</div>
</div>

<div class="btn_write"><a href="<?php echo G5_BBS_URL ?>/help_write.php"></a></div>

</div>

<script>
    $(function() {
        if('<?=$no_select_flag?>') {
            // swal('채택되지 않은 답변이 있습니다.');
            $('#noSelectModal').modal('show');
        }

        help_list(); // 리스트

        $(".tab_content").hide();
        $(".tab_content:first").show();

        // 답변대기/답변완료
        $("ul.tabs li").click(function () {
            if (!($(this).find('a').length > 0)) {
                $("ul.tabs li").removeClass("active");
                $(this).addClass("active");
                $(".tab_content").hide()
                var activeTab = $(this).attr("rel");
                $("#" + activeTab).fadeIn()

                $('#state').val($(this)[0].innerText);

                help_list(); // 리스트
            }
        });
    });

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
    function click_event(object, element, class_name, column) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        help_list(); // 리스트
    }

	// 헬프미 리스트 (ajax)
	function help_list(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.help_list.php",
            data: {orderby : $('#orderby').val(), state : $('#state').val(), search : $('#search').val(), category : $('#category').val(), date : $('#date').val(), page : $('#page').val(), sch_tag : $('#sch_tag').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.helpme').html(data);

                    var search = $.trim($('#search').val());
                    $(".left").highlight(search); // 검색어 있을 시 하이라이트

                    // 페이징 처리 -- 하단에 페이지 표시
                    ajaxGetPaging();
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 태그 검색
    function tag_search(tag) {
        // 검색폼에 데이터 입력
        $('#sch_tag').val(tag);
        $('#search').val(tag);
        help_list();
    }

    // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    function get_page(page) {
        help_list(page);
    }
</script>

<?php
include_once(G5_BBS_PATH.'/help_list_search_script.php');
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>