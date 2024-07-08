<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '특이사항';
include_once(G5_PATH.'/head.sub.php');


// 메모 저장
if ($_POST['w'] == "u") {
	$sql = "UPDATE g5_member SET mb_memo = '{$_POST['mb_memo']}' WHERE mb_id = '{$mb_id}'";
	sql_query($sql);
}



$row = sql_fetch(" SELECT mb_name, mb_birth, mb_sex, mb_hp, mb_si, mb_gu, mb_memo FROM g5_member WHERE mb_id = '{$mb_id}' ");
if (!$row) {
	echo "<script>alert('회원정보를 불러오는데 실패하였습니다. 다시 시도해 주세요.'); window.close();</script>";
	exit;
}

// 회원정보
$mb_name = $row['mb_name'];
$mb_birth = $row['mb_birth'];
$mb_sex = $row['mb_sex'];
$mb_hp = $row['mb_hp'];
$mb_si = $row['mb_si'];
$mb_gu = $row['mb_gu'];
$mb_age = (date("Y")+1) - substr($mb_birth, 0, 4);

$mb_memo = $row['mb_memo'];

?>

<div id="popup_wrap" class="match">
	<p>특이사항</p>
	<form name="fPopup" action="./member_memo.php?mb_id=<?=$mb_id?>" method="post">
		<input type="hidden" name="mb_id" value="<?=$mb_id?>">
		<input type="hidden" name="w" value="u">

		<div class="tbl_head02 tbl_wrap">
			<!-- 회원정보 -->
			<? include_once("./member_info_pop.php"); ?>
			<!-- //회원정보 -->

			<br>
			<!-- 특이사항 -->
			<table>
			<caption>특이사항</caption>
			<colgroup>
				<col width="5%">
				<col width="15%">
				<col width="15%">
				<col width="10%">
				<col width="10%">
				<col width="12%">
				<col width="">
				<col width="15%">
			</colgroup>
			<thead>
			<tr>
				<th>특이사항</th>
			</tr>
			</thead>
			<tbody>
				<td align="center"><textarea name="mb_memo" class="memo" style="width:635px"><?=$mb_memo?></textarea></td>
			</tbody>
			</table>

			<br>
			<div class="btn_confirm01 btn_confirm">
				<input type="submit" value="저장" class="btn_submit">
				<a href="javascript:void(0);" onclick="getWinClose();">닫기</a>
			</div>
		</div>
	</form>
</div>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>