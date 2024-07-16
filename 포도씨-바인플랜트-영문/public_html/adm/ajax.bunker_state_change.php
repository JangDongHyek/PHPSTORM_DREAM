<?php
include_once('./_common.php');

/** 벙커트레이더 승인 상태 or 출금신청 승인 상태 변경 (ajax) **/
/** 취소 기능 X, 취소 기능 필요 시 HISTORY 삭제 후 회원 포인트 원래대로 업데이트 시켜줘야함 **/

$mb = get_member($mb_id); // 벙커 트레이더 신청 회원 정보

if($mode == 'trader') { // 벙커트레이더 등록 신청
    $sql = " update g5_bunker_trader set state = '{$state}', up_datetime = '".G5_TIME_YMDHIS."' where idx = {$idx} ";
    $result = sql_query($sql);
}
else if($mode == 'withdraw') { // 출금 신청
    $sql = " select * from g5_bunker_withdraw where idx = {$idx} "; // 출금 정보
    $row = sql_fetch($sql);

    $sql_add = '';
    if($state == '완료') { // 완료
        $sql_add .= " , payment_date = '".G5_TIME_YMDHIS."' ";

        // BUNKER HISTORY -- 회원 포인트에서 미리 차감 시켜둔 후 관리자에서 승인 시 이력에 기록 (관리자가 승인 안할 수도 있기 때문)
        sql_query(" insert into g5_bunker_history set mb_id = '{$row['mb_id']}', mode = '출금', bunker = '{$row['bunker']}', normal = '{$row['bunker']}', normal_remain = '{$row['remain_bunker']}', contents = 'BUNKER 출금', rel_table = 'g5_bunker_withdraw', rel_idx = '{$idx}', etc = 'withdraw', wr_datetime = '".G5_TIME_YMDHIS."' ");
    }
    else if($state == '대기') { // 대기
        $sql_add .= " , payment_date = '' ";

        // BUNKER_HISTORY -- 완료 후 다시 대기로 변경 시 이력에서 삭제
        $count = sql_fetch(" select count(*) as count from g5_bunker_history where mb_id = '{$mb_id}' and rel_table = 'g5_bunker_withdraw' and rel_idx = '{$idx}'; ")['count'];
        if($count > 0) {
            $sql = " delete from g5_bunker_history where mb_id = '{$mb_id}' and rel_table = 'g5_bunker_withdraw' and rel_idx = '{$idx}'; ";
            sql_query($sql);
        }
    }
    /*else if($state == '취소') { // 취소
        // 출금 신청 벙커 복구
        $sql = " update g5_member set mb_bunker = mb_bunker + '{$row['bunker']}' where mb_id = '{$mb_id}' ";
        sql_query($sql);

        // BUNKER HISTORY -- 관리자에서 취소 시 이력에 기록
        $normal_remain = $mb['mb_bunker'] + $row['bunker'];
        sql_query(" insert into g5_bunker_history set mb_id = '{$row['mb_id']}', mode = '적립', bunker = '{$row['bunker']}', normal = '{$row['bunker']}', normal_remain = '{$normal_remain}', contents = 'BUNKER 출금 취소', rel_table = 'g5_bunker_withdraw', rel_idx = '{$idx}', etc = 'withdraw', wr_datetime = '".G5_TIME_YMDHIS."' ");
    }*/
    $sql = " update g5_bunker_withdraw set state = '{$state}', up_datetime = '".G5_TIME_YMDHIS."' {$sql_add} where idx = {$idx} ";
    $result = sql_query($sql);
}

die($result);
?>