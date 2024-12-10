<?php
/**
 * 카카오아이디로 로그인
 */

die();

include_once ("../common.php");

$rest_api_key = "311cbd76cb7e7d5f4f12d0647321b956";
$redirect_uri = "http://www.T탁송.com/test/kakao_oauth.php";
$code = $_GET['code'];

// 1) 사용자 토큰받기
$shell_string = "curl -v -X POST https://kauth.kakao.com/oauth/token -d 'grant_type=authorization_code' -d 'client_id={$rest_api_key}' -d 'redirect_uri={$redirect_uri}' -d 'code={$code}'";
$output = shell_exec($shell_string);
$token_json = json_decode($output, true);

/*
print_r($token_json);
Array
(
    [access_token] => SxHTQgsQ20BPxsmXWqqpFG0DyKVbNMlI6RDtlwo9dZwAAAF_YuONtA
    [token_type] => bearer
    [refresh_token] => wg6fY28k4zM6imZVEBkshnIbzbreh6USUHxbAwo9dZwAAAF_YuONsg
    [expires_in] => 21599
    [refresh_token_expires_in] => 5183999
)
*/

if (!$token_json['access_token']) {
    die("카카오 로그인에 실패했습니다. 다시 시도해 주세요.");
}

// 2) 사용자 정보받기
$shell_string = "curl -v -X POST https://kapi.kakao.com/v2/user/me -H 'Authorization: Bearer {$token_json['access_token']}'";
$output2 = shell_exec($shell_string);
$user_info_json = json_decode($output2, true);

print_r($user_info_json);
/*
 * Array
(
    [id] => 2149727001
    [connected_at] => 2022-03-07T05:39:14Z
)
 */


/*
// 1) 사용자 토큰받기
$shell_string = "curl -v -X POST https://kauth.kakao.com/oauth/token -d 'grant_type=authorization_code' -d 'client_id=" . $app_key . "' -d 'redirect_uri=" . $redirect_uri . "' -d 'code=" . $get_data['code'] . "'";
$output = shell_exec($shell_string);
$token_json = json_decode($output, true);
*/