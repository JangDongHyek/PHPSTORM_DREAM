<?php
include_once("./_common.php");

$idx = $_POST['idx'];
$memo = $_POST['memo'];

// 프로가 레슨일지를 먼저 등록해야 회원이 조회할 수 있기 때문에 회원이 메모를 등록할 경우 db 업데이트만 가능
$sql = " update g5_lesson_diary set lesson_mb_memo = '{$memo}' where idx = {$idx} ";
sql_query($sql);

die('success');