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
		 <td width="100%" align='right'><input type="submit" size="32" class="input_03" value="���ε�"></td>
	</tr>
</form>
	</table>
</body>
</html>
<?
}
elseif ($flag == "update") {
	if (strstr(substr($attach_name,-4),'.jpg') || strstr(substr($attach_name,-4),'.gif')||strstr(substr($attach_name,-4),'.swf')||strstr(substr($attach_name,-4),'.JPG') || strstr(substr($attach_name,-4),'.GIF')||strstr(substr($attach_name,-4),'.SWF')){
		// ���� ���?
	}
	else{
	echo "
		<script>
		alert(\"�̹��� ȭ���� �ƴմϴ�.\\n���ε� ������ jpg,gif,swf�Դϴ�.\")
		this.close();
		</script>
		";
		exit;
	}

	//================== ���ε� ������ �ҷ��� ================================================
	include "../../upload.php";
	$upload = "$Co_img_UP"."$mart_id/intro_img/";
	echo $upload;
	//exit;
	//================== ÷�� ������ ���ε��� ================================================
	if( $attach_name ){
		$file = FileUploadName( "$attach1", "$upload", $attach, $attach_name );//������ ���ε� ��

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
				window.alert('���� ���ε忡 �����߽��ϴ�.');
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