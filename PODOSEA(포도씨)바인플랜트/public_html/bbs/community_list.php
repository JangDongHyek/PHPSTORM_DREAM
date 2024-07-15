<?
include_once('./_common.php');

// 카테고리
if($op == 'tab1') {
    $co_category = '꿀팁';
} else if($op == 'tab2') {
    $co_category = '일상 이런저런';
} else if($op == 'tab3') {
    $co_category = '회사/현장 이야기';
} else if($op == 'tab4') {
    $co_category = '해양뉴스';
} else if($op == 'tab5') {
    $co_category = '긴급구인';
}

$g5['title'] = $co_category;
include_once('./_head.php');

$sql_search = " and co_category = '{$co_category}' and del_yn is null ";
if(!empty($search)) { // 검색어 입력
    $sql_search .= " and (co_subject like '%{$search}%' or co_contents like '%{$search}%') ";
}
$sql_orderby = " order by co_good desc, wr_datetime "; // 정렬

/**
 * 앱 심사용 - 차단한 사용자 숨김
 * ajax.help_list.php, help_view.php, ajax.community_list.php, community_view.php, community.php, community_list.php
 */
if($member['mb_id'] == 'test01') {
    if(!empty(blockUser($member['mb_id']))) {
        $block = blockUser($member['mb_id']);
        $sql_search .= " and mb_id not in ({$block}) ";
    }
}

/**테스트용**/
if(!$private) {
    $sql_search .= "and mb_id != 'test01' ";
}

// 최근 인기글 (좋아요 많은 순, 일주일 기준?)
$sql1 = " select * from g5_community where date_format(wr_datetime, '%Y-%m-%d') > date_add(date_format(now(), '%Y-%m-%d'), INTERVAL -1 WEEK) {$sql_search} {$sql_orderby} limit 7; ";
$result1 = sql_query($sql1);

// 월간 인기글 (좋아요 많은 순)
$sql2 = " select * from g5_community where date_format(wr_datetime, '%Y-%m-%d') > date_add(date_format(now(), '%Y-%m-%d'), INTERVAL -1 MONTH) {$sql_search} {$sql_orderby} limit 7; ";
$result2 = sql_query($sql2);

