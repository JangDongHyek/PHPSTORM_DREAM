<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$t_regdate = date("Y-m-d H:i:s");

$t_money = str_replace( ",", "", $t_money );

if($flag == "insert"){
	//========================== ������ȣ�� �ߺ��Ǿ����� �˻��� ==========================
	$sql0 = "select * from $TicketTable where t_title='$t_title'";
	$res0 = mysql_query( $sql0, $dbconn );
	$tot0 = mysql_num_rows( $res0 );

	if( $tot0 > 0 ){
		echo ("
			<script>
			alert('������ȣ�� �ߺ��Դϴ�.');
			history.go(-1);
			</script>
		");
		exit;
	}

	$sql = "insert into $TicketTable ( t_uid, mart_id, provider_id, t_title, t_money, t_name, t_jumin1, t_jumin2, t_date, t_ok, t_yes, t_regdate ) values ( '', '$mart_id', '$provider_id', '$t_title', '$t_money', '$t_name', '$t_jumin1', '$t_jumin2', '$t_date', 'n', 'y', '$t_regdate' )";
	$result = mysql_query($sql, $dbconn);
	if( $result ){
		echo "
			<script>
			alert('����߽��ϴ�.');
			</script>
			<meta http-equiv='refresh' content='0; URL= list.php?page=$page&keyset=$keyset&searchword=$searchword'>
		";
	}else{
		echo ("
			<script>
			alert('����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}

if($flag == "update"){
	$SQL = "update $TicketTable set t_title='$t_title' , t_money='$t_money', t_name='$t_name', t_jumin1='$t_jumin1', t_jumin2='$t_jumin2', t_date='$t_date' where t_uid='$t_uid'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= view.php?t_uid=$t_uid&page=$page&keyset=$keyset&searchword=$searchword'>";
	}else{
		echo ("
			<script>
			alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}

if($flag == "cancel"){
	$SQL = "update $TicketTable set t_yes='n' where t_uid='$t_uid'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		if( $mode == 'view' ){
			echo "
				<script>
				alert('����߽��ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL= view.php?page=$page&keyset=$keyset&searchword=$searchword&t_uid=$t_uid'>
			";

		}else{
			echo "
				<script>
				alert('����߽��ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL= list.php?page=$page&keyset=$keyset&searchword=$searchword'>
			";
		}
	}else{
		echo ("
			<script>
			alert('����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}

if($flag == "ok"){
	$SQL = "update $TicketTable set t_yes='y' where t_uid='$t_uid'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		if( $mode == 'view' ){
			echo "
				<script>
				alert('�����߽��ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL= view.php?page=$page&keyset=$keyset&searchword=$searchword&t_uid=$t_uid'>
			";

		}else{
			echo "
				<script>
				alert('�����߽��ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL= list.php?page=$page&keyset=$keyset&searchword=$searchword'>
			";
		}
	}else{
		echo ("
			<script>
			alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}

if($flag=="del"){	
	$SQL = "delete from $TicketTable where t_uid='$t_uid'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= list.php?page=$page&keyset=$keyset&searchword=$searchword'>";
	}else{
		echo ("
			<script>
			alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}
?>
<?
mysql_close($dbconn);
?>