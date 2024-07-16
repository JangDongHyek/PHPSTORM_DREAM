<?php
include_once('./_common.php');
// include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

if ($is_member) alert('You are already logging in.', G5_URL);

$email = trim($_POST['mb_email']);
if (!$email) alert('This is an email address error.');

$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_datetime from {$g5['member_table']} where mb_id = '{$mb_id}' and mb_email = '{$mb_email}' ";
$mb = sql_fetch($sql);
if (!$mb['mb_id']) alert('You are a non-existent member.');
else if (is_admin($mb['mb_id'])) alert('Administrator ID is not accessible.');

// 임시비밀번호 발급
$change_password = rand(100000, 999999);
$mb_lost_certify = get_encrypt_string($change_password);

// 어떠한 회원정보도 포함되지 않은 일회용 난수를 생성하여 인증에 사용
$mb_nonce = md5(pack('V*', rand(), rand(), rand(), rand()));

// 임시비밀번호와 난수를 mb_lost_certify 필드에 저장 ==> ??
$sql = " update {$g5['member_table']} set mb_lost_certify = '".$mb_lost_certify."' where mb_id = '{$mb['mb_id']}' ";
sql_query($sql);

// 인증 링크 생성
$href = G5_BBS_URL.'/password_lost_certify.php?mb_no='.$mb['mb_no'].'&amp;mb_nonce='.$mb_nonce;

$subject = "[".$config['cf_title']."] This is an e-mail to find the requested member information.";

$content = "";
$content .= '<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">';
$content .= '<div style="border:1px solid #dedede">';
$content .= '<h1 style="padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em">';
$content .= 'Guidance on finding member information';
$content .= '</h1>';
$content .= '<span style="display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right">';
$content .= '<a href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>';
$content .= '</span>';
$content .= '<p style="margin:20px 0 0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
$content .= 'Member '.addslashes($mb['mb_id']).' made a request to find member information to '.G5_TIME_YMDHIS.'<br>';
$content .= 'Since even the administrator of our site cannot know the password, we create a new password and guide you instead of telling you the password.<br>';
$content .= 'After checking the password to be changed below, <span style="color:#ff3061">Click the <strong>Change Password</strong> link.</span><br>';
$content .= 'If an authentication message indicating that the password has been changed is displayed, enter the member ID and the changed password on the homepage and log in.<br>';
$content .= 'After logging in, please change to a new password in the Edit Information menu.';
$content .= '</p>';
$content .= '<p style="margin:0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
$content .= '<span style="display:inline-block;width:150px">Member ID</span> '.$mb['mb_id'].'<br>';
$content .= '<span style="display:inline-block;width:150px">Password to be changed</span> <strong style="color:#ff3061">'.$change_password.'</strong>';
$content .= '</p>';
$content .= '<a href="'.$href.'" target="_blank" style="display:block;padding:30px 0;background:#484848;color:#fff;text-decoration:none;text-align:center">Change Password</a>';
$content .= '</div>';
$content .= '</div>';

itforoneMailer('no-reply@dreamforone.com', $config['cf_admin_email_name'], $email, $mb['mb_name'], $subject, $content);

alert($email.'\\n\\nby email above to verify your member ID and password has been sent.\\n\\nPlease check your email.');
?>
