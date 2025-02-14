<?php
include_once('./_common.php');

$sql = " select * from g5_member where mb_id like '%{$id}%' order by mb_no desc limit 10 ";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);
?>
<table style="text-align: center;">
<thead>
<tr>
	<th>아이디</th>
    <th>닉네임</th>
	<th>선택</th>
</tr>
</thead>
<tbody>
<? if ((int)$result_cnt == 0) { ?>
<tr><td colspan="3">검색결과가 없습니다.</td></tr>
<? 
} else {
	for($i=0; $row = sql_fetch_array($result); $i++) {
?>
<tr>
	<td><?=$row['mb_id']?></td>
    <td><?=$row['mb_nick']?></td>
	<td><button type="button" class="btn_frmline" onclick="select_id('<?=$row['mb_id']?>');">선택</button></td>
</tr>
<?
	}
} 
?>
</tbody>
</table>