<?php
include_once('./_common.php');

if(!$is_admin && $member['mb_level'] < 3){
	alert('관리자 또는 임직원으로 로그인해주세요',G5_URL);
	exit;
}

$g5['title'] = '자주찾는 질문 카테고리 관리';
include_once('./_head.php');

include_once($member_skin_path.'/qc_write.skin.php');

include_once('./_tail.php');
?>
