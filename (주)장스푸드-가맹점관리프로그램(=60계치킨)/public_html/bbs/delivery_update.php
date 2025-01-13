<?php
include_once('./_common.php');

$od_tel = $od_tel1.'-'.$od_tel2.'-'.$od_tel3;
$od_hp = $od_hp1.'-'.$od_hp2.'-'.$od_hp3;

if($od_delivery != ''){
	$deli_sql = " select * from g5_delivery where de_idx='{$od_delivery}' ";
	$deli_row = sql_fetch($deli_sql);
	
	$od_delivery_idx = $deli_row['de_idx'];
	$od_delivery_name = $deli_row['de_name'];
	$od_delivery_url = $deli_row['de_url'];
}

$order_tbl = "g5_order";
if($order_mode == "point") $order_tbl = "g5_point_order";
if($order_mode == "ptmall") $order_tbl = "g5_ptmall_order";

$sql = " update {$order_tbl} set 
	od_name = '{$od_name}',
	od_tel = '{$od_tel}',
	od_hp = '{$od_hp}',
	od_zip = '{$od_zip}',
	od_addr1 = '{$od_addr1}',
	od_addr2 = '{$od_addr2}',
	od_addr3 = '{$od_addr3}',
	od_delivery_idx = '{$od_delivery_idx}',
	od_delivery_name = '{$od_delivery_name}',
	od_delivery_url = '{$od_delivery_url}',
	od_send_number = '{$od_send_number}' 
	where od_idx = '{$od_idx}'
";
sql_query($sql);

goto_url(G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$od_idx.'&page='.$page);
?>
