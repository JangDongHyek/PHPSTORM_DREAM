<?php
$sub_menu = 150100;
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$mb_no = $_GET['mb_no'];
$row = sql_fetch("SELECT mb_2 FROM g5_member WHERE mb_no = '{$mb_no}'");

$target_Dir = G5_DATA_PATH.'/biz/';
$file = $row['mb_2'];
$down = $target_Dir.$file;
$filesize = filesize($down);

if (file_exists($down) && $file != '') {
	header("Content-Type:application/octet-stream");
	header("Content-Disposition:attachment;filename=$file");
	header("Content-Transfer-Encoding:binary");
	header("Content-Length:".filesize($target_Dir.$file));
	header("Cache-Control:cache,must-revalidate");
	header("Pragma:no-cache");
	header("Expires:0");

	if (is_file($down)) {
		$fp = fopen($down,"r");

		while(!feof($fp)) {
			$buf = fread($fp,8096);
			$read = strlen($buf);
			print($buf);
			flush();
		}
		fclose($fp);
	} else {
		alert('파일을 불러오는데 실패하였습니다. 다시 시도해 주세요.');
	}

} else{
	alert('파일을 불러오는데 실패하였습니다. 다시 시도해 주세요.');
}
?>