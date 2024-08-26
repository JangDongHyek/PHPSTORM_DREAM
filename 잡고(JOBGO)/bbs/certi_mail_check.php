<?php
include_once('./_common.php');

$reg_mb_email = base64_decode($_REQUEST['certify_key']);

// 이메일 인증 버튼 클릭 시 기존 인증 여부 확인 (메일 여러 건 발송 시 확인 필요)
$sql = " select count(*) as count from new_certify_history where ch_check='Y' and ch_id = '{$reg_mb_email}' ";
$row = sql_fetch($sql);
$count = $row['count'];

// 이미 인증 완료 된 메일은 알림창 / 최초 인증 시 'Y'로 update
if($count > 0) {
    echo '<script>alert("이미 인증이 완료된 이메일입니다.");parent.window.close();</script>';
} else {
    $sql = " update new_certify_history set ch_check = 'Y', ch_date = now() where ch_id = '{$reg_mb_email}' ";
    $result = sql_query($sql);

    echo '<script>alert("인증 완료되었습니다.");parent.window.close();</script>';
}
?>
