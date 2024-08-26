<?
include "../lib/Mall_Admin_Session.php";
?>

<?
if ($flag == "") {
	$SQL = "select * from $User_GuideTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0 ){
		mysql_data_seek($dbresult, 0);
		$ary = mysql_fetch_array($dbresult);
		$question1 = $ary["question1"];	 
		$answer1 = htmlspecialchars($ary["answer1"], ENT_QUOTES);
		$question2 = $ary["question2"];	 
		$answer2 = htmlspecialchars($ary["answer2"], ENT_QUOTES);
		$question3 = $ary["question3"];	 
		$answer3 = htmlspecialchars($ary["answer3"], ENT_QUOTES);
		$question4 = $ary["question4"];	 
		$answer4 = htmlspecialchars($ary["answer4"], ENT_QUOTES);
		$question5 = $ary["question5"];	 
		$answer5 = htmlspecialchars($ary["answer5"], ENT_QUOTES);
		$question6 = $ary["question6"];	 
		$answer6 = htmlspecialchars($ary["answer6"], ENT_QUOTES);
		$question7 = $ary["question7"];	 
		$answer7 = htmlspecialchars($ary["answer7"], ENT_QUOTES);
		$question8 = $ary["question8"];	 
		$answer8 = htmlspecialchars($ary["answer8"], ENT_QUOTES);
		$question9 = $ary["question9"];	 
		$answer9 = htmlspecialchars($ary["answer9"], ENT_QUOTES);
		$question10 = $ary["question10"];	 
		$answer10 = htmlspecialchars($ary["answer10"], ENT_QUOTES);	
		$flag = "update";
	}
	else $flag = "write";

	include "../admin_head.php";
?>
<script>
var blnBodyLoaded = false;
var blnEditorLoaded1 = false;
var blnEditorLoaded2 = false;
var blnEditorLoaded3 = false;
var blnEditorLoaded4 = false;
var blnEditorLoaded5 = false;
var blnEditorLoaded6 = false;
var blnEditorLoaded7 = false;
var blnEditorLoaded8 = false;
var blnEditorLoaded9 = false;
var blnEditorLoaded10 = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded1 == true) {
		init1();
	}
	if (blnEditorLoaded2 == true) {
		init2();
	}
	if (blnEditorLoaded3 == true) {
		init3();
	}
	if (blnEditorLoaded4 == true) {
		init4();
	}
	if (blnEditorLoaded5 == true) {
		init5();
	}
	if (blnEditorLoaded6 == true) {
		init6();
	}
	if (blnEditorLoaded7 == true) {
		init7();
	}
	if (blnEditorLoaded8 == true) {
		init8();
	}
	if (blnEditorLoaded9 == true) {
		init9();
	}
	if (blnEditorLoaded10 == true) {
		init10();
	}
}

function setEditMode1(sMode){
	document.all.editBox1.editmode = sMode;
}
function setEditMode2(sMode){
	document.all.editBox2.editmode = sMode;
}
function setEditMode3(sMode){
	document.all.editBox3.editmode = sMode;
}
function setEditMode4(sMode){
	document.all.editBox4.editmode = sMode;
}
function setEditMode5(sMode){
	document.all.editBox5.editmode = sMode;
}
function setEditMode6(sMode){
	document.all.editBox6.editmode = sMode;
}
function setEditMode7(sMode){
	document.all.editBox7.editmode = sMode;
}
function setEditMode8(sMode){
	document.all.editBox8.editmode = sMode;
}
function setEditMode9(sMode){
	document.all.editBox9.editmode = sMode;
}
function setEditMode10(sMode){
	document.all.editBox10.editmode = sMode;
}

function init1() {
	var f = document.writeform;
	f.editmode1[0].click();
	f.editBox1.editmode = "html";
	f.editBox1.html = f.answer1.value;
}
function init2() {
	var f = document.writeform;
	f.editmode2[0].click();
	f.editBox2.editmode = "html";
	f.editBox2.html = f.answer2.value;
}
function init3() {
	var f = document.writeform;
	f.editmode3[0].click();
	f.editBox3.editmode = "html";
	f.editBox3.html = f.answer3.value;
}
function init4() {
	var f = document.writeform;
	f.editmode4[0].click();
	f.editBox4.editmode = "html";
	f.editBox4.html = f.answer4.value;
}
function init5() {
	var f = document.writeform;
	f.editmode5[0].click();
	f.editBox5.editmode = "html";
	f.editBox5.html = f.answer5.value;
}
function init6() {
	var f = document.writeform;
	f.editmode6[0].click();
	f.editBox6.editmode = "html";
	f.editBox6.html = f.answer6.value;
}
function init7() {
	var f = document.writeform;
	f.editmode7[0].click();
	f.editBox7.editmode = "html";
	f.editBox7.html = f.answer7.value;
}
function init8() {
	var f = document.writeform;
	f.editmode8[0].click();
	f.editBox8.editmode = "html";
	f.editBox8.html = f.answer8.value;
}
function init9() {
	var f = document.writeform;
	f.editmode9[0].click();
	f.editBox9.editmode = "html";
	f.editBox9.html = f.answer9.value;
}
function init10() {
	var f = document.writeform;
	f.editmode10[0].click();
	f.editBox10.editmode = "html";
	f.editBox10.html = f.answer10.value;
	f.editBox1.focus();
	f.editBox1.setFocus();
}

