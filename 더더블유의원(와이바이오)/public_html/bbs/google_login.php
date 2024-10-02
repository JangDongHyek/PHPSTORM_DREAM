<?php
include_once('./_common.php');

$mb_level = 2;
$mb_datetime=date("Y-m-d H:i:s");

$sql="select * from g5_member where mb_id='$mb_id'";
$row=sql_fetch($sql);


$is_member=$row[mb_id]?true:false;
if($mb_id){
	// 로그인 회원일 경우
	if( $is_member === true){
		$sql="update g5_member set 
						mb_email='$mb_email'
						where mb_id='$mb_id'";
				sql_query($sql);
	}
	// 새로 가입일 경우
	else{
		$sql="insert g5_member set 
				mb_id='$mb_id',
				mb_name='$mb_name',
				mb_email='$mb_email',
				mb_level='$mb_level',
				mb_datetime='$mb_datetime'";
		sql_query($sql);
	}
	$mb=get_member($mb_id);
	// 회원아이디 세션 생성
	set_session('ss_mb_id', $mb['mb_id']);
	// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
}

// state 초기화 

	header("Location: /");
?>