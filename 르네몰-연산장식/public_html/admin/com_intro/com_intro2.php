<?
include "../lib/Mall_Admin_Session.php";
if ($flag == "") {
	$SQL = "select * from $MartIntroTable where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	$ary = mysql_fetch_array($dbresult);
	$help = $ary["help"];
	$help = htmlspecialchars($help, ENT_QUOTES);

	include "../admin_head.php";
?>

<script language="javascript">
<!-- 
function input_chk(){ 
	oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);	// �������� ������ textarea�� ����˴ϴ�.

	var content=oEditors.getById["content"].getIR();
	content=content.replace("<P>&nbsp;</P>","");
	if (content== "" ){ 
		 alert("������ �Է��ϼ���."); 
		 oEditors.getById["content"].exec("FOCUS", []); 
		return false;
	}

}
//-->
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 

include_once('../../editor/func_editor.php');
$content = $help;
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>ȸ��Ұ� ����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="80%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<form name='form' method='post' onsubmit='return input_chk();' enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
					<tr>
						<td height="35"><b>ȸ��Ұ��� ��Ÿ�� ������ html�� ���� �ۼ��ϼ���.</b></td>
					</tr>
					<tr>
						<td width='100%' bgcolor='#FFFFFF' align="center">
							

<!--------------------------------------- ������ ���� ------------------------------------------------------>
<script type="text/javascript" src="../../smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<input type='hidden' name='secontent' value=''>
<textarea name="content" id="content" rows="10" cols="100" style="width100%; height:412px; display:none;"><?=$content?></textarea>
<!--textarea name="content" id="content" rows="10" cols="100" style="width:100%; height:412px; min-width:610px; display:none;"></textarea-->
<!--
<p>
	<input type="button" onclick="pasteHTML();" value="������ ���� �ֱ�" />
	<input type="button" onclick="showHTML();" value="���� ���� ��������" />
	<input type="button" onclick="submitContents(this);" value="������ ���� ����" />
	<input type="button" onclick="setDefaultFont();" value="�⺻ ��Ʈ �����ϱ� (�ü�_24)" />
</p>
-->

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "../../smarteditor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// ���� ��� ���� (true:���/ false:������� ����)
		bUseVerticalResizer : true,		// �Է�â ũ�� ������ ��� ���� (true:���/ false:������� ����)
		bUseModeChanger : true,			// ��� ��(Editor | HTML | TEXT) ��� ���� (true:���/ false:������� ����)
		fOnBeforeUnload : function(){
			//alert("�ƽ�!");	
		}
	}, //boolean
	fOnAppLoad : function(){
		//���� �ڵ�
		//oEditors.getById["content"].exec("PASTE_HTML", ["�ε��� �Ϸ�� �Ŀ� ������ ���ԵǴ� text�Դϴ�."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>�̹����� ���� ������� �����մϴ�.<\/span>";
	oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["content"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);	// �������� ������ textarea�� ����˴ϴ�.
	alert(form.content.value);
	
	// �������� ���뿡 ���� �� ������ �̰����� document.getElementById("content").value�� �̿��ؼ� ó���ϸ� �˴ϴ�.



	try {
		return false;
		//elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '�ü�';
	var nFontSize = 24;
	oEditors.getById["content"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>
<!--------------------------------------- ����Ʈ �� ------------------------------------------------------>	
						</td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" align="center" height="40">
							<input type="submit" class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" value="�Ϸ�">&nbsp; 
							<input class="aa" onclick='document.form.reset();' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="���Է�"> 
						</td>
					</tr>
</form>
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
elseif ($flag == "update") {
	$sql1 = "update $MartIntroTable set help = '$content' where mart_id='$mart_id'";
	$res1 = mysql_query($sql1, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=$PHP_SELF'>";
}
?>	
<?
mysql_close($dbconn);
?>