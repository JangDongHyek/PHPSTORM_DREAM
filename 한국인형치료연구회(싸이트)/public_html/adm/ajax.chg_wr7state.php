<?php

	include_once('./_common.php');

	if($value!='' && $id!='' && !empty($table)){

				$sql ="update g5_write_{$table} set wr_7 = {$value} where wr_id ={$id}";		
				echo $sql;
				sql_query($sql);
	
	}



?>