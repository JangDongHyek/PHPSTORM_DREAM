<?php
$sub_id = "item_view";
include_once('./_common.php');

$g5['title'] = '재능상품';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
//if (!$is_member){
//    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
//}

$idx = $_GET['idx'];

// 재능 기본 정보
$sql = " select * from {$g5['talent_table']} where ta_idx = {$idx} ";
$ta = sql_fetch($sql);

if (empty($ta)){
    alert("존재하지 않는 재능입니다.", G5_URL);
}
//총작업 수
$sql = " select count(*) cnt from {$g5['talent_table']} where mb_id = '{$ta['mb_id']}' ";
$member_cnt = sql_fetch($sql)['cnt'];
//의뢰인 만족도
$sql = "select IF(avg(rating) is null,'없음',CONCAT (avg(rating),'점')) as avg from new_payment_review pr left join {$g5['talent_table']} ta on ta.ta_idx = pr.ta_idx where ta.mb_id = '{$ta['mb_id']}' ";
$member_avg= sql_fetch($sql)['avg'];

//글쓴이 회원정보 및 프로필
$mb = get_member($ta['mb_id']);
$sql = "select * from new_profile where mb_id = '{$ta['mb_id']}' ";
$profile = sql_fetch($sql);
$certificate_arr = explode(',',$profile['pf_certificate']);
//print_r($certificate_arr);

// 재능 가격 정보 (standatd)
$sql = " select * from {$g5['pay_talent_table']} where ta_idx = {$idx} and pta_info = 1 ";
$pta_st = sql_fetch($sql);

// 재능 가격 정보 (deluxe)
$sql = " select * from {$g5['pay_talent_table']} where ta_idx = {$idx} and pta_info = 2 ";
$pta_de = sql_fetch($sql);

// 재능 가격 정보 (premium)
$sql = " select * from {$g5['pay_talent_table']} where ta_idx = {$idx} and pta_info = 3 ";
$pta_pr = sql_fetch($sql);

// 재능 등록 이미지 -- main
$main_file_count = sql_fetch(" select count(*) as count from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$idx}; ")['count'];
$main_file_sql = " select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$idx} order by bf_no ";
$main_file_result1 = sql_query($main_file_sql);
$main_file_result2 = sql_query($main_file_sql);

// 재능 등록 이미지 -- sub
$sub_file_sql = " select * from {$g5['board_file_table']} where bo_table = 'sub_talent' and wr_id = {$idx} order by bf_no ";
$sub_file_result = sql_query($sub_file_sql);

//자주하는 질문과 답변
$sql = " select * from new_talent_qna where ta_idx = {$idx} ";
$qna_result = sql_query($sql);

//취소 및 환불규정 팝업
$sql = "select * from new_cancel_rule where cr_category1 = {$ta['ta_category1']} and cr_use = 1 ";
$popup_result = sql_fetch($sql);

//프로필 이미지
$mb_dir = substr($ta['mb_id'],0,2);
$dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $ta['mb_id'] . '.jpg';
$dest_url = G5_DATA_URL . '/member/' . $mb_dir . '/' . $ta['mb_id'] . '.jpg';

// 서비스 평가글
$review_count = sql_fetch(" select count(*) as count from new_payment_review as re left join g5_member as mb on mb.mb_id = re.mb_id where re.ta_idx = {$idx} ")['count'];
$review_avg = sql_fetch(" select avg(re.rating) as avg from new_payment_review as re left join g5_member as mb on mb.mb_id = re.mb_id where re.ta_idx = {$idx} ")['avg'];

$sql = " select re.*, mb.mb_nick from new_payment_review as re left join g5_member as mb on mb.mb_id = re.mb_id where re.ta_idx = {$idx} order by wr_datetime desc limit 0, 5 ";
$review_result = sql_query($sql);

//탈퇴한 사용자 일 경우 게시물 접근 X
if($mb['mb_8'] == 2){
    alert("탈퇴한 사용자가 올린 글이므로 해당 게시물에 접근할 수 없습니다.");
}

include_once($member_skin_path.'/item_view.skin.php');

include_once('./_tail.php');
?>