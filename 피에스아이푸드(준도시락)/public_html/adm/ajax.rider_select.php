<?php
include_once ('./_common.php');
/**
 * 주문내역 - 담당기사 배정
 */

$ord = sql_fetch(" select * from g5_order where idx = '{$idx}' ");

$sql = " update g5_order set rider = '{$rider}' where idx = '{$idx}' ";
$result = sql_query($sql);

// * 담당기사 배정 시 이후 주문 건도 동일한 담당기사 자동 배정
$mb = get_member($rider);
$info = sql_fetch(" select * from g5_rider where customer = '{$customer}' ");
if(!isset($info['idx'])) { // 담당기사 없으면 insert
    $sql = " insert into g5_rider set rider = '{$rider}', rider_name = '{$mb['mb_name']}', customer = '{$customer}', wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);

    // 이전 주문 건도 동일한 담당기사 자동 배정 (설정된 담당기사가 없을 경우!)
    sql_query(" update g5_order set rider = '{$rider}' where mb_id = '{$customer}' and (rider is null or rider = '') ");
}
if(isset($info['idx']) && $info['driver'] != $rider) { // 담당기사 변경 시 update
    $sql = " update g5_rider set rider = '{$rider}', rider_name = '{$mb['mb_name']}', up_datetime = '".G5_TIME_YMDHIS."' where customer = '{$customer}' ";
    $result = sql_query($sql);
}

die($result);