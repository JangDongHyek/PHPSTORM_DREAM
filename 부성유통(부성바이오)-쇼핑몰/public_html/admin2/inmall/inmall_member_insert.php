<?
include "../lib/Mall_Admin_Session.php";
?>
<?
include "../admin_head.php";
?>
<script language="JavaScript">
function idcheck(){
	var username = document.f.username.value;
	var url = "idcheck.php?mart_id=<?=$mart_id?>&form_info=f.username&user_id="+username
	var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	var Digit = '1234567890'

	if (Tcheck(f.username, '��� ID', Alpha + Digit, 4, 10)) return false;
	else{
		var checkwin
		checkwin = window.open(url, 'child','toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=400,height=300');
		//checkwin.focus(); 
	}
}

function Tcheck(target, cmt, astr, lmin, lmax){
	var i
	var t = target.value

	if (t.length < lmin || t.length > lmax) {
		if (lmin == lmax) alert(cmt + '�� ' + lmin + ' Byte �̾�� �մϴ�.');
			 else alert(cmt + '�� ' + lmin + ' ~ ' + lmax + ' Byte �̳��� �Է��ϼ���.');
		target.focus()
		return true
	}
	if (astr.length > 1) {
	        for (i=0; i<t.length; i++)
	                if(astr.indexOf(t.substring(i,i+1))<0) {
				alert(cmt + '�� ����� �� ���� ���ڰ� �ԷµǾ����ϴ�');
				target.focus()
				return true
			}
	}
        return false
	
}

function Eaddcheck(target, cmt){
	var i
	var t = target.value

	if (t.length > 1) {
	        for (i=0; i<t.length; i++)
	                if(t.substring(i,i+1) == '@') {
				return false;
			}
	}
        	alert(cmt + '�� ��Ȯ�� �Է��Ͽ� �ֽʽÿ�.');
	target.focus()
	return true	
}


