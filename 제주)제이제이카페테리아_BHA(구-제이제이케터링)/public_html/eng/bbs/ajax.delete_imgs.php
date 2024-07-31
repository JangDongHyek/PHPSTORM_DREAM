<?php

include_once('./_common.php');

$sql="select * from g5_carte_images where 
        date= '{$date}' and 
        tmcate='{$tmcate}' and 
        sheet='{$sheet}'  ";
$result_images  = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result_images); $i++){
    //	echo G5_DATA_PATH."/file/carte/{$row['file_path']}";

    unlink(G5_DATA_IMG_PATH."/file/carte/{$row['file_path']}");
    $sql ="delete from g5_carte_images where idx = {$row['idx']}";
    sql_query($sql);
}

?>