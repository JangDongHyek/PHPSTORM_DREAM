<?php
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'company_inquiry', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'company_inquiry', G5_DIR_PERMISSION);

//print_r($_FILES);exit;
//print_r($_REQUEST);

// ci_open ==> open : 전체공개 / private : 선택공개

if($w == "") { // 등록
    $sql = " insert into g5_company_inquiry set mb_id = '{$member['mb_id']}', target_mb_no = '{$target_mb_no}', ci_type = '{$ci_type}', ci_vessel = '{$ci_vessel}', ci_imo_no = '{$ci_imo_no}', 
             ci_subject = '{$ci_subject}', ci_deadline_date = '{$ci_deadline_date}', ci_category = '{$ci_category}', ci_maker = '{$ci_maker}', ci_model = '{$ci_model}', 
             ci_serial_no = '{$ci_serial_no}', ci_contents = '{$ci_contents}', ci_open = '{$ci_open}', ci_budget = '{$ci_budget}', ci_delivery_to = '{$ci_delivery_to}', ci_password = '{$ci_password}', 
             ci_state = '접수대기', podosea = '{$podosea}', wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);
    $idx = sql_insert_id();

    if(!empty($target_mb_no)) {
        // 기업미니홈피에서 바로의뢰 시 해당 기업회원에게 푸시
        $push_status = "direct_inquiry";
        $push_data = array('subject'=>$ci_subject, 'url'=>G5_BBS_URL."/mypage_company03.php", 'ref_idx'=>$idx, 'ref_table'=>'g5_company_inquiry', 'mb_no'=>$target_mb_no);
        @include_once(G5_BBS_PATH.'/send_push.php');
    }
}
else if($w == 'u') { // 수정
    $sql = " update g5_company_inquiry set ci_type = '{$ci_type}', ci_vessel = '{$ci_vessel}', ci_imo_no = '{$ci_imo_no}', 
             ci_subject = '{$ci_subject}', ci_deadline_date = '{$ci_deadline_date}', ci_category = '{$ci_category}', ci_maker = '{$ci_maker}', ci_model = '{$ci_model}', 
             ci_serial_no = '{$ci_serial_no}', ci_contents = '{$ci_contents}', ci_open = '{$ci_open}', ci_budget = '{$ci_budget}', ci_delivery_to = '{$ci_delivery_to}', 
             ci_password = '{$ci_password}', up_datetime = '".G5_TIME_YMDHIS."' where idx = {$idx}";
    $result = sql_query($sql);
}
else { // 삭제
    // 견적 수
    $cnt = selectCount('g5_company_estimate', 'company_inquiry_idx', $idx);
    if($cnt == 0) {
        $sql = " update g5_company_inquiry set del_yn = 'Y' where idx = '{$idx}' ";
        $result = sql_query($sql);
    }
    else {
        die('fail'); // 이미 받은 견적이 있음 / 받은 견적 있으면 삭제 불가
    }
}

/*// 의뢰 상세 자료 파일 삭제
$del_file = explode(',', $del_file_idx);
for($i = 0; $i < count($del_file); $i++) {
    $sql = " select * from g5_company_inquiry_img where idx = {$del_file[$i]} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/company_inquiry/' . $row['img_file']);

    $sql = " delete from g5_company_inquiry_img where idx = {$del_file[$i]} ";
    sql_query($sql);
}*/

// 의뢰 상세 자료 파일 업로드
for($i=0; $i<count($_FILES['files']['name']); $i++) {
    if(!empty($_FILES['files']['name'])) {
        $tmp_file = $_FILES['files']['tmp_name'][$i];
        $filesize = $_FILES['files']['size'][$i];
        $filename = $_FILES['files']['name'][$i];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/company_inquiry/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 의뢰 상세 자료 DB INSERT
        $result = sql_query(" insert into g5_company_inquiry_img set company_inquiry_idx = {$idx}, img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
    }
}

if($result) {
    die('success');
}
?>