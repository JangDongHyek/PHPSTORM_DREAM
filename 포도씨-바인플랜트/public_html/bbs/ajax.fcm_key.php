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

// *동일한 토큰이 존재하면 현재 로그인한 회원에게만 토큰을 주고 동일한 토큰을 가지고 있는 아이디에 있는 토큰은 지움*
$cnt = sql_fetch("SELECT count(*) AS cnt FROM g5_fcm WHERE token = '{$token}' and mb_id != '{$member['mb_id']}'")['cnt']; // 나를 제외하고 나와 같은 토큰을 가진 회원이 있는지 확인
if($cnt > 0) {
    $sql = "UPDATE g5_fcm SET token = '', mod_date = now() WHERE token = '{$token}'";
    sql_query($sql);
}

// 기존정보 확인
$sql = "SELECT * FROM g5_fcm WHERE mb_id = '{$member['mb_id']}' ORDER BY idx DESC LIMIT 0, 1";
$row = sql_fetch($sql);

$sql_common = " mb_id = '{$member['mb_id']}', 
                agent = '{$agent}', 
                token = '{$token}', 
                reg_date = now() ";

if(!isset($row['idx'])) { // DB에 fcm 정보가 없으면 INSERT
    $sql = "INSERT INTO g5_fcm SET {$sql_common}";
}
else if (empty($row['token']) || $row['token'] != $token) { // 토큰값이 비었거나 토큰값 변경 시
    // 새토큰 업데이트
    $sql = "UPDATE g5_fcm SET {$sql_common} WHERE idx = '{$row['idx']}'";
}
sql_query($sql);