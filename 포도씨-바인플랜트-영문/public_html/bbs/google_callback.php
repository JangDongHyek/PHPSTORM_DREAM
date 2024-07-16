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
        alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
    }

    // 자동로그인
    if ($is_inapp) {
        echo '<script>window.Android.updateLoginInfo("'.$mb['mb_id'].'");</script>';
    }

    set_session('ss_mb_id', $mb["mb_id"]);
    set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
    set_session('ss_sns', 'google');

    goto_url(G5_URL);
}
else { // 회원아니면 회원가입 페이지로 이동
    alert('회원 정보가 없습니다.\n회원 가입을 완료해 주세요.', G5_BBS_URL.'/register.php?id='.$id.'&email='.$email.'&sns=google', false);
    //goto_url(G5_BBS_URL.'/register.php?id='.$id.'&email='.$email.'&sns=kakao');
}