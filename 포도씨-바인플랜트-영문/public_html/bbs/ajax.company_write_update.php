<?php
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'company_inquiry', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'company_inquiry', G5_DIR_PERMISSION);

//print_r($_FILES);exit;
//print_r($_REQUEST);

// ci_open ==> open : 전체공개 / private : 선택공개

if($w == "") { // 등록
    $sql = " insert into g5_company_inquiry set mb_id = '{$member['mb_id']}', target_mb_no = '{$target_mb_no}', ci_type = '{$ciTypes}', ci_vessel = '{$ci_vessel}', ci_imo_no = '{$ci_imo_no}', 
             ci_subject = '{$ci_subject}', ci_deadline_date = '{$ci_deadline_date}', ci_category = '{$ci_category}', ci_maker = '{$ci_maker}', ci_model = '{$ci_model}', 
             ci_serial_no = '{$ci_serial_no}', ci_contents = '{$ci_contents}', ci_open = '{$ci_open}', ci_budget = '{$ci_budget}', ci_delivery_to = '{$ci_delivery_to}', ci_password = '{$ci_password}', ci_state = 'Processing Submission', podosea = '{$podosea}', wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);
    $idx = sql_insert_id();
}
else if($w == 'u') { // 수정
    // 등록된 견적이 있으면 수정 불가
    $cnt = selectCount('g5_company_estimate', 'company_inquiry_idx', $idx, '', '');
    if($cnt != 0) die('fail');

    $sql = " update g5_company_inquiry set ci_type = '{$ciTypes}', ci_vessel = '{$ci_vessel}', ci_imo_no = '{$ci_imo_no}', 
             ci_subject = '{$ci_subject}', ci_deadline_date = '{$ci_deadline_date}', ci_category = '{$ci_category}', ci_maker = '{$ci_maker}', ci_model = '{$ci_model}', 
             ci_serial_no = '{$ci_serial_no}', ci_contents = '{$ci_contents}', ci_open = '{$ci_open}', ci_budget = '{$ci_budget}', ci_delivery_to = '{$ci_delivery_to}', ci_password = '{$ci_password}', up_datetime = '".G5_TIME_YMDHIS."' where idx = {$idx}";
    $result = sql_query($sql);
}
else { // 삭제
    // 견적 수
    $cnt = selectCount('g5_company_estimate', 'company_inquiry_idx', $idx, '', '');
    if($cnt != 0) die('fail'); // 이미 받은 견적이 있음 / 받은 견적 있으면 삭제 불가

    $sql = " update g5_company_inquiry set del_yn = 'Y' where idx = '{$idx}' ";
    $result = sql_query($sql);
}

if($w == '' || $w == 'u') {
    // 23.05.16 RFQ Content
    // content 삭제
    $contentIdxArr = implode(',', $contentIdx);
    sql_query("DELETE FROM g5_company_inquiry_content WHERE idx NOT IN ({$contentIdxArr})");

    // // 등록된 esitamte에서도 삭제 및 total_cost 업데이트 ==> 등록된 estimate가 있으면 수정 불가
    // $estimateInfo = sql_fetch("SELECT estimate_idx, sum(line_cost) as totalCost FROM g5_company_estimate_content WHERE inquiry_content_idx IN ({$contentIdxArr})");
    // sql_query("DELETE FROM g5_company_estimate_content WHERE inquiry_content_idx NOT IN ({$contentIdxArr})");
    // sql_query("UPDATE g5_company_estimate SET total_cost = '{$estimateInfo['totalCost']}' WHERE idx = '{$estimateInfo['estimate_idx']}'");

    for($i=0; $i<count($description); $i++) {
        if(empty($contentIdx[$i])) {
            $sql = " INSERT INTO g5_company_inquiry_content SET mb_id = '{$member['mb_id']}', inquiry_idx = '{$idx}', description = '{$description[$i]}', reference = '{$reference[$i]}', part_no = '{$partNo[$i]}', quantity = '{$quantity[$i]}', uom = '{$uom[$i]}' ";
        } else {
            $sql = " UPDATE g5_company_inquiry_content SET description = '{$description[$i]}', reference = '{$reference[$i]}', part_no = '{$partNo[$i]}', quantity = '{$quantity[$i]}', uom = '{$uom[$i]}', up_datetime = '".G5_TIME_YMD."' WHERE idx = '{$contentIdx[$i]}' ";
        }
        sql_query($sql);
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
