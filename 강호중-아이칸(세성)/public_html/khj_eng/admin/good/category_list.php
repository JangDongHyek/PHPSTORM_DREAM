<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false || $flag == "") {
	include "../admin_head.php";
?>
<script>
function del_category(category_num){
	if(confirm("삭제 하시겠습니까?")){
		window.location.href='category_modify.php?flag=delcategory&category_num='+category_num;
		return true;
	}
	else return false;
}
/**	사용안함
function really_del_gnt_category_s(gnt_category_num_s){
	if(confirm("삭제 하시겠습니까?")){
		window.location.href='category_modify.php?flag=del_gnt_category_s&gnt_category_num_s='+gnt_category_num_s;
		return true;
	}
	else return false;
}**/
</script>
<?
$SQL = "select count(*) from $ItemTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$numRows = mysql_result($dbresult,0,0);
}
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "3";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>상품 관리 </b> [총상품수 : <?=$numRows?>개]</td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">
					그룹명을 클릭하시면 하위그룹와 상품을 등록/관리하실 수 있습니다.<br>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%">
<?
$SQL1 = "select category_num from $GiveNTakeTable where seller_id='$Mall_Admin_ID'";
$dbresult1 = mysql_query($SQL1, $dbconn);
$numRows1 = mysql_num_rows($dbresult1);
$count_totoal = 0;

for($i=0;$i<$numRows1;$i++){
	$category_num_t = mysql_result($dbresult1,$i,0);
	
	$SQL2 = "select count(category_num) from $CategoryTable where prevno='$category_num_t'";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$count_t = mysql_result($dbresult2,0,0);
	$count_total += $count_t;
}

$SQL = "select count(category_num) from $CategoryTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_result($dbresult,0,0);
$numRows_t = $numRows1 + $count_total + $numRows;
?>
						<form method='post' action='category_modify.php'>
						<input type='hidden' name='flag' value='addcategory'>
						<tr>
							<td width="50%"><b>
								[총 <?=$numRows_t?>개의 그룹가 생성되어 있습니다]</b>
							</td>
						</tr>
					</form>
					</table>
					<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="100%" bgcolor="#808080" height="1"></td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="0"><table border="0" width="100%">
						<tr>
							<td width="30%" height="3"></td>
							<td width="70%" height="3"></td>
						</tr>
<?
// 주고받기 그룹....
$SQL = "select count(gnt_no) from $GiveNTakeTable where seller_id='$Mall_Admin_ID' and state1='2' order by gnt_cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_result($dbresult,0,0);
?>
					</table>
					</td>
				 </tr>
			  </table>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="a7a7a7">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#e7e7e7" colspan="3">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="50%">&nbsp; <b>
												등록된 그룹 목록</b></td>
											<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="53%" bgcolor="#FFFFFF" align="left">
										<p align="center">그룹명
									</td>
									<td width="15%" bgcolor="#FFFFFF" align="left">
										<p align="center">등록된 상품갯수
									</td>
									<td width="32%" bgcolor="#FFFFFF" align="center">
										그룹 수정/삭제
									</td>
								</tr>
<?
//================== 1차 그룹 ========================================================
$SQL = "select category_num,category_name,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='0' and category_num > 28 order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

