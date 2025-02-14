<?php
include_once('./_common.php');

$idx = $_POST['idx'];
$state = $_POST['state'];

// 데이트 수락
if($state == '수락') {
    $sql = " update g5_propose set propose_state = '수락', propose_state_date = now() where idx = {$idx}; ";
    sql_query($sql);
}
// 데이트 거절
else {
    $sql = " update g5_propose set propose_state = '거절', propose_state_date = now() where idx = {$idx}; ";
    sql_query($sql);
}

die('success');
?>