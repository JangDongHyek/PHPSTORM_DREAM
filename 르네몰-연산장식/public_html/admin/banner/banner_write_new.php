<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag != "write"){
?>
<?
	include "../admin_head.php";
?>
<script>
function checkform(f){
	if (f.img.value=="" &&f.flash_image.value=="") {
		alert("�̹����� �����ϼ���");
		//f.imageup.focus();
		return false;
	}
	/*
	if (f.link.value=="") {
		alert("��ũ�Ұ��� �Է��ϼ���");
		f.link.focus();
		return false;
	}
	*/
	return true;	
}
function checkform1(f){
	if(f.if_flash[0].checked){
		if (f.img.value=='') {
			alert("�̹����� �����ϼ���");
			//f.imageup.focus();
			return false;
		}
		if (f.img_width.value=='') {
			alert("���α��̸� �Է��ϼ���.");
			f.img_width.focus();
			return false;
		}
		if (f.img_height.value=='') {
			alert("���α��̸� �Է��ϼ���.");
			f.img_height.focus();
			return false;
		}
	}
	return true;	
}

function fileup(formname, imagename){
	var url = "../file_upload.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}
</script>

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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>��ʰ���</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" bgcolor="#FFFFFF"><strong>[��� ���]</strong><br>
				  <font color="#0000FF">���� ��ʷ� �̹����� ����� 
				  ������ �÷������Ϸ� ����� ������ �����Ͻ� ��, �ش��ϴ� �ʵ忡 
				  �Է��ϼ���.<br>
				  <br>
				  ����� ������� ������ ���ø��� �°� �����ڰ� ���� �Է��Ͻ� �� �ֽ��ϴ�.
		����, ��ʻ���� �Է����� �����ø� ���� ��ʴ� ���� 131px, ���� ��ʴ� ���� 165px��
		�ڵ�����˴ϴ�.
						<br>
				  �ϴܿ� ���� ��ʴ� ���� �����ϴ�.(��, 750�ȼ��� ���� �� �����ϴ�)<br>
				  ���� ���α��̴� ������ �����ϹǷ� ���Ͻô� ũ���� �����Ͻø� 
				  �˴ϴ�.</font>
				  </td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
		<form method="post" name="frm" onsubmit="return checkform(this)">
		<input type="hidden" name="flag" value="write">
		<input type="hidden" name="updateflag" value>
				  <table border="0" width="95%">
					 <tr>
						<td width="90%" bgcolor="#999999"><table border="0" width="100%" cellspacing="1" cellpadding="3">
						  <tr>
							 <td width="100%" bgcolor="#8FBECD" colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="50%">&nbsp; <strong>��� ����ϱ�</strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">�����ġ</td>
							 <td width="43%" bgcolor="#FFFFFF" align="left"><select name="banner_pos" size="1" style="height: 18px; border: 1px solid black">
								<option value="right">������</option>
								<option value="left">����</option>
								<option value="bottom">�ϴ�</option>
							 </select> </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">
							 <input name="if_flash" type="radio" value="0" checked>�̹���</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="img" size="60" class="input_03" readonly> 
							 <input name="imageup" onclick="javascript:fileup('frm','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�"> 
							 <br>
							 <br>
							 ���α���&nbsp;&nbsp; 
							 <input name="img_width" value='<?echo $img_width?>' class="input_03" size="4"> &nbsp;&nbsp;&nbsp; ���α���&nbsp;&nbsp; 
							 <input name="img_height" value='<?echo $img_height?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff">���ø����� ����, ������ ���̰� �ٸ��Ƿ� ������ 
							 ���ø��� �°� ����� �Է��ϼ���.</font>
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">��ũ�� �ּ�</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="link" size="60" class="input_03">
							 <br>
							 <font color="#0000ff">��ũ�ϰ��� �Ͻø� ��ũ�ּҸ� http:// ���� �Է��Ͻð�, 
							 <br>
							 ��ũ�� ������ �����ø� �Է����� ���ʽÿ�.
										<br> 
										��ǰ�� ��ũ�ϰ��� �ϽǶ��� ��Ÿ������ �ϴ� ��ǰ�� ��ũ�ּҴ�
										<br> 
										"����������>��ũURL�ȳ�"�� Ŭ���Ͻð� 
										<br>�ش��ǰ�� ��ũ�� �����Ͽ� �����Ͻø� �˴ϴ�.</font> 

							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">��â/����â ����</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_newwin" type="radio" value="t" checked>��â 
							 <input name="if_newwin" type="radio" value="f">����â</td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">����������/��ü������ ����</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_inwin" type="radio" value="0" checked>���������� 
							 <input name="if_inwin" type="radio" value="1">��ü������
							 <font color="#0000ff"><br>
							 ����â ������ ���� ��ȿ�մϴ�.</font></td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">
							 <input name="if_flash" type="radio" value="1">�÷���</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="flash_image" size="60" class="input_03" readonly> 
							 <input name="imageup" onclick="javascript:fileup('frm','flash_image');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�"><br>
							 <br>
							  ���α���&nbsp;&nbsp;
							 <input name="flash_width" class="input_03" size="4">
							 &nbsp;&nbsp;&nbsp; ���α���&nbsp;&nbsp;
							 <input name="flash_height" class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff"><br>
							 �÷����� �ø���� ����� �Է��ϼ���.</font></td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="���"> 
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�"> 
					  <input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ">
					  </td>
				</tr>
</form>

<form method="post" name="frm1" onsubmit="return checkform1(this)">
<input type="hidden" name="flag" value="write">
<input type="hidden" name="updateflag" value>
<input type="hidden" name="banner_pos" value="scrol">
				<tr align="center">
				  <td width="100%" bgcolor="#FFFFFF" align="left"><strong>&nbsp;&nbsp; [�̵���ũ�� ��� ���]</strong><br>
						<font color="#0000FF">&nbsp;&nbsp; �̵���ũ�ѹ�ʴ� 
						���θ�ùȭ�� �����ʿ� ��ġ�ϸ�, �������� ��ũ�ѵɶ� �Բ� ����ٴϴ� <br>
						&nbsp;&nbsp; ����Դϴ�. <br>
						&nbsp;&nbsp; ���� ��ʷ� �̹����� ����� ������ �÷������Ϸ� 
						����� ������ �����Ͻ� ��, �ش��ϴ� �ʵ忡 �Է��ϼ���.<br>
						<br>
						&nbsp;&nbsp;��� �̹������ε� �� ���ο� ���α��̸� �� �Է��ϼ���.</font><br>
						<br>
						<font color="#0000FF">&nbsp; * �÷����� �۾��ϽǶ��� �ݵ�� 
						�ش縵ũ�� Ÿ���� �����ϼż� ���ε��ϼž� �մϴ�.<br>
						&nbsp; ��ũ�ϰ��� �Ͻø� ��ũ�ּҸ� http:// ���� �Է��Ͻð�, ��ũ�� ������ �����ø� �Է����� ���ʽÿ�.<br>
						&nbsp; ��ǰ�� ��ũ�ϰ��� �ϽǶ��� ��Ÿ������ �ϴ� ��ǰ�� ��ũ�ּҴ� <br>
						&nbsp; "����������>��ũURL�ȳ�"�� Ŭ���Ͻð� �ش��ǰ�� ��ũ�� �����Ͽ� �����Ͻø� �˴ϴ�.<br></font>
				  </td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" valign="top"><div align="center"><center><table
				  border="0" width="95%">
					 <tr>
						<td width="90%" bgcolor="#999999"><table border="0" width="100%" cellspacing="1"
						cellpadding="3">
						  <tr>
							 <td width="100%" bgcolor="#8FBECD" colspan="2"><table border="0" width="100%"
							 cellspacing="0" cellpadding="0">
								<tr>
								  <td width="50%">&nbsp; <strong>��� ����ϱ�</strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">
							 <input name="if_flash" type="radio" value="0" checked>�̹���</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="img" size="60" class="input_03" readonly> 
							 <input name="imageup" onclick="javascript:fileup('frm1','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�"> 
							 <br>
							 <br>
							 ���α���&nbsp;&nbsp; 
							 <input name="img_width" value='<?echo $img_width?>' class="input_03" size="4"> &nbsp;&nbsp;&nbsp; ���α���&nbsp;&nbsp; 
							 <input name="img_height" value='<?echo $img_height?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff">���α��̿� ���α��̸� �� �Է����ּ���.</font>
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">��ũ�� �ּ�</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left"><input name="link" size="60" class="input_03"> 
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">��â/����â ����</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_newwin" type="radio" value="t" checked>��â 
							 <input name="if_newwin" type="radio" value="f">����â</td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">����������/��ü������ ����</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_inwin" type="radio" value="0" checked>���������� 
							 <input name="if_inwin" type="radio" value="1">��ü������
							 <font color="#0000ff"><br>
							 ����â ������ ���� ��ȿ�մϴ�.</font></td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left" rowspan="2">
							 <input name="if_flash" type="radio" value="1">�÷���</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="flash_image" size="60" class="input_03" readonly> 
							 <input name="imageup" onclick="javascript:fileup('frm1','flash_image');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�"></td>
						  </tr>
						  <tr>
							 <td width="44%" bgcolor="#FFFFFF" align="left">���α���&nbsp;&nbsp;
							 <input name="flash_width" class="input_03" size="4">&nbsp;&nbsp;&nbsp; 
							 ���α���&nbsp;&nbsp;
							 <input name="flash_height" class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff"><br>
							 �÷����� �ø���� ����� �Է��ϼ���.</font></td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="���"> 
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�"> 
					  <input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ"> </td>
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
elseif ($flag == "write") {
	
	$SQL = "select max(banner_no), count(*) from $BannerTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0) 
		$maxBanner_no = mysql_result($dbresult, 0, 0);
	else
		$maxBanner_no = 0;
	
	$SQL = "select max(banner_order), count(*) from $BannerTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0) 
		$maxBanner_order = mysql_result($dbresult, 0, 0);
	else
		$maxBanner_order = 0;
	/*	
	if($banner_pos == 'scrol'){
		$SQL = "select * from $BannerTable where banner_pos = 'scrol' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			echo ("
			<script>
			alert(\"��ũ�� ��ʴ� �Ѱ��� ����� �� �ֽ��ϴ�.\");
			history.go(-1);
			</script>
			");
			exit;
		}
	}
	*/
	if (isset($img)&&($img != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$maxBanner_no_1 = $maxBanner_no+1;
		$img_new = "banner_".$maxBanner_no_1."_".$img;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img"))
			copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//���ε� ���� ����
	}
	if (isset($flash_image)&&($flash_image != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$maxBanner_no_1 = $maxBanner_no+1;
		$flash_image_new = "banner_flash_".$maxBanner_no_1."_".$flash_image;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$flash_image"))
			copy ("$Co_img_UP$mart_id/$flash_image","$Co_img_UP$mart_id/$flash_image_new" );	//���ε� ���� ����
	}
	$date = date("Ymd");
	$SQL = "insert into $BannerTable (banner_no, mart_id, info, banner_pos, img, img_width, img_height, link, date, 
	if_newwin, if_flash, flash_image, flash_width, flash_height, if_inwin, banner_order) 
	values ($maxBanner_no+1, '$mart_id', '$info', '$banner_pos', '$img_new', '$img_width', '$img_height', '$link', 
	'$date', '$if_newwin','$if_flash', '$flash_image_new', '$flash_width', '$flash_height', '$if_inwin',$maxBanner_order+1)";
	
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=banner_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>