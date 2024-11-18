<?php
include_once('./_common.php');

if($member['mb_id'] != "lets080" && $member['mb_id'] != "admin" && $member['mb_id'] != "admin2" && $member['mb_id'] != "admin3"){
    $print['code'] = "-1";
    $print['msg'] = "";
    die(json_encode($print));
}

$sql = "update `g5_write_cs` set `wr_10` = '$wr_state' where `wr_id` = '$wr_id'";
sql_query($sql);

$print['code'] = "200";
$print['msg'] = "";
die(json_encode($print));