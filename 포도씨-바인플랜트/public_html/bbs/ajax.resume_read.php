<?php
include_once("./_common.php");

/** 이력서 다운로드 시 이력서 읽음 표시 (ajax) **/

$result = sql_query(" update g5_resume set read_yn = 'Y' where idx = '{$idx}' ");

echo $result;
exit;
?>