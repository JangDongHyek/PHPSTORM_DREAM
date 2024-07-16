<?php
include_once("./_common.php");

/** 마이페이지 - 벙커관리 - 벙커트레이더 신청 or 환전 신청 **/

$account_holder = trim($account_holder);
$registration_number = Encrypt($reg_number1.'-'.$reg_number2);
if($mode == 'trader') { // 벙커트레이더 등록 신청
    // 기존에 이미 신청했으나 거절당한 건이 있을 경우 del_yn = 'Y' 업데이트 후 새로 추가
    $cnt = sql_fetch(" select count(*) as cnt from g5_bunker_trader where mb_id = '{$member['mb_id']}' and state = '승인거절' ")['cnt'];
    if($cnt > 0) {
        sql_query("update g5_bunker_trader set del_yn = 'Y' where mb_id = '{$member['mb_id']}' and state = '승인거절' ");
    }

    $sql = " insert into g5_bunker_trader set mb_id = '{$member['mb_id']}', bank = '{$bank}', account_holder = '{$account_holder}', account_number = '{$account_number}', registration_number = '{$registration_number}', state = '승인대기', wr_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
}
else {
    $bunker = str_replace(',', '', $bunker); // 환전 신청 벙커
    $remain_bunker = $member['mb_bunker'] - $bunker; // 잔여 벙커

    // 회원 정보에서 벙커 우선 차감 (계속 신청할 수 있으므로)
    $sql = " update g5_member set mb_bunker = '{$remain_bunker}' where mb_id = '{$member['mb_id']}' ";
    sql_query($sql);

    $sql = " insert into g5_bunker_withdraw set 
             trader_idx = '{$trader_idx}', mb_id = '{$member['mb_id']}', bank = '{$input_bank}', account_holder = '{$account_holder}', account_number = '{$account_number}', registration_number = '{$registration_number}',
             bunker = '{$bunker}', remain_bunker = '{$remain_bunker}', exchange_krw = '{$exchange_krw}', state = '대기', wr_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    $idx = sql_insert_id();

    // BUNKER HISTORY
    //bunkerHistory($member['mb_id'], '출금', $bunker, 'BUNKER 출금', '', 'g5_bunker_withdraw', $idx, 'withdraw');
}

alert('신청이 완료되었습니다.', G5_BBS_URL.'/mypage_bunker.php', false);