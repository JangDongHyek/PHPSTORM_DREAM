<?php
include_once("./_common.php");

$sql="select * from g5_write_program where wr_id='$s_wr_1'";
$row=sql_fetch($sql);
$fileName=$row[wr_subject]."신청현황";
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = ".$fileName.".xls" );   
header( "Content-Description: PHP4 Generated Data" ); 


$sql="select * from g5_write_apply where wr_1='$s_wr_1' order by wr_id desc";
$vResult=sql_query($sql);
?>
<table border="1">
	<thead>
		<tr>
		<th colspan="9"><?=$fileName?></th>
		</tr>
		<tr>
			<th scope="row"><label for="wr_name">학생명</label></th>
			 <th scope="row"><label for="wr_2">학생연락처</label></th>
			 <th scope="row"><label for="wr_3">학부모성함</label></th>
			 <th scope="row"><label for="wr_4">학부모연락처</label></th>
			 <th scope="row"><label for="wr_subject">학교명</label></th>
			 <th scope="row"><label for="wr_content">학년</label></th>
			 <th scope="row"><label for="wr_5">기타1</th>
			 <th scope="row"><label for="wr_6">기타2</th>
			 <th scope="row"><label for="wr_7">기타3</th>
			 <th scope="row"><label for="wr_7">접수일</th>
		</tr>
	</thead>
	<?php
		while($view=sql_fetch_array($vResult)){?>

	<tbody>
		<tr>
			<td><?=$view[wr_name]?></td>
            <td><?=$view[wr_2]?></td>
	        <td><?=$view[wr_3]?></td>
		    <td><?=$view[wr_4]?></td>        
            <td><?=$view[wr_subject]?></td>
			<td><?=$view[wr_content]?></td>
			<td><?=nl2br($view[wr_5])?></td>
			<td><?=nl2br($view[wr_6])?></td>
			<td><?=nl2br($view[wr_7])?></td>
			<td><?php echo $view[wr_datetime]?></td>
        </tr>
	</tbody>
	<?php }?>
</table>
