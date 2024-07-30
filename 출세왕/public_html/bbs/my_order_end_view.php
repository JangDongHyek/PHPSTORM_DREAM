<?php
$sub_id = "my_order_end_view";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/
$sql = "select * from {$g5['car_wash_table']} where cw_idx = '{$_REQUEST["idx"]}' ";
$view = sql_fetch($sql);

$sql = "select * from {$g5['board_file_table']} where wr_id = '{$_REQUEST['idx']}' and bo_table = 'car_wash' ";
$result = sql_query($sql);
$cnt = sql_num_rows($result);

$sql = "select * from new_re_car_wash where cw_idx = '{$view["cw_idx"]}' and rw_step = 2 order by complete_datetime asc";
$re_result_array = sql_query($sql);

$sql = "select * from new_complete_history where cw_idx = '{$_REQUEST["idx"]}' and update_yn = 'N' order by ch_idx asc";
$complete_result=sql_query($sql);


if (empty($view)){
    alert("올바른 경로로 접속해주세요", G5_URL,'error');
}

$is_mypage = "my_order_end_view";
$g5['title'] = '완료작업';
include_once('./_head.php');

include_once($member_skin_path.'/my_order_end_view.skin.php');

include_once('./_tail.php');
?>
