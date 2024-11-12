<?php
include_once('./_common.php'); // 그누보드 공통 파일 포함

$mb_name = $_POST['mb_name'];
$mb_nick = $_POST['mb_nick'];
$mb_email = $_POST['mb_email'];

// SQL 인젝션 방지를 위한 데이터 처리
$mb_name = mysqli_real_escape_string($g5['connect_db'], $mb_name);
$mb_nick = mysqli_real_escape_string($g5['connect_db'], $mb_nick);
$mb_email = mysqli_real_escape_string($g5['connect_db'], $mb_email);

$sql = "SELECT COUNT(*) AS cnt FROM {$g5['member_table']} 
        WHERE mb_name = '{$mb_name}' AND mb_nick = '{$mb_nick}' AND mb_email = '{$mb_email}'";

$result = sql_query($sql);
$row = sql_fetch_array($result);

// 데이터 존재 여부에 따라 true 또는 false 리턴
if ($row['cnt'] > 0) {
    echo json_encode(true);
} else {
    echo json_encode(false);
}
?>
