<?php
include_once("./_common.php");
$fileName="행사알림 신청현황";
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = ".$fileName.".xls" );   
header( "Content-Description: PHP4 Generated Data" ); 


$sql="select * from g5_write_push order by wr_id desc";
$vResult=sql_query($sql);
?>
<table border="1">
	<thead>
		<tr>
			<th colspan="9"><?=$fileName?></th>
			<th rowspan="3">작성일</th>
		</tr>
		<tr>
			<th colspan="3" style="background-color:#e1e1e1; border-right:0px; padding:16px 10px; font-size:14px">학부모 정보</th>
			<th colspan="3" style="background-color:#FFFFFF; border-right:0px; padding:16px 10px; font-size:14px">자녀1 정보</th>
			<th colspan="3" style="background-color:#FFFFFF; border-right:0px; padding:16px 10px; font-size:14px">자녀2 정보</th>
		</tr>
		<tr>
			<th>성명</th>
			<th>휴대폰</th>
			<th>거주동</th>
			<th>성명</th>
			<th>휴대폰</th>
			<th>생년월일</th>
			<th>성명</th>
			<th>휴대폰</th>
			<th>생년월일</th>
		</tr>
	</thead>
	<?php
		while($view=sql_fetch_array($vResult)){?>

	<tbody>
		
		<tr>
			<td><?=$view[wr_name]?></td>
			
			<td><?=$view[wr_subject]?></td>
			
			<td><?=$view[wr_content]?></td>
	
			<td><?=$view[wr_1]?></td>
			
			<td><?=$view[wr_2]?></td>
			
			<td><?=$view[wr_3]?></td>
		
			<td><?=$view[wr_4]?></td>
			
			<td><?=$view[wr_5]?></td>
			
			<td><?=$view[wr_6]?></td>
			<td><?php echo substr($view[wr_datetime],0,10)?></td>
		</tr>
	</tbody>
	<?php }?>
</table>
