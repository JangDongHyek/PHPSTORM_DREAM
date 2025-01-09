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
			alert("이미지를 선택하세요");
			f.imageup.focus();
			return false;
		}
	}
	if (f.if_flash[1].checked == true){
		if (f.flash_image.value=="") {
			alert("플래시를 선택하세요");
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
			<!--왼쪽부분시작-->
<?
$left_menu = "10";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>관리자 지정상품 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="90%" bgcolor="#FFFFFF" height="35"><strong>[타이틀 이미지 수정]</strong>
				<font color="#0000FF">
				배너의 사이즈는 각각의 템플릿에 맞게 관리자가 직접 입력하실 수 있습니다.
</font>
			</td>

<?
	$SQL = "select * from $AdminMainTable where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$mart_id = mysql_result($dbresult, 0, "mart_id");
	$img = mysql_result($dbresult, 0, "img");
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
										<td width="50%">&nbsp; <strong>타이틀 이미지 수정하기</strong></td>
										<td width="50%"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">현재이미지</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
<?
	if( $img ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img?>' width='<?=$img_width?>' height='<?=$img_height?>' border='0'>
<?
	}
?>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">바꿀이미지</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									<input name="img" size="60" value='<?echo $img?>' class="input_03" readonly> 
									<input name="imageup" onclick="javascript:fileup('frm','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
									<br>
									 <br>
									 가로길이&nbsp;&nbsp; 
									 <input name="img_width" value='<?echo $img_width?>' class="input_03" size="4"> &nbsp;&nbsp;&nbsp; 세로길이&nbsp;&nbsp; 
									 <input name="img_height" value='<?echo $img_height?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
									 <font color="#0000ff">관리자 지정상품 타이틀 이미지 가로넓이값은 최대700입니다.</font> 
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
				<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정"> 
				<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
				<input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">
			</td>
			</tr>
</form>
		</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
elseif ($flag == "update") {
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
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
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
				copy ("$Co_img_UP$mart_id/$flash_image","$Co_img_UP$mart_id/$flash_image_new" );	//업로드 파일 저장
		}
		else{
			$flash_image_new = $flash_image;
		}
	}
	
	$fromdate = $y.$m.$d;
	$todate = $y1.$m1.$d1;	

	if($img_width > 700){
		$img_width = "700";
	}
	$SQL = "update $AdminMainTable set img = '$img_new', img_width='$img_width', ".
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