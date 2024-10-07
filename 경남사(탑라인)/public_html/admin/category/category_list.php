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
$SQL = "select count(*) from $CategoryTable where category_degree='0' and category_num > 28 and mart_id='$mart_id'";
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
$left_menu = "2";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>카테고리 관리 </b> [1차 카테고리수 : <?=$numRows?>개]</td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">
					쇼핑몰에 등록될 카테고리를 생성/수정/삭제, 또한 해당 카테고리에 대한 상품을 관리하실 수 있습니다.<br>
					카테고리명을 클릭하시면 하위카테고리와 상품을 등록/관리하실 수 있습니다.<br>
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

$SQL = "select count(category_num) from $CategoryTable where mart_id='$mart_id' and special is NULL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_result($dbresult,0,0);
$numRows_t = $numRows1 + $count_total + $numRows;
?>
						<form method='post' action='category_modify.php'>
						<input type='hidden' name='flag' value='addcategory'>
						<tr>
							<td width="50%"><b>
								[총 <?=$numRows_t?>개의 카테고리가 생성되어 있습니다]</b></td>
							<td width="50%"><p align="right">
								<b>카테고리 생성: </b>								
								<input name="category_name" size="13" class="input_03" required="required" itemname="카테고리명">
								<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="생성">
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
// 주고받기 카테고리....
$SQL = "select count(gnt_no) from $GiveNTakeTable where seller_id='$Mall_Admin_ID' and state1='2' order by gnt_cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_result($dbresult,0,0);
?>
						<tr>
							<td width="30%"><a href="category_order.php"><img src="../images/soo.gif" border="0" WIDTH="140" HEIGHT="19"></a></td>
							<td width="70%">카테고리를 생성하신 후 상품등록을
							하세요.
<?
if($numRows > 0){
	echo "
&nbsp;<a href='gnt_category_order.php'>
	<img src='../images/soo1.gif' border='0' WIDTH='140' HEIGHT='19'></a>
	";
}
?>
							</td>
					  </tr>
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
												등록된 카테고리 목록</b></td>
											<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="53%" bgcolor="#FFFFFF" align="left">
										<p align="center">카테고리명
									</td>
									<td width="15%" bgcolor="#FFFFFF" align="left">
										<p align="center">등록된 상품갯수
									</td>
									<td width="32%" bgcolor="#FFFFFF" align="center">
										카테고리 추가/수정/삭제
									</td>
								</tr>
<?
//================== 1차 카테고리 ========================================================
$SQL = "select category_num,prevno,category_name,if_hide,category_degree,cat_order from $CategoryTable where mart_id='$mart_id' and category_num > 28 and prevno='0' order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$start= "0";

