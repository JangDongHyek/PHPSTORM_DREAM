<?php
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'business', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'business', G5_DIR_PERMISSION);

//print_r($_FILES['file']['name']);exit;
//print_r($_REQUEST);
//exit;

// 사업 소개 DB INSERT (1차 분류)
$sql = " insert into g5_business_information set mb_no = '{$member['mb_no']}', bi_name = '{$bi_name}', wr_datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql);
$p_idx = sql_insert_id();

// 2차 분류 개수 (파일은 필수이므로 파일 개수로 파악 -- 파일이 필수가 아니게 될 시 로직 변경)
$fileCount = count($_FILES['file']['name']);
for($i=0; $i<$fileCount; $i++) {
    $k = $i+1;

    // 파일 업로드 (2차 분류)
    $tmp_file = $_FILES['file']['tmp_name'][$i];
    $filesize = $_FILES['file']['size'][$i];
    $filename = $_FILES['file']['name'][$i];
    $filename = get_safe_filename($filename);
    $img_file = fileUpload_up(G5_DATA_PATH . "/file/business/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

    // 사업 소개 DB INSERT (2차 분류)
    $sql = " insert into g5_business_information set mb_no = '{$member['mb_no']}', p_idx = {$p_idx}, bi_name = '{$bi_name}', bi_img_file = '{$img_file}', bi_title = '{$title[$i]}', bi_contents = '{$contents[$i]}', wr_datetime = '".G5_TIME_YMDHIS."'  ";
    sql_query($sql);
    $p_idx2 = sql_insert_id();

    // 파일 업로드 DB INSERT (2차 분류)
    sql_query(" insert into g5_business_information_img set bi_idx = {$p_idx2}, mb_id='{$member['mb_id']}', img_no = '{$k}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");

    // 사업 소개 DB INSERT (3차 분류)
    for($j=0; $j<count(${"third_depth_$k"}); $j++) {
        if(!empty(${"third_depth_$k"}[$j])) {
            $sql = " insert into g5_business_information set mb_no = '{$member['mb_no']}', p_idx = {$p_idx2}, bi_name = '{$bi_name}', bi_img_file = '{$img_file}', bi_title = '{$title[$i]}', bi_contents = '{$contents[$i]}', bi_third_depth = '{${"third_depth_$k"}[$j]}', wr_datetime = '".G5_TIME_YMDHIS."'  ";
            sql_query($sql);
        }
    }
}

die('success');
?>