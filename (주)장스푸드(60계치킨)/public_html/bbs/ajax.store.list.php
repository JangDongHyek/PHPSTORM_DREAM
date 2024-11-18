<?php
include_once('./_common.php');
$sql="select * from g5_write_store where wr_subject like '%$wr_subject%'";
$result=sql_query($sql);
?>
<table class="table">
	<thead>
		<tr>
			<th>업체명</th>
			<th>선택</th>
		</tr>
	</thead>
	<tbody>
		<?php
			while($row=sql_fetch_array($result)){?>
		<tr>
			<td><?=$row[wr_subject]?></td>
			<td><a href="javascript:;" onclick="storeChoice('<?=$row[wr_subject]?>')">선택</a></td>
		</tr>
		<?php }?>
	</tbody>
</table>