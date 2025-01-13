<?php
include_once('./_common.php');

$params = "oid=" . $oid . "&price=" . $price . "&timestamp=" . $timestamp;
$sign = hash("sha256", $params);

echo $sign;

?>