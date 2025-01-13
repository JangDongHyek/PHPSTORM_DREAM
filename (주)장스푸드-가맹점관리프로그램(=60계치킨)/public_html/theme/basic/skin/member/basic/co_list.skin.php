<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<script>
function ca_del(idx){
	if(confirm('정말 삭제하시겠습니까?')){
		location.href = g5_bbs_url + "/co_write_update.php?w=d&idx="+idx;
	}
}
</script>

<div id="bo_l">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<div class="bo_fx">
		<a class="btn_b02" href="<?php echo G5_BBS_URL ?>/co_write.php">등록하기</a>
	</div>

	<table class="me_tbl">
	<thead>
	<tr>
		<th class="list_tbl_th">카테고리명</th>
		<th class="list_tbl_th x220">활성상태</th>
		<th class="list_tbl_th x220">수정/삭제</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM g5_ck_company ORDER BY idx DESC";
	$result = sql_query($sql);

	for ($i = 0; $row = sql_fetch_array($result); $i++) {

		$tr_bg = ($i%2 == 0)? 'tr_bg' : '';
	?>
	<tr>
		<td class="list_tbl_td talign_c <?=$tr_bg?>"><?=$row['co_name']?></td>
		<td class="list_tbl_td talign_c <?=$tr_bg?>"><?=$row['co_use']?></td>
		<td class="list_tbl_td talign_c <?=$tr_bg?>">
			<a style="color:#666; text-decoration:none;" href="<?php echo G5_BBS_URL ?>/co_write.php?w=u&idx=<?=$row['idx']?>">[수정]</a>
			<a style="color:#666; text-decoration:none; margin-left:15px; cursor:pointer;" onclick="ca_del(<?=$row['idx']?>)">[삭제]</a>
		</td>
	</tr>
	<?
	}
	if ($i == 0) {
	?>
	<tr>
		<td colspan="3" class="list_tbl_td talign_c tr_bg">등록된 계육업체가 없습니다.</td>
	</tr>
	<? } ?>
	</tbody>
	</table>
</div>
