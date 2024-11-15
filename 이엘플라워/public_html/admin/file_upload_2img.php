<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='login.html';
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
<script language="javascript" src="js/common.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!--
	function viewImage(file)
	{
		img = document.getElementById("upImage");
		img.src = file.value;
		img.style.display = "inline";
	}
//-->
</SCRIPT>
</head>

<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
<center>
<form method="POST" enctype="multipart/form-data">
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='formname' value='<?=$formname?>'>
<input type='hidden' name='imagename' value='<?=$imagename?>'>

<table width="100%" border="5" cellspacing="3" cellpadding="3" height="100%" bgcolor="#DBE6ED" bordercolor="white">
	<tr>
		<td align="center">파일 : <input type="File" name="attach" style="BACKGROUND-COLOR: #93BAD3; BORDER-BOTTOM: #93BAD3 1px solid; BORDER-LEFT: #93BAD3 1px solid; BORDER-RIGHT: #93BAD3 1px solid; BORDER-TOP: #93BAD3 1px solid; COLOR: white; HEIGHT: 18px" onChange="viewImage(this);"></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left"><?=$title?> : <img src="" id="upImage" width=50 height=50 border=0 style="display:none;" align="absmiddle"></td>
					<td align="right"><input type="submit" style="BACKGROUND-COLOR: #93BAD3; BORDER-BOTTOM: #93BAD3 1px solid; BORDER-LEFT: #93BAD3 1px solid; BORDER-RIGHT: #93BAD3 1px solid; BORDER-TOP: #93BAD3 1px solid; COLOR: white; HEIGHT: 18px" value=" UpLoad"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</center>
</body>
</html>
<?
}
elseif ($flag == "update") {
	if ($imagename == 'img_high'){//고화질이미지
		if (strstr(substr($attach_name,-4),'.jpg') || strstr(substr($attach_name,-4),'.gif') || strstr(substr($attach_name,-4),'.GIF') || strstr(substr($attach_name,-4),'.JPG')){
			// 차후 사용?
		}else{
			echo "
			<script>
			alert(\"이미지 화일이 아닙니다.\\n업로드 형식은 jpg,gif입니다.\")
			this.close();
			</script>
			";
			exit;
		}
	
	}else{
		if (strstr(substr($attach_name,-4),'.jpg') || strstr(substr($attach_name,-4),'.gif')||strstr(substr($attach_name,-4),'.swf')||strstr(substr($attach_name,-4),'.JPG') || strstr(substr($attach_name,-4),'.GIF')||strstr(substr($attach_name,-4),'.SWF')){
			// 차후 사용?
		}else{
			echo "
			<script>
			alert(\"이미지 화일이 아닙니다.\\n업로드 형식은 jpg,gif,swf입니다.\")
			this.close();
			</script>
			";
			exit;
		}
	}

	if (isset($attach_name)&&($attach_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$size = filesize($attach);
		
		if($imagename == 'img_sml' && $size > 1000000){
			echo ("
		<script language='javascript'>
			alert(\"메인/리스트 이미지의 크기는 1000K를 넘을 수 없습니다.\");
			this.close();
		</script>
			");
			exit;
		}

		if($imagename == 'img' && $size > 1000000){
			echo ("
		<script language='javascript'>
			alert(\"상세설명 이미지의 크기는 1000K를 넘을 수 없습니다.\");
			this.close();
		</script>
			");
			exit;
		}
		
		if($imagename == 'img_big' && $size > 1000000){
			echo ("
		<script language='javascript'>
			alert(\"확대이미지 이미지의 크기는 1000K를 넘을 수 없습니다.\");
			this.close();
		</script>
			");
			exit;
			
		}

		if($imagename == 'img_high' && $size > 1000000){
			echo ("
		<script language='javascript'>
			alert(\"고화질이미지 이미지의 크기는 1000K를 넘을 수 없습니다.\");
			this.close();
		</script>
			");
			exit;
			
		}
		
		//================== 업로드 파일을 불러옴 ================================================
		include "../upload.php";
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

		//copy ($attach, "$Co_img_UP$mart_id/$attach_name");	//업로드 파일 저장
	}

	$updateflag = $imagename."_updateflag";

	echo ("
	<script language='javascript'>
		op = window.opener;

		if(String(op.document.view_$imagename) != \"undefined\")
			op.document.view_$imagename.src = '$home_dir/co_img/$mart_id/$attach_name';
		op.$formname.$imagename.value= \"$attach_name\";
		op.$formname.$updateflag.value= \"ok\";
		op.$formname.$updateflag.value= \"ok\";
		this.close();
	</script>
	");
}
?>	
<?
mysql_close($dbconn);
?>