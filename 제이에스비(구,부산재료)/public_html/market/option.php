<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect.php";
?>
<?
/*$sql="TRUNCATE TABLE  $OptionTable";
mysql_query($sql);*/
$sql="select opt,opt_old,item_no from $ItemTable where opt<>'' and opt<>'=='";
$result=mysql_query($sql);
if(!$result){
	echo mysql_error();
}
while($rs=mysql_fetch_array($result)){
	$opt = $rs[opt];
	$opts = explode("=", $opt);
	$op1 = explode("!", $opts[0]);
	$op1_count = count($op1);
	/*for($i=0;$i< $op1_count;$i++){
		$op1_1 = explode("^", $op1[$i]);
		$sql="insert  into $OptionTable( `item_no` , `opt_name` , `opt_price` , `opt_ea` , `opt_code` , `opt_order`)  values('$rs[item_no]','$op1_1[0]','$op1_1[1]','0','$op1_1[3]','0')";
		mysql_query($sql);
	}*/
	$sql="update $ItemTable set opt='$op1[0]' where item_no='$rs[item_no]'";
	$result2=mysql_query($sql);
}
?>
<?
mysql_close($dbconn);
?>