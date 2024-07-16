<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 기업의뢰 - 거래 미체결 (ajax) (사용 X) ==> ajax.inquiry_review.php 합침 **/

// 견적을 제출한 모든 기업에 미체결 정보 저장
$estimate_arr = array();
$rlt = sql_query(" select * from g5_company_estimate where company_inquiry_idx = '{$idx}' order by idx ");
while($rs = sql_fetch_array($rlt)) {
    array_push($estimate_arr, $rs['idx']);
}
$estimate_idx = implode(',', $estimate_arr);

$sql = " insert into g5_company_inquiry_result set type = '미체결', mb_id = '{$member['mb_id']}', inquiry_idx = '{$idx}', estimate_idx = '{$estimate_idx}', review = '{$checked}', review_etc = '{$etc}', wr_datetime = '".G5_TIME_YMDHIS."' ";
$result = sql_query($sql);

if($result) {
    echo 1;
    exit;
}