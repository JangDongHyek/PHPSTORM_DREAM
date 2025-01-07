<?php
$sub_menu = '300000';
include_once('./_common.php');
$sql="delete from g5_item where idx='$idx'";
sql_query($sql);
goto_url("./item_list.php");
?>