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
		alert("이미지를 선택하세요");
		//f.imageup.focus();
		return false;
	}
	/*
	if (f.link.value=="") {
		alert("링크할곳을 입력하세요");
		f.link.focus();
		return false;
	}
	*/
	return true;	
}
function checkform1(f){
	if(f.if_flash[0].checked){
		if (f.img.value=='') {
			alert("이미지를 선택하세요");
			//f.imageup.focus();
			return false;
		}
		if (f.img_width.value=='') {
			alert("가로길이를 입력하세요.");
			f.img_width.focus();
			return false;
		}
		if (f.img_height.value=='') {
			alert("세로길이를 입력하세요.");
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
				  <td width="90%" bgcolor="#FFFFFF"><strong>[배너 등록]</strong><br>
				  <font color="#0000FF">먼저 배너로 이미지로 등록할 
				  것인지 플래쉬파일로 등록할 것인지 선택하신 후, 해당하는 필드에 
				  입력하세요.<br>
				  <br>
				  배너의 사이즈는 각각의 템플릿에 맞게 관리자가 직접 입력하실 수 있습니다.
		만약, 배너사이즈를 입력하지 않으시면 좌측 배너는 가로 131px, 우측 배너는 가로 165px로
		자동저장됩니다.
						<br>
				  하단에 오는 배너는 제한 없습니다.(단, 750픽셀을 넘을 수 없습니다)<br>
				  또한 세로길이는 조절이 가능하므로 원하시는 크기대로 제작하시면 
				  됩니다.</font>
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
								  <td width="50%">&nbsp; <strong>배너 등록하기</strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">배너위치</td>
							 <td width="43%" bgcolor="#FFFFFF" align="left"><select name="banner_pos" size="1" style="height: 18px; border: 1px solid black">
								<option value="right">오른편</option>
								<option value="left">왼편</option>
								<option value="bottom">하단</option>
							 </select> </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">
							 <input name="if_flash" type="radio" value="0" checked>이미지</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="img" size="60" class="input_03" readonly> 
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
							 <td width="10%" bgcolor="#C8DFEC" align="left">링크될 주소</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="link" size="60" class="input_03">
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
							 <td width="10%" bgcolor="#C8DFEC" align="left">새창/현재창 선택</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_newwin" type="radio" value="t" checked>새창 
							 <input name="if_newwin" type="radio" value="f">현재창</td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">내부프레임/전체프레임 선택</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_inwin" type="radio" value="0" checked>내부프레임 
							 <input name="if_inwin" type="radio" value="1">전체프레임
							 <font color="#0000ff"><br>
							 현재창 선택일 때만 유효합니다.</font></td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">
							 <input name="if_flash" type="radio" value="1">플래쉬</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="flash_image" size="60" class="input_03" readonly> 
							 <input name="imageup" onclick="javascript:fileup('frm','flash_image');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드"><br>
							 <br>
							  가로길이&nbsp;&nbsp;
							 <input name="flash_width" class="input_03" size="4">
							 &nbsp;&nbsp;&nbsp; 세로길이&nbsp;&nbsp;
							 <input name="flash_height" class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff"><br>
							 플래쉬를 올릴경우 사이즈를 입력하세요.</font></td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="등록"> 
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
					  <input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">
					  </td>
				</tr>
</form>

<form method="post" name="frm1" onsubmit="return checkform1(this)">
<input type="hidden" name="flag" value="write">
<input type="hidden" name="updateflag" value>
<input type="hidden" name="banner_pos" value="scrol">
				<tr align="center">
				  <td width="100%" bgcolor="#FFFFFF" align="left"><strong>&nbsp;&nbsp; [이동스크롤 배너 등록]</strong><br>
						<font color="#0000FF">&nbsp;&nbsp; 이동스크롤배너는 
						쇼핑몰첫화면 오른쪽에 위치하며, 페이지가 스크롤될때 함께 따라다니는 <br>
						&nbsp;&nbsp; 배너입니다. <br>
						&nbsp;&nbsp; 먼저 배너로 이미지로 등록할 것인지 플래쉬파일로 
						등록할 것인지 선택하신 후, 해당하는 필드에 입력하세요.<br>
						<br>
						&nbsp;&nbsp;배너 이미지업로드 시 가로와 세로길이를 꼭 입력하세요.</font><br>
						<br>
						<font color="#0000FF">&nbsp; * 플래쉬로 작업하실때는 반드시 
						해당링크와 타겟을 지정하셔서 업로드하셔야 합니다.<br>
						&nbsp; 링크하고자 하시면 링크주소를 http:// 부터 입력하시고, 링크를 원하지 않으시면 입력하지 마십시오.<br>
						&nbsp; 상품을 링크하고자 하실때는 나타내고자 하는 상품의 링크주소는 <br>
						&nbsp; "셀프디자인>링크URL안내"를 클릭하시고 해당상품의 링크를 선택하여 복사하시면 됩니다.<br></font>
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
								  <td width="50%">&nbsp; <strong>배너 등록하기</strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">
							 <input name="if_flash" type="radio" value="0" checked>이미지</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="img" size="60" class="input_03" readonly> 
							 <input name="imageup" onclick="javascript:fileup('frm1','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드"> 
							 <br>
							 <br>
							 가로길이&nbsp;&nbsp; 
							 <input name="img_width" value='<?echo $img_width?>' class="input_03" size="4"> &nbsp;&nbsp;&nbsp; 세로길이&nbsp;&nbsp; 
							 <input name="img_height" value='<?echo $img_height?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff">가로길이와 세로길이를 꼭 입력해주세요.</font>
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">링크될 주소</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left"><input name="link" size="60" class="input_03"> 
							 </td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">새창/현재창 선택</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_newwin" type="radio" value="t" checked>새창 
							 <input name="if_newwin" type="radio" value="f">현재창</td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left">내부프레임/전체프레임 선택</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="if_inwin" type="radio" value="0" checked>내부프레임 
							 <input name="if_inwin" type="radio" value="1">전체프레임
							 <font color="#0000ff"><br>
							 현재창 선택일 때만 유효합니다.</font></td>
						  </tr>
						  <tr>
							 <td width="10%" bgcolor="#C8DFEC" align="left" rowspan="2">
							 <input name="if_flash" type="radio" value="1">플래쉬</td>
							 <td width="44%" bgcolor="#FFFFFF" align="left">
							 <input name="flash_image" size="60" class="input_03" readonly> 
							 <input name="imageup" onclick="javascript:fileup('frm1','flash_image');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드"></td>
						  </tr>
						  <tr>
							 <td width="44%" bgcolor="#FFFFFF" align="left">가로길이&nbsp;&nbsp;
							 <input name="flash_width" class="input_03" size="4">&nbsp;&nbsp;&nbsp; 
							 세로길이&nbsp;&nbsp;
							 <input name="flash_height" class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff"><br>
							 플래쉬를 올릴경우 사이즈를 입력하세요.</font></td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="등록"> 
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
					  <input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트"> </td>
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
elseif ($flag == "write") {
	
	$SQL = "select max(banner_no), count(*) from $BannerTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0) 
		$maxBanner_no = mysql_result($dbresult, 0, 0);
	else
		$maxBanner_no = 0;
	
	$SQL = "select max(banner_order), count(*) from $BannerTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
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
			alert(\"스크롤 배너는 한개만 등록할 수 있습니다.\");
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
			copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
	}
	if (isset($flash_image)&&($flash_image != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$maxBanner_no_1 = $maxBanner_no+1;
		$flash_image_new = "banner_flash_".$maxBanner_no_1."_".$flash_image;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$flash_image"))
			copy ("$Co_img_UP$mart_id/$flash_image","$Co_img_UP$mart_id/$flash_image_new" );	//업로드 파일 저장
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