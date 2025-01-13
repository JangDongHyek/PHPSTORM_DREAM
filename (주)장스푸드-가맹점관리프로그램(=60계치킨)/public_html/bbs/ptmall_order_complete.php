<?php
/****************************************
포인트몰 결제
****************************************/

include_once('./_common.php');

$today = mktime(date('G'),number_format(date('i')),number_format(date('s')),date('n'),date('j'),date('Y'));

$od_tel = '';
if($_POST['od_tel1'] != '') $od_tel .= $_POST['od_tel1'].'-';
if($_POST['od_tel2'] != '') $od_tel .= $_POST['od_tel2'].'-';
if($_POST['od_tel3'] != '') $od_tel .= $_POST['od_tel3'];

$od_hp = '';
if($_POST['od_hp1'] != '') $od_hp .= $_POST['od_hp1'].'-';
if($_POST['od_hp2'] != '') $od_hp .= $_POST['od_hp2'].'-';
if($_POST['od_hp3'] != '') $od_hp .= $_POST['od_hp3'];

if($hap > 0 && $hap2 > 0){
	$od_method = '포인트&일반 주문';
}else if($hap > 0){
	$od_method = '일반 주문';
}else if($hap2 > 0){
	$od_method = '포인트';
}else{
	$od_method = '일반 주문';
}

$sql = " update g5_ptmall_order set 
	od_name = '{$_POST['od_name']}',
	od_tel = '{$od_tel}',
	od_hp = '{$od_hp}',
	od_zip = '{$_POST['od_zip']}',
	od_addr1 = '{$_POST['od_addr1']}',
	od_addr2 = '{$_POST['od_addr2']}',
	od_addr3 = '{$_POST['od_addr3']}',
	od_memo = '{$_POST['od_memo']}',
	od_tot_price = '{$cart_sum}',
    od_tot_price2 = '{$cart_sum2}',
	od_tot_fee = '{$cart_fee_sum}',
	od_hap = '{$hap}',
    od_hap2 = '{$hap2}',
	od_status = '신청',
	od_method = '{$od_method}',
	pay_status = '결제완료',
	od_date = '".date('Y-m-d H:i:s')."', 
	tid = '', 
	result_code = '', 
	result_msg = '', 
	moid = '60chicken4_{$today}', 
	appl_date = '".date('Ymd')."', 
	appl_time = '".date('His')."' 
	where od_idx = '{$od_idx}'
";
sql_query($sql);

$sql2 = " update g5_ptmall_cart set ct_status = '신청' where od_idx='{$od_idx}' ";
sql_query($sql2);

// 포인트 차감
$mb_id = $member['mb_id'];
$po_point = "-".$hap2;
$po_content = $goodname;
$expire = "";
$mb = get_member($mb_id);
$po_type = "사용";

insert_point2($mb_id, $po_point, $po_content, '@passive', $mb_id, $mb_id.'-'.uniqid(''), $expire, $po_type);

// 포인트 pt_od_idx 업데이트
$sql = "SELECT po_id FROM g5_point WHERE mb_id = '{$mb_id}' AND po_rel_table = '@passive' ORDER BY po_id DESC LIMIT 0, 1";
$row = sql_fetch($sql);			
$po_id = $row["po_id"];

$sql = "UPDATE g5_point SET pt_od_idx = '{$od_idx}' WHERE po_id = '{$po_id}' AND mb_id = '{$mb_id}'";
sql_query($sql);


/* SMS 발송 STR */
// SMS 발송
$od_sql = " select * from g5_ptmall_order where od_idx = '{$od_idx}' ";
$od_row = sql_fetch($od_sql);
$mb_hp = $od_row['mb_hp'];

$mem_sql = " select * from g5_member where mb_id='{$od_row['mb_id']}' ";
$mem_row = sql_fetch($mem_sql);

$moid_val = '60chicken4_'.$today;
$moid_arr = explode('60chicken4_',$moid_val);

$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
mysql_select_db("chicken60");

// 점주에게 발송
$tran_msg1 = "[60계치킨] 결제가 완료되었습니다\n주문번호 : {$moid_arr[1]}";
//$tran_msg1 = iconv('utf-8','euc-kr',$tran_msg1);

// 점주에게 발송
/*$tran_msg2 = "[60계치킨] 접수되었습니다\n디자인 완료 후 검토요청 드리겠습니다";*/
$tran_msg2 = "{$mem_row['mb_2']}\n주문번호 : {$moid_arr[1]} 주문이 완료되었습니다\n빠른시간안에 제작하여 배송해드리겠습니다";
//$tran_msg2 = iconv('utf-8','euc-kr',$tran_msg2);

// 회원관리에서 결제 체킹된 임직원에게 발송
$tran_msg3 = "[60계치킨] 결제가 완료되었습니다\n매장명 : {$mem_row['mb_2']}\n주문번호 : {$moid_arr[1]}";
//$tran_msg3 = iconv('utf-8','euc-kr',$tran_msg3);

// 회원관리에서 주문 체킹된 임직원에게 발송
$tran_msg4 = "[60계치킨] 디자인 작업요청되었습니다\n매장명 : {$mem_row['mb_2']}\n주문번호 : {$moid_arr[1]}";
//$tran_msg4 = iconv('utf-8','euc-kr',$tran_msg4);
//$sendHP="0260117054";

$sendHP=$g_tel2;

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
	'$sendHP',
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

$sql2 = "insert into TBL_SUBMIT_QUEUE values
(
	'200".$od_idx."1',
	'orders',
	'4133',
	'1',
	'00',
	'I',
	CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
	'1',
	'".str_replace('-','',$mb_hp)."',
	'$sendHP',
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
mysql_query($sql2,$conn_db);

$oscm1_sql = " select * from g5_order_sms_cate_mb where oscm_ca_name='결제' and oscm_use='y' ";
$oscm1_qry = sql_query($oscm1_sql);
$k1=0;
while($oscm1_row = sql_fetch_array($oscm1_qry)){
	$sql3 = "insert into TBL_SUBMIT_QUEUE values
	(
		'200".$od_idx."0".$k1."',
		'orders',
		'4133',
		'1',
		'10',
		'I',
		CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
		'1',
		'".str_replace('-','',$oscm1_row['oscm_mb_hp'])."',
		'$sendHP',
		'',
		'00000',
		'".$tran_msg3."',
		'',
		'1',
		'text/plain',
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
	mysql_query($sql3,$conn_db);
	$k1++;
}

$oscm2_sql = " select * from g5_order_sms_cate_mb where oscm_ca_name='주문' and oscm_use='y' ";
$oscm2_qry = sql_query($oscm2_sql);
$k2=0;
while($oscm2_row = sql_fetch_array($oscm2_qry)){
	$sql4 = "insert into TBL_SUBMIT_QUEUE values
	(
		'200".$od_idx."1".$k2."',
		'orders',
		'4133',
		'1',
		'10',
		'I',
		CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
		'1',
		'".str_replace('-','',$oscm2_row['oscm_mb_hp'])."',
		'$sendHP',
		'',
		'00000',
		'".$tran_msg4."',
		'',
		'1',
		'text/plain',
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
	//mysql_query($sql4,$conn_db);
	$k2++;
}
/* SMS 발송 END */



$location_data = G5_BBS_URL."/content.php?co_id=ptmall_myorder&od_idx=".$od_idx;

echo "<script>location.href = '".$location_data."'; </script>";
?>
