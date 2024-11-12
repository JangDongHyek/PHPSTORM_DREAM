<?php
include_once('./_common.php');

$option = $_POST['option'];

if($option == 'tes') {
    if($_POST['te_no'] != '') {
        $sql = " select * from g5_tes where te_no = {$_POST['te_no']} ";
    } else {
        $sql = " select * from g5_tes ";
    }
    $result = sql_query($sql);

    $array = array();
    for($i=0; $row = sql_fetch_array($result); $i++) {
        array_push($array, $row);
    }

    die(json_encode($array));
}
else if($option == 'file') {
    $sql = " select file.*, tes.* from g5_file as file ";
    $sql .= " left join g5_tes as tes on file.tb_no = tes.te_no ";
    $sql .= " where file.tb_no = {$_POST['tb_no']} order by file.fi_no limit 1 ";
    $result = sql_query($sql);

    $array = array();
    for($i=0; $row = sql_fetch_array($result); $i++) {
        array_push($array, $row);
    }

    die(json_encode($array));
}
?>