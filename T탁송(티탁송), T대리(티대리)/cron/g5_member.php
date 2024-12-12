<?php
include_once("../jl/JlConfig.php");

file_put_contents('/home/tdaeri2/www/cron/log.txt', "Cron job executed at " . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);

$g5_member = new JlModel(array("table"=>"g5_member"));


$g5_member->where("mb_level" , 9);
$g5_member->addSql(" AND mb_datetime < DATE_SUB(NOW(), INTERVAL 7 DAY)");
$g5_member->where("mb_use" , "N");

$g5_member->whereDelete();
?>