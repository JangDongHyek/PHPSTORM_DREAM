<?php
include_once("./_common.php");
$sql="delete from g5_rental_fee where ca_name = '$ca_name'";
sql_query($sql);

for($i=0;$i<count($model);$i++){
	$sql="select * from g5_rental_fee where model='$model[$i]'";
	
	$row=sql_fetch($sql);
	if($row[model]){
	$sql="update g5_rental_fee set 
			ca_name='$ca_name',
			day1='$day1[$i]',
			day3='$day3[$i]',
			day5='$day5[$i]',
			day7='$day7[$i]',
			hour6='$hour6[$i]',
			hour10='$hour10[$i]',
			hour12='$hour12[$i]'
			where model='$model[$i]'
		";
	}else{
		$sql="insert g5_rental_fee set 
			ca_name='$ca_name',
			day1='$day1[$i]',
			day3='$day3[$i]',
			day5='$day5[$i]',
			day7='$day7[$i]',
			hour6='$hour6[$i]',
			hour10='$hour10[$i]',
			hour12='$hour12[$i]',
			model='$model[$i]'
		";
	}

	sql_query($sql);
}
?>
<script type="text/javascript">
	opener.document.location.reload();
	self.close();
</script>

<?php exit;?>