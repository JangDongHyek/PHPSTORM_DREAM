<?
/*******************************************
회원문자발송 - 회원리스트
*******************************************/
include_once('./_common.php');

$sql = "SELECT mb_id, mb_group, mb_name, mb_hp FROM g5_member 
		WHERE mb_level != '10' AND mb_id != 'lets080' and mb_leave_date ='' ";			//lets080제외, 탈퇴회원 제외

if ($member['mb_id'] == "lets080") { 
	$sql = "SELECT mb_id, mb_group, mb_name, mb_hp FROM g5_member WHERE mb_leave_date ='' ";
}

if ((int)$_POST['mb_group'] != 99)	$sql .= " AND mb_group = '{$_POST['mb_group']}' ";
if ($_POST['mb_name'] != "")		$sql .= " AND (mb_name LIKE '%{$_POST['mb_name']}%' OR mb_route LIKE '%{$_POST['mb_name']}%' OR mb_route_input LIKE '%{$_POST['mb_name']}%')";
$sql .= " ORDER BY mb_name ASC; ";

$result = sql_query($sql);
$result_cnt = sql_num_rows($result);


if ($result_cnt == 0) {
?>
<tr><td colspan="5">검색결과가 없습니다.</td></tr>
<?
} else { 
	$num = 1;
	while($row = sql_fetch_array($result)) {
?>
<tr>
	<td>
		<input type="checkbox" name="sms_chkbox[]" value="<?=$num?>">
		<input type="hidden" name="sms_rcv_id[<?=$num?>]" value="<?=$row['mb_id']?>">
		<input type="hidden" name="sms_rcv_hp[<?=$num?>]" value="<?=$row['mb_hp']?>">
	</td>
	<td><?=$num?></td>
	<td><?=$member_group[$row['mb_group']]?></td>
	<td><?=$row['mb_name']?></td>
	<td><?=$row['mb_hp']?></td>
</tr>
<? 
	$num++;
	}
}
?>