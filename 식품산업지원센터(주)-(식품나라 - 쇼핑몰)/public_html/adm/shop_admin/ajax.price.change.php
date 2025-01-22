<?php
	include_once("./_common.php");
	$sql="select count(*) cnt from month_menu_price";
	$row=sql_fetch($sql);
	if(0 < $row[cnt]){
		$sql="update month_menu_price set price='$price'";
	}else{
		$sql="insert month_menu_price set price='$price'";
	}
	sql_query($sql);
	
?>