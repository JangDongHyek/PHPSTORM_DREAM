<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if($w == 'u'){
	$sql = " select * from g5_write_inquiry_cate where ic_idx='{$ic_idx}' ";
	$row = sql_fetch($sql);

	$mb_sql = " select * from g5_member where mb_id='{$row['ic_mb_id']}' ";
	$mb_row = sql_fetch($mb_sql);
}
?>

<div id="bo_l">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<div id="form_box">
		<form method="post" name="ic_frm" action="<?php echo G5_BBS_URL ?>/ic_write_update.php" onsubmit="return frm_submit(this);" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="ic_idx" value="<?php echo $ic_idx ?>">
			<table class="me_tbl">
			<tbody>
			<tr>
				<th class="me_th" style="width:15%;">카테고리명</th>
				<td class="me_td" style="width:35%;">
					<input type="text" name="ic_ca_name" class="me_text x170" id="ic_ca_name" value="<?php echo $row['ic_ca_name'] ?>">
				</td>
				<th class="me_th" style="width:15%;">활성상태</th>
				<td class="me_td" style="width:35%;">
					<select name="ic_use" id="ic_use">
						<option value="Y" <?php if($row['ic_use'] == 'Y') echo 'selected'; ?>>Y</option>
						<option value="N" <?php if($row['ic_use'] == 'N') echo 'selected'; ?>>N</option>
					</select>
				</td>
			</tr>
			<tr>
				<th class="me_th">담당자명</th>
				<td class="me_td" colspan="3">
					<input type="hidden" name="ic_mb_id" id="ic_mb_id" value="<?php echo $row['ic_mb_id'] ?>">
					<span id="ic_span"><?php echo $row['ic_mb_id'] ?> [담당자명 : <?php echo $mb_row['mb_name'] ?>]</span>
					<a id="sm_btn">검색하기</a>
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
		window.open('<?php echo G5_BBS_URL ?>/ic_member.php','sm','width=400,height=600,scrollbars=yes');
	});
});


function frm_submit(f)
{
	if(f.ic_ca_name.value == ''){
		alert('카테고리명을 입력해주세요');
		f.ic_ca_name.focus();
		return false;
	}

	if(f.ic_mb_id.value == ''){
		alert('담당자명을 검색/선택해주세요');
		return false;
	}

	return true;
}
</script>

</div>
</div>