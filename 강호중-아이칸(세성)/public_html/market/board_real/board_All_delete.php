<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
foreach($index_no as $key => $i_no){
	$SQL = "select passwd, userfile, userfile1, thread from $New_BoardTable where index_no=$i_no and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(!$dbresult){
		echo mysql_error();
	}
	if ($dbresult == false) echo "쿼리 실행 실패!";
	
	$row = mysql_fetch_array($dbresult);

	$passwd_db = $row[passwd];
	$username = $row[username];
	$userfile = $row[userfile];
	$userfile1 = $row[userfile1];
	$thread = $row[thread];
	
	$upload = "$UploadRoot$mart_id/";
	if( $userfile ){ //해당번호에 파일이 있다면 파일을 삭제함
		$desc = "{$upload}{$userfile}";
		unlink($desc);
	}
	if( $userfile1 ){ //해당번호에 파일이 있다면 파일을 삭제함
		$desc1 = "{$upload}{$userfile1}";
		unlink($desc1);
	}
	$SQL = "delete from $New_BoardTable where index_no = $i_no and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
$SQL1 = "select * from $New_BoardTable where bbs_no = '$bbs_no' $open_chk_query and mart_id = '$mart_id' "; 
$SQL2 = "and binary $keyset like '%$searchword%' ";
$SQL2_1 = "and (binary writer like '%$searchword%' or binary subject_new like '%$searchword%' or binary content like '%$searchword%') ";
$SQL3 = "order by ansno asc limit $skipNum, $cnfPagecount";
$SQL=$SQL1.$SQL3;
$dbresult = mysql_query($SQL, $dbconn);
$cnt = mysql_num_rows($dbresult);
if(!$cnt){
	$page1=$page1-1;
}
if(!$searchword){
	$keyset="";
}
echo "<meta http-equiv='refresh' content='0; URL=board_list.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword&page=$page1'>";
?>
<?
mysql_close($dbconn);
?>