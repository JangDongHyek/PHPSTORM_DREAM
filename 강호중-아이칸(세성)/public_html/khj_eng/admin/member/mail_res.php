#!/usr/local/bin/php -q
<?
/*$HostName = "localhost";
$DbName = "bluecart";
$Admin = "nx7208";
$AdminPass = "xcvbnm";
$dbconn = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
if ($dbconn == false) {
	echo "데이타베이스 연결 실패!"; exit;
}*/
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
<?
$SQL = "select * from email_res";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	mysql_data_seek($dbresult, $i);
	$ary = mysql_fetch_array($dbresult);
	$email_list = $ary["email_list"];
	$subject = $ary["subject"];
	$shopname = $ary["shopname"];
	$shopmail = $ary["shopmail"];
	$content = $ary["content"];
	$email = explode(',',$email_list);
	for ($j=0; $j < count($email); $j++) {
		mail("$email[$j]", "$subject", "$content", "From: $shopname<$shopmail>\nReturn-Path: $shopmail\nContent-type: text/html", "-f $shopmail");
	}
}
$SQL = "delete from email_res";
$dbresult = mysql_query($SQL, $dbconn);
?>
<?
mysql_close($dbconn);
?>