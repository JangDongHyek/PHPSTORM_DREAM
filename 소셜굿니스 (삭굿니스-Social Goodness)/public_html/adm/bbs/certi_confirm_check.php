<?php
include_once('./_common.php');

$reg_mb_email = $_POST['reg_mb_email'];

// 이메일 인증 여부 확인
$sql = " select count(*) as count from g5_certify_history where ch_check='Y' and ch_id = '{$reg_mb_email}' ";
$row = sql_fetch($sql);
$count = $row['count'];

// 인증 완료
if($count > 0) {
    die('certify');
} else {
    die('no_certify');
}
?>
