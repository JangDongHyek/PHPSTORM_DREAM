<?php
include_once('./_common.php');

$google = $_REQUEST;
$url = "";
$mb = get_member($google['id']);

//회원이면 로그인
if ($mb["mb_id"] != "") {

    if ($mb['mb_sns'] != 'google'){
        alert("같은 이메일로  회원가입한 이력이 있습니다. 다른 sns로 접근해주세요.",G5_URL);
    }

    // 탈퇴한 아이디인가?
    if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
        alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
    }

    set_session('ss_mb_id', $mb["mb_id"]);
    set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
    set_session('ss_mb_no', $mb["mb_no"] );
    set_session('ss_sns', 'Y' );

    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
    set_cookie('ck_auto', $key, 86400 * 31 * 9999);
    set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);


    $url =  G5_URL;



    //아닐경우 회원가입
}else{

    set_session('ss_check_mb_id', $google['id']);
    set_session('ss_sns', 'google' );
    set_session('chk_birth', $google['mb_birthday'] ); //앱으로 구글 회원가입 시 생년월일 안넘어옴.
    set_session('chk_name', $google['mb_name'] );
    $url =  G5_BBS_URL . '/register_form.php?sns=Y';


}

echo $url;
