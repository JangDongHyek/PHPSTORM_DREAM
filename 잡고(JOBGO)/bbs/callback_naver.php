<?php
include_once('./_common.php');
include_once("../jl/JlModel.php");

$client_id = "zLJRPBj6a8ai5kXgCYb4";
$client_secret = "SGOWXGbsL0";
$code = $_GET["code"];;
$state = $_GET["state"];;
$redirectURI = urlencode(G5_BBS_URL."/callback_naver.php");
$url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
$is_post = false;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = array();
$response = curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close ($ch);



if($status_code == 200) {
    $arr= json_decode($response, true);
    $token = $arr['access_token'];
    $refresh_token = $arr['refresh_token'];
    $header = "Bearer ".$token; // Bearer 다음에 공백 추가
    $url = "https://openapi.naver.com/v1/nid/me";
    $is_post = false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, $is_post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = array();
    $headers[] = "Authorization: ".$header;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $pr_response = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close ($ch);
    if($status_code == 200) {
        $pr_arr= json_decode($pr_response, true);
        $mb = get_member($pr_arr['response']['email']);

        //회원이면 로그인
        if (isset($mb["mb_id"])) {

            if ($mb['mb_sns'] != 'naver'){
                alert("같은 이메일로  회원가입한 이력이 있습니다. 다른 sns로 접근해주세요.",G5_URL);
            }

            // 탈퇴한 아이디인가?
            if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
                $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
                alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
            }

            // 로그인데이터 앱저장
            if ($android == true) {

                echo '
                <script>
                    window.Android.updateLoginInfo("'.$mb['mb_id'].'");
                </script>';
            }

            set_session('ss_mb_id', $mb["mb_id"]);
            set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
            set_session('ss_mb_no', $mb["mb_no"] );
            set_session('ss_sns', 'Y' );
            set_session('ss_naver_token', $refresh_token );
            set_session('ss_naver_token2', $token );

            $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
            set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
            set_cookie('ck_auto', $key, 86400 * 31 * 9999);
            set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);
            goto_url(G5_URL);
            //아닐경우 회원가입
        }else{

            //필수항목 체크하지 않았을 경우 틩겨냄.
            if (!$pr_arr['response']['email']) {
//                $shell_string = "curl -v -X POST https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&state=".$state."&redirect_uri=".G5_BBS_URL.'/login_sns.php'."&auth_type=reauthenticate -H 'Authorization: Bearer " . $token . "'";
//                shell_exec($shell_string);
                alert('필수 정보에 동의하지 않으셨습니다. 네이버 [내정보 > 보안설정 > 외부사이트연결] 페이지에서 '.$config["cf_title"].'의 연결을 해제 하신 후 다시 시도해 주세요.',G5_BBS_URL.'/login_sns.php' );
            }


            set_session('ss_check_mb_id', $pr_arr['response']['email']);
            set_session('chk_hp', $pr_arr['response']['mobile']);
            set_session('chk_birth', $pr_arr['response']['birthyear'].str_replace( '-' , '', $pr_arr['response']['birthday']));
            set_session('ss_sns', 'naver' );

            $model = new JlModel(array(
                "table" => "g5_member",
                "primary" => "mb_no",
                "autoincrement" => true,
                "empty" => false
            ));

            $obj = array(
                "mb_id" => $pr_arr['response']['email'],
                "mb_email" => $pr_arr['response']['email'],
                "mb_level" => 2,
                "mb_birth" => $pr_arr['response']['birthyear'].str_replace( '-' , '', $pr_arr['response']['birthday']),
                "mb_hp" => $pr_arr['response']['mobile'],
                "mb_name" => $pr_arr['response']['name'],
                "mb_adult" => 1,
                "mb_sns" => "naver",
                "mb_division" => 1,
                "mb_join_division" => 1,
                "mb_datetime" => "now()"
            );

            $model->insert($obj);

            $mb = get_member($pr_arr['response']['email']);

            // 로그인데이터 앱저장
            if ($android == true) {

                echo '
                <script>
                    window.Android.updateLoginInfo("'.$mb['mb_id'].'");
                </script>';
            }

            set_session('ss_mb_id', $mb["mb_id"]);
            set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
            set_session('ss_mb_no', $mb["mb_no"] );
            set_session('ss_sns', 'Y' );
            set_session('ss_naver_token', $refresh_token );
            set_session('ss_naver_token2', $token );

            $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
            set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
            set_cookie('ck_auto', $key, 86400 * 31 * 9999);
            set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);


            //goto_url(G5_BBS_URL . '/register_new_form.php?sns=Y');
            goto_url(G5_BBS_URL.'/register_result.php');
        }

    } else {
        if ($_REQUEST['error'] == 'access_denied'){
            goto_url(G5_BBS_URL.'/login.php');
        }else{
            alert($response."관리자에게 문의해주세요.",G5_URL);
        }
    }
//    $mb = get_member();
//    goto_url(G5_URL);
} else {
    if ($_REQUEST['error'] == 'access_denied'){
        goto_url(G5_BBS_URL.'/login.php');
    }else{
        alert($response."관리자에게 문의해주세요.",G5_URL);
    }
}