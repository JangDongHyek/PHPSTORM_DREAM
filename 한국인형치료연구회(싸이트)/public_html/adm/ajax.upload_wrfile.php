<?php

include_once('./_common.php');


$json['error'] = "";
$json['post'] = $_POST;
$json['result'] = false;

if(count($_FILES['bf_file']['name'])>0 && $is_admin){

    $tmp_file  = $_FILES['bf_file']['tmp_name'];
    $filesize  = $_FILES['bf_file']['size'];
    $filename  = $_FILES['bf_file']['name'];
    $filename  = get_safe_filename($filename);

    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
    shuffle($chars_array);
    $shuffle = implode('', $chars_array);

	if ($filename) {
        if ($_FILES['bf_file']['error'] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
			echo 1;
			exit;
        }
        else if ($_FILES['bf_file']['error'] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
			echo 2;
			exit;
        }
    }

    $up_filename = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

    $dest_file = G5_DATA_PATH.'/file/'.$flg.'/'.$up_filename;

    // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
    if(move_uploaded_file($tmp_file, $dest_file)){
        $sql ="update g5_write_{$flg} set wr_6 = '{$up_filename}' where wr_id = {$wr_id}";
        $json['result'] = sql_query($sql);
    }else{
        $json['error'] = $file_upload_msg;
    }


}



die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));


?>