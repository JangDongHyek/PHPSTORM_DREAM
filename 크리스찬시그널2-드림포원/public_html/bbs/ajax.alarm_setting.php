<?php
include_once('./_common.php');

$alarm = $_POST['alarm'];
$mode = $_POST['mode'];

if($mode == 'date') {
    // 데이트 설정
    $sql = " update g5_member set propose = '{$alarm}' where mb_no = {$member['mb_no']} ";
    sql_query($sql);
} else {
    // 알림 설정
    $sql = " update g5_member set alarm = '{$alarm}' where mb_no = {$member['mb_no']} ";
    sql_query($sql);
}

die('success');
?>