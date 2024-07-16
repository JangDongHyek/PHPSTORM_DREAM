<?php
include_once('./_common.php');

// 기업검색 - 기업미니홈피 - 문의하기 INSERT
$sql = " insert into g5_company_question set mb_no = {$mb_no}, mb_id = '{$member['mb_id']}', email = '{$email}', subject = '{$subject}', contents = '{$contents}', state = 'Processing', wr_datetime = '".G5_TIME_YMDHIS."' ";
$result = sql_query($sql);

die($result);
?>