<?php
$sub_id = "my_profile_end";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$mb_id = "";
if(!empty($_SESSION['ss_mb_id'] && $_SESSION['ss_mb_id'] != "")) {
    $mb_id = $_SESSION['ss_mb_id'];
} else {
    $mb_id = $_GET['mb_id'];
}

$sql = " select * from {$g5['member_table']} where mb_id = '{$mb_id}' ";
$mb = sql_fetch($sql);

$is_mypage = "my_profile_end";
$g5['title'] = '프로필 작성완료';
include_once('./_head.php');

include_once($member_skin_path.'/my_profile_end.skin.php');

include_once('./_tail.php');
?>
