<?
	$path="./up/jsbusan";
	$fileName=$_FILES[ex_file][name];
	move_uploaded_file($_FILES[ex_file][tmp_name],$path."/".$fileName);
	$fp=fopen($path."/".$fileName,"r");
	$csvFile="";
	while(($fread=fgets($fp,1000))){
		$csvFile.=$fread."||";
		
	}
	$csvArray=explode("||",$csvFile);
	for($i=1;$i<count($csvArray);$i++){
		$csvArr=explode(",",$csvArray[$i]);
		$sql="update item set item_name='$csvArr[1]',item_company='$csvArr[2]',item_kyukyuk='$csvArr[3]',
			  item_code='$csvArr[4]',jaego_use='$csvArr[5]',jaego='$csvArr[6]',member_price='$csvArr[7]'
			  ,g_margin='$csvArr[8]',z_price='$csvArr[9]',bonus='$csvArr[10]',price='$csvArr[11]',fee='$csvArr[12]'
			  where item_no='$csvArr[0]'";
			  echo $sql;
		//echo $csvFile[$i];
	}
	/*while(($csvData=fgetcsv($fp,10000,"\n"))!==false){
		echo count($csvData);
		/*for($i=0;$i<count($csvData);$i++){
			echo $i."-";
			echo $csvData[$i]."<br>";
		}
	}*/
?>