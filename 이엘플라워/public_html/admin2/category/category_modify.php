<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//================== ī�װ��� �߰��� ===================================================
if($flag == "addcategory") {
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	else
		$maxCategory_num = 30;	// 27 ���ϴ� ��ȹ��ǰ
		
	$SQL = "select max(cat_order), count(*) from $CategoryTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxOrder = mysql_result($dbresult, 0, 0);
	else
		$maxOrder = 0;
		
	$category_date = date("Y-m-d H:i:s");
	
	if (isset($prevno) == false || $prevno == "") $prevno = 0;
	else $maxOrder = 0;
	
	$SQL = "insert into $CategoryTable (mart_id, category_num, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, $prevno, '$category_name', '$category_date', '1', $maxOrder+1)";

	$dbresult = mysql_query($SQL, $dbconn);

	$current_num = mysql_insert_id();
	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$current_num'>";
}
//========================================================================================
//================== ī�װ��� ������ ===================================================
if($flag == "update"){
	//================== ���ε� ������ �ҷ��� ============================================
	include "../../upload.php";
	$upload = "$UploadRoot/$mart_id/";
	//================== ÷�� ������ ���ε��� ============================================
	if( $categoryimg_name ){
		$file = FileUploadName( "$category_img", "$upload", $categoryimg, $categoryimg_name );//������ ���ε� ��

		$query = "update $CategoryTable set category_img='$file' where category_num = $category_num and mart_id='$mart_id'";
		$result = mysql_query( $query, $dbconn );
		if( !$result ){
			echo("
				<script>
				window.alert('���� ���ε忡 �����߽��ϴ�.');
				history.go(-1)
				</script>
			");
			exit;
		}
	}

	$SQL = "update $CategoryTable set category_name='$category_name', category_html='$category_html', category_left='$category_left', if_hide='$if_hide' where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	

	$SQL = "select * from $CategoryTable where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);


/*
	if($rows[category_degree] == 0){
		$SQL = "update $ItemTable set if_hide='$if_hide' where firstno='$category_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}elseif($rows[category_degree] == 1){
		$SQL = "update $ItemTable set if_hide='$if_hide' where prevno='$category_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}elseif($rows[category_degree] == 2){
		$SQL = "update $ItemTable set if_hide='$if_hide' where thirdno='$category_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
*/
	if(!empty($url))
		echo "<meta http-equiv='refresh' content='0; URL=category_edit.php?category_num=$category_num'>";
	else
		echo "<meta http-equiv='refresh' content='0; URL=category_edit.php?category_num=$category_num'>";
}
//========================================================================================
//================== ī�װ��� ������ ===================================================
if($flag == "delcategory"){
	$SQL = "select * from $CategoryTable where prevno=$category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"���� ī�װ��� �־� ������ �� �����ϴ�.\");
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
		alert(\"ī�װ��� ���� ��ǰ�� �־� ������ �� �����ϴ�.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
		exit;
	}
							
	$SQL = "delete from $CategoryTable where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
}
//========================================================================================
//================== ����ī�װ��� ������ ===============================================
/** ������
if($flag == "del_gnt_category_s"){
	$SQL = "select * from $Gnt_ItemTable where seller_id='$Mall_Admin_ID' and gnt_category_num_s=$gnt_category_num_s";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"ī�װ��� ���� ��ǰ�� �־� ������ �� �����ϴ�.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
		exit;
	}
	//ī�װ��� �����س����� ����
	$SQL = "delete from $Gnt_Category_NameTable where seller_id = '$Mall_Admin_ID' and gnt_category_num = '$gnt_category_num_s'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	//���� ī�װ� ����
	$SQL = "delete from $Gnt_Category_UseTable where seller_id = '$Mall_Admin_ID' and gnt_category_num_s = '$gnt_category_num_s'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
} **/
//========================================================================================
//================== 2�� ī�װ��� �߰��� ===============================================
if( $st == "2"){ //2�� ī�װ� ����
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from $CategoryTable where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");

	$SQL = "insert into $CategoryTable (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '1', '$prevno', '$category2_name', '$category_date', '$category_desc', $maxOrder+1)";

	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$prevno'>";
}
//========================================================================================
//================== 3�� ī�װ��� �߰��� ===============================================
if( $st == "3"){ //3�� ī�װ� ����
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from $CategoryTable where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");
		
	$SQL = "insert into $CategoryTable (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '2', '$prevno', '$category3_name', '$category_date', '$category_desc', $maxOrder+1)";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$prevno'>";
}
//================== 3�� ī�װ��� �߰��� ===============================================
if( $st == "4"){ //3�� ī�װ� ����
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from $CategoryTable where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");
		
	$SQL = "insert into $CategoryTable (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order) values ('$mart_id', $maxCategory_num+1, '3', '$prevno', '$category4_name', '$category_date', '$category_desc', $maxOrder+1)";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$prevno'>";
}
//========================================================================================
//================== ī�װ��� �Ѵܰ� �ø� ==============================================
if($flag == "up"){ //�Ѵܰ� �ø���
	$SQL = "select cat_order from $CategoryTable where prevno=$prevno and cat_order > $cat_order and mart_id='$mart_id' order by cat_order asc";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_cat_order = mysql_result($dbresult,0,0);

	$SQL = "select category_num from $CategoryTable where cat_order = $up_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_category_num = mysql_result($dbresult,0,0);
	
	$SQL = "update $CategoryTable set cat_order = $up_cat_order where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $CategoryTable set cat_order = $cat_order where category_num = $up_category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$category_num'>";
}
//========================================================================================
//================== ī�װ��� �Ѵܰ� ���� ==============================================
if($flag == "down"){ //�Ѵܰ� ������
	$SQL = "select cat_order from $CategoryTable where prevno=$prevno and cat_order < $cat_order and mart_id='$mart_id' order by cat_order Desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_cat_order = mysql_result($dbresult,0,0);
	
	$SQL = "select category_num from $CategoryTable where cat_order = $down_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_category_num= mysql_result($dbresult,0,0);
	
	$SQL = "update $CategoryTable set cat_order = $down_cat_order where category_num = $category_num and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	
	$SQL = "update $CategoryTable set cat_order = $cat_order where category_num = $down_category_num and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$category_num'>";
}
?>
<?
mysql_close($dbconn);
?>
