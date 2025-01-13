<?php
include_once('./_common.php');

$g5['title'] = '로그인';
include_once('./_head.sub.php');

if ($_POST['mb_id']) { 

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

	echo "<div style='text-align: center; color: #FFF; font-size: 2em;'>".$mb['mb_id']." :: session 생성 완료</div>";
	goto_url(G5_URL);
}

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div id="mb_login" class="mbskin">
    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
		<input type="hidden" name="url" value="<?php echo $login_url ?>">
		
		<div class="login-skin">
			<dl>
				<dt class="login-line"><img src="<?php echo G5_THEME_IMG_URL;?>/logo.png"></dt>
				<dd class="login-tbl">
					<table>
						<caption>
							<col width="20%">
							<col width="50%">
							<col width="auto">
						</caption>
						<tbody>
							<tr>
								<td><label for="login_id" class="login_id">ID<strong class="sound_only"> 필수</strong></label></td>
								<td><input type="text" name="mb_id" id="login_id" required class="log-input required" size="20" maxLength="20" tabindex="1"></td>
								<td rowspan="2" class="text-right"><input type="submit" value="로그인" class="btn btn-default" tabindex="3"></td>
							</tr>
						</tbody>
					</table>
				</dd>
			</dl>
		</div>
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
include_once('./_tail.sub.php');
?>
