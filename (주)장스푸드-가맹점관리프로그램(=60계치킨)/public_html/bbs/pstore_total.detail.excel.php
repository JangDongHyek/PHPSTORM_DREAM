<?
include_once('./_common.php');

$fileName = "포인트상세_".substr(date("Ymd", strtotime($s_date)), 2, 6);

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
		<td align="left"><?=$s_date?></td>
	</tr>
</table>
<table border="1" class="tbl">
	<tr>
		<td class="head">날짜</td>
		<td class="head">매장명</td>
		<td class="head">발급</td>
		<td class="head">차감</td>
	</tr>
	<?
	$e_date = date("Y-m-d", strtotime("+1 days", strtotime($s_date)));
	$sql_common = "po_rel_table <> '@login' and po_datetime >= '{$s_date}' and po_datetime < '{$e_date}' and po_type in ('발급', '차감')";

	$list_sql = "select * from g5_point where {$sql_common} order by po_datetime desc";
	$list_qry = sql_query($list_sql);
	$list_num = sql_num_rows($list_qry);

	if($list_num > 0) {

		for($l=0; $l<$list_num; $l++){
			$list_row = sql_fetch_array($list_qry);

			$mb = get_member($list_row[mb_id]);
			$mb_point = intval($list_row[po_point]);
	?>
	<tr>
		<td align="center"><?=$s_date?></td>
		<td align="center"><?=$mb[mb_2]?></td>
		<td align="right"><? if($mb_point > 0) echo number_format($mb_point);?></td>
		<td align="right"><? if($mb_point < 0) echo number_format(abs($mb_point));?></td>
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