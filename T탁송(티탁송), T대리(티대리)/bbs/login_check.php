<?php
include_once('./_common.php');

$g5['title'] = "로그인 검사";

$mb_id       = trim($_POST['mb_id']);
$mb_password = trim($_POST['mb_password']);

if (!$mb_id || !$mb_password)
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_id);

if (!$mb) {
	// 일반회원 로그인용 아이디 조회
	$rs = sql_fetch("SELECT login_id FROM g5_member_login_id WHERE mb_hp = '{$mb_id}' AND agency_no = '{$_SESSION['myAgency']}' AND is_leave != 'Y' ORDER BY idx DESC LIMIT 0, 1");
	$login_id = $rs['login_id'];

	if ($login_id != "") {
		$mb = get_member($login_id);
	} else {
		$mb = array();
	}
}

// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.

if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
    alert('가입된 회원아이디가 아니거나 비밀번호가 틀립니다.');
}

// 차단된 아이디인가?
if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
    alert('회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date);
}

// 탈퇴한 아이디인가?
if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
    alert('탈퇴된 아이디입니다.\n탈퇴일 : '.$date);
}

/*******************************
티대리 분양플랫폼
*******************************/
if ($mb['mb_level'] == "9" && $mb['mb_use'] != "Y") {
	// 1) 대리점 : 승인여부 확인
	alert('관리자 승인이 되지 않은 대리점입니다.');

} else {
	// 2) 기사/회원 : 
	if ((int)$mb['mb_level'] < 9) {
		// 2.1) 상위 대리점의 승인여부 확인
		$rs = sql_fetch("SELECT mb_use FROM g5_member WHERE mb_no = '{$mb['agency_no']}'");
		$agency_use_chk = $rs['mb_use'];

		if ($agency_use_chk != "Y") {
			alert('관리자 승인이 되지 않은 대리점입니다.');
		}

		// 2.2) 회원 승인여부 확인 (200727추가)
		switch ($mb['mb_user_auth']) {
			case "2" : alert('관리자 승인이 되지 않은 회원입니다.');
			case "3" : alert('해당 회원은 퇴사신청 처리중으로 로그인이 불가능합니다.');
			case "4" : alert('퇴사완료된 아이디 입니다.');
		}
	}
}

/*
if ($config['cf_use_email_certify'] && !preg_match("/[1-9]/", $mb['mb_email_certify'])) {
    $ckey = md5($mb['mb_ip'].$mb['mb_datetime']);
    confirm("{$mb['mb_email']} 메일로 메일인증을 받으셔야 로그인 가능합니다. 다른 메일주소로 변경하여 인증하시려면 취소를 클릭하시기 바랍니다.", G5_URL, G5_BBS_URL.'/register_email.php?mb_id='.$mb_id.'&ckey='.$ckey);
}
*/
@include_once($member_skin_path.'/login_check.skin.php');


// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

// 포인트 체크
if($config['cf_use_point']) {
    $sum_point = get_point_sum($mb['mb_id']);

    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);
}

// 자동로그인
$auto_login = 1;

// 3.26
// 아이디 쿠키에 한달간 저장
if ($auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 한달간 저장
	//$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
	$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
    set_cookie('ck_auto', $key, 86400 * 31 * 9999);
	//set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
	//set_cookie_app('mb_id', $mb['mb_id'], 86400);
}

if ($url) {
    // url 체크
    check_url_host($url);

    $link = urldecode($url);
    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&amp;";
    else
        $split= "?";

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    foreach($_POST as $key=>$value) {
        if ($key != 'mb_id' && $key != 'mb_password' && $key != 'x' && $key != 'y' && $key != 'url') {
            $link .= "$split$key=$value";
            $split = "&amp;";
        }
    }
} else  {
    $link = G5_URL;
}

//goto_url($link);

// 앱토큰 존재하면 업데이트
$app_token = get_session('ss_app_token');
// 로그아웃후 구워놓은 토큰쿠키가 있으면 (재로그인시)
if ($app_token == "" && get_cookie('cc_app_token')) $app_token = get_cookie('cc_app_token');
if ($app_token != "") {
    // mb_id 기존토큰 초기화 (선택사항)
    sql_query("UPDATE g5_fcm_token SET mb_id = '' WHERE mb_id = '{$mb['mb_id']}'");
    // 새토큰 업데이트
    $sql = "UPDATE g5_fcm_token SET mb_id = '{$mb['mb_id']}' WHERE token = '{$app_token}'";
    if (sql_query($sql)) {
        set_cookie('cc_app_token', '', 0);
        set_session('ss_app_token', $app_token);
    }
}

include_once(G5_THEME_PATH.'/head.sub.php');
?>
<script>
    <?php if($is_inapp && $aos_ver > 1) { ?>
    // AOS인앱이면 자동로그인 데이터저장
    saveMemberInfo("<?=$mb['mb_id']?>");
    <?php } ?>

    history.replaceState({data: "replaceState"}, "", g5_url + "/index.php");
    location.href = "<?=$link?>";
</script>
<?
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
