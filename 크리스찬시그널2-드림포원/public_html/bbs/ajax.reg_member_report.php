<?php
include_once('./_common.php');

$mb_no = $_REQUEST['mb_no'];
$report_category = $_REQUEST['category'];
$report_contents = $_REQUEST['contents'];
$op = $_REQUEST['op']; // 이미 신고했는지 여부
$report_mb_id = sql_fetch(" select mb_id from g5_member where mb_no = '{$mb_no}'; ")['mb_id'];

$sql = " select count(*) as count from g5_member_report where mb_no = '{$member['mb_no']}' and report_mb_no = '{$mb_no}' ";
$count = sql_fetch($sql)['count'];

if(empty($op)) {
    die($count);
}

if($count > 0) {
    die('fail');
} else {
    $sql = " insert into g5_member_report set 
             mb_no = '{$member['mb_no']}', 
             mb_id = '{$member['mb_id']}',
             report_mb_no = '{$mb_no}', 
             report_mb_id = '{$report_mb_id}',
             report_category = '{$report_category}',
             report_contents = '{$report_contents}',
             report_date = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);

    die('success');
}
?>