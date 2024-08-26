<?php
include_once('./_common.php');

$mb = get_member($_REQUEST["mb_id"]);

if ($mb["mb_id"] == ""){
    alert("존재하지 않는 사용자 입니다.");
}

$point = str_replace ( ',' , '', $_REQUEST['p_point']);
$sql = " update g5_member set mb_new_point = mb_new_point + {$point} where mb_id = '{$mb['mb_id']}'; ";
sql_query($sql);

$mb = get_member($_REQUEST["mb_id"]);

$sale_point_mb = get_member($member['mb_id']);
point_history($mb['mb_id'], '',$_REQUEST["p_content"], $point, $mb['mb_new_point'], 'plus');

goto_url("./point_history.php?".$qstr);