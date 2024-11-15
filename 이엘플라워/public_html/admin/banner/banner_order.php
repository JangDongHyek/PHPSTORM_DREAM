<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag==""){
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
$left_menu = "10";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>배너관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" bgcolor="#FFFFFF" height="35">등록된 배너의 순서를 조정합니다.</td>
				</tr>

				<tr>
				  <td width="100%" bgcolor="#FFFFFF" valign="top"><div align="center"><center><table border="0" width="95%">
					 <tr>
						<td width="90%" bgcolor="#999999"><table border="0" width="100%" cellspacing="1" cellpadding="3">
						  <tr>
							 <td width="100%" bgcolor="#8FBECD" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="33%">&nbsp; <strong>배너 순서조정</strong></td>
								  <td width="33%"></td>
								  <td width="33%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td width="33%" bgcolor="#FFFFFF" align="center" valign="top" colspan="3">
							 <table border="0" width="100%" cellspacing="3" cellpadding="3">
		<?
			$SQL = "select * from $BannerTable where mart_id='$mart_id'  order by banner_order desc";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			for ($i=0; $i<$numRows; $i++) {
				$ary = mysql_fetch_array($dbresult);
				$banner_no = $ary["banner_no"];
				$info = $ary["info"];
				$img = $ary["img"];
				$link = $ary["link"];
				$date = $ary["date"];
				$if_flash = $ary["if_flash"];
				$flash_image = $ary["flash_image"];
				$flash_width = $ary["flash_width"];
				$flash_height = $ary["flash_height"];
				$banner_order = $ary["banner_order"];
				$img_width = $ary["img_width"];
				$img_height =$ary["img_height"];

				echo "
											<tr>
												<td width='9%' bgcolor='#f7f7f7' align='center'>
				  ";
								  if($i > 0){	
				echo "
												<a href='banner_order.php?banner_no=$banner_no&banner_order=$banner_order&banner_pos=$banner_pos&flag=up'>
												<img src='../images/up1.gif' alt='한단계 올리기' border='0' WIDTH='13' HEIGHT='13'></a>
													";	
												}
												else echo "&nbsp;&nbsp;&nbsp;";
												
										if($i < $numRows - 1){
													echo "
													<a href='banner_order.php?banner_no=$banner_no&banner_order=$banner_order&banner_pos=$banner_pos&flag=down'>
													<img src='../images/dn1.gif' alt='한단계 내리기' border='0' WIDTH='13' HEIGHT='13'></a>
													";	
												}
												else echo "&nbsp;&nbsp;&nbsp;";
												echo "
												</td>
								  <td width='41%' bgcolor='#f7f7f7' align='center'>
								  ";
								  if($if_flash == 0){
										 if($img!='') echo "<img src='$Co_img_DOWN$mart_id/$img' width='150'>";
									  }
									  else{
										if($flash_image!='') echo "<embed src='$Co_img_DOWN$mart_id/$flash_image' width='150' height='100'>";
									  }
									echo "
									</td>
								</tr>				
									";
								}	
		?>
								</table>
							 </td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" height="35" align="center">
						<input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="이전화면"></td>
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
if($flag == "up"){
	$SQL = "select banner_order from $BannerTable where banner_order > $banner_order and mart_id='$mart_id' order by banner_order Asc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$up_banner_order = $ary["banner_order"];
	
	$SQL = "select banner_no from $BannerTable where banner_order = $up_banner_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$up_banner_no = $ary["banner_no"];
	
	$SQL = "update $BannerTable set banner_order = $up_banner_order where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	
	$SQL = "update $BannerTable set banner_order = $banner_order where banner_no = $up_banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=banner_order.php'>";
}

if($flag == "down"){
	$SQL = "select banner_order from $BannerTable where banner_order < $banner_order and mart_id='$mart_id' order by banner_order Desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$down_banner_order = $ary["banner_order"];
	
	$SQL = "select banner_no from $BannerTable where banner_order = $down_banner_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$ary=mysql_fetch_array($dbresult);	
	$down_banner_no = $ary["banner_no"];
	
	$SQL = "update $BannerTable set banner_order = $down_banner_order where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $BannerTable set banner_order = $banner_order where banner_no = $down_banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=banner_order.php'>";
}
?>
<?
mysql_close($dbconn);
?>