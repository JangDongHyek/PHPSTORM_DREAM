<?
include_once('./_common.php');

$g5['title'] = 'Community';
include_once('./_head.php');

$sql_search = " and del_yn is null ";
if(!empty($search)) { // 검색어 입력
    $sql_search .= " and (co_subject like '%{$search}%' or co_contents like '%{$search}%') ";
}
$sql_orderby = " order by co_good desc, wr_datetime "; // 정렬

// 최근 인기글 (좋아요 많은 순, 일주일 기준?)
$sql1 = " select * from g5_community where date_format(wr_datetime, '%Y-%m-%d') > date_add(date_format(now(), '%Y-%m-%d'), INTERVAL -1 WEEK) {$sql_search} {$sql_orderby} limit 7; ";
$result1 = sql_query($sql1);

// 월간 인기글 (좋아요 많은 순)
$sql2 = " select * from g5_community where date_format(wr_datetime, '%Y-%m-%d') > date_add(date_format(now(), '%Y-%m-%d'), INTERVAL -1 MONTH) {$sql_search} {$sql_orderby} limit 7; ";
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
			<h1>PODOSEA Community</h1>
			<span>Communicate with other Podosea members.</span>
			<a href="<?=G5_BBS_URL?>/community_write.php"><span>Create a post</span></a>
		</div>
		<div class="img"><img src="<?php echo G5_IMG_URL ?>/community_obj.png"></div>
	</div>
	<div class="community_cate">
		<div class="inr v3">
			<ul class="list_cate">
                <li><a href="<?php echo G5_BBS_URL ?>/community.php" class="active">All</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab1">Tips</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab2">Casual talk</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab3">Company/on-site stories</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/community_list.php?op=tab4">Maritime industry news</a></li>
			</ul>
			<div class="box_sch">
                <form name="fsearchbox">
                    <input type="text" placeholder="Search" name="search" id="Search" value="<?=$search?>">
                    <input type="hidden" name="page" id="page" value="1">
                    <button type="submit"></button>
                </form>
			</div>
		</div>
	</div>	
	<div class="inr v3">
		<div class="area_top">
			<div class="area_board">
				<h3>Recent most popular</h3>
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
                    <li class="nodata">There are no registered post.</li>
                    <?php
                    }
                    ?>
				</ul>
			</div>
			<div class="area_board">
				<h3>Monthly most popular</h3>
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
                    <li class="nodata">There are no registered post.</li>
                    <?php
                    }
                    ?>
				</ul>
			</div>
		</div>
		<div class="area_bottom">
			<h3>Most popular by forum</h3>
			<div class="tab_container">
				<div class="top_box">
					<ul class="tabs">
						<li class="active" rel="tab1"><span>Tips</span></li>
						<li rel="tab2"><span>Casual talk</span></li>
						<li rel="tab3"><span>Company/on-site stories</span></li>
						<li rel="tab4"><span>Maritime industry news</span></li>
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