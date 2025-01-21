<?php
$sub_id = "my_money_view";
include_once('./_common.php');


//echo $_SESSION['ss_mb_id'];

//$sql = "select * from new_payment where userId = '{$_SESSION['ss_mb_id']}'";
//$dan_pay_query = sql_query($sql);

/*
$qstr = '';
$qstr .= '&amp;ma_step=' . urlencode($_REQUEST["ma_step"]);
$qstr .= '&amp;car_date_type=' . urlencode($_REQUEST["car_date_type"]);
$qstr .= '&amp;complete_datetime=' . urlencode($_REQUEST["complete_datetime"]);


$sql = "select * from new_re_car_wash where cw_idx = '{$view["cw_idx"]}' and rw_step = 2 order by complete_datetime asc";
$re_result_array = sql_query($sql);

$sql = "select * from new_complete_history where cw_idx = '{$_REQUEST["idx"]}' and update_yn = 'N' order by ch_idx asc";
$complete_result=sql_query($sql);
*/

$is_mypage = "my_payment";
$g5['title'] = '결제내역';
include_once('./_head.php');

include_once($member_skin_path.'/my_payment2.skin.php');

include_once('./_tail.php');
?>
