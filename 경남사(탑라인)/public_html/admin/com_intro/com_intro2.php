<?
include "../lib/Mall_Admin_Session.php";
?>
<?
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
		
	return true;
}
//-->
</script>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 

include_once('../../editor/func_editor.php');
$content = $help;
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회사소개 설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="80%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<form name='form' method='post' onsubmit='return editor_wr_ok();' enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
					<tr>
						<td height="35"><b>회사소개에 나타날 내용을 html로 직접 작성하세요.</b></td>
					</tr>
					<tr>
						<td width='100%' bgcolor='#FFFFFF' align="center">
							<!-- <object id="help_txt" codebase="<?=$edit_url?>GsWebEdit.cab#version=1,0,0,62" height="400" width="90%" classid="CLSID:8B844CB2-4E1B-4707-B3D5-31C00D717398">
								<param name="AhrefAutoTargetUse" value="true">
								<param name="AhrefAutoTarget" value="__blank">
								<param name="CurMoveFirst" value="true">
								<param name="Metacontent" value="<?=$url?>">
								<param name="CharSet" value="ks_c_5601-1987">
								<param name="BorderColor" value="#FFFFFF">
								<param name="InsertHtml" value="<?=$help?>">
								<param name="FontSize" VALUE="">
								<param name="LimitAttachFileSize" value="0">
								<param name="LimitAttachFileTotalSize" value="0">
								<param name="LimitAttachFileCount" value="0">
								<param name="CSSUrl" value="<?=$style_url?>style.css">
								<param name="TableBorder" value="1">
								<param name="TableCellSpacing" value="2">
								<param name="TableCellPadding" value="1">
								<param name="ShowProgressBar" value="true">
								<param name="ToolBarStyleUrl" value="<?=$style_url?>style.txt">
								<param name="UseBR" value="true">
								<param name="UseStyle" value="true">
								<param name="ToolBarImagePath" value="">
								<param name="ToolBarHotImagePath" value="">
								<param name="ToolBarDisableImagePath" value="">
								<param name="TabPosition" value="bottom">
							</object> <textarea style='display:none' name="help"></textarea> -->
							<?=myEditor(1,'../../editor','form','help','100%','200');?>							
						</td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" align="center" height="40">
							<input type="submit" class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" value="완료">&nbsp; 
							<input class="aa" onclick='document.form.reset();' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="재입력"> 
						</td>
					</tr>
</form>
				</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
elseif ($flag == "update") {
	$sql1 = "update $MartIntroTable set help = '$help' where mart_id='$mart_id'";
	$res1 = mysql_query($sql1, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=$PHP_SELF'>";
}
?>	
<?
mysql_close($dbconn);
?>