function init_t(){
	init1();
	init2();
	init3();
	init4();
	init5();
	init6();
	init7();
	init8();
	init9();
	init10();
}

function checkform(f){
	f.editBox1.editmode = "html";
	f.answer1.value = f.editBox1.html;
	
	f.editBox2.editmode = "html";
	f.answer2.value = f.editBox2.html;
	
	f.editBox3.editmode = "html";
	f.answer3.value = f.editBox3.html;
	
	f.editBox4.editmode = "html";
	f.answer4.value = f.editBox4.html;
	
	f.editBox5.editmode = "html";
	f.answer5.value = f.editBox5.html;
	
	f.editBox6.editmode = "html";
	f.answer6.value = f.editBox6.html;
	
	f.editBox7.editmode = "html";
	f.answer7.value = f.editBox7.html;
	
	f.editBox8.editmode = "html";
	f.answer8.value = f.editBox8.html;
	
	f.editBox9.editmode = "html";
	f.answer9.value = f.editBox9.html;
	
	f.editBox10.editmode = "html";
	f.answer10.value = f.editBox10.html;
	
	f.submit();
}
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox1>
if (name == "onafterload") {
	blnEditorLoaded1 = true;
	if (blnBodyLoaded == true) {
		init1();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox2>
if (name == "onafterload") {
	blnEditorLoaded2 = true;
	if (blnBodyLoaded == true) {
		init2();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox3>
if (name == "onafterload") {
	blnEditorLoaded3 = true;
	if (blnBodyLoaded == true) {
		init3();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox4>
if (name == "onafterload") {
	blnEditorLoaded4 = true;
	if (blnBodyLoaded == true) {
		init4();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox5>
if (name == "onafterload") {
	blnEditorLoaded5 = true;
	if (blnBodyLoaded == true) {
		init5();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox6>
if (name == "onafterload") {
	blnEditorLoaded6 = true;
	if (blnBodyLoaded == true) {
		init6();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox7>
if (name == "onafterload") {
	blnEditorLoaded7 = true;
	if (blnBodyLoaded == true) {
		init7();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox8>
if (name == "onafterload") {
	blnEditorLoaded8 = true;
	if (blnBodyLoaded == true) {
		init8();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox9>
if (name == "onafterload") {
	blnEditorLoaded9 = true;
	if (blnBodyLoaded == true) {
		init9();
	}
}
</SCRIPT>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox10>
if (name == "onafterload") {
	blnEditorLoaded10 = true;
	if (blnBodyLoaded == true) {
		init10();
	}
}
</SCRIPT>

</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onload="HandleLoad()">
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>이용안내</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<p style="padding-left: 15px">쇼핑몰 메뉴 &quot;이용안내&quot;에 들어가는 부분입니다.<br>
				예시로 제시된 내용을 참고하셔서 부분수정하시거나 직접 
				작성하세요.<br>
			</td>
			</tr>
			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>
			
	<form method=post  name=writeform onsubmit='return checkform(this)'>
	<input type='hidden' name='flag' value='<?echo $flag?>'>
	<input type=hidden name=answer1 value='<?echo $answer1?>'> 
	<input type=hidden name=answer2 value='<?echo $answer2?>'> 
	<input type=hidden name=answer3 value='<?echo $answer3?>'> 
	<input type=hidden name=answer4 value='<?echo $answer4?>'> 
	<input type=hidden name=answer5 value='<?echo $answer5?>'> 
	<input type=hidden name=answer6 value='<?echo $answer6?>'> 
	<input type=hidden name=answer7 value='<?echo $answer7?>'> 
	<input type=hidden name=answer8 value='<?echo $answer8?>'> 
	<input type=hidden name=answer9 value='<?echo $answer9?>'> 
	<input type=hidden name=answer10 value='<?echo $answer10?>'> 
		  
			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="0" valign="top">
				
				<table border="0" width="90%">
					<tr>
						<td width="100%" height="14">
							<p align="left"><strong>Q1.&nbsp; <input name="question1" value="<?echo $question1?>" class="input_03" size="80">
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%" height="14">
							<p align="center">
							<input name="editmode1" onclick="setEditMode1('html');" type="radio" value="html">에디터 
						<input name="editmode1" onclick="setEditMode1('text');" type="radio" value="text">HTML 직접입력 
						 
						</td>
					</tr>
					<tr>
						<td width="100%" height="26">
							<p align="center">
							<OBJECT id=editBox1 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
					</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1" valign="top">
			
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							<strong>Q2.&nbsp; 
							<input name="question2" value="<?echo $question2?>" class="input_03" size="80"> 
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<input name="editmode2" onclick="setEditMode2('html');" type="radio" value="html">에디터 
						<input name="editmode2" onclick="setEditMode2('text');" type="radio" value="text">HTML 직접입력 
					</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox2 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1">
			
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							<strong>
							Q3.&nbsp; 
							<input name="question3" value="<?echo $question3?>" class="input_03" size="80">
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<input name="editmode3" onclick="setEditMode3('html');" type="radio" value="html">에디터 
						<input name="editmode3" onclick="setEditMode3('text');" type="radio" value="text">HTML 직접입력 
					</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox3 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1">
				
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							<strong>Q4.&nbsp; 
							<input name="question4" value="<?echo $question4?>" class="input_03" size="80"> <br>
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%"><p align="center">
							
							<input name="editmode4" onclick="setEditMode4('html');" type="radio" value="html">에디터 
						<input name="editmode4" onclick="setEditMode4('text');" type="radio" value="text">HTML 직접입력 
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox4 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1">
				
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							<strong>Q5.&nbsp; 
							<input name="question5" value="<?echo $question5?>" class="input_03" size="80"> 
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<input name="editmode5" onclick="setEditMode5('html');" type="radio" value="html">에디터 
						<input name="editmode5" onclick="setEditMode5('text');" type="radio" value="text">HTML 직접입력 
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox5 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="3"></td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF">
			
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							
							<strong>Q6.&nbsp; 
							<input name="question6" value="<?echo $question6?>" class="input_03" size="80">
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<input name="editmode6" onclick="setEditMode6('html');" type="radio" value="html">에디터 
						<input name="editmode6" onclick="setEditMode6('text');" type="radio" value="text">HTML 직접입력 
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox6 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1">
				
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							
							<strong>Q7.&nbsp; 
							<input name="question7" value='<?echo $question7?>' class="input_03" size="80"> 
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							
							<input name="editmode7" onclick="setEditMode7('html');" type="radio" value="html">에디터 
						<input name="editmode7" onclick="setEditMode7('text');" type="radio" value="text">HTML 직접입력 
					</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox7 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1"></td>
			</tr>
			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1">
			
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							
							<strong>Q8.&nbsp; 
							<input name="question8" value='<?echo $question8?>' class="input_03" size="80"> 
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							
							<input name="editmode8" onclick="setEditMode8('html');" type="radio" value="html">에디터 
						<input name="editmode8" onclick="setEditMode8('text');" type="radio" value="text">HTML 직접입력 
					</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox8 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1">
				
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							
							<strong>Q9.&nbsp; 
							<input name="question9" value='<?echo $question9?>' class="input_03" size="80"> 
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							
							<input name="editmode9" onclick="setEditMode9('html');" type="radio" value="html">에디터 
						<input name="editmode9" onclick="setEditMode9('text');" type="radio" value="text">HTML 직접입력 
					</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox9 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="1">
				
				<table border="0" width="90%">
					<tr>
						<td width="100%">
							
							<strong>Q10.&nbsp; 
							<input name="question10" value='<?echo $question10?>' class="input_03" size="80"> 
							<br>
							</strong>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							
							<input name="editmode10" onclick="setEditMode10('html');" type="radio" value="html">에디터 
						<input name="editmode10" onclick="setEditMode10('text');" type="radio" value="text">HTML 직접입력 
					</td>
					</tr>
					<tr>
						<td width="100%">
							<p align="center">
							<OBJECT id=editBox10 data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" align="center" height="35"><p align="center"><input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp; 
				<input class="aa" onclick='init_t()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="재입력"></td>
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
	
	$SQL = "update $User_GuideTable set question1 = '$question1', question2 = '$question2', question3 = '$question3', ".
	"question4 = '$question4', question5 = '$question5', question6 = '$question6', question7 = '$question7', ".
	"question8 = '$question8', question9 = '$question9', question10 = '$question10' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 
	
	$SQL = "update $User_GuideTable set answer1 = '$answer1' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	 
	$SQL = "update $User_GuideTable set answer2 = '$answer2' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer3 = '$answer3' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer4 = '$answer4' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer5 = '$answer5' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer6 = '$answer6' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer7 = '$answer7' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer8 = '$answer8' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer9 = '$answer9' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $User_GuideTable set answer10 = '$answer10' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL= user_guide.php'>";
}
elseif ($flag == "write") {
	$SQL = "insert into $User_GuideTable (mart_id, question1, answer1, question2, answer2, question3, answer3, ".
	"question4, answer4, question5, answer5, question6, answer6, question7, answer7, question8, answer8, ".
	"question9, answer9, question10, answer10) ".
	"values ('$mart_id', '$question1', '$answer1', '$question2', '$answer2', '$question3', '$answer3', ".
	"'$question4', '$answer4', '$question5', '$answer5', '$question6', '$answer6', '$question7', '$answer7', ".
	"'$question8', '$answer8', '$question9', '$answer9', '$question10', '$answer10')";
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=user_guide.php'>";
}?>	
<?
mysql_close($dbconn);
?>