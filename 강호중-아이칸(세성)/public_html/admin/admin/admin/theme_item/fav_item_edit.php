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
$SQL = "select * from $Fav_ItemTable where fav_item_no = $fav_item_no and mart_id='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_no_ori = $ary["item_no"];
	$provider_id = $ary["provider_id"];
	$comment = $ary["comment"];
}
?>
<?
	include "../admin_head.php";
?>
<script>
function checkform(f){
	if(f.comment.value==""){
		alert("�ڸ�Ʈ�� �Է��ϼ���.");
		f.comment.focus();
		return false;
	}
	return true;
}
</script>
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
        	<td width="90%" bgcolor="#FFFFFF" valign="top">��<p style="padding-left: 10px"><strong><span
        		class="cc">[����Ʈ��ǰ ���]</strong> ��ϵǾ��� ��ǰ 
        		�� ����Ʈ��ǰ���� ����մϴ�.<br>
        		����� ����Ʈ��ǰ�� ����ȭ���� ����Ʈ��ǰ������ ��µ˴ϴ�.<br>
        		����Ʈ��ǰ ��ϰ��������� ������ 3~4�� ������ �����մϴ�.<br>
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
      	
      	<form method="post" name="frm" onsubmit='return checkform(this)'>
		<input type="hidden" name="flag" value="update">
		<input type="hidden" name="fav_item_no" value='<?echo $fav_item_no?>'>
		
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
                			<td size="80" bgcolor="#FFFFFF" align="center"><p align="left">&nbsp;
                				 
                				<?
								$SQL = "select * from $ItemTable where item_no=$item_no_ori";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if($numRows > 0) {
									mysql_data_seek($dbresult, 0);
									$ary = mysql_fetch_array($dbresult);
									$item_name = $ary["item_name"];
								}
			            		echo $item_name;
			            		?>
			            		
			            	</td>
              			</tr>
              			<tr>
                			<td width="20%" bgcolor="#C8DFEC" align="center">�ڸ�Ʈ</td>
                			<td size="80" bgcolor="#FFFFFF" align="center"><p align="left">&nbsp; 
                				
            					<input name="comment" value='<?echo $comment?>' size="80" maxlength='35' style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"> 35�� �̳�
			     			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="2">
                				
                				<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ����Ʈ��ǰ���� ����� 
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
elseif ($flag == "update") {
	$SQL = "update $Fav_ItemTable set comment = '$comment' where mart_id='$mart_id' and fav_item_no = $fav_item_no";
	$dbresult = mysql_query($SQL, $dbconn);

	if ($dbresult == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
?>
<?
mysql_close($dbconn);
?>