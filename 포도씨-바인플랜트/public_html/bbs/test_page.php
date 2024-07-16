<?php
include_once('./_common.php');

// phpinfo();
// $_apiURL = "https://public-prime.qa4.meshdev.io/api/delivery/submit_fee";
// $_header = array("apikey: NLcymsxDAbKhbrmW", "secret: ZITqsTBqgg5EbxuwZrEGriVnmP4E3zbW", "Content-Type: application/json");
// $_data = array(
//     "branch_code"=> "JLK1234",
//     "dest_address"=> "서울시 강남구 삼성동 6",
//     "dest_address_detail"=> "현대아파트 101동 101",
//     "dest_address_road"=> "서울시 강남구 학동로64길 14",
//     "dest_address_detail_road"=> "현대아파트 101동 101",
//     "dest_lat"=> "37.1234",
//     "dest_lng"=> "128.1234"
// );
//
// $oCurl = curl_init();
// curl_setopt($oCurl, CURLOPT_URL, $_apiURL);
// curl_setopt($oCurl, CURLOPT_POST, 1);
// curl_setopt($oCurl, CURLOPT_HTTPHEADER, $_header);
// curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
// curl_setopt ($oCurl, CURLOPT_POSTFIELDS, http_build_query($_data));
//
//
// $ret = curl_exec($oCurl);
// if ($ret === FALSE) {
//     die('Curl failed: ' . curl_error($oCurl));
// }
// curl_close($oCurl);
//
//
// // JSON 문자열 배열 변환
// $retArr = json_decode($ret);
//
// print_r($retArr);
?>
<!--<script>
    fetch("https://api-test.meshprime.com/api/delivery/submit_fee", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "apikey": "Tdfesfer4Eb09DIf",
            "secret": "kF83whKkuef37yo3rjp0er32rh7YgYf8"
        },
        body: JSON.stringify({

        }),
    })
    .then((response) => console.log(response))
    .then((data) => console.log(data));
</script>-->
