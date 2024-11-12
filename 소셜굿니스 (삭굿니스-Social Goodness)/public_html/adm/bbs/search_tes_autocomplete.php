<?php
include_once('./_common.php');

// 자동 완성
if($_POST['option'] == 'autocomplete') {
    $sql = " select * from g5_tes where te_name like '%{$_POST['address']}%' or te_address like '%{$_POST['address']}%' ";
    $result = sql_query($sql);
}
// 검색 버튼
else if ($_POST['option'] == 'search') {
    $sql = " select * from g5_tes where te_name = '{$_POST['address']}' or te_address = '{$_POST['address']}' ";
    $result = sql_query($sql);
}

$array = array();
for($i=0; $row = sql_fetch_array($result); $i++) {
    array_push($array, $row);
}

die(json_encode($array));
?>