<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>재고관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
						각 카테고리와 하부카테고리를 클릭하시면 재고현황을 열람하실 수 있습니다.<br>
						또한, 카테고리와 상관없이 전체상품중의 품절상품/위험상품등을 
						검색하여 확인하실 수 있습니다.<br>
					</td>
				</tr>

				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="0">
								
								<table border="0" width="100%">
								<tr>
									<td width="100%" colspan="2" align="center">
										<input onclick="window.location.href='jaego_search_result.php?search_type=1'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="품절상품 보기">&nbsp; 
										<input onclick="window.location.href='jaego_search_result.php?search_type=2'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="위험상품보기">&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp; </td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
				</tr>
				
				
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#ffffff">
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#a7a7a7" align="center">
								<tr>
									<td width="100%" bgcolor="#e7e7e7" colspan="2">
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
									<td width="40%" bgcolor="#FFFFFF"  align="center">카테고리명</td>
									<td width="60%" bgcolor="#FFFFFF"  align="center">등록된 상품갯수</td>
								</tr>
<?
$SQL = "select * from $CategoryTable where prevno=0 and mart_id='$mart_id' order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++){
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$category_num = $ary["category_num"];
	$category_name = $ary["category_name"];
	
	$SQL1 = "select * from $ItemTable where category_num = '$category_num' and mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);

	$SQL2 = "select * from $CategoryTable where prevno=$category_num and mart_id='$mart_id' order by category_num desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$numRows2 = mysql_num_rows($dbresult2);
?>
								<tr>
									<td bgcolor='#808080' align='left' height='1' colspan='2'></td>
								</tr>
								<tr>
									<td bgcolor='#FFFFFF' align='left'>
										<a href='jaego_item_list.php?category_num=<?=$category_num?>'>
										<b><?=$category_name?></b></a>
									</td>
									<td bgcolor='#FFFFFF' align='center'>
										<b>총 <?=$numRows1?>개</b>
									</td>
								</tr>

								<tr>
									<td bgcolor='#FFFFFF' align='center' colspan='2'>
										<?=$numRows2?>개의 2차 카테고리가 등록되어 있습니다.
									</td>
								</tr>
<?
	for($j=0;$j<$numRows2;$j++){
		mysql_data_seek($dbresult2,$j);
		$ary2 = mysql_fetch_array($dbresult2);
		$category_num2 = $ary2["category_num"];
		$category_name2 = $ary2["category_name"];
			
		$SQL3 = "select * from $ItemTable where category_num = '$category_num2' and mart_id='$mart_id'";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);
		$k = $j + 1;

		$SQL4 = "select * from $CategoryTable where prevno='$category_num2' and mart_id='$mart_id' order by category_num desc";
		$dbresult4 = mysql_query($SQL4, $dbconn);
		$numRows4 = mysql_num_rows($dbresult4);
?>
								<tr>
									<td bgcolor='#FFFFFF' align='left'>
										<p style='padding-left: 10px'>[<?=$k?>]
										<a href='jaego_item_list.php?category_num=<?=$category_num2?>'><?=$category_name2?></a>
									</td>
									<td bgcolor='#FFFFFF' align='left'>
										<p align='center'><?=$numRows3?>개
									</td>
								</tr>
<?
		for( $m=0; $m<$numRows4;$m++ ){
			mysql_data_seek($dbresult4,$m);
			$ary4 = mysql_fetch_array($dbresult4);
			$category_num4 = $ary4[category_num];
			$category_name4 = $ary4[category_name];
				
			$SQL5 = "select * from $ItemTable where category_num = '$category_num4' and mart_id='$mart_id'";
			$dbresult5 = mysql_query($SQL5, $dbconn);
			$numRows5 = mysql_num_rows($dbresult5);
			$p = $m + 1;
?>
								<tr>
									<td bgcolor='#FFFFFF' align='left'>
										<p style='padding-left: 10px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<<?=$p?>>
										<a href='jaego_item_list.php?category_num=<?=$category_num4?>'><?=$category_name4?></a>
									</td>
									<td bgcolor='#FFFFFF' align='left'>
										<p align='center'><?=$numRows5?>개
									</td>
								</tr>
<?
		}
	}
}
?>
								
								</table>
							</td>
						</tr>
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
mysql_close($dbconn);
?>