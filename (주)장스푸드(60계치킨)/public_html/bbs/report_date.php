<?php
include_once('./_common.php');

$year = $_GET["year"];
$month = $_GET["month"];
$setDate = $year."-".$month."-01";
$lastDay = date('t', strtotime($setDate));

echo "<option value=''>일</option>";

for($i = 1; $i <= $lastDay; $i++) {
	echo "<option value='".sprintf('%02d', $i)."'>{$i}</option>";
}


?>
