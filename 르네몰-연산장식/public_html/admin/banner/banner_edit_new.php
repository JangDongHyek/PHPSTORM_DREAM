<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
?>
<?
	include "../admin_head.php";
?>
<script>
function checkform(f){
	if (f.if_flash[0].checked == true){
		if (f.img.value=="") {
			alert("�̹����� �����ϼ���");
			f.imageup.focus();
			return false;
		}
	}
	if (f.if_flash[1].checked == true){
		if (f.flash_image.value=="") {
			alert("�÷��ø� �����ϼ���");
			f.imageup1.focus();
			return false;
		}
	}
	return true;
}

function fileup(formname, imagename){
	var url = "./file_upload.php?formname="+formname+"&imagename="+imagename
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
			<td width="90%" bgcolor="#FFFFFF" height="35"><strong>[��� ����]</strong>
				<font color="#0000FF">
				����� ������� ������ ���ø��� �°� �����ڰ� ���� �Է��Ͻ� �� �ֽ��ϴ�.
����, ��ʻ���� �Է����� �����ø� ���� ��ʴ� ���� 131px, ���� ��ʴ� ���� 165px��
�ڵ�����˴ϴ�.<br>
				�ϴܿ� ���� ��ʴ� ���� �����ϴ�.(��, 750�ȼ��� ���� �� �����ϴ�)<br>
				���� ���α��̴� ������ �����ϹǷ� ���Ͻô� ũ���� �����Ͻø� 
				�˴ϴ�. </font>
			</td>

<?
	$SQL = "select * from $BannerTable where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$img = mysql_result($dbresult, 0, "img");
	$banner_pos = mysql_result($dbresult, 0, "banner_pos");
	$link = mysql_result($dbresult, 0, "link");
	$if_newwin = mysql_result($dbresult, 0, "if_newwin");
	$if_flash = mysql_result($dbresult, 0, "if_flash");
	$flash_image = mysql_result($dbresult, 0, "flash_image");
	$flash_width = mysql_result($dbresult, 0, "flash_width");
	$flash_height = mysql_result($dbresult, 0, "flash_height");
	$img_width = mysql_result($dbresult, 0, "img_width");
	$img_height = mysql_result($dbresult, 0, "img_height");
	$if_inwin = mysql_result($dbresult, 0, "if_inwin");
?>
			
<form method="post" name="frm"  onsubmit="return checkform(this)">
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='img_updateflag' value=''>
<input type='hidden' name='flash_image_updateflag' value=''>
<input type='hidden' name='img_old' value='<?echo $img?>'>
<input type='hidden' name='flash_image_old' value='<?echo $flash_image?>'>
				
				<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				
				<table border="0" width="95%">
					<tr>
						<td width="90%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="100%" bgcolor="#8FBECD" colspan="2">
								
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
										<td width="50%">&nbsp; <strong>��� �����ϱ�</strong></td>
										<td width="50%"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									��ġ�� ����</td>
								<td width="43%" bgcolor="#FFFFFF" align="left">
									<select name="banner_pos" size="1" style="height: 18px; border: 1px solid black">
										<option value="right"
										<?
										if($banner_pos == 'right') echo " selected";
										?>
										>������</option>
										<option value="left"
										<?
										if($banner_pos == 'left') echo " selected";
										?>
										>����</option>
										<option value="bottom"
										<?
										if($banner_pos == 'bottom') echo " selected";
										?>
										>�ϴ�</option>
										<option value="scrol"
										<?
										if($banner_pos == 'scrol') echo " selected";
										?>
										>��ũ��</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">�����̹���</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
<?
	if( $img ){
?>
								<img src='<?=$Co_img_DOWN?><?=$Mall_Admin_ID?>/<?=$img?>' width='<?=$img_width?>' height='<?=$img_height?>' border='0'>
<?
	}
?>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">�ٲ��̹���</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									<input name="img" size="60" value='<?echo $img?>' class="input_03" readonly> 
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
								<td width="10%" bgcolor="#C8DFEC" align="left">
									��ũ�� �ּ�</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="link" size="60" value='<?echo $link?>' class="input_03">
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
								<td width="10%" bgcolor="#C8DFEC" align="left">
									��â/����â ����</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="if_newwin" type="radio" value="t"<?if($if_newwin=='t') echo " checked"?>>��â
									<input name="if_newwin" type="radio" value="f"<?if($if_newwin=='f') echo " checked"?>>����â
									
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									����������/��ü������ ����</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="if_inwin" type="radio" value="0"<?if($if_inwin==0) echo " checked"?>>����������
									<input name="if_inwin" type="radio" value="1"<?if($if_inwin==1) echo " checked"?>>��ü������
									<font color="#0000ff"><br>
									����â ������ ���� ��ȿ�մϴ�.</font>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									�̹���/�÷��� ����</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="if_flash" type="radio" value="0"<?if($if_flash == 0) echo " checked"?>>�̹���
									<input name="if_flash" type="radio" value="1"<?if($if_flash == 1) echo " checked"?>>�÷���
									
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">�����÷���</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									<?
									if($flash_image !=""){
										echo ("
									<embed src='$Co_img_DOWN$mart_id/$flash_image'></embed>
										");
									}
									?>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">�ٲ��÷���</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									<input name="flash_image" size="60" value='<?echo $flash_image?>'class="input_03" readonly> 
									<input name="imageup1" onclick="javascript:fileup('frm','flash_image');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�"> </td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">�÷��� ũ��</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
								���α���&nbsp;&nbsp;
								<input name="flash_width" value='<?echo $flash_width?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; 
								���α���&nbsp;&nbsp;
								<input name="flash_height" value='<?echo $flash_height?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>
				</center></div>
			</td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" align="center" height="30">
				<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="����"> 
				<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�"> 
				<input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ">
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
	/*
	if($banner_pos == 'scrol'){
		$SQL = "select * from $BannerTable where banner_pos = 'scrol' and banner_no!=$banner_no and mart_id='$mart_id'";
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
	if($img_old != "" && $img == ""){
		if(file_exists("$Co_img_UP$mart_id/$img"))
			unlink("$Co_img_UP$mart_id/$img");
	}
	if($flash_image_old != "" && $flash_image == ""){
		if(file_exists("$Co_img_UP$mart_id/$flash_image"))
			unlink("$Co_img_UP$mart_id/$flash_image");
	}
	
	if (isset($img)&&($img != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img_old"))
					unlink("$Co_img_UP$mart_id/$img_old");	
			}
			$img_new = "banner_".$banner_no."_".$img;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img"))
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//���ε� ���� ����
		}
		else{
			$img_new = $img;
		}
	}
	if (isset($flash_image)&&($flash_image != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($flash_image_updateflag=="ok"){
			if($flash_image_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$flash_image_old"))
					unlink("$Co_img_UP$mart_id/$flash_image_old");	
			}
			$flash_image_new = "banner_flash_".$banner_no."_".$flash_image;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$flash_image"))
				copy ("$Co_img_UP$mart_id/$flash_image","$Co_img_UP$mart_id/$flash_image_new" );	//���ε� ���� ����
		}
		else{
			$flash_image_new = $flash_image;
		}
	}
	
	$fromdate = $y.$m.$d;
	$todate = $y1.$m1.$d1;	
	$SQL = "update $BannerTable set banner_pos = '$banner_pos', img = '$img_new', img_width='$img_width', ".
	"img_height='$img_height', link = '$link', ".
	"if_newwin = '$if_newwin', if_flash = '$if_flash', flash_image = '$flash_image_new', flash_width = '$flash_width', ".
	"flash_height = '$flash_height', if_inwin='$if_inwin' where banner_no = $banner_no and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=banner_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>