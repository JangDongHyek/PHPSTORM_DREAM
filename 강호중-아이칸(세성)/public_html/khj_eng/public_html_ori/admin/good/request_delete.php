<?
include "../lib/Mall_Admin_Session.php";

if($flag=="insert"){
	$sql  = "select * from item where item_no='$item_no'";
	$res  = mysql_query($sql,$dbconn);
	$rows = mysql_fetch_array($res);

	$firstno = $rows[firstno];
	$prevno = $rows[prevno];
	$thirdno = $rows[thirdno];
	$category_num = $rows[category_num];

	
	$regdate = date("Y-m-d H:i:s");
	$sql = "insert into request_delete (seq_num,firstno,prevno,thirdno,category_num,item_no,update_yn,regdate) values ('','$firstno','$prevno','$thirdno','$category_num','$item_no','n','$regdate')";
	$res = mysql_query($sql,$dbconn);

	echo "
		<script>
			alert('삭제요청을 하였습니다.');window.close();
		</script>
	";
	exit;
}
?>
