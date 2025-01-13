<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div id="bo_l">

<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
	<!--
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
	-->
    <!-- } 게시판 카테고리 끝 -->

	<div id="search_box">
		<!-- 게시판 검색 시작 { -->
		<form name="fsearch" id="fsearch" method="get">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sop" value="and">
		<label for="sfl" class="sound_only">검색대상</label>
		<select name="sfl" id="sfl" class="search_text">
			<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
			<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
			<option value="ic_ca_name"<?php echo get_selected($sfl, 'ic_ca_name'); ?>>분류</option>
			<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
		</select>
		<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class="search_text" size="15" maxlength="20" placeholder="검색어">
		<?php if($member['mb_level'] >= 3){ ?>
		<input type="text" name="sch_wr_1" value="<?php echo $sch_wr_1 ?>" id="sch_wr_1" class="search_text" size="15" maxlength="20" placeholder="매장명">
		<?php } ?>
        <input type="hidden" name="reply_st_date" id="reply_st_date" value="<?php echo $_REQUEST['reply_st_date']?>"> <!-- 21.02.25 미답변 글 조회 -->
        <input type="hidden" name="reply_ed_date" id="reply_ed_date" value="<?php echo $_REQUEST['reply_ed_date']?>"> <!-- 21.02.25 미답변 글 조회 -->
        <input type="hidden" name="reply_option" id="reply_option" value="<?php echo $_REQUEST['reply_option']?>"> <!-- 21.02.25 미답변 글 조회 -->
		<input type="submit" value="검색" class="btn_submit">
		</form>
		<!-- } 게시판 검색 끝 -->

		<? if ($member['mb_level'] > 2) { ?>
        <!-- 21.02.28 1:1 문의 미답변 통계 추가 -->
        <div style="float:right;;position: relative;bottom: 33px;">
            <table>
                <tr>
                    <td style="font-weight: bold;">미답변통계</td>
                    <td style="font-weight: bold; width: 20px;"></td>
                    <td style="font-weight: bold;">이번주 : <br>지난주 : </td>
                    <td style="font-weight: bold; width: 10px;"></td>
                    <td style="font-weight: bold;"><span id="this_week" style="color: red; cursor:pointer;" onclick="reply_chk('this');"><?=$this_no_reply_count?></span> / <?=$this_total['count']?><br><span id="pre_week" style="color: red; cursor:pointer;" onclick="reply_chk('last');"><?=$last_no_reply_count?></span> / <?=$last_total['count']?></td> <!-- 미답변 숫자 / 전체 게시글 숫자 -->
                </tr>
            </table>
        </div>
		<? } ?>

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
            <?php if ($write_href && $member['mb_level'] == 2) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
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

    
	<table class="list_tbl">
	<thead>
	<tr>
		<!--<th class="list_tbl_th">번호</th>-->
		<th class="list_tbl_th">문의번호</th>
		<?php if ($is_checkbox) { ?>
		<th class="list_tbl_th">
			<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
            <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
		</th>
		<?php } ?>
		<?php if ($is_category) { ?>
		<th class="list_tbl_th">분류</th>
		<?php } ?>
		<th class="list_tbl_th">제목</th>
		<th class="list_tbl_th">매장명</th>
		<th class="list_tbl_th">작성일</th>
		<th class="list_tbl_th">답변자</th>
		<th class="list_tbl_th">답변일</th>
	</tr>
	</thead>
	<tbody>
	<?php
	for ($i=0; $i<count($list); $i++) {
		if($i%2 == 0) $tr_bg = 'tr_bg';
		else $tr_bg = '';
	?>
	<tr>
		<!--
		<td class="list_tbl_td x70 talign_c <?php echo $tr_bg ?>">
			<?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
            ?>
		</td>
		-->
		<td class="list_tbl_td x70 talign_c <?php echo $tr_bg ?>">
			<?php echo $list[$i]['wr_id'] ?>
		</td>
		<?php if ($is_checkbox) { ?>
		<td class="list_tbl_td x40 talign_c <?php echo $tr_bg ?>">
			<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
		</td>
		<?php } ?>
		<?php if ($is_category && $list[$i]['ca_name']) { ?>
		<td class="list_tbl_td x180 talign_c <?php echo $tr_bg ?>">
			<?php
			$ic_sql = " select * from g5_write_inquiry_cate where ic_idx='{$list[$i]['ca_name']}' ";
			$ic_row = sql_fetch($ic_sql);
			?>
			<?php echo $ic_row['ic_ca_name'] ?>
		</td>
		<?php } ?>
		<td class="list_tbl_td <?php echo $tr_bg ?>">
			<div style="padding-left:15px; padding-right:15px;">
				<a href="<?php echo $list[$i]['href'] ?>">
					<?php echo $list[$i]['subject'] ?>
					<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
				</a>

				<?php
				if (isset($list[$i]['icon_new'])) echo '&nbsp;'.$list[$i]['icon_new'];
				if (isset($list[$i]['icon_file'])) echo '&nbsp;'.$list[$i]['icon_file'];
				?>
			</div>
		</td>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>">
			<?php
			$list_mb = null;
			$list_mb = get_member($list[$i]['mb_id']);
			if($list[$i][wr_1]==""){
				$sql="update g5_write_inquiry set wr_1='$list_mb[mb_2]' where wr_id='".$list[$i][wr_id]."'";
				sql_query($sql);
			}
			if($list_mb['mb_2'] != '') echo $list_mb['mb_2'];
			?>
		</td>
		<td class="list_tbl_td x100 talign_c <?php echo $tr_bg ?>">
			<?php
			$datetime_arr = explode(' ', $list[$i]['wr_datetime']);
			$sub_datetime = $datetime_arr[0];
			?>
		<?php echo $sub_datetime ?>
		</td>
		<?php
		$re_sql = " select * from {$write_table} where wr_num='{$list[$i]['wr_num']}' and wr_reply!='' order by wr_num, wr_reply limit 1 ";
		$re_row = sql_fetch($re_sql);
		?>
		<td class="list_tbl_td x90 talign_c <?php echo $tr_bg ?>">
		<?php
		if(!$re_row['wr_name']){
			$re_mem = get_member($re_row['mb_id']);
			echo $re_mem['mb_name'];
			$up_sql = " update g5_write_{$bo_table} set wr_name='{$re_mem['mb_name']}' where wr_num='{$list[$i]['wr_num']}' and wr_reply='A' ";
			sql_query($up_sql);
		}else{
			echo $re_row['wr_name'];
		}
		?>
		</td>
		<td class="list_tbl_td x100 talign_c <?php echo $tr_bg ?>">
		<?php
		if($re_row['wr_id'] != ''){
			$redatetime_arr = explode(' ', $re_row['wr_datetime']);
			$re_datetime = $redatetime_arr[0];
			echo $re_datetime;
		}else{
			echo '<span style="color:#ff0000;">미답변</span>';
		}
		?>
		</td>
	</tr>
	<?php
	}

	if (count($list) == 0) {
	?>
	<tr>
		<td colspan="8" class="list_tbl_td talign_c">등록된 게시물이 없습니다.</td>
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
            <?php if ($write_href && $member['mb_level'] == 2) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
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

<script>
    // 21.02.25 미답변 글만 조회
    function reply_chk(op) {
        if(op == 'this') {
            $('#reply_st_date').val('<?=$term['this_monday']?>');
            $('#reply_ed_date').val('<?=$term['this_sunday']?>');
            $('#reply_option').val(op);
        } else {
            $('#reply_st_date').val('<?=$term['last_monday']?>');
            $('#reply_ed_date').val('<?=$term['last_sunday']?>');
            $('#reply_option').val(op);
        }

        $('#fsearch').submit();
    }
</script>


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
