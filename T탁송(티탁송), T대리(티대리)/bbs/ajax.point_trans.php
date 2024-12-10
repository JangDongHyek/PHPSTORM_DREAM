<?php
/**************************************
포인트 출금신청
1. 출금가능금액 확인 (보유포인트 체크)
2. 송금요청 진행 (300원 수수료 차감후 입금)
3. 결과 : 출금신청 DB등록
	3.1 출금요청 성공 : 포인트차감 
	3.2 출금요청 실패
**************************************/
include_once('./_common.php');

$rst = array();
$rst['result'] = "F";
$rst['post'] = $_POST;
$rst['msg'] = "";

// 1. 출금가능금액 확인 (보유포인트 체크)
$chk_amt = preg_replace("/[^0-9]*/s", "", $amt);
$chk_point = point_calc($member['mb_id']);
//$rst['chk_amt'] = $chk_amt;
//$rst['chk_point'] = $chk_point;


if ((int)$chk_amt > (int)$chk_point) {
	//$rst['msg'] = "보유포인트가 부족합니다";
	//echo json_encode($rst, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	//exit;
}

// 2. 송금요청 진행 (300원 수수료 차감후 입금)
$url = "https://www.arspay.co.kr/AcctOutTransReq.acct";

$req_fee = 300;
//$req_amt = (int)$chk_amt - $req_fee;
$req_amt = (int)$chk_amt;
$post_data = array();
$post_data["mid"] = INNO_ACC_MID;
$post_data["merkey"] = INNO_ACC_KEY;
$post_data["moid"] = $moid;
$post_data["bankCode"] = $bankCode;
$post_data["acntNo"] = $acntNo;
$post_data["acntNm"] = $acntNm;
$post_data["amt"] = $req_amt;
$post_data["depAcntNo"] = INNO_DEP_ACCNO;
$post_data["depAcntNm"] = INNO_DEP_ACCNM;

//$rst['post_data'] = $post_data;

$headers = array("content-type: application/json"); 
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

// 3. 결과 DB등록
// 대외기관(은행)으로의 송금이체 요청 결과  (0000:정상)
$sql = "INSERT INTO g5_point_trans SET 
		mb_id = '{$member['mb_id']}',
		pt_tid = '{$decode['tid']}',
		pt_moid = '{$decode['moid']}',
		pt_reqDt = '{$decode['reqDt']}',
		pt_bankCode = '{$decode['bankCode']}',
		pt_acntNo = '{$decode['acntNo']}',
		pt_acntNm = '{$decode['acntNm']}',
		pt_amt = '{$decode['amt']}',
		pt_fee = '{$req_fee}',
		pt_depAcntNo = '{$decode['depAcntNo']}',
		pt_depAcntNm = '{$decode['depAcntNm']}',
		pt_resultCode = '{$decode['resultCode']}',
		pt_resultMsg = '{$decode['resultMsg']}',
		pt_transDt = '{$decode['transDt']}',
		pt_regdate = '".G5_TIME_YMDHIS."',
		pt_regdateTS = '".time()."'
		";
sql_query($sql);

if ($decode['resultCode'] == "0000") {
	// 3.1 출금요청 성공 : 포인트차감
	$rs = sql_fetch("SELECT idx FROM g5_point_trans WHERE mb_id = '{$member['mb_id']}' AND pt_tid = '{$decode['tid']}'");
	$rel_id = $rs['idx'];

	$po_content = "포인트 현금출금";
	point_update($member['mb_id'], 0, $chk_amt, $po_content, 'trans', $rel_id, 'point_trans', 0, $decode['tid']);
	$rst['result'] = "T";


} else {
	// 3.2 송금요청 실패
	$rst['msg'] = ($decode['resultMsg'] != "")? $decode['resultMsg'] : "포인트 출금신청에 실패하였습니다. 다시 시도해 주세요.";
}


echo json_encode($rst, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>