<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
	if (isset($prevno) == false) $prevno = 0;
	
	$SQL = "select * from $PollTable where poll_code = $poll_code and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		$ary=mysql_fetch_array($dbresult);
		$date = $ary["date"];
		$content = $ary["content"];
		$answer1 = $ary["answer1"];
		$answer2 = $ary["answer2"];
		$answer3 = $ary["answer3"];
		$answer4 = $ary["answer4"];
		$answer5 = $ary["answer5"];
		$answer6 = $ary["answer6"];
		$answer7 = $ary["answer7"];
		$answer8 = $ary["answer8"];
		$answer9 = $ary["answer9"];
	}
	include "../admin_head.php";
?>
<script language="javascript1.1">
	<!--
	function checkform(f){
		if (f.content.value.length < 1){
			alert("내용을 적어주세요!!")
			f.content.focus();
			return false;
		}
	return true;
}
function really(f){
	if(confirm("삭제하시겠습니까?")){
		f.flag.value='delete'
		f.submit();
	}
}
	//-->
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>설문조사관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="90%" bgcolor="#FFFFFF" align="center"><strong>&nbsp;&nbsp; [설문조사 수정]</strong></td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				<table border="0" width="97%">

<form method="POST" name="inputform" onsubmit="return checkform(this)">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="poll_code" value="<?echo $poll_code?>">

				<tr>
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="14%" bgcolor="#C8DFEC" align="left">
									날짜</td>
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?echo substr($date,0,10)?></td>
							</tr>
							<tr>
								<td width="14%" bgcolor="#C8DFEC" align="left">
									제목</td>
								<td width="48%" bgcolor="#FFFFFF" align="left">
									
									<input name="content" value='<?echo $content?>' size="67" class="input_03">
										
									</td>
							</tr>
							<tr>
								<td width="14%" bgcolor="#C8DFEC" align="left">문항수</td>
								<td width="48%" bgcolor="#FFFFFF" align="left">
									
									<input name="login_pnum" size="7" class="input_03">&nbsp;&nbsp; 
										(숫자만 기입하세요)</td>
							</tr>
							<tr>
								<td width="62%" bgcolor="#C8DFEC" align="left" colspan="2">
										<p align="center">문 항 입 력</td>
							</tr>
						</center></center>
							<tr>
								<td width="51%" bgcolor="#FFFFFF" align="left" colspan="2">
										<p align="center"><font color="#0000FF"><br>
										문항 수는 총 9개까지 가능하며, 위의 문항수에 
										맞게 순서대로 입력하세요.<br>
										</font>
										1. <input name="answer1" value='<?echo $answer1?>' size="67" class="input_03">
										<br>
										2. <input name="answer2" value='<?echo $answer2?>' size="67" class="input_03">
										<br>
										3. <input name="answer3" value='<?echo $answer3?>' size="67" class="input_03">
										<br>
										4. <input name="answer4" value='<?echo $answer4?>' size="67" class="input_03">
										<br>
										5. <input name="answer5" value='<?echo $answer5?>' size="67" class="input_03">
										<br>
										6. <input name="answer6" value='<?echo $answer6?>' size="67" class="input_03">
										<br>
										7. <input name="answer7" value='<?echo $answer7?>' size="67" class="input_03">
										<br>
										8. <input name="answer8" value='<?echo $answer8?>' size="67" class="input_03">
										<br>
										9. <input name="answer9" value='<?echo $answer9?>' size="67" class="input_03">
										<br>
										<center>
										<br>
										</center>
								</td>
							</tr>
							</table>
						</td>
					</tr>
				<tr>
					<td width="100%" bgcolor="#FFFFFF" height="35" align="center">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료">&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">&nbsp;   
						<input onclick="window.location.href='poll_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로">&nbsp;   
						<input onclick="really(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제">
					</td>
				</tr>
				</form>
				</table>
			</td>
			</tr>
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
	$SQL = "update $PollTable set content = '$content', answer1 = '$answer1', answer2 = '$answer2', ".
	"answer3 = '$answer3', answer4 = '$answer4', answer5 = '$answer5', answer6 = '$answer6', answer7 = '$answer7', ".
	"answer8 = '$answer8', answer9 = '$answer9' where poll_code = $poll_code and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=poll_list.php'>";
}
elseif ($flag == "delete") {
	$SQL = "delete from $PollTable where poll_code = $poll_code and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=poll_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>