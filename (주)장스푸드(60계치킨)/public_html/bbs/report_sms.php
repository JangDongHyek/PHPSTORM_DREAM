<?php
include_once('./_common.php');
include_once('../lib/sms.lib.php');

/*********************************
	글등록시 휴대폰 인증
*********************************/

$sa_hp = $_GET["number"];					// 휴대폰 번호
$sa_hp = str_replace("-", "", $sa_hp);

switch($mode){
	case "request" :	// 1) 인증번호 요청

		$sa_authNo = fnRandomString(6);									// 인증번호 (6자리)
		$sa_expDate = date("Y-m-d H:i:s", strtotime("+5 minutes"));		// 만료 (5분)

		// 등록된 번호가 있다면 삭제
		$sql = "DELETE FROM g5_sms_auth WHERE sa_hp = '{$sa_hp}'";
		sql_query($sql);

		// 인증번호 발급
		$sql = "INSERT INTO g5_sms_auth SET 
				bo_table = '{$bo_table}',
				sa_hp = '{$sa_hp}',
				sa_authNo = '{$sa_authNo}',
				sa_expDate = '{$sa_expDate}'
				";
		$insResult = sql_query($sql);

		$resultArr = ["result" => $insResult, "authNo" => $sa_authNo, "expDate" => $sa_expDate];

		// 인증번호 발송
		$sendNumber = "0260117050";
		$msg = "[60계치킨] 인증번호는 [".$sa_authNo."]입니다.";

		$smsResult = goJangsSMS($sa_hp, $sendNumber, $msg, $sa_authNo, $bo_table);
		$resultArr["result"] = $smsResult;

		break;

	case "confirm" :	// 2) 인증번호 확인

		// 만료된 데이터 삭제 (전체)
		$sql = "DELETE FROM g5_sms_auth WHERE sa_expDate < '".date("Y-m-d H:i:s")."'";
		sql_query($sql);

		// 인증번호 조회
		$sql = "SELECT sa_authNo FROM g5_sms_auth 
				WHERE bo_table = '{$bo_table}' AND sa_hp = '{$sa_hp}'
				ORDER BY idx DESC LIMIT 0, 1";
		$row = sql_fetch($sql);
		$sa_authNo = $row["sa_authNo"];

		if($sa_authNo == $authChkNo) { 
			$resultArr = ["result" => true, "no" => $sa_authNo];	

		} else { 
			$resultArr = ["result" => false, "no" => $sa_authNo];
		}

		break;
}

// return
echo json_encode($resultArr, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);



// 인증번호 생성
function fnRandomString($leng = 6){
	$chars = "0123456789";
	$charsLength = strlen($chars);
	$randomStr = "";

	for ($i = 0; $i < $leng; $i++){
		$randomStr .= $chars[rand(0, $charsLength - 1)];
	}
	return $randomStr;
}

?>