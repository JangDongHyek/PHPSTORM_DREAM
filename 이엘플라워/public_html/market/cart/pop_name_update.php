<?
//================== DB ���� ������ �ҷ��� ===============================================
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
			echo "<script>alert('��ϵǾ����ϴ�.');location.replace('./pop_name.php');</script>";
		}else{
			echo "<script>alert('������ �Ҿ����մϴ�.');location.replace('./pop_name.php');</script>";
		}
	}else{
		echo "<script>alert('�ִ� ��ϰ����� �ʰ��߽��ϴ�. ���� �׸��� 1���̻��� �����ϰ� ������ּ���.');location.replace('./pop_name.php');</script>";
	}
}else if($_GET['mode'] == "update"){	
	$SQL = " update send_name set mb_name = '$_GET[mb_name]', mb_datetime = '$insert_date' where idx = '$_GET[idx]' and mb_id = '$_GET[mb_id]' ";
	if(mysql_query($SQL, $dbconn)){
		echo "<script>alert('�����Ǿ����ϴ�.');location.replace('./pop_name.php');</script>";
	}else{
			echo "<script>alert('������ �Ҿ����մϴ�.');location.replace('./pop_name.php');</script>";
		}
}else if($_GET['mode'] == "delete"){
	$SQL = " delete from send_name where idx = '$_GET[idx]' and mb_id = '$_GET[mb_id]' ";

	if(mysql_query($SQL, $dbconn)){
		echo "<script>alert('�����Ǿ����ϴ�.');location.replace('./pop_name.php');</script>";
	}else{
		echo "<script>alert('������ �Ҿ����մϴ�.');location.replace('./pop_name.php');</script>";
	}
}
