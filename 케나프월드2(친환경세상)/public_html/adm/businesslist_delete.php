<?php
include_once('./_common.php');

for($i=0; $i< count($_POST['chk']); $i++){
	$sql="delete from g5_pay_business where idx = {$_POST['chk'][$i]}";
	sql_query($sql);
}

goto_url('./pay_businesslist.php');
?>