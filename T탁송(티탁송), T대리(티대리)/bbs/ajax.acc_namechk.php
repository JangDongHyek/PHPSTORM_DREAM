<?php
/************************************************
이노페이 계좌실명인증
************************************************/
include_once('./_common.php');

$return_data = array();
$return_data['post'] = $_POST;
$return_data['result'] = "F";

$url = "Https://www.arspay.co.kr/AcctNmReq.acct";

$post_data = array();
$post_data["mid"] = INNO_ACC_MID;
$post_data["merkey"] = get_text(INNO_ACC_KEY);
$post_data["moid"] = time().getRandomString(4, "int");
$post_data["bankCode"] = $bankCode;
$post_data["acntNo"] = $acntNo;
$post_data["idNo"] = $idNo;
$post_data["acntNm"] = $acntNm;

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

$decode = json_decode($response, true);

// 조회결과 DB등록
$return_data['list'] = $decode;
$return_data['err_msg'] = "계좌인증에 실패하였습니다.";

if ($decode['tid'] != "") {
	$sql = "INSERT INTO g5_pg_namechk SET
			tid = '{$decode['tid']}',
			moid = '{$decode['moid']}',
			reqDt = '{$decode['reqDt']}',
			bankCode = '{$decode['bankCode']}',
			acntNo = '{$decode['acntNo']}',
			acntNm = '{$decode['acntNm']}',
			resultAcntNm = '{$decode['resultAcntNm']}',
			resultCode = '{$decode['resultCode']}',
			resultMsg = '{$decode['resultMsg']}',
			transDt = '{$decode['transDt']}'
			";
	sql_query($sql);

	if ($decode['resultCode'] == "0000") {
		$return_data['result'] = "T";
	} else {
		//$return_data['err_msg'] = ($innopay_namechk_result[$decode['resultCode']])? $innopay_namechk_result[$decode['resultCode']] : "계좌인증에 실패하였습니다.";
		if ($innopay_namechk_result[$decode['resultCode']] != "") $return_data['err_msg'] = $innopay_namechk_result[$decode['resultCode']];
	}
}

echo json_encode($return_data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
exit;



//===================================TEST
/*
acntNm: "천지수"
acntNo: "79791096643"
bankCode: "090"
mid: "butdrivinm"
moid: "15973822208045"
reqDt: "20200814141700"
resultAcntNm: "천지수"
resultCode: "0000"
resultMsg: "정상처리"
tid: "butdrivinm20081414170022"
transDt: "20200814141701"
*/
$url = "Https://www.arspay.co.kr/AcctNmReq.acct";

$post_data = array();
$post_data["mid"] = "butdrivinm"; //INNOPAY_MID;
$post_data["merkey"] = get_text("BJQTPtoda47ieFmZgux2SCUGgk9LXDBcWRMqa3Wd/D5vVtfpW4KbBfq61n0H3cZdOD9V/XC6eNsE06HOGuiBg=="); //INNOPAY_KEY;
$post_data["moid"] = "TEST00001";
$post_data["bankCode"] = "032";
$post_data["acntNo"] = "092120588417";
$post_data["idNo"] = "890220";
$post_data["acntNm"] = "윤지영";

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

$decode = json_decode($response, true);
print_r($decode);

?>