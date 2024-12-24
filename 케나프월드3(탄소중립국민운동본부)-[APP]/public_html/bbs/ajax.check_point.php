<?php
include_once("./_common.php");

$sql="select mb_point from g5_member where mb_id = '{$_POST['mbid']}'";

$result = sql_fetch($sql);

$arr_result = array();

if($_POST['value'] > $result['mb_point']){
	$arr_result['chkflag'] = 1;	
}
else{
	$arr_result['chkflag'] = 0;	
}
		
	$date = Date("Y-m-d");
	$arr_result['startdate'] = $date;	
	
	if($_POST['period'] != 88 && $_POST['period'] != 77){
	$timestamp = strtotime("+" .$_POST['period']." months");
	$enddate = Date("Y-m-d", $timestamp);
	$arr_result['enddate'] = $enddate;	
	}

	else if($_POST['period'] != 88){	
	$arr_result['enddate'] = '9999-12-31';	
	}

echo json_encode($arr_result);
?>