<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == "confirm"){
	$SQL = "update $Quiz_ApplyTable set if_win = 't' where quiz_apply_no = '$quiz_apply_no'";
	$dbresult = mysql_query($SQL, $dbconn);
}
if($flag == "cancel"){
	$SQL = "update $Quiz_ApplyTable set if_win = 'f' where quiz_apply_no = '$quiz_apply_no'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>

<body bgColor="#ffffff" leftMargin="0" topMargin="0">
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
					<td bgColor="#ffffff" width="90%">���� 
						��� ������ ������ ����Ʈ�Դϴ�. <br>
						������ �������� ��÷��ư�� Ŭ���Ͻø� �Ʒ� ��÷��ID����Ʈ�� 
						���ԵǸ�, �� ��÷�ڰ� �˴ϴ�.<br>
						��, ������ ��÷�ڿ� ���� ��÷��Ҹ� �Ҷ� ��÷��� ��ư�� 
						�����ø� �˴ϴ�.<br>
						��÷��ҹ�ư�� ��÷��ư�� Ŭ���� ��󿡸� ��µ˴ϴ�.
					</td>
					</tr>
					<tr>
					<td bgColor="#ffffff" height="3" vAlign="top" width="100%">
						<table border="0" width="100%">
							<tr>
								<td height="10" width="100%"><p align="left"><strong>&nbsp; [�������� ������ Ȯ��]</strong></td>
							</tr>
						</table>
					</td>
					</tr>
					<tr align="center">
					<td bgColor="#ffffff" vAlign="top" width="100%">
						<div align="center"><center>
						
						<table border="0" width="97%">
							<?
							$SQL = "select * from $QuizTable where mart_id='$mart_id' and quiz_no = $quiz_no";
							//echo "sql=$SQL";
							$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						if($numRows > 0){
							mysql_data_seek($dbresult, 0);
							$ary=mysql_fetch_array($dbresult);
							$quiz_no = $ary["quiz_no"];
							$quiz_question = $ary["quiz_question"];
							$correct_answer_no = $ary["correct_answer_no"];
							$quiz_explain = $ary["quiz_explain"];
						}
						?>
						<tr>
								<td bgColor="#999999" width="100%">
									<table border="0" cellPadding="3" cellSpacing="1" width="100%">
									<tr>
										<td align="middle" bgColor="#C8DCA9" width="5%">
											<p align="center">����</td>
										<td align="middle" bgColor="#FFFFFF" width="62%" colspan="3">
											<p align="left">
											<?echo $quiz_question?></td>
									</tr>
									<tr>
										<td align="center" bgColor="#94C652" width="13%">
											<strong>
											��ȣ</strong></td>
										<td align="center" bgColor="#94C652" width="13%">
											<strong>
											<a href='quiz_win_list.php?quiz_no=<?echo $quiz_no?>&order=username'>ID</a>
											</strong></td>
										<td align="center" bgColor="#94C652" width="21%">
											<strong>
											<a href='quiz_win_list.php?quiz_no=<?echo $quiz_no?>&order=name'>�̸�</a>
											</strong></td>
										<td align="center" bgColor="#94C652" width="20%">
											<strong>
											<a href='quiz_win_list.php?quiz_no=<?echo $quiz_no?>&order=if_win'>��÷�� �����ϱ�</a>
											</strong>
										</td>
									</tr>
								<?
								if($order == ""){
									$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '$correct_answer_no' order by quiz_apply_no desc";
									}
									else if($order == "if_win"){
										$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '$correct_answer_no' order by $order desc";
									}
									else{
										$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '$correct_answer_no' order by $order";
									}
									
									//echo "sql=$SQL";
									$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if ($cnfPagecount == "") $cnfPagecount = 10;
								if ($page == "") $page = 1;
								$skipNum = ($page - 1) * $cnfPagecount;
								
								$prev_page = $page - 1;
								$next_page = $page + 1;
								
								$total_page = ($numRows - 1) / $cnfPagecount;
								$total_page = intval($total_page)+1;
								
								if($page % 10 == 0)
								$start_page = $page - 9;
								else
								$start_page = $page - ($page % 10) + 1;
								
								$end_page = $start_page + 9;
								if($end_page >= $total_page)
									$end_page = $total_page;
								$prev_start_page = $start_page - 10;
								$next_start_page = $start_page + 10;
					
					
					
								for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
									if ($i >= $numRows) break;
									mysql_data_seek($dbresult, $i);
									$ary=mysql_fetch_array($dbresult);
									$quiz_apply_no = $ary["quiz_apply_no"];
									$mart_id = $ary["mart_id"];
									$quiz_no = $ary["quiz_no"];
									$answer_no = $ary["answer_no"];
									$username = $ary["username"];
									$name = $ary["name"];
									$if_win = $ary["if_win"];
									$j = $i + 1;
									
									if($if_win != 't'){
										echo("
											
									<tr>
										<td align='center' bgColor='#C8DCA9' width='5%'>$j</td>
										<td align='center' bgColor='#ffffff' width='21%'>$username</td>
										<td align='center' bgColor='#ffffff' width='21%'>$name</td>
										<td align='center' bgColor='#ffffff' width='20%'>
											<input onclick=\"window.location.href='quiz_win_list.php?flag=confirm&quiz_no=$quiz_no&quiz_apply_no=$quiz_apply_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='��÷'>
										</td>
									</tr>
										");
										}
										if($if_win == 't'){
										echo("
								<tr>
										<td align='center' bgColor='#E6E6E6' width='5%'>$j</td>
										<td align='center' bgColor='#E6E6E6' width='21%'>$username</td>
										<td align='center' bgColor='#E6E6E6' width='21%'>$name</td>
										<td align='center' bgColor='#E6E6E6' width='20%'>
											<strong>
											<font color='#0000FF'>��÷�� </font></strong>
											<input onclick=\"window.location.href='quiz_win_list.php?flag=cancel&quiz_no=$quiz_no&quiz_apply_no=$quiz_apply_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='��÷���'>
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
					<td height="10" width="100%">
						<p align="right">
						
						<?
						if($page == 1){
							echo ("
							ó��
							");
						}
						else{
							echo ("
							<a href='quiz_win_list.php?quiz_no=$quiz_no&page=1'>ó��</a> 
							");
						}
					
						if($start_page > 1){
							echo ("
							<a href='quiz_win_list.php?quiz_no=$quiz_no&page=$prev_start_page'>
							��&nbsp; 
							</a>
							");
						}
						else{
							echo ("
							��&nbsp; 
							");
						}
						for($i=$start_page;$i<=$end_page;$i++){
							if($i == $page){
								echo ("	
								[<b>$i</b>]
								");
							}
							else{
								echo ("
							<a href='quiz_win_list.php?quiz_no=$quiz_no&page=$i'>$i</a> 
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='quiz_win_list.php?quiz_no=$quiz_no&page=$next_start_page'>
							&nbsp;��
							</a>
							");
						}
						else{
							echo ("
							&nbsp;��
							");
						}
						if($page == $total_page){
							echo ("
							��
							");
						}
						else{
							echo ("
							<a href='quiz_win_list.php?quiz_no=$quiz_no&page=$total_page'>��</a> 
							");
						}
						?>
						
					</td>
					</tr>
					<?
					$SQL = "select * from $Quiz_ApplyTable where mart_id='$mart_id' and quiz_no = '$quiz_no' and answer_no = '$correct_answer_no' and if_win = 't'";
					//echo "sql=$SQL";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				?>
				<tr>
					<td bgColor="#ffffff" vAlign="top" width="100%">
						<p align="center"><strong>
						 
						&nbsp; ������ �� ��÷�ڼ�: <?echo $numRows?> ��&nbsp;&nbsp; </strong>
					</td>
					</tr>
					<tr>
						<td bgColor="#ffffff" align="center" width="100%">
							<input onclick="window.location.href='quiz_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="ùȭ��"> 
							<input onclick="window.location.href='quiz_apply_list.php?quiz_no=<?echo $quiz_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����ȭ��">
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
mysql_close($dbconn);
?>