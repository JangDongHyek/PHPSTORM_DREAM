<?php
include_once('./_common.php');
for ($i=0; $i<count($_POST['chk']); $i++) {
	$k = $_POST['chk'][$i];
	
	
	$sql="delete from g5_write_b_reserv where wr_id='$wr_idx[$k]'";
	sql_query($sql);
}
goto_url("./reserv_list.php");
?>