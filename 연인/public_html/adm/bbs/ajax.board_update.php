<?php
include_once('./_common.php');

$json = array();
$json['result'] = false;
$json['post'] = $_POST;
$json['file'] = $_FILES;

$tbl_name = "";
$tbl_idx = 0;
$files = "";

switch ($_POST['mode']) {
    case "refundWrite" : // 환불요청 글쓰기
        $tbl_name = "refund";
        $files = $_FILES['img_file'];

        $idx = (int)$_POST['idx'];
        $writer_no = $_POST['writer_no'];
        $mb_no = $_POST['mb_no'];
        $subject = trim(mb_substr($_POST['subject'], 0, 190, 'utf-8'));
        $content = trim($_POST['content']);

        if ($idx == 0) {
            $sql = "INSERT INTO g5_bbs_refund SET 
                    writer_no = '{$writer_no}',
                    mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                    mb_no = '{$mb_no}',
                    subject = '{$subject}',
                    content = '{$content}'
                    ";
        } else {
            $sql = "UPDATE g5_bbs_refund SET 
                    writer_no = '{$writer_no}',
                    mb_no = '{$mb_no}',
                    subject = '{$subject}',
                    content = '{$content}'
                    WHERE idx = '{$idx}'
                    ";
        }

        if (sql_query($sql)) {
            $json['result'] = true;
            $tbl_idx = ($idx == 0)? sql_insert_id() : $idx;
        }

        break;

    case "refundDelete" :   // 환불요청 삭제
        $sql = "UPDATE g5_bbs_refund SET del_yn = 'Y' WHERE idx IN (";
        $sql .= implode(",", $_POST['list']);
        $sql .= ")";
        $json['result'] = sql_query($sql);
        break;

    case "reportDelete" :   // 신고게시판 삭제
        $sql = "UPDATE g5_bbs_report SET del_yn = 'Y' WHERE idx IN (";
        $sql .= implode(",", $_POST['list']);
        $sql .= ")";
        $json['result'] = sql_query($sql);
        break;

    case "couponWrite" : // 쿠폰발급요청 글쓰기
        $tbl_name = "coupon";
        $files = $_FILES['img_file'];

        $idx = (int)$_POST['idx'];
        $writer_no = $_POST['writer_no'];
        $mb_no = $_POST['mb_no'];
        $subject = trim(mb_substr($_POST['subject'], 0, 190, 'utf-8'));
        $content = trim($_POST['content']);

        if ($idx == 0) {
            $sql = "INSERT INTO g5_bbs_coupon SET 
                    writer_no = '{$writer_no}',
                    writer_ip = '{$_SERVER['REMOTE_ADDR']}',
                    mb_no = '{$mb_no}',
                    subject = '{$subject}',
                    content = '{$content}',
                    regdate = NOW()
                    ";
        } else {
            $sql = "UPDATE g5_bbs_coupon SET 
                    writer_no = '{$writer_no}',
                    mb_no = '{$mb_no}',
                    subject = '{$subject}',
                    content = '{$content}'
                    WHERE idx = '{$idx}'
                    ";
        }

        if (sql_query($sql)) {
            $json['result'] = true;
            $tbl_idx = ($idx == 0)? sql_insert_id() : $idx;
        }

        break;

    case "couponDelete" :   // 쿠폰발급요청 삭제
        $sql = "UPDATE g5_bbs_coupon SET del_yn = 'Y' WHERE idx IN (";
        $sql .= implode(",", $_POST['list']);
        $sql .= ")";
        $json['result'] = sql_query($sql);
        break;

    case "basicWrite" : // 기본형게시판 글쓰기 (카운슬러,notice)
        $tbl_name = $_POST['tbl_name'];
        $files = $_FILES['img_file'];

        $idx = (int)$_POST['idx'];
        $writer_no = $_POST['writer_no'];
        $subject = trim(mb_substr($_POST['subject'], 0, 190, 'utf-8'));
        $content = trim($_POST['content']);
        $category = $_POST['category'];

        if ($idx == 0) {
            $sql = "INSERT INTO g5_bbs_basic SET
                    tbl_name = '{$tbl_name}',
                    writer_no = '{$writer_no}',
                    writer_ip = '{$_SERVER['REMOTE_ADDR']}',
                    category = '{$category}',
                    subject = '{$subject}',
                    content = '{$content}',
                    regdate = NOW()
                    ";
        } else {
            $sql = "UPDATE g5_bbs_basic SET 
                    writer_no = '{$writer_no}',
                    category = '{$category}',
                    subject = '{$subject}',
                    content = '{$content}'
                    WHERE idx = '{$idx}'
                    ";
        }

        if (sql_query($sql)) {
            $json['result'] = true;
            $tbl_idx = ($idx == 0)? sql_insert_id() : $idx;
        }

        break;

    case "basicDelete" :   // 기본형게시판 삭제
        $sql = "UPDATE g5_bbs_basic SET del_yn = 'Y' WHERE idx IN (";
        $sql .= implode(",", $_POST['list']);
        $sql .= ")";
        $json['result'] = sql_query($sql);
        break;

    case "commentWrite" : // 코멘트 등록
        $idx = (int)$_POST['idx'];
        $content = trim($_POST['content']);

        if ($idx == 0) { // 등록
            $tbl_name = $_POST['tbl_name'];
            $tbl_idx = $_POST['tbl_idx'];

            $sql = "INSERT INTO g5_bbs_reply SET 
                    tbl_name = '{$tbl_name}', 
                    tbl_idx = '{$tbl_idx}', 
                    mb_no = '{$member['mb_no']}', 
                    mb_name = '{$member['mb_name']}', 
                    content = '{$content}', 
                    regdate = NOW(), 
                    ip = '{$_SERVER['REMOTE_ADDR']}'";

        } else { // 수정
            $sql = "UPDATE g5_bbs_reply SET 
                    content = '{$content}'
                    WHERE idx = '{$idx}'
                    ";
        }

        $json['result'] = sql_query($sql);
        break;

    case "commentDelete" :  // 코멘트 삭제
        $idx = (int)$_POST['idx'];
        $sql = "UPDATE g5_bbs_reply SET del_yn = 'Y' WHERE idx = '{$idx}'";
        $json['result'] = sql_query($sql);
        break;
}


