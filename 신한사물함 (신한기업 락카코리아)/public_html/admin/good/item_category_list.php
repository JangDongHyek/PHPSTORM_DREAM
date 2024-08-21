<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false || $flag == "") {

$SQL = "select count(*) from $ItemTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$item_count1 = mysql_result($dbresult,0,0);
}

$SQL = "select count(*) from $Gnt_ItemTable where seller_id='$Mall_Admin_ID'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$item_count2 = mysql_result($dbresult,0,0);
}
$item_count = $item_count1 + $item_count2;

?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../js/category_tree.js"></script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="280" height="100%"  border="0" align="right" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>상품 관리 </b> [전체 상품수 : <?=$item_count?>개]</b></td>
				</tr>
			</table>

			<!--내용 START~~-->

			<table border="1" cellpadding="5" cellspacing="0" width="100%" height="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="10%" bgcolor="#FFFFFF" valign="top">
<script>
// 홈 버튼
foldersTree = gFld("카테고리 리스트", "")
<?
//================== 1차 카테고리 ========================================================
$SQL = "select category_num,category_name,if_hide,category_degree, special from $CategoryTable where mart_id='$mart_id' and prevno='0' and if_hide = '0' and category_num > 0 order by cat_order desc";
//echo "//$SQL\n";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

while($row = mysql_fetch_array( $dbresult )){
	$category_num = $row[category_num];
	$category_name = $row[category_name];
	$cat_order = $row[cat_order];
	$if_hide = $row[if_hide];
	$gnt_id = $row[gnt_id];
	$gnt_category_num = $row[gnt_category_num];
	$special = $row[special];

	if($Mall_Admin_ID == $gnt_id) {
?>
	aux1 = insFld(foldersTree, gFld("<?=$category_name?>","javascript:;"))
<?
	}
	else { 
		if($special)
		{
?>
			insDoc(foldersTree, gLnk(0, "<?=$category_name?>", "./item_list.php?pu=1&category_num=<?=$category_num?>"))
<?
		}else{
?>
			aux1 = insFld(foldersTree, gFld("<font color='blue'><?=$category_name?></font>","./item_list.php?pu=1&category_num=<?=$category_num?>"));
<?
		}
	}

	$SQL2 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' and category_degree='1' and if_hide = '0' and category_num > 0 order by cat_order desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$tot2 = mysql_num_rows($dbresult2);

	//================== 2차 카테고리 ====================================================
	while($row2 = mysql_fetch_array( $dbresult2 )){
		$category_num2 = $row2[category_num];
		$category_name2 = $row2[category_name];
		$category_degree2 = $row2[category_degree];
		$cat_order2 = $row2[cat_order];
		$if_hide2 = $row2[if_hide];

		$gnt_id2 = $row2[gnt_id];
		$gnt_category_num2 = $row[gnt_category_num];

		if($Mall_Admin_ID == $gnt_id2) {
?>
			aux2 = insFld(aux1,gFld("<?=$category_name2?>","javascript:;"))
<?
		}
		else { 
?>
			//insDoc(aux1, gLnk(0, "<?=$category_name2?>", "./item_list.php?pu=2&category_num=<?=$category_num2?>"))
			aux2 = insFld(aux1,gFld("<font color='blue'><?=$category_name2?></font>","./item_list.php?pu=2&category_num=<?=$category_num2?>"))
<?
		}

		$SQL5 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num2' and category_degree='2' order by cat_order desc";
		$dbresult5 = mysql_query($SQL5, $dbconn);
		$tot5 = mysql_num_rows($dbresult5);

		//================== 3차 카테고리 ================================================
		$sql6 = "select category_num,category_name,cat_order,if_hide,category_degree,prevno from $CategoryTable where mart_id='$mart_id' and prevno='$category_num2' and category_degree='2' and if_hide = '0' order by cat_order desc";
		
		$res6 = mysql_query($sql6, $dbconn);
		$tot6 = mysql_num_rows($res6);

		if( $tot6 > 0 ){
			while($row6 = mysql_fetch_array( $res6 )){
				$category_num3 = $row6[category_num];
				$category_name3 = $row6[category_name];
				$category_degree3 = $row6[category_degree];
				$cat_order3 = $row6[cat_order];
				$prevno3 = $row6[prevno];
				$if_hide3 = $row6[if_hide];
				$gnt_id3 = $row6[gnt_id];
				$gnt_category_num3 = $row6[gnt_category_num];

				if($Mall_Admin_ID == $gnt_id3) {
?>
					insDoc(aux2, gLnk(0, "<?=$category_name3?>", "./item_list.php?category_num=<?=$category_num3?>"))
<?
				}
				else { 
?>
					aux3 = insFld(aux2,gFld("<font color='blue'><?=$category_name3?></font>","./item_list.php?pu=3&category_num=<?=$category_num3?>"))
					//insDoc(aux2, gLnk(0, "<font color='blue'><?=$category_name3?></font>", "./item_list.php?pu=3&category_num=<?=$category_num3?>"))
<?					
					//================== 3차 카테고리 ================================================
					$sql7 = "select category_num,category_name,cat_order,if_hide,category_degree,prevno from $CategoryTable where mart_id='$mart_id' and prevno='$category_num3' and category_degree='3' and if_hide = '0' order by cat_order desc";
		
					$res7 = mysql_query($sql7, $dbconn);
					$tot7 = mysql_num_rows($res7);
					if( $tot7 > 0 ){
						while($row7 = mysql_fetch_array( $res7 )){
							$category_num4 = $row7[category_num];
							$category_name4 = $row7[category_name];
							$category_degree4 = $row7[category_degree];
							$cat_order4 = $row7[cat_order];
							$prevno4 = $row7[prevno];
							$if_hide4 = $row7[if_hide];
							$gnt_id4 = $row7[gnt_id];
							$gnt_category_num4 = $row7[gnt_category_num];
?>
							insDoc(aux3, gLnk(0, "<?=$category_name4?>", "./item_list.php?pu=4&category_num=<?=$category_num4?>"))
<?
						}
					}
				}
			}
		}
	}
}
?>
</script>
<script>
initializeDocument()
</script>
<!-- 트리 -->
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
mysql_close($dbconn);
?>