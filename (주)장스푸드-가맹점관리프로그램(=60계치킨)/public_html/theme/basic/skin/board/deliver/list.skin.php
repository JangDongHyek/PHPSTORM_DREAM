<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

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

    <div style="margin:30px 0px 0px 0px;">※ 최대 10개까지 등록가능 합니다</div>

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
			<?php
			$check_sql = " select count(*) as cnt from {$write_table} where mb_id='{$member['mb_id']}' ";
			$check_row = sql_fetch($check_sql);
			if($check_row['cnt'] < 10){
			?>
				<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">신규등록</a></li><?php } ?>
			<?php
			}
			?>
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
		<th class="list_tbl_th">관리</th>
		<th class="list_tbl_th">배송지명</th>
		<th class="list_tbl_th">수령인</th>
		<th class="list_tbl_th">전화번호</th>
		<th class="list_tbl_th">휴대폰번호</th>
		<th class="list_tbl_th">주소</th>
	</tr>
	</thead>
	<tbody>
	<?php
	for ($i=0; $i<count($list); $i++) {
		if($i%2 == 0) $tr_bg = 'tr_bg';
		else $tr_bg = '';
	?>
	<tr>
		<td class="list_tbl_td talign_c x120 <?php echo $tr_bg ?>">
			<a class="btn_b01" href="./write.php?w=u&bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $list[$i]['wr_id'] ?>">수정</a>
			<a class="btn_b01" onclick="del(this.href); return false;" href="./delete.php?bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $list[$i]['wr_id'] ?>&page=<?php echo $page ?>">삭제</a>
		</td>
		<td class="list_tbl_td talign_c x90 <?php echo $tr_bg ?>"><?php echo $list[$i]['wr_subject'] ?></td>
		<td class="list_tbl_td talign_c x80 <?php echo $tr_bg ?>"><?php echo $list[$i]['wr_7'] ?></td>
		<td class="list_tbl_td talign_c x120 <?php echo $tr_bg ?>"><?php echo $list[$i]['wr_1'] ?></td>
		<td class="list_tbl_td talign_c x120 <?php echo $tr_bg ?>"><?php echo $list[$i]['wr_2'] ?></td>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>">
			<?php
			if($list[$i]['wr_4'] != '') echo $list[$i]['wr_4'].' ';
			if($list[$i]['wr_5'] != '') echo $list[$i]['wr_5'];
			?>
		</td>
	</tr>
	<?php
	}

	if (count($list) == 0) {
	?>
	<tr>
		<td colspan="6" class="list_tbl_td talign_c">등록된 배송정보가 없습니다.</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>

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
<!-- } 게시판 목록 끝 -->
