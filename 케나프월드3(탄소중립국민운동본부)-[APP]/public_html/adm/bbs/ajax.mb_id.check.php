<?php
include_once('./_common.php');

$id = strtolower($id);

$sql = "SELECT COUNT(*) AS cnt FROM {$g5['member_table']} 
		WHERE mb_id = '{$id}'";
$result = sql_fetch($sql);

//$returnValue = ($result["cnt"] == 0) ? "<font color='blue'>��� ������ ���̵� �Դϴ�.</font>" : "<font color='red'></font>";


echo $result["cnt"];
?>