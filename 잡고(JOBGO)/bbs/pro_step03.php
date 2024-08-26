<?php
$sub_id = "pro_step03";
include_once('./_common.php');


if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}


$ta_idx = $_GET['ta_idx'];

$sql = " select * from {$g5['talent_table']} where ta_idx = {$ta_idx} ";
$ta = sql_fetch($sql);
if (!$ta){
    alert('존재하지 않는 공모전 입니다.', G5_URL);
}

if ($member['mb_id'] != $ta['mb_id']){
    alert('올바른 접근 방식이 아닙니다.', G5_URL);
}


$category1 = common_code($ta['ta_category1'],'code_idx','json');
$category1_name = $category1[0]['name'];

$category2_name = common_code($ta['ta_category2'],'code_idx','json');
$category2_name = $category2_name[0]['name'];
$category3_name = common_code($ta['ta_category3'],'code_idx','json');
$category3_name = $category3_name[0]['name'];

$sql = "select count(bf_idx) cnt from {$g5['board_file_table']} where wr_id = '{$ta_idx}' and bo_table = 'sub_talent' ";
$sub_img_cnt = sql_fetch($sql);

$sql = "select count(bf_idx) cnt from {$g5['board_file_table']} where wr_id = '{$ta_idx}' and bo_table = 'talent' ";
$img_cnt = sql_fetch($sql);

//취소 및 환불규정 팝업
$sql = "select * from new_cancel_rule where cr_category1 = {$category1[0]['idx']} and cr_use = 1 ";
$popup_result = sql_fetch($sql);

$is_mypage = "pro_step03";
$g5['title'] = '재능상품 등록';
include_once('./_head.php');

include_once($member_skin_path.'/pro_step03.skin.php');

include_once('./_tail.php');
?>
