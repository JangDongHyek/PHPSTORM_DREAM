<?php
$sub_menu = "280100";
include_once('./_common.php');




if($w == ""){
	$sql = "insert into `v5_holiday_list` set `date` ='$date'";
	sql_query($sql);
} else {
	$sql = "delete from `v5_holiday_list` where `idx` = '$idx'";
	sql_query($sql);
}



?>