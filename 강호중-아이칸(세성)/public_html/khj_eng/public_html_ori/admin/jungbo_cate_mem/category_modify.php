<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//================== 분류를 추가함 ===================================================
if($flag == "addcategory") {
	$SQL = "select max(category_num), count(*) from jungbo_cate";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	else
		$maxCategory_num = 30;	// 27 이하는 이획상품
		
	$SQL = "select max(cat_order), count(*) from jungbo_cate where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxOrder = mysql_result($dbresult, 0, 0);
	else
		$maxOrder = 0;
		
	$category_date = date("Y-m-d H:i:s");
	
	if (isset($prevno) == false || $prevno == "") $prevno = 0;
	else $maxOrder = 0;
	
	$SQL = "insert into jungbo_cate (mart_id, category_num, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, $prevno, '$category_name', '$category_date', '1', $maxOrder+1)";

	$dbresult = mysql_query($SQL, $dbconn);

	$current_num = mysql_insert_id();
	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$current_num'>";
}
//========================================================================================
//================== 분류를 수정함 ===================================================
if($flag == "update"){

	
	$money = str_replace(",","",$money);
	$gigan = str_replace(",","",$gigan);


	//$SQL = "update jungbo_cate set category_name='$category_name', category_html='$category_html', category_left='$category_left', if_hide='$if_hide',money='$money',gigan='$gigan' where category_num = '$category_num' and mart_id='$mart_id'";
	


	$start_date = date("Y-m-d");
	$date = $start_date;
	$date_ex2 = explode("-",$date);	
	$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
	$cdate = strtotime("+$gigan day", $date_mktime);
	$res_date = date("Y-m-d", $cdate);


	$SQL = "insert into jungbo_cate_mem (mart_id, category_num, prevno, category_name, category_date, category_desc, cat_order, money, gigan, start_date,end_date,item_id) values ('$mart_id', '$category_num', '$prevno', '$category_name', '$category_date', '1', '$cat_order', '$money','$gigan','$start_date','$res_date', '$_SESSION[Mall_Admin_ID]')";
	$dbresult = mysql_query($SQL, $dbconn);

	//회원정보추출
	$sql = "select bonus_total,item_code from item where item_id='$_SESSION[Mall_Admin_ID]'";
	$res = mysql_query($sql,$dbconn);
	$row = mysql_fetch_array($res);
	
	//충전금 차감
	$nowdatetime = date("YmdHis");
	$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) values ('$mart_id', '$row[item_code]', '$nowdatetime', '-$money', '$category_name', 'uc')";

	$dbresult3 = mysql_query($SQL3, $dbconn);

	//충전금 차감 내역
	$SQL4 = "update $ItemTable set bonus_total = bonus_total - '$money' where item_code='$row[item_code]'";
	$dbresult4 = mysql_query($SQL4, $dbconn);

	

		echo"<script>alert('분류구매가 완료되었습니다.');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$category_num'>";
}
//========================================================================================
//================== 분류를 삭제함 ===================================================
if($flag == "delcategory"){
	$SQL = "select * from jungbo_cate where prevno=$category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"하위 분류가 있어 삭제할 수 없습니다.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
		exit;
	}
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
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
		exit;
	}
							
	$SQL = "delete from jungbo_cate where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
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
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
		exit;
	}
	//분류명 설정해놓은거 삭제
	$SQL = "delete from $Gnt_Category_NameTable where seller_id = '$Mall_Admin_ID' and gnt_category_num = '$gnt_category_num_s'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	//하위 분류 삭제
	$SQL = "delete from $Gnt_Category_UseTable where seller_id = '$Mall_Admin_ID' and gnt_category_num_s = '$gnt_category_num_s'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
} **/
//========================================================================================
//================== 2차 분류를 추가함 ===============================================
if( $st == "2"){ //2차 분류 생성
	$SQL = "select max(category_num), count(*) from jungbo_cate";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from jungbo_cate where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");

	$SQL = "insert into jungbo_cate (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '1', '$prevno', '$category2_name', '$category_date', '$category_desc', $maxOrder+1)";

	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$prevno'>";
}
//========================================================================================
//================== 3차 분류를 추가함 ===============================================
if( $st == "3"){ //3차 분류 생성
	$SQL = "select max(category_num), count(*) from jungbo_cate";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from jungbo_cate where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");
		
	$SQL = "insert into jungbo_cate (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '2', '$prevno', '$category3_name', '$category_date', '$category_desc', $maxOrder+1)";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$prevno'>";
}
//================== 3차 분류를 추가함 ===============================================
if( $st == "4"){ //3차 분류 생성
	$SQL = "select max(category_num), count(*) from jungbo_cate";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from jungbo_cate where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");
		
	$SQL = "insert into jungbo_cate (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '3', '$prevno', '$category4_name', '$category_date', '$category_desc', $maxOrder+1)";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$prevno'>";
}
//========================================================================================
//================== 분류를 한단계 올림 ==============================================
if($flag == "up"){ //한단계 올리기
	$SQL = "select cat_order from jungbo_cate where prevno=$prevno and cat_order > $cat_order and mart_id='$mart_id' order by cat_order asc";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_cat_order = mysql_result($dbresult,0,0);

	$SQL = "select category_num from jungbo_cate where cat_order = $up_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_category_num = mysql_result($dbresult,0,0);
	
	$SQL = "update jungbo_cate set cat_order = $up_cat_order where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update jungbo_cate set cat_order = $cat_order where category_num = $up_category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$category_num'>";
}
//========================================================================================
//================== 분류를 한단계 내림 ==============================================
if($flag == "down"){ //한단계 내리기
	$SQL = "select cat_order from jungbo_cate where prevno=$prevno and cat_order < $cat_order and mart_id='$mart_id' order by cat_order Desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_cat_order = mysql_result($dbresult,0,0);
	
	$SQL = "select category_num from jungbo_cate where cat_order = $down_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_category_num= mysql_result($dbresult,0,0);
	
	$SQL = "update jungbo_cate set cat_order = $down_cat_order where category_num = $category_num and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	
	$SQL = "update jungbo_cate set cat_order = $cat_order where category_num = $down_category_num and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$category_num'>";
}
?>
<?
mysql_close($dbconn);
?>
