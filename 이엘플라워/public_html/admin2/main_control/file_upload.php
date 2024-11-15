<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if ($flag == "") {
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
<form method="POST" enctype="multipart/form-data">
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='formname' value='<?echo $formname?>'>
<input type='hidden' name='imagename' value='<?echo $imagename?>'>

<table width="100%" border="5" cellspacing="3" cellpadding="3" height="100%" bgcolor="#DBE6ED" bordercolor="white" align='center'>
	<tr>
		<td align="center">File : <input type="File" name="attach" style="BACKGROUND-COLOR: #93BAD3; BORDER-BOTTOM: #93BAD3 1px solid; BORDER-LEFT: #93BAD3 1px solid; BORDER-RIGHT: #93BAD3 1px solid; BORDER-TOP: #93BAD3 1px solid; COLOR: white; HEIGHT: 18px"></td>
	</tr>
	<tr>
		<td><div align="right"><input type="submit" style="BACKGROUND-COLOR: #93BAD3; BORDER-BOTTOM: #93BAD3 1px solid; BORDER-LEFT: #93BAD3 1px solid; BORDER-RIGHT: #93BAD3 1px solid; BORDER-TOP: #93BAD3 1px solid; COLOR: white; HEIGHT: 18px" value=" UpLoad"></div></td>
	</tr>
</table>
</form>
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

	//================== 업로드 파일을 불러옴 ================================================
	include "../../upload.php";
	$upload = "$Co_img_UP"."$mart_id/";
	//================== 첨부 파일을 업로드함 ================================================
	if( $attach_name ){
		$file = FileUploadName( "", "$upload", $attach, $attach_name );//파일을 업로드 함

		if( !$file ){
			echo("
				<script>
				window.alert('파일 업로드에 실패했습니다.');
				history.go(-1)
				</script>
			");
			exit;
		}
	}

	$updateflag = $imagename."_updateflag";
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
<?
mysql_close($dbconn);
?>