function checkform(f){
	if (f.username.value=="") {
		alert("\n���̵� �Է��ϼ���.");
		f.username.focus();
		return false;
	}

	if (f.password.value=="") {
		alert("\n��й�ȣ�� �Է��ϼ���.");
		f.password.focus();
		return false;
	}

	var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	var Digit = '1234567890'

	if (Tcheck(f.password, '��й�ȣ', Alpha + Digit, 4, 8)) return false;
	
	if (f.name.value=="") {
		alert("\n���������� �Է��ϼ���.");
		f.name.focus();
		return false;
	}

	if (f.zip.value==""){
		alert("\n�����ȣ�� �Է��ϼ���.");
		f.zip.focus();  
		return false;
	}

	if (f.place.value==""){
		alert("\n�ּҸ� �Է��ϼ���.");
		f.place.focus();  
		return false;
	}

	if (f.place_detail.value==""){
		alert("\n�� �ּҸ� �Է��ϼ���.");
		f.place_detail.focus();  
		return false;
	}

	if (f.place_detail.value==""){
		alert("\n�� �ּҸ� �Է��ϼ���.");
		f.place_detail.focus();  
		return false;
	}

	if (f.tel1.value==""){
		alert("\n����ó�� �Է��ϼ���.");
		f.tel1.focus();  
		return false;
	}

}
function find_zip()	{
	var Sel = window.open ( '../../market/member/find_zip.php?flag=inmall', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}
function check1(){
    var str = document.f.passport.value.length;
    if(str == 12) {
       document.f.email.focus();
       
	}   	
} 
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>������ ����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">���� ���θ��� ������ ��� ���������� ������ ���/�����ϴ� ���Դϴ�.<br></td>
					</tr>
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top"></td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						<table border="0" width="100%">
							<tr>
								<td width="100%" height="20"><p align="center"><b>[������ �߰�]</b></td>
							</tr>
						</table>
					</td>
					</tr>
					
				<form method="post" name="f" onsubmit="return checkform(this)" enctype="multipart/form-data" action='inmall_member_regist.php'>
				<input type='hidden' name='flag' value='insert'>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"align="center">
						<table border="0" width="97%">
							<tr>
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										 <td width="15%" bgcolor="#C8DFEC" align="left">���̵�</td>
										 <td width="85%" bgcolor="#FFFFFF" colspan='3' align="left"><input name="username" value='<?=$username?>' size="20" class="input_03" style='ime-mode:inactive'> <input type="button" value="�ߺ�Ȯ��" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" style='cursor:hand' onclick="idcheck();"> (���̵�� ������, ���� �����ؼ� 6���̻�)</td>
									</tr>
									<tr>
										 <td width="15%" bgcolor="#C8DFEC" align="left">��й�ȣ</td>
										 <td width="35%" bgcolor="#FFFFFF" align="left"><input type='password' name="password" size="20" class="input_03" style='ime-mode:inactive'></td>
										 <td width="15%" bgcolor="#C8DFEC" align="left">��������</td>
										 <td width="35%" bgcolor="#FFFFFF" align="left"><input name="name" value="<?=$name?>" size="20" class="input_03" style='ime-mode:active'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">������</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3"> <input type='file' name='adminimg' class="bb" size="30"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">����ڹ�ȣ</td>
										<td bgcolor="#FFFFFF" align="left"><input name="passport" value="<?=$passport?>" size="20" maxlength='12' class="input_03" onkeyup='check1();'></td>
										<td bgcolor="#C8DFEC" align="left">�̸���</td>
										<td bgcolor="#FFFFFF" align="left"><p align="left"><input name="email" value="<?=$email?>" size="35" class="input_03" style='ime-mode:inactive'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">�����ȣ</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3">
											<input name="zip" value='<?=$zip?>' size="13" class="input_03" readonly>
											<input onclick="javascript:find_zip();" class="input_03" type="button" value="ã��" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px">
										</td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">�ּ�</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="place" value='<?=$place?>' size="50" class="input_03" style='ime-mode:active'> </td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">���ּ�</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="place_detail" value='<?=$place_detail?>' size="50" class="input_03" style='ime-mode:active'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">����ó</td>
										<td bgcolor="#FFFFFF" align="left"><input name="tel1" value='<?=$tel1?>' size="20" class="input_03"></td>
										<td bgcolor="#C8DFEC" align="left">�޴���</td>
										<td bgcolor="#FFFFFF" align="left"><input name="tel2" value='<?=$tel2?>' size="20" class="input_03"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">��������</td>
										<td bgcolor="#FFFFFF" align="left"><input name="me_bank" value='<?=$me_bank?>' size="20" class="input_03" style='ime-mode:active'>
										<td bgcolor="#C8DFEC" align="left">���¹�ȣ</td>
										<td bgcolor="#FFFFFF" align="left"><input name="me_bankno" value='<?=$me_bankno?>' size="20" class="input_03"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">������</td>
										<td bgcolor="#FFFFFF" align="left" colspan='3'><input name="me_bankowner" value='<?=$me_bankowner?>' size="20" class="input_03" style='ime-mode:active'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">��۾�ü��</td>
										<td bgcolor="#FFFFFF" align="left" colspan='3'><input name="me_delivery" value='<?=$me_delivery?>' size="50" class="input_03" style='ime-mode:active'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">��ۺ�</td>
										<td bgcolor="#FFFFFF" align="left" colspan='3'><input name="me_delivery_price" value='<?=$me_delivery_price?>' size="10" class="input_03" style='ime-mode:active'>�� (���ڸ� �Է��ϼ���)</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#C8DFEC" align="left">�� ��</td>
										<td width="85%" bgcolor="#FFFFFF" align="left" colspan='3'>
											<textarea cols="55" name="message" rows="4" class="input_03" style='ime-mode:active'><?=$message?></textarea>
										</td>
									</tr>
         
									</table>
								</td>
							</tr>
						</table>
					</td>
					</tr>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�� ��">
						&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�">
						&nbsp; 
						<input onclick="window.location.href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="����Ʈ��">
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
mysql_close($dbconn);
?>