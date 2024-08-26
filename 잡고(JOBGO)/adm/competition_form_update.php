<?php
$sub_menu = "250200";
include_once("./_common.php");

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$idx = $_REQUEST['idx'];

foreach ($_REQUEST as $key => $value) {
    if (strpos($key, 'cp_') === 0) {
        if ($key != 'cp_idx') {
            $sql_common .= $key . "='" . $value . "',";
        }
    }
}

if ($idx != "" ){
    $sql = "update new_competition set ".$sql_common." up_datetime = '".G5_TIME_YMDHIS."' where cp_idx = ".$idx;
    sql_query($sql);
}else{
    $sql = "insert into new_competition set ".$sql_common." mb_id = '{$_REQUEST['mb_id']}',wr_datetime = '".G5_TIME_YMDHIS. "'";
    sql_query($sql);
    $idx = sql_insert_id();


}


goto_url(G5_ADMIN_URL.'/competition_form?'.$qstr.'&w=u&idx='.$idx);