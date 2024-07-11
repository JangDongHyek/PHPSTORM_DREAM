<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 설정 파일을 불러옴 =============================================
include "../../main.class";
?><?

if($flag=="insert"){
	$sql  = "select * from new_board where bbs_no='$bbs_no' and index_no='$index_no'";
	$res  = mysql_query($sql,$dbconn);
	$rows = mysql_fetch_array($res);

	$firstno = $rows[firstno];
	$prevno = $rows[prevno];
	$thirdno = $rows[thirdno];
	$category_num = $rows[category_num];

	
	$regdate = date("Y-m-d H:i:s");
	$sql = "insert into request_delete_board (seq_num,firstno,prevno,thirdno,category_num,item_no,update_yn,regdate,index_no,bbs_no) values ('','$firstno','$prevno','$thirdno','$category_num','$_SESSION[Mall_Admin_ID]','n','$regdate','$index_no','$bbs_no')";
	$res = mysql_query($sql,$dbconn);




	echo "
		<script>
			alert('삭제요청을 하였습니다.');window.close();
		</script>
	";
	exit;
}
?>
