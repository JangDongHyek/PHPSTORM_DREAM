<?php
include_once('./_common.php');

$reg_mb_email = base64_decode($certify_key);
$request_count = base64_decode($certify_count);

// 이메일 인증 버튼 클릭 시 기존 인증 여부 확인 (메일 여러 건 발송 시 확인 필요)
$count = sql_fetch(" select count(*) as count from g5_certify_history where ch_check='Y' and ch_id = '{$reg_mb_email}'; ")['count'];
// 이미 인증 완료 된 메일은 알림창 / 최초 인증 시 'Y'로 update
if($count > 0) {
    echo '<script>alert("Authenticated already.");parent.window.close();</script>';
    exit;
} else {
    // 인증 만료된 메일 처리 (인증 완료 전 메일 여러 건 재발송 시 이전 메일 인증은 사용 불가 처리), 인증 링크에 있는 cerfity_count와 DB ch_count 비교
    $ch_count = sql_fetch(" select ch_count from g5_certify_history where ch_check='N' and ch_id = '{$reg_mb_email}'; ")['ch_count'];
    if($ch_count != $request_count) {
        echo '<script>alert("Certification has expired.");parent.window.close();</script>';
        exit;
    }

    $sql = " update g5_certify_history set ch_check = 'Y', ch_date = now() where ch_id = '{$reg_mb_email}' ";
    $result = sql_query($sql);

    echo '<script>alert("Authentication is complete.");parent.window.close();</script>';
    exit;
}
?>