<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $Member_WelcomeTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$doctype = mysql_result($dbresult, 0, "doctype");
$message = mysql_result($dbresult, 0, "message");
$bg_img = mysql_result($dbresult, 0, "bg_img");
$message = nl2br($message);

	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원가입 후 출력될 내용과 이메일로 전송될 내용입니다.</b></td>
				</tr>
			</table>

			<!--내용 START~~-->

				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="13" valign="top" align="center"><p align="center"><img src="../images/<?echo $bg_img?>" WIDTH="290" HEIGHT="114"><br>
						<table border="0" width="80%">
							<tr>
								<td width="100%"><span class="aa"><?echo $message?></span>
								</td>
							</tr>
						</table>
						<br>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35"><input onclick='javascript:top.window.close()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="닫기"></td>
					</tr>
				</table>


			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
</html>
<?
mysql_close($dbconn);
?>