<?php
include_once('./_common.php');

$love_mb_no = explode(',',$_POST['del_member']);

for($i=0; $i<count($love_mb_no); $i++) {
    sql_query(" delete from g5_member_love where love_mb_no = '{$love_mb_no[$i]}' ");
}

die('success');
?>