<?php
include_once("./_common.php");

$mb_no = $_POST['mb_no'];

$sql = " select mb_pro_profile from g5_member where mb_no = {$mb_no} ";
$mb_pro_profile = sql_fetch($sql)['mb_pro_profile'];

die($mb_pro_profile);
?>