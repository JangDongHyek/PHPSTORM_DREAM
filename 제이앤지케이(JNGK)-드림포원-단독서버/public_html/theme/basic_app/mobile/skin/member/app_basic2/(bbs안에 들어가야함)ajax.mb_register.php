<?php
include_once("./_common.php");
$type	= $_POST['type'];
$val	= $_POST['val'];

$sql = "select count(*) as cnt from {$g5['member_table']} where {$type} = '{$val}'";
$row = sql_fetch($sql);
echo $row['cnt'];

$type2	= $_POST['type2'];
$val2	= $_POST['val2'];

$sql = "select count(*) as cnt from {$g5['member_table']} where {$type2} = '{$val2}'";
$row = sql_fetch($sql);
echo $row['cnt'];
/*
$row = sql_fetch($sql);		// ������ 1�� ( �������� );

sql_query($sql);			// ���ุ��Ű�°� (insert, update, delete);
$result = sql_query($sql);	// ������ �޾ƿö� (select); 

while($row = sql_fetch_array($result)){	// ��ü select �� �ٳ���  ( ����Ʈ);
	print_r($row);
}

$cnt = sql_num_rows($result);	// select �� ��ü ����

sql_fetch($sql);
*/


?>
