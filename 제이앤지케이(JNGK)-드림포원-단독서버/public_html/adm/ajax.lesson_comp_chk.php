<?php
include_once("./_common.php");

$idx = $_POST['idx'];

$count = sql_fetch(" select count(*) as count from g5_lesson_diary where reser_idx = {$idx}; ")['count'];

if($count > 0) {
    die('fail');
} else {
    die('success');
}
?>