<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if(isset($flag)==false){
	$date = date("Y-m-d H:i:s");
	include "../admin_head.php";
?>
<script language="javascript1.1">
	<!--
	function checkform(f){
		if (f.content.value.length < 1){
			alert("������ �����ּ���!!")
			f.content.focus();
			return false;
		}
	return true;
	}
	//-->
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�����������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="90%" bgcolor="#FFFFFF" height="40"><strong>&nbsp;&nbsp; [�������� ���]</strong></td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				<table border="0" width="97%">
					
<form method="POST"  name="inputform" onsubmit="return checkform(this)">
<input type="hidden" name="flag" value="add">

				<tr>
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="14%" bgcolor="#C8DFEC" align="left">��¥</td>
								<td width="48%" bgcolor="#FFFFFF" align="left"><?echo substr($date,0,10)?></td>
							</tr>
							<tr>
								<td width="14%" bgcolor="#C8DFEC" align="left">
									����</td>
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<input name="content" size="67" class="input_03">
										
									</td>
							</tr>
							<tr>
								<td width="62%" bgcolor="#C8DFEC" align="left" colspan="2">
										<p align="center">�� �� �� ��</td>
							</tr>

							<tr>
								<td width="51%" bgcolor="#FFFFFF" align="center" colspan="2">
										���� ���� �� 9������ �����ϸ�, ���� ���׼��� 
										�°� ������� �Է��ϼ���.<br>
										</font>
										1. <input name="answer1" size="67" class="input_03">
										<br>
										2. <input name="answer2" size="67" class="input_03">
										<br>
										3. <input name="answer3" size="67" class="input_03">
										<br>
										4. <input name="answer4" size="67" class="input_03">
										<br>
										5. <input name="answer5" size="67" class="input_03">
										<br>
										6. <input name="answer6" size="67" class="input_03">
										<br>
										7. <input name="answer7" size="67" class="input_03">
										<br>
										8. <input name="answer8" size="67" class="input_03">
										<br>
										9. <input name="answer9" size="67" class="input_03">
										<br><br>
								</td>
							</tr>
							</table>
						</td>
					</tr>
				<tr>
					<td width="100%" bgcolor="#FFFFFF" height="35" align="center">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�">&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�">&nbsp;   
						<input onclick="window.location.href='poll_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��">
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
elseif ($flag == "add") {
	$dbconn = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconn == false) {
			echo "����Ÿ���̽� ���� ����!"; exit;
	}
	
	$SQL = "select max(poll_code), count(*) from $PollTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) >0) 
		$maxPoll_code = mysql_result($dbresult, 0, 0);
	else
		$maxPoll_code = 0;
	$date = date("Y-m-d H:i:s");
	
	$SQL = "insert into $PollTable (poll_code, mart_id, content, date, answer1, answer2, answer3, answer4, ".
	"answer5, answer6, answer7, answer8, answer9) values ($maxPoll_code+1, '$mart_id', ".
	"'$content', '$date', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', ".
	"'$answer6', '$answer7', '$answer8', '$answer9')";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=poll_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>