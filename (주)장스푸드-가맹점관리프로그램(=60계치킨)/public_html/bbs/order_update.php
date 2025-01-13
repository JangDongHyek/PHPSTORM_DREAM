<?php
include_once('./_common.php');

$od_tel = $od_tel1.'-'.$od_tel2.'-'.$od_tel3;
$od_hp = $od_hp1.'-'.$od_hp2.'-'.$od_hp3;

$sql = " update g5_order set 
	od_name = '{$od_name}',
	od_tel = '{$od_tel}',
	od_hp = '{$od_hp}',
	od_zip = '{$od_zip}',
	od_addr1 = '{$od_addr1}',
	od_addr2 = '{$od_addr2}',
	od_addr3 = '{$od_addr3}',
	od_memo = '{$od_memo}',
	od_tot_fee = '{$cart_fee_sum}',
	od_tot_price = '{$cart_sum}',
	od_hap = '{$hap}',
	od_method = '{$od_method}',
	od_status = '신청',
	pay_status = '대기',
	od_date = '".date('Y-m-d H:i:s')."' 
	where od_idx = '{$od_idx}'
";
sql_query($sql);

$sql = " update g5_cart set ct_status = '신청' where od_idx='{$od_idx}' ";
sql_query($sql);

alert('주문이 완료되었습니다',G5_BBS_URL.'/content.php?co_id=myorder');
?>
