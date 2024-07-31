<?php
$sub_menu = "500100";
include_once('./_common.php');
include_once('./survery_config.php');

check_demo();

auth_check($auth[$sub_menu], 'd');

check_admin_token();

$count = count($_POST['chk']);

if(!$count)
    alert('삭제할 투표목록을 1개이상 선택해 주세요.');

for($i=0; $i<$count; $i++) {
    $sv_id = $_POST['chk'][$i];

    $sql = " delete from {$g5['survey_table']} where sv_id = '$sv_id' ";
    sql_query($sql);

    $sql = " delete from {$g5['clause_table']} where sv_id = '$sv_id' ";
    sql_query($sql);
}

goto_url('./survey_list.php?'.$qstr);
?>