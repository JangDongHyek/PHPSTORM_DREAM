<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect.php";
?>
<?
$sql="select opt,item_no from $ItemTable where opt<>'' and opt<>'=='";
$result=mysql_query($sql);
while($rs=mysql_fetch_array($result)){
	$opt = $rs[opt];
	$opts = explode("=", $opt);
	$op1 = explode("!", $opts[0]);
	$op1_count = count($op1);
	for($i=0;$i< $op1_count;$i++){
		$op1_1 = explode("^", $op1[$i]);
		echo $rs[item_no]."-".$op1_1[0]."<br>";
	}
}
?>
<?
mysql_close($dbconn);
?>