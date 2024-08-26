<?php
$sub_id = "my_withdraw";
include_once('./_common.php');

$g5['title'] = '출금 신청';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}

$mb_id = $_SESSION['ss_mb_id'];
$mb = get_member($mb_id);

include_once($member_skin_path.'/my_withdraw.skin.php');

include_once('./_tail.php');
?>