<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if(isset($flag) == false) {
	$SQL = "select * from $MemberTable where mart_id='$mart_id' and username='$username'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);	
		$ary = mysql_fetch_array($dbresult);
		$lastlogin = $ary[lastlogin];
		$loginno  = $ary[loginno ];
		$username = $ary[username];
		$password = $ary[password];
		$perms = $ary[perms];
		$name = $ary[name];
		$admin_img = $ary[admin_img]; //������ ���ۼ��� ������
		$date1 = $ary[date];
		$description = $ary[description];
		$passport = $ary[passport];
		$tel1 = $ary[tel1]; 
		$tel2 = $ary[tel2];
		$email = $ary[email];
		$message = $ary[message];
		$gubun = $ary[gubun];
		$zip = $ary[zip];
		$place = $ary[place];
		$place_detail = $ary[place_detail];
		$me_bank = $ary[me_bank];
		$me_bankno = $ary[me_bankno];
		$me_bankowner = $ary[me_bankowner];

		if($perms == "4"){
			$Perms = "ȸ����";
		}elseif($perms == "3"){
			$Perms = "������";
		}elseif($perms == "2"){
			$Perms = "���θ�������";
		}elseif($perms == "1"){
			$Perms = "��ü������";
		}else{
			$Perms = "&nbsp;";
		}

		if( $admin_img ){
			//========================= �׸������� ������ ��� ===========================
			$upload = "../../up/$mart_id/"; //���ε� ���丮
			$target = "$upload"."$admin_img";
			$admin_img_new = "<img src='$target' border='0' align='absmiddle'>";
		}
	}

	include "../admin_head.php";
?>
<script language="JavaScript">
function Tcheck(target, cmt, astr, lmin, lmax)
{
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

function Eaddcheck(target, cmt)
{
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


function checkform(f)
{
	var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	var Digit = '1234567890'

	if (Tcheck(f.password, '��й�ȣ', Alpha + Digit, 4, 8)) return false;
	
	if (f.name.value=="") {
	        alert("\n�̸��� �Է��ϼ���.");
	        f.name.focus();
	        return false;
	}
	
}
function find_zip()	{
	var Sel = window.open ( '../../market/member/find_zip.php?flag=inmember', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}
function really(){
	if(confirm("\n���� ȸ���縦 �����Ͻðڽ��ϱ�?\n\n������ ���� �ʽ��ϴ�.")){
    window.location.href='inmember_member_view.php?flag=del&username=<?=$username?>';
  }
	
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "7";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>ȸ���� ����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">���� ���θ��� ������ ��� ȸ������� ������ ���/�����ϴ� ���Դϴ�.<br></td>
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
								<td width="100%" height="20"><p align="center"><b>[ȸ���� ������ �� ����]</b></td>
							</tr>
						</table>
					</td>
					</tr>
					
				<form method="post" name="f" onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='admin_img' value='<?=$admin_img?>'>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"align="center">
						<table border="0" width="97%">
							<tr>
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										 <td width="15%" bgcolor="#C8DFEC" align="left">ȸ�����</td>
										 <td width="35%" bgcolor="#FFFFFF" align="left"><input name="name" value="<?=$name?>" size="20" class="input_03" style='ime-mode:active'></td>
										 <td width="15%" bgcolor="#C8DFEC" align="left">������</td>
										 <td width="35%" bgcolor="#FFFFFF" align="left"><?=$date1?></td>
									  </tr>
									<tr>
										<td width="15%" bgcolor="#C8DFEC" align="left">�����α���</td>
										<td width="35%" bgcolor="#FFFFFF" align="left"><?=$lastlogin?></td>
										<td width="15%" bgcolor="#C8DFEC" align="left">�α���Ƚ��</td>
										<td width="35%" bgcolor="#FFFFFF" align="left"><?=$loginno?></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">������</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3"><?=$admin_img_new?> <input type='file' name='adminimg' class="bb" size="30"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">ID</td>
										<td bgcolor="#FFFFFF" align="left"><?=$username?></td>
										<td bgcolor="#C8DFEC" align="left">�̸���</td>
										<td bgcolor="#FFFFFF" align="left"><p align="left"><input name="email" value="<?=$email?>" size="35" class="input_03" style='ime-mode:inactive'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">��й�ȣ</td>
										<td bgcolor="#FFFFFF" align="left"><input name="password" value="<?=$password?>" size="20" class="input_03" style='ime-mode:inactive'></td>
										<td bgcolor="#C8DFEC" align="left">����ڹ�ȣ</td>
										<td bgcolor="#FFFFFF" align="left"><input name="passport" value="<?=$passport?>" size="14" maxlength='14' class="input_03"></td>
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
										<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="place_detail" value='<?=$place_detail?>' size="50" class="input_03" style='ime-mode:active'> </td>
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
										<td bgcolor="#C8DFEC" align="left">�� ��</td>
										<td bgcolor="#FFFFFF" align="left" colspan='3'><textarea cols="55" name="message" rows="4" class="input_03" style='ime-mode:active'><?=$message?></textarea></td>
									</tr>
         
									</table>
								</td>
							</tr>
						</table>
					</td>
					</tr>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="����">
						&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�">
						&nbsp; 
						<input onclick="really()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����">
						&nbsp; 
						<input onclick="window.location.href='inmember_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="����Ʈ��">
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
if($flag == "update"){
	//================== ���ε� �Լ� �ҷ��� ==============================================
	include "../../market/upload.php";
	$upload_dir = "$UploadRoot$mart_id/";

	if( $adminimg_name ){//÷�� ������ ���ε� ������ ���ϸ��� ������
		$file = FileUploadName( "$admin_img", "$upload_dir", $adminimg, $adminimg_name );
		$sql = "update $MemberTable set admin_img='$file' where username='$username'";
		$res = mysql_query( $sql, $dbconn );

		if( !$res ){
			echo("
				<script>
				window.alert('�̹����� �����ϴµ� �����߽��ϴ�!');
				history.go(-1)
				</script>
			");
			exit;
		}
	}

	$SQL = "update $MemberTable set name='$name', password='$password', email= '$email', tel1='$tel1', tel2='$tel2', zip='$zip', place='$place', place_detail='$place_detail', passport='$passport', message='$message', me_bank='$me_bank', me_bankno='$me_bankno', me_bankowner='$me_bankowner' where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= inmember_member_view.php?username=$username'>";
	}else{
		echo ("
			<script>
			alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}
if($flag=="del"){
	$upload_dir = "$UploadRoot$mart_id/";

	//==================== ������ �ִٸ� ������ ���� ������ ==============================
	$sql = "select admin_img from $MemberTable where username='$username' and mart_id ='$mart_id'";
	$res = mysql_query($sql, $dbconn);
	$row = mysql_fetch_array( $res );
	$admin_img = $row[admin_img];

	if( $admin_img ){
		$desc = "{$upload_dir}{$admin_img}";
		unlink($desc);
	}

	$SQL = "delete from $MemberTable where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= inmember_member_list.php'>";
	}else{
		echo ("
			<script>
			alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}
?>
<?
mysql_close($dbconn);
?>