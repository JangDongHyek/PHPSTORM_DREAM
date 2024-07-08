<?php
/**************************************** 
1. 회원정보찾기 
2. 회원가입시 인증번호
3. 임시비밀번호변경 후 return
****************************************/
include_once('./_common.php');

$result = array();
$result['mb_id'] = preg_replace("/[^0-9]*/s", "", $mb_id);	//-->mb_hp임
$result['mode'] = $mode;

// 회원정보조회
$row = sql_fetch(" SELECT COUNT(*) AS cnt FROM g5_member WHERE REPLACE(mb_hp, '-', '') = '{$mb_id}' AND mb_level != 10 ");
$cnt = (int)$row['cnt'];

$result['cnt'] = $cnt;

switch ($mode) {	
	case "find" :					// 1) 회원정보찾기
		if ($cnt == 0) {			// 1.1) 아이디정보 없음 -->찾기실패
			$result['msg'] = "등록되지 않은 아이디입니다.";
		} else {					// 1.2) 아이디정보 존재 -->인증번호발송
			$result['msg'] = "인증번호를 발송하였습니다.";
			$result['auth'] = getRandomString(6);

			// SMS발송
			$content = "[연인] 인증번호[".$result['auth']."]를 입력해 주세요.";
			//getSendSMS($content, $mb_id);
			goSms($mb_id, COMMON_SEND_NUM, $content);
		}
		break;

	case "join" :					// 2) 회원가입 인증번호
		if ($cnt == 0) {			// 2.1) 아이디정보 없음 -->인증번호발송
			$result['msg'] = "인증번호를 발송하였습니다.";
			$result['auth'] = getRandomString(6);

			// SMS발송
			$content = "[연인] 인증번호[".$result['auth']."]를 입력해 주세요.";
			//getSendSMS($content, $mb_id);
			goSms($mb_id, COMMON_SEND_NUM, $content);
		} else {					// 2.2) 아이디정보 존재 -->가입불가
			$result['msg'] = "이미 등록된 아이디입니다.";
		}
		
		break;

	case "modify" :					// 3) 임시비밀번호변경
		$result['rst'] = "F";	
		$result['msg'] = "임시비밀번호 변경에 실패하였습니다. 다시 시도해 주세요.";

		if ($mb_id != "") {
			$tmp_pass = getRandomString(6);
			$mb_password = get_encrypt_string($tmp_pass);
			$update_result = sql_query(" UPDATE g5_member SET mb_password = '{$mb_password}', mb_10 = '{$tmp_pass}' WHERE REPLACE(mb_hp, '-', '') = '{$mb_id}' ");

			if ($update_result) {
				$row2 = sql_fetch(" SELECT mb_id FROM g5_member WHERE REPLACE(mb_hp, '-', '') = '{$mb_id}' AND mb_level != 10 ");
				$result['mb_id'] = $row2['mb_id'];

				$result['rst'] = "T";
				$result['msg'] = "성공";
				$result['auth'] = $tmp_pass;
			} 
		} 
		break;
}


echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>