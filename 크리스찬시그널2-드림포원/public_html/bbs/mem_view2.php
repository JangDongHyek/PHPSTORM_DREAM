<?php
$sub_id = "mem_view2";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$mb_no = $_GET['mb_no'];

$sql = " select * from {$g5['member_table']} where mb_no = '{$mb_no}' ";
$mb = sql_fetch($sql);

$sql = " select * from g5_member_interview where mb_no = '{$mb_no}' ";
$mi = sql_fetch($sql);

$is_mypage = "mem_view2";
$g5['title'] = $mb['mb_nick'];
include_once('./_head.php');

include_once($member_skin_path.'/mem_view2.skin.php');

include_once('./_tail.php');
?>
