<?php
include_once("../common.php");
include_once("./__init.php");
/**
 * 카카오 로그인 콜백
 * https://developers.kakao.com/docs/latest/ko/kakaologin/rest-api
 */

if(empty($code)) die();

$redirect_uri = APP_URL.'/kakao_login_callback.php';
// 액세스 토큰과 리프레시 토큰을 발급받는 API
$shell_string = "curl -v -X POST https://kauth.kakao.com/oauth/token -d 'grant_type=authorization_code' -d 'client_id=".$kakao_javascript_key."' -d 'redirect_uri=".$redirect_uri."' -d 'code=".$code."'";
$output = shell_exec($shell_string);

$token = json_decode($output, true);
$access_token = $token['access_token'];

if (empty($access_token)) {
    alert('정보가 없습니다. 다시 시도해 주세요.',APP_URL.'/login.php');
}
else {
    // 사용자 정보 가져오는 API (엑세스 토큰 필요)
    $shell_string = "curl -v -X POST https://kapi.kakao.com/v2/user/me -H 'Authorization: Bearer ".$access_token."'";
    $u_output = shell_exec($shell_string);

    $p_arr = json_decode($u_output, true);
    $id = $p_arr['id'];
    $email = $p_arr['kakao_account']['email'];

    $mb = get_member($id.'@k');

    // 회원이면 로그인
    if (isset($mb['mb_id'])) {
        // 탈퇴한 아이디인가?
        if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
            $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
            alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
        }

        // 자동로그인 (AOS)
        if ($is_inapp) {
            echo '<script>window.Android.updateLoginInfo("'.$mb['mb_id'].'");</script>';
        }

        set_session('ss_mb_id', $mb["mb_id"]);
        set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
        set_session('ss_sns', 'kakao');

        // 쿠키-자동로그인
        $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
        set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
        set_cookie('ck_auto', $key, 86400 * 31 * 9999);
        set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);

        goto_url(APP_URL);
    }
    else { // 회원아니면 회원가입 페이지로 이동
        goto_url(APP_URL.'/register.php?id='.$id.'&email='.$email.'&sns=kakao');
    }
}
