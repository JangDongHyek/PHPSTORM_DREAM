<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";

if($flag == "delete"){
	$SQL = "select username, userfile, userfile1, thread from $New_BoardTable where index_no=$index_no and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	
	$row = mysql_fetch_array($dbresult);

	$username = $row[username];
	$userfile = $row[userfile];
	$userfile1 = $row[userfile1];
	$thread = $row[thread];

	if( $username != $UnameSess ){
		echo ("
			<script language='javascript'>
			window.alert('������ ������ �����ϴ�');
			history.go(-1);
			</script>
		");	
		exit;
	}else{
		//==================== ������ ������ ������ step �� 1�� ���� =====================
		$sql0 = "select * from $New_BoardTable where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
		$res0 = mysql_query( $sql0, $dbconn );
		$tot0 = mysql_num_rows( $res0 );
		if( $tot0 ){
			$sql1 = "update $New_BoardTable set step = step - 1 where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
			$res1 = mysql_query( $sql1, $dbconn );
			if( !$res1 ){
				echo "
				<script>
					window.alert('���� ������Ʈ�� �����߽��ϴ�.');
					history.go(-1);
				</script>
				";
				exit;
			}
		}

		$upload = "$UploadRoot$mart_id/";
		if( $userfile ){ //�ش��ȣ�� ������ �ִٸ� ������ ������
			$desc = "{$upload}{$userfile}";
			unlink($desc);
		}
		if( $userfile1 ){ //�ش��ȣ�� ������ �ִٸ� ������ ������
			$desc1 = "{$upload}{$userfile1}";
			unlink($desc1);
		}

		$SQL = "delete from $New_BoardTable where index_no = $index_no and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "���� ���� ����!";

		//���� �ڸ�Ʈ ����
		$SQL = "delete from board_comment where index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		echo "<meta http-equiv='refresh' content='0; URL=board_list.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
	}
}
?>
<?
mysql_close($dbconn);
?>