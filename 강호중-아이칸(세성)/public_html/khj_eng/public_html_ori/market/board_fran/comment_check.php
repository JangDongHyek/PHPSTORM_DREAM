<?
if($Mall_Admin_ID&&$MemberLevel==1){
	echo"<script>if(confirm('���� ���� �Ͻðڽ��ϱ�??')){location.href='comment_del.php?flag=comdel&c_no=$c_no&index_no=$index_no&bbs_no=$bbs_no&page=$page&mart_id=$mart_id&keyset=$keyset&searchword=$searchword';}else{window.close();}</script>";
	exit;
}
?>
<html>
<head>
<title>��й�ȣ Ȯ��</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script>
var f = document.com;

function checkform(){
	if(document.com.cmt_password.value==''){
		alert("��й�ȣ�� �Է��ϼ���.");
		document.com.cmt_password.focus();
		return false;
	}
	return true;	
}	
</script>
</head>

<body topmargin='0' leftmargin='0' onload='document.com.cmt_password.focus();'>
<form name='com' action='comment_del.php?flag=comdel&c_no=<?=$c_no?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>' method='post' onsubmit='return checkform();'>


<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="10" rowspan="3"></td>
		<td height="70"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        	<tr>
        		<td background="../image/blank/title_bg.gif"><img src="../image/blank/title_8.gif" width="190" height="70"></td>
        		<td width="20"><img src="../image/blank/title_right.gif" width="20" height="70"></td>
     		</tr>
        	</table></td>
		<td width="10" rowspan="3"></td>
	</tr>
	<tr>
		<td valign="top"><table width="100%" height="100%"  border="0" cellpadding="10" cellspacing="0">
				<tr>
					<td valign="top"><!--���̺� ����-->
    						<table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
                            	<tr>
                            		<td width="90" height="4" bgcolor="1F76AF"></td>
                           		</tr>
                            	<tr align="center">
                            		<td height="50"  bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">��й�ȣ�� �Է��ϼ���! </td>
                           		</tr>
                            	<tr align="center" bgcolor="#FFFFFF">
                            		<td height="100">
											<input type='password' name='cmt_password' size='20' class='input_03'>

											<input type='image' onfocus='blur();' src="../image/helpdesk/bu_ok2.gif" width="45" height="20" align="absmiddle" border="0">
                           		</td>
                           		</tr>
                            	<tr>
                            		<td bgcolor="1F76AF" height="4"></td>
                           		</tr>
                            	</table>
    						<!--���̺� END-->
					</td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        	<tr>
        		<td width="20"><img src="../image/blank/bottom_left.gif" width="20" height="50"></td>
        		<td align="center" background="../image/blank/bottom_bg.gif"> <img src="../image/bu_close.gif" width="60" height="20" style="cursor:hand;" onclick="window.close()"></td>
        		<td width="20"><img src="../image/blank/bottom_right.gif" width="20" height="50"></td>
     		</tr>
        	</table></td>
	</tr>
</table>

<!--
<table width='300' border='0' cellpadding='0' cellspacing='0'>
	<tr height='20'>
		<td></td>
	</tr>
	<tr height='30'>
		<td align='center'><b>��й�ȣ Ȯ��</b></td>
	</tr>
	<tr height='25'>
		<td>��й�ȣ : <input type='password' name='cmt_password' size='12'>&nbsp;&nbsp;<input type='submit' name='ok' value='Ȯ ��'></td>
	</tr>
</table>
-->

</form>
</body>
</html>