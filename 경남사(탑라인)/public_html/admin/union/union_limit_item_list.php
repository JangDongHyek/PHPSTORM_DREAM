<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($delflag=="del"){
	$SQL = "delete from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>
<script>
function really2(item_no, union_no){
	if (confirm("�����ǰ�� �����Ͻðڽ��ϱ�?")){
		document.location.href='union_limit_item_list.php?delflag=del&item_no='+item_no+'&union_no='+union_no; 
	}
}
</script>
</head>

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
					<tr>
					<td width="90%" bgcolor="#FFFFFF"><strong>[�������� ��ǰ���]&nbsp;&nbsp;�������� ��ǰ�� ���/�����Ͻ� �� �ֽ��ϴ�.</td>
					</tr>
					<?
				$SQL = "select * from $Union_ListTable where mart_id='$mart_id' order by union_no desc";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				mysql_data_seek($dbresult, $i);
				$ary=mysql_fetch_array($dbresult);
				$limit_no = $ary["limit_no"];
			
				$SQL = "select * from $Union_ItemTable where type='limit' and union_no = '$union_no' and mart_id='$mart_id' order by item_no desc";
				//echo "sql=$SQL";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				?>
				<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						
						<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%" bgcolor="#FFFFFF">�� <?echo $numRows?> ���� ��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="54%" bgcolor="#DDC5E4" align="center" colspan="5">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">&nbsp; �� <?echo $limit_no?> �� ��������/ �����Ǹ� 
													��ǰ����Ʈ</td>
												<td width="50%">
													<p align="right">
													<input onclick="window.location.href='limit_item_write.php?union_no=<?echo $union_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="��ǰ���"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td bgcolor="#F3F3F3" align="center">��ǰ��</td>
										<td bgcolor="#F3F3F3" align="center">������</td>
										<td bgcolor="#F3F3F3" align="center">�Ѽ���/��û����</td>
										<td bgcolor="#F3F3F3" align="center">����</td>
										<td bgcolor="#F3F3F3" align="center">��û�ں���</td>
									</tr>
									<?
									$SQL = "select * from $Union_ItemTable where type='limit' and union_no = '$union_no' and mart_id='$mart_id' order by item_no desc";
								//echo "sql=$SQL";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								
								for ($i=0; $i < $numRows; $i++) {
									mysql_data_seek($dbresult, $i);
									$ary=mysql_fetch_array($dbresult);
									$item_no = $ary["item_no"];
									$item_name = $ary["item_name"];
									$z_price = $ary["z_price"];
									$z_price_str = number_format($z_price);
									$limit_total = $ary["limit_total"];
									$limit_total_str = number_format($limit_total);
									$read_num = $ary["read_num"];
									$current_num = $ary["current_num"];
									$current_num_str = number_format($current_num);
									
									echo ("
								<tr>
										<td bgcolor='#FFFFFF' align='center'>
											$item_name</td>
										<td bgcolor='#FFFFFF' align='center'>
											$z_price_str ��</td>
										<td bgcolor='#FFFFFF' align='center'>
											$limit_total_str ��/<font color='#0000FF'> $current_num_str ��</font></td>
										<td bgcolor='#FFFFFF' align='center'>
											<input  onclick=\"window.location.href='limit_item_edit.php?item_no=$item_no&union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'> 
											<input  onClick='really2($item_no, $union_no)'  style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='����'></td>
										<td bgcolor='#FFFFFF' align='center'>
											<input  onclick=\"window.location.href='union_order_id_list.php?type=limit&item_no=$item_no&union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='��û�ں���'></td>
									</tr>
										");
									}
									?>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center"><strong>
						<input onclick="window.location.href='union_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�������� ùȭ��"> 
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