<?php
include_once('./_common.php');
include_once('./admin.shop.lib.php');

$od_receipt_point = $_REQUEST['od_receipt_point'];
$od_id = $_REQUEST['od_id'];
$mb_id = $_REQUEST['mb_id'];

// 회원이고 포인트 환불
if ($mb_id && $od_receipt_point){
    insert_point($mb_id, (+1) * $od_receipt_point, "주문번호 $od_id 결제 포인트환불");

    // 결제정보 반영
    $sql = " update {$g5['g5_shop_order_table']}
            set 
                od_receipt_point   = od_receipt_point - {$od_receipt_point}*1
 
            where od_id = '$od_id' ";
    $result = sql_query($sql);

    if($result){
        exit('포인트 환불성공');
    }else{
        exit('오류 잠시 후 다시 시도해 주세요');
    }

}
