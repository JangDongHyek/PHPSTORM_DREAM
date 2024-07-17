<?php
include_once('./_common.php');

$mb = get_member($member[mb_id]);

if($mb['mb_id'] == null || $mb['mb_id'] == "") return;

if($mb['mb_level'] >= 9) return;

$change_mb_level = $mb['mb_level'] == 3 ? 2:3;

$sql = "update `g5_member` set `mb_level` = '$change_mb_level' where `mb_id` = '$mb[mb_id]'";
sql_query($sql);


echo $sql;
