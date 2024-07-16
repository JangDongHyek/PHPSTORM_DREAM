<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

$mb_id = substr(clean_xss_tags($_POST['mb_id']), 0, 20);
$mb_email = get_email_address(trim($_POST['mb_email']));

if(!$mb_id || !$mb_email)
    alert('Please use it in the right way.', G5_URL);

$sql = " select mb_name, mb_password, mb_email, mb_datetime from {$g5['member_table']} where mb_id = '{$mb_id}' and substring(mb_email_certify, 1, 1) = '0' ";
$mb = sql_fetch($sql);
if (!$mb) {
    alert("You are already a member with email verification.", G5_URL);
}

if (!chk_captcha()) {
    alert('The number to prevent automatic registration is incorrect.');
}

$sql = " select count(*) as cnt from {$g5['member_table']} where mb_id <> '{$mb_id}' and mb_email = '$mb_email' ";
$row = sql_fetch($sql);
if ($row['cnt']) {
    alert("{$mb_email} E-mail is an existing e-mail address.\\n\\nPlease enter a different e-mail address.");
}

// 인증메일 발송
$subject = '['.$config['cf_title'].'] confirmation email.';

$mb_name = $mb['mb_name'];
$mb_datetime = $mb['mb_datetime'] ? $mb['mb_datetime'] : G5_TIME_YMDHIS;
$mb_md5 = md5($mb_id.$mb_email.$mb_datetime);
$certify_href = G5_BBS_URL.'/email_certify.php?mb_id='.$mb_id.'&amp;mb_md5='.$mb_md5;

ob_start();
include_once ('./register_form_update_mail3.php');
$content = ob_get_contents();
ob_end_clean();

mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content, 1);

$sql = " update {$g5['member_table']} set mb_email = '$mb_email' where mb_id = '$mb_id' ";
sql_query($sql);

alert("A verification email has been sent back to {$mb_email}. \\n\\n Please check your email {$mb_email} after a while.", G5_URL);
?>