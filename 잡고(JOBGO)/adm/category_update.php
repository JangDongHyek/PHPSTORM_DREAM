<?php
$sub_menu = "260200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');


$code_p_idx = $_POST['code_p_idx'];
$code_name = $_POST['code_name'];
$code_use = $_POST['code_use'];
$idx = $_POST['idx'];
$code_ctg = $_POST['code_ctg'];
$sql_common = "";

if ($idx != ""){
    $sql = "update {$g5["code_table"]} set
        code_p_idx = '{$code_p_idx}',
        code_name = '{$code_name}',
        code_use = '{$code_use}'
        where code_idx = '{$idx}' ";

    $sql_common = "and code_idx != '{$idx}' ";

}else {

    $dup_sql = "select * from {$g5['code_table']} where code_name = '{$code_name}' and code_p_idx = '{$code_p_idx}' {$sql_common} order by code_p_idx";
    $result = sql_fetch($dup_sql);

    if (isset($result)){
        alert('중복되는 카테고리 이름입니다.');
    }


    $sql = "insert into {$g5["code_table"]} set
        code_p_idx = '{$code_p_idx}',
        code_name = '{$code_name}',
        code_use = '{$code_use}',
        code_ctg = '{$code_ctg}',
        wr_datetime = '".G5_TIME_YMDHIS."' ";

}
//print_r($sql);
//exit();


sql_query($sql);

goto_url('./category_list.php?'.$qstr);
?>
