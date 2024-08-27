<?php
$sub_id = "my_service_ok";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/
if ($_REQUEST['cdt'] != 4) {
    $sql = "select * from {$g5['car_wash_table']} where cw_idx = '{$_REQUEST["idx"]}' ";
    $view = sql_fetch($sql);
}else{
    $sql = "select * from new_company_car_wash where cc_idx = '{$_REQUEST["idx"]}' ";
    $view = sql_fetch($sql);
}

if ($view['mb_id'] != $member['mb_id'] && $member['mb_id'] != 'admin' ){
    alert('올바른 경로로 접속해주세요.',G5_URL.'/index.php','error');
}

// 23.04.20 쿠폰관련 총금액
$pay = $money_list[$view['car_date_type']."".$view['car_size']];
//$in_pay = $view['car_in_yn'] == 'Y' ? '10000': "";
//$final_pay = $pay + $in_pay;
$final_pay = number_format($view['final_pay']);

$in_pay = $view['car_in_yn'] == 'Y' ? '+ 내부세차 '.number_format($in_pay).'원': "";


$is_mypage = "my_service_ok";
$g5['title'] = '예약완료';
include_once('./_head.php');

include_once($member_skin_path.'/my_service_ok.skin.php');

include_once('./_tail.php');
?>
