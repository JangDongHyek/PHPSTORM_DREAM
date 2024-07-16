<?php
include_once ("./_common.php");
/**
 * FCM TOKEN 등록
 * $token : push key
 * $agent : AOS, IOS
 */

$token = $_POST['token'];
$agent = $_POST['agent'];

if (empty($agent)) $agent = (0 < strpos($_SERVER['HTTP_USER_AGENT'], "APodosea")) ? "AOS" : "IOS";
set_session('ss_agent', $agent);
if (!$is_member) die();
if (empty($token)) die();

// 기존정보 확인
$sql = "SELECT * FROM g5_fcm WHERE mb_id = '{$member['mb_id']}' ORDER BY idx DESC LIMIT 0, 1";
$row = sql_fetch($sql);

$sql_common = " mb_id = '{$member['mb_id']}', 
                agent = '{$agent}', 
                token = '{$token}', 
                reg_date = now()
                ";

if(empty($row['token'])) {
    $sql = "INSERT INTO g5_fcm SET {$sql_common}";
}
else if (!empty($row['token']) && $row['token'] != $token) { // 토큰값 변경 시
    // 새토큰 업데이트
    $sql = "UPDATE g5_fcm SET {$sql_common} WHERE idx = '{$row['idx']}'";
}
sql_query($sql);