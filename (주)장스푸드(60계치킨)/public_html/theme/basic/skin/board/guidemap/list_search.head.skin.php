<?php
	$city = "";
	$city2 = "";

	if($si)
		$city .= "".$si;
	if($gu)
		$city .= " ".$gu;
	if($dong)
		$city .= " ".$dong;

	if($si == "세종") {
		$city = "세종특별자치시";
		$city2 = " and wr_1 like '%".$dong."%' ";
	}
	if($bo_table!="store"){
		$sql_search .= " and wr_1 like '".$city."%' $city2";
	}
?>