<?php
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'company_estimate', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'company_estimate', G5_DIR_PERMISSION);

//print_r($_FILES);exit;
//print_r($_REQUEST);

// ci_open ==> open : 전체공개 / private : 선택공개

if(!empty($company_inquiry_idx)) {
    $ce_offer_price = str_replace(',', '', $ce_offer_price);
    $totalCost = str_replace(',', '', $totalCost);

    if($w == '') {
        $sql = " insert into g5_company_estimate set company_inquiry_idx = {$company_inquiry_idx}, mb_id = '{$member['mb_id']}', ce_unit = '{$ce_unit}', ce_valid_date = '{$ce_valid_date}', ce_contents = '{$ce_contents}', ce_state = 'Processing Submission', vat_include_yn = '{$vat}', total_cost = '{$totalCost}', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
        $result = sql_query($sql);
        $idx = sql_insert_id();
    }
    else {
        $sql = " update g5_company_estimate set ce_unit = '{$ce_unit}', ce_valid_date = '{$ce_valid_date}', ce_contents = '{$ce_contents}', vat_include_yn = '{$vat}', total_cost = '{$totalCost}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$ce_idx}' ";
        $result = sql_query($sql);
        $idx = $ce_idx;
    }

    // 23.05.16 RFQ content
    // 전체 삭제 후 저장
    sql_query("delete from g5_company_estimate_content where estimate_idx = '{$idx}' ");
    for($i=0; $i<count($quantityOffered); $i++) {
        $quantityOffered[$i] = str_replace(',', '', $quantityOffered[$i]);
        $unitCost[$i] = str_replace(',', '', $unitCost[$i]);
        $lineCost[$i] = str_replace(',', '', $lineCost[$i]);

        $sql = "insert into g5_company_estimate_content set mb_id = '{$member['mb_id']}', estimate_idx = '{$idx}', inquiry_content_idx = '{$contentIdx[$i]}', quantity_offered = '{$quantityOffered[$i]}', uom = '{$uom[$i]}', unit_cost = '{$unitCost[$i]}', line_cost = '{$lineCost[$i]}'";
        sql_query($sql);
    }

    // 견적 상세 자료 파일 삭제
    $del_file = explode(',', $del_file_idx);
    for($i = 0; $i < count($del_file); $i++) {
        $sql = " select * from g5_company_estimate_img where idx = {$del_file[$i]} ";
        $row = sql_fetch($sql);

        unlink(G5_DATA_PATH . '/file/company_estimate/' . $row['img_file']);

        $sql = " delete from g5_company_estimate_img where idx = {$del_file[$i]} ";
        sql_query($sql);
    }

    // 견적 상세 자료 파일 업로드
    for($i=0; $i<count($_FILES['files']['name']); $i++) {
        if(!empty($_FILES['files']['name'])) {
            $tmp_file = $_FILES['files']['tmp_name'][$i];
            $filesize = $_FILES['files']['size'][$i];
            $filename = $_FILES['files']['name'][$i];
            $filename = get_safe_filename($filename);
            $img_file = fileUpload_up(G5_DATA_PATH . "/file/company_estimate/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

            // 견적 상세 자료 DB INSERT
            $result = sql_query(" insert into g5_company_estimate_img set company_estimate_idx = {$idx}, img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
        }
    }

    if($result) {
        die('success');
    }
}
?>
