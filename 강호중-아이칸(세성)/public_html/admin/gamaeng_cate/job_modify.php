<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//================== 분류를 추가함 ===================================================
if($flag == "addcategory") {
	$SQL = "select max(category_num), count(*) from job_gubun";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	else
		$maxCategory_num = 30;	// 27 이하는 이획상품
		
	$SQL = "select max(cat_order), count(*) from job_gubun where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxOrder = mysql_result($dbresult, 0, 0);
	else
		$maxOrder = 0;
		
	$category_date = date("Y-m-d H:i:s");
	
	if (isset($prevno) == false || $prevno == "") $prevno = 0;
	else $maxOrder = 0;
	
	$SQL = "insert into job_gubun (mart_id, category_num, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, $prevno, '$category_name', '$category_date', '1', $maxOrder+1)";

	$dbresult = mysql_query($SQL, $dbconn);

	$current_num = mysql_insert_id();
	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php?#$current_num'>";
}
//========================================================================================
//================== 분류를 수정함 ===================================================
if($flag == "update"){

	
	$money = str_replace(",","",$money);
	$gigan = str_replace(",","",$gigan);


	$SQL = "update job_gubun set category_name='$category_name', category_html='$category_html', category_left='$category_left', if_hide='$if_hide',gigan_money10='$gigan_money10',gigan_money20='$gigan_money20',gigan_money30='$gigan_money30' where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	

	

	if(!empty($url))
		echo "<meta http-equiv='refresh' content='0; URL=category_edit_job.php?category_num=$category_num'>";
	else
		echo "<meta http-equiv='refresh' content='0; URL=category_edit_job.php?category_num=$category_num'>";
}
//========================================================================================
//================== 분류를 삭제함 ===================================================
if($flag == "delcategory"){
	$SQL = "select * from job_gubun where prevno=$category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"하위 분류가 있어 삭제할 수 없습니다.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php'>";
		exit;
	}
	/*
	$SQL = "select item_no from $ItemTable where category_num=$category_num and mart_id='$mart_id'
	UNION select item_no from $Gnt_ItemTable where category_num=$category_num and seller_id='$Mall_Admin_ID'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"분류에 속한 제품이 있어 삭제할 수 없습니다.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php'>";
		exit;
	}
	*/				
	$SQL = "delete from job_gubun where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php'>";
}
//========================================================================================
//================== 공급분류를 삭제함 ===============================================
/** 사용안함
if($flag == "del_gnt_category_s"){
	$SQL = "select * from $Gnt_ItemTable where seller_id='$Mall_Admin_ID' and gnt_category_num_s=$gnt_category_num_s";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"분류에 속한 상품이 있어 삭제할 수 없습니다.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php'>";
		exit;
	}
	//분류명 설정해놓은거 삭제
	$SQL = "delete from $Gnt_Category_NameTable where seller_id = '$Mall_Admin_ID' and gnt_category_num = '$gnt_category_num_s'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	//하위 분류 삭제
	$SQL = "delete from $Gnt_Category_UseTable where seller_id = '$Mall_Admin_ID' and gnt_category_num_s = '$gnt_category_num_s'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php'>";
} **/
//========================================================================================
//================== 2차 분류를 추가함 ===============================================
if( $st == "2"){ //2차 분류 생성
	$SQL = "select max(category_num), count(*) from job_gubun";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from job_gubun where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");

	$SQL = "insert into job_gubun (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '1', '$prevno', '$category2_name', '$category_date', '$category_desc', $maxOrder+1)";

	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php?#$prevno'>";
}
//========================================================================================
//================== 3차 분류를 추가함 ===============================================
if( $st == "3"){ //3차 분류 생성
	$SQL = "select max(category_num), count(*) from job_gubun";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from job_gubun where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");
		
	$SQL = "insert into job_gubun (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '2', '$prevno', '$category3_name', '$category_date', '$category_desc', $maxOrder+1)";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php?#$prevno'>";
}
//================== 3차 분류를 추가함 ===============================================
if( $st == "4"){ //3차 분류 생성
	$SQL = "select max(category_num), count(*) from job_gubun";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from job_gubun where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");
		
	$SQL = "insert into job_gubun (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '3', '$prevno', '$category4_name', '$category_date', '$category_desc', $maxOrder+1)";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php?#$prevno'>";
}
//========================================================================================
//================== 분류를 한단계 올림 ==============================================
if($flag == "up"){ //한단계 올리기
	$SQL = "select cat_order from job_gubun where prevno=$prevno and cat_order > $cat_order and mart_id='$mart_id' order by cat_order asc";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_cat_order = mysql_result($dbresult,0,0);

	$SQL = "select category_num from job_gubun where cat_order = $up_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_category_num = mysql_result($dbresult,0,0);
	
	$SQL = "update job_gubun set cat_order = $up_cat_order where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update job_gubun set cat_order = $cat_order where category_num = $up_category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php?#$category_num'>";
}
//========================================================================================
//================== 분류를 한단계 내림 ==============================================
if($flag == "down"){ //한단계 내리기
	$SQL = "select cat_order from job_gubun where prevno=$prevno and cat_order < $cat_order and mart_id='$mart_id' order by cat_order Desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_cat_order = mysql_result($dbresult,0,0);
	
	$SQL = "select category_num from job_gubun where cat_order = $down_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_category_num= mysql_result($dbresult,0,0);
	
	$SQL = "update job_gubun set cat_order = $down_cat_order where category_num = $category_num and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	
	$SQL = "update job_gubun set cat_order = $cat_order where category_num = $down_category_num and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list_job.php?#$category_num'>";
}
?>
<?
mysql_close($dbconn);
?>
