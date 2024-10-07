<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $Member_WelcomeTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$doctype = mysql_result($dbresult, 0, "doctype");
		$message = mysql_result($dbresult, 0, "message");
		$bg_img = mysql_result($dbresult, 0, "bg_img");
		$message = htmlspecialchars($message);
	}

	include "../admin_head.php";
?>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 

include_once('../../editor/func_editor.php');
$content = $message;
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>축하메세지</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<form method=post  name=writeform onsubmit='return editor_wr_ok();'>
			<input type='hidden' name='flag' value='update'>
			<!-- <input type='hidden' name='message' value='<?echo $message?>'> -->
			<!-- <tr>
				<td width="100%" bgcolor="#FFFFFF" height="7" valign="top"><p align="center"><span class="cc">아래 3개의 템플릿 중 하나를 선택하시고 내용을 입력하여 
					주세요.</span></td>
			</tr>
			<tr>
				<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></span></td>
			</tr>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="13" valign="top"><p align="center"><br>
				<img src="../images/j1.gif" border="1" WIDTH="290" HEIGHT="114"><br>
				<input name='bg_img' type="radio" value="j1.gif" <?if($bg_img == 'j1.gif') echo " checked"?>><br>
				<img src="../images/j2.gif" border="1" WIDTH="290" HEIGHT="114"><br>
				<input name='bg_img' type="radio" value="j2.gif" <?if($bg_img == 'j2.gif') echo " checked"?>><br>
				<img src="../images/j3.gif" border="1" WIDTH="290" HEIGHT="114"><br>
				<input name='bg_img' type="radio" value="j3.gif" <?if($bg_img == 'j3.gif') echo " checked"?>></td>
			</tr>
			<tr>
				<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="35" valign="top" align="center">
					<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
					<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 
					직접입력 
				</td>
			</tr>		 -->
			<tr>
				<td width="100%" bgcolor="#FFFFFF"><p align="center"><?=myEditor(1,'../../editor','writeform','message','100%','200');?><!-- <OBJECT id=editBox data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT> --></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp; 
					<input class="aa" onclick='init()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="재입력">&nbsp; 
					<input class="aa" onclick='prev_win()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="Preview">
				</td>
			</tr>
			</form>
		</table>
		<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
elseif ($flag == "update") {
	$SQL = "select * from $Member_WelcomeTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$SQL = "update $Member_WelcomeTable set message = '$message', bg_img = '$bg_img' where mart_id='$mart_id'";
	}else{
		$SQL = "insert into $Member_WelcomeTable (mart_id, message, bg_img) values ('$mart_id', '$message', '$bg_img')";
	}

	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=welcome.php'>";
}
?>	
<?
mysql_close($dbconn);
?>