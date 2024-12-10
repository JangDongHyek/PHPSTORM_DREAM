<?
// 예금주 성명조회 (예금주명, 은행, 계좌번호로만 조회)
include_once('../common.php');

$g5['title'] = '예금주 성명조회';
include_once(G5_THEME_PATH.'/head.php');

$url = "https://www.arspay.co.kr/acctInterfaceJson.acct";

$post_data = array();
$post_data["merchantNo"] = INNO_ACC_MID;
$post_data["licenseKey"] = INNO_ACC_KEY;
$post_data["serviceMethod"] = "01";
$post_data["bankCd"] = "032";
$post_data["iacctNo"] = "092120588417";
$post_data["iacctNm"] = "윤지영";

echo "<pre>";
print_r($post_data);
echo "</pre>";

$headers = array("content-type: application/json"); 

//배열을 JSON데이터로 생성 
$json = json_encode($post_data); 

//CURL함수 사용 
$ch=curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
curl_setopt($ch, CURLOPT_TIMEOUT, 999);		// sec

$response = curl_exec($ch); 

if(curl_error($ch)){ 
	$curl_data = null; 
} else {
	$curl_data = $response; 
} 

curl_close($ch);

// print_r($curl_data);

$decode = json_decode($response, true);
echo "<pre>";
print_r($decode);
echo "</pre>";


include_once(G5_THEME_PATH.'/tail.php');
?>