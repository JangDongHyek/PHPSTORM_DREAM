<?php
	$city = "";
	if($si)
		$city .= "".$si;
	if($gu)
		$city .= " ".$gu;
	if($dong)
		$city .= " ".$dong;
	
	$sql_search .= " and wr_1 like '".$city."%'";
?>