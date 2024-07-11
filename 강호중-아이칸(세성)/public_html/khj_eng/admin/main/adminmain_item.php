<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''){
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "10";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>관리자 지정상품 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

					<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
						<tr>
							<td width="90%" bgcolor="#ffffff">
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#a7a7a7" align="center">

<!---------------------------- 관리자 지정상품 관리 시작 ------------------------------->
									<form name='adminmain_list' action='adminmain_item.php' method='post'>
									<input type='hidden' name='flag' value='adminmain_item'>
									<input type='hidden' name='banner_no' value='<?=$banner_no?>'>
								<tr>
								<td  colspan="5">
								<?
																	
											$SQL = "select * from $AdminMainTable where mart_id='$mart_id' and banner_no='$banner_no'";
															$dbresult = mysql_query($SQL, $dbconn);
															$numRows = mysql_num_rows($dbresult);
															for ($i=0; $i<$numRows; $i++) {
																mysql_data_seek($dbresult,$i);
																$ary = mysql_fetch_array($dbresult);
																$banner_no = $ary["banner_no"];
																$img = $ary["img"];
																$img_width = $ary["img_width"];
																$img_height =$ary["img_height"];

																if($img_width > 699){
																	$img_width = "500";
																}
															}
								?>
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td width="50%">
													<?
									echo"<img src='$Co_img_DOWN$mart_id/$img' width='$img_width' height='$img_height' border='0'>";
													?>
													<td>
												</tr>
										</table>
								</td>
								</tr>
								<tr>
										<td width="53%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td width="50%"><b>지정상품 관리</b></td>
													<td width="50%" align="right"><input onclick="window.location.href='banner_list.php?banner_no=<?=$banner_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="타이틀 이미지 관리">&nbsp;&nbsp;<input onclick="window.location.href='adminmain_item_new.php?banner_no=<?=$banner_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="상품 등록">&nbsp;&nbsp;<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="순서 조정">
													</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= 관리자 지정상품 관리 ============================================
$sql2 = "select * from $Admin_ItemTable where mart_id='$mart_id' and adminmain_parent='$banner_no' order by adminmain_item_order asc";
$res2 = mysql_query($sql2, $dbconn);
$tot2 = mysql_num_rows($res2);
?>
									<tr>
										<td width="53%" bgcolor="#FFFFFF" colspan="5" align="center">총 <?=$tot2?>개의 상품이 등록되어 있습니다.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="8%">번호</td>
										<td width="10%">순서</td>
										<td width="72%" colspan='2'>상품명</td>
										<td width="10%">삭제</td>
									</tr>
<?
for ($i=0; $i < $tot2; $i++){
	mysql_data_seek($res2, $i);
	$ary2 = mysql_fetch_array($res2);

	$adminmain_item_no = $ary2[adminmain_item_no];
	$item_no = $ary2[item_no];
	$provider_id = $ary2[provider_id];
	$adminmain_item_order = $ary2[adminmain_item_order];
	$adminmain_main =  $ary2[adminmain_main];

	if( $adminmain_main == 'y' ){
		$adminmain_main_str = "<input onclick=\"document.location.href='adminmain_item.php?flag=fav&target=main&adminmain_item_no=$adminmain_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='메인상품'>";
	}else{
		$adminmain_main_str = "<input onclick=\"document.location.href='adminmain_item.php?flag=fav&target=list&adminmain_item_no=$adminmain_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='일반상품'>";
	}
			
	$sql3 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no=$item_no";
	$res3 = mysql_query($sql3, $dbconn);
	$tot3 = mysql_num_rows($res3);
	if($tot3 > 0){
		$item_name = mysql_result($res3, 0, 0);
		$price = mysql_result($res3, 0, 1);
		$mart_id = mysql_result($res3, 0, 2);
		$firstno = mysql_result($res3, 0, 3);
		$prevno = mysql_result($res3, 0, 4);
		$category_num = mysql_result($res3, 0, 5);

		//================== 카테고리 정보를 불러옴 ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");

		$j = $i + 1;
	}else{
		$item_name = "제품이 삭제되었습니다.";
	}

	if($i < $tot2 - 1){
		$down_str = "<a href='adminmain_item.php?adminmain_item_no=$adminmain_item_no&adminmain_item_order=$adminmain_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='adminmain_item.php?adminmain_item_no=$adminmain_item_no&adminmain_item_order=$adminmain_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	

?>								
									<tr>
									<input type='hidden' name='adminmain_no[]' value='<?=$adminmain_item_no?>'>
										<td bgcolor='#FFFFFF' align='center'><?=$j?></td>
										<td align="center"><input type='text' name='adminmain_item_order[]' value='<?=$adminmain_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>
										<td align='left' colspan='2'><?=$upperclass_str?> &gt; <a onclick="javascript:window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td align="center"><input onclick="document.location.href='adminmain_item.php?flag=del&target=fav&adminmain_item_no=<?=$adminmain_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'></td>
									</tr>
<?
}
?>
									</form>
<!---------------------------- 관리자 지정상품 관리 끝 --------------------------------->


							</table>
							</td>
						</tr>
					</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
//================== 관리자 지정상품 상품 순서를 변경함 =================================
if($flag == "adminmain_item"){							
	for($i=0; $i<count($adminmain_no); $i++) {
		$adminmain_item_no = $adminmain_no[$i];
		
		$SQL = "update $Admin_ItemTable set adminmain_item_order = '$adminmain_item_order[$i]' where adminmain_item_no='$adminmain_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=adminmain_item.php?banner_no=$banner_no'>";
}
//========================================================================================


if($flag=="del"){
	if($target == 'fav'){
		$sql = "delete from $Admin_ItemTable where adminmain_item_no = $adminmain_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if ($res == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=adminmain_item.php?banner_no=$banner_no'>";
}



if($flag == "fav"){
	if($target == 'main'){
		$sql = "update $Admin_ItemTable set adminmain_main='n' where adminmain_item_no='$adminmain_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	if($target == 'list'){
		$sql = "update $Admin_ItemTable set adminmain_main='y' where adminmain_item_no='$adminmain_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=adminmain_item.php?banner_no=$banner_no'>";
}


if($flag == "up"){

	
	if(!empty($adminmain_item_no)&&!empty($adminmain_item_order)){
		$sql = "select adminmain_item_order from $Admin_ItemTable where adminmain_item_order > $adminmain_item_order and mart_id='$mart_id' order by adminmain_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_adminmain_item_order = mysql_result($res,0,0);
		
		$sql = "select adminmain_item_no from $Admin_ItemTable where adminmain_item_order = $up_adminmain_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_adminmain_item_no = mysql_result($res,0,0);
		
		$sql = "update $Admin_ItemTable set adminmain_item_order = $up_adminmain_item_order where adminmain_item_no = $adminmain_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $Admin_ItemTable set adminmain_item_order = $adminmain_item_order where adminmain_item_no = $up_adminmain_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=adminmain_item.php?banner_no=$banner_no'>";
}
?>
<?
mysql_close($dbconn);
?>