for ($i=0; $i<$numRows; $i++){
	$row = mysql_fetch_array( $dbresult );
	$category_num = $row[category_num];
	$category_name = $row[category_name];
	$if_hide = $row[if_hide];

	if($if_hide == '1') $hide_str = "<img src='../images/hide.gif'>";
	else $hide_str = "";

	$SQL1 = "select count(item_no) from $ItemTable where category_num='$category_num' and mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1_tmp = mysql_result($dbresult1,0,0);

	$SQL1 = "select count(gnt_item_no) from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and category_num='$category_num'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_result($dbresult1,0,0);

	$numRows1 += $numRows1_tmp;
							
	$SQL2 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' and category_degree='1' order by cat_order desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$tot2 = mysql_num_rows($dbresult2);
?>
								<tr>
									<td bgcolor='#808080' align='left' height='1' colspan='3'></td>
								</tr>
								<tr bgcolor='#FFFFFF'>
									<td align='left'>
										<a href='../good/item_list.php?category_num=<?=$category_num?>'><b><?=$category_name?></b></a>&nbsp;<?=$hide_str?>
									</td>
									<td align='center'><b>총 <?=$numRows1?>개</b></td>
									<td>
										<input class='aa' onclick="location.href='../category/category_edit.php?category_num=<?=$category_num?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
<?										
	if($numRows1 == 0 && $tot2 == 0){
?>
										<input class='aa' onclick="return del_category('<?=$category_num?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'>
<?
	}
?>
									</td>
									</form>
								</tr>
<?
	//================== 2차 그룹 ====================================================
	for($j=0;$j<$tot2;$j++){
		$row2 = mysql_fetch_array( $dbresult2 );
		$category_num2 = $row2[category_num];
		$category_name2 = $row2[category_name];
		$category_degree2 = $row2[category_degree];
		$cat_order2 = $row2[cat_order];
		$if_hide2 = $row2[if_hide];

		if($if_hide2 == '1') $hide2_str = "<img src='../images/hide.gif'>";
		else $hide2_str = "";
					
		$SQL3 = "select count(item_no) from $ItemTable where category_num = '$category_num2' and mart_id='$mart_id'";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_result($dbresult3,0,0);
		
		$SQL4 = "select count(gnt_item_no) from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and category_num = '$category_num2'";
		$dbresult4 = mysql_query($SQL4, $dbconn);
		$numRows4 = mysql_result($dbresult4,0,0);
		
		$numRows3 += $numRows4;
		$k = $j + 1;
?>
								<tr bgcolor='#FFFFFF'>
									<td align='left'>
										<p style='padding-left: 10px'>
										<a href='../good/item_list.php?category_num=<?=$category_num2?>'><?=$category_name2?></a>&nbsp;<?=$hide2_str?>
									</td>
									<td align='center'><?=$numRows3?>개</td>
									<td>
										<input class='aa' onclick="location.href='../category/category_edit.php?category_num=<?=$category_num2?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
<?								
		if($numRows3 == 0){
?>
										<input class='aa' onclick="return del_category('<?=$category_num2?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='삭제'>
<?
		}
?>
									</td>
									</form>
								</tr>
<!--------------------------------------------------------------------------------------->
<?
		//================== 3차 그룹 ================================================
		$sql6 = "select category_num,category_name,cat_order,if_hide,category_degree,prevno from $CategoryTable where mart_id='$mart_id' and prevno='$category_num2' and category_degree='2' order by cat_order desc";
		
		$res6 = mysql_query($sql6, $dbconn);
		$tot6 = mysql_num_rows($res6);
?>
<?
		if( $tot6 > 0 ){
?>	
<?
			for( $m=0; $m < $tot6; $m++ ){
				$row6 = mysql_fetch_array( $res6 );
				$category_num3 = $row6[category_num];
				$category_name3 = $row6[category_name];
				$category_degree3 = $row6[category_degree];
				$cat_order3 = $row6[cat_order];
				$prevno3 = $row6[prevno];
				$if_hide3 = $row6[if_hide];

				if($if_hide3 == '1') $hide3_str = "<img src='../images/hide.gif'>";
				else $hide3_str = "";
							
				$sq6 = "select count(item_no) from $ItemTable where category_num='$category_num3' and mart_id='$mart_id'";
				$re6 = mysql_query($sq6, $dbconn);
				$to6 = mysql_result($re6,0,0);
				
				$sq7 = "select count(gnt_item_no) from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and category_num='$category_num3'";
				$re7 = mysql_query($sq7, $dbconn);
				$to7 = mysql_result($re7,0,0);
				
				$to6 += $to7;
				$p = $m + 1;
?>
								<tr bgcolor='#FFFFFF'>
									<td align='left'>
										<p style='padding-left:10px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href='../good/item_list.php?category_num=<?=$category_num3?>'><?=$category_name3?></a>&nbsp;<?=$hide3_str?>
									</td>
									<td align='center'><?=$to6?>개</td>
									<td align='center'>
										<input class='aa' onclick="location.href='../category/category_edit.php?category_num=<?=$category_num3?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
<?								
				if($to6 == 0){
?>
										<input class='aa' onclick="return del_category('<?=$category_num3?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='삭제'>
<?
				}
?>
									</td>
								</tr>
<?
			}//for end
		}//if end
?>
								<tr bgcolor='#FFFFFF'>
									<td colspan='3' align='center'><?=$tot6?>개 3차 그룹</td>
								</tr>
<?
		//}
?>								
<!--------------------------------------------------------------------------------------->
<?
	}
?>
								<tr bgcolor='#CCCCCC'>
									<td colspan='3' align='center'><?=$tot2?>개 2차 그룹</td>
								</tr>
<?
}
?>

