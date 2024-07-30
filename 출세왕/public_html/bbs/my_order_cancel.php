<?php
$sub_id = "my_order_cancel";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/


$sql = "select * from {$g5['car_wash_table']} where cw_step = 3 and ma_id = '{$member["mb_id"]}' order by up_datetime desc ";
$cancel_result = sql_query($sql);

$is_mypage = "my_order_cancel";
$g5['title'] = '취소작업';
include_once('./_head.php');


include_once($member_skin_path.'/my_order_cancel.skin.php');

include_once('./_tail.php');
?>
