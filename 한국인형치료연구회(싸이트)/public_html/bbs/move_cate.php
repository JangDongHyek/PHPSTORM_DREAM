<?php
	include_once('./_common.php');

	if(!empty($wr_id_list)){

			$arr_wrids  = explode(',',$wr_id_list);
			$chk_cate = trim($chk_cate);
			

			for($i=0; $i<count($arr_wrids); $i++){

		
				$sql ="update g5_write_{$bo_table} set ca_name = '{$chk_cate}' where wr_id = {$arr_wrids[$i]}";		
				sql_query($sql);
				
			}

			echo '<script>opener.document.location.reload(); window.close();</script>';


	}
	




?>