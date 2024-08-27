<?php
$sub_id = "my_service_clean_ok";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$sql = "select * from {$g5['cleanup_table']} where cu_idx = '{$_REQUEST["idx"]}' ";
$view = sql_fetch($sql);

//SH
//echo $sql;
//exit;

if ($view['mb_id'] != $member['mb_id'] && $member['mb_id'] != 'admin' ){
    alert('올바른 경로로 접속해주세요.',G5_URL.'/index.php','error');
}



$is_mypage = "my_service_clean_ok";
$g5['title'] = '예약완료';
include_once('./_head.php');

include_once($member_skin_path.'/my_service_clean_ok.skin.php');

include_once('./_tail.php');
?>
