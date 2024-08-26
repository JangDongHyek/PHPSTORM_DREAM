<?php
$sub_menu = "200100";
include_once("./_common.php");

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$sql_common = "";
foreach ($_REQUEST as $key => $value) {
    if (strpos( $key, 'cr_' ) === 0) {
        if ($key != 'cr_idx') {

            $sql_common .= $key . "='" . $value . "',";

        }
    }
}

$cr_idx = $_REQUEST["cr_idx"];
if ($w == 'u'){

    $sql = "update new_cancel_rule set {$sql_common} up_datetime = '".G5_TIME_YMDHIS."' where cr_idx = '{$cr_idx}' ";
    sql_query($sql);
    $msg = '수정';

}elseif ($w == ''){

    $sql = "insert into new_cancel_rule set {$sql_common}  wr_datetime = '".G5_TIME_YMDHIS."'  ";

    sql_query($sql);
    $cr_idx = sql_insert_id();
    $msg = '저장';


}


alert($msg.' 완료되었습니다.','./cancel_rule_form.php?'.$qstr.'&amp;w=u&amp;cr_idx='.$cr_idx, false);
?>