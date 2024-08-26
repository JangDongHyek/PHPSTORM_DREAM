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
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>배너관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="90%" bgcolor="#FFFFFF" height="35"><strong>[배너 수정]</strong>
				<font color="#0000FF">
				배너의 사이즈는 각각의 템플릿에 맞게 관리자가 직접 입력하실 수 있습니다.
만약, 배너사이즈를 입력하지 않으시면 좌측 배너는 가로 131px, 우측 배너는 가로 165px로
자동저장됩니다.<br>
				하단에 오는 배너는 제한 없습니다.(단, 750픽셀을 넘을 수 없습니다)<br>
				또한 세로길이는 조절이 가능하므로 원하시는 크기대로 제작하시면 
				됩니다. </font>
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
										<td width="50%">&nbsp; <strong>배너 수정하기</strong></td>
										<td width="50%"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									위치및 동작</td>
								<td width="43%" bgcolor="#FFFFFF" align="left">
									<select name="banner_pos" size="1" style="height: 18px; border: 1px solid black">
										<option value="right"
										<?
										if($banner_pos == 'right') echo " selected";
										?>
										>오른편</option>
										<option value="left"
										<?
										if($banner_pos == 'left') echo " selected";
										?>
										>왼편</option>
										<option value="bottom"
										<?
										if($banner_pos == 'bottom') echo " selected";
										?>
										>하단</option>
										<option value="scrol"
										<?
										if($banner_pos == 'scrol') echo " selected";
										?>
										>스크롤</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">현재이미지</td>
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
								<td width="10%" bgcolor="#C8DFEC" align="left">바꿀이미지</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									<input name="img" size="60" value='<?echo $img?>' class="input_03" readonly> 
									<input name="imageup" onclick="javascript:fileup('frm','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
									<br>
									 <br>
									 가로길이&nbsp;&nbsp; 
									 <input name="img_width" value='<?echo $img_width?>' class="input_03" size="4"> &nbsp;&nbsp;&nbsp; 세로길이&nbsp;&nbsp; 
									 <input name="img_height" value='<?echo $img_height?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
									 <font color="#0000ff">템플릿별로 좌측, 우측의 길이가 다르므로 각각의 
									 템플릿에 맞게 사이즈를 입력하세요.</font> 
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									링크될 주소</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="link" size="60" value='<?echo $link?>' class="input_03">
									<br>
					 <font color="#0000ff">링크하고자 하시면 링크주소를 http:// 부터 입력하시고, 
					 <br>
					 링크를 원하지 않으시면 입력하지 마십시오.
								<br> 
								상품을 링크하고자 하실때는 나타내고자 하는 상품의 링크주소는
								<br> 
								"셀프디자인>링크URL안내"를 클릭하시고 
								<br>해당상품의 링크를 선택하여 복사하시면 됩니다.</font> 
								</td>
							</tr>
								<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									새창/현재창 선택</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="if_newwin" type="radio" value="t"<?if($if_newwin=='t') echo " checked"?>>새창
									<input name="if_newwin" type="radio" value="f"<?if($if_newwin=='f') echo " checked"?>>현재창
									
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									내부프레임/전체프레임 선택</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="if_inwin" type="radio" value="0"<?if($if_inwin==0) echo " checked"?>>내부프레임
									<input name="if_inwin" type="radio" value="1"<?if($if_inwin==1) echo " checked"?>>전체프레임
									<font color="#0000ff"><br>
									현재창 선택일 때만 유효합니다.</font>
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">
									이미지/플래시 선택</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									
									<input name="if_flash" type="radio" value="0"<?if($if_flash == 0) echo " checked"?>>이미지
									<input name="if_flash" type="radio" value="1"<?if($if_flash == 1) echo " checked"?>>플래시
									
								</td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">현재플래시</td>
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
								<td width="10%" bgcolor="#C8DFEC" align="left">바꿀플래시</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
									<input name="flash_image" size="60" value='<?echo $flash_image?>'class="input_03" readonly> 
									<input name="imageup1" onclick="javascript:fileup('frm','flash_image');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드"> </td>
							</tr>
							<tr>
								<td width="10%" bgcolor="#C8DFEC" align="left">플래시 크기</td>
								<td width="44%" bgcolor="#FFFFFF" align="left">
								가로길이&nbsp;&nbsp;
								<input name="flash_width" value='<?echo $flash_width?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; 
								세로길이&nbsp;&nbsp;
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
	/*
	if($banner_pos == 'scrol'){
		$SQL = "select * from $BannerTable where banner_pos = 'scrol' and banner_no!=$banner_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			echo ("
			<script>
			alert(\"스크롤 배너는 한개만 등록할 수 있습니다.\");
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