<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $ReceiptTable where mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		$company_no = mysql_result($dbresult, 0, "company_no");
		$company_name = mysql_result($dbresult, 0, "company_name");
		$bossname = mysql_result($dbresult, 0, "bossname");
		$tel = mysql_result($dbresult, 0, "tel");
		$company_kind1 = mysql_result($dbresult, 0, "company_kind1");
		$company_kind2 = mysql_result($dbresult, 0, "company_kind2");
		$address = mysql_result($dbresult, 0, "address");
	}

	include "../admin_head.php";
?>
<script>
function check_form(f){
	if(f.company_no.value==""){
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���");
		f.company_no.focus();
		return false;
	}
	if(f.company_name.value==""){
		alert("��ȣ�� �Է��ϼ���");
		f.company_name.focus();
		return false;
	}
	if(f.bossname.value==""){
		alert("��ǥ�ڸ��� �Է��ϼ���");
		f.bossname.focus();
		return false;
	}
	if(f.tel.value==""){
		alert("��ȭ��ȣ�� �Է��ϼ���");
		f.tel.focus();
		return false;
	}
	if(f.company_kind1.value==""){
		alert("���¸� �Է��ϼ���");
		f.company_kind1.focus();
		return false;
	}
	if(f.company_kind2.value==""){
		alert("������ �Է��ϼ���");
		f.company_kind2.focus();
		return false;
	}
	if(f.address.value==""){
		alert("�������� �Է��ϼ���");
		f.address.focus();
		return false;
	}
}
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>����������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="35">��������¿� �ʿ��� �׸��� �Է��մϴ�.</td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>
<form name='f' method=post onsubmit="return check_form(this)">
<input type="hidden" name="flag" value="update" >
		<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<table border="0" width="90%" cellspacing="4" cellpadding="3">
					<tr>
						<td width="25%">����ڵ�Ϲ�ȣ</td>
						<td width="25%">
							<input name="company_no" value='<?echo $company_no?>' size="16" class="input_03"></td>
						<td width="25%" align="center">��ȣ</td>
						<td width="25%">
							<input name="company_name" value='<?echo $company_name?>' size="16" class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">��ǥ</td>
						<td width="25%">
							<input name="bossname" value='<?echo $bossname?>' size="16" class="input_03"></td>
						<td width="25%" align="center">��ȭ</td>
						<td width="25%">
							<input name="tel" value='<?echo $tel?>' size="16" class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">����</td>
						<td width="25%">
							<input name="company_kind1" value='<?echo $company_kind1?>' size="16" class="input_03"></td>
						<td width="25%" align="center">����</td>
						<td width="25%">
							<input name="company_kind2" value='<?echo $company_kind2?>' size="16" class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">������</td>
						<td width="75%" colspan="3">
							<input name="address" value='<?echo $address?>' size="55" class="input_03"></td>
					</tr>
				</table>
			</td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
				<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="�Ϸ�">&nbsp; 
				<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="���Է�">
				</td>
			</tr>
</form>
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
elseif ($flag == "update") {
	
	$SQL = "select * from $ReceiptTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	if(mysql_num_rows($dbresult)>0){
		$SQL = "update $ReceiptTable set company_no = '$company_no', company_name = '$company_name', ".
		"bossname = '$bossname', tel = '$tel', company_kind1 = '$company_kind1', company_kind2 = '$company_kind2', ".
		"address = '$address' where mart_id='$mart_id'";
	}else{
		$SQL = "insert into $ReceiptTable (mart_id, company_no, company_name, bossname, tel, company_kind1, ".
		"company_kind2, address) values ('$mart_id', '$company_no', '$company_name', '$bossname', '$tel', ".
		"'$company_kind1', '$company_kind2', '$address')";
	}
	
	$dbresult = mysql_query($SQL, $dbconn); 
	
	echo "<meta http-equiv='refresh' content='0; URL=receipt.php'>";
}
?>	
<?
mysql_close($dbconn);
?>