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
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원 관리 </b> [전체 회원수 : <?=$item_count?>명]</b></td>
				</tr>
			</table>

			<!--내용 START~~-->

			<table border="1" cellpadding="5" cellspacing="0" width="100%" height="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="10%" bgcolor="#FFFFFF" valign="top">
<?
if($_SESSION["MemberLevel"] == 10){	
			
?>

<script>
// 홈 버튼
foldersTree = gFld("그룹 리스트", "")
<?
//================== 1차 그룹 ========================================================
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
	

	$SQL2 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' and category_degree='1' and if_hide = '0' and category_num > 0 order by cat_order desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$tot2 = mysql_num_rows($dbresult2);

	//================== 2차 그룹 ====================================================
	while($row2 = mysql_fetch_array( $dbresult2 )){
		$category_num2 = $row2[category_num];
		$category_name2 = $row2[category_name];
		$category_degree2 = $row2[category_degree];
		$cat_order2 = $row2[cat_order];
		$if_hide2 = $row2[if_hide];

		$gnt_id2 = $row2[gnt_id];
		$gnt_category_num2 = $row[gnt_category_num];


?>
			
			aux2 = insFld(aux1,gFld("<font color='blue'><?=$category_name2?></font>","./item_list.php?pu=2&category_num=<?=$category_num2?>"))
<?
		

		$SQL5 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num2' and category_degree='2' order by cat_order desc";
		$dbresult5 = mysql_query($SQL5, $dbconn);
		$tot5 = mysql_num_rows($dbresult5);

		//================== 3차 그룹 ================================================
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


?>
					aux3 = insFld(aux2,gFld("<font color='blue'><?=$category_name3?></font>","./item_list.php?pu=3&category_num=<?=$category_num3?>"))
<?					
				
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

<?
}if($_SESSION["MemberLevel"] == 1){	
$SQL = "select category_num from $CategoryTable where mart_id='$mart_id' and g_id='$_SESSION[Mall_Admin_ID]'";
$dbresult = mysql_query($SQL, $dbconn);
$Rows = mysql_fetch_array($dbresult);
?>

<script>
// 홈 버튼
foldersTree = gFld("그룹 리스트", "")
<?
//================== 1차 그룹 ========================================================
$SQL = "select category_num,category_name,if_hide,category_degree, special from $CategoryTable where mart_id='$mart_id' and prevno='$Rows[category_num]' and if_hide = '0' and category_num > 0 order by cat_order desc";
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


		if($special)
		{
?>
			insDoc(foldersTree, gLnk(0, "<?=$category_name?>", "./item_list.php?pu=2&category_num=<?=$category_num?>"))
<?
		}else{
?>
			aux1 = insFld(foldersTree, gFld("<font color='blue'><?=$category_name?></font>","./item_list.php?pu=2&category_num=<?=$category_num?>"));
<?
		}
	

	$SQL2 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' and category_degree='2' and if_hide = '0' and category_num > 0 order by cat_order desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$tot2 = mysql_num_rows($dbresult2);

	//================== 2차 그룹 ====================================================
	while($row2 = mysql_fetch_array( $dbresult2 )){
		$category_num2 = $row2[category_num];
		$category_name2 = $row2[category_name];
		$category_degree2 = $row2[category_degree];
		$cat_order2 = $row2[cat_order];
		$if_hide2 = $row2[if_hide];

		$gnt_id2 = $row2[gnt_id];
		$gnt_category_num2 = $row[gnt_category_num];


?>
			
			aux2 = insFld(aux1,gFld("<font color='blue'><?=$category_name2?></font>","./item_list.php?pu=3&category_num=<?=$category_num2?>"))
<?
		

		$SQL5 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num2' and category_degree='2' order by cat_order desc";
		$dbresult5 = mysql_query($SQL5, $dbconn);
		$tot5 = mysql_num_rows($dbresult5);

		//================== 3차 그룹 ================================================
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


?>
					aux3 = insFld(aux2,gFld("<font color='blue'><?=$category_name3?></font>","./item_list.php?pu=3&category_num=<?=$category_num3?>"))
<?					
				
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
<?
}if($_SESSION["MemberLevel"] == 2){	
$SQL = "select category_num from $CategoryTable where mart_id='$mart_id' and g_id='$_SESSION[Mall_Admin_ID]'";
$dbresult = mysql_query($SQL, $dbconn);
$Rows = mysql_fetch_array($dbresult);
?>

<script>
// 홈 버튼
foldersTree = gFld("그룹 리스트", "")
<?
//================== 1차 그룹 ========================================================
$SQL = "select category_num,category_name,if_hide,category_degree, special from $CategoryTable where mart_id='$mart_id' and prevno='$Rows[category_num]' and if_hide = '0' and category_num > 0 order by cat_order desc";
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


		if($special)
		{
?>
			insDoc(foldersTree, gLnk(0, "<?=$category_name?>", "./item_list.php?pu=3&category_num=<?=$category_num?>"))
<?
		}else{
?>
			aux1 = insFld(foldersTree, gFld("<font color='blue'><?=$category_name?></font>","./item_list.php?pu=3&category_num=<?=$category_num?>"));
<?
		}
	

	$SQL2 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' and category_degree='2' and if_hide = '0' and category_num > 0 order by cat_order desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$tot2 = mysql_num_rows($dbresult2);

	//================== 2차 그룹 ====================================================
	while($row2 = mysql_fetch_array( $dbresult2 )){
		$category_num2 = $row2[category_num];
		$category_name2 = $row2[category_name];
		$category_degree2 = $row2[category_degree];
		$cat_order2 = $row2[cat_order];
		$if_hide2 = $row2[if_hide];

		$gnt_id2 = $row2[gnt_id];
		$gnt_category_num2 = $row[gnt_category_num];


?>
			
			aux2 = insFld(aux1,gFld("<font color='blue'><?=$category_name2?></font>","./item_list.php?pu=2&category_num=<?=$category_num2?>"))
<?
		

		$SQL5 = "select category_num,category_name,cat_order,if_hide,category_degree from $CategoryTable where mart_id='$mart_id' and prevno='$category_num2' and category_degree='2' order by cat_order desc";
		$dbresult5 = mysql_query($SQL5, $dbconn);
		$tot5 = mysql_num_rows($dbresult5);

		//================== 3차 그룹 ================================================
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


?>
					aux3 = insFld(aux2,gFld("<font color='blue'><?=$category_name3?></font>","./item_list.php?pu=3&category_num=<?=$category_num3?>"))
<?					
				
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
<?
}
?>
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