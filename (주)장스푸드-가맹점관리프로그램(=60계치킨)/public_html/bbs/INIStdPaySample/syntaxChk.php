<?
include_once('../../common.php');

 /*
$no_oid = "60chicken4_1549603453671";

// 결제완료 SMS발송
$od_sql = " select * from g5_point_order where moid = '{$no_oid}' ";
$od_row = sql_fetch($od_sql);
$mb_hp = $od_row['mb_hp'];
$od_idx = $od_row['od_idx'];

$mem_sql = " select * from g5_member where mb_id='{$od_row['mb_id']}' ";
$mem_row = sql_fetch($mem_sql);

$moid_arr = explode('60chicken4_', $no_oid);

$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
mysql_select_db("chicken60");

// 점주에게 발송
$tran_msg1 = "[60계치킨] 결제가 완료되었습니다\n주문번호 : {$moid_arr[1]}";
//$tran_msg1 = iconv('utf-8','euc-kr',$tran_msg1);

$sql = "insert into TBL_SUBMIT_QUEUE values
(
	'200".$od_idx."0',
	'orders',
	'4133',
	'1',
	'00',
	'I',
	CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
	'1',
	'".str_replace('-','',$mb_hp)."',
	'0260117054',
	'',
	'00000',
	'".$tran_msg1."',
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

echo 1;

*/

$tran_msg1 = "[60계치킨] 결제가 완료되었습니다\n주문번호 : {$moid_arr[1]}";

echo $tran_msg1;

?>
