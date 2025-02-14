<?php
include_once('./_common.php');

$idx = $_POST['idx'];
$mode = $_POST['mode'];

// 받은 사람이 받은 메세지 삭제
if($mode == 'receive') {
    $sql = " update g5_message set receive_delete_yn = 'Y', receive_delete_date = now() where idx = {$idx}; ";
    sql_query($sql);
}
// 보낸 사람이 보낸 메세지 삭제
else {
    $sql = " update g5_message set send_delete_yn = 'Y', send_delete_date = now() where idx = {$idx}; ";
    sql_query($sql);
}

die('success');
?>