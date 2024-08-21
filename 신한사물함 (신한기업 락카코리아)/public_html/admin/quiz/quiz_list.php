<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == 'del'){
	$SQL = "delete from $QuizTable where quiz_no = $quiz_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	$SQL = "delete from $Quiz_ApplyTable where quiz_no = $quiz_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
if($flag == 'end'){
	$SQL = "update $QuizTable set if_end = 't' where quiz_no = $quiz_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
if($flag == 'resume'){
	$SQL = "update $QuizTable set if_end = 'f' where quiz_no = $quiz_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>
<script>
function del_quiz(quiz_no){
	if(confirm("삭제하시겠습니까?")){
		window.location.href = 'quiz_list.php?flag=del&quiz_no='+ quiz_no;
	}
	else return false;
}
</script>
</head>

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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>퀴즈</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td bgColor="#ffffff" vAlign="top" width="90%">퀴즈문제를 
					만들고 정답자에게 경품등을 줄 수 있는 이벤트를 만들고 관리하는 
					프로그램입니다. <br>
					퀴즈/응모 이벤트를 잘 활용하면 쇼핑몰의 방문자를 늘리거나 
					경품등을 활용한 고객접점을 만들 수 있습니다.
				</td>
				</tr>
				<tr>
				<td bgColor="#ffffff" height="3" vAlign="top" width="100%">
					
					<table border="0" width="100%">
						<tr>
							<td height="10" width="100%">
								<p align="left"><strong>&nbsp; [현재 진행되고 있는 퀴즈]</strong>
							</td>
						</tr>
					</table>
				</td>
				</tr>
				<tr align="center">
				<td bgColor="#ffffff" vAlign="top" width="100%">
					<div align="center"><center>
					
					<table border="0" width="97%">
						<tr>
							<td bgColor="#999999" width="100%">
							
								<table border="0" cellPadding="3" cellSpacing="1" width="100%">
								<tr>
									<td align="middle" bgColor="#C8DCA9" width="30%">제목</td>
									<td align="middle" bgColor="#C8DCA9" width="14%">응모기간</td>
									<td align="middle" bgColor="#C8DCA9" width="18%">결과보기</td>
								</tr>
								<?
								$today = date("Ymd");
								$SQL = "select * from $QuizTable where mart_id='$mart_id' and if_end = 'f'";
								//echo "sql=$SQL";
								$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							if($numRows == 0){
								echo ("
							<tr>
									<td align='left' bgColor='#ffffff' width='62%' colspan='3'>
										
										<p align='center'>진행되고 있는 퀴즈가 없습니다.
									</td>
								</tr>
									");
								}
								else{
									for ($i=0; $i < ($numRows); $i++) {
									mysql_data_seek($dbresult, $i);
									$ary=mysql_fetch_array($dbresult);
									$quiz_no = $ary["quiz_no"];
									$mart_id = $ary["mart_id"];
									$from_date = $ary["from_date"];
									$from_date_str = substr($from_date,0,4)."/".substr($from_date,4,2)."/".substr($from_date,6,2);
									$to_date = $ary["to_date"];
									$to_date_str =substr($to_date,4,2)."/".substr($to_date,6,2);
									$quiz_question = $ary["quiz_question"];
									$currect_answer_no = $ary["currect_answer_no"];
									$quiz_explain = $ary["quiz_explain"];
									$date = $ary["date"];
								
										echo ("
								
								<tr>
									<td align='left' bgColor='#ffffff' width='30%'>
										
										<a href='quiz_edit.php?quiz_no=$quiz_no'>
										$quiz_question</a>
										
									</td>
									<td align='middle' bgColor='#ffffff' width='14%'>
										$from_date_str~$to_date_str</td>
									<td align='middle' bgColor='#ffffff' width='18%'>
										<input onclick=\"window.location.href='quiz_apply_list.php?quiz_no=$quiz_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='결과보기'>
										<input onclick=\"window.location.href='quiz_list.php?flag=end&quiz_no=$quiz_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='마감'>
										<input onclick=\"return del_quiz('$quiz_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'>
									</td>
								</tr>
										");
									}
							
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
				<td bgColor="#ffffff" vAlign="top" width="100%">
					
					<table border="0" width="100%">
						<tr>
							<td width="97%">
								<strong>&nbsp;&nbsp; [지난 퀴즈 리스트] </strong>
							</td>
						</tr>
						<tr>
							<td bgColor="#ffffff" vAlign="top" width="100%">
								<div align="center"><center>
								
								<table border="0" width="97%">
								<tr>
									<td bgColor="#999999" width="100%">
										
										<table border="0" cellPadding="3" cellSpacing="1" width="100%">
									<tr>
											<td align="middle" bgColor="#C8DCA9" width="30%">
												제목</td>
											<td align="middle" bgColor="#C8DCA9" width="14%">
												응모기간</td>
											<td align="middle" bgColor="#C8DCA9" width="18%">
												관리</td>
											</tr>
											<?
											$SQL = "select * from $QuizTable where mart_id='$mart_id' and if_end = 't'";
										$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
									if($numRows == 0){
										echo ("
									<tr>
											<td align='left' bgColor='#ffffff' width='62%' colspan='3'>
												
												<p align='center'>지난 퀴즈가 없습니다.
											</td>
										</tr>
												");
										}
										else{
											for ($i=0; $i < ($numRows); $i++) {
											mysql_data_seek($dbresult, $i);
											$ary=mysql_fetch_array($dbresult);
											$quiz_no = $ary["quiz_no"];
											$mart_id = $ary["mart_id"];
											$from_date = $ary["from_date"];
											$from_date_str = substr($from_date,0,4)."/".substr($from_date,4,2)."/".substr($from_date,6,2);
											$to_date = $ary["to_date"];
											$to_date_str =substr($to_date,4,2)."/".substr($to_date,6,2);
											$quiz_question = $ary["quiz_question"];
											$currect_answer_no = $ary["currect_answer_no"];
											$explain = $ary["explain"];
											$date = $ary["date"];
								
												echo ("
										<tr>
											<td align='left' bgColor='#ffffff' width='30%'>
												
												<a href='quiz_edit.php?quiz_no=$quiz_no'>
												$quiz_question</a></td>
											<td align='middle' bgColor='#ffffff' width='14%'>
												$from_date_str~$to_date_str</td>
											<td align='middle' bgColor='#ffffff' width='18%'>
												<input onclick=\"window.location.href='past_quiz_win_list?&quiz_no=$quiz_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='결과보기'>
												<input onclick=\"window.location.href='quiz_list.php?flag=resume&quiz_no=$quiz_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='복원'>
												<input onclick=\"return del_quiz('$quiz_no')\"  style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'>
											</td>
											</tr>
													");
												}
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
							<td bgColor="#ffffff" vAlign="top" width="100%">
								<p align="left"><strong>&nbsp;&nbsp; [퀴즈 등록]<br></strong>
								<font color="#000000">&nbsp;&nbsp;&nbsp; 새로운 퀴즈를 만드시려면&nbsp; 
								
								<input onclick="window.location.href='quiz_write.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="퀴즈등록"> 을 
								눌러주세요 </font></td>
						</tr>
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
mysql_close($dbconn);
?>