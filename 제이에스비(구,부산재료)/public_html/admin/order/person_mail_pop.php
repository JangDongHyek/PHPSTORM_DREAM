<?
include "../lib/Mall_Admin_Session.php";

include "../admin_head.php";
?>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">

		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>���� ������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>
<script>
/*var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}
function re_init(){
	document.writeform.reset();
	init();
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.content.value;
	f.editBox.focus();
	f.editBox.setFocus();
}*/
function re_init(){
	document.writeform.reset();
	init();
}


function checkform(f){
	if(f.subject.value == ""){
		alert("������ �Է��ϼ���.");
		f.subject.focus();
		return false;
	}
//	f.editBox.editmode = "html";
//	f.content.value = f.editBox.html;

	if(!editor_wr_ok())
	{
		return false;
	}
	return true;
}
function cant_send(){
	alert("�׽�Ʈ �������� ������ ������ �����ϴ�.");
	return;
}	
function cant_send1(){
	alert("�̹� ����� ������ �ֽ��ϴ�.");
	return;
}	
</script>
</head>
<?
function check_email($email, $check_dns = false){ 
  if( (preg_match('/(@.*@)|(..)|(@.)|(.@)|(^.)/', $email)) || (preg_match('/^.+@([?)[a-zA-Z0-9-.]+.([a-zA-Z]{2,3}|[0-9]{1,3})(]?)$/', $email)) ){ 
	 if($check_dns){ 
		$host = explode('@', $email); 
		// Check for MX record 
		if( checkdnsrr($host[1], 'MX') ) return true; 
		// Check for A record 
		if( checkdnsrr($host[1], 'A') ) return true; 
		// Check for CNAME record 
		if( checkdnsrr($host[1], 'CNAME') ) return true; 
	 }else{ 
		return true; 
	 } 
  } 
  return false; 
} 
					

$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	$shopname = mysql_result($dbresult, 0, "shopname");
	$name = mysql_result($dbresult, 0, "name");
	$passport = mysql_result($dbresult, 0, "passport");
	$tel1 = mysql_result($dbresult, 0, "tel1");
	$tel2 = mysql_result($dbresult, 0, "tel2");
	$shopmail = mysql_result($dbresult, 0, "email");
	$place = mysql_result($dbresult, 0, "place");
	
}
if ($flag == "") {
	$SQL = "select * from $Email_ResTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);	
	/*if($numRows > 0){
		echo "
		<script>
		alert(\"�̹� ����� ������ �־� ������ ������ �� �����ϴ�.\\n������ �Ϸ翡 ���� ������ �� �ֽ��ϴ�.\")
		history.go(-1)
		</script>
		";
		exit;
	}*/
?>
<?
include_once('../../editor/func_editor.php');
$content = "";
?>
		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
     
			<form action='person_mail_pop.php' name="writeform" method="post" onsubmit='return checkform(this)'>
			<input type="hidden" name="flag" value="send">
			<input type="hidden" name="shopname" value="<?=$shopname?>">
			<input type="hidden" name="shopmail" value="<?=$shopmail?>">
			<input type="hidden" name="email" value="<?=$email?>">
			<tr>     
				<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				<table border="0" width="97%">     
					<tr>     
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">     
							<tr>     
								<td width="14%" bgcolor="#C8DFEC" align="left">
									��¥</td>     
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?=date("Y-m-d")?></td>     
							</tr>     
							<tr>     
								<td width="14%" bgcolor="#C8DFEC" align="left">
									������	��</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?=$shopname?></td>      
							</tr>      
							<tr>      
								<td width="14%" bgcolor="#C8DFEC" align="left">
									������ �̸���</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?=$shopmail?></td>      
							</tr>      
										<tr>
								<td width="14%" bgcolor="#C8DFEC" align="left">
									�޴� ��</td>
								<td width="48%" bgcolor="#FFFFFF" align="left">
																<?=$email?>
								</td>
							</tr>
							
							<tr>      
								<td width="14%" bgcolor="#C8DFEC" align="left">
									����</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									
									<input name="subject" size="67" class="input_03">
									&nbsp;
									</td>      
							</tr>      
							<tr>      
								<td width="62%" bgcolor="#C8DFEC" align="left" colspan="2">    
										<p align="center">�� ��</td>      
							</tr>      
							<tr>      
								<td width="51%" bgcolor="#FFFFFF" align="left" colspan="2" class="aa">    
										<!-- <p align="center">
										<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">������ 
										<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML �����Է�<br>
										<OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT>    
										</p>     -->
								<?=myEditor(1,'../../editor','writeform','content','100%','250');?>
								</td>      
							</tr>      
							</table>      
						</td>
					</tr>
				<tr>      
					<td width="100%" bgcolor="#FFFFFF" height="35" align="center">
						<?
						if($Mall_Admin_ID == 'test' ||$Mall_Admin_ID == 'guest1'){
							echo "<input onclick='cant_send()' class='aa' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'>&nbsp;";   
						}
						else{
							$SQL = "select * from $Email_ResTable where mart_id='$mart_id'";
							$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if($numRows > 0)
								echo "<input onclick='cant_send1()' class='aa' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'>&nbsp;";
								else
							echo "<input class='aa' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='submit' value='����'>&nbsp;";
						}
						?>
						<input onclick = "window.close();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�ݱ�">
					</td>
				</tr>
</form>
				</table>
			</td>
			</tr>
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
else {
	if(strlen($content)>122400){
		echo "
		<script>
		alert(\"���� ������ 100k�� ������ �����ϴ�.\");
		history.go(-1);
		</script>
		";
		exit;
	}	
	
	if($email){

					$content = $content;
			$email = check_email($email);	
					//echo"mail('$email', '$subject', '$content', 'From: $shopname<$shopmail>\nContent-type: text/html')";

					$result = mail("$email", "$subject", "$content", "From: $shopname<$shopmail>\nContent-type: text/html");
	}
	if( $result ){
		echo ("
			<script>
			alert('������ �߼۵Ǿ����ϴ�.');
			</script>
		");
	}else{
		echo ("
			<script>
			alert('���� �߼ۿ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}

	echo "<script>window.close();</script>";
}
?>
<?
mysql_close($dbconn);
?>