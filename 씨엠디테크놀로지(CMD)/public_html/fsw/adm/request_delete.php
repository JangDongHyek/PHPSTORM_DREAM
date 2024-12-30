<?php
include_once("./_common.php");

$sql="delete from g5_fsw_request where idx='$idx'";
sql_query($sql);
goto_url("./request_list.php?sod=$sod&sfl=$sfl&stx=$stx&page=$page");
?>