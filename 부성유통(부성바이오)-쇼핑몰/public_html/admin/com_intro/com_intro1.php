<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
?>

<script language="JavaScript">
<!--
//*************************** ���� ���ε� â ********************************************************************

function fileup(whichform,comment1,comment2){
// formname : form �� name
// mart_id : ���� mart_id
// imagename : ���ε�Ǵ� �̹��� ������ �ԷµǴ� field name, �� ���� DB�� ����
	
	var url = "file_upload_intro.php?whichform="+whichform+"&comment1="+comment1+"&comment2="+comment2;
	var uploadwin = window.open(url,"uploadwin","width=310,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

function OpenWindow2() {
	RemindWindow = window.open( "com_intro1_content.php", "mainpage2","toolbar=no,width=540,height=240,location=no,directories=no,status=no,menubar=no,scrollbars=auto,resizable=yes"); 
}
function prev_win() {
	window.open( "preview.php", "mainpage3","toolbar=no,width=600,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes"); 
}
//*************************** ���� ���ε� â ********************************************************************

//-->
</script>
</head>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>ȸ��Ұ� ����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="80%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="7" valign="top"><p style="padding-left: 15px"><span class="aa">�Ʒ��� ȭ���� ���ð� &quot;�� click&quot;ǥ�ð� �ִ� �κ��� 
						Ŭ���ϼż� �����Ͻð�, �������ϴ��� Preview��ư��<br>
						Ŭ���Ͻø� �ۼ��Ͻ� ȸ��Ұ�ȭ���� ���� �� �ֽ��ϴ�.<br>
						<br>
						</span>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="7" valign="top">
						<div align="center"><center>
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td colspan="3"><img src="../images/lay1000.gif" border="0" WIDTH="438" HEIGHT="150"></td>
							</tr>
							<tr>
								<td><img src="../images/lay1001.gif" border="0" WIDTH="84" HEIGHT="266"></td>
								<td><a href="javascript:fileup('1','ȸ��Ұ��� �ø� �̹����� ���ε��ϼ���.','�̹��������� : ���� 154pixel x ���� 173pixel');" onfocus="this.blur()"><img src="../images/lay1002.gif" border="0" WIDTH="92" HEIGHT="266"></a></td>
								<td><a href="javascript:OpenWindow2()" onfocus="this.blur()"><img src="../images/lay1003.gif" border="0" WIDTH="262" HEIGHT="134"></a><br>
									<a href="javascript:fileup('2','ȸ�� �൵�� �ø� �̹����� ���ε��ϼ���.','�̹��������� : ���� 450 pixel x ���� 350 pixel');" onfocus="this.blur()"><img src="../images/lay1004.gif" border="0" WIDTH="262" HEIGHT="132"></a></td>
							</tr>
						</table>
						</center></div><p style="padding-left: 10px" class="aa">��
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top"><p align="center"><span class="aa">
						<input class="aa" onclick='javascript:prev_win()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="Preview"></span></td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top"></td>
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