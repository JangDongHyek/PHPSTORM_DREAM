<?php
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'company_estimate', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'company_estimate', G5_DIR_PERMISSION);

//print_r($_FILES);exit;
//print_r($_REQUEST);

// ci_open ==> open : 전체공개 / private : 선택공개

if(!empty($company_inquiry_idx)) {
    $ce_offer_price = str_replace(',', '', $ce_offer_price);

    if($w == '') {
        $sql = " insert into g5_company_estimate set company_inquiry_idx = {$company_inquiry_idx}, mb_id = '{$member['mb_id']}', ce_offer_price = '{$ce_offer_price}', ce_unit = '{$ce_unit}', ce_contents = '{$ce_contents}', ce_state = '접수대기', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
        $result = sql_query($sql);
        $idx = sql_insert_id();

        // 견적보내기 시 견적 의뢰자에게 푸시
        $inquiry = sql_fetch("select * from g5_company_inquiry where idx = '{$company_inquiry_idx}' "); // 외뢰정보
        $push_status = "estimate";
        $push_data = array('subject'=>$inquiry['ci_subject'], 'url'=>G5_BBS_URL."/mypage_company01.php", 'ref_idx'=>$idx, 'ref_table'=>'company_estimate', 'mb_id'=>$inquiry['mb_id']);
        @include_once(G5_BBS_PATH.'/send_push.php');
    }
    else {
        $sql = " update g5_company_estimate set ce_offer_price = '{$ce_offer_price}', ce_unit = '{$ce_unit}', ce_contents = '{$ce_contents}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$ce_idx}' ";
        $result = sql_query($sql);
        $idx = $ce_idx;
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