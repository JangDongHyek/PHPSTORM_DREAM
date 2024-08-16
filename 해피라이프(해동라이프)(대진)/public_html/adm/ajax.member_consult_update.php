<?
/*******************************************
회원상세 - 상담내역 등록/수정, 삭제, 폼로드
*******************************************/
include_once('./_common.php');

$mode = $_POST['mode'];


if ($mode == 'update') {						
	// 1) 등록/수정
	$sql_common = "cs_date = '{$cs_date}',
				   cs_memo = '{$cs_memo}',
				   cs_name = '{$cs_name}'
				  ";

	if ($idx == "") {
		$sql = "INSERT INTO g5_consult SET mb_id = '{$mb_id}', ";
		$sql .= $sql_common;

	} else {
		$sql = "UPDATE g5_consult SET ";
		$sql .= $sql_common;
		$sql .= " WHERE idx = '{$idx}'";
	}

	echo (sql_query($sql))? "T" : "F";
	exit;

} else if ($mode == 'delete') {	
	// 2) 삭제
	$sql = "DELETE FROM g5_consult WHERE idx = '{$idx}' ";
	echo (sql_query($sql))? "T" : "F";
	exit;

} else if ($mode == 'load') {					
	// 3) 폼 로드
	$row = '';

	if ($idx != '') {
		$row = sql_fetch("SELECT * FROM g5_consult WHERE idx = '{$idx}' AND mb_id = '{$mb_id}'");
	} else {
		$row['cs_date'] = date('Y-m-d');
		$row['cs_name'] = $member['mb_name'];
	}
?>

<form id="frm">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<input type="hidden" name="mb_id" value="<?=$mb_id?>">

	<table class="tbl_frm01">
	<colgroup>
		<col width="20%">
		<col width="80%">
	</colgroup>
	<tbody>
	<tr>
		<th scope="row">상담일자</th>
		<td><input type="text" name="cs_date" class="frm_input f_date" placeholder="<?=date('Y-m-d')?>" value="<?=$row['cs_date']?>"></td>
	</tr>
	<tr>
		<th scope="row">상담내용</th>
		<td><textarea name="cs_memo" style="height:200px;"><?=$row['cs_memo']?></textarea></td>
	</tr>
	<tr>
		<th scope="row">작성자</th>
		<td><input type="text" name="cs_name" class="frm_input" value="<?=$row['cs_name']?>"></td>
	</tr>
	</tbody>
	</table>
</form>

<script>
$(function() {
	$('input.f_date').on("keyup", function(){
		var num = $(this).val().replace(/[^\d]+/g, '').replace(/^0+/, '');
		if (num.length < 5) {
			num = num.substr(0,4);
		} else if (num.length < 7) {
			num = num.substr(0,4) + "-" + num.substr(4,2);
		} else {
			num = num.substr(0,4) + "-" + num.substr(4,2) + "-" + num.substr(6,2);
		}
		$(this).val(num);
	});
});
</script>

<?
}
?>