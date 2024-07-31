<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/survey.lib.php');

$is_survey = "survey";
$g5['title'] = 'Survey';
include_once('./_head.php');

echo survey('basic'); // 설문조사 

include_once('./_tail.php');
?>
