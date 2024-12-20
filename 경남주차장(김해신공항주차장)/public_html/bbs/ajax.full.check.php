<?php
include_once('./_common.php');
$sql="select * from g5_fullsetting where parkname='$parkname'";
$row=sql_fetch($sql);
echo $row[full];
?>