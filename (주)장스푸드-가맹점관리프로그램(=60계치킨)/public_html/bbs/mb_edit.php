<?php
include_once('./_common.php');

if(!$is_member){
	alert('로그인을 해주세요',G5_URL);
	exit;
}

$g5['title'] = '정보수정';
include_once('./_head.php');

include_once($member_skin_path.'/mb_edit.skin.php');

include_once('./_tail.php');
?>
