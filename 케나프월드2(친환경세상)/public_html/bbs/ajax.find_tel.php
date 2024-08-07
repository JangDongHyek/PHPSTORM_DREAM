<?php
include_once('./_common.php');

$wl_tel = $_GET['wl_tel'];

$result = array();

$sql = "select * from g5_member where mb_id = '{$wl_tel}' and mb_id != '{$member['mb_id']}'";
$mb = sql_fetch($sql);

if($mb){
	$result['success'] = true;
	$result['msg'] = $mb['mb_name']."님 회원이 맞습니까?";
}else{
	$result['success'] = false;
	$result['msg'] = "찾으시는 회원이 없습니다.";
}

echo json_encode($result);
?>