<?php
include_once ("./_common.php");
/**
 * 자료실 판매등록/수정 처리
 */

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}

@mkdir(G5_DATA_PATH . '/file/' . 'reference', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'reference', G5_DIR_PERMISSION);

if(empty($rr_is_free)) $rr_is_free = "N";
$rr_price = str_replace(',', '', $rr_price);
$sql_common = " rr_category = '{$rr_category}',
                rr_sub_category = '{$rr_sub_category}',
                rr_subject = '{$rr_subject}',
                rr_hashtag = '{$rr_hashtag}',
                rr_contents = '{$rr_contents}',
                rr_is_free = '{$rr_is_free}',
                rr_price = '{$rr_price}' ";

if($w == "") { // 등록
    $sql = " INSERT INTO g5_reference_room SET mb_id = '{$member['mb_id']}', wr_datetime = '".G5_TIME_YMDHIS."', {$sql_common} ";
    $result = sql_query($sql);
    $idx = sql_insert_id();
}
else if($w == "u") { // 수정
    $sql = " UPDATE g5_reference_room SET up_datetime = '".G5_TIME_YMDHIS."', {$sql_common} WHERE idx = '{$idx}' ";
    $result = sql_query($sql);
}
// else if($w == "d") { // 삭제
//     // 자료실 정보
//     $data = sql_fetch(" select * from g5_reference_room where idx = '{$idx}' ");
//
//     // 자료실 정보 UPDATE (삭제하지않고 상태변경)
//     $result = sql_query(" update g5_reference_room set del_yn = 'Y', de_datetime = '".G5_TIME_YMDHIS."' where idx = {$idx}; ");
// }

// 자료실 파일 삭제
$del_file = explode(',', $del_file_idx);
for($i = 0; $i < count($del_file); $i++) {
    $sql = " select * from g5_reference_room_file where idx = {$del_file[$i]} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/reference/' . $row['img_file']);

    $sql = " delete from g5_reference_room_file where idx = {$del_file[$i]} ";
    sql_query($sql);
}

// 자료실 파일 업로드
for($i=0; $i<count($_FILES['files']['name']); $i++) {
    if(!empty($_FILES['files']['name'])) {
        $tmp_file = $_FILES['files']['tmp_name'][$i];
        $filesize = $_FILES['files']['size'][$i];
        $filename = $_FILES['files']['name'][$i];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/reference/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 견적 상세 자료 DB INSERT
        $result = sql_query(" insert into g5_reference_room_file set reference_idx = {$idx}, mode = 'file', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
    }
}

// 썸네일 파일 업로드
for($i=0; $i<count($_FILES['thumbs']['name']); $i++) {
    if(!empty($_FILES['thumbs']['name'])) {
        $tmp_file = $_FILES['thumbs']['tmp_name'][$i];
        $filesize = $_FILES['thumbs']['size'][$i];
        $filename = $_FILES['thumbs']['name'][$i];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/reference/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 견적 상세 자료 DB INSERT
        $result = sql_query(" insert into g5_reference_room_file set reference_idx = {$idx}, mode = 'thumb', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
    }
}

if($result) echo $idx;exit;
