<?php
include_once ('./_common.php');
/**
 * 프로필 - 기본정보 - 추가서류
 */

if($add_file_mode == 'r') {
    // 추가서류 등록
    if(!empty($_FILES['document']['name'])) {
        // 카달로그 파일 업로드
        $tmp_file = $_FILES['document']['tmp_name'];
        $filesize = $_FILES['document']['size'];
        $filename = $_FILES['document']['name'];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/member_add/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 추가서류 DB INSERT
        sql_query(" insert into g5_member_img_add set mb_no='{$_REQUEST['mb_no']}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
        $idx = sql_insert_id();

        echo $idx;
        exit;
    }
}
else if($add_file_mode == 'd') {
    // 추가서류 삭제
    $info = sql_fetch(" select * from g5_member_img_add where idx = '{$file_idx}' ");
    unlink(G5_DATA_PATH . '/file/member_add/' . $info['img_file']);

    $sql = " delete from g5_member_img_add where idx = '{$file_idx}' ";
    sql_query($sql);

    echo 1;
    exit;
}