<?php
$sub_id = "my_reser_end";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/


$sql = "select * from new_car_wash 
where mb_id = '{$member['mb_id']}' and cw_step = 2 order by cw_idx desc ";
$cancel_result = sql_query($sql);

$is_mypage = "my_reser_end";
$g5['title'] = '완료내역';
include_once('./_head.php');

include_once($member_skin_path.'/my_reser_end.skin.php');

include_once('./_tail.php');
?>
