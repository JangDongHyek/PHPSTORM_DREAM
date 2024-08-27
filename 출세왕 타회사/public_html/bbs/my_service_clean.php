<?php
$sub_id = "my_service_clean";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$req = $_REQUEST ;

$is_mypage = "my_service_clean";
$g5['title'] = '예약하기';
include_once('./_head.php');

include_once($member_skin_path.'/my_service_clean.skin.php');

include_once('./_tail.php');
?>
