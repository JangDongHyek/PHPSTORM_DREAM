<?php
include_once("../common.php");

$json['post'] = $_POST;
$json['result'] = false;
$json['file_result'] = false;
$json['obj'] = array();

switch ($_POST['mode']){

    /**
     * 신고 등록
     */
    case "declare_write" :
        $sql = " INSERT INTO g5_declare_list SET mb_id = '{$_POST['mb_id']}',
                                                 wr_id = '{$_POST['wr_id']}',
                                                 declare_type = '{$_POST['declare_type']}',
                                                 declare_content = '{$_POST['declare_content']}',
                                                 reg_date = now() ";
        $json['sql'] = $sql;
        $json['result'] = sql_query($sql);
        break;
}




die(json_encode($json));

?>

