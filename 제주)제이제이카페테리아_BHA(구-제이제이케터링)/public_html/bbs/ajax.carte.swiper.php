<?php

	include_once('./_common.php');
	
	$sql="select * from g5_carte_images where date = '{$date}' and sheet = {$sheet} and tmcate = '{$sme}' ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++){
?>
	  <div class="swiper-slide"><img src="<?=G5_DATA_URL.'/file/carte/'.$row['file_path']?>" /></div>
<?}?>