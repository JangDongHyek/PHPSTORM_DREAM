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
$left_menu = "3";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>������ </b></td>
				</tr>
			</table>

			<!--���� START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">�� ī�װ��� �Ϻ�ī�װ��� Ŭ���Ͻø� �����Ȳ�� �����Ͻ� �� 
					�ֽ��ϴ�.<br>
					����, ī�װ��� ������� ��ü��ǰ���� ǰ����ǰ/�����ǰ���� 
					�˻��Ͽ� Ȯ���Ͻ� �� �ֽ��ϴ�.<br>
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
										<input class="aa" onclick="window.location.href='jaego_search_result.php?search_type=1'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="ǰ����ǰ ����">&nbsp; 
										<input class="aa" onclick="window.location.href='jaego_search_result.php?search_type=2'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�����ǰ����">&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp; </td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
				</tr>
				
				
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><div align="center"><center>
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#ffffff">
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#a7a7a7" align="center">
								<tr>
									<td width="100%" bgcolor="#e7e7e7" colspan="3">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="50%">&nbsp; <strong>
												��ϵ� ī�װ� ���</strong></td>
											<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="40%" bgcolor="#FFFFFF" align="left">
										<p align="center">ī�װ���</td>
									<td width="15%" bgcolor="#FFFFFF" align="left">
										<p align="center">��ϵ� ��ǰ����</td>
								</tr>
								<?
								$SQL = "select * from $CategoryTable where prevno=0 and mart_id='$mart_id' order by cat_order desc";
							$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							for ($i=0; $i<$numRows; $i++) {
								mysql_data_seek($dbresult,$i);
								$ary = mysql_fetch_array($dbresult);
								$category_num = $ary["category_num"];
								$category_name = $ary["category_name"];
								
								$SQL1 = "select * from $ItemTable where category_num = '$category_num' and mart_id='$mart_id'";
								$dbresult1 = mysql_query($SQL1, $dbconn);
								$numRows1 = mysql_num_rows($dbresult1);
							
								$SQL2 = "select * from $CategoryTable where prevno=$category_num and mart_id='$mart_id' order by category_num desc";
								//echo "sql=$SQL";
								$dbresult2 = mysql_query($SQL2, $dbconn);
								$numRows2 = mysql_num_rows($dbresult2);
								
								echo ("
							<tr>
									<td width='53%' bgcolor='#808080' align='left' height='1' colspan='3'></td>
								</tr>
								<tr>
									<td width='23%' bgcolor='#FFFFFF' align='left'>
										<a href='jaego_item_list.php?category_num=$category_num'>
										<strong><span class='bb'>$category_name</strong></a></td>
									<td width='15%' bgcolor='#FFFFFF' align='left'>
										<p align='center'><span class='bb'><strong>�� $numRows1 ��</strong></td>
									");
										
									echo ("
								</tr>
									");
									
								
								echo ("
							<tr>
									<td width='53%' bgcolor='#FFFFFF' align='left' colspan='3'>
										<span class='aa'><p align='center'>
										$numRows2 ���� ���� ī�װ��� ��ϵǾ� �ֽ��ϴ�.</td>
								</tr>
									");
								for($j=0;$j<$numRows2;$j++){
									mysql_data_seek($dbresult2,$j);
									$ary2 = mysql_fetch_array($dbresult2);
									$category_num2 = $ary2["category_num"];
									$category_name2 = $ary2["category_name"];
										
										$SQL3 = "select * from $ItemTable where category_num = '$category_num2' and mart_id='$mart_id'";
									$dbresult3 = mysql_query($SQL3, $dbconn);
									$numRows3 = mysql_num_rows($dbresult3);
									$k = $j + 1;
									echo ("
								<tr>
									<td width='23%' bgcolor='#FFFFFF' align='left'>
										<p style='padding-left: 10px'><span class='aa'>[$k]
										<a href='jaego_item_list.php?category_num=$category_num2'>$category_name2</a></td>
									<td width='15%' bgcolor='#FFFFFF' align='left'>
										<p align='center'><span class='aa'>$numRows3 ��</td>
										");
										echo ("
								</tr>
										");
									}
								}
								?>
								
								</table>
							</td>
						</tr>
					</table>
					</center></div><p align="center">��</p>
					</div>
				</td>
				</tr>
				<tr align="center">
				<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
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