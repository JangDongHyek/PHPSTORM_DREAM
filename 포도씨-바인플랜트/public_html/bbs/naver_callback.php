<?php
include_once('./_common.php');
/**
 * 네이버 로그인 콜백
 * https://developers.naver.com/docs/login/api/api.md
 */

// 네이버 로그인 API (콜백)
$client_id = "OYo_HAmkzC766_xvReqe";
$client_secret = "Jn2FOVOByo";
$code = $_GET["code"];
$state = $_GET["state"];
$redirectURI = urlencode("https://www.podosea.kr/bbs/naver_callback.php");
$url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
$is_post = false;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = array();
$response = curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//echo "status_code:".$status_code;
curl_close ($ch);

if($status_code == 200) {
    //echo $response;

    // 회원 프로필 조회 API
    $arr = json_decode($response, true);
    $acc_token = $arr['access_token'];
    $refresh_token = $arr['refresh_token'];
    $header = "Bearer " . $acc_token; // Bearer 다음에 공백 추가
    $p_url = "https://openapi.naver.com/v1/nid/me";
    $is_post = false;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $p_url);
    curl_setopt($ch, CURLOPT_POST, $is_post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = array();
    $headers[] = "Authorization: ".$header;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $p_response = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //echo "status_code:".$status_code."<br>";
    curl_close ($ch);

    if($status_code == 200) {
        //echo $p_response;
        $p_arr = json_decode($p_response, true)['response'];

        /*// 필수 제공 항목 누락 시 동의 화면으로 이동
        $re_url = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&state=STATE_STRING&redirect_uri=".$redirectURI."&auth_type=reprompt";
        if(empty($p_arr['id']) || empty($p_arr['email']) || empty($p_arr['mobile']) || empty($p_arr['name'])) { // 이메일/이름/휴대번호 선택
            alert("필수 제공 항목이 누락되었습니다.\\n정보 제공에 동의해 주세요.", $re_url);
        }*/

        $id = $p_arr['id'];
        $email = $p_arr['email'];
        $mobile = $p_arr['mobile'];
        $name = $p_arr['name'];

        $mb = sql_fetch(" select * from g5_member where sns_id = '{$id}' "); // 회원정보

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

            // 자동로그인 (aOS)
            if ($is_inapp) {
                echo '<script>window.Android.updateLoginInfo("'.$mb['mb_id'].'");</script>';
            }

            // 로그인
            set_session('ss_mb_id', $mb["mb_id"]);
            set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
            set_session('ss_sns', 'naver');
            set_session('ss_sns_token', $acc_token);

            // 쿠키 - 자동로그인
            $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
            set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
            set_cookie('ck_auto', $key, 86400 * 31 * 9999);
            set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);

            goto_url(G5_URL);
        }
        else { // 회원아니면 회원가입 페이지로 이동
            //$mb_id = substr($p_arr['id'], 0, 10); // 네이버에서 넘어온 고유값 10자리 잘라서 사용 (중복 발생 시 아이디 뒤 랜덤한 문자 붙여줌)
            //alert('회원 정보가 없습니다.\n회원 가입을 진행해 주세요.', G5_BBS_URL.'/register_form.php?id='.$id.'&email='.$email.'&name='.$name.'&mobile='.$mobile.'&sns=naver&sns_token='.$acc_token, false);
            if($_SESSION['join_check'] == 'login') {
                alert('회원 정보가 없습니다.\n회원 가입을 진행해 주세요.', G5_BBS_URL.'/register.php', false);
            } else {
                if(empty($email)) {
                    alert('이메일 주소만 알려주시면 회원가입이 완료됩니다!', G5_BBS_URL.'/register_form.php?id='.$id.'&email='.$email.'&name='.$name.'&mobile='.$mobile.'&sns=naver&sns_token='.$acc_token, false);
                } else {
                    goto_url(G5_BBS_URL.'/register_form.php?id='.$id.'&email='.$email.'&name='.$name.'&mobile='.$mobile.'&sns=naver&sns_token='.$acc_token);
                }
            }
        }
    } else {
        echo "Error 내용:".$response;
    }
} else {
    echo "Error 내용:".$response;
}