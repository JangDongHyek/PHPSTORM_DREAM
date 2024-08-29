<?
include "../lib/Mall_Admin_Session.php";
?>

<?
	$path="../../up/jsbusan/";
	$fileName=$_FILES[ex_file][name];
	move_uploaded_file($_FILES[ex_file][tmp_name],$path.$fileName);
	$fp=fopen($path.$fileName,"r");
	$csvFile="";
	
	while(($fread=fgets($fp,100000000))){
		$csvFile.=$fread."||";
		
	}
	$csvArray=explode("||",$csvFile);
	for($i=1;$i<count($csvArray)-1;$i++){
		$csvArr=explode(",",$csvArray[$i]);
		if($csvArr[1]=="可记1"){
			$OptionTable="opt_table";
		}else if($csvArr[1]=="可记2"){
			$OptionTable="opt_table2";
		}else if($csvArr[1]=="可记3"){
			$OptionTable="opt_table3";
		}else if($csvArr[1]=="可记4"){
			$OptionTable="opt_table4";
		}
		$csvArr[7]=str_replace("?","",$csvArr[7]);
		if(trim($csvArr[9])=="Y"){
			echo $csvArr[0];
			if($csvArr[0]){
			$sql="delete from $OptionTable  where opt_no='$csvArr[0]' and item_no='$csvArr[2]'";
			
			$result=mysql_query($sql);
			}else{
			
			}
			
		}else{
			if($csvArr[0]){
			$sql="update $OptionTable set opt_name='$csvArr[4]',opt_price='$csvArr[5]',opt_ea='$csvArr[6]',
				  opt_code='$csvArr[7]' where opt_no='$csvArr[0]' and item_no='$csvArr[2]'";
			$result=mysql_query($sql);
			}else{
			
			}
		}
		
		//
		
	}
	@unlink($path.$fileName);
	echo "<script language='javascript'>";
	echo "alert('己傍利栏肺 诀单捞飘登菌嚼聪促.');";
	echo "self.close();";
	echo "</script>";
	exit;
	
?>