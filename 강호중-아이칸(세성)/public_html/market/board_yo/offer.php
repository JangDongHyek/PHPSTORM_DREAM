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

	$pre_username = $rows[username];
	$pre_writer = $rows[writer];
	$pre_subject = $rows[subject_new];
	$pre_price = $rows[price];
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

     			<input type="hidden" name="pre_username" value="<?=$pre_username?>">
     			<input type="hidden" name="pre_writer" value="<?=$pre_writer?>">
     			<input type="hidden" name="pre_subject" value="<?=$pre_subject?>">
     			<input type="hidden" name="pre_price" value="<?=$pre_price?>">



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
								�޴���ȭ : 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								<input type=radio name="open_mobile" value="n" checked>����� <input type=radio name="open_mobile" value="y">����
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
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								ȸ����ȣ : 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								<input type=radio name="open_num" value="n" checked>����� <input type=radio name="open_num" value="y">����
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




	$sql = "insert into offer (seq_num ,index_no ,item_no ,content ,open_address ,open_email ,open_tel,open_mobile ,open_hobby, open_num, state, misu, pre_username,  pre_writer, pre_subject, pre_price, regdate,country_num) values ('' ,'$index_no' ,'$item_no' ,'$content' ,'$open_address' ,'$open_email' ,'$open_tel','$open_mobile' ,'$open_hobby', '$open_num', 'n','n', '$pre_username',  '$pre_writer', '$pre_subject', '$pre_price', '$regdate','100')";


	$res = mysql_query($sql,$dbconn);

	$conn_db=mysql_connect("localhost","khj_eng","tpsxja!@#");
	mysql_select_db("khj_eng");
	$country_num = 100;//�ѱ�
	$sql2 = "insert into offer (seq_num ,index_no ,item_no ,content ,open_address ,open_email ,open_tel,open_mobile ,open_hobby, open_num, state, misu, pre_username,  pre_writer, pre_subject, pre_price, regdate, country_num) values ('' ,'$index_no' ,'$item_no' ,'$content' ,'$open_address' ,'$open_email' ,'$open_tel','$open_mobile' ,'$open_hobby', '$open_num', 'n','n', '$pre_username',  '$pre_writer', '$pre_subject', '$pre_price', '$regdate', '$country_num')";
	$res2 = mysql_query($sql2,$conn_db);

	echo "
		<script>
			alert('���ſ�û �� ��û �Ͽ����ϴ�.');window.close();
		</script>
	";
	exit;
}
?>
