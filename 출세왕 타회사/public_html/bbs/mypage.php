<?php
$sub_id = "mypage";
include_once('./_common.php');
include_once(G5_LIB_PATH.'/shop.lib.php'); //쿠폰관련 include

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

// 23.04.21 쿠폰 관련 wc             and od_id <= '0' 이거빼줌
$sql = " select *
         from {$g5['g5_shop_coupon_table']}
         where mb_id IN ( '{$member['mb_id']}', '전체회원' )
            and cp_method = '2'
            and cp_start <= '".G5_TIME_YMD."'
            and cp_end >= '".G5_TIME_YMD."'
         ";
$coupon_result = sql_query($sql);
$coupon_cnt = sql_num_rows($coupon_result);

$is_mypage = "mypage";
$g5['title'] = '마이페이지';
include_once('./_head.php');

include_once($member_skin_path.'/mypage.skin.php');

include_once('./_tail.php');
?>
