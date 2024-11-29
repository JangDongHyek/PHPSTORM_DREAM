<?php
include_once ("./_common.php");
/**
 * FCM TOKEN 등록
 * $token : push key
 * $agent : AOS, IOS
 * AOS ==> $version1 : versionCode, $name : versionName
 * IOS ==> $version1 : version, $name : build
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

$sql_common = " mb_id = '{$member['mb_id']}',
                agent = '{$agent}', 
                token = '{$token}',
                version1 = '{$version1}', 
                version2 = '{$version2}' ";

if(!isset($row['idx'])) { // DB에 fcm 정보가 없으면 INSERT
    $sql = "insert g5_fcm set {$sql_common}, reg_date = '" . G5_TIME_YMDHIS . "'";
}
else if(empty($row['token']) || $row['token'] != $token) { // 토큰값이 비었거나 토큰값 변경 시 UPDATE
    //|| empty($row['version1'])
    $sql = "update g5_fcm set {$sql_common}, mod_date = '" . G5_TIME_YMDHIS . "' where idx = '{$row['idx']}'";
}
sql_query($sql);

if(!empty($version1) && (empty($row['version1']) || $row['version1'] != $version1)) { // 버전정보가 달라지면
    $sql = "update g5_fcm set {$sql_common}, version_update = '" . G5_TIME_YMDHIS . "' where idx = '{$row['idx']}'";
    sql_query($sql);
}

die();
