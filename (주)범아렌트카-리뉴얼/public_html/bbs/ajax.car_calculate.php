<?php
	include_once("./_common.php");
	$saleArr=array("1",
					"1",
					"1",
					"1",
					"1",
					"1",
					"0.75",
					"0.75",
					"0.75",
					"0.75",
					"0.75",
					"0.75",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55",
					"0.55");
	$secTime=strtotime($_GET['wr_4']." ".$_GET['wr_5'].":00")-strtotime($_GET['wr_2']." ".$_GET['wr_3'].":00");
	$day=$secTime/86400;
	$day=1<=$day?floor($day):0;
	$hour=floor(($secTime%86400)/(60*60));
	$price=0;

	$sql="select * from g5_model2 where model='$wr_9'";
	$row=sql_fetch($sql);
	if($day==0){
		$price+=$row[day_price];//일일요금
		$price+=$wr_10=='true'?$row[insurance_price]:0;
	}else{
		$price+=$day*$row[day_price];//일일요금
		
		$max=0;
		$max1=0;
		$max2=0;
		$maxHour=0;
		if(6<=$hour&&$hour<=11){
			
			$max=(6*$row[hour_price]-$row[hour_price]*0.25*6);
			$maxHour=($hour-6);	
		}else if(11<$hour&&$hour<=23){
			$max=(12*$row[hour_price]-$row[hour_price]*0.45*12);
			$maxHour=($hour-12);	
		}else{
			$maxHour=$hour;
		}
		


		/*if(6<=$hour&&$hour<=11){
			$max=5*$row[hour_price];
			$salePrice=($saleArr[$hour]*$row[hour_price])*($hour-5);
			
			$price+=$max+$salePrice;
		}else if(12<=$hour&&$hour<=23){
			$max=(5*$row[hour_price])+(($saleArr[11]*$row[hour_price])*6);
			$salePrice=($saleArr[$hour]*$row[hour_price])*($hour-11);
			
			$price+=$max+$salePrice;
		}else{
			$price+=$hour*$row[hour_price];//($row[hour_price]*$saleArr[$hour]);
			$price+=$wr_10=='true'?$row[insurance_price]:0;
		}*/
		$price+=($maxHour*$row[hour_price])+$max;//($row[hour_price]*$saleArr[$hour]);
		$price+=$wr_10=='true'?$row[insurance_price]:0;
	}
	echo $price;
?>