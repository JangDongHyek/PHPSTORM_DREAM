<?php
/**
 * FCM TOKEN 등록
 * $token : push key
 * $agent : AOS, IOS
 */
include_once ("../common.php");

$token = $_POST['token'];
$agent = $_POST['agent'];

if (empty($token)) die();
if (empty($agent)) $agent = (0<strpos($_SERVER['HTTP_USER_AGENT'],"IOS"))? "IOS" : "AOS";

// 기존정보 확인
$sql = "SELECT idx FROM g5_fcm_token WHERE token = '{$token}' ORDER BY idx DESC LIMIT 0, 1";
$row = sql_fetch($sql);

$sql_common = " mb_id = '{$member['mb_id']}', 
                agent = '{$agent}', 
                token = '{$token}', 
                regdate = now()
                ";

if ($row['idx']) {
    // 기존토큰에 등록된 아이디가 있으면 값 비움
    $sql = "UPDATE g5_fcm_token SET mb_id = '', regdate = now() WHERE token = '{$token}'";
    sql_query($sql);

    // 새토큰 업데이트
    $sql = "UPDATE g5_fcm_token SET {$sql_common} WHERE idx = '{$row['idx']}'";

} else {
    $sql = "INSERT INTO g5_fcm_token SET {$sql_common}";
}
sql_query($sql);

// 해당세션 /app/ajax.login_check.php에서 확인
set_session('ss_app_token', $token);