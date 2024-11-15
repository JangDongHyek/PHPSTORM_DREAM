<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

include( '../../market/include/getmartinfo.php' );

$insert_date = date("Y-m-d H:i:s");

if($_POST['mode'] == "insert"){
	$name_sql = " select count(*) as cnt from send_name where mb_id='$UnameSess' ";
	$name_res = mysql_query($name_sql, $dbconn);
	$name_tot = mysql_fetch_array($name_res);
	
	if($name_tot['cnt'] < 5){		
		$SQL = " insert into send_name (mb_id, mb_name, mb_datetime) values ('$UnameSess', '$_POST[mb_name]', '$insert_date') ";	
		if(mysql_query($SQL, $dbconn)){
			echo "<script>alert('등록되었습니다.');location.replace('./pop_name.php');</script>";
		}else{
			echo "<script>alert('서버가 불안정합니다.');location.replace('./pop_name.php');</script>";
		}
	}else{
		echo "<script>alert('최대 등록개수를 초과했습니다. 기존 항목중 1개이상을 삭제하고 등록해주세요.');location.replace('./pop_name.php');</script>";
	}
}else if($_GET['mode'] == "update"){	
	$SQL = " update send_name set mb_name = '$_GET[mb_name]', mb_datetime = '$insert_date' where idx = '$_GET[idx]' and mb_id = '$_GET[mb_id]' ";
	if(mysql_query($SQL, $dbconn)){
		echo "<script>alert('수정되었습니다.');location.replace('./pop_name.php');</script>";
	}else{
			echo "<script>alert('서버가 불안정합니다.');location.replace('./pop_name.php');</script>";
		}
}else if($_GET['mode'] == "delete"){
	$SQL = " delete from send_name where idx = '$_GET[idx]' and mb_id = '$_GET[mb_id]' ";

	if(mysql_query($SQL, $dbconn)){
		echo "<script>alert('삭제되었습니다.');location.replace('./pop_name.php');</script>";
	}else{
		echo "<script>alert('서버가 불안정합니다.');location.replace('./pop_name.php');</script>";
	}
}
