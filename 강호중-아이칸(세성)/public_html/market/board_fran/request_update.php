<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ���� ������ �ҷ��� =============================================
include "../../main.class";
?><?

if($flag!="add"){

	$sql  = "select * from new_board where bbs_no='$bbs_no' and index_no='$index_no'";
	$res  = mysql_query($sql,$dbconn);
	$rows = mysql_fetch_array($res);

	$firstno = $rows[firstno];
	$prevno = $rows[prevno];
	$thirdno = $rows[thirdno];
	$category_num = $rows[category_num];
}
?>
<html>
<head>
<title>������û</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.content.value==""){
		alert("\n��û������ �Է��ϼ���.");
		frm.content.focus();
		return false;
	}	
	return true;
}

</script>



</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="410" height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		<td>


			<!--���� START~~-->  	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><b>[������û]</b><br><br>
				</td>
			</tr>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px">�ذԽñⰣ �׸� ���ؼ��� ������û�� �����մϴ�.<br><br>
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
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
        		<table border="0" width="95%">
          		<form action='request_update.php' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="flag" value="add">
				<input type="hidden" name="pu" value="<?=$pu?>">
				<input type="hidden" name="firstno" value="<?=$firstno?>">
				<input type="hidden" name="prevno" value="<?=$prevno?>">
				<input type="hidden" name="thirdno" value="<?=$thirdno?>">
				<input type="hidden" name="category_num" value="<?=$category_num?>">
  				<input type="hidden" name="item_no" value="<?=$_SESSION[Mall_Admin_ID]?>">
     			<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
     			<input type="hidden" name="index_no" value="<?=$index_no?>">
     		<tr>
            		<td width="90%" bgcolor="#999999">
    
					<table border="0" width="100%" cellpadding=1 cellspacing=1>

              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				�ԽñⰣ ����							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="6">
								<input type=radio name="content" value="5��" checked>5��
								<input type=radio name="content" value="10��">10��
								<input type=radio name="content" value="20��">20��
								<input type=radio name="content" value="1����">1����
								<input type=radio name="content" value="3����">3����
								<input type=radio name="content" value="6����">6����
								<input type=radio name="content" value="12����">12����
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br>
				<input type=submit style='width:60' type="submit" value="��û�ϱ�" style='cursor:hand'>&nbsp;&nbsp;
        		<input  onclick="javascript:window.close();" class='butt_none' style='width:60' type="button" style='cursor:hand' value="â�ݱ�">
        	</td>
      	</tr>
  
		</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
if($flag=="add"){
	
	$regdate = date("Y-m-d H:i:s");
	//ȸ���Ⱓ�� �����ؼ� insert�ϱ�
	$sql = "insert into request_update_fran (seq_num,firstno,prevno,thirdno,category_num,item_no,content,update_yn,regdate,index_no,bbs_no) values ('','$firstno','$prevno','$thirdno','$category_num','$item_no','$content','n','$regdate','$index_no','$bbs_no')";
	$res = mysql_query($sql,$dbconn);


	echo "
		<script>
			alert('������û�� �Ͽ����ϴ�.');window.close();
		</script>
	";
	exit;
}
?>
