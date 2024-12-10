<?php
/**************************************
포인트충전
1. 전용계좌 잔여개수 확인
2. 내 전용계좌 존재 : 정보리턴
3. 발급안됨 : 계좌매칭후 정보리턴
**************************************/
include_once('./_common.php');

$json = array();
$json['result'] = "F";
$json['err_msg'] = "전용계좌 발급에 실패하였습니다. 고객센터로 문의해 주세요. 1599-1009";
$json['post'] = $_POST;

// 1. 전용계좌 잔여개수 확인
$row = sql_fetch("SELECT COUNT(*) AS cnt FROM g5_acc_list WHERE mb_id = ''");
if ((int)$row['cnt'] == 0) {
	$json['err_msg'] = "전용계좌 부족으로 계좌발급에 실패하였습니다. 고객센터로 문의해 주세요. 1599-1009";
	echo json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	exit;
}

// 2. 내계좌 확인
$my_bank = getMemberVbankNo($mb_id);
if (count($my_bank) > 0) {
	$json['err_msg'] = "이미 발급된 전용계좌가 존재합니다.";

} else {
	// 3. 발급안됨
	$row = sql_fetch("SELECT min(idx) AS idx FROM g5_acc_list WHERE mb_id = ''");
	if ($row) {
		$sql = "UPDATE g5_acc_list SET mb_id = '{$mb_id}', matchDate = '".G5_TIME_YMDHIS."' WHERE idx = '{$row['idx']}'";
		// 발급완료
		if (sql_query($sql)) {
			$json['result'] = "T";
			$json['err_msg'] = "";
		}
	}
}

echo json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>