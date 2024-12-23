<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if(isset($flag)==false){
	$SQL = "select * from $QuizTable where mart_id='$mart_id' and quiz_no = $quiz_no";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, $i);
		$ary=mysql_fetch_array($dbresult);
		$quiz_no = $ary["quiz_no"];
		$mart_id = $ary["mart_id"];
		$from_date = $ary["from_date"];
		$to_date = $ary["to_date"];
		$quiz_question = $ary["quiz_question"];
		$correct_answer_no = $ary["correct_answer_no"];
		$answer1 = $ary["answer1"];
		$answer2 = $ary["answer2"];
		$answer3 = $ary["answer3"];
		$answer4 = $ary["answer4"];
		$answer5 = $ary["answer5"];
		$answer6 = $ary["answer6"];
		$answer7 = $ary["answer7"];
		$answer8 = $ary["answer8"];
		$answer9 = $ary["answer9"];
		$quiz_explain = htmlspecialchars($ary["quiz_explain"]);
		$date = $ary["date"];
		
		$from_year = substr($from_date,0,4);
		$from_month = substr($from_date,4,2);
		$from_day = substr($from_date,6,2);
		$to_year = substr($to_date,0,4);
		$to_month = substr($to_date,4,2);
		$to_day = substr($to_date,6,2);
	}
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
		alert("문제를 적어주세요!")
		f.quiz_question.focus();
		return false;
	}
	if (f.correct_answer_no.value.length < 1){
		alert("정답번호를 적어주세요!")
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>퀴즈</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
						퀴즈문제를 만들고 정답자에게 경품등을 줄 수 있는 이벤트를 
						만들고 관리하는 프로그램입니다. <br>
						퀴즈응모 이벤트를 잘 활용하면 쇼핑몰의 방문자를 늘리거나 
						경품등을 활용한 고객접점을 만들 수 있습니다.
					</td>
					</tr>
<form method="POST"  name="writeform" onsubmit="return checkform(this)">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="quiz_explain" value='<?echo $quiz_explain?>'>
				
				<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="13%" bgcolor="#C8DCA9">응모기간</td>
										<td width="54%" bgcolor="#FFFFFF">
											<select name="from_year" size="1">
											<?
										for($i=2001;$i<=2005;$i++){
											echo ("<option value='$i'");
											if($from_year == $i) echo " selected";
											echo (">$i");
										}
										?>
										</select>
											년 
											<select name="from_month" size="1">
											<?
										for($i=1;$i<=12;$i++){
											if(strlen($i)==1) $i_temp='0'.$i;
											else $i_temp = $i;
											echo ("<option value='$i_temp'");
											if($from_month == $i_temp) echo " selected";
											echo (">$i");
										}
										?>
										</select>
											월 
											<select name="from_day" size="1">
											<?
										for($i=1;$i<=31;$i++){
											if(strlen($i)==1) $i_temp='0'.$i;
											else $i_temp = $i;
											echo ("<option value='$i_temp'");
											if($from_day == $i_temp) echo " selected";
											echo (">$i");
										}
										?>
											</select>
											일 ~ 
											<select name="to_year" size="1">
												<?
										for($i=2001;$i<=2005;$i++){
											echo ("<option value='$i'");
											if($to_year == $i) echo " selected";
											echo (">$i");
										}
										?>
										</select>
											년 
											<select name="to_month" size="1">
												<?
										for($i=1;$i<=12;$i++){
											if(strlen($i)==1) $i_temp='0'.$i;
											else $i_temp = $i;
											echo ("<option value='$i_temp'");
											if($to_month == $i_temp) echo " selected";
											echo (">$i");
										}
										?>
										</select>
											월 
											<select name="to_day" size="1">
												<?
										for($i=1;$i<=31;$i++){
											if(strlen($i)==1) $i_temp='0'.$i;
											else $i_temp = $i;
											echo ("<option value='$i_temp'");
											if($to_day == $i_temp) echo " selected";
											echo (">$i");
										}
										?>
											</select>
											일&nbsp;&nbsp;&nbsp; 
										</td>
									</tr>
									<tr>
										<td width="9%" bgcolor="#C8DCA9" align="left">
											문제</td>
										<td width="38%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											
											<input name="quiz_question" value='<?echo $quiz_question?>' size="57" class="input_03">
											
										</td>
									</tr>
									<tr>
										<td width="9%" bgcolor="#C8DCA9" align="left">
											정답</td>
										<td width="38%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="correct_answer_no" value='<?echo $correct_answer_no?>' size="3" maxlength='1' class="input_03"> 
											번
										</td>
									</tr>
									<tr>
										<td width="47%" bgcolor="#C8DCA9" align="left" colspan="2">
											<p align="center">보기
										</td>
									</tr>
									<tr>
										<td width="47%" bgcolor="#FFFFFF" align="center" colspan="2">
											
											<font color="#0000FF">답변 수는 총 9개까지 가능하며, 순서대로 입력하세요.</font><br>
											
											1. 
											<input name="answer1" value='<?echo $answer1?>' size="67" class="input_03"> 
											<br>
											2. 
											<input name="answer2" value='<?echo $answer2?>' size="67" class="input_03"> 
											<br>
											3. 
											<input name="answer3" value='<?echo $answer3?>' size="67" class="input_03"> 
											<br>
											4. 
											<input name="answer4" value='<?echo $answer4?>' size="67" class="input_03"> 
											<br>
											5. 
											<input name="answer5" value='<?echo $answer5?>' size="67" class="input_03"> 
											<br>
											6. 
											<input name="answer6" value='<?echo $answer6?>' size="67" class="input_03"> 
											<br>
											7. 
											<input name="answer7" value='<?echo $answer7?>' size="67" class="input_03"> 
											<br>
											8. 
											<input name="answer8" value='<?echo $answer8?>' size="67" class="input_03"> 
											<br>
											9. 
											<input name="answer9" value='<?echo $answer9?>' size="67" class="input_03"> 
											
										</td>
									</tr>
									<tr>
										<td width="47%" bgcolor="#C8DCA9" align="left" colspan="2">
											<p align="center">설 명</td>
									</tr>
									<tr>
										<td width="47%" bgcolor="#FFFFFF" align="left" colspan="2">
											<p align="center">
											
											<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
										<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
										
										<br>
											<br>
											
											<OBJECT id=editBox data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
											
											<br>
											<br>
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
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료">&nbsp; 
						<input onclick='init()' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
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
	$from_date = $from_year.$from_month.$from_day;
	$to_date = $to_year.$to_month.$to_day;
	
	$SQL = "update $QuizTable set from_date = '$from_date', to_date = '$to_date', ".
	"quiz_question = '$quiz_question', correct_answer_no = '$correct_answer_no', answer1 = '$answer1', ".
	"answer2 = '$answer2', answer3 = '$answer3', answer4 = '$answer4', answer5 = '$answer5', answer6 = '$answer6', ".
	"answer7 = '$answer7', answer8 = '$answer8', answer9 = '$answer9', quiz_explain = '$quiz_explain'  ".
	"where quiz_no = $quiz_no and mart_id='$mart_id'";
	
	$dbresult = mysql_query($SQL, $dbconn); 
	
	echo "<meta http-equiv='refresh' content='0; URL=quiz_list.php'>";
}
?>	
<?
mysql_close($dbconn);
?>