<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){
	$SQL = "select * from $CatalogTable where catalog_no = $catalog_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$img = $ary["img"];
		if(file_exists("$Co_img_UP$mart_id/$img") && $img != '')
			unlink("$Co_img_UP$mart_id/$img");
	}
	
	$SQL = "delete from $CatalogTable where catalog_no = $catalog_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$flag = '';
}

if($flag == ""){
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$if_catalog = $ary["if_catalog"];
	}
	
	$SQL = "select * from $Catalog_ConfTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$catalog_name = $ary["catalog_name"];
	}

	include "../admin_head.php";
?>
<script>
function del(catalog_no){
	if(confirm("�����Ͻðڽ��ϱ�?")){
		window.location.href = 'catalog_list.php?flag=del&catalog_no='+catalog_no;
	}
	else return;
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>īŻ�α�</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">�¶��� īŻ�α״� ������, �ٹ�, 
					��ǰ īŻ�α�, �����̵� ���µ����� �̿��� ������ 
					���α׷��Դϴ�. <br>
					<br>
					������� ���λ���Ʈ������ �������� Ȱ���� �����ϰ� 
					��Ƽ�������� ����ũ�� ���µ��� ���鶧 <br>
					�̿��Ͻ� �� �ֽ��ϴ�. <br>
					�¶��� īŻ�α״� ���� 1������ ���������ϸ� �̹����� 150������ 
					�ø� �� �ֽ��ϴ�. <br>
					���� ���׷��̵� ������ ���� ���������� īŻ�α� �Խ����� ���� 
					�ø� �����Դϴ�.
				</td>
				</tr>

				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%" cellspacing="0" cellpadding="0">
<form>
<input type='hidden' name='flag' value='update'>
						
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="0" colspan="2">
								<strong>�¶��� īŻ�α� ����� �̿��Ͻðڽ��ϱ�?&nbsp;&nbsp; </strong>
								<input name="if_catalog" type="radio" value="t" 
								<?
								if($if_catalog == 't') echo " checked";
								?>
								>Yes&nbsp;&nbsp; 
								<input name="if_catalog" type="radio" value="f"
								<?
								if($if_catalog == 'f') echo " checked";
								?>
								>No<br>

								<strong>īŻ�α��� �̸��� �������� �Ͻðڽ��ϱ�? &nbsp;&nbsp; </strong>
								
								<input name="catalog_name" value='<?echo $catalog_name?>' size="25" class="input_03">
								<br>
								<font color="#0000FF">(�Է¿� : �̼ҳ� �ڷ��, ����ũ�� 
								����, īŻ�α�)</font>
							</td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"></td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"><center>
								<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="����">&nbsp;
								<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�">&nbsp;
								</center>
							</td>
						</tr>
</form>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br>
							</td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
						</tr>
<?
	$SQL = "select * from $CatalogTable where mart_id='$mart_id' order by catalog_no desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if ($cnfPagecount == "") $cnfPagecount = 10;
	if ($page == "") $page = 1;
	$skipNum = ($page - 1) * $cnfPagecount;
	
	$prev_page = $page - 1;
	$next_page = $page + 1;
	
	$total_page = ($numRows - 1) / $cnfPagecount;
	$total_page = intval($total_page)+1;
	
	if($page % 10 == 0)
	$start_page = $page - 9;
	else
	$start_page = $page - ($page % 10) + 1;
	
	$end_page = $start_page + 9;
	if($end_page >= $total_page)
		$end_page = $total_page;
	$prev_start_page = $start_page - 10;
	$next_start_page = $start_page + 10;
?>
					<tr>
							<td width="50%" bgcolor="#FFFFFF">
								<p style="padding-left: 10px"><br>
								�� <?echo $numRows?>���� �Խù��� ��ϵǾ� �ֽ��ϴ�.
							</td>
							<td width="50%" bgcolor="#FFFFFF"><p align="right"><br>
								<input onclick="window.location.href='catalog_write.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Խù� ���">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								
							</td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" colspan="2">
								<p style="padding-left: 20px">
								
								<?
							if($page == 1){
								echo ("
								ó��
								");
							}
							else{
								echo ("
								<a href='catalog_list.php?page=1'>ó��</a>
								");
							}
						
							if($start_page >1){
								echo ("
								<a href='catalog_list.php?page=$prev_start_page'>
								��&nbsp; 
								</a>
								");
							}
							else{
								echo ("
								��&nbsp; 
								");
							}
							for($i=$start_page;$i<=$end_page;$i++){
								if($i == $page){
									echo ("	
									[<b>$i</b>]
									");
								}
								else{
									echo ("
								<a href='catalog_list.php?page=$i'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='catalog_list.php?page=$next_start_page'>
								&nbsp;��
								</a>
								");
							}
							else{
								echo ("
								&nbsp;��
								");
							}
							if($page == $total_page){
								echo ("
								��
								");
							}
							else{
								echo ("
								<a href='catalog_list.php?page=$total_page'>��</a>
								");
							}
							?>
								
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
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#94C652" colspan="5">
										<strong>&quot;īŻ�α��̸�&quot;�� 
										��ϵ� �Խù� ����Ʈ</strong>
									</td>
								</tr>
								<tr>
									<td width="6%" bgcolor="#C8DCA9" align="center">��ȣ</td>
									<td width="24%" bgcolor="#C8DCA9" align="left"><p align="center">����</td>
									<td width="9%" bgcolor="#C8DCA9" align="left"><p align="center">�����</td>
									<td width="9%" bgcolor="#C8DCA9" align="center">����/����</td>
									<td width="5%" bgcolor="#C8DCA9" align="center">��ȸ��</td>
								</tr>
							  <?
								for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
								if ($i >= $numRows) break;
								mysql_data_seek($dbresult, $i);
								$ary=mysql_fetch_array($dbresult);
								$catalog_no = $ary["catalog_no"];
								$title = $ary["title"];
								$date = $ary["date"];
								$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
								$content = $ary["content"];
								$readnum = $ary["readnum"];
								$img = $ary["img"];
								$j = $numRows - $i;
								echo ("	
							<tr>
									<td width='6%' bgcolor='#FFFFFF' align='center'>
										$j</td>
									<td width='25%' bgcolor='#FFFFFF' align='left'>
										$title</td>
									<td width='9%' bgcolor='#FFFFFF' align='left'>
										<p align='center'>
										$date_str</td>
									<td width='9%' bgcolor='#FFFFFF' align='center'>
										<input onclick=\"window.location.href='catalog_edit.php?catalog_no=$catalog_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'>
										<input onclick=\"return del('$catalog_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'>
									</td>
									<td width='5%' bgcolor='#FFFFFF' align='center'>
										0
									</td>
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
}
if($flag == "update"){
	$SQL = "update $MartMngInfoTable set if_catalog = '$if_catalog' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 
	
	$SQL = "select * from $Catalog_ConfTable where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	if(mysql_num_rows($dbresult)>0){
		$SQL = "update $Catalog_ConfTable set catalog_name='$catalog_name' where mart_id='$mart_id'";
	}
	else{
		$SQL = "insert into $Catalog_ConfTable (mart_id, catalog_name) values ".
		"('$mart_id', '$catalog_name')";
	}
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=catalog_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>