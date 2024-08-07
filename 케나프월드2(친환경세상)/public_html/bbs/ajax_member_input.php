<?php
include_once('./_common.php');

$age = $_GET['age'];
$mb_name = $_GET['mb_name'];
$mb_hp = $_GET['mb_hp'];

sql_fetch("update `g5_member` set `age` = '$age', mb_name = '{$mb_name}', mb_hp = '{$mb_hp}' where `mb_id` = '$member[mb_id]'");

echo G5_URL;
?>