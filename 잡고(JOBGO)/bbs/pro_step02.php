<?php
$sub_id = "pro_step02";
include_once('./_common.php');


if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}


$ta_idx = $_GET['ta_idx'];

// standard
$sql = " select pt.*,ta.mb_id,ta.ta_imsi from {$g5['pay_talent_table']} pt left join {$g5['talent_table']} ta on pt.ta_idx = ta.ta_idx where pt.ta_idx = {$ta_idx} and pta_info = 1 ";
$pta_st = sql_fetch($sql);

if (!$pta_st && $ta['ta_imsi'] == 'N'){
    alert('존재하지 않는 공모전 입니다.', G5_URL);
}

if ($member['mb_id'] != $pta_st['mb_id'] && isset($pta_st)){
    alert('올바른 접근 방식이 아닙니다.', G5_URL);
}

// deluxe
$sql = " select * from {$g5['pay_talent_table']} where ta_idx = {$ta_idx} and pta_info = 2 ";
$pta_de = sql_fetch($sql);

// premium
$sql = " select * from {$g5['pay_talent_table']} where ta_idx = {$ta_idx} and pta_info = 3 ";
$pta_pr = sql_fetch($sql);


$is_mypage = "pro_step02";
$g5['title'] = '재능상품 등록';
include_once('./_head.php');

include_once($member_skin_path.'/pro_step02.skin.php');

include_once('./_tail.php');
?>
