<?
include "../lib/Mall_Admin_Session.php";
?>
<?

$category_name = $category_limit_start."-".$category_limit_end;


	$gr_tel = $tel1."-".$tel2."-".$tel3;
	$gr_mobile = $mobile1."-".$mobile2."-".$mobile3;


//================== 그룹를 추가함 ===================================================
if($flag == "addcategory") {



	$SQL = "select * from $CategoryTable where mart_id='$mart_id' and g_id='$g_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		echo ("
			<script language=javascript>
				alert(\"이미 존재하는 ID입니다.\\n\\n 다른 ID를 입력해주세요.\");
			</script>
			<form name='form' action='category_write.php' method='post'>
				<input type='hidden' name='category_name' value='$category_name'>
				<input type='hidden' name='category_limit_start' value='$category_limit_start'>
				<input type='hidden' name='category_limit_end' value='$category_limit_end'>
				<input type='hidden' name='flag' value='$flag'>
				<input type='hidden' name='st' value='$st'>
				<input type='hidden' name='prevno' value='$prevno'>
			</form>
			<script>
			document.form.submit();
			</script>
		");
		exit;
	}
	$SQL = "select * from $ItemTable where mart_id='$mart_id' and item_id='$g_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		echo ("
			<script language=javascript>
				alert(\"이미 존재하는 ID입니다.\\n\\n 다른 ID를 입력해주세요.\");
			</script>
			<form name='form' action='category_write.php' method='post'>
				<input type='hidden' name='category_name' value='$category_name'>
				<input type='hidden' name='category_limit_start' value='$category_limit_start'>
				<input type='hidden' name='category_limit_end' value='$category_limit_end'>
				<input type='hidden' name='flag' value='$flag'>
				<input type='hidden' name='st' value='$st'>
				<input type='hidden' name='prevno' value='$prevno'>
			</form>
			<script>
			document.form.submit();
			</script>
		");
		exit;
	}
	$SQL = "select * from $MemberTable where mart_id='$mart_id' and username='$g_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		echo ("
			<script language=javascript>
				alert(\"이미 존재하는 ID입니다.\\n\\n 다른 ID를 입력해주세요.\");
			</script>
			<form name='form' action='category_write.php' method='post'>
				<input type='hidden' name='category_name' value='$category_name'>
				<input type='hidden' name='category_limit_start' value='$category_limit_start'>
				<input type='hidden' name='category_limit_end' value='$category_limit_end'>
				<input type='hidden' name='flag' value='$flag'>
				<input type='hidden' name='st' value='$st'>
				<input type='hidden' name='prevno' value='$prevno'>
			</form>
			<script>
			document.form.submit();
			</script>
		");
		exit;
	}



	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	else
		$maxCategory_num = 30;	// 27 이하는 이획상품
		
	$SQL = "select max(cat_order), count(*) from $CategoryTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxOrder = mysql_result($dbresult, 0, 0);
	else
		$maxOrder = 0;
		
	$category_date = date("Y-m-d H:i:s");
	
	if (isset($prevno) == false || $prevno == "") $prevno = 0;
	else $maxOrder = 0;





	//================== 업로드 파일을 불러옴 ================================================
	include "../../upload.php";
	$upload = "$Co_img_UP"."$mart_id/";
	//================== 첨부 파일을 업로드함 ================================================

	
	##################################img_big###############################################
		



			
	if( $categoryimg_name ){
			
		$now_time = date("YmdHis");
		$categoryimg_name = "c_".$now_time.".jpg";

		$file = FileUploadName( "", "$upload", $categoryimg, $categoryimg_name );//파일을 업로드 함

		if( !$file ){
			echo("
				<script>
				window.alert('파일 업로드에 실패했습니다.');
				history.go(-1)
				</script>
			");
			exit;
		}
	}


	$SQL = "insert into $CategoryTable (mart_id, category_num, prevno, category_name, category_date, category_desc, cat_order, category_img, category_limit_start, category_limit_end, g_id, g_pw, com_bank_name, com_bank_account,com_bank_master,gr_name,gr_address,gr_zip,gr_tel ,gr_mobile ,gr_email,gr_conum ,com_bank_name2 ,com_bank_account2 ,com_bank_master2, com_bank_name3, com_bank_account3,com_bank_master3, com_bank_name4, com_bank_account4,com_bank_master4, country_num, sea_num, sung_num, khan_num, sea_area, sung_area,khan_area,end_date,charge_price,charge_gigan,login_point) values ('$mart_id', $maxCategory_num+1, $prevno, '$category_name', '$category_date', '1', $maxOrder+1, '$categoryimg_name', '$category_limit_start', '$category_limit_end', '$g_id', '$g_pw' , '$com_bank_name', '$com_bank_account','$com_bank_master','$gr_name','$gr_address','$gr_zip','$gr_tel' ,'$gr_mobile' ,'$gr_email','$gr_conum' ,'$com_bank_name2' ,'$com_bank_account2' ,'$com_bank_master2','$com_bank_name3' ,'$com_bank_account3' ,'$com_bank_master3','$com_bank_name4' ,'$com_bank_account4' ,'$com_bank_master4', '100', '$sea_num', '$sung_num', '$khan_num', '$sea_area', '$sung_area','$khan_area','$end_date','$charge_price','$charge_gigan','$login_point')";

	$dbresult = mysql_query($SQL, $dbconn);

	$current_num = mysql_insert_id();
	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?#$current_num'>";
}
//========================================================================================
//================== 그룹를 수정함 ===================================================
if($flag == "update"){



	//================== 업로드 파일을 불러옴 ================================================
	include "../../upload.php";
	$upload = "$Co_img_UP"."$mart_id/";
	//================== 첨부 파일을 업로드함 ================================================

	if($del_big == "y"){ 
		if($categoryimg_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($category_img_old !=""){ // 기존 화일 있는가?


				if(file_exists("$Co_img_UP$mart_id/$category_img_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$category_img_old"); // 삭제...
				}
			}
		}
			
	}



	if($categoryimg_name && $category_img_old){ // 화일 입력난이 공란아니고
		if($categoryimg_updateflag=="ok"){ // 화일 업데이트 되었고..
				if(file_exists("$Co_img_UP$mart_id/$category_img_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$category_img_old"); // 삭제...
				}
		}
			
	}


	if( $categoryimg_name ){
			
		$now_time = date("YmdHis");
		$categoryimg_name = "c_".$now_time.".jpg";

		$file = FileUploadName( "", "$upload", $categoryimg, $categoryimg_name );//파일을 업로드 함

		if( !$file ){
			echo("
				<script>
				window.alert('파일 업로드에 실패했습니다.');
				history.go(-1)
				</script>
			");
			exit;
		}
	}



	$SQL = "update $CategoryTable set category_name='$category_name', category_html='$category_html', category_left='$category_left', category_img='$categoryimg_name', category_limit_start='$category_limit_start',category_limit_end='$category_limit_end' ,g_pw='$g_pw',com_bank_name='$com_bank_name', com_bank_account='$com_bank_account', com_bank_master='$com_bank_master',gr_name='$gr_name',gr_address='$gr_address',gr_zip='$gr_zip',gr_tel='$gr_tel' ,gr_mobile='$gr_mobile' ,gr_email='$gr_email',gr_conum='$gr_conum' ,com_bank_name2='$com_bank_name2' ,com_bank_account2='$com_bank_account2' ,com_bank_master2='$com_bank_master2',com_bank_name3='$com_bank_name3' ,com_bank_account3='$com_bank_account3' ,com_bank_master3='$com_bank_master3',com_bank_name4='$com_bank_name4' ,com_bank_account4='$com_bank_account4' ,com_bank_master4='$com_bank_master4',end_date='$end_date',charge_price='$charge_price',charge_gigan='$charge_gigan',sea_num='$sea_num',sea_area='$sea_area',sung_num='$sung_num',sung_area='$sung_area',khan_num='$khan_num',khan_area='$khan_area',login_point='$login_point' where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	

	$SQL = "select * from $CategoryTable where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);




	echo "<meta http-equiv='refresh' content='0; URL=category_edit.php?category_num=$category_num&prev_category_num=$prev_category_num'>";
	
}
//========================================================================================
//================== 그룹를 삭제함 ===================================================
if($flag == "delcategory"){
	$SQL = "select * from $CategoryTable where prevno=$category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"하위 그룹이 있어 삭제할 수 없습니다.\");
		</script>
		");
		if($prev_category_num){
			echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$prev_category_num'>";
		}else{
			echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$category_num'>";
		}
		exit;
	}
	$SQL = "select item_no from $ItemTable where if_hide='0' and category_num=$category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		echo ("
		<script>
		alert(\"그룹에 속한 회원이 있어 삭제할 수 없습니다.\");
		</script>
		");
		if($prev_category_num){
			echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$prev_category_num'>";
		}else{
			echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$category_num'>";
		}

		exit;
	}
							
	$SQL = "delete from $CategoryTable where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	
	if($prev_category_num){
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$prev_category_num'>";
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$category_num'>";
	}
}
//========================================================================================
//================== 2차 그룹를 추가함 ===============================================
if( $st == "2"){ //2차 그룹 생성

	$SQL = "select * from $CategoryTable where mart_id='$mart_id' and g_id='$g_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		echo ("
			<script language=javascript>
				alert(\"이미 존재하는 ID입니다.\\n\\n 다른 ID를 입력해주세요.\");
			</script>
			<form name='form' action='category_write.php' method='post'>
				<input type='hidden' name='category_name' value='$category_name'>
				<input type='hidden' name='category_limit' value='$category_limit'>
				<input type='hidden' name='prevno' value='$prevno'>
			</form>
			<script>
			document.form.submit();
			</script>
		");
		exit;
	}

	
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from $CategoryTable where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");

	$SQL = "insert into $CategoryTable (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order, category_limit_start, category_limit_end, g_id, g_pw,com_bank_name, com_bank_account, com_bank_master,gr_name,gr_address,gr_zip,gr_tel ,gr_mobile ,gr_email,gr_conum ,com_bank_name2 ,com_bank_account2 ,com_bank_master2, sea_num, sung_num, khan_num, sea_area, sung_area,khan_area,end_date,charge_price,charge_gigan,login_point) values ('$mart_id', $maxCategory_num+1, '1', '$prevno', '$category_name', '$category_date', '$category_desc', $maxOrder+1 , '$category_limit_start', '$category_limit_end', '$g_id', '$g_pw','$com_bank_name', '$com_bank_account' , '$com_bank_master','$gr_name','$gr_address','$gr_zip','$gr_tel' ,'$gr_mobile' ,'$gr_email','$gr_conum' ,'$com_bank_name2' ,'$com_bank_account2' ,'$com_bank_master2', '$sea_num', '$sung_num', '$khan_num', '$sea_area', '$sung_area', '$khan_area','$end_date','$charge_price','$charge_gigan','$login_point')";


	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$category_num'>";
}
//========================================================================================
//================== 3차 그룹를 추가함 ===============================================
if( $st == "3"){ //3차 그룹 생성
	$SQL = "select * from $CategoryTable where mart_id='$mart_id' and g_id='$g_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		echo ("
			<script language=javascript>
				alert(\"이미 존재하는 ID입니다.\\n\\n 다른 ID를 입력해주세요.\");
			</script>
			<form name='form' action='category_write.php' method='post'>
				<input type='hidden' name='category_name' value='$category_name'>
				<input type='hidden' name='category_limit' value='$category_limit'>
				<input type='hidden' name='prevno' value='$prevno'>
			</form>
			<script>
			document.form.submit();
			</script>
		");
		exit;
	}

	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	}else{
		$maxCategory_num = 0;
	}

	$SQL = "select max(cat_order) from $CategoryTable where mart_id='$mart_id'";
	$res = mysql_query($SQL, $dbconn);
	$maxOrder = mysql_result($dbresult, 0, 0);
		
	$category_date = date("Y-m-d H:i:s");
		
	$SQL = "insert into $CategoryTable (mart_id, category_num, category_degree, prevno, category_name, category_date, category_desc, cat_order, category_limit_start,category_limit_end, g_id, g_pw, com_bank_name, com_bank_account, com_bank_master,gr_name,gr_address,gr_zip,gr_tel ,gr_mobile ,gr_email,gr_conum ,com_bank_name2 ,com_bank_account2 ,com_bank_master2, sea_num, sung_num, khan_num, sea_area, sung_area, khan_area,end_date,charge_price,charge_gigan,login_point) values ('$mart_id', $maxCategory_num+1, '2', '$prevno', '$category_name', '$category_date', '$category_desc', $maxOrder+1 , '$category_limit_start', '$category_limit_end', '$g_id', '$g_pw', '$com_bank_name', '$com_bank_account', '$com_bank_master','$gr_name','$gr_address','$gr_zip','$gr_tel' ,'$gr_mobile' ,'$gr_email','$gr_conum' ,'$com_bank_name2' ,'$com_bank_account2' ,'$com_bank_master2', '$sea_num', '$sung_num', '$khan_num', '$sea_area', '$sung_area', '$khan_area','$end_date','$charge_price','$charge_gigan','$login_point')";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php?category_num=$category_num'>";
}
//================== 4차 그룹를 추가함 ===============================================
if( $st == "4"){ //4차 그룹 생성
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
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
//================== 그룹를 한단계 올림 ==============================================
if($flag == "up"){ //한단계 올리기
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
//================== 그룹를 한단계 내림 ==============================================
if($flag == "down"){ //한단계 내리기
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
