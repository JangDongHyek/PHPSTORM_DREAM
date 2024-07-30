<?php
$sub_id = "my_service";
include_once('./_common.php');
include_once(G5_LIB_PATH.'/shop.lib.php'); //쿠폰관련 include

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$cdt = $_REQUEST['cdt'];
$cs = $_REQUEST['cs'];

$sql = "select * from {$g5['car_table']} where mb_id = '{$member['mb_id']}'";
$car_result = sql_query($sql);

$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS));


// 23.04.21 쿠폰 관련 wc
$sql = " select *
         from {$g5['g5_shop_coupon_table']}
         where mb_id IN ( '{$member['mb_id']}', '전체회원' )
            and cp_method = '2'
            and od_id <= '0'
            and cp_start <= '".G5_TIME_YMD."'
            and cp_end >= '".G5_TIME_YMD."'
         ";
$coupon_result = sql_query($sql);
$coupon_cnt = sql_num_rows($coupon_result);

$sql = "select * from new_car_wash where mb_id = '{$member['mb_id']}' order by cw_idx desc limit 1";
$car_wash = sql_fetch($sql);

$is_mypage = "my_service";
$g5['title'] = '예약하기';
include_once('./_head.php');

include_once($member_skin_path.'/my_service.skin.php');

include_once('./_tail.php');
?>
