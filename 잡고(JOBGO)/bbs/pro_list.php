<?php
$sub_id = "pro_list";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$is_mypage = "pro_list";
$g5['title'] = '나의 재능상품';
include_once('./_head.php');

include_once($member_skin_path.'/pro_list.skin.php');

include_once('./_tail.php');
?>
