<?php
include_once('./_common.php');
$firstRow=$page*$row;
if($po_datetime1){
	$totime1=strtotime($po_datetime1);
	$where1=" and $totime1<=unix_timestamp(po_datetime)";
}
if($po_datetime2){
	$totime2=strtotime($po_datetime2." 23:59:59");
	$where2=" and unix_timestamp(po_datetime)<=$totime2";
}
$sql="select sum(po_point) as po_point,left(po_datetime,10) as po_datetime,po_mb_point from g5_point 
	  where mb_id='$member[mb_id]' 
	  $where1 
	  $where2
	 group by left(po_datetime,10) order by po_id desc limit $firstRow,$row";
$result=sql_query($sql);
?>
<? while($row=sql_fetch_array($result)){
				
			?>
		<tr>
				<!--<th>금액</th>
				<td></td>-->
				<td><a href="javascript:;" onclick="pointView('<?=$row[po_datetime]?>')"><?php echo $row['po_datetime'] ?></a></td>
				<td><?=$row['po_point']?></td>
				<td><?=$row['po_mb_point']?></td>
			</tr>
		<? }?>
