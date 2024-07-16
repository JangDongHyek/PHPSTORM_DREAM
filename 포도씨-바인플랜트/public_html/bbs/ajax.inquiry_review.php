<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 기업의뢰 - 미체결 사유 or 거래 후기 or 감사 인사 작성 (ajax) **/
/** 
 * 미체결 사유는 의뢰 회사 => 견적 보낸 회사 
 * 거래 후기는 의뢰 회사 => 견적 보낸 회사
 * 감사 인사는 견적 보낸 회사 => 의뢰 회사
 */

$ci = sql_fetch(" select * from g5_company_inquiry where idx = '{$idx}' "); // 의뢰 정보

if($mode == 'no') { // 미체결 사유 작성
    $type = '미체결';

    // 견적을 제출한 모든 기업에 미체결 정보 저장
    $estimate_arr = array();
    $rlt = sql_query(" select * from g5_company_estimate where company_inquiry_idx = '{$idx}' order by idx ");
    while($rs = sql_fetch_array($rlt)) {
        array_push($estimate_arr, $rs['idx']);
    }
    $estimate_idx = implode(',', $estimate_arr);

    $sql_common = ", review = '{$checked}' ";
}
if($mode == 'select') { // 거래 후기 작성, 작성 완료 시 거래 회사 변경 불가능
    $type = '거래후기';

    if(empty($idx) || empty($estimate_idx)) {
        alert('오류가 발생하였습니다.\n다시 진행해 주세요.');
    }

    // 거래 상대 회사 아이디
    $estimate_mb_id = sql_fetch(" select * from g5_company_estimate where idx = '{$estimate_idx}' ")['mb_id'];
    // 선택된 거래 상대 회사에 거래 후기 보내기
    $sql_common = ", estimate_mb_id = '{$estimate_mb_id}', star_score = '{$star_score}', review = '{$checked}' ";

    // ==선택 받지 못한 회사의 견적은 상태-미체결로 업데이트 / 선택 된 회사의 견적은 상태-거래완료로 업데이트
    sql_query(" update g5_company_estimate set ce_state = '거래완료' where idx = '{$estimate_idx}' ");
    sql_query(" update g5_company_estimate set ce_state = '미체결' where idx != '{$estimate_idx}' and company_inquiry_idx = '{$idx}' ");
    // 선택 받은 회사 제외, 견적을 제출한 모든 기업에 미체결 정보 저장 (미체결 사유 - 타사 견적 선택으로 저장)
    $no_estimate_arr = array();
    $rlt = sql_query(" select * from g5_company_estimate where idx != '{$estimate_idx}' and company_inquiry_idx = '{$idx}' order by idx ");
    while($rs = sql_fetch_array($rlt)) {
        array_push($no_estimate_arr, $rs['idx']);
    }
    $no_estimate_idx = implode(',', $no_estimate_arr);

    if(!empty($no_estimate_arr)) {
        sql_query(" insert into g5_company_inquiry_result set type = '미체결', inquiry_mb_id = '{$member['mb_id']}', inquiry_idx = '{$idx}', estimate_idx = '{$no_estimate_idx}', review = 4, review_etc = '타사 견적 선택', wr_datetime = '" . G5_TIME_YMDHIS . "' ");
    }
    // ==//선택 받지 못한 회사의 견적은 상태-미체결로 업데이트 / 선택 된 회사의 견적은 상태-거래완료로 업데이트
}
if($mode == 'reselect') { // 거래 회사 재선택
    $result = sql_query("update g5_company_estimate set ce_selection = null where company_inquiry_idx = '{$idx}' ");
    if($result) {
        echo 1;
        exit;
    }
}
if($mode == 'thanks') { // 감사 인사 작성
    $type = '감사인사';

    $ce = sql_fetch(" select * from g5_company_estimate where idx = '{$estimate_idx}' "); // 견적 정보
    $sql_common = ", estimate_mb_id = '{$estimate_mb_id}' ";

//    if(!$is_admin) {
//        // 벙커 - 감사 인사를 전달한 회사에게 벙커 지급 == 의뢰 회사에게 지급
//        $msg = bunkerHistory($member['mb_id'], '차감', $bunker, '벙커로 감사 인사 전달 ('.$ci['mb_id'].')', $ci['mb_id'], 'g5_company_estimate', $estimate_idx); // 견적 회사 차감
//        if(!$msg) {
//            echo 'no_bunker';
//            exit;
//        } else {
//            bunkerHistory($ci['mb_id'], '적립', $bunker, '벙커로 감사 인사 전달 ('.$ce['mb_id'].')', $member['mb_id'], 'g5_company_estimate', $estimate_idx); // 의뢰 회사 지급
//        }
//    }
}
$sql = " insert into g5_company_inquiry_result set type = '{$type}', mb_id = '{$member['mb_id']}', inquiry_mb_id = '{$ci['mb_id']}', inquiry_idx = '{$idx}', estimate_idx = '{$estimate_idx}', review_etc = '{$etc}', bunker = '{$bunker}', wr_datetime = '".G5_TIME_YMDHIS."' {$sql_common} ";
$result = sql_query($sql);
$rlt_idx = sql_insert_id();

if($result) {
    // 푸시
    if($mode == 'select') { //  거래후기
        // 거래 후기 작성 시 상대 견적 회사에 푸시
        $push_status = "review";
        $push_data = array('subject'=>$ci['ci_subject'], 'url'=>G5_BBS_URL."/mypage_company_detail02.php?idx=".$estimate_idx, 'ref_idx'=>$rlt_idx, 'ref_table'=>'g5_company_inquiry_result', 'mb_id'=>$estimate_mb_id);
        @include_once(G5_BBS_PATH.'/send_push.php');
    }
    else if($mode == 'thanks') { // 감사인사
        // 감사 인사 작성 시 상대 의뢰 회사에 푸시
        $push_status = "thanks";
        $push_data = array('url'=>G5_BBS_URL."/mypage_company_detail01.php?idx=".$idx, 'ref_idx'=>$rlt_idx, 'ref_table'=>'g5_company_inquiry_result', 'mb_id'=>$ci['mb_id']);
        @include_once(G5_BBS_PATH.'/send_push.php');
    }
    echo 1;
    exit;
}