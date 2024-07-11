<?
include "../lib/Mall_Admin_Session.php";
?>
<?	
$SQL = "delete from board_comment where c_no = '$c_no' and index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);

if( $dbresult ){
	echo("
		<script>
		//window.alert('삭제 되었습니다.');
		location.href='./board_read.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&mart_id=$mart_id&keyset=$keyset&searchword=$searchword';
		</script>
	");
}else{
	echo("
		<script>
		window.alert('삭제하는데 실패했습니다.');
		history.go(-1);
		</script>
	");
}
?>
<?
mysql_close($dbconn);
?>