// 전체 건수
$total_count = sql_fetch(" select count(*) as count from g5_community where 1=1 {$sql_search} {$sql_orderby}; ")['count'];
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
    .highlight {color:#275dd7;}
</style>

<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="sort_list_mobile">
                        <li class="active">최신순</li>
						<li>인기순</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

<div id="area_community">
	<div id="sub_bn">
		<div class="txt">
			<h1><img src="<?php echo G5_IMG_URL ?>/community_txt.png"></h1>
			<span>포도씨 회원님들과 소통해보세요.</span>
			<a href="<?php echo G5_BBS_URL ?>/community_write.php"><span>글쓰기</span></a>
		</div>
		<div class="img"><img src="<?php echo G5_IMG_URL ?>/community_obj.png"></div>
	</div>
	<div class="community_cate">
		<div class="inr v3">
			<ul class="list_cate">
                <li><a <?php echo $op == '' ? 'class="active"' : ''; ?> href="<?php echo G5_BBS_URL ?>/community.php">전체</a></li>
                <li><a <?php echo $op == 'tab1' ? 'class="active"' : ''; ?> href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab1">꿀팁</a></li>
                <li><a <?php echo $op == 'tab2' ? 'class="active"' : ''; ?> href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab2">일상 이런저런</a></li>
                <!--<li><a <?php /*echo $op == 'tab3' ? 'class="active"' : ''; */?> href="<?php /*echo G5_BBS_URL */?>/community_list.php?op=tab3">회사/현장 이야기</a></li>-->
                <li><a <?php echo $op == 'tab4' ? 'class="active"' : ''; ?> href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab4">해양뉴스</a></li>
                <!--<li><a <?php /*echo $op == 'tab5' ? 'class="active"' : ''; */?> href="<?php /*echo G5_BBS_URL */?>/community_list.php?op=tab5">긴급구인</a></li>-->
			</ul>
			<div class="box_sch">
                <form name="fsearchbox" method="get">
                    <input type="text" placeholder="검색하기" name="search" id="search" value="<?=$search?>">
                    <input type="hidden" name="op" value="<?=$op?>">
                    <input type="hidden" name="orderby" id="orderby">
                    <input type="hidden" name="page" id="page" value="1">
                    <button type="submit"></button>
                </form>
			</div>
		</div>
	</div>
	<div class="inr v3">
		<div class="area_top">
			<div class="area_board">
				<h3>최근 인기글</h3>
                <ul>
                    <?php
                    for($i=0; $row=sql_fetch_array($result1); $i++) {
                    ?>
                    <!-- 목록 7개 -->
                    <li>
                        <a href="<?=G5_BBS_URL?>/community_view.php?idx=<?=$row['idx']?>">
                            <span><?=$row['co_subject']?></span><!-- 제목 -->
                            <em><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></em><!-- 날짜 -->
                        </a>
                    </li>
                    <?php
                    }
                    if($i==0) {
                    ?>
                    <li class="nodata">등록된 글이 없습니다.</li>
                    <?php
                    }
                    ?>
                </ul>
			</div>
			<div class="area_board">
				<h3>월간 인기글</h3>
                <ul>
                    <?php
                    for($i=0; $row=sql_fetch_array($result2); $i++) {
                    ?>
                    <!-- 목록 7개 -->
                    <li>
                        <a href="<?=G5_BBS_URL?>/community_view.php?idx=<?=$row['idx']?>">
                            <span><?=$row['co_subject']?></span><!-- 제목 -->
                            <em><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></em><!-- 날짜 -->
                        </a>
                    </li>
                    <?php
                    }
                    if($i==0) {
                    ?>
                    <li class="nodata">등록된 글이 없습니다.</li>
                    <?php
                    }
                    ?>
                </ul>
			</div>
		</div>
		<div class="area_bottom">
			<div class="tab_container">
				<div class="tab_content">
					<div class="top_filter">
						<span class="view">전체 <span class="blue"><?=number_format($total_count)?></span>건</span>
						<ul class="sort_list">
                            <li class="selected"><span>최신순</span></li>
							<li><span>인기순</span></li>
						</ul>
						<div class="msort_list">
							<span data-toggle="modal" data-target="#listModal">최신순</span>
						</div>
					</div>
                    <!--ajax.community_list.php-->
					<ul class="board_list"></ul>

                    <div id="paging"></div>

					<!--<nav class="pg_wrap">
						<span class="pg">
							<a href="" class="pg_page pg_start"></a>
							<a href="" class="pg_page pg_prev"></a>
							<span class="sound_only">열린</span>
								<strong class="pg_current">1</strong>
							<span class="sound_only">페이지</span>
							<a href="" class="pg_page">2</a>
							<a href="" class="pg_page">3</a>
							<a href="" class="pg_page pg_next"></a>
							<a href="" class="pg_page pg_end"></a>
						</span>
					</nav>-->

				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {
        community_list(); // 리스트

        // 인기순/최신순 (웹)
        $(".sort_list li").click(function () {
            click_event('sort_list', $(this), 'selected', 'orderby');
        });

        // 인기순/최신순 (모바일)
        $(".sort_list_mobile li").click(function () {
            click_event('sort_list_mobile', $(this), 'active', 'orderby');

            $('.msort_list span').text($(this)[0]['innerText']);
            $('#listModal').modal('hide');
        });
    });

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
    function click_event(object, element, class_name, column) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        community_list(); // 리스트
    }

    // 커뮤니티 리스트 (ajax)
    function community_list(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.community_list.php",
            data: {orderby : $('#orderby').val(), search : $('#search').val(), op : '<?=$op?>', page : $('#page').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.board_list').html(data);

                    var search = $.trim($('#search').val());
                    // 검색어 있을 시 하이라이트
                    $('.area_board li').highlight(search);
                    $(".left a").highlight(search);

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
        community_list(page);
    }
</script>

<?
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>
