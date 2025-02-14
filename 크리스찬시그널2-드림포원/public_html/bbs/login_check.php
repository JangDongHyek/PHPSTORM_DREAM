<?php
include_once('./_common.php');

$auto_login = 1;

$g5['title'] = "로그인 검사";

$mb_id       = trim($_POST['mb_id']);
$mb_password = trim($_POST['mb_password']);

if (!$mb_id || !$mb_password)
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_id);


// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.

// 차단된 아이디인가?
if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
    alert('회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date);
}

// 탈퇴한 아이디인가?
if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
    alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
}

if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
    alert('가입된 회원아이디가 아니거나 비밀번호가 틀립니다.\\n비밀번호는 대소문자를 구분합니다.');
}

if ($config['cf_use_email_certify'] && !preg_match("/[1-9]/", $mb['mb_email_certify'])) {
    $ckey = md5($mb['mb_ip'].$mb['mb_datetime']);
    confirm("{$mb['mb_email']} 메일로 메일인증을 받으셔야 로그인 가능합니다. 다른 메일주소로 변경하여 인증하시려면 취소를 클릭하시기 바랍니다.", G5_URL, G5_BBS_URL.'/register_email.php?mb_id='.$mb_id.'&ckey='.$ckey);
}



@include_once($member_skin_path.'/login_check.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// 회원번호 세션 생성
set_session('ss_mb_no', $mb['mb_no']);
// 회원 프로필 승인 세션 생성
set_session('ss_mb_approval', $mb['mb_approval']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

// 포인트 체크
if($config['cf_use_point']) {
    $sum_point = get_point_sum($mb['mb_id']);

    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);
}

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
	set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
	set_cookie_app('mb_id', $mb['mb_id'], 86400);
}

// 21.03.08 푸시알림
if(!empty($token)) {
    $sql = "select * from g5_fcm where mb_id = '{$_POST['mb_id']}'";
    $result = sql_query($sql);
    if (sql_num_rows($result)) {
        $sql = "update g5_fcm set token='$token' where mb_id = '{$_POST['mb_id']}' ";
    } else {
        $sql = "insert g5_fcm set mb_id = '{$_POST['mb_id']}', token='$token'";
    }
    sql_query($sql);
}

if ($url) {
    // url 체크
    check_url_host($url);

    // 관리자로 로그인 시 관리자페이지로
    if($mb_id == 'admin' || $mb_id == 'lets080') {
        $link = G5_ADMIN_URL;
    }
    else {
        /*// 프로필 심사 중일 시 프로필 작성완료 페이지로 이동
        if ($mb['mb_approval_request'] == 'Y' && $mb['mb_approval'] == 'N') {
            $link = G5_BBS_URL . '/my_profile_end.php';
        }
        // 프로필 미작성 시 회원가입완료 페이지로 이동
        else if($mb['mb_approval_request'] == 'N') {
            $link = G5_BBS_URL . '/register_result.php';
        }
        else {
            $link = urldecode($url);
        }*/

        $link = urldecode($url);
    }

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

if ($mb["mb_update_yn"] == "N"){

    $link = G5_BBS_URL."/register_form?w=u&update_yn=N";
    alert("임시비밀번호로 로그인 후 비밀번호를 수정해주세요.", $link);
}
goto_url($link);
?>
