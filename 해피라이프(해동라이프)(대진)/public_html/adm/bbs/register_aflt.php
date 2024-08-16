<?php
/****************************************
제휴사 회원가입
****************************************/
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

if( $provider && function_exists('social_nonce_is_valid') ){   //모바일로 소셜 연결을 했다면
    if( social_nonce_is_valid(get_session("social_link_token"), $provider) ){  //토큰값이 유효한지 체크
        $w = 'u';   //회원 수정으로 처리
        $_POST['mb_id'] = $member['mb_id'];
    }
}

if ($w == "") {
    // 회원 로그인을 한 경우 회원가입 할 수 없다
    // 경고창이 뜨는것을 막기위해 아래의 코드로 대체
    // alert("이미 로그인중이므로 회원 가입 하실 수 없습니다.", "./");
    if ($is_member) {
		session_unset(); // 모든 세션변수를 언레지스터 시켜줌
		session_destroy(); // 세션해제함

		// 자동로그인 해제 --------------------------------
		set_cookie('ck_mb_id', '', 0);
		set_cookie('ck_auto', '', 0);

        // goto_url(G5_URL);
    }

    $g5['title'] = '제휴사 회원가입';
} 

//include_once('./_head.php');
include_once(G5_THEME_PATH.'/head.sub.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';

add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

include_once($member_skin_path.'/register_aflt.skin.php');
//include_once('./_tail.php');
include_once(G5_THEME_PATH.'/tail.sub.php');
?>