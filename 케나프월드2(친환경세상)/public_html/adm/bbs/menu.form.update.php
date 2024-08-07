<?
	include_once('./_common.php');
	for($i=0;$i<count($cat_idx);$i++){
		$sql="select * from g5_dmenu where bo_table='$bo_table' and wr_id='$wr_id' and cat_idx='$cat_idx[$i]' order by idx asc";
		$result=sql_query($sql);
		$idxArray=array();
		$idx2Array=array();
		$a=0;
		while($row=sql_fetch_array($result)){
			
			if(${idx.$cat_idx[$i]}[$a]==$row[idx]){
			
			}else{
				$sql="delete from g5_dmenu where idx='$row[idx]'";
				sql_query($sql);
			}
			$a++;
			
		}
		for($j=0;$j<count(${me_name.$cat_idx[$i]});$j++){
			$idx2Array[$j]=${idx[$i]}[$j];

			if(${me_name.$cat_idx[$i]}[$j]){
				if(${idx.$cat_idx[$i]}[$j]){
					$sql="update g5_dmenu set 
								me_name='".${me_name.$cat_idx[$i]}[$j]."',
								me_price='".${me_price.$cat_idx[$i]}[$j]."',
								me_image='".${me_image.$cat_idx[$i]}[$j]."',
								me_main_status='".${me_main_status.$cat_idx[$i]}[$j]."'
								where idx='".${idx.$cat_idx[$i]}[$j]."'";
				}else{
					$sql="insert g5_dmenu set 
								bo_table='$bo_table',
								wr_id='$wr_id',
								cat_idx='$cat_idx[$i]',
								me_name='".${me_name.$cat_idx[$i]}[$j]."',
								me_price='".${me_price.$cat_idx[$i]}[$j]."',
								me_image='".${me_image.$cat_idx[$i]}[$j]."',
								me_main_status='".${me_main_status.$cat_idx[$i]}[$j]."'";
				}

				
				sql_query($sql);			
			}

		}
		
	}
	goto_url("./menu.form.php?bo_table=$bo_table&wr_id=$wr_id");
?>