<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect.php";
?>
<?
$SQL = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$shopuser = mysql_result($dbresult, 0, "shopuser");

$SQL = "select * from $MartDesignTable where mart_id ='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$if_use_intro = $ary["if_use_intro"];
}
if($shopuser == 0){
	if($if_use_intro == 1)
		echo "<meta http-equiv='refresh' content='0; URL=./main/index_intro.php?mart_id=$mart_id'>";
	else
		echo "<meta http-equiv='refresh' content='0; URL=./main/index.php?mart_id=$mart_id'>";
}
if($shopuser == 1){
	echo "<meta http-equiv='refresh' content='0; URL=./main/adult_login.php?mart_id=$mart_id'>";
}
if($shopuser == 2){
	if($if_use_intro == 1)
		echo "<meta http-equiv='refresh' content='0; URL=./main/index_intro.php?mart_id=$mart_id'>";
	else
		echo "<meta http-equiv='refresh' content='0; URL=./main/index.php?mart_id=$mart_id'>";
}
if($shopuser == 3){
	$insert=0;
	$member_session="Member_Session";
	if(isset($HTTP_COOKIE_VARS[$member_session])&&$HTTP_COOKIE_VARS[$member_session]!=""){
		$SQL = "select * from active_sessions where sid='$HTTP_COOKIE_VARS[$member_session]'";
		$dbresult = mysql_query($SQL, $dbconn);
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$strVal = $ary["val"];
		if(strstr($strVal,"member_session")){
			$insert=1;
		}
	}
	
	if($insert == 1) { 
		echo "<meta http-equiv='refresh' content='0; URL=./main/index.php?mart_id=$mart_id'>";
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=./main/b2b_login.php?mart_id=$mart_id'>";
	}
}
mysql_close($dbconn);
?>