<?php
include_once('./_common.php');

$mb_no = $_REQUEST['mb_no'];
$message = $_REQUEST['message'];

// 비노출 대상 아이디
$mb_id = sql_fetch(" select mb_id from g5_member where mb_no = {$mb_no}; ")['mb_id'];

$sql = " select count(*) as count from g5_noshow where mb_no = '{$member['mb_no']}' and noshow_mb_no = '{$mb_no}' ";
$count = sql_fetch($sql)['count'];

if($count > 0) {
    die('fail');
}
else {
    // 비노출 DB 저장
    $sql = " insert into g5_noshow set 
             mb_no = {$member['mb_no']}, mb_id = '{$_SESSION['ss_mb_id']}', noshow_mb_no = {$mb_no}, noshow_mb_id = '{$mb_id}', reg_date = '". G5_TIME_YMDHIS . "'; ";
    sql_query($sql);

    die('success');
}
?>