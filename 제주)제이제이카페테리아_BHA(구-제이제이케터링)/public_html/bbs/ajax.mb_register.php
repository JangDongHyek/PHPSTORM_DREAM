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
$row = sql_fetch($sql);		// 무조건 1개 ( 상세페이지 );

sql_query($sql);			// 실행만시키는거 (insert, update, delete);
$result = sql_query($sql);	// 정보를 받아올때 (select); 

while($row = sql_fetch_array($result)){	// 전체 select 가 다나옴  ( 리스트);
	print_r($row);
}

$cnt = sql_num_rows($result);	// select 의 전체 갯수

sql_fetch($sql);
*/


?>
