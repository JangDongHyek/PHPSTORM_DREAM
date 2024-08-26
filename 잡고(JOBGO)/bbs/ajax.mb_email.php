<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$mb_email = trim($_POST['reg_mb_email']);
$mb_id    = trim($_POST['reg_mb_id']);
$mb_sns   = trim($_POST['mb_sns']); // 페이스북 로그인 때문에 예외 처리

set_session('ss_check_mb_email', '');

if ($msg = empty_mb_email($mb_email)) die($msg);
if($mb_sns != 'facebook') { // 페이스북은 이메일 형식으로 아이디가 넘어오지 않기 때문에 형식 체크하지 않음
    if ($msg = valid_mb_email($mb_email)) die($msg);
}
if ($msg = prohibit_mb_email($mb_email)) die($msg);
if ($msg = exist_mb_email($mb_email, $mb_id)) die($msg);

set_session('ss_check_mb_email', $mb_email);
?>