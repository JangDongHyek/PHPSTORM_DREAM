<?php
include_once("./_common.php");

$idx = $_POST['idx'];

$sql = " select * from g5_lesson_diary where idx = {$idx} ";
$result = sql_fetch($sql);

die(json_encode($result));
?>