<?php
include_once("./_common.php");
if(3<strlen($mb_id)){
	
}else{
	switch($mb_id){
		case "0":
			return;
			break;
		case "01":
			return;
		case "010":
			return;
			break;
		default :
			break;
	}
}

$sql="select * from g5_member where instr (mb_id,'$mb_id') and mb_level!=10";
$result=sql_query($sql);
?>
<table class="table">
	<thead>
		<tr>
			<th>휴대폰번호</th>
			<th>이름</th>
			<th>선택</th>
		</tr>
	</thead>
	<tbody>
		<? 
		$no=0;
		while($row=sql_fetch_array($result)){?>
		<tr>
			<td><?=$row[mb_id]?></td>
			<td><?=$row[mb_name]?></td>
			<td onclick="recommendChoice('<?=$row[mb_id]?>')">선택</td>
		</tr>
		<? $no++;}
		echo $no=="0"?"<tr><td colspan='2' align='center'>해당번호가 없습니다.</td></tr><script>isRecommend=false;</script>":"";
		echo $no=="1"&&11==strlen($mb_id)?"<script>recommendChoice('".$mb_id."');</script>":"";
		?>
	</tbody>
</table>