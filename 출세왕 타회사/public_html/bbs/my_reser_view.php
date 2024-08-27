<?php
$sub_id = "my_reser_view";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$sql = "select * from {$g5['car_wash_table']} where cw_idx = '{$_REQUEST["idx"]}' and mb_id = '{$member['mb_id']}' ";
$view = sql_fetch($sql);

$sql = "select * from {$g5['board_file_table']} where wr_id = '{$_REQUEST['idx']}' and bo_table = 'car_wash' ";
$result = sql_query($sql);
$cnt = sql_num_rows($result);


$sql = "select * from {$g5['board_file_table']} where wr_id = '{$view['rw_idx']}' and bo_table = 're_car_wash' ";
$re_result_file = sql_query($sql);
$re_cnt = sql_num_rows($re_result_file);


$sql = "select * from new_re_car_wash where cw_idx = '{$view["cw_idx"]}' and rw_step = 2 order by complete_datetime asc";
$re_result_array = sql_query($sql);
$sql = "select * from new_re_car_wash where rw_idx = {$view["rw_idx"]}  order by complete_datetime asc";
$re_result = sql_fetch($sql);

$sql = "select * from new_complete_history where cw_idx = '{$_REQUEST["idx"]}' and update_yn = 'N' order by ch_idx asc";
$complete_result=sql_query($sql);

if (empty($view)){
    alert("올바른 경로로 접속해주세요", G5_URL,'error');
}
$back_url= "";
if ($view['cw_step'] != 3){
    $back_url = "/my_reser.php";
}else{
    $back_url = "/my_reser_end.php";
}

$is_mypage = "my_reser_view";
$g5['title'] = '예약내역';
include_once('./_head.php');

include_once($member_skin_path.'/my_reser_view.skin.php');

include_once('./_tail.php');
?>
