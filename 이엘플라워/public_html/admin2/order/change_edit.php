<?
include "../lib/Mall_Admin_Session.php";
include "../admin_head.php";
?>
<?
$table = "changegood";

$query = "select * from $table where c_uid='$c_uid'";

$result = mysql_query( $query, $dbconn );
$row = mysql_fetch_array( $result );

$c_code = $row[c_code];
$c_title = $row[c_title];
$c_order_num = $row[c_order_num];
$username = $row[username];
$c_name = $row[c_name];
$c_phone = $row[c_phone];
$c_email = $row[c_email];
$c_content = $row[c_content];
$c_reply = $row[c_reply];
$c_ok = $row[c_ok];
$c_regdate = $row[c_regdate];

$c_content = eregi_replace( "<br>", "", $c_content );

if( $username ){
	$username_str = "<a href='../member/member_view.php?username=$username'>$username</a>";
}else{
	$username_str = "��ȸ��";
}

if( $result ){
	mysql_free_result( $result );
}

?>
<script language="JavaScript">
<!-- 
function OpenWindow() {
	RemindWindow = window.open( "", "mainpage","toolbar=no,width=610,height=150,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no");
}
// -->
</script>
<script>
function really(num){
	if(confirm("\n������ �����Ͻðٽ��ϱ�?")){
		window.location.href='change_modify.php?flag=delete&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&c_uid='+num;
		return true;
	}
	return false; 
}

function change_check(){ 
	var base = document.changeform;

	if(base.c_title.value == ""){
		alert("������ �Է��ϼ���")
		base.c_title.focus()
		return;
	}

	if(base.c_name.value == ""){
		alert("��û�ڸ� �Է��ϼ���")
		base.c_name.focus()
		return;
	}

	if(base.c_order_num.value == ""){
		alert("�ֹ���ȣ�� �Է��ϼ���")
		base.c_order_num.focus()
		return;
	}

	if(base.c_phone.value == ""){
		alert("����ó�� �Է��ϼ���")
		base.c_phone.focus()
		return;
	}

	if(base.c_email.value == ""){
		alert("E-mail�� �Է��ϼ���")
		base.c_email.focus()
		return;
	}else{
		if(!check_email(base.c_email.value)){
			alert("�߸��� E-Mail �Դϴ�.");
			base.c_email.focus();
			return;
		}
	}

	if(base.c_content.value == ""){
		alert("������ �Է��ϼ���")
		base.c_content.focus()
		return;
	}

	base.submit();
}
</script>
<script>
function product_send_mail(order_num){
	var conf = confirm("����߸����� �����ðڽ��ϱ�?");
	if(conf == true)
	window.open("./product_send_mail.php?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&c_uid="+c_uid,"0x0","top=3000,left=3000,width=0,height=0");
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onload="InitializeStaticMenu();">
<?  include '../inc/menu4.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�ֹ�����</span> &gt; <span class="text_gray2_c">��ȯ/��ǰ ���� </span></div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>��ȯ/��ǰ ���� </b></td>
				</tr>
			</table>

			<!--���� START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
						��ȯ/��ǰ ������ �����մϴ�.</font><br>
					</td>
				</tr>
				<tr>
					<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>				
				<tr>
				<form name='changeform' method='post' action='change_modify.php?flag=update&c_uid=<?=$c_uid?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>' onsubmit='change_check(); return false;'>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
										<tr>
											<td width="100%" bgcolor="#8FBECD" colspan="2">
												<table border="0" width="100%" cellspacing="0" cellpadding="0">
													<tr>
														<td>&nbsp; <b>��ȯ/��ǰ ���� ���� &nbsp; [������ : <?=$c_regdate?>]</b></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr height='30'>
											<td width="20%" bgcolor="#FFFFFF" align="center">�� ��</td>
											<td width='80%' bgcolor="#FFFFFF" align="left">
												<input name="c_title" size="85" value='<?=$c_title?>' class="input_03" style='ime-mode:active'>
											</td>
										</tr>
										<tr height='30'>
											<td width="20%" bgcolor="#FFFFFF" align="center">�ֹ���ȣ</td>
											<td width='80%' bgcolor="#FFFFFF" align="left">
												<input name="c_order_num" size="30" value='<?=$c_order_num?>' class="input_03" style='ime-mode:inactive'>
											</td>
										</tr>
										<tr height='30'>
											<td bgcolor="#FFFFFF" align="center">��û��</td>
											<td bgcolor="#FFFFFF" align="left">
												<input name="c_name" size="20" value='<?=$c_name?>' class="input_03" style='ime-mode:active'> (<?=$username_str?>)
											</td>
										</tr>
										<tr height='30'>
											<td bgcolor="#FFFFFF" align="center">�̸���</td>
											<td bgcolor="#FFFFFF" align="left">
												<input name="c_email" size="50" value='<?=$c_email?>' class="input_03" style='ime-mode:inactive'>
											</td>
										</tr>
										<tr height='30'>
											<td bgcolor="#FFFFFF" align="center">����ó</td>
											<td bgcolor="#FFFFFF" align="left"><input name="c_phone" size="30" value='<?=$c_phone?>' class="input_03"></td>
										</tr>
										<tr>
											<td bgcolor="#FFFFFF" align="center">��ȯ/��ǰ ����</td>
											<td bgcolor="#FFFFFF" align="left"><textarea name="c_content" cols="83" rows="10" style='ime-mode:active'><?=$c_content?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<p align="center">
						<input type="submit" value="�� ��" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="�� ��">
						<input onClick="location.href='change_list.php?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�� ��">
						<input onClick="javascript:return really('<?=$c_uid?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�� ��">
						</p>
					</td>
				</form>
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
?>
<?
mysql_close($dbconn);
?>