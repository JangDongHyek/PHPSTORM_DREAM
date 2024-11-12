<?php
$sub_menu = '400900';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

if ($_POST['w'] == "u") {
	// 신규등록, 수정 체크
	$row = sql_fetch("SELECT COUNT(*) AS cnt FROM g5_shop_item_info WHERE mb_id = '{$member['mb_id']}'");
	$cnt = (int)$row['cnt'];

	$sql_common = "if_desc1 = '{$_POST['if_desc1']}', 
				   if_desc2 = '{$_POST['if_desc2']}'
				   ";

	if ($cnt == 0) {
		$sql = "INSERT INTO g5_shop_item_info SET 
				mb_id = '{$member['mb_id']}',
				{$sql_common}
				";
	} else {
		$sql = "UPDATE g5_shop_item_info SET 
				{$sql_common}
				WHERE mb_id = '{$member['mb_id']}'
				";
	}

	sql_query($sql);
}

// 조회
$row = sql_fetch("SELECT * FROM g5_shop_item_info WHERE mb_id = '{$member['mb_id']}'");


$g5['title'] = '배송/교환 정보등록';
include_once (G5_ADMIN_PATH.'/admin.head.php');

?>
<script>
function frmSubmit(f) {
	return true;
}
</script>

<form name="frm" action="./itemform.info.php" onsubmit="return frmSubmit(this)" method="post">
	<input type="hidden" name="w" value="u">

	<!--<h2 class="h2_frm">쇼핑몰 상세페이지 배송/교환 정보등록</h2>-->
	<div class="local_desc02 local_desc">
		<p>아래 정보를 등록하시면 쇼핑몰 상세페이지의 배송/교환 정보가 공통으로 보여집니다.</p>
	</div>
	<div class="tbl_frm01 tbl_wrap">
		<table>
		<colgroup>
			<col class="grid_4">
			<col>
		</colgroup>
		<tbody>
		<tr>
			<th scope="row"><label for="if_desc1">배송 안내</label></th>
			<td><textarea name="if_desc1" id="if_desc1" style="height: 250px;"><?=$row['if_desc1']?></textarea></td>
		</tr>
		<tr>
			<th scope="row"><label for="if_desc2">교환/반품 안내</label></th>
			<td><textarea name="if_desc2" id="if_desc2" style="height: 250px;"><?=$row['if_desc2']?></textarea></td>
		</tr>
		</tbody>
		</table>
	</div>

	<div class="btn_fixed_top">
		<input type="submit" class="btn btn_01" value="등록완료">
	</div>

</form>

<?
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
