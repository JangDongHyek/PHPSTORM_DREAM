<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);


if($w == 'u'){
	$sql = "SELECT * FROM g5_ck_company WHERE idx = '{$idx}'";
	$row = sql_fetch($sql);
}
?>

<div id="bo_l">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<div id="form_box">
		<form method="post" name="frm" action="<?php echo G5_BBS_URL ?>/co_write_update.php" onsubmit="return frm_submit(this);" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="idx" value="<?php echo $idx ?>">
			<table class="me_tbl">
			<tbody>
			<tr>
				<th class="me_th" style="width:15%;">카테고리명</th>
				<td class="me_td" style="width:35%;">
					<input type="text" name="co_name" class="me_text x170" id="co_name" value="<?php echo $row['co_name'] ?>" required>
				</td>
				<th class="me_th" style="width:15%;">활성상태</th>
				<td class="me_td" style="width:35%;">
					<select name="co_use" id="co_use">
						<option value="Y" <?php if($row['co_use'] == 'Y') echo 'selected'; ?>>Y</option>
						<option value="N" <?php if($row['co_use'] == 'N') echo 'selected'; ?>>N</option>
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
	if(f.co_name.value == ''){
		alert('카테고리명을 입력해주세요');
		f.co_name.focus();
		return false;
	}

	return true;
}
</script>

</div>
</div>