<?php
include_once('./_common.php');

// 기업검색 - 기업미니홈피 - 문의하기 INSERT
$sql = " insert into g5_company_question set mb_no = {$mb_no}, mb_id = '{$member['mb_id']}', email = '{$email}', subject = '{$subject}', contents = '{$contents}', state = '처리중', wr_datetime = '".G5_TIME_YMDHIS."' ";
$result = sql_query($sql);
$idx = sql_insert_id();

if($idx) {
    // 문의하기 등록 시 해당 기업회원에게 푸시
    $push_status = "question";
    $push_data = array('subject'=>$subject, 'url'=>G5_BBS_URL."/mypage_inquiry_corp.php", 'ref_idx'=>$idx, 'ref_table'=>'g5_company_question', 'mb_no'=>$mb_no);
    @include_once(G5_BBS_PATH.'/send_push.php');
}

die($result);
?>