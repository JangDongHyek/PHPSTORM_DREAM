<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $MartIntroTable where mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$link = mysql_result($dbresult, 0, "link");
	include "../admin_head.php";
?>
<script>
function checkform(){
	var f = document.writeform;
	if(f.link.value==""){
		alert("연결할 URL을 입력해주세요.");
		f.link.focus();
		return false;
	}
	return true;
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
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
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="40">회사홈페이지가 별도로 준비되신 분들을 위해 쇼핑몰에서 
						연결할 수 있도록 하였습니다. <br>
						아래의 링크창에 직접 주소를 적어주시면 되고, 링크된 
						회사홈페이지는 새창으로 열립니다.</td>
					</tr>
<form method=post name=writeform onsubmit='return checkform()'>
<input type='hidden' name='flag' value='update'>
				
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="40"><p align="center">
						<small>▶</small> 연결할 URL : http://
						<input name="link" size="50" value='<?echo $link?>' class="input_03">
					</td>
					</tr>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp; 
						<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="재입력">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
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
	$SQL = "update $MartIntroTable set link = '$link' where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=com_intro_choice.php'>";
}
?>	
<?
mysql_close($dbconn);
?>