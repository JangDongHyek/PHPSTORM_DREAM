<?php
/*******************************************************************************
이노페이 송금(입금이체) 결과 통보 처리
*******************************************************************************/
include_once('../common.php');
ini_set('allow_url_fopen', 'ON');
header('Content-Type: application/json; charset=UTF-8');

// 컨텐츠 타입이 JSON 인지 확인한다
if(!in_array('application/json', explode(';',$_SERVER['CONTENT_TYPE']))) {
	echo json_encode(array('mid'=>INNO_ACC_MID, 'tid'=>INNO_ACC_KEY, 'resultCode'=>'9999'));
	exit;
}
 
$json = file_get_contents("php://input");
$decode = json_decode($json, true);
 
$str[] = "";

foreach ($decode as $key=>$val) {
	$str[] = $key."=>".$val;
}
$str2 = implode("|", $str);

// DB등록
$sql = "INSERT INTO g5_point_trans_noti SET 
		tn_tid = '{$decode['tid']}', 
		tn_resultCode = '{$decode['resultCode']}',
		tn_resultMsg = '{$decode['resultMsg']}',
		tn_result = '".$str2."', 
		ip = '".$_SERVER['REMOTE_ADDR']."'
		";
$result = sql_query($sql);


// 이노페이서버로 응답
$response = array('mid'=>INNO_ACC_MID, 'tid'=>INNO_ACC_KEY);

if ($result) {
	$response['resultCode'] = '0000';
} else {
	//echo json_encode(array('mid'=>INNO_ACC_MID, 'tid'=>INNO_ACC_KEY, 'resultCode'=>'9999'));
	$response['resultCode'] = '9999'
}

echo json_encode($response);

?>