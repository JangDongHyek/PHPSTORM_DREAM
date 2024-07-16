<?php
include_once("./_common.php");

/** 프리미엄 신청내역 - 상태 변경 (ajax) **/

// 처리 상태 변경
sql_query(" update g5_premium set state = '{$state}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}' ");

if($state == '완료') {
    // 프리미엄으로 전환
    $result = sql_query(" update g5_member set mb_grade = 'Premium' where mb_id = '{$mb_id}' ");
} else {
    // 베이직으로 전환
    $result = sql_query(" update g5_member set mb_grade = 'Basic' where mb_id = '{$mb_id}' ");
}

die($result);