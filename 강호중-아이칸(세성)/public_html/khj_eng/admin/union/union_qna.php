<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $Union_QnaTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$question1 = $ary["question1"];
		$answer1 = $ary["answer1"];
		$question2 = $ary["question2"];
		$answer2 = $ary["answer2"];
		$question3 = $ary["question3"];
		$answer3 = $ary["answer3"];
		$question4 = $ary["question4"];
		$answer4 = $ary["answer4"];
		$question5 = $ary["question5"];
		$answer5 = $ary["answer5"];
		$question6 = $ary["question6"];
		$answer6 = $ary["answer6"];
		$question7 = $ary["question7"];
		$answer7 = $ary["answer7"];
		$question8 = $ary["question8"];
		$answer8 = $ary["answer8"];
		$question9 = $ary["question9"];
		$answer9 = $ary["answer9"];
		$question10 = $ary["question10"];
		$answer10 = $ary["answer10"];
	}
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>공동구매이용안내관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">공동구매 이용안내를 
						설정합니다. 기본으로 설정되어있는 내용을 참고하시고, 추가/수정하시면 
						됩니다.</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#B584C6" colspan="3">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">&nbsp; <strong>공동구매 이용안내 </strong></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center" colspan="2">
											번호</td>
										<td width="80%" bgcolor="#DDC5E4" align="left">
											<p align="center">
											내용</td>
									</tr>
									
									<form name='f' method=post>
								<input type="hidden" name="flag" value="update" >

								<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											1</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="left">
											<input name="question1" size="80" value='<?echo $question1?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A</td>
										<td width="85%" bgcolor="#FFFFFF" align="left">
											<textarea cols="95" name="answer1" rows="4" class="input_03"><?echo $answer1?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">2</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="left">
											<input name="question2" size="80" value='<?echo $question2?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A</td>
										<td width="85%" bgcolor="#FFFFFF" align="left">
											<textarea cols="95" name="answer2" rows="4" class="input_03"><?echo $answer2?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">3</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="left">
											<input name="question3" size="80" value='<?echo $question3?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A</td>
										<td width="85%" bgcolor="#FFFFFF" align="left">
											<textarea cols="95" name="answer3" rows="4" class="input_03"><?echo $answer3?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											4</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="question4" size="80" value='<?echo $question4?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A<strong>
										</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<textarea cols="95" name="answer4" rows="4" class="input_03"><?echo $answer4?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											5</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="question5" size="80" value='<?echo $question5?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A<strong>
										</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<textarea cols="95" name="answer5" rows="4" class="input_03"><?echo $answer5?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											6</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="question6" size="80" value='<?echo $question6?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A
										</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<textarea cols="95" name="answer6" rows="4" class="input_03"><?echo $answer6?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											7</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="question7" size="80" value='<?echo $question7?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A<strong>
										</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<textarea cols="95" name="answer7" rows="4" class="input_03"><?echo $answer7?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											8</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="question8" size="80" value='<?echo $question8?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A<strong>
										</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<textarea cols="95" name="answer8" rows="4" class="input_03"><?echo $answer8?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											9</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="question9" size="80" value='<?echo $question9?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A<strong>
										</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<textarea cols="95" name="answer9" rows="4" class="input_03"><?echo $answer9?></textarea>
										</td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center" rowspan="2">
											10</td>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											Q</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<input name="question10" size="80" value='<?echo $question10?>' class="input_03">
										</td>
									</tr>
									<tr>
										<td width="10%" bgcolor="#EBDEEF" align="center">
											A
										</td>
										<td width="85%" bgcolor="#FFFFFF" align="center">
											<p align="left">
											<textarea cols="95" name="answer10" rows="4" class="input_03"><?echo $answer10?></textarea>
										</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center"><strong>
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="submit" value="완료">&nbsp;
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="reset" value="재입력">&nbsp;
						</strong>
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
	$SQL = "select * from $Union_QnaTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows == 0){
		$SQL = "insert into $Union_QnaTable (mart_id, question1, answer1, question2, answer2, question3, answer3, question4, answer4, question5, answer5, question6, answer6, question7, answer7, question8, answer8, question9, answer9, question10, answer10) values ('$mart_id', '$question1', '$answer1', '$question2', '$answer2', '$question3', '$answer3', '$question4', '$answer4', '$question5', '$answer5', '$question6', '$answer6', '$question7', '$answer7', '$question8', '$answer8', '$question9', '$answer9', '$question10', '$answer10')";
	}else{
		$SQL = "update $Union_QnaTable set question1 = '$question1', answer1 = '$answer1', question2 = '$question2', answer2 = '$answer2', question3 = '$question3', answer3 = '$answer3', question4 = '$question4', answer4 = '$answer4', question5 = '$question5', answer5 = '$answer5', question6 = '$question6', answer6 = '$answer6', question7 = '$question7', answer7 = '$answer7', question8 = '$question8', answer8 = '$answer8', question9 = '$question9', answer9 = '$answer9', question10 = '$question10', answer10 = '$answer10' where mart_id='$mart_id'";
	}
	
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=union_qna.php'>";
}
?>	
<?
mysql_close($dbconn);
?>