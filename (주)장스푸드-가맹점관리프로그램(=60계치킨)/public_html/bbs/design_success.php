<?php
include_once('./_common.php');

$sql = " update g5_order set 
	design_check = '검토완료',
	edit_check = '',
	design_ok = '검토완료' 
	where od_idx = '{$od_idx}'
";
sql_query($sql);

//$conn_db = mysql_connect("211.115.216.107","jfsms","wkdtmvnem12!@");
$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
//mysql_select_db("si_server");
mysql_select_db("chicken60");

$od_sql = " select * from g5_order where od_idx = '{$od_idx}' ";
$od_row = sql_fetch($od_sql);

$mem_sql = " select * from g5_member where mb_id='{$od_row['mb_id']}' ";
$mem_row = sql_fetch($mem_sql);

$tran_msg1 = "[60계치킨] 디자인 검토가 완료되었습니다
매장명: {$mem_row['mb_2']}";
//$tran_msg1 = iconv('utf-8','euc-kr',$tran_msg1);

$oscm1_sql = " select * from g5_order_sms_cate_mb where oscm_ca_name='주문' and oscm_use='y' ";
$oscm1_qry = sql_query($oscm1_sql);
$k1=0;
while($oscm1_row = sql_fetch_array($oscm1_qry)){
	$sql2 = "insert into TBL_SUBMIT_QUEUE values
	(
		'200".$od_idx."3".$k1."',
		'orders',
		'4133',
		'1',
		'00',
		'I',
		CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
		'1',
		'".str_replace('-','',$oscm1_row['oscm_mb_hp'])."',
		'$g_tel1',
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
	mysql_query($sql2,$conn_db);
	$k1++;
}

/////////////추가///////////////

/* SMS 발송 STR */
// SMS 발송
$od_sql = " select * from g5_order where od_idx = '{$od_idx}' ";
$od_row = sql_fetch($od_sql);
$mb_hp = $od_row['mb_hp'];

$moid_arr = explode('60chicken4_',$od_row['moid']);

$tran_msg2 = "[60계치킨] 검토 완료가 접수되었습니다.
주문번호: {$moid_arr[1]}";
//$tran_msg2 = iconv('utf-8','euc-kr',$tran_msg1);

$msg_title = '';

$sql = "insert into TBL_SUBMIT_QUEUE values
(
	'200".$od_idx."3',
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

alert('시안 검토완료를 하였습니다.',G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$od_idx.'&page='.$page.'&mode='.$mode);
?>
