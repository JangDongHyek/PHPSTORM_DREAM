<?php 
include_once('./_common.php');

$sql = "select * from g5_member where mb_id = '{$mb_id}'";
$res = sql_query($sql);
echo $cnt = sql_num_rows($res);

?>