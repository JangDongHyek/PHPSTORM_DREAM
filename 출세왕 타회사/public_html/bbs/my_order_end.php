<?php
$sub_id = "my_order_end";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$filter = $_REQUEST['filter'];
if($filter==""){$filter = 3;}

$id = "ma_id";

$sql_where = "";
if ($filter == 3){
    $sql_where = "car_date_type = 3";
}else if($filter == 5){
    $sql_where = "car_date_type = 5";
}else{
    //정기세차는 1,2
    $sql_where = "car_date_type < 3" ;
}

// 23.05.08 재작업건만
$rw_idx_check = $_REQUEST['rw_idx_check'];
if($rw_idx_check){
    $filter = 99;
    $sql_where = "car_date_type <= 5" ;
    //$sql_where .= " and ( rw.rw_step = 2 )" ;
}else{
    //$sql_where .= " and rw.rw_step = 0 " ;
}

$sql = "select *,cw.cw_idx cw_idx,cw.complete_datetime cw_complete_date from {$g5['car_wash_table']}  cw
LEFT join new_re_car_wash rw on cw.rw_idx = rw.rw_idx
where ".$id." = '{$member['mb_id']}' and (cw_step = 2 or (rw_step = 2 and is_turn_yn = 'N' )) and {$sql_where} order by cw.cw_idx desc ";

$order_result = sql_query($sql);


$is_mypage = "my_order_end";
$g5['title'] = '완료작업';
include_once('./_head.php');

include_once($member_skin_path.'/my_order_end.skin.php');

include_once('./_tail.php');
?>
