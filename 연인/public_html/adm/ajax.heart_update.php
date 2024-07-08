<?php
/**
 * 포인트
 */
include_once('./_common.php');

$json = array();
$json['result'] = false;
$json['post'] = $_POST;

switch ($_POST['mode']) {
    case "changeHeartCount" :       // 관리자 포인트개수 변경
        $old_heart = $_POST['old_heart']; // 기존 잔여 개수
        $new_heart = $_POST['new_heart']; // 변경할 개수
        $mb_no = $_POST['mb_no'];
        $desc = "연인 포인트 수정 (".number_format($new_heart)."P)";
        $ref_idx = $member['mb_no'];

        $json['result'] = setMemberHeart($mb_no, $new_heart, $old_heart, $desc, $ref_idx);

        break;
}

die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));