<?php
/*************************************
head 회원상태 (진행기, 휴면기)
*************************************/
include_once('./_common.php');

$mb_switch = ($_POST['flag'] == "on")? "off" : "on";

if ($_POST['mb_id'] == "") {
	exit;
}

$sql = "UPDATE g5_member SET 
		mb_switch = '{$mb_switch}'
		WHERE mb_id = '{$mb_id}'
		";

sql_query($sql);

?>