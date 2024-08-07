<?php
include_once("./_common.php");

	$mb = get_member($id);
	if($mb['mb_id'] != ''){
	set_session('ss_mb_id', $mb['mb_id']);
	// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

	goto_url(G5_URL);
	}
	else{
		goto_url(G5_URL);
	}
?>
