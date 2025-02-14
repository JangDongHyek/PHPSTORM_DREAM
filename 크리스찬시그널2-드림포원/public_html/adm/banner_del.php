<?php
/*************************************************************
배너관리 - 배너삭제
*************************************************************/
include_once('./_common.php');

$table_name = 'new_adm_banner';

$row = sql_fetch(" SELECT image FROM {$table_name} WHERE idx = '{$idx}' ");
$image = $row['image'];

if ($image != "") {
	$img_path = G5_BNR_PATH.'/'.$image;

	// 이미지삭제
	@unlink($img_path);
}

// DB삭제
$sql = "DELETE FROM {$table_name} WHERE idx = '{$idx}'";
sql_query($sql);

echo 1;


?>