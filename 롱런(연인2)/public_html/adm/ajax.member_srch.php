<?
/**********************************
회원검색 - 환불요청, 쿠폰발급요청 게시판
**********************************/
include_once('./_common.php');
if ($member['mb_level'] != "10") exit;


$sql = "SELECT mb_no, mb_id, mb_name, mb_sex, mb_birth, mb_hp, mb_si, mb_gu FROM g5_member
		WHERE mb_name LIKE '%{$_POST['mb_name']}%' AND mb_level < 10 ORDER BY mb_name ASC; ";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

/*
for ($i = 0; $row = sql_fetch_array($result); $i++) { // 
	echo $row["wr_id"];
}
*/
?>
<style>
div.result_empty {padding: 15px 0;}
.result {margin: 10px 0; width: 70%;}
.result th {padding: 5px; background: #ececec; text-align: center;}
.result td {padding: 5px; text-align: center;}
</style>

<? if ($result_cnt == 0) { ?>
<div class="result_empty">검색결과가 없습니다.</div>

<? } else { ?>
<table class="result">
<tr>
	<th>이름</th>
	<th>아이디</th>
	<th>성별</th>
	<th>나이</th>
	<th>연락처</th>
	<th>지역</th>
	<th>지역상세</th>
	<th>선택</th>
<?
	while($row = sql_fetch_array($result)) {
		$mb_age = (date("Y")+1) - substr($row['mb_birth'], 0, 4);
?>
<tr>
	<td><?=$row['mb_name']?></td>
	<td><?=$row['mb_id']?></td>
	<td><?=$row['mb_sex']?></td>
	<td><?=$mb_age?></td>
	<td><?=$row['mb_hp']?></td>
	<td><?=$row['mb_si']?></td>
	<td><?=$row['mb_gu']?></td>
	<td><button type="button" class="btn01" onclick="setMember('<?=$row['mb_name']?>', '<?=$row['mb_no']?>');">선택</button></td>
</tr>
<?	} // end while ?>
</table>
<? } // end if ?>