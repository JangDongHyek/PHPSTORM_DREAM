<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
?>

<body bgColor="#ffffff" leftMargin="0" topMargin="0">
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
					<td bgColor="#ffffff" vAlign="top" width="90%">현재 
						퀴즈에 응모한 현황을 보실 수 있으며 보기 중 정답의 우측에 
						정답자확인을 누르시면<br>
						정답자 응모현황을 확인하실 수 있습니다.
					</td>
					</tr>

					<tr>
					<td bgColor="#ffffff" height="3" vAlign="top" width="100%">
					
						<table border="0" width="100%">
							<tr>
								<td height="10" width="100%" align="left"><strong>&nbsp; [퀴즈응모 결과보기]</strong>
								</td>
							</tr>
						</table>
					</td>
					</tr>
					<tr align="center">
					<td bgColor="#ffffff" vAlign="top" width="100%">
						<div align="center"><center>
						
						<table border="0" width="97%">
							<?
							$SQL = "select * from $QuizTable where quiz_no = $quiz_no and mart_id='$mart_id'";
							$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							if($numRows > 0){
								mysql_data_seek($dbresult,0);
								$ary = mysql_fetch_array($dbresult);
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
								
								$answer1_num = $ary["answer1_num"];
								$answer2_num = $ary["answer2_num"];
								$answer3_num = $ary["answer3_num"];
								$answer4_num = $ary["answer4_num"];
								$answer5_num = $ary["answer5_num"];
								$answer6_num = $ary["answer6_num"];
								$answer7_num = $ary["answer7_num"];
								$answer8_num = $ary["answer8_num"];
								$answer9_num = $ary["answer9_num"];
								
								$correct_answer_button1 = "";
								$correct_answer_button2 = "";
								$correct_answer_button3 = "";
								$correct_answer_button4 = "";
								$correct_answer_button5 = "";
								$correct_answer_button6 = "";
								$correct_answer_button7 = "";
								$correct_answer_button8 = "";
								$correct_answer_button9 = "";
								
								if($correct_answer_no == 1)
								$correct_answer_button1 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 2)
								$correct_answer_button2 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 3)
								$correct_answer_button3 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 4)
								$correct_answer_button4 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 5)
								$correct_answer_button5 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 6)
								$correct_answer_button6 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 7)
								$correct_answer_button7 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 8)
								$correct_answer_button8 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								if($correct_answer_no == 9)
								$correct_answer_button9 = "<input onclick=\"window.location.href='quiz_win_list.php?quiz_no=$quiz_no&correct_answer_no=$correct_answer_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='정답자확인'>"; 
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '1'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer1_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '2'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer2_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '3'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer3_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '4'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer4_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '5'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer5_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '6'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer6_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '7'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer7_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '8'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer8_num = mysql_num_rows($dbresult);
								
								$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '9'";
								$dbresult = mysql_query($SQL, $dbconn);
								$answer9_num = mysql_num_rows($dbresult);
								
							}
							?>
							<tr>
								<td bgColor="#999999" width="100%">
									
									<table border="0" cellPadding="3" cellSpacing="1" width="100%">
									<tr>
										<td align="middle" bgColor="#C8DCA9" width="5%">
											<p align="center">
											문제
										</td>
										<td align="middle" bgColor="#FFFFFF" width="62%" colspan="3">
											<p align="left">
											
											<?echo $quiz_question?>
											
										</td>
									</tr>
									<tr>
										<td align="center" bgColor="#C8DCA9" width="26%" colspan="2">
											보기</td>
										<td align="center" bgColor="#C8DCA9" width="21%">
											응모수</td>
										<td align="center" bgColor="#C8DCA9" width="20%">
											정답자확인</td>
									</tr>
									<?
									if($answer1 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											1</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer1</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer1_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button1
										</td>
									</tr>
										");
									}
									if($answer2 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											2</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer2</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer2_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button2
										</td>
									</tr>
										");
									}
									if($answer3 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											3</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer3</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer3_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button3
										</td>
									</tr>
										");
									}
									if($answer4 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											4</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer4</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer4_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button4
										</td>
									</tr>
										");
									}
									if($answer5 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											5</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer5</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer5_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button5
										</td>
									</tr>
										");
									}
									if($answer6 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											6</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer6</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer6_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button6
										</td>
									</tr>
										");
									}
									if($answer7 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											7</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer7</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer7_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button7
										</td>
									</tr>
										");
									}
									if($answer8 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											8</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer8</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer8_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button8
										</td>
									</tr>
										");
									}
									if($answer9 != ""){
										echo ("
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>
											9</td>
										<td align='left' bgColor='#ffffff' width='21%'>
											$answer9</td>
										<td align='center' bgColor='#ffffff' width='21%'>
											$answer9_num</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											$correct_answer_button9
										</td>
									</tr>
										");
									}
									?>
									
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
				</tr>
					<tr>
					<td bgColor="#ffffff" align="center" width="100%" height="35"><p align="center">
						<input onclick="window.location.href='quiz_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로">
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
mysql_close($dbconn);
?>