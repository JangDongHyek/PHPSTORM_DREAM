<?
include_once('./_common.php');

$g5['title'] = '커뮤니티';
include_once('./_head.php');

$sql_search = " and del_yn is null ";
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

// 23.09.26 CS
$sql_not_search = " and co_category not in ('긴급구인', '회사/현장 이야기') "; // 커뮤니티에서 긴급구인, 회사/현장 이야기 제외

// 최근 인기글 (좋아요 많은 순, 일주일 기준?)
$sql1 = " select * from g5_community where date_format(wr_datetime, '%Y-%m-%d') > date_add(date_format(now(), '%Y-%m-%d'), INTERVAL -1 WEEK) {$sql_search} {$sql_not_search} {$sql_orderby} limit 7; ";
$result1 = sql_query($sql1);

// 월간 인기글 (좋아요 많은 순)
$sql2 = " select * from g5_community where date_format(wr_datetime, '%Y-%m-%d') > date_add(date_format(now(), '%Y-%m-%d'), INTERVAL -1 MONTH) {$sql_search} {$sql_not_search} {$sql_orderby} limit 7; ";
$result2 = sql_query($sql2);
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<?php include_once('./category_modal.php'); ?>

<style>
	#container{padding:0 0 140px;}
    .highlight {color:#275dd7;}
</style>
<div id="area_community">
	<div id="sub_bn">
		<div class="txt">
			<h1><img src="<?php echo G5_IMG_URL ?>/community_txt.png"></h1>
			<span>포도씨 회원님들과 소통해보세요.</span>
			<a href="<?=G5_BBS_URL?>/community_write.php"><span>글쓰기</span></a>
		</div>
		<div class="img"><img src="<?php echo G5_IMG_URL ?>/community_obj.png"></div>
	</div>
	<div class="community_cate">
		<div class="inr v3">
			<ul class="list_cate">
                <li><a href="<?php echo G5_BBS_URL ?>/community.php" class="active">전체</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab1">꿀팁</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab2">일상 이런저런</a></li>
				<!--<li><a href="<?php /*echo G5_BBS_URL */?>/community_list.php?op=tab3">회사/현장 이야기</a></li>-->
				<li><a href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab4">해양뉴스</a></li>
                <!--<li><a href="<?php /*echo G5_BBS_URL */?>/community_list.php?op=tab5">긴급구인</a></li>-->
			</ul>
			<div class="box_sch">
                <form name="fsearchbox">
                    <input type="text" placeholder="검색하기" name="search" id="search" value="<?=$search?>">
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
			<h3>게시판별 인기글</h3>
			<div class="tab_container">
				<div class="top_box">
					<ul class="tabs">
						<li class="active" rel="tab1"><span>꿀팁</span></li>
						<li rel="tab2"><span>일상 이런저런</span></li>
						<!--<li rel="tab3"><span>회사/현장 이야기</span></li>-->
						<li rel="tab4"><span>해양뉴스</span></li>
                        <!--<li rel="tab5"><span>긴급구인</span></li>-->
					</ul>
				</div>
				<div id="tab1" class="tab_content">
					<ul class="board_list"></ul>
				</div>
				<div id="tab2" class="tab_content" style="display: none;">
					<ul class="board_list"></ul>
				</div>
                <div id="tab3" class="tab_content" style="display: none;">
                    <ul class="board_list"></ul>
                </div>
                <div id="tab4" class="tab_content" style="display: none;">
                    <ul class="board_list"></ul>
                </div>
                <div id="tab5" class="tab_content" style="display: none;">
                    <ul class="board_list"></ul>
                </div>

                <div id="paging"></div>
			</div>
		</div>
	</div>
</div>

<script>
	// 게시판별 인기글 탭
    var selectTab = '';
	$(document).ready(function() {
        community_list(); // 리스트

		$(".tab_content").hide();
		$(".tab_content:first").show();

		$("ul.tabs li").click(function () {
			if(!($(this).find('a').length > 0)){
				$("ul.tabs li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide()
				var activeTab = $(this).attr("rel");
				$("#" + activeTab).fadeIn()

                selectTab = activeTab;
				community_list();
			}
		});
	});

    // 커뮤니티 리스트 (ajax)
    function community_list(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.community_list.php",
            data: {search : $('#search').val(), op : selectTab, page : $('#page').val(), gubun : 'main'},
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
