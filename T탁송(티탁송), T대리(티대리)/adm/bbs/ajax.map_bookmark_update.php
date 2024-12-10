<?php
/************************************************
주소검색시 북마크&히스토리 업데이트
************************************************/
include_once('./_common.php');

$mode = $_GET['mode'];

if ($mode == "favorite") {
	$bm_favorites = ($cur_val == "1")? 0 : 1;

	$sql = "UPDATE g5_bookmark SET bm_favorites = '{$bm_favorites}'";
	if ($bm_favorites == "1") 
		$sql .= ", bm_regdate = '".G5_TIME_YMDHIS."'";
	$sql .=	"WHERE idx = '{$idx}'";

	sql_query($sql);
}





?>