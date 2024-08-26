<?php
$sub_id = "my_order";
include_once('./_common.php');

$g5['title'] = '주문서';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}


//직접입력 일 경우
$pta_idx = ($_REQUEST["pta_idx"] == "pta_write_price") ? $_REQUEST["pta_write_price"] : $_REQUEST['pta_idx'];


$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)) .'-'.$_REQUEST['ta_idx'].'-'.$pta_idx;

$sql = "select * from new_talent where ta_idx = '{$_REQUEST['ta_idx']}' ";
$ta = sql_fetch($sql);
$mb = get_member($ta['mb_id']);
// 재능 등록 이미지 (첫번째 이미지)
$file_sql = " select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$_REQUEST['ta_idx']} order by bf_datetime limit 1 ";
$file_row = sql_fetch($file_sql);

if (empty($ta)){
    alert('올바른 방식으로 접근해주세요.', G5_URL);
}

$sql = "select * from new_pay_talent where pta_idx = '{$_REQUEST['pta_idx']}' ";
$pta = sql_fetch($sql);

$pta_info = "";
if ($pta['pta_info'] == 1){
    $pta_info = 'STANDARD';
}elseif ($pta['pta_info'] == 2){
    $pta_info = 'DELUXE';
}elseif ($pta['pta_info'] == 3){
    $pta_info = 'PREMIUM';
}else{
    $pta_info = '직접입력';
}


//직접입력 일 경우
if ($_REQUEST["pta_idx"] == "pta_write_price"){
    $pta['pta_title'] = "직접입력";
    $pta['pta_content'] = "판매자와 상의 후 가격을 입력 후 결제해주세요.";
    $pta['pta_pay'] = $_REQUEST["pta_write_price"];

}

if ($member['mb_id'] == $mb['mb_id'] && !$private){
    alert('본인의 게시물을 구매할 수 없습니다.', G5_BBS_URL.'/item_view.php?idx='.$_REQUEST['ta_idx']);
}


include_once($member_skin_path.'/my_order.skin.php');

include_once('./_tail.php');
?>