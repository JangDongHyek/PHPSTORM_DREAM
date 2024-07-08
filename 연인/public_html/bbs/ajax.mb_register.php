<?php
include_once("./_common.php");

set_session('ss_check_mb_id', '');

$type	= $_POST['type'];
$val	= $_POST['val'];

$sql = "select count(*) as cnt from {$g5['member_table']} where {$type} = '{$val}'";
$row = sql_fetch($sql);

if ($type = 'mb_id' && $row['cnt'] == 0) {
	set_session('ss_check_mb_id', $val);
}

echo $row['cnt'];



?>