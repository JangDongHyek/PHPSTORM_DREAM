<?php
include_once('./_common.php');

/** 자료실 판매자 신청 승인 상태 변경 (ajax) **/

$sql = " update g5_reference_room_seller set state = '{$state}', up_datetime = '".G5_TIME_YMDHIS."' where idx = {$idx} ";
$result = sql_query($sql);

$info = sql_fetch(" select * from g5_reference_room_seller where idx = '{$idx}' "); // 판매자 신청 정보
$mb = get_member($mb_id); // 판매자 회원 정보

if($state == '승인완료') {
    $sql = "update g5_member set seller = 'Y' where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    if($mb['mb_level'] == 2) {
        // 벙커트레이더 DB (판매자 신청 승인 시 벙커트레이더 자동 등록) ==> 일반 회원만
        $sql = " insert into g5_bunker_trader set mb_id = '{$mb_id}', bank = '{$info['bank']}', account_holder = '{$info['account_holder']}', account_number = '{$info['account_number']}', registration_number = '{$info['registration_number']}', state = '승인완료', rel_table = 'g5_reference_room_seller', rel_idx = '{$idx}', memo = '자료실 판매자 등록', wr_datetime = '".G5_TIME_YMDHIS."' ";
        sql_query($sql);
    }
}
else if($state == '승인거절') {
    $sql = "update g5_member set seller = 'N' where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    if($mb['mb_level'] == 2) {
        // 벙커트레이더 DB (등록된 벙커트레이더가 있으면 삭제))
        $cnt = sql_fetch(" select count(*) as cnt from g5_bunker_trader where rel_idx = '{$idx}' ")['cnt'];
        if($cnt > 0) sql_query(" delete from g5_bunker_trader where rel_idx = '{$idx}' ");
    }
}

die($result);
?>
