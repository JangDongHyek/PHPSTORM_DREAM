<?php
include_once("./_common.php");

// 푸시테스트
$sql = " select * from g5_fcm where mb_id = '{$member['mb_id']}' ";
$fRow = sql_fetch($sql);
if(!empty($fRow['token'])) {
    $tokens = array($fRow['token']);
    $message = array(
        "subject"=>"포도씨",
        "message"=>"푸시알림테스트중입니다",
        "goUrl"=>"",
    );
    $fcm=sendFcm($tokens, $message);
}