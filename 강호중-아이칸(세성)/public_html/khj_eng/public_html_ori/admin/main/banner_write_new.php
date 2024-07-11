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
				  <td width="90%" bgcolor="#FFFFFF"><strong>[관리자 지정상품 타이틀 등록]</strong><br>
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
								  <td width="50%">&nbsp; <strong>관리자 지정상품 타이틀 등록하기</strong></td>
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
							 <input name="imageup" onclick="javascript:fileup('frm','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드"> 
							 <br>
							 <br>
							 가로길이&nbsp;&nbsp; 
							 <input name="img_width" value='700' class="input_03" size="4"> &nbsp;&nbsp;&nbsp; 세로길이&nbsp;&nbsp; 
							 <input name="img_height" value='<?echo $img_height?>' class="input_03" size="4">&nbsp;&nbsp;&nbsp; <br>
							 <font color="#0000ff">관리자 지정상품 타이틀 이미지 가로넓이값은 최대 700픽셀입니다.</font>
							 </td>
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

</body>
</html>
<?
}
elseif ($flag == "write") {
	
	$SQL = "select max(banner_no), count(*) from $AdminMainTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0) 
		$maxBanner_no = mysql_result($dbresult, 0, 0);
	else
		$maxBanner_no = 0;
	
	$SQL = "select max(banner_order), count(*) from $AdminMainTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0) 
		$maxBanner_order = mysql_result($dbresult, 0, 0);
	else
		$maxBanner_order = 0;

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
	if($img_width > 700){
		$img_width = "700";
	}
	$SQL = "insert into $AdminMainTable (banner_no, mart_id, info,  img, img_width, img_height, link, date, 
	if_newwin, if_flash, flash_image, flash_width, flash_height, if_inwin, banner_order) 
	values ($maxBanner_no+1, '$mart_id', '$info', '$img_new', '$img_width', '$img_height', '$link', 
	'$date', '$if_newwin','$if_flash', '$flash_image_new', '$flash_width', '$flash_height', '$if_inwin',$maxBanner_order+1)";
	
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=banner_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>