// 파일업로드 추가/삭제
if ($json['result'] && $tbl_name != "" && $files != "") {
    $upload_dir = BBS_IMG_PATH.'/';
    $img_count = count($files['tmp_name']);
    $sort = 0;
    $random_str = getRandomString(4, "str");
    

    for ($i=0; $i<$img_count; $i++) {
        $upload_file = $files['tmp_name'][$i];

        if ($upload_file != "") { // 신규 파일업로드
            $origin_name = $files['name'][$i];
            $ext = array_pop(explode(".", $origin_name));
            $file_name = time() . "{$sort}{$random_str}.{$ext}";
            $upload_path = $upload_dir . $file_name;
            $json['aa'] = $upload_file;
            $json['bb'] = $upload_path;

            if (move_uploaded_file($upload_file, $upload_path)) { // 성공
                // 파일 신규등록
                $json['cc'] = 1;
                $sql = "INSERT INTO g5_bbs_file (tbl_name, tbl_idx, sort, regdate, origin_name, file_name) VALUES ";
                $sql .= "('{$tbl_name}', '{$tbl_idx}', '{$sort}', NOW(), '{$origin_name}', '{$file_name}')";
                sql_query($sql);
                $sort++;
            }
        }
    }

    // 파일삭제
    if (count($_POST['del_file']) > 0) {
        $names = [];
        foreach ($_POST['del_file'] AS $key=>$del_name) {
            $names[] = "'{$del_name}'";
            @unlink($upload_dir.$del_name);
        }

        $sql = "DELETE FROM g5_bbs_file WHERE tbl_name = '{$tbl_name}' AND file_name IN (";
        $sql .= implode(",", $names);
        $sql .= ")";
        sql_query($sql);
    }
}


die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));