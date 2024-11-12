<?php
$sub_id = "register_mail_form";
include_once('./_common.php');

// 로그인중인 경우 회원가입 할 수 없습니다.
if ($is_member) {
    goto_url(G5_URL);
}

// 세션을 지웁니다.
set_session("ss_mb_reg", "");

$_GET['certify_method'] = str_replace('\"','', $_GET['certify_method']);

if($_GET['certify_method'] == 'mail') {
    $g5['title'] = '이메일 회원가입';
} else if($_GET['certify_method'] == 'phone') {
    $g5['title'] = '휴대폰 회원가입';
} else {
    $g5['title'] = 'SNS 회원가입';
}

include_once('./_head.php');

$mb_id = $_GET['certify_id'];

$register_action_url = G5_BBS_URL.'/register_mail_form.php';
include_once($member_skin_path.'/register_mail_form.skin.php');

include_once('./_tail.sub.php');
?>
