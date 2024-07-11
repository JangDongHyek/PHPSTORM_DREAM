<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
$SQL = "select username,mart_id from $Mart_Member_NewTable order by mart_id, username limit 50000,5001";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	$username = mysql_result($dbresult,$i,0);
	$mart_id = mysql_result($dbresult,$i,1);
	if($username == '') continue;
	
	$SQL0 = "update $Mart_Member_NewTable set money_total = 0 where username='$username' and mart_id='$mart_id'";
	echo "$i sql0=$SQL0 <br>";
	$dbresult0 = mysql_query($SQL0, $dbconn);
		
	$SQL0 = "select order_num from $Order_BuyTable where id = '$username' and mart_id='$mart_id' and status='3' order by index_no desc";
	$dbresult0 = mysql_query($SQL0, $dbconn);
	$numRows0 = mysql_num_rows($dbresult0);
	$sum_total_all = 0;
	for ($j=0; $j<$numRows0; $j++) {
		$order_num = mysql_result($dbresult0,$j,0);
	
		$SQL1 = "select * from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
		$sum_total = 0;
		for ($k=0; $k<$numRows1; $k++) {
			mysql_data_seek($dbresult1,$k);
			$ary = mysql_fetch_array($dbresult1);
			$z_price_tmp = $ary["z_price"];
			$quantity_tmp = $ary["quantity"];
			$sum_tmp = $z_price_tmp * $quantity_tmp;
			$sum_total += $sum_tmp;
		}
		$sum_total_all += $sum_total;
	}
	//echo "sum_total_all=$sum_total_all <br>";
	if($sum_total_all > 0){
		$SQL2 = "update $Mart_Member_NewTable set money_total = money_total + $sum_total_all 
		where username='$username' and mart_id='$mart_id'";
		$dbresult2 = mysql_query($SQL2, $dbconn);
		echo "$i sql2=$SQL2 <br>";
	}
}
?>
<?
mysql_close($dbconn);
?>