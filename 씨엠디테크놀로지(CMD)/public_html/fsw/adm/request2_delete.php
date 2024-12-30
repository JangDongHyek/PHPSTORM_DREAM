<?php
include_once("./_common.php");

$sql="delete from g5_fsw_request2 where idx='$idx'";
sql_query($sql);
goto_url("./request2_list.php?sod=$sod&sfl=$sfl&stx=$stx&page=$page");
?>