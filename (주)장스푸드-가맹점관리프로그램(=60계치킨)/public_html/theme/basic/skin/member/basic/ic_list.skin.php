<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<script>
function ic_del(ic_idx){
	if(confirm('정말 삭제하시겠습니까?')){
		location.href = "<?php echo G5_BBS_URL ?>/ic_del.php?ic_idx="+ic_idx;
	}
}
</script>

<div id="bo_l">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<div class="bo_fx">
		<a class="btn_b02" href="<?php echo G5_BBS_URL ?>/ic_write.php">등록하기</a>
	</div>

	<table class="me_tbl">
	<thead>
	<tr>
		<th class="list_tbl_th x300">카테고리명</th>
		<th class="list_tbl_th x260">담당자</th>
		<th class="list_tbl_th x220">활성상태</th>
		<th class="list_tbl_th">수정/삭제</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$ic_sql = " select * from g5_write_inquiry_cate order by ic_idx desc ";
	$ic_qry = sql_query($ic_sql);
	$ic_num = sql_num_rows($ic_qry);
	if($ic_num > 0){
		for($i=0; $i<$ic_num; $i++){
			$ic_row = sql_fetch_array($ic_qry);

			$tr_bg = '';
			if($i%2 == 0) $tr_bg = 'tr_bg';

			$mb_sql = " select mb_name from g5_member where mb_id='{$ic_row['ic_mb_id']}' ";
			$mb_row = sql_fetch($mb_sql);
	?>
	<tr>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>"><?php echo $ic_row['ic_ca_name'] ?></td>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>"><?php echo $mb_row['mb_name'] ?></td>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>"><?php echo $ic_row['ic_use'] ?></td>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>">
			<a style="color:#666; text-decoration:none;" href="<?php echo G5_BBS_URL ?>/ic_write.php?w=u&ic_idx=<?php echo $ic_row['ic_idx'] ?>">[수정]</a>
			<a style="color:#666; text-decoration:none; margin-left:15px; cursor:pointer;" onclick="ic_del(<?php echo $ic_row['ic_idx'] ?>)">[삭제]</a>
		</td>
	</tr>
	<?php
		}
	}
	?>
	</tbody>
	</table>
</div>
