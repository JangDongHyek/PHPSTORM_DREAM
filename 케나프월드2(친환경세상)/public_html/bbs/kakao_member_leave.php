<?php
include_once('./_common.php');


sql_fetch("update `g5_member` set `mb_level` = '1' where `mb_id` = '678302394'");

echo 200;

?>