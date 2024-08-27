<?php
$sub_id = "my_money_view";
include_once('./_common.php');

if(!$_REQUEST["idx"]){
	alert("올바른 방법으로 이용해주세요.");
}

$sql = " select cw.* from {$g5['car_wash_table']} cw
                left join g5_member mem on cw.ma_id = mem.mb_id
                 where cw_idx = '{$_REQUEST["idx"]}'";
$view = sql_fetch($sql);

$qstr = '';
$qstr .= '&amp;ma_step=' . urlencode($_REQUEST["ma_step"]);
$qstr .= '&amp;car_date_type=' . urlencode($_REQUEST["car_date_type"]);
$qstr .= '&amp;complete_datetime=' . urlencode($_REQUEST["complete_datetime"]);


$sql = "select * from new_re_car_wash where cw_idx = '{$view["cw_idx"]}' and rw_step = 2 order by complete_datetime asc";
$re_result_array = sql_query($sql);

$sql = "select * from new_complete_history where cw_idx = '{$_REQUEST["idx"]}' and update_yn = 'N' order by ch_idx asc";
$complete_result=sql_query($sql);


$is_mypage = "my_money_view";
$g5['title'] = '정산내역';
include_once('./_head.php');

include_once($member_skin_path.'/my_money_view.skin.php');

include_once('./_tail.php');
?>
