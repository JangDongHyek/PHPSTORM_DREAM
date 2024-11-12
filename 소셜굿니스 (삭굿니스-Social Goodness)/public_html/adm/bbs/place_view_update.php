<?php
include_once('./_common.php');

$mb_no = $_POST['mb_no'];
$te_no = $_POST['te_no'];
$finger_option = $_POST['finger_option'];
$mb_btm = $_POST['mb_btm'] + 5; // 평가 완료 보상 5 BTM 추가

if(!$mb_no)
    alert('올바른 방법으로 이용해 주십시오.', G5_URL);

// 평가 이력 있는지 확인
$eval_sql = " select count(*) as count from g5_place_eval where mb_no = {$mb_no} and te_no = {$te_no} ";
$eval_row = sql_fetch($eval_sql);
$eval_count = $eval_row['count'];

// 평가를 수정할 수 없도록 처리
//if($eval_count > 0) {
//    // 평가 있을 경우 평가 점수 수정
//    $sql = " update g5_place_eval set finger_option = {$finger_option}, eval_date = now() where mb_no = {$mb_no} and te_no = {$te_no} and category = '평가'; ";
//    $result = sql_query($sql);
//}

// 현재 보유 BTM, 총 누적 리워드 BTM, 총 누적 BTM에 보상 BTM + 평가 완료 보상 5 BTM 추가
$sql = " update g5_member set mb_btm = mb_btm + {$mb_btm}, mb_btm_reward = mb_btm_reward + {$mb_btm}, mb_btm_accumulate = mb_btm_accumulate + {$mb_btm} where mb_no = {$mb_no}; ";
$result = sql_query($sql);

$sql = " insert into g5_place_eval set category = '평가', mb_no = {$mb_no}, te_no = {$te_no}, finger_option = {$finger_option}, eval_date = now(); ";
$result = sql_query($sql);

die($result);
?>