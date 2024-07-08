<?php
/*************************************
head 회원상태 (진행기, 휴면기)
*************************************/
include_once('./_common.php');

/*
$mb_switch = ($_POST['flag'] == "on")? "off" : "on";

if ($_POST['mb_id'] == "") {
	exit;
}
*/

$row = sql_fetch(" SELECT mb_switch FROM g5_member WHERE mb_id = '{$mb_id}' ");
$flag = $row['mb_switch'];

if ($row['mb_switch'] == "") {
	$flag = $_POST['flag'];
}

$mb_switch = ($flag == "on")? "off" : "on";

$sql = "UPDATE g5_member SET 
		mb_switch = '{$mb_switch}'
		WHERE mb_id = '{$mb_id}'
		";

sql_query($sql);

echo $mb_switch;

?>