<?php
$sub_id = "register_mail";
include_once('./_common.php');

// 로그인중인 경우 회원가입 할 수 없습니다.
if ($is_member) {
    goto_url(G5_URL);
}

// 세션을 지웁니다.
set_session("ss_mb_reg", "");

$g5['title'] = '이메일 로그인';
include_once('./_head.php');

$register_action_url = G5_BBS_URL.'/register_mail.php';
include_once($member_skin_path.'/register_mail.skin.php');

include_once('./_tail.sub.php');
?>
