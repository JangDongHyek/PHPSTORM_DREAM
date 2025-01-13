<?php
include_once('./_common.php');

/********************
포인트 결제취소 (주문취소)
********************/


// 카트정보 조회 (상품명)
$c_sql = " select * from g5_ptmall_cart where od_idx='{$od_idx}' ";
$row = sql_fetch($c_sql);
$po_point = $row["it_tot_price2"];		// 총금액
$mb_id = $row["mb_id"];
$it_name = $row["it_name"];				// 상품명
$ct_idx = $row["ct_idx"];	

$po_content = "[주문취소] ".$it_name;
$po_type = "취소";

// 포인트 환급
insert_point2($mb_id, $po_point, $po_content, '@passive', $mb_id, $member['mb_id'].'-'.uniqid(''), $expire, $po_type);


// 포인트 주문idx 업데이트
$sql = "SELECT po_id FROM g5_point WHERE mb_id = '{$mb_id}' AND po_rel_table = '@passive' ORDER BY po_id DESC LIMIT 0, 1";
$row = sql_fetch($sql);				
$po_id = $row["po_id"];

$sql = "UPDATE g5_point set po_od_idx = '{$od_idx}' where mb_id = '{$mb_id}' and po_id = '{$po_id}'";
sql_query($sql);


// 주문 상태 변경 -> 취소
$o_update_sql = "UPDATE g5_ptmall_order SET pay_status = '결제취소' WHERE od_idx='{$od_idx}' ";
sql_query($o_update_sql);


//url 파라미터
$qstr = "";
if($sch_wr_id != "") $qstr .= "&amp;sch_wr_id=".$sch_wr_id;
if($sch_mb_2 != "") $qstr .= "&amp;sch_mb_2=".$sch_mb_2;

goto_url(G5_BBS_URL.'/content.php?co_id='.$co_id.'&page='.$page.$qstr);

?>