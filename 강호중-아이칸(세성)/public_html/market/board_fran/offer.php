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
<title>���� �� ��û��û</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.content.value==""){
		alert("\n������ �Է��ϼ���.");
		frm.content.focus();
		return false;
	}	
	return true;
}

</script>



</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="390" height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		<td>


			<!--���� START~~-->  	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><b>[���� �� ��û ��û�ϱ�]</b><br><br>
				</td>
			</tr>
			<!--
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px">������,����,�ԽñⰣ �׸� ���ؼ��� ������û�� �����մϴ�.<br><br>
				</td>
			</tr>
			-->
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
          		<form action='offer.php' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="flag" value="add">
  				<input type="hidden" name="item_no" value="<?=$_SESSION[Mall_Admin_ID]?>">
     			<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
     			<input type="hidden" name="index_no" value="<?=$index_no?>">
     		<tr>
            		<td width="90%" bgcolor="#999999">
    
					<table border="0" width="100%" cellpadding=1 cellspacing=1>

              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="2">
                				���ǻ���
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="2">
								<textarea name="content" rows='15' cols='50'></textarea>
                			</td>
              			</tr>
               			<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								�ڵ��� : 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;����
                			</td>
						</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								��ȭ��ȣ : 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								<input type=radio name="open_tel" value="n" checked>����� <input type=radio name="open_tel" value="y">����
                			</td>
              			</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								�ּ� : 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								 <input type=radio name="open_address" value="n" checked>����� <input type=radio name="open_address" value="y">����
                			</td>
              			</tr>
              			<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								�̸��� : 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								 <input type=radio name="open_email" value="n" checked>����� <input type=radio name="open_email" value="y">����
                			</td>
              			</tr>

              			<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								��� : 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								 <input type=radio name="open_hobby" value="n" checked>����� <input type=radio name="open_hobby" value="y">����
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
	$sql = "insert into offer (seq_num ,index_no ,item_no ,content ,open_address ,open_email ,open_tel ,open_hobby, state, misu, regdate) values ('' ,'$index_no' ,'$item_no' ,'$content' ,'$open_address' ,'$open_email' ,'$open_tel' ,'$open_hobby', 'n','n', '$regdate')";


	$res = mysql_query($sql,$dbconn);


	echo "
		<script>
			alert('���ſ�û �� ��û �Ͽ����ϴ�.');window.close();
		</script>
	";
	exit;
}
?>
