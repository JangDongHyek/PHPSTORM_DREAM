<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $MartIntroTable where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	$ary = mysql_fetch_array($dbresult);
	$attach1 = $ary["attach1"];

	include "../admin_head.php";
?>

<body topmargin="0" leftmargin="0" bgcolor="#ffffff">

	<table border="1" cellpadding="3" cellspacing="0" width="99%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
<form method="POST" enctype="multipart/form-data">
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='whichform' value='<?=$whichform?>'>
<input type='hidden' name='attach1' value='<?=$attach1?>'>
	<tr>
		 <td width="100%"><?echo $comment1?><br>
		 <input type="File" name="attach" size="32" class="input_03"></td>
	</tr>
	<tr>
		 <td width="100%"><?echo $comment2?></td>
	</tr>
	<tr>
		 <td width="100%" align='right'><input type="submit" size="32" class="input_03" value="업로드"></td>
	</tr>
</form>
	</table>
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
	$upload = "$Co_img_UP"."$mart_id/intro_img/";
	echo $upload;
	//exit;
	//================== 첨부 파일을 업로드함 ================================================
	if( $attach_name ){
		$file = FileUploadName( "$attach1", "$upload", $attach, $attach_name );//파일을 업로드 함

		if($whichform == 1){
			$SQL = "update $MartIntroTable set attach = '$file' where mart_id='$mart_id'";
		}
		if($whichform == 2){
			$SQL = "update $MartIntroTable set attach1 = '$file' where mart_id='$mart_id'";
		}
		$dbresult = mysql_query($SQL, $dbconn); 

		if( !$dbresult ){
			echo("
				<script>
				window.alert('파일 업로드에 실패했습니다.');
				history.go(-1)
				</script>
			");
			exit;
		}
	}	
	
	echo ("
	<script language='javascript'>
	this.close();
	</script>
	");
}
?>	
<?
mysql_close($dbconn);
?>