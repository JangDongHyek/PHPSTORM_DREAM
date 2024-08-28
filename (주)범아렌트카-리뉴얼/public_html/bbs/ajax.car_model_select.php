<?php
	include_once("./_common.php");
	if($cat=="단기대여 서비스"){
		$table="2";
	}else{
		$table="";
	}
	$sql="select * from g5_model{$table} where ca_name='$ca_name'";
	$result=sql_query($sql);
	echo '<option value="">모델명을 선택하세요</option>';
	for($i=0;$row=sql_fetch_array($result);$i++){
?>
	<option value="<?php echo $row[model]?>"><?php echo $row[model]?></option>
<?php }?>
	
