<?php
$sub_id = "my_reser_cancel";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/


$sql = "select * from {$g5['car_wash_table']} where mb_id = '{$member['mb_id']}' and cw_step = 3 order by up_datetime desc ";
$cancel_result = sql_query($sql);

$is_mypage = "my_reser_cancel";
$g5['title'] = '예약취소';
include_once('./_head.php');

include_once($member_skin_path.'/my_reser_cancel.skin.php');

include_once('./_tail.php');
?>
