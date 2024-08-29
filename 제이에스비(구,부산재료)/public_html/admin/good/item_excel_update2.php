<?
include "../lib/Mall_Admin_Session.php";
?>

<?
	$path="../../up/jsbusan/";
	$fileName=$_FILES[ex_file][name];
	move_uploaded_file($_FILES[ex_file][tmp_name],$path.$fileName);
	$fp=fopen($path.$fileName,"r");
	$csvFile="";
	while(($fread=fgets($fp,10000000))){
		$csvFile.=$fread."||";
		
	}
	$csvArray=explode("||",$csvFile);
	for($i=1;$i<count($csvArray)-1;$i++){
		$csvArr=explode(",",$csvArray[$i]);
		$csvArr[4]=str_replace("?","",$csvArr[4]);
		$if_hide="0";
		if(trim($csvArr[21])=="숨김"){$if_hide="1";}
		$sql="update item set item_name='$csvArr[1]',item_company='$csvArr[2]',item_kyukyuk='$csvArr[3]',
			  item_code='$csvArr[4]',jaego_use='$csvArr[5]',jaego='$csvArr[6]',member_price='$csvArr[7]'
			  ,g_margin='$csvArr[8]',z_price='$csvArr[9]',bonus='$csvArr[10]',price='$csvArr[11]',opt='$csvArr[12]',opt2='$csvArr[13]',opt3='$csvArr[14]',opt4='$csvArr[15]',if_opt_jaego='$csvArr[16]',if_opt_jaego2='$csvArr[17]',if_opt_jaego3='$csvArr[18]',if_opt_jaego4='$csvArr[19]',fee='$csvArr[20]',if_hide='$if_hide'
			  where item_no='$csvArr[0]'";
		$result=mysql_query($sql);
		if(!$result){
			echo mysql_error();
			echo mysql_errno();
			exit;
		}
		
	}
	@unlink($path.$fileName);
	echo "<script language='javascript'>";
	echo "alert('성공적으로 업데이트되었습니다.');";
	echo "self.close();";
	echo "</script>";
	exit;
	
?>