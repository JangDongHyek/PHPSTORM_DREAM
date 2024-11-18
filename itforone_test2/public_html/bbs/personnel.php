<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
$sql="select * from g5_person";
$row=sql_fetch($sql);
?>
<div class="new_win">
	<form name="form" method="post" action="<?=G5_BBS_URL?>/personnel.update.php">
	<table class="table" align="center">
		<tbody>
			<tr>
				<th>대표</th>
				<td><input type="number" name="ceo" value="<?=$row[ceo]?>" class="frm_input" required>명
			</tr>
			<tr>
				<th>디자이너</th>
				<td><input type="number" name="disign" value="<?=$row[disign]?>" class="frm_input" required>명
			</tr>
			<tr>
				<th>개발자</th>
				<td><input type="number" name="developer" value="<?=$row[developer]?>" class="frm_input" required>명
			</tr>
			<tr>
				<th>영업</th>
				<td><input type="number" name="sales" value="<?=$row[sales]?>" class="frm_input" required>명
			</tr>
			<tr>
				<th>관리자</th>
				<td><input type="number" name="manager" value="<?=$row[manager]?>" class="frm_input" required>명
			</tr>
		</tbody>
	</table>
	<div style="width:100%;text-align:center">
	<button class="btn" class="text-center">확인</button>
	</div>
	</form>
</div>