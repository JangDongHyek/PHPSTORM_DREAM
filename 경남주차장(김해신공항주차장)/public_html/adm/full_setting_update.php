<?php
include_once('./_common.php');
for($i=1;$i<=4;$i++){
	$sql="update g5_fullsetting set full='${full.$i}' where idx='$i'";
	sql_query($sql);
}
goto_url("./full_setting.php");
?>
