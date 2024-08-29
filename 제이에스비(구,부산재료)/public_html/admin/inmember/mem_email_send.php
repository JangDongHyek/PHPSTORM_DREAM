<?
include "../lib/Mall_Admin_Session.php";
?>
<?
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
	include "../admin_head.php";
?>
<script>
var blnBodyLoaded = false;
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
}


function checkform(f){
	if(f.subject.value == ""){
		alert("제목을 입력하세요.");
		f.subject.focus();
		return false;
	}
	f.editBox.editmode = "html";
	f.content.value = f.editBox.html;
	return true;
}
</script>
<script event="onscriptletevent(name, eventData)" for="editBox">
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onload="HandleLoad()">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
  <tr>
	 <td vAlign="top" width="646" bgColor="#ffffff"><div align="center"><center>
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td width="90%" height="50" bgColor="#ffffff"><strong>&nbsp;&nbsp; [개별회원 이메일 발송]</strong> <br>
		  <font color="red">&nbsp;&nbsp; 개별회원에게 메일을 발송합니다.<br></font></td>
		</tr>
		<tr>
		  <td></td>
		</tr>
	<form action='mem_email_send.php' name="writeform" method="post" onsubmit='return checkform(this)'>
	<input type="hidden" name="flag" value="send">
	<input type="hidden" name="shopname" value="<?=$shopname?>">
	<input type="hidden" name="shopmail" value="<?=$shopmail?>">
	<input type="hidden" name="content" value="<?=$content?>">
			<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center>
		  <table width="97%" border="0">
			 <tr>
				<td width="100%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%" border="0">
				  <tr>
					 <td align="left" width="14%" bgColor="#c8dfec">날짜</td>
					 <td align="left" width="48%" bgColor="#ffffff"><?=date("Y-m-d")?></td>
				  </tr>
				  <tr>
					 <td align="left" width="14%" bgColor="#c8dfec">보내는 이</td>
					 <td align="left" width="48%" bgColor="#ffffff"><?=$shopname?></td>
				  </tr>
				  <tr>
					 <td align="left" width="14%" bgColor="#c8dfec">보내는 이메일</td>
					 <td align="left" width="48%" bgColor="#ffffff"><?=$shopmail?></td>
				  </tr>
<?
if($keyset == '' && $searchword == '') 
$SQL = "select * from $MemberTable where mart_id='$mart_id' and perms='4' and username='$username'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$email = $ary["email"];
}
?>
						<input type='hidden' name='email' value='<?=$email?>'>
				  <tr>
					 <td align="left" width="14%" bgColor="#c8dfec">받는 이</td>
					 <td align="left" width="48%" bgColor="#ffffff"><?=$email?></td>
				  </tr>
				  <tr>
					 <td align="left" width="14%" bgColor="#c8dfec">제목</td>
					 <td align="left" width="48%" bgColor="#ffffff">
					 <input name="subject" class="input_03" size="67" style='ime-mode:active'> &nbsp; </td>
				  </tr>
				  <tr>
					 <td align="left" width="62%" bgColor="#c8dfec" colSpan="2"><p align="center"><span
					 class="aa">내 용</td>
				  </tr>
				  <tr>
					 <td align="left" width="51%" bgColor="#ffffff" colSpan="2"><p align="center"><input
					 onclick="setEditMode('html');" type="radio" value="html" name="editmode">에디터 <input
					 onclick="setEditMode('text');" type="radio" value="text" name="editmode">HTML 직접입력 <br>
					 <object id="editBox" type="text/x-scriptlet" height="350" width="530" data="../editor/Editorx.htm">
					 </object>
					 <br>
					 </td>
				  </tr>
				</table>
				</td>
			 </tr>
			 <tr>
				<td width="100%" bgColor="#ffffff" height="40"><p align="center">
				<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="전송">&nbsp; 
				<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" onclick="re_init()" type="button" value="재입력">&nbsp; 
				<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" onclick="window.close()" type="button" value="취소"></td>
			 </tr>
		  </table>
		  </center></div></td>
		</tr>
		</form>
	 </table>
	 </center></div></td>
  </tr>
</table>

</body>
</html>
<?
}
else if($flag=='send'){
	$content = stripslashes($content);
	if(strlen($content)>122400){
		echo "
		<script>
		alert(\"메일 내용은 100k를 넘을수 없습니다.\");
		history.go(-1);
		</script>
		";
		exit;
	}	
	$result = mail("$email", "$subject", "$content", "From: $shopname<$shopmail>\nReturn-Path: $shopmail\nContent-type: text/html", "-f $shopmail");

	if( $result ){
		echo ("
			<script>
			alert('{$email}로 메일을 보냈습니다.');
			window.close();
			</script>
		");
		exit;
	}else{
		echo ("
			<script>
			alert('메일 발송에 실패했습니다.');
			history.go(-1);
			</script>
		");
		exit;
	}
}
?>
<?
mysql_close($dbconn);
?>