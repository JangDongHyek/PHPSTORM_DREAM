<?php
include_once('./_common.php');

if (isset($_SESSION['ss_mb_reg'])) {
    $mb = get_member($_SESSION['ss_mb_reg']);
} else if ($_GET['mb_id']) {
	$mb = get_member($_GET['mb_id']);
}

// 회원정보가 없다면 초기 페이지로 이동
if (!$mb['mb_id'])
    goto_url(G5_URL);


// 스코피 회원가입인 경우 리턴
if ((int)$mb['mb_group'] == 3) {
	$url = "http://app.skopi.com/skopi/event/happyLifeReturn.do?memberCd=".$mb['skopi_memberCd']."&seqNo=".$mb['skopi_seqNo'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	
	/*
	echo curl_errno($ch)."<br>";       //에러 정보 출력
	echo curl_error($ch)."<br>";       //에러 정보 출력
	var_dump($response);        //결과 값 출력
	print_r(curl_getinfo($ch)); //모든 정보 출력
	*/

	curl_close($ch);
}

$g5['title'] = '회원가입 완료';
include_once('./_head.php');
include_once($member_skin_path.'/register_result.skin.php');
include_once('./_tail.php');
?>