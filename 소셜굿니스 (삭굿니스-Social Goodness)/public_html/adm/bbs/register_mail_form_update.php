<?php
include_once('./_common.php');

$mb_id = get_email_address(trim($_POST['mb_id'])); // 이메일이 곧 아이디
$mb_password = get_encrypt_string($_POST['mb_password']);
$mb_password2 = get_encrypt_string($_POST['mb_password2']);

if(!$mb_id)
    alert('올바른 방법으로 이용해 주십시오.', G5_URL);

$sql = " select * from g5_certify_history where ch_id = '{$mb_id}' ";
$row = sql_fetch($sql);
$mb_email_certify = $row['ch_date']; // 이메일 인증 일자

$sql = " insert into g5_member set ";
$sql .= " mb_id = '{$mb_id}', mb_password = '{$mb_password}', mb_email = '{$mb_id}', mb_email_certify = '{$mb_email_certify}', mb_sex = '{$_POST['mb_sex']}', ";
$sql .= " mb_birth = '{$_POST['mb_birth']}', mb_hp = '{$_POST['mb_hp']}', mb_state = '정상', mb_join_date = now(), mb_btm = {$_POST['mb_btm']}, ";
$sql .= " mb_agree1 = 'Y', mb_agree2 = 'Y', mb_agree3 = 'Y'; ";
$result = sql_query($sql);

echo "<script>alert('회원가입이 완료되었습니다.');</script>";

goto_url(G5_BBS_URL.'/register_mail.php');
?>