<?php
include_once('./_common.php');

$mb_id	= $_POST['mb_id'];
$mb_1	= $_POST['mb_1'];
$e		= $_POST['e'];

if($e == "add")
	$mb_1++;
else if($e == "min")
	$mb_1--;

sql_query(" update {$g5['member_table']} set mb_1 = '{$mb_1}' where mb_id = '{$mb_id}' ");

echo json_encode($mb_1);

?>