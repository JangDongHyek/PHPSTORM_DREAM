<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ���� ������ �ҷ��� =============================================
include "../../main.class";
?><?

$sql = "select * from offer where seq_num = '$seq_num'";
$res  = mysql_query($sql,$dbconn);
$rows = mysql_fetch_array($res);


$sql2 = "select * from item where item_id='$rows[item_no]'";
$result2 = mysql_query($sql2,$dbconn);
$rows2 = mysql_fetch_array($result2);

?>
<html>
<head>
<title>���� �� ��û��û �󼼺���</title>
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
					<p style="padding-left: 10px"><b>[�󼼺���]</b><br><br>
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
          		<form action='offer_detail.php' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="flag" value="add">
  				<input type="hidden" name="seq_num" value="<?=$seq_num?>">
     		<tr>
            		<td width="90%" bgcolor="#999999">
    
					<table border="0" width="100%" cellpadding=1 cellspacing=1>
                		<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>�ۼ��ð�</b>  &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows[regdate]?>
                			</td>
						</tr>
                		<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>�̸�</b>    &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[item_name]?>
                			</td>
						</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>�ڵ���</b>  &nbsp;  
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[mobile]?>
                			</td>
						</tr>
						<?
						if($rows[open_tel] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>��ȭ��ȣ</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[tel]?>
                			</td>
              			</tr>
						<?}?>
						<?
						if($rows[open_address] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>�ּ�</b>  &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[address]?> <font style='cursor:hand;' onclick="window.open('./map.php?address_pop=<?=$rows2[address]?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[��ġȮ��]</font>	
                			</td>
              			</tr>
 						<?}?>
						<?
						if($rows[open_email] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>�̸���</b>  &nbsp; 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								 &nbsp;<?=$rows2[email]?>
                			</td>
              			</tr>
						<?}?>
						<?
						if($rows[open_hobby] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>���</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[hobby]?>
                			</td>
              			</tr>
						<?}?>
 						<?
						if($rows[open_num] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>ȸ����ȣ</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$row2[country_num]?><?=$row2[sea_num]?><?=$row2[sung_num]?><?=$row2[khan_num]?><?=$row2[sudong_num]?>
                			</td>
              			</tr>
						<?}?>

						<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="2">
                				<b>���ǻ���</b>  &nbsp;
							</td>
              			</tr>
              			<tr>
                			<td width="100%" height=200 bgcolor="#FFFFFF" colspan="2" valign=top>
								<?=nl2br($rows[content])?>
                			</td>
              			</tr>
					</table>
<?
//�ڱ���϶� ������û,������û	
if($username == $_SESSION[Mall_Admin_ID]){
?>
<table border="0" width="100%" cellpadding=1 cellspacing=1>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>�ϷῩ��</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<input type=radio name=state value="y" <?if($rows[state]=='y'){echo"checked";}?>>�Ϸ� <input type=radio name=state value="n" <?if($rows[state]=='n'){echo"checked";}?>>�̿Ϸ�
                			</td>
              			</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>�̼��ݿ���</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<input type=radio name=misu value="y" <?if($rows[misu]=='y'){echo"checked";}?>>�� <input type=radio name=misu value="n" <?if($rows[misu]=='n'){echo"checked";}?>>�ƴϿ�
                			</td>
              			</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>��Ÿ�޸�</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<textarea name="memo" rows='13' cols='30'><?=$rows[memo]?></textarea>
                			</td>
              			</tr>

		
		</table>
<?}?>




            		</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br>
				
        	<input type=submit style='width:60' type="submit" value=" ���� " style='cursor:hand'>&nbsp;&nbsp;	<input  onclick="javascript:window.close();" class='butt_none' style='width:60' type="button" style='cursor:hand' value="â�ݱ�">
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
	$sql = "update offer set state='$state', misu='$misu', memo='$memo' where seq_num='$seq_num'";


	$res = mysql_query($sql,$dbconn);


	echo "
		<script>
			alert('���� �Ͽ����ϴ�.');opener.location.reload();window.close();
		</script>
	";
	exit;
}
?>
