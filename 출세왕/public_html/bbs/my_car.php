<?php
$sub_id = "my_car";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$sql = "select * from {$g5['car_table']} where mb_id = '{$member['mb_id']}' order by car_type";
$car_result = sql_query($sql);

$is_mypage = "my_car";
$g5['title'] = '내 차량관리';
include_once('./_head.php');

include_once($member_skin_path.'/my_car.skin.php');

include_once('./_tail.php');
?>
