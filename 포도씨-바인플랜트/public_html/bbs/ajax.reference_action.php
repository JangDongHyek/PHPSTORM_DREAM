<?php
include_once ("./_common.php");
/**
 * 자료실 결제 (전액 벙커 결제 시 사용) / 삭제
 */

$reference = sql_fetch(" select * from g5_reference_room where idx = '{$idx}' "); // 자료 정보

// 자료실 결제 여부 확인
if($mode == "view") {
    $cnt = sql_fetch(" select count(*) as cnt from g5_reference_room_sale where buy_mb_id = '{$member['mb_id']}' and reference_idx = '{$idx}' ")['cnt'];

    if($cnt > 0 || $reference['rr_is_free'] == 'Y') {
        // 다운로드 기록
        $sql = " insert into g5_reference_room_download set mb_id = '{$member['mb_id']}', reference_idx = '{$idx}', wr_datetime = '".G5_TIME_YMDHIS."' ";
        $result = sql_query($sql);

        echo 'payment_complete';
        exit;
    }
}

// 결제
if($mode == "payment") {
    $msg = bunkerHistory($member['mb_id'], '차감', $price, '자료실 결제', $reference['mb_id'], 'g5_reference_room', $idx, '', '');
    if(!$msg) {
        echo 'no_bunker';
        exit;
    }
    else {
        // 구매 기록
        $sql = " insert into g5_reference_room_sale set reference_idx = '{$idx}', buy_mb_id = '{$member['mb_id']}', sale_mb_id = '{$reference['mb_id']}', bunker = '{$reference['rr_price']}', wr_datetime = '".G5_TIME_YMDHIS."' ";
        $result = sql_query($sql);

        // 판매자에게 벙커 지급
        bunkerHistory($reference['mb_id'], '적립', $reference['rr_price'], '자료실 결제', $member['mb_id'], 'g5_reference_room', $idx, 'reference', '');

        // 다운로드 기록
        $sql = " insert into g5_reference_room_download set mb_id = '{$member['mb_id']}', reference_idx = '{$idx}', wr_datetime = '".G5_TIME_YMDHIS."' ";
        $result = sql_query($sql);

        // 항상 보유 벙커 전액 사용
        sql_query("update g5_member set always_use = '{$all_use}' where mb_id = '{$member['mb_id']}' ");

        echo 'success';
        exit;
    }
}

// 삭제
if($mode == "del") {
    $result = sql_query("update g5_reference_room set del_yn = 'Y', del_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}' ");
    echo $result;
    exit;
}
