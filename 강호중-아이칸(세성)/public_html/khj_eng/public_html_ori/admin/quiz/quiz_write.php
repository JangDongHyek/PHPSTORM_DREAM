<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if(isset($flag)==false){
	$today = date("Ymd");
	$today_year = substr($today,0,4);
	$today_month = substr($today,4,2);
	$today_day = substr($today,6,2);
	include "../admin_head.php";
?>
<script language="javascript1.1">
<!--
function checkform(f){
	return true;
}
//-->
</script>
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
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.quiz_explain.value;
	f.editBox.focus();
	f.editBox.setFocus();
}
function checkform(){
	var f = document.writeform;
	if (f.quiz_question.value.length < 1){
		alert("������ �����ּ���!")
		f.quiz_question.focus();
		return false;
	}
	if (f.correct_answer_no.value.length < 1){
		alert("�����ȣ�� �����ּ���!")
		f.correct_answer_no.focus();
		return false;
	}
	
	f.editBox.editmode = "html";
	f.quiz_explain.value = f.editBox.html;
	return true;
}
</script>
<script event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</script>

<body onload="HandleLoad()" bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" align="center">
					������� ����� �����ڿ��� ��ǰ���� �� �� �ִ� �̺�Ʈ�� 
					����� �����ϴ� ���α׷��Դϴ�. <br>
					�������� �̺�Ʈ�� �� Ȱ���ϸ� ���θ��� �湮�ڸ� �ø��ų� 
					��ǰ���� Ȱ���� �������� ���� �� �ֽ��ϴ�.
				</td>
<form method="POST"  name="writeform" onsubmit="return checkform(this)">
<input type="hidden" name="flag" value="write">
<input type="hidden" name="quiz_explain" value="">
			<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#999999">
								
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="13%" bgcolor="#C8DCA9">����Ⱓ</td>
									<td width="54%" bgcolor="#FFFFFF">
										<select name="from_year" size="1">
										<?
									for($i=2001;$i<=2005;$i++){
										echo ("<option value='$i'");
										if($today_year == $i) echo " selected";
										echo (">$i");
									}
									?>
									</select>
										�� 
										<select name="from_month" size="1">
										<?
									for($i=1;$i<=12;$i++){
										if(strlen($i)==1) $i_temp='0'.$i;
										else $i_temp = $i;
										echo ("<option value='$i_temp'");
										if($today_month == $i_temp) echo " selected";
										echo (">$i");
									}
									?>
									</select>
										�� 
										<select name="from_day" size="1">
										<?
									for($i=1;$i<=31;$i++){
										if(strlen($i)==1) $i_temp='0'.$i;
										else $i_temp = $i;
										echo ("<option value='$i_temp'");
										if($today_day == $i_temp) echo " selected";
										echo (">$i");
									}
									?>
										</select>
										�� ~ 
										<select name="to_year" size="1">
											<?
									for($i=2001;$i<=2005;$i++){
										echo ("<option value='$i'");
										if($today_year == $i) echo " selected";
										echo (">$i");
									}
									?>
									</select>
										�� 
										<select name="to_month" size="1">
											<?
									for($i=1;$i<=12;$i++){
										if(strlen($i)==1) $i_temp='0'.$i;
										else $i_temp = $i;
										echo ("<option value='$i_temp'");
										if($today_month == $i_temp) echo " selected";
										echo (">$i");
									}
									?>
									</select>
										�� 
										<select name="to_day" size="1">
											<?
									for($i=1;$i<=31;$i++){
										if(strlen($i)==1) $i_temp='0'.$i;
										else $i_temp = $i;
										echo ("<option value='$i_temp'");
										if($today_day == $i_temp) echo " selected";
										echo (">$i");
									}
									?>
										</select>
										��&nbsp;&nbsp;&nbsp; 
									</td>
								</tr>
								<tr>
									<td width="9%" bgcolor="#C8DCA9" align="left">
										����</td>
									<td width="38%" bgcolor="#FFFFFF" align="center">
										<p align="left">
										<input name="quiz_question" size="57" class="input_03">
									</td>
								</tr>
								<tr>
									<td width="9%" bgcolor="#C8DCA9" align="left">
										����</td>
									<td width="38%" bgcolor="#FFFFFF" align="center">
										<p align="left">
										<input name="correct_answer_no" size="3" maxlength='1' class="input_03"> 
										��
									</td>
								</tr>
								<tr>
									<td width="47%" bgcolor="#C8DCA9" align="left" colspan="2"><p align="center">����</td>
								</tr>
								<tr>
									<td width="47%" bgcolor="#FFFFFF" align="center" colspan="2">
										
										<font color="#0000FF">�亯 ���� �� 9������ �����ϸ�, ������� �Է��ϼ���.</font><br>
										
										1. 
										<input name="answer1" size="67" class="input_03"> 
										<br>
										2. 
										<input name="answer2" size="67" class="input_03"> 
										<br>
										3. 
										<input name="answer3" size="67" class="input_03"> 
										<br>
										4. 
										<input name="answer4" size="67" class="input_03"> 
										<br>
										5. 
										<input name="answer5" size="67" class="input_03"> 
										<br>
										6. 
										<input name="answer6" size="67" class="input_03"> 
										<br>
										7. 
										<input name="answer7" size="67" class="input_03"> 
										<br>
										8. 
										<input name="answer8" size="67" class="input_03"> 
										<br>
										9. 
										<input name="answer9" size="67" class="input_03"> 
										
									</td>
								</tr>
								<tr>
									<td width="47%" bgcolor="#C8DCA9" align="left" colspan="2">
										<p align="center">�� ��</td>
								</tr>
								<tr>
									<td width="47%" bgcolor="#FFFFFF" colspan="2" align="center">
										<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">������ 
										<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML �����Է� <br>
										<OBJECT id=editBox data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
									</td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
					</center></div>
				</td>
				</tr>
				<tr align="center">
				<td width="100%" bgcolor="#FFFFFF" align="center">
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�">&nbsp; 
					<input onclick='init()' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�">&nbsp;
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
elseif ($flag == "write") {
	
	$SQL = "select max(quiz_no), count(*) from $QuizTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0) 
		$maxQuiz_no = mysql_result($dbresult, 0, 0);
	else
		$maxQuiz_no = 0;
	$date = date("Ymd H:i:s");
	
	$from_date = $from_year.$from_month.$from_day;
	$to_date = $to_year.$to_month.$to_day;
	
	$SQL = "insert into $QuizTable (quiz_no, mart_id, from_date, to_date, quiz_question, correct_answer_no, answer1, ".
	"answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, quiz_explain, date, if_end) values ($maxQuiz_no+1, ".
	"'$mart_id', '$from_date', '$to_date', '$quiz_question', '$correct_answer_no', '$answer1', '$answer2', '$answer3', ".
	"'$answer4', '$answer5', '$answer6', '$answer7', '$answer8', '$answer9', '$quiz_explain', '$date','f')";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=quiz_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>