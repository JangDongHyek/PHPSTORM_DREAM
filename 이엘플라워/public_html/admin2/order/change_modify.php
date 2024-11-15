<?
include "../lib/Mall_Admin_Session.php";

$table = "changegood";

if( $flag == "update" ){
	$c_content = str_replace( "\n", "<br>", $c_content );

	//==========================================================================================
	$query = "update $table set c_title='$c_title', c_order_num='$c_order_num', c_name='$c_name', c_email='$c_email', c_phone='$c_phone', c_content='$c_content'  where c_uid='$c_uid'";

	$result = mysql_query( $query, $dbconn );

	if( $result ){
		echo("
			<script>
			window.alert('수정했습니다!');
			</script>
			<meta http-equiv='Refresh' content='0; URL=change_edit.php?c_uid=$c_uid&code=$code&mode=$mode&select_key=$select_key&input_key=$input_key&page=$page'>
		");
	}else{
		echo("
			<script>
			window.alert('수정하는데 실패했습니다!');
			history.go(-1)
			</script>
		");
		exit;
	}
}

if( $flag == "delete" ){
	$dbdel = "delete from $table where c_uid='$c_uid'";
	$result = mysql_query($dbdel, $dbconn);

	//========================================================================================

	if( $result ){
		echo("
			<meta http-equiv='Refresh' content='0; URL=change_list.php?code=$code&mode=$mode&select_key=$select_key&input_key=$input_key&page=$page'>
		");
	}else{
		echo("
			<script>
			window.alert('삭제하기에 실패했습니다!');
			history.go(-1)
			</script>
		");
		exit;
	}
}

mysql_close($dbconn);
?>