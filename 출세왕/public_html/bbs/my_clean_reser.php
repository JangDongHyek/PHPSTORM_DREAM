<?php
$sub_id = "my_clean_reser";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$sql = "select * from {$g5['cleanup_table']} where mb_id = '{$member['mb_id']}' order by cu_idx desc ";
$result = sql_query($sql);

$is_mypage = "my_clean_reser";
$g5['title'] = '청소신청내역';
include_once('./_head.php');

include_once($member_skin_path.'/my_clean_reser.skin.php');

include_once('./_tail.php');
?>
