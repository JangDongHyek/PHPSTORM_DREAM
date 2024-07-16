<?php
include_once('./_common.php');

/**
 **  기업의뢰 ==> 조회(view) 동작
 **  넘어오는 idx => 기업의뢰 : g5_company_inquiry idx / 답변 : g5_helpme_answer idx
 **/

$acc_count = sql_fetch(" select count(*) as count from g5_company_inquiry_action where company_inquiry_idx = {$company_inquiry_idx} and mode = '{$mode}' order by idx ")['count']; // 누적카운트
if(empty($acc_count)) { $acc_count = 0; }

$count = sql_fetch(" select count(*) as count from g5_company_inquiry_action where company_inquiry_idx = {$company_inquiry_idx} and mb_id = '{$member['mb_id']}' and mode = '{$mode}' and date_format(wr_datetime,'%Y-%m-%d') = date_format(now(), '%Y-%m-%d'); ")['count']; // 금일 해당 동작을 했는지 확인
if($count == 0) {
    $acc_count = $acc_count + 1; // 누적카운트 + 1
    sql_query(" insert into g5_company_inquiry_action set mode = '{$mode}', company_inquiry_idx = {$company_inquiry_idx}, mb_id = '{$member['mb_id']}', acc_count = {$acc_count}, wr_datetime = '".G5_TIME_YMDHIS."'; ");
}

echo $acc_count;
?>