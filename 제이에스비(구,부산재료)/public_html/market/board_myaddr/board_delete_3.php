<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";

if($flag == "delete"){
	$SQL = "select username, userfile, userfile1, thread from $New_BoardTable where index_no=$index_no and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	
	$row = mysql_fetch_array($dbresult);

	$username = $row[username];
	$userfile = $row[userfile];
	$userfile1 = $row[userfile1];
	$thread = $row[thread];

	if( $username != $UnameSess ){
		echo ("
			<script language='javascript'>
			window.alert('삭제할 권한이 없습니다');
			history.go(-1);
			</script>
		");	
		exit;
	}else{
		//==================== 리플이 있으면 리플의 step 을 1씩 줄임 =====================
		$sql0 = "select * from $New_BoardTable where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
		$res0 = mysql_query( $sql0, $dbconn );
		$tot0 = mysql_num_rows( $res0 );
		if( $tot0 ){
			$sql1 = "update $New_BoardTable set step = step - 1 where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
			$res1 = mysql_query( $sql1, $dbconn );
			if( !$res1 ){
				echo "
				<script>
					window.alert('리플 업데이트에 실패했습니다.');
					history.go(-1);
				</script>
				";
				exit;
			}
		}

		$upload = "$UploadRoot$mart_id/";
		if( $userfile ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc = "{$upload}{$userfile}";
			unlink($desc);
		}
		if( $userfile1 ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc1 = "{$upload}{$userfile1}";
			unlink($desc1);
		}

		$SQL = "delete from $New_BoardTable where index_no = $index_no and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";

		//관련 코멘트 삭제
		$SQL = "delete from board_comment where index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		echo "<meta http-equiv='refresh' content='0; URL=board_list.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
	}
}
?>
<?
mysql_close($dbconn);
?>