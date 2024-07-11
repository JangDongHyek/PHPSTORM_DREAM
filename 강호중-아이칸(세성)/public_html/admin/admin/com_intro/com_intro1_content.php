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
	$SQL = "select * from $MartIntroTable where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	$help = mysql_result($dbresult, 0, "help");
	$help = htmlspecialchars($help);
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
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
	document.writeform.editBox.editmode = sMode;
}
function init() {
	var f = document.writeform;
	if (f.help.value != "") {
		f.editBox.html = f.help.value;
	}
	//document.all.editBox.setBgColor();

	f.editBox.focus();
	f.editBox.setFocus();
}


function checkform(f){
	f.editBox.editmode = "html";
	f.help.value = f.editBox.html;
	return true;
}
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</SCRIPT>
</head>

<body onload=HandleLoad() topmargin="0" leftmargin="3" bgcolor="#FFFFFF">
<table border="0" width="438">

<form method=post  name=writeform onsubmit='return checkform(this)'>
<input type='hidden' name='flag' value='update'>
<input type=hidden name=help value='<?echo $help?>'> 

<tr>
    <td width="100%" bgcolor="#FFFFFF">
    	<p align="center"><span class="aa"><br>
    	</span><span class="bb">회사 소개에 올릴 내용을 작성하세요.<br>
    	<input name="editmode" onclick="setEditMode('html');" type="radio" value="html" checked>에디터 
        <input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
       	</span>
       	<OBJECT id=editBox data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
	</td>
</tr>
<tr>
    <td width="100%">
    	<p align="center">
    	<span class="aa">
    	<input class="aa" style="background-color: #5a5a5a; color: white; height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp;
    	<input class="aa" onclick="javascript:top.window.close()" style="background-color: #5a5a5a; color: white; height: 18px; border: 1px solid #5a5a5a" type="button" value="창닫기">
    	</span>
    </td>
</tr>
</form>
</table>
</body>
</html>
<?
}
elseif ($flag == "update") {
	//$help = str_replace("<BR>", "\n", $help);
	//$help = stripslashes($help);
	
	$SQL = "update $MartIntroTable set help = '$help' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=com_intro1_content.php'>";
}
?>	
<?
mysql_close($dbconn);
?>