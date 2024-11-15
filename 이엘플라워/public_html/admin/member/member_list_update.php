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
$SQL = "select username,mart_id from $Mart_Member_NewTable order by mart_id, username limit 28000,2001";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	$username = mysql_result($dbresult,$i,0);
	$mart_id = mysql_result($dbresult,$i,1);
	if($username == '') continue;
	$SQL1 = "select bonus from $BonusTable where mart_id ='$mart_id' and id = '$username'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	$sum = 0;
	for ($j=0; $j<$numRows1; $j++) {
		$bonus = mysql_result($dbresult1,$j,0);
		$sum = $sum + $bonus;
	}
	$SQL2 = "update $Mart_Member_NewTable set bonus_total=$sum where mart_id ='$mart_id' and username = '$username'";
	echo "$i sql2=$SQL2 <br>" ;
	$dbresult2 = mysql_query($SQL2, $dbconn);
}
?>
<?
mysql_close($dbconn);
?>