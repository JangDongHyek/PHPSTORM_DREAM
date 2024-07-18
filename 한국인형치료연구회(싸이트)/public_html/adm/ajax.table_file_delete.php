<?php

include_once('./_common.php');


$json['error'] = "";
$json['post'] = $_POST;
$json['result'] = false;
$json['file_delete_result'] = false;

switch($_POST['mode']){
    case "delete" :
        $file_path = G5_DATA_PATH."/file/".$_POST['table']."/".get_wr_file($_POST['table'],$_POST['wr_id']);
        $sql = " UPDATE g5_write_{$_POST['table']} SET wr_6 = '' WHERE wr_id = '{$_POST['wr_id']}' ";
        $json['result'] = sql_query($sql);

        // 파일 삭제
        if(file_exists($file_path)){
            unlink($file_path);
            $json['file_delete_result'] = true;
        }
        break;
}



die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));


?>
