<?php
include_once('./_common.php');

$od_tel = $od_tel1.'-'.$od_tel2.'-'.$od_tel3;
$od_hp = $od_hp1.'-'.$od_hp2.'-'.$od_hp3;

$sql = " update g5_ptmall_order set 
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

// 포인트 처리 START
// - 포인트 차감
$po_content = '[주문] '.$it_name;
insert_point($member['mb_id'], "-".$cart_sum, $po_content, '@passive', $member['mb_id'], $member['mb_id'].'-'.uniqid(''), $expire);

// - 포인트 주문idx 업데이트
$sql = "SELECT po_id FROM g5_point WHERE mb_id = '{$member[mb_id]}' AND po_rel_table = '@passive' ORDER BY po_id DESC LIMIT 0, 1";
$row = sql_fetch($sql);				
$po_id = $row["po_id"];

$sql = "UPDATE g5_point set po_od_idx = '{$od_idx}' where mb_id = '{$member[mb_id]}' and po_id = '{$po_id}'";
sql_query($sql);

// 포인트 처리 END

$sql = " update g5_point_cart set ct_status = '신청' where od_idx='{$od_idx}' ";
sql_query($sql);

alert('주문이 완료되었습니다',G5_BBS_URL.'/content.php?co_id=point_myorder');
?>
