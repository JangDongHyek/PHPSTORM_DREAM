<?
include_once('./_common.php');

$mb=get_member($mb_id);
$fileName = $mb[mb_2]."_".date("Ymd");

header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = ".$fileName.".xls" );
header( "Content-Description: PHP4 Generated Data" ); 

print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">"); 

?>
<style>
.tbl {color: #000; font-size: 11pt;}
.title {font-size: 14pt; font-weight: bold; text-align: left; border: 0;}
.head {background: #e4624a; color: #FFF; text-align: center; width: 140px;}
.head2 {background: #e4624a; color: #FFF; text-align: center; width: 300px;}
.txt {width: 200px; text-align: left;}
.pt {width: 100px; text-align: right;}
</style>

<table border="0" class="tbl">
	<tr>
		<th class="title">포인트 발급/차감</th>
	</tr>
	<?
	// 보유 포인트
	$sql = "select sum(po_point) as total from g5_point where mb_id='$mb_id' and po_rel_table <> '@login'";
	$result=sql_query($sql);
	$p_row=sql_fetch_array($result);
	?>
	<tr>
		<td>지점명</td>
		<td colspan="5"><?=$mb[mb_2]?></td>
	</tr>
	<tr>
		<td>보유 포인트</td>
		<td colspan="5"><?=number_format($p_row[total])?>점</td>
	</tr>
	<tr>
		<td>조회일</td>
		<td colspan="5"><?=$s_date?>~<?=$e_date?></td>
	</tr>
</table>
<table border="1" class="tbl">
	<tr>
		<td class="head">관리자</td>
		<td class="head">날짜</td>
		<td class="head2" colspan="2">발급</td>
		<td class="head2" colspan="2">차감</td>
        <td class="head2">비고</td>
	</tr>
	<?
		$next_e_date = date("Y-m-d", strtotime("+1 days", strtotime($e_date)));
		$sql_common = "and po_datetime >= '{$s_date}' and po_datetime < '{$next_e_date}'";

		$list_sql="select * from g5_point where mb_id = '$mb_id' and po_rel_table <> '@login' {$sql_common} order by po_id desc";
		$list_qry = sql_query($list_sql);
		$list_num = sql_num_rows($list_qry);

		if($list_num > 0) {

			for($l=0; $l<$list_num; $l++){
				$list_row = sql_fetch_array($list_qry);
				$admin_id=explode("-",$list_row[po_rel_action]);
				$sql="select mb_name from g5_member where mb_id='$admin_id[0]'";
				$result2=sql_query($sql);
				$row2=sql_fetch_array($result2);

				$mb_point = intval($list_row[po_point]);
	?>
	<tr>
		<td align="center"><?=$row2[mb_name]?></td>
		<td align="center"><?=$list_row[po_datetime]?></td>
		<td class="txt">
			<? if($mb_point >= 0) echo $list_row[po_content]; ?>
		</td>
		<td class="pt">
			<span style="color:blue;"><? if($mb_point >= 0) echo number_format(abs($mb_point)); ?></span>
		</td>
		<td class="txt">
			<? if($mb_point < 0) echo $list_row[po_content]; ?>
		</td>
		<td class="pt">
			<span style="color:red;"><? if($mb_point < 0) echo number_format(abs($mb_point)); ?></span>
		</td>
        <td align="center"><?=$list_row[po_etc]?></td>
	</tr>
	<?		
			} // for
		} else {
	?>
	<tr>
		<td colspan="7" align="center">포인트 내역이 없습니다.</td>
	</tr>
	<?
		} // end if
	?>
</table>