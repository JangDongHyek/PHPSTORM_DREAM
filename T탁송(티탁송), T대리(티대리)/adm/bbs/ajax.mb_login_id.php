<?php
/************************************************
소속대리점 회원로그인용 코드생성 (아이디 자동부여)
- 관리자페이지
- 앱
************************************************/
include_once('./_common.php');

$agency_no = preg_replace("/[^0-9]*/s", "", $agency_no);
$mb_hp = preg_replace("/[^0-9]*/s", "", $mb_hp);

// 아이디 자동생성
$result = getMemberCode($agency_no, $mb_hp);


// 앱 회원가입이면 세션추가
if ($reg_page == "app" && $result['result'] == true) {

	include_once(G5_LIB_PATH.'/register.lib.php');

	$mb_id = $result['login_id'];
	set_session('ss_check_mb_id', '');

	//if ($msg = empty_mb_id($mb_id))     die($msg);
	//if ($msg = valid_mb_id($mb_id))     die($msg);
	//if ($msg = count_mb_id($mb_id))     die($msg);
	//if ($msg = reserve_mb_id($mb_id))   die($msg);
	if ($msg = exist_mb_id($mb_id)) {	// 중복조회
		$result['result'] = false;
		$result['msg'] = "";
	}

	set_session('ss_check_mb_id', $mb_id);
}

echo json_encode($result);
?>