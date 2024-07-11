<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?	

include( '../include/getmartinfo.php' );
	include('../include/head_alltemplate.php');
?>

<?
if( $top_body ){
	//include "$top_body";
}
if( $headhtml ){
	echo "<br>$headhtml";
}


$now_date = date("Y-m-d");


$sql = "select * from item where item_id='$_SESSION[Mall_Admin_ID]'";
$dbresult = mysql_query($sql, $dbconn);
$rows = mysql_fetch_array($dbresult);
if($rows[job_gubun] > 0){
	if($rows[job_end_date] > $now_date){

		echo"<script>location.href='../board_job2/board_write.php?bbs_no=15&gubun=$rows[job_gubun]';</script>";
		exit;
	}
}


if($mode == "update"){
	
	$date = $now_date;
	$date_ex2 = explode("-",$date);	
	$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
	$cdate = strtotime("+$gigan_value day", $date_mktime);
	$sdate = date("Y-m-d", $cdate);


	$sql="update item set job_gubun='$gubun', job_start_date='$now_date', job_end_date='$sdate' where item_id='$_SESSION[Mall_Admin_ID]'";
	$dbresult = mysql_query($sql, $dbconn);

	if($gubun == 3){//근로자는 종목선택해야함
		echo"<script>top.location.href='../../admin/good/job_jungong_suntaek.php';</script>";		
	}else{
		echo"<script>location.href='../board_job2/board_write.php?bbs_no=15&gubun=$gubun';</script>";
	}

/*
	if($gigan_value == 10){
		echo"<script>location.href='../board_job2/board_write.php?bbs_no=15&gubun=$gubun';</script>";
	}
	elseif($gigan_value == 20){
		echo"<script>location.href='../board_job2/board_write.php?bbs_no=15&gubun=$gubun';</script>";
	}
	elseif($gigan_value == 30){
		echo"<script>location.href='../board_job2/board_write.php?bbs_no=15&gubun=$gubun';</script>";
	}
*/
}










?>

</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table border="0" cellpadding="0" cellspacing="0" width="40%" bordercolorlight="#E1E1E1"  align="center">
  <tr>
	 <td vAlign="top" width="646" bgColor="#ffffff" align="center">
		
<?
$SQL = "select * from job_gubun where category_num=$gubun";
$dbresult = mysql_query($SQL, $dbconn);
$row = mysql_fetch_array( $dbresult );
$category_name = $row[category_name];
$category_date = $row[category_date];
$category_desc = $row[category_desc];
$category_degree = $row[category_degree];
$category_img = $row[category_img];

$gigan_money10 = $row[gigan_money10];
$gigan_money20 = $row[gigan_money20];
$gigan_money30 = $row[gigan_money30];





?>
<form action="<?=$PHP_SELF?>">
<input type=hidden name=mode value=update>
<input type=hidden name=gubun value=<?=$gubun?>>
<input type=radio name="gigan_value" value="10" checked> 10일:<?=$gigan_money10?>원&nbsp;&nbsp;
<input type=radio name="gigan_value" value="20"> 20일:<?=$gigan_money20?>원&nbsp;&nbsp;
<input type=radio name="gigan_value" value="30"> 30일:<?=$gigan_money30?>원

<input type=submit  value=" 확 인 ">
</form>



				
	 </td> 
  </tr>
</table>

</body>
</html>
