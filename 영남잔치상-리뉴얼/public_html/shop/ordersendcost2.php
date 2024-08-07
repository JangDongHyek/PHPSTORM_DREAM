<?php
include_once('./_common.php');

$code = preg_replace('#[^0-9]#', '', $_POST['zipcode']);
$sql="select sc_zip1,sc_zip2,sc_name from {$g5['g5_shop_sendcost_table']}";
$result=sql_query($sql);
for($i=0;$row=sql_fetch_array($result);$i++){
	if(-1 < strpos($_GET[sc_name],$row[sc_name])) {
		$code=$row[sc_zip1];
		break;
	}
}


?>