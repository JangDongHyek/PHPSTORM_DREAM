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
			<!--���ʺκн���-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�������� �⺻��������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
<?
$SQL = "select * from $Union_OrderTable where item_no = '$item_no' and type = '$type' and mart_id='$mart_id' order by substring(union_order_num,1,8) desc , substring(union_order_num,9)*1 desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
?>
				<tr>
					<td width="90%" bgcolor="#FFFFFF" height="35"><strong>[��û�� ����]</strong>&nbsp;&nbsp;&nbsp;��û�� �Ѱ� : <?echo $numRows?> ��</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="54%" bgcolor="#DDC5E4" align="center" colspan="4">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="100%"><p align="center">&nbsp; ��û�� ����Ʈ</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td bgcolor="#F3F3F3" align="center">ID</td>
										<td bgcolor="#F3F3F3" align="center">����</td>
										<td bgcolor="#F3F3F3" align="center">ID</td>
										<td bgcolor="#F3F3F3" align="center">����</td>
									</tr>
									<tr>
									<?
									for ($i=0; $i < $numRows; $i++) {	
									mysql_data_seek($dbresult, $i);
									$ary=mysql_fetch_array($dbresult);
									$union_order_num = $ary["union_order_num"];
									$item_no = $ary["item_no"];
									$item_name = $ary["item_name"];
									$quantity = $ary["quantity"];
									$type = $ary["type"];
									$username = $ary["username"];
									
									
									$SQL1 = "select * from $Mart_Member_NewTable where username = '$username' and mart_id='$mart_id'";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									if($numRows1 > 0){
										mysql_data_seek($dbresult1, 0);
										$ary1=mysql_fetch_array($dbresult1);
										$name = $ary1["name"];
									}
									echo ("
									<td width='2%' bgcolor='#FFFFFF' align='center'><span class='aa'>$username</td>
										<td width='8%' bgcolor='#FFFFFF' align='center'><span class='aa'>$name</td>
										");
										if($i % 2 == 1 && $i + 1 < $numRows){
										echo ("				
										</tr>
										<tr>
										");
									}							
										
									}
									?>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<?
						if($type == 'limit'){
							echo ("
							<input class='aa' onclick=\"window.location.href='union_limit_item_list.php?union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����ȭ��'>
							");
						}
						if($type == 'slide'){
							echo ("
							<input class='aa' onclick=\"window.location.href='union_slide_item_list.php?union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����ȭ��'>
							");
						}
						?>		
					</td>
					</tr>
				</table>


<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>