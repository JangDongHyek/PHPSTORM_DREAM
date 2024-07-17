<?php
include_once("./_common.php");

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
    $sql = "insert into new_competition set ".$sql_common." mb_id = '{$member['mb_id']}',wr_datetime = '".G5_TIME_YMDHIS. "'";
    sql_query($sql);
    $idx = sql_insert_id();
}


@mkdir(G5_DATA_PATH."/file/competition", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/file/competition", G5_DIR_PERMISSION);


$path=G5_DATA_PATH."/file/competition/";
$filename =$_FILES["main_img"]['name'];
$tmp_file = $_FILES["main_img"]['tmp_name'];

$file = fileUpload_up($path, $filename, $tmp_file);

$sql = " insert into {$g5['board_file_table']}
                    set bo_table = 'competition',
                         wr_id = '{$idx}',
                         bf_no = '0',
                         bf_source = '{$filename}',
                         bf_file = '{$file}',
                         bf_download = '0',
                         bf_content = '',
                         bf_filesize = '{$_FILES["main_img"]['size']}',
                         bf_width = '',
                         bf_height = '',
                         bf_type = '',
                         bf_datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql, false);

for($i=1; $i<4; $i++){
    $filename =$_FILES["data".$i]['name'];
    $tmp_file = $_FILES["data".$i]['tmp_name'];

    if($filename == null || $filename == "") continue;

    $file = fileUpload_up($path, $filename, $tmp_file);

    $sql = " insert into {$g5['board_file_table']}
                    set bo_table = 'competition',
                         wr_id = '{$idx}',
                         bf_no = '{$i}',
                         bf_source = '{$filename}',
                         bf_file = '{$file}',
                         bf_download = '0',
                         bf_content = '',
                         bf_filesize = '{$_FILES["data".$i]['size']}',
                         bf_width = '',
                         bf_height = '',
                         bf_type = '',
                         bf_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql, false);
}

goto_url(G5_BBS_URL.'/contest_view.php?idx='.$idx);