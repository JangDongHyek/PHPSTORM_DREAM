<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if($w == 'u'){
	$sql = " select * from g5_write_question_cate where qc_idx='{$qc_idx}' ";
	$row = sql_fetch($sql);

	$mb_sql = " select * from g5_member where mb_id='{$row['qc_mb_id']}' ";
	$mb_row = sql_fetch($mb_sql);
}
?>

<div id="bo_l">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<div id="form_box">
		<form method="post" name="qc_frm" action="<?php echo G5_BBS_URL ?>/qc_write_update.php" onsubmit="return frm_submit(this);" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="qc_idx" value="<?php echo $qc_idx ?>">
			<table class="me_tbl">
			<tbody>
			<tr>
				<th class="me_th" style="width:15%;">카테고리명</th>
				<td class="me_td" style="width:35%;">
					<input type="text" name="qc_ca_name" class="me_text x170" id="qc_ca_name" value="<?php echo $row['qc_ca_name'] ?>">
				</td>
				<th class="me_th" style="width:15%;">활성상태</th>
				<td class="me_td" style="width:35%;">
					<select name="qc_use" id="qc_use">
						<option value="Y" <?php if($row['qc_use'] == 'Y') echo 'selected'; ?>>Y</option>
						<option value="N" <?php if($row['qc_use'] == 'N') echo 'selected'; ?>>N</option>
					</select>
				</td>
			</tr>
			</tbody>
			</table>

			<div class="btn_confirm" style="margin-top:20px;">
				<input type="submit" class="btn_submit" value="<?php echo ($w == '')? '등록하기':'수정하기'; ?>">
			</div>
		</form>
	</div>
</div>

<script>
$(function(){
	$("#sm_btn").on('click', function(){
		window.open('<?php echo G5_BBS_URL ?>/qc_member.php','sm','width=400,height=600,scrollbars=yes');
	});
});


function frm_submit(f)
{
	if(f.qc_ca_name.value == ''){
		alert('카테고리명을 입력해주세요');
		f.qc_ca_name.focus();
		return false;
	}

	return true;
}
</script>

</div>
</div>