<?php
	include_once("./_common.php");
	for($i=0;$i<count($old_idx);$i++){
		if($idx[$i]==""){
			$sql="delete from g5_model2 where idx='$old_idx[$i]'";
			sql_query($sql);
		}
	}
	for($i=0;$i<count($model);$i++){
		if($model[$i]!=""){
			if($idx[$i]!=""){
				$sql="update g5_model2 set 
						model='$model[$i]',
						day_price='$day_price[$i]',
						insurance_price	='$insurance_price[$i]',
						hour_price='$hour_price[$i]'
						where idx='$idx[$i]'";
			}else{
				$sql="insert g5_model2 set 
					ca_name='$ca_name',
					insurance_price	='$insurance_price[$i]',
					day_price='$day_price[$i]',
					hour_price='$hour_price[$i]',
					model='$model[$i]'";
			}
		}
		sql_query($sql);		
	}
	//goto_url("./car_model.php?ca_name=$ca_name");
?>
<script type="text/javascript">
	opener.document.location.reload();
	location.href="./car_model2.php?ca_name=<?=$ca_name?>";
</script>
<?php exit;?>