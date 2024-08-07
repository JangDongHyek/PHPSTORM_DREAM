<?php

error_reporting( E_ALL );
ini_set("display_errors", 1);

include_once('../common.php');
include_once(G5_LIB_PATH.'/CatchLoc.php');

use CatchLocSDK\CatchLoc;

$result = array('result' => false, 'msg' => '');

/* 기사 memberkey 정보 가져오기 */
$delivery_mb_id = $_POST['delivery_mb_id'];
$memberKey = getDeliveryInfo($delivery_mb_id)['driver_member_key'];

/* API키와 서버키를 SDK에 주입하여, SDK인스턴스를 초기화 합니다. */
$catchloc = new CatchLoc();

$catchloc->setApiKey(CatchApiKey);
$catchloc->setServerKey(CatchServerKey);


$response = $catchloc->getLastData($memberKey);
$info = json_decode($response, true);

/* items 정보 */
//protocol : JSON Object
//member_key : 조회대상 MEMBER_KEY
//name : 조회대상 이름
//latitude : 위도
//longitude : 경도
//accuracy : 위치 정확도(m)
//speed : 속도(km)
//odometer : 총 누적이동거리(m)
//location_date : 위치확인시간(Unix timestamp, milliseconds)

if($info['result'] == 'ok'){
    
    $result['data'] = $info['message'];
    
    /* 좌표로 현재 주소 반환 하기 */    
    $latitude = $result['data']['latitude']; // 위도
    $longitude = $result['data']['longitude']; // 경도
    
    $KakaoRestApiKey = KakaoRestApiKey;
    
    $url = "https://dapi.kakao.com/v2/local/geo/coord2address.json?x=$longitude&y=$latitude";
    $headers = array(
        "Authorization: KakaoAK $KakaoRestApiKey",
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $decoded_response = json_decode($response, true);
    $address = $decoded_response['documents'][0]['address']['address_name'];
    
    $result['data']['addr'] = $address;
    $result['data']['reg_date'] = getDateFormat2(date('Y-m-d H:i:s', ($result['data']['location_date'] / 1000))); /* timestamp 날짜 변환 */
    $result['result'] = true;
}else{
    $result['msg'] = "위치정보를 가져올 수 없습니다.";
    $result['errMsg'] = $info['message'];
}

die(json_encode($result));

?>