<?php
/************************************************
(기사)회원수정 - 은행정보변경
mb_user_acc : 출금계좌 승인여부
************************************************/
include_once('./_common.php');

$json = array();
$json['post'] = $_POST;

$sql = "UPDATE g5_member SET 
		mb_6 = '{$mb_6}',
		mb_7 = '{$mb_7}',
		mb_8 = '{$mb_8}',
		mb_9 = '{$mb_9}',
		mb_10 = '{$mb_10}',
		mb_namechk_tid = '{$mb_tid}',
		mb_user_acc = 'Y'
		WHERE mb_id = '{$mb_id}'
		";

$json['sql'] = $sql;
$json['result'] = (sql_query($sql))? "T" : "F";

echo json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>