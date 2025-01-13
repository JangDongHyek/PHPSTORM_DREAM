<?php
include_once('./_common.php');

switch($co_id){
	case "myorder" :			// 홍보물 쇼핑몰
		$tableName = "g5_order";
		break;
	case "point_myorder" :		// 물품 쇼핑몰
		$tableName = "g5_point_order";
		break;
	case "ptmall_myorder" :		// 포인트몰
		$tableName = "g5_ptmall_order";
		break;
}

$sql = " update {$tableName} set 
	trade_check = '발주완료' 
	where od_idx = '{$od_idx}'
";
sql_query($sql);

$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
mysql_select_db("chicken60");

/* SMS 발송 STR */
// SMS 발송
$od_sql = " select * from {$tableName} where od_idx = '{$od_idx}' ";
$od_row = sql_fetch($od_sql);
$mb_hp = $od_row['mb_hp'];

$moid_arr = explode('60chicken4_',$od_row['moid']);

$tran_msg2 = "[60계치킨] 발주가 완료되었습니다.
주문번호: {$moid_arr[1]}";
//$tran_msg2 = iconv('utf-8','euc-kr',$tran_msg1);

$msg_title = '';

$sql = "insert into TBL_SUBMIT_QUEUE values
(
	'200".$od_idx."4',
	'orders',
	'4133',
	'1',
	'00',
	'I',
	CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
	'1',
	'".str_replace('-','',$mb_hp)."',
	'$g_tel1',
	'',
	'00000',
	'".$tran_msg2."',
	'',
	'0',
	'',
	'',
	CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
	'',
	'',
	'',
	'',
	'0',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'0',
	'0'
)";
mysql_query($sql,$conn_db);
/* SMS 발송 END */

alert('발주완료를 하였습니다.',G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$od_idx.'&page='.$page);
?>
