<?php
include_once('./_common.php');


$load_quiz="select wr_content, wr_1 from g5_write_clinic0{$_POST['flag_view']} where ca_name = '{$_POST['value']}'";
$result_quiz = sql_query($load_quiz);
$count_quiz = sql_num_rows($result_quiz);
$row_quiz = sql_fetch_array($result_quiz);
if($count_quiz > 0)
echo 1;
else
echo 0;

?>