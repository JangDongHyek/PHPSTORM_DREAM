<?php
include_once("./_common.php");
/**
 * FCM TOKEN 등록 (IOS)
 * $token : push key
 * $agent : AOS, IOS
 * $version : version
 * $build : build
 */

$token = $_POST['token'];
$agent = $_POST['agent'];
$version1 = $_POST['version1'];
$version2 = $_POST['version2'];

if (empty($agent)) $agent = (0 < strpos($_SERVER['HTTP_USER_AGENT'], "AJNGK")) ? "AOS" : "IOS";
if (!$is_member) die();
if (empty($token)) die();

$sql = "select * from g5_fcm where mb_id = '{$member['mb_id']}'";
$row = sql_fetch($sql);
if ($row['mb_id']) {
    $sql = "update g5_fcm set agent = '{$agent}', token = '{$token}', mod_date = '" . G5_TIME_YMDHIS . "', version1 = '{$version1}', version2 = '{$version2}' where mb_id = '{$member['mb_id']}'";
} else {
    $sql = "insert g5_fcm set agent = '{$agent}', token = '{$token}', mb_id = '{$member['mb_id']}', reg_date = '" . G5_TIME_YMDHIS . "', version1 = '{$version1}', version2 = '{$version2}'";
}

sql_query($sql);
echo "ok";
?>
