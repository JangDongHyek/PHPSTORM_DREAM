<?php
$sub_menu = "200300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '회원문자목록 상세';
include_once(G5_PATH.'/head.sub.php');

// 리스트
$sql = "SELECT sms_rcv_id, sms_rcv_hp FROM g5_sms WHERE idx = '{$idx}'";
$row = sql_fetch($sql);

$mb_id = explode(",", $row['sms_rcv_id']);
$mb_hp = explode(",", $row['sms_rcv_hp']);
?>
<style>
.tbl_head01 tbody tr {background: #FFF;}
</style>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>회원목록</caption>
	<colgroup>
	<col width="10%">
	</colgroup>
	<thead>
	<tr>
		<th>No.</th>
		<th>아이디</th>
		<th>휴대폰번호</th>
		<!--<th>성공여부</th>-->
	</tr>
	</thead>
	<tbody>
	<? if (count($mb_id) == 0) { ?>
	<tr><td colspan='4'>내역이 없습니다.</td></tr>
	<?
	} else {
		foreach ($mb_id as $key=>$id) {
	?>
	<tr>
		<td><?=$key+1?></td>
		<td><?=$id?></td>
		<td><?=$id?></td>
		<!--<td><?/*=$mb_hp[$key]*/?></td>-->
		<!--<td></td>-->
	</tr>
	<?
		}
	}
	?>
	</tbody>
	</table>
</div>