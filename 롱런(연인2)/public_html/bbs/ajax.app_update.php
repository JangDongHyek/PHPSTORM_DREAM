<?php
/**
 * 앱 액션
 * 1. 카운슬러 신고
 */
include_once("./_common.php");

$json = array();
$json['result'] = false;
$json['post'] = $_POST;

switch ($_POST['mode']) {
    case "counselorReport" :    // 카운슬러 신고
        $content = trim($_POST['content']);

        $sql = "INSERT INTO g5_bbs_report SET 
        writer_no = '{$member['mb_no']}',
        writer_ip = '{$_SERVER['REMOTE_ADDR']}',
        target_no = '{$_POST['target_no']}',
        content = '{$content}',
        regdate = NOW()
        ";
        $json['result'] = sql_query($sql);
        break;

    case "changeStatus" :       // 회원상태변경 (on, off)
        $status = $_POST['cur_status']=="on"? "off" : "on";
        $sql = "UPDATE g5_member SET mb_switch = '{$status}' WHERE mb_no = '{$member['mb_no']}'";
        $json['result'] = sql_query($sql);
        $json['status'] = $status;
        break;


}



die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));