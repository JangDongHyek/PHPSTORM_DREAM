<?php
include_once("./_common.php");
/**
 * 안씀
 */
// 21.02.04 푸시알림
if(strpos($_SERVER['HTTP_USER_AGENT'], 'AJNGK') > 0) {
    $sql = "select * from g5_fcm where mb_id = '{$_POST['mb_id']}'";
    $result = sql_query($sql);
    if (sql_num_rows($result)) {
        $sql = "update g5_fcm set token = '{$token}', mod_date = '".G5_TIME_YMDHIS."' where mb_id = '{$_POST['mb_id']}' ";
    } else {
        $sql = "insert g5_fcm set mb_id = '{$_POST['mb_id']}', token = '{$token}', reg_date = '".G5_TIME_YMDHIS."' ";
    }
    sql_query($sql);
}
?>
