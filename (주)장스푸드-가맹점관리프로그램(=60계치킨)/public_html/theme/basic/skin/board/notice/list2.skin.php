<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div id="bo_l">

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

	<table class="list_tbl">
	<thead>
	<tr>
		<th class="list_tbl_th">번호</th>
		<th class="list_tbl_th">제목</th>
		<th class="list_tbl_th">작성일</th>
		<th class="list_tbl_th">조회수</th>
		<th class="list_tbl_th">작성자</th>
	</tr>
	</thead>
	<tbody>
	<?php
	for ($i=0; $i<count($list); $i++) {
		if($i%2 == 0) $tr_bg = 'tr_bg';
		else $tr_bg = '';
	?>
	<tr>
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
		<td class="list_tbl_td <?php echo $tr_bg ?>">
			<div style="padding-left:15px; padding-right:15px;">
				<?php
				echo $list[$i]['icon_reply'];
				if ($is_category && $list[$i]['ca_name']) {
				 ?>
				<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
				<?php } ?>

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
		<td class="list_tbl_td x110 talign_c <?php echo $tr_bg ?>">
			<?php
			$datetime_arr = explode(' ', $list[$i]['wr_datetime']);
			$sub_datetime = $datetime_arr[0];
			?>
		<?php echo $sub_datetime ?>
		</td>
		<td class="list_tbl_td x80 talign_c <?php echo $tr_bg ?>"><?php echo $list[$i]['wr_hit'] ?></td>
		<td class="list_tbl_td x100 talign_c <?php echo $tr_bg ?>"><?php echo $list[$i]['name'] ?></td>
	</tr>
	<?php
	}

	if (count($list) == 0) {
	?>
	<tr>
		<td colspan="6" class="list_tbl_td talign_c">등록된 게시물이 없습니다.</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
</div>

</div>

<!-- 페이지 -->
<?php echo $write_pages;  ?>
<!-- } 게시판 목록 끝 -->
