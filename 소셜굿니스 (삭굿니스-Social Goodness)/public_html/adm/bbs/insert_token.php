<?php
include_once('./_common.php');

	if(isset($_POST["Token"])){

		$token = $_POST["Token"];
		
		$sql = "insert push_token set token = '".$token."'";
		sql_query($sql);		
	}

?>