for ($i=0; $i<$numRows; $i++){
	$row = mysql_fetch_array( $dbresult );
	$category_num = $row[category_num];
	$prevno = $row[prevno];
	$category_name = $row[category_name];
	$cat_order = $row[cat_order];
	$if_hide = $row[if_hide];

	if($if_hide == '1') $hide_str = "<img src='../images/hide.gif' border='0'>";
	else $hide_str = "";

	$cat_sql1 = "select * from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' order by cat_order desc";
	$cat_res1 =  mysql_query($cat_sql1, $dbconn);

	$cat_num = 0;
	while( $cat_row1 = mysql_fetch_array( $cat_res1 ) ){
		$category_num1 = $cat_row1[category_num];
		$prevno1 = $cat_row1[prevno];

		$SQL1 = "select item_no from $ItemTable where prevno='$category_num1' and mart_id='$mart_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows( $dbresult1 );
		$cat_num = $cat_num + $numRows1;
	}

	$SQL2 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' and category_degree='1' order by cat_order desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$tot2 = mysql_num_rows($dbresult2);
?>
								<tr>
									<td bgcolor='#808080' align='left' height='1' colspan='3'></td>
								</tr>
								<tr bgcolor='#FFFFFF'>
									<td align='left'><a name="<?=$category_num?>">
<?
		if($i < $numRows - 1){
?>
										<a href='category_modify.php?prevno=0&category_num=<?=$category_num?>&cat_order=<?=$cat_order?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'> </a>
<?
		}else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
		if($i > 0){	
?>
										<a href='category_modify.php?prevno=0&category_num=<?=$category_num?>&cat_order=<?=$cat_order?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'> </a>
<?
		}
		else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
?>
										&nbsp;<b><?=$category_name?></b>&nbsp;<?=$hide_str?></a>
									</td>
									<td align='center'><b>총 <?=$cat_num?>개 </b></td>
									<form name='form2' method='post' action='category_modify.php'>
									<input type='hidden' name='st' value='2'>
									<input type='hidden' name='prevno' value='<?=$category_num?>'>
									<td>
										&nbsp;<input type='text' class='input_01' name='category2_name' size='8' required="required" itemname="카테고리명"> <input type='submit' value='추 가' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px'>&nbsp;
										<input class='aa' onclick="location.href='category_edit.php?category_num=<?=$category_num?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
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
	//================== 2차 카테고리 ====================================================
	for($j=0;$j<$tot2;$j++){
		$row2 = mysql_fetch_array( $dbresult2 );
		$category_num2 = $row2[category_num];
		$category_name2 = $row2[category_name];
		$category_degree2 = $row2[category_degree];
		$cat_order2 = $row2[cat_order];
		$if_hide2 = $row2[if_hide];

		if($if_hide2 == '1') $hide2_str = "<img src='../images/hide.gif' border='0'>";
		else $hide2_str = "";
					
		$SQL3 = "select count(item_no) from $ItemTable where prevno = '$category_num2' and mart_id='$mart_id'";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_result($dbresult3,0,0);
		/*
		$SQL4 = "select count(gnt_item_no) from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and category_num = '$category_num2'";
		$dbresult4 = mysql_query($SQL4, $dbconn);
		$numRows4 = mysql_result($dbresult4,0,0);
		*/
		//$numRows3 += $numRows4;
		$k = $j + 1;
?>
								<tr bgcolor='#FFFFFF'>
									<td align='left'><a name="<?=$category_num2?>">
										<p style='padding-left: 10px'>
<?
		if($j < $tot2 - 1){
?>
										<a href='category_modify.php?prevno=<?=$category_num?>&category_num=<?=$category_num2?>&cat_order=<?=$cat_order2?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'> </a>
<?
		}else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
		if($j > 0){	
?>
										<a href='category_modify.php?prevno=<?=$category_num?>&category_num=<?=$category_num2?>&cat_order=<?=$cat_order2?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'> </a>
<?
		}
		else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
?>				
										<span class='aa'>[<?=$k?>]
										<?=$category_name2?>&nbsp;<?=$hide2_str?></a>
									</td>
									<td align='center'><?=$numRows3?>개</td>
									<form name='form1' method='post' action='category_modify.php'>
									<input type='hidden' name='st' value='3'>
									<input type='hidden' name='prevno' value='<?=$category_num2?>'>
									<td>
										&nbsp;<input type='text' class='input_01' name='category3_name' size='8' required="required" itemname="카테고리명"> <input type='submit' value='추 가' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px'>&nbsp;
										<input class='aa' onclick="location.href='category_edit.php?category_num=<?=$category_num2?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
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
		//================== 3차 카테고리 ================================================
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

				if($if_hide3 == '1') $hide3_str = "<img src='../images/hide.gif' border='0'>";
				else $hide3_str = "";
							
				$sq6 = "select count(item_no) from $ItemTable where thirdno='$category_num3' and mart_id='$mart_id'";
				$re6 = mysql_query($sq6, $dbconn);
				$to6 = mysql_result($re6,0,0);
				
				$sq7 = "select count(gnt_item_no) from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and category_num='$category_num3'";
				$re7 = mysql_query($sq7, $dbconn);
				$to7 = mysql_result($re7,0,0);
				
				$to6 += $to7;
				$p = $m + 1;
?>
								<tr bgcolor='#FFFFFF'>
									<td align='left'><a name="<?=$category_num3?>">
										<p style='padding-left:10px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?
				if($m < $tot6 - 1){
?>
										<a href='category_modify.php?prevno=<?=$prevno3?>&category_num=<?=$category_num3?>&cat_order=<?=$cat_order3?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'></a> 
<?
				}else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
				}
				if($m > 0){	
?>
										<a href='category_modify.php?prevno=<?=$prevno3?>&category_num=<?=$category_num3?>&cat_order=<?=$cat_order3?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'> </a>
<?
				}
				else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
				}
