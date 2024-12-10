<?php
include_once ("../common.php");

die();

$json_string = '{"text":"안녕하세요. 개발자 민트의 블로그 입니다. 
부족하지만 같이 개발 공부 해요! ","date":"2022-03-10"}';
$json_string = str_replace(array("\n", "\r"), ' ', $json_string);

echo $json_string;
$decode = json_decode($json_string, true);

print_r($decode);
echo json_last_error();

die();

// 카카오 로그인
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>카카오 로그인</title>
        <style>
            button {
                border: 0;
                background: none;
            }
        </style>
    </head>
    <body>
    <button type="button" onclick="loginWithKakao()">
        <img src="https://k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg">
    </button>

    <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script><!-- SDK -->
    <script>
        Kakao.init('b86e26532d1e3783ade49a479eb64795'); // JavaScript 키 입력

        function loginWithKakao() {
            Kakao.Auth.authorize({
                redirectUri: 'http://www.T탁송.com/test/kakao_oauth.php',
            });
        }

    </script>
    </body>
    </html>


<?php
die();


// 암호화 함수 openssl_encrypt 를 사용하여 암복호화 사용하기!

//secured_encrypt('123');

$plaintext = "민트의 개발일지";

// 암호화
$enc = encrypt($plaintext);
echo $enc; // toPA9+syodaqqqpLKXflNwuJUuoEqCobB9GxTVfRgU0=

// 복호화
$dec = decrypt($enc);
echo $dec; // 민트의 개발일지


// 암호화
function encrypt($plaintext, $key = '')
{
    if (!$key) $key = "test-key";

    return base64_encode(openssl_encrypt($plaintext, "AES-256-CBC", $key, true, str_repeat(chr(0), 16)));
}

// 복호화
function decrypt($ciphertext, $key = '')
{
    if (!$key) $key = "test-key";

    return openssl_decrypt(base64_decode($ciphertext), "AES-256-CBC", $key, true, str_repeat(chr(0), 16));
}




die();

/*
// 현재 위치를 담은 배열
$parameter = array(
    'x' => 127.423084873712,
    'y'=>37.0789561558879,
    'input_coord'=>'WGS84'
);

// Request 정보
$host = "https://dapi.kakao.com/v2/local/geo/coord2address";
$api_key = "311cbd76cb7e7d5f4f12d0647321b956";
$headers = array("Authorization: KakaoAK {$api_key}");

$query = http_build_query($parameter);
$content_type = "json";

$opts = array(
    CURLOPT_URL => $host . '.' . $content_type . '?' . $query,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSLVERSION => 1,
    CURLOPT_HEADER => false,
    CURLOPT_HTTPHEADER => $headers
);

$curl_session = curl_init();
curl_setopt_array($curl_session, $opts);
$return_data = curl_exec($curl_session);

// 결과 배열로 변환
$decode = json_decode($return_data, true);

if (curl_errno($curl_session)) {
    // 통신 실패
    throw new Exception(curl_error($curl_session));
} else {
    // 성공
    curl_close($curl_session);
}
*/


//카카오 rest api 함수
function kakaoRestApi2($type, $parameter = array(), $content_type = 'json')
{
    // Request 정보
    $host = "https://dapi.kakao.com";
    $api_key = "311cbd76cb7e7d5f4f12d0647321b956";
    $headers = array("Authorization: KakaoAK {$api_key}");

    $query = http_build_query($parameter);
    $path = "";

    switch ($type) {
        case "coord2address" :      // 좌표로 주소변환
            $path = "/v2/local/geo/coord2address";
            break;

        case "address" :            // 주소 검색
            $path = "/v2/local/search/address";
            break;

        case "coord2regioncode" :   // 좌표로 행정구역정보 받기
            $path = "/v2/local/geo/coord2regioncode";
            break;

        default :
            // 올바른 API 구분이 아닌 경우 return;
            return array('api_result' => false, 'err_msg' => 'API 구분을 올바르게 입력해 주세요.');
    }

    $opts = array(
        CURLOPT_URL => $host . $path . '.' . $content_type . '?' . $query,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSLVERSION => 1,
        CURLOPT_HEADER => false,
        CURLOPT_HTTPHEADER => $headers
    );

    $curl_session = curl_init();
    curl_setopt_array($curl_session, $opts);
    $return_data = curl_exec($curl_session);

    // response 정보
    $decode = json_decode($return_data, true);

    if (curl_errno($curl_session)) {
        throw new Exception(curl_error($curl_session));
        $decode['api_result'] = false;
    } else {
        curl_close($curl_session);
        $decode['api_result'] = true;
    }

    return $decode;
}

$params = array(
    'query' => '서울시 종로구 효자로 12',
);

$test1 = kakaoRestApi2('address', $params);
print_r($test1);