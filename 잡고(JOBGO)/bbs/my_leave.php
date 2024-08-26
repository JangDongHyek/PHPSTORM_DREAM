<?php
$sub_id = "my_leave";
include_once('./_common.php');

$g5['title'] = '회원 탈퇴';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/register.php');
}

include_once($member_skin_path.'/my_leave.skin.php');

include_once('./_tail.php');
?>