?>				
										<span class='aa'>[<?=$p?>]
										<?=$category_name3?>&nbsp;<?=$hide3_str?></a>
									</td>
									<td align='center'><?=$to6?>개</td>
									<form name='form3' method='post' action='category_modify.php'>
									<input type='hidden' name='st' value='4'>
									<input type='hidden' name='prevno' value='<?=$category_num3?>'>
									<td align='left'>
										&nbsp;<input type='text' class='input_01' name='category4_name' size='8' required="required" itemname="카테고리명"> <input type='submit' value='추 가' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px'>&nbsp;
										<input class='aa' onclick="location.href='category_edit.php?category_num=<?=$category_num3?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
<?								
				if($to6 == 0){
?>
										<input class='aa' onclick="return del_category('<?=$category_num3?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='삭제'>
<?
				}
?>
									</td>
									</form>
								</tr>
			<!-------------------------------------------------------------------->
			<?
					//================== 4차 카테고리 ================================================
					$sql7 = "select category_num,category_name,cat_order,if_hide,category_degree,prevno from $CategoryTable where mart_id='$mart_id' and prevno='$category_num3' and category_degree='3' order by cat_order desc";

					//echo $sql7;
					
					$res7 = mysql_query($sql7, $dbconn);
					$tot7 = mysql_num_rows($res7);
			?>
			<?
					if( $tot6 > 0 ){
			?>	
			<?
						for( $n=0; $n < $tot7; $n++ ){
							$row7 = mysql_fetch_array( $res7 );
							$category_num4 = $row7[category_num];
							$category_name4 = $row7[category_name];
							$category_degree4 = $row7[category_degree];
							$cat_order4 = $row7[cat_order];
							$prevno4 = $row7[prevno];
							$if_hide4 = $row7[if_hide];

							if($if_hide4 == '1') $hide4_str = "<img src='../images/hide.gif' border='0'>";
							else $hide4_str = "";
										
							$sq8 = "select count(item_no) from $ItemTable where category_num='$category_num4' and mart_id='$mart_id'";
							$re8 = mysql_query($sq8, $dbconn);
							$to8 = mysql_result($re8,0,0);									

			?>
											<tr bgcolor='#FFFFFF'>
												<td align='left'><a name="<?=$category_num4?>">
													<p style='padding-left:10px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?
							if($n < $tot7 - 1){
			?>
													<a href='category_modify.php?prevno=<?=$prevno4?>&category_num=<?=$category_num4?>&cat_order=<?=$cat_order4?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'> </a>
			<?
							}else{
			?>
													<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
			<?
							}
							if($n > 0){	
			?>
													<a href='category_modify.php?prevno=<?=$prevno4?>&category_num=<?=$category_num4?>&cat_order=<?=$cat_order4?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'> </a>
			<?
							}
							else{
			?>
													<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
			<?
							}
			?>				
													<span class='aa'>[<?=$p?>]
													<?=$category_name4?>&nbsp;<?=$hide4_str?></a>
												</td>
												<td align='center'><?=$to8?>개</td>															
												<td align='center'>
													&nbsp;
													<input class='aa' onclick="location.href='category_edit.php?category_num=<?=$category_num4?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
			<?								
							if($to8 == 0){
			?>
													<input class='aa' onclick="return del_category('<?=$category_num4?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='삭제'>
			<?
							}
			?>
												</td>
											</tr>
			<?
							

						}//for end
					}//if end
			?>
											<!-- <tr bgcolor='#FFFFFF'>
												<td colspan='3' align='center'><?=$tot6?>개 3차 카테고리</td>
											</tr> -->
			<?
					//}
			?>								
			<!----------------------------------------------------------------------->
				
<?
			}//for end
		}//if end
?>
								<!-- <tr bgcolor='#FFFFFF'>
									<td colspan='3' align='center'><?=$tot6?>개 3차 카테고리</td>
								</tr> -->
<?
		//}
?>								
<!--------------------------------------------------------------------------------------->


<?
	}
?>
								<tr bgcolor='#CCCCCC'>
									<td colspan='3' align='center'><?=$tot2?>개 2차 카테고리</td>
								</tr>
<?
}
?>

<?
// 주고받기 카테고리....
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
										<input class='aa' onclick=\"window.location.href='gnt_category_edit.php?category_num=$category_num'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
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
										$numRows2 개의 하위 카테고리가 등록되어 있습니다.</td>
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
<script type="text/javascript" src="/js/script.js"></script>
<?
}
?>
<?
mysql_close($dbconn);
?>