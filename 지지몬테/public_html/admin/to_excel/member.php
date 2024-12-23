<? 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=member.xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 
?>
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
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<style>
<!--
.shopstyle
	{mso-style-parent:style0;
	border:.5pt solid black;
	white-space:normal;}
-->
</style>
</head>

<body bgcolor=white > 
<table cellspacing=0 cellpadding=2 border=0 > 
<tr>
	<td class=shopstyle width='15%'>
		ID</td>
	<td class=shopstyle width='15%'>
		비밀번호</td>
	<td class=shopstyle width='11%'>
		성명</td>
	<td class=shopstyle width='11%'>
		주민번호</td>
	<td class=shopstyle width='26%'>
		이메일</td>
	<td class=shopstyle width='26%'>
		연락처</td>
	<td class=shopstyle width='26%'>
		기타연락처</td>
	<td class=shopstyle width='26%'>
		우편번호</td>
	<td class=shopstyle width='26%'>
		주소</td>
	<td class=shopstyle width='26%'>
		상세주소</td>
	<td class=shopstyle width='15%'>
		가입일</td>
	<td class=shopstyle width='10%'>
		마일리지</td>
</tr>
<? 
if($order == '') $order = 'date';
if($orderby == '') $orderby = 'desc';

$SQL1 = "select * from $Mart_Member_NewTable where mart_id='$mart_id'";
$SQL2 = " and $keyset like '%$searchword%' ";
$SQL3 = " order by $order $orderby";
if($keyset!=""&&$searchword!="")
	$SQL=$SQL1.$SQL2.$SQL3;
else
	$SQL=$SQL1.$SQL3;

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$username = $ary["username"];
	$password = $ary["password"];
	$name = $ary["name"];
	$passport1 = $ary["passport1"];
	$passport2 = $ary["passport2"];
	$age = $ary["age"];
	$birth = $ary["birth"];
	$email = $ary["email"];
	$tel = $ary["tel"];
	$tel1 = $ary["tel1"];
	$zip = $ary["zip"];
	$resd = $ary["resd"];
	$address = $ary["address"];
	$address_d = $ary["address_d"];
	$date = $ary["date"];
	$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
	$is_member = $ary["is_member"];
	$if_maillist = $ary["if_maillist"];
	$bonus_total = number_format($ary["bonus_total"]);
	
	if($if_maillist == '1') $if_maillist_str ="<img src='../images/y.gif'>";
	else $if_maillist_str ="<img src='../images/n.gif'>";
	/*
	$SQL1 = "select * from $BonusTable where mart_id='$mart_id' and id = '$username'";
	//echo "sql1=$SQL1";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	$sum = 0;
	for ($j=0; $j<$numRows1; $j++) {
		mysql_data_seek($dbresult1,$j);
		$ary1 = mysql_fetch_array($dbresult1);
		$bonus = $ary1["bonus"];
		$sum = $sum + $bonus;
	}
	$sum_str = number_format($sum);
	*/
	echo "
<tr>
	<td class=shopstyle width='15%'>
		$username</td>
	<td class=shopstyle width='15%'>
		$password</td>
	<td class=shopstyle width='11%'>
		$name</td>
	<td class=shopstyle width='11%'>
		$passport1-$passport2</td>
	<td class=shopstyle width='26%'>
		$email</td>
	<td class=shopstyle width='26%'>
		$tel</td>
	<td class=shopstyle width='26%'>
		$tel1</td>
	<td class=shopstyle width='26%'>
		$zip</td>
	<td class=shopstyle width='26%'>
		$address</td>
	<td class=shopstyle width='26%'>
		$address_d</td>
	<td class=shopstyle width='15%'>
		$date_str</td>
	<td class=shopstyle width='10%'>
		$bonus_total</td>
</tr>
	";
}
?>
</table> 
</body> 
</html> 
<?
mysql_close($dbconn);
?>