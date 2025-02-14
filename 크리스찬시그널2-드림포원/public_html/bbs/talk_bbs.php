<?php
$sub_id = "talk_bbs";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$is_mypage = "talk_bbs";
$g5['title'] = '시그널 Talk Talk';
include_once('./_head.php');

include_once($member_skin_path.'/talk_bbs.skin.php');

include_once('./_tail.php');
?>
