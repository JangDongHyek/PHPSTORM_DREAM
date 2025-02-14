<?php
$sub_id = "my_profile03";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$mb_id = "";
if(!empty($_SESSION['ss_mb_id'])) {
    $mb_id = $_SESSION['ss_mb_id'];
} else {
    $mb_id = $_GET['mb_id'];
}

// 회원 기본정보
$sql = " select * from {$g5['member_table']} where mb_id = '{$mb_id}' ";
$mb = sql_fetch($sql);

$sql = "select * from new_member_interview where mb_id = '{$mb_id}' ";
$mi = sql_fetch($sql);


$is_mypage = "my_profile03";
$g5['title'] = '취미/관심사';
include_once('./_head.php');

include_once($member_skin_path.'/my_profile03.skin.php');

include_once('./_tail.php');
?>
