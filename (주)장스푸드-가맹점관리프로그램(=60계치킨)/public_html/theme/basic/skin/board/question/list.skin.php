<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 3;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div id="bo_l">

<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <li>
				<a <?php if(!$sca) echo 'id="bo_cate_on"'; ?> href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>">전체</a>
			</li>
			<?php
			$qc_sql = " select * from g5_write_question_cate where qc_bo_table='{$bo_table}' and qc_use='y' order by qc_idx ";
			$qc_qry = sql_query($qc_sql);
			$qc_num = sql_num_rows($qc_qry);
			if($qc_num > 0){
				for($qc=0; $qc<$qc_num; $qc++){
					$qc_row = sql_fetch_array($qc_qry);
			?>
			<li>
				<a <?php if($sca == $qc_row['qc_idx']) echo 'id="bo_cate_on"'; ?> href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>&sca=<?php echo urlencode($qc_row['qc_idx']) ?>"><?php echo $qc_row['qc_ca_name'] ?></a>
			</li>
			<?php
				}
			}
			?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

	<div id="search_box">
		<!-- 게시판 검색 시작 { -->
		<form name="fsearch" method="get">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sop" value="and">
		<label for="sfl" class="sound_only">검색대상</label>
		<select name="sfl" id="sfl">
			<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
			<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
			<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
		</select>
		<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="search_text required" size="15" maxlength="20">
		<input type="submit" value="검색" class="btn_submit">
		</form>
		<!-- } 게시판 검색 끝 -->
	</div>

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($admin_href) { ?><!--<li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li>--><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    
	<table class="list_tbl" style="table-layout:fixed;">
	<thead>
	<tr>
		<th class="list_tbl_th x90">번호</th>
		<?php if ($is_checkbox) { ?>
		<th class="list_tbl_th x40">
			<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
            <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
		</th>
		<?php } ?>
		<?php if ($is_category) { ?>
		<th class="list_tbl_th x140">분류</th>
		<?php } ?>
		<th class="list_tbl_th">제목</th>
		<!--<th class="list_tbl_th">조회수</th>-->
	</tr>
	</thead>
	<tbody>
	<?php
	for ($i=0; $i<count($list); $i++) {
		if($i%2 == 0) $tr_bg = 'tr_bg';
		else $tr_bg = '';
	?>
	<tr class="list_tr">
		<td class="list_tbl_td talign_c tr_bg">
			<?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
            ?>
		</td>
		<?php if ($is_checkbox) { ?>
		<td class="list_tbl_td talign_c tr_bg">
			<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
		</td>
		<?php } ?>
		<?php if ($is_category && $list[$i]['ca_name']) { ?>
		<td class="list_tbl_td talign_c tr_bg">
			<?php
			$qc_sql = " select * from g5_write_question_cate where qc_idx='{$list[$i]['ca_name']}' ";
			$qc_row = sql_fetch($qc_sql);
			?>
			<?php echo $qc_row['qc_ca_name'] ?>
		</td>
		<?php } ?>
		<td class="list_tbl_td tr_bg" style="cursor:pointer;">
			<div style="padding-left:15px; padding-right:15px;" style="cursor:pointer;">
				<?php if($is_admin){ ?>
				<a href="<?php echo $list[$i]['href'] ?>">
					<?php echo $list[$i]['subject'] ?>
					<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
				</a>
				<?php }else{ ?>
					<?php echo $list[$i]['subject'] ?>
					<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
				<?php } ?>

				<?php
				if (isset($list[$i]['icon_new'])) echo '&nbsp;'.$list[$i]['icon_new'];
				if (isset($list[$i]['icon_file'])) echo '&nbsp;'.$list[$i]['icon_file'];
				?>
			</div>
		</td>
		<!--<td class="list_tbl_td x80 talign_c tr_bg"><?php echo $list[$i]['wr_hit'] ?></td>-->
	</tr>
	<tr>
		<td colspan="<?php echo $colspan ?>" class="td_content">
			<?php echo $list[$i]['wr_content'] ?>
			<?php
			if($list[$i]['file']['count'] > 0){
				for ($k=0; $k<count($list[$i]['file']['count']); $k++) {
					if (isset($list[$i]['file'][$k]['source']) && $list[$i]['file'][$k]['source']) {
						echo '<div><label class="list_down_btn">다운로드</label>';
						echo '<a href="'.$list[$i]['file'][$k]['href'].'">';
						echo $list[$i]['file'][$k]['source'].'</a>';
						echo ' ('.$list[$i]['file'][$k]['size'].')';
						echo '</div>';
					}
				}
			}
			?>
		</td>
	</tr>
	<?php
	}

	if (count($list) == 0) {
	?>
	<tr>
		<td colspan="<?php echo $colspan ?>" class="list_tbl_td talign_c">등록된 게시물이 없습니다.</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <!--
			<li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
			-->
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>


<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->

<script>
$(function(){
	$('.list_tr').click(function(){
		var _idx = $('.list_tr').index(this);

		if($('.td_content').eq(_idx).css('display') == 'none'){
			$('.td_content').css('display','none');
			$('.td_content').eq(_idx).css('display','table-cell');
		}else{
			$('.td_content').eq(_idx).css('display','none');
		}
	});
});
</script>