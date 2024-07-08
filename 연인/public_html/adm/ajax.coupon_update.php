<?php
/**
 * 쿠폰
 */
include_once('./_common.php');

$json = array();
$json['result'] = false;
$json['post'] = $_POST;

switch ($_POST['mode']) {
    case "issueCoupon" : // 쿠폰발급
        $sql_add = [];
        for ($i=0; $i<$_POST['cnt']; $i++) {
            $sql_add[] = "({$_POST['mb_no']}, '".G5_TIME_YMDHIS."', {$member['mb_no']})";
        }

        $sql = "INSERT INTO g5_coupon (mb_no, issue_date, admin_no) VALUES ";
        $sql .= implode(",", $sql_add);

        $json['result'] = sql_query($sql);
        break;

    case "deleteCoupon" :   // 쿠폰삭제
        $sql = "DELETE FROM g5_coupon WHERE idx = '{$_POST['idx']}'";
        $json['result'] = sql_query($sql);
        break;
}

die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));