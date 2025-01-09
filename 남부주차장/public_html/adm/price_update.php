<?php
$sub_menu = "400000";
include_once('./_common.php');
$sql="select * from g5_price";
$result=sql_query($sql);
$cnt=sql_num_rows($result);
if(0 < $cnt){
	$sql="update g5_price set price='$price'";

}else{
	$sql="insert g5_price set price='$price'";	
}

sql_query($sql);
goto_url("./price.php");

?>