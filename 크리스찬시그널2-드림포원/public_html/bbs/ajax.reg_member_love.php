<?php
include_once('./_common.php');

$mb_no = $_REQUEST['mb_no'];

$sql = " select count(*) as count from g5_member_love where mb_no = '{$member['mb_no']}' and love_mb_no = '{$mb_no}' ";
$count = sql_fetch($sql)['count'];

if($count > 0) {
    die('fail');
} else {
    $sql = " insert into g5_member_love set mb_no = '{$member['mb_no']}', love_mb_no = '{$mb_no}', love_date = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);

    die('success');
}
?>