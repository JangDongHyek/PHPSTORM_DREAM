<?php
$sub_menu = '400400';
include_once('./_common.php');
$od_status = $od_status_c;
for($i=0;$i<count($chk);$i++){
	$no = $chk[$i];
	$sql = "update {$g5['g5_shop_cart_table']} set ct_status='$od_status' where od_id='".$od_id[$no]."' and ct_status <> '취소'";
	sql_query($sql);
	$sql = "update {$g5['g5_shop_order_table']} set od_status='$od_status' where od_id='".$od_id[$no]."' and od_status <> '취소'";
	sql_query($sql);
	$sql="select * from {$g5['g5_shop_order_table']} where od_id='".$od_id[$no]."'";
	$row=sql_fetch($sql);
	if($od_status=="취소"){	
		$sql = "update {$g5['g5_shop_order_table']} set od_cancel_price='$row[od_cart_price]',od_misu='$row[od_receipt_price]' where od_id='".$od_id[$no]."'";
		sql_query($sql);
	}else{
		$sql = "update {$g5['g5_shop_order_table']} set od_cancel_price='0',od_misu='0' where od_id='".$od_id[$no]."' and od_status <> '취소'";
		sql_query($sql);
	}
	
	

	if($od_status=="입금"){
		goLms("051-528-1408",$row[od_hp],"[영남잔치상]주문하신 상품 결제 확인 되었습니다. 감사합니다.");
	}


}
?>