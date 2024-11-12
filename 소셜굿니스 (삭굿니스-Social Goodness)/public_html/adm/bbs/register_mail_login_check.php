<?php
include_once('./_common.php');

$g5['title'] = "로그인 검사";
include_once('./_head.php');

$mb_email = trim($_POST['mb_email']);
$mb_password = trim($_POST['mb_password']);

if (!$mb_email || !$mb_password)
    alert('이메일이나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_email);

// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.

if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
    alert('가입된 회원이 아니거나 비밀번호가 틀립니다.\\n비밀번호는 대소문자를 구분합니다.');
}

// 회원 상태 : 차단 , date_format 적용 안되어 substr로 변경
if ($mb['mb_state'] == '차단') {
    alert('회원님의 이메일은 차단 처리 되었습니다.\n처리일 : '.substr($mb['mb_state_date'],0,-9));
}

// 해지 완료 : 해지 , date_format 적용 안되어 substr로 변경
if ($mb['mb_cancel'] == '해지 완료') {
    alert('회원님의 이메일은 해지 완료 처리 되었습니다.\n처리일 : '.substr($mb['mb_cancel_date'],0,-9));
}

//@include_once($member_skin_path.'/register_mail.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
set_session('ss_mb_email', $mb['mb_email']);
// 20.08.10 추가
set_session('ss_mb_no', $mb['mb_no']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

// 20.08.13 로그인 시 로그인 일자가 매월 1일인 경우 소멸 BTM 55 BTM으로 초기화
// 금일이 1일인지 확인 후 1일이면
// mb_btm_volatility 55 BTM 초기화
// 누적 BTM 55 BTM 추가
if(date('d') == '01') {
    // 금일 지급 여부 확인
    $today = date('Y-m-d');
    $sql = " select count(*) as count from g5_btm_history where date_format(btm_date, '%Y-%m-%d') = '{$today}' and btm_column = 'mb_btm_volatility' and mb_no = {$_SESSION['ss_mb_no']}; ";
    $count = sql_fetch($sql);
    $count = $count['count'];

    if($count == 0)
    {
        $sql = " update {$g5['member_table']} set mb_btm_volatility = 55, mb_btm_accumulate = mb_btm_accumulate + 55 where mb_no = {$_SESSION['ss_mb_no']}; ";
        sql_query($sql);

        // btm DB에 변동이 있을 경우 history 추가
        $sql = " insert into g5_btm_history set mb_no = {$_SESSION['ss_mb_no']}, btm_column = 'mb_btm_volatility', btm = 55, btm_content = '소멸 BTM 지급', btm_date = now(); ";
        sql_query($sql);

        $sql = " insert into g5_btm_history set mb_no = {$_SESSION['ss_mb_no']}, btm_column = 'mb_btm_accumulate', btm = 55, btm_content = '소멸 BTM 지급', btm_date = now(); ";
        sql_query($sql);
    }
}

// 포인트 체크
//if($config['cf_use_point']) {
//    $sum_point = get_point_sum($mb['mb_id']);
//
//    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
//    sql_query($sql);
//}

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
    $link = G5_URL.'/index.php';
}

goto_url($link);
?>