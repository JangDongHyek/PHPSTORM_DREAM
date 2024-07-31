<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if($is_day){
	include_once($board_skin_path."/list_day.skin.php");
}
else if($test==1){
	include_once($board_skin_path."/list_week2.skin.php");
}
else{
	include_once($board_skin_path."/list_week.skin.php");
}

?>