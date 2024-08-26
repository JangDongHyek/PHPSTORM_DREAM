<? 
include("../globalInc_mysql.php");

if ($flag == "") {
?>
<html>
<head>
	<title>File Upload</title>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
<center>
<form method="POST" enctype="multipart/form-data">
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='formname' value='<?echo $formname?>'>
<input type='hidden' name='imagename' value='<?echo $imagename?>'>

<table width="100%" border="5" cellspacing="3" cellpadding="3" height="100%" bgcolor="#DBE6ED" bordercolor="white">
	<tr>
		<td align="center">File : <input type="File" name="attach" style="BACKGROUND-COLOR: #93BAD3; BORDER-BOTTOM: #93BAD3 1px solid; BORDER-LEFT: #93BAD3 1px solid; BORDER-RIGHT: #93BAD3 1px solid; BORDER-TOP: #93BAD3 1px solid; COLOR: white; HEIGHT: 18px"></td>
	</tr>
	<tr>
		<td><div align="right"><input type="submit" style="BACKGROUND-COLOR: #93BAD3; BORDER-BOTTOM: #93BAD3 1px solid; BORDER-LEFT: #93BAD3 1px solid; BORDER-RIGHT: #93BAD3 1px solid; BORDER-TOP: #93BAD3 1px solid; COLOR: white; HEIGHT: 18px" value=" UpLoad"></div></td>
	</tr>
</table>
</form>
</center>
</body>
</html>
<?
}
elseif ($flag == "update") {
	
	if (strstr(substr($attach_name,-4),'.jpg') || strstr(substr($attach_name,-4),'.gif')||strstr(substr($attach_name,-4),'.swf')||strstr(substr($attach_name,-4),'.JPG') || strstr(substr($attach_name,-4),'.GIF')||strstr(substr($attach_name,-4),'.SWF')){
		// 차후 사용?
	}
	else{
	echo "
		<script>
		alert(\"이미지 화일이 아닙니다.\\n업로드 형식은 jpg,gif,swf입니다.\")
		this.close();
		</script>
		";
		exit;
	}
	if (isset($attach_name)&&($attach_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		copy ($attach, "$Co_img_UP$mart_id/$attach_name");	//업로드 파일 저장
	}
	echo ("
	<script language='javascript'>
		op = window.opener;
		op.$formname.$imagename.value= \"$attach_name\";
		op.$formname.updateflag.value= \"ok\";
		this.close();
	</script>
	");
}
?>	
