<?php
include_once('./_common.php');

/********************
주문삭제
********************/

switch($co_id){
	case "point_myorder" :		// 물품 쇼핑몰
		$tblCartOpt = "g5_point_cart_opt";
		$tblCart = "g5_point_cart";
		$tblOrder = "g5_point_order";
		break;
	case "ptmall_myorder" :		// 포인트몰
		$tblCartOpt = "g5_ptmall_cart_opt";
		$tblCart = "g5_ptmall_cart";
		$tblOrder = "g5_ptmall_order";
		break;
}


// 삭제
// -
$sql = "SELECT ct_idx FROM {$tblCart} WHERE od_idx='{$od_idx}' ";
$row = sql_fetch($sql);		
$ct_idx = $row["ct_idx"];

// - 주문 옵션 삭제
$co_del_sql = " delete from {$tblCartOpt} where ct_idx='{$ct_idx}' ";
sql_query($co_del_sql);

// - 장바구니 삭제
$c_del_sql = " delete from {$tblCart} where od_idx='{$od_idx}' ";
sql_query($c_del_sql);

// - 주문 삭제
$o_del_sql = " delete from {$tblOrder} where od_idx='{$od_idx}' ";
sql_query($o_del_sql);


//url 파라미터
$qstr = "";
if($sch_wr_id != "") $qstr .= "&amp;sch_wr_id=".$sch_wr_id;
if($sch_mb_2 != "") $qstr .= "&amp;sch_mb_2=".$sch_mb_2;

goto_url(G5_BBS_URL.'/content.php?co_id='.$co_id.'&page='.$page.$qstr);
?>