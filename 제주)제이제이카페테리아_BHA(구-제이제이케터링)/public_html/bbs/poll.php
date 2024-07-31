<?php
include_once('./_common.php');

$is_poll = "poll";
$g5['title'] = '설문조사';
include_once('./_head.php');

echo poll('basic'); // 설문조사 

include_once('./_tail.php');
?>
