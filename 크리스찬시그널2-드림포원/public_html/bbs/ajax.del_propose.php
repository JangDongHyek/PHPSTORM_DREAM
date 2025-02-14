<?php
include_once('./_common.php');

$idx = $_POST['idx'];
$mode = $_POST['mode'];

// 데이트 수신자가 데이트 수신 삭제
if($mode == 'receive') {
    $sql = " update g5_propose set receive_delete_yn = 'Y', receive_delete_date = now() where idx = {$idx}; ";
    sql_query($sql);
}
// 데이트 신청자가 데이트 신청 삭제
else {
    $sql = " update g5_propose set send_delete_yn = 'Y', send_delete_date = now() where idx = {$idx}; ";
    sql_query($sql);
}

die('success');
?>