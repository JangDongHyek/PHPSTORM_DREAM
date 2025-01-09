<div style="float:left;width:100px;position:relative; margin:0; padding:0px 0px 10px 0px;">
	<div><a style="position:relative; margin:0px; padding:2px 8px; height:28px; line-height:28px; background-color:#eb4b3e; color:#fff; border:1px solid #eb4b3e;" href="<?php echo $board_skin_url; ?>/excel.down.php?b_wr_id=<?php echo $b_wr_id; ?>">엑셀 다운로드</a></div>
</div>

<?php
if($identify_del == 'ok'){
	$sql = " DELETE FROM `g5_write_counsel_book` WHERE b_idx = '".$b_idx."' ";
	if(sql_query($sql)){
		$sql = "UPDATE `g5_write_counsel` SET wr_10 = '예약가능' where wr_id = '".$b_wr_id."' ";
		sql_query($sql);
		echo "<script>
		alert('상담 예약이 취소되었습니다.');			
		</script>";
	}else{
		echo "<script>
		alert('상담 예약 취소에 실패하였습니다.');
		</script>";
	}
}

$sql = " SELECT * FROM `g5_write_counsel_book` WHERE b_wr_id='{$b_wr_id}' ORDER BY b_idx DESC ";
$result = sql_query($sql);
$numb = sql_num_rows($result);

$sql2 = " SELECT * FROM `g5_write_counsel` WHERE wr_id='{$b_wr_id}' LIMIT 1 ";
$result2 = sql_query($sql2);
$row2 = sql_fetch_array($result2);

$wr_6 = $row2['wr_6'];
$wr_7 = $row2['wr_7'];
$wr_8 = $row2['wr_8'];
$wr_9 = $row2['wr_9'];

if($wr_6 < 10) $wr_6 = '0'.$wr_6;
if($wr_7 < 10) $wr_7 = '0'.$wr_7;
if($wr_8 < 10) $wr_8 = '0'.$wr_8;
if($wr_9 < 10) $wr_9 = '0'.$wr_9;

if($numb <= 0){
?>
<div style="margin:0; padding:30px 0px; text-align:center;">해당 정보에는 예약된 상담이 없습니다.</div>
<?php
}else{
	for($i=0; $i<$numb; $i++){
		$row = sql_fetch_array($result);
?>
<form method="post" name="book_form" action="./board.php?bo_table=<?php echo $bo_table; ?>&mode=identify_adm" onsubmit="return fwrite_submit(this);">
		<input type="hidden" name="identify_del" value="ok" />
		<input type="hidden" name="b_idx" value="<?=$row['b_idx']?>" />
		<input type="hidden" name="b_wr_id" value="<?=$row2['wr_id']?>" />
		<input type="hidden" name="b_name" value="<?=$row['b_name']?>" />
		<input type="hidden" name="b_tel" value="<?=$row['b_tel']?>" />

		<div style="margin:0; padding-bottom:15px;">
		<input type="submit" style="cursor:pointer; float:right; padding:4px 8px; background-color:#eb4b3e; color:#fff; border:1px solid #eb4b3e;" value="예약취소" />
</form>

<div style="margin:0; padding-bottom:15px;">
	<table style="margin:0 auto; padding:0px 0px; width:100%; border-collapse:collapse;">
	<tbody>
	<tr>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>프로그램명</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row2['wr_subject']; ?></td>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>예약날짜</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;">
		<?php echo $row2['wr_5'].'&nbsp;&nbsp;'.$wr_6.':'.$wr_7.'&nbsp;~&nbsp;'.$wr_8.':'.$wr_9; ?>
		</td>
	</tr>
	<tr>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>예약자명</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_name']; ?></td>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>대상</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row2['wr_content']; ?></td>
	</tr>
	<tr>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>학교</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_school']; ?></td>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>학년</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php if($row['b_class'] != '') echo $row['b_class'].'학년'; ?></td>
	</tr>
	<tr>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>휴대폰번호</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_tel']; ?></td>
		<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>이메일</label></th>
		<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_email']; ?></td>
	</tr>
	<tr>
				<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>학부모성함</label></th>
				<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_parent_name']; ?></td>
				<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>학부모연락처</label></th>
				<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_parent_tel']; ?></td>
			</tr>
			<tr>
				<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>상담요청</label></th>
				<td colspan="3" style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo nl2br($row['b_request']); ?></td>
			</tr>
	</tbody>
	</table>
</div>
<?php
	}
}
?>

<script>
function fwrite_submit(f)
{
	if(!confirm("예약취소 하시겠습니까?")) {
		return false;
	}

	return true;
}
</script>