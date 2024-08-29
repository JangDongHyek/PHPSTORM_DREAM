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
$SQL = "select * from $MartIntroTable where mart_id='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$help = mysql_result($dbresult, 0, "help");
$attach = mysql_result($dbresult, 0, "attach");
$attach1 = mysql_result($dbresult, 0, "attach1");
$help = nl2br($help);

?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<table border="0" width="580">
<tr>
    <td width="576">
    	<img src="../images/comtitle.gif" alt="comtitle.gif (1384 bytes)" WIDTH="150" HEIGHT="31"></td>
</tr>
<tr>
    <td width="576" height="20"></td>
</tr>
<tr>
    <td width="572"><p style="padding-left: 10px">
    	<img height="173" src='<?echo "$Co_img_DOWN$mart_id/intro_img/$attach"?>' width="154" align="left" hspace="5">
    	<?echo $help?>
    </td>
</tr>
<tr>
    <td width="576"></td>
</tr>
<tr>
    <td width="576" height="20"></td>
</tr>
<tr>
    <td width="576">
    	<img src="../images/map.gif" hspace="10" WIDTH="128" HEIGHT="20"></td>
</tr>
<tr>
    <td width="576"><p align="center"><br>
    	<img src='<?echo "$Co_img_DOWN$mart_id/intro_img/$attach1"?>' WIDTH="450" HEIGHT="350"></td>
</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>