<?
// 주고받기 그룹....
$SQL = "select category_num,provider_id,gnt_category_name from $GiveNTakeTable where seller_id='$Mall_Admin_ID' and state1='2' order by gnt_cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$category_num = mysql_result($dbresult,$i,0);
	$provider_id = mysql_result($dbresult,$i,1);
	$gnt_category_name = mysql_result($dbresult,$i,2);
	
	$SQL0 = "select count(category_num) from $CategoryTable where category_num = '$category_num' and mart_id='$provider_id'";
	$dbresult0 = mysql_query($SQL0, $dbconn);
	$numRows0 = mysql_result($dbresult0,0,0);
	
	if($numRows0 > 0){
		$SQL0 = "select category_name from $CategoryTable where category_num = '$category_num' and mart_id='$provider_id'";
		$dbresult0 = mysql_query($SQL0, $dbconn);
		$category_name = mysql_result($dbresult0,0,0);
	
		$SQL1 = "select count(item_no) from $ItemTable where category_num = '$category_num' and mart_id='$provider_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_result($dbresult1,0,0);
		if($gnt_category_name != '') $category_name = $gnt_category_name;
		echo ("
								<tr>
									<td bgcolor='#808080' align='left' height='1' colspan='3'></td>
								</tr>
								<tr>
									<td bgcolor='#FFFFFF' align='left'>
										<a href='item_list_gnt.php?category_num=$category_num'>
										<b><span class='bb'>$category_name</b></a>
										<img src='../images/gnt.gif' height='12' width='25'></td>
									<td bgcolor='#FFFFFF' align='left'>
										<p align='center'><span class='bb'><b>총 $numRows1 개</b></td>
									<td bgcolor='#FFFFFF' align='center'>
										<input class='aa' onclick=\"window.location.href='../category/gnt_category_edit.php?category_num=$category_num'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
									</td>
								</tr>
										");
									
								
													$SQL2 = "select category_num,category_name from $CategoryTable where mart_id='$provider_id' and prevno=$category_num order by category_num desc";
													//echo "sql=$SQL";
													$dbresult2 = mysql_query($SQL2, $dbconn);
													$numRows2 = mysql_num_rows($dbresult2);
												
													echo ("
											<tr>
									<td width='53%' bgcolor='#FFFFFF' align='left' colspan='3'>
										<span class='aa'><p align='center'>
										$numRows2 개의 하위 그룹가 등록되어 있습니다.</td>
								</tr>
									");
									for($j=0;$j<$numRows2;$j++){
										$category_num2 = mysql_result($dbresult2,$j,0);
										$category_name2 = mysql_result($dbresult2,$j,1);
										
							$SQL3 = "select count(item_no) from $ItemTable where category_num = '$category_num2' and mart_id='$provider_id'";
										$dbresult3 = mysql_query($SQL3, $dbconn);
										$numRows3 = mysql_result($dbresult3,0,0);
										$k = $j + 1;
									
										echo ("
								<tr>
									<td bgcolor='#FFFFFF' align='left'>
										<p style='padding-left: 10px'><span class='aa'>[$k]
										<a href='item_list_gnt.php?category_num=$category_num2'>$category_name2</a></td>
									<td bgcolor='#FFFFFF' align='left'>
										<p align='center'><span class='aa'>$numRows3 개</td>
									<td bgcolor='#FFFFFF' align='center'>
									</td>
								</tr>
			");
		}
	}
}
?>
								</table>
							</td>
						</tr>
					</table>


<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
?>
<?
mysql_close($dbconn);
?>