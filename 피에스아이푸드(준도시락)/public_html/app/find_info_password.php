<?php
include_once('../common.php');
include_once(G5_CAPTCHA_PATH . '/captcha.lib.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');

/**
 * 비밀번호 찾기 - 임시 비밀번호 발급
 */

if ($is_member) {
    alert_close('이미 로그인 중입니다.', G5_URL);
}

$email = trim($_POST['mb_email']);

if (!$email)
    alert_close('메일주소 오류입니다.');
$mb_hp = hyphen_hp_number($mb_hp);

$sql = " select count(*) as cnt from {$g5['member_table']} where mb_hp = '{$mb_hp}' and mb_id = '{$mb_id}'";
$row = sql_fetch($sql);

$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_datetime, sns from {$g5['member_table']} where mb_hp = '{$mb_hp}' and mb_id = '{$mb_id}' ";
$mb = sql_fetch($sql);
if (!$mb['mb_id'])
    alert('존재하지 않는 회원입니다.\\n입력 정보를 확인해 주세요.');
else if (is_admin($mb['mb_id']))
    alert('관리자 아이디는 접근 불가합니다.');
else if (!empty($mb['sns'])) { // sns 계정은 비밀번호 찾기 불가
    alert('SNS 계정은 이용할 수 없습니다.');
}

// 임시비밀번호 발급
$change_password = rand(100000, 999999);

$subject = "[" . $config['cf_title'] . "] 임시 비밀번호 발급 안내";

$content = "";
$content .= '<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7;font-family:Nanum Gothic;">';
$content .= '<div style="border:1px solid #dedede">';
$content .= '<h1 style="padding:30px 30px 30px 30px;background:#f7f7f7;color:#555;font-size:1.4em">';
$content .= '임시 비밀번호 발급 안내';
$content .= '</h1>';
$content .= '<p style="margin:20px 0 0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
$content .= '임시 비밀번호를 다음과 같이 안내드립니다.<br>';
$content .= '아래에서 임시 비밀번호를 확인하신 후,<br>로그인 후에는 새로운 비밀번호로 변경해 주십시오.</span><br>';
$content .= '</p>';
$content .= '<p style="margin:0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
$content .= '<span style="display:inline-block;width:120px">회원아이디</span> ' . $mb['mb_id'] . '<br>';
$content .= '<span style="display:inline-block;width:120px">임시비밀번호</span> <strong style="color:#ff3061">' . $change_password . '</strong>';
$content .= '</p>';
$content .= '</div>';
$content .= '</div>';

itforoneMailer('itforyou@hanmail.net', $config['cf_admin_email_name'], $_POST['mb_email'], $mb['mb_name'], $subject, $content);

// 임시비밀번호 업데이트
sql_query(" update {$g5['member_table']} set mb_password = '".get_encrypt_string($change_password)."' where mb_id = '{$mb_id}' ");
sql_query(" insert into g5_mail_log set mb_id = '{$mb_id}', mb_hp = '{$mb_hp}', mb_email = '{$mb_email}', wr_datetime = now() ");

alert('임시 비밀번호가 메일로 발송되었습니다.\\n메일을 확인해 주세요.', APP_URL . '/login.php', false);
?>
