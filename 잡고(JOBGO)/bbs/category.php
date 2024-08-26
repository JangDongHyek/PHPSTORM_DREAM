<?php
$sub_id = "category";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$is_mypage = "category";
$g5['title'] = '상품카테고리';
include_once('./_head.php');

include_once($member_skin_path.'/category.skin.php');

include_once('./_tail.php');
?>
