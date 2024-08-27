<?php
$sub_id = "my_service_end";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$sql = "select * ,cw.up_datetime up_datetime,cw.cw_idx cw_idx,cw.ma_id ma_id
from {$g5['car_wash_table']} cw

where cw.mb_id = '{$member["mb_id"]}' and cw.cw_step = 2 
order by cw.cw_idx desc
";
$end_result = sql_query($sql);


$is_mypage = "my_service_end";
$g5['title'] = '완료된 서비스';
include_once('./_head.php');

include_once($member_skin_path.'/my_service_end.skin.php');

include_once('./_tail.php');
?>
