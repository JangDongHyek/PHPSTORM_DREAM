<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if (isset($flag) == false) {
?>
<?
	include "../admin_head.php";
?>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top"><p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a3.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><br>
        		<small>��</small> <font face="����">���θ��� <strong>�׸���ǰ</strong>��<strong> 
        		<br>
        		&nbsp;&nbsp; ����</strong>�մϴ�.<br>
        		</font><br>
        		
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#98A043" height="1"></td>
      	</tr>
    	</table>
    	<p align="left"><br>
    	<br>
    </td>
    <td width="1" bgcolor="#808080"><br>
    </td>
    <td width="646" bgcolor="#FFFFFF" valign="top">
    	<div align="center"><center>
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top">��<p style="padding-left: 10px"><strong>[������� ���]</strong> ��ϵǾ��� ��ǰ �� 
        		����������� ����մϴ�.<br>
        		����� ��������� ����ȭ���� ������῵���� ��µ˴ϴ�.<br>
        		������� ��ϰ��������� ������ 3~6�� ������ �����մϴ�.<br>
        		<br>
        		
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF"></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	
      	<form method="post" name="frm">
		<input type="hidden" name="flag" value="add">
		
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="left">
        		<table border="0" width="100%">
          		<tr>
            		<td width="1%" bgcolor="#FFFFFF"></td>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="20%" bgcolor="#C8DFEC" align="center">��ǰ��</td>
                			<td width="80%" bgcolor="#FFFFFF" align="center"><p align="left">&nbsp; 
	                			<select name="item_no" size="1">
								<?
								$SQL = "select * from $ItemTable where mart_id='$mart_id' order by item_no desc";
								$dbresult = mysql_query($SQL, $dbconn);

								$numRows = mysql_num_rows($dbresult);
								for ($i=0; $i<$numRows; $i++) {
									mysql_data_seek($dbresult,$i);
									$ary = mysql_fetch_array($dbresult);
									$item_no = $ary["item_no"];
									$item_name = $ary["item_name"];
									echo "<option value='$item_no' >$item_name</option>";
								}
			            		
			            		// �ְ� �ޱ� ��ǰ ������ ����
			            		$SQL = "select T1.* from $ItemTable T1, $GiveNTakeTable T2 ".
			            		"where (T1.category_num = T2.category_num or T1.prevno = T2.category_num) and T2.seller_id = '$Mall_Admin_ID' and T2.state1='2' order by item_no desc";
								$dbresult = mysql_query($SQL, $dbconn);

								$numRows = mysql_num_rows($dbresult);
								for ($i=0; $i<$numRows; $i++) {
									mysql_data_seek($dbresult,$i);
									$ary = mysql_fetch_array($dbresult);
									$item_no = $ary["item_no"];
									$item_name = $ary["item_name"];
									echo "<option value='$item_no' >$item_name</option>";
								}
								?>
			            		</select>
			            	</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="2">
	                			<p align="left">
                				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ����������� ����� 
                				��ǰ�� �����Ͻ� ����, �ϷḦ Ŭ���ϼ���.
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		</div>
        	</td>
   		</tr>
    	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�">&nbsp; 
        		<input onclick="window.location.href='theme_item.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��">
        	</td>
 		</tr>
    	</form>
    	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
    	</tr>
    	</table>
    	</center></div>
   	</td>
</tr>
</table>
</body>
</html>
<?
}
elseif ($flag == "add") {
	$SQL = "select count(*) from $New_ItemTable where mart_id='$mart_id' and item_no = $item_no";
	$dbresult = mysql_query($SQL, $dbconn);

	if ($dbresult == false) echo "���� ���� ����!";

	if (mysql_result($dbresult,0,0) > 0){
		echo ("
		<script language='javascript'>
			alert(\"�̹� ����Ͻ� ��ǰ�Դϴ�.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=new_item.php'>";
		exit;
	} 
	
	$SQL = "select max(new_item_no), count(*) from $New_ItemTable";
	$dbresult = mysql_query($SQL, $dbconn);

	if ($dbresult == false) echo "���� ���� ����!";

	if (mysql_result($dbresult,0,1) > 0) 
		$maxNew_Item_no = mysql_result($dbresult, 0, 0);
	else
		$maxNew_Item_no = 0;
	
	$maxNew_Item_no = $maxNew_Item_no + 1;
	
	$SQL = "insert into $New_ItemTable (new_item_no, item_no, mart_id) values ($maxNew_Item_no, $item_no, '$Mall_Admin_ID')";
	$dbresult = mysql_query($SQL, $dbconn);

	if ($dbresult == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
?>
<?
mysql_close($dbconn);
?>