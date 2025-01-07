<?php
include_once("./_common.php");

$return = sql_fetch(" select co_subject, co_content, co_mobile_content from {$g5['content_save_table']} where co_no = '{$co_no}' ");

echo json_encode($return);
?>