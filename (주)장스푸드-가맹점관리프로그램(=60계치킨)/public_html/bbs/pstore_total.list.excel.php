<?
include_once('./_common.php');

$s_str = substr(date("Ymd", strtotime($s_date)), 2, 6);
$e_str = substr(date("Ymd", strtotime($e_date)), 2, 6);
$fileName = "포인트상세_(".$s_str."-".$e_str.")";

header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = ".$fileName.".xls" );
header( "Content-Description: PHP4 Generated Data" ); 

print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">"); 

?>
<style>
.tbl {color: #000; font-size: 11pt;}
.title {font-size: 14pt; font-weight: bold; text-align: left; border: 0;}
.head {background: #e4624a; color: #FFF; text-align: center;}
</style>

<table border="0" class="tbl">
	<tr>
		<th class="title">포인트 상세이력</th>
	</tr>
	<tr>
		<td>조회일</td>
		<td colspan="2"><?=$s_date?>~<?=$e_date?></td>
	</tr>
</table>
<table border="1" class="tbl">
	<tr>
		<td class="head">날짜</td>
		<td class="head">총 발급</td>
		<td class="head">총 차감</td>
	</tr>
	<?
	$next_e_date = date("Y-m-d", strtotime("+1 days", strtotime($e_date)));
	$sql_common = "po_rel_table <> '@login' and po_datetime >= '{$s_date}' and po_datetime < '{$next_e_date}' and po_type in ('발급', '차감') group by left(po_datetime, 10)";

	$list_sql="select * from g5_point where {$sql_common} order by po_datetime desc";
	$list_qry = sql_query($list_sql);
	$list_num = sql_num_rows($list_qry);

	if($list_num > 0) {

		for($l=0; $l<$list_num; $l++){
			$list_row = sql_fetch_array($list_qry);
			$list_date = substr($list_row[po_datetime], 0, 10);
			
			$next_list_date = date("Y-m-d", strtotime("+1 days", strtotime($list_date)));
			$sql = "select * from g5_point where po_rel_table <> '@login' and po_datetime >= '{$list_date}' and po_datetime < '{$next_list_date}' and po_rel_action like 'admin%'";
			$result2 = sql_query($sql);
			$total_issue = 0;	//발급
			$total_deduct = 0;	//차감
			while($row2 = sql_fetch_array($result2)){
				if(strpos($row2[po_point], "-") !== false)
					$total_deduct += $row2[po_point];
				else 
					$total_issue += $row2[po_point];
			}
	?>
	<tr>
		<td align="center"><?=$list_date?></td>
		<td align="right"><?=number_format($total_issue)?></td>
		<td align="right"><?=number_format(abs($total_deduct))?></td>
	</tr>
	<?		
		} // for
	} else {
	?>
	<tr>
		<td colspan="3" align="center">포인트 내역이 없습니다.</td>
	</tr>
	<?
	} // end if
	?>
</table>