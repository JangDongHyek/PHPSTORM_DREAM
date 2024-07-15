<?php
include_once('./_common.php');

// * 회원가입 완료 버튼 클릭 시 인증 여부 체크
$count = selectCount('g5_certify_history', 'ch_id',  $reg_mb_email, 'ch_check', 'Y');
if($count > 0) { // 인증완료
    die('success');
} else { // 미인증
    die('fail2');
}
?>