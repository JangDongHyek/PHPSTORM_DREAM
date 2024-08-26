<html>
<head>
<title>
ImageZoom Service
</title>
</head>
<?
include("./globalInc_mysql.php");

$dbconn = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
if ($dbconn == false) {
	echo "데이타베이스 연결 실패!"; exit;
}
$SQL = "select img_high, mart_id from $ItemTable where item_no=$item_no";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$img_high = mysql_result($dbresult,0,0);
$mart_id = mysql_result($dbresult,0,1);
if (strstr(strtolower(substr($img_high,-4)),'.icp')) {//전체확대
	echo "
<body topmargin=0 leftmargin=0 marginheigh=0 marginwidth=0>
<applet code='ImageZoom.class' archive='ImageZoom.jar'width = 500 height = 500 >
<param name='ICPFileName' value='./co_img/$mart_id/$img_high'>
</applet>
	";
}
else if (strstr(strtolower(substr($img_high,-4)),'.ixf')) {//부분
	echo "
<body topmargin=0 leftmargin=0>
<applet code='PhotoZoom.class' archive='PhotoZoom.jar' width = 500 height = 500 >
<param name='ixfFile' value='./co_img/$mart_id/$img_high'>
<param name='mode' value='glass'>
</applet>
	";
}
mysql_close($dbconn);
?>
</body>
</html>	
