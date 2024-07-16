<?php
include_once('./_common.php');
/**
 * 구글 로그인 콜백
 */

$mb = sql_fetch(" select * from g5_member where sns = 'google' and sns_id = '{$id}' "); // 회원정보

// 회원이면 로그인
if (isset($mb['mb_id'])) {
    // 탈퇴한 아이디인가?
    if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
        alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date, G5_URL);
    }
    // 차단된 아이디인가?
    if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
        alert('회원님의 아이디는 이용이 금지되어 있습니다.\n처리일 : '.$date);
    }

    // 자동로그인
    if ($is_inapp) {
        echo '<script>window.Android.updateLoginInfo("'.$mb['mb_id'].'");</script>';
    }

    // 로그인 (aOS)
    set_session('ss_mb_id', $mb["mb_id"]);
    set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
    set_session('ss_sns', 'google');

    // 쿠키 - 자동로그인
    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
    set_cookie('ck_auto', $key, 86400 * 31 * 9999);
    set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);

    goto_url(G5_URL);
}
else { // 회원아니면 회원가입 페이지로 이동
    //alert('회원 정보가 없습니다.\n회원 가입을 진행해 주세요.', G5_BBS_URL.'/register_form.php?id='.$id.'&email='.$email.'&name='.$name.'&sns=google', false);
    if($_SESSION['join_check'] == 'login') {
        alert('회원 정보가 없습니다.\n회원 가입을 진행해 주세요.', G5_BBS_URL.'/register.php', false);
    } else {
        goto_url(G5_BBS_URL.'/register_form.php?id='.$id.'&email='.$email.'&name='.$name.'&sns=google');
    }
}