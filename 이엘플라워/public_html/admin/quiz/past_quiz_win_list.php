<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
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
					<td bgColor="#FFFFFF" align="center" width="100%" height="35"><strong>&nbsp; [지난 퀴즈응모 결과 및 당첨자 확인]</td>
					</tr>
				<?
				$SQL = "select * from $QuizTable where mart_id='$mart_id' and quiz_no = '$quiz_no'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				if($numRows > 0){
					mysql_data_seek($dbresult, 0);
					$ary=mysql_fetch_array($dbresult);
					$quiz_no = $ary["quiz_no"];
					$mart_id = $ary["mart_id"];
					$from_date = $ary["from_date"];
					$to_date = $ary["to_date"];
					$quiz_question = $ary["quiz_question"];
					$correct_answer_no = $ary["correct_answer_no"];
					$quiz_explain = $ary["quiz_explain"];
					$date = $ary["date"];
					$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
				}
				
				$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no'";
				//echo "sql=$SQL";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				?>	
				<tr align="center">
					<td bgColor="#ffffff" vAlign="top" width="100%">
						<div align="center"><center>
						
						<table border="0" width="97%">
							<tr>
								<td bgColor="#999999" width="100%">
									<table border="0" cellPadding="3" cellSpacing="1" width="100%">
									<tr>
										<td align="middle" bgColor="#C8DCA9" width="5%">
											<p align="center">문 제</td>
										<td align="middle" bgColor="#FFFFFF" width="62%" colspan="2">
											<p align="left">
											<?echo $quiz_question?></td>
									</tr>
									<tr>
										<td align="middle" bgColor="#C8DCA9" width="5%">
											
											<p align="center">정 답</td>
										<td align="left" bgColor="#FFFFFF" width="62%" colspan="2">
											<?echo $correct_answer_no?>번</td>
									</tr>
									<tr>
										<td align="middle" bgColor="#C8DCA9" width="5%">
											
											<p align="center">총응모자</td>
										<td align="left" bgColor="#FFFFFF" width="62%" colspan="2">
											<?echo $numRows?>명</td>
									</tr>
									<tr>
										<td align="center" bgColor="#C8DCA9" width="67%" colspan="3">
											당첨자</td>
									</tr>
									<tr>
										<td align="center" bgColor="#94C652" width="13%"><strong>번호</strong></td>
										<td align="center" bgColor="#94C652" width="13%"><strong>ID</strong></td>
										<td align="center" bgColor="#94C652" width="21%"><strong>이름</strong></td>
									</tr>
									<?
								if($numRows > 0){
									mysql_data_seek($dbresult, 0);
									$ary=mysql_fetch_array($dbresult);
									$quiz_no = $ary["quiz_no"];
									$quiz_apply_no = $ary["quiz_no"];
									$mart_id = $ary["quiz_no"];
									$quiz_no = $ary["quiz_no"];
									$answer_no = $ary["quiz_no"];
									$username = $ary["quiz_no"];
									$name = $ary["quiz_no"];
									$if_win = $ary["quiz_no"];
									$date = $ary["quiz_no"];
									
									$j = $i + 1;
									echo ("
								<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>$j</td>
										<td align='center' bgColor='#ffffff' width='21%'>$username</td>
										<td align='center' bgColor='#ffffff' width='21%'>$name</td>
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
					<td bgColor="#ffffff" width="100%" height="27" align="center">
						<input onclick="window.location.href='quiz_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="첫화면"> 
						<input onclick="window.location.href='quiz.html'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="이전화면">
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