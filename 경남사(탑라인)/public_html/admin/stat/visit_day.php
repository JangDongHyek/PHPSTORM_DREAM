<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
?>
<script>
function goto_byselect(sel, targetstr)
{
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
     if (targetstr == 'blank') {
       window.open(sel.options[index].value, 'win1');
     } else {
       var frameobj;
       if ((frameobj = eval(targetstr)) != null)
         frameobj.location = sel.options[index].value;
     }
  }
}
</script>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�湮��� > �Ϻ� �湮��Ȳ</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="90%" bgcolor="#FFFFFF" height="35">�� �湮�� ��踦 ���Ǻ��� �˻��Ͻ� �� �ֽ��ϴ�. ���Ǻ� ��踦 �̿��Ͽ� �̵��ϼ���.</td>
					</tr>
<?
$today_day = date("Ymd");
$today_month = date("Ym");

$SQL = "select * from $Mart_CounterTable where mart_id='$mart_id' and date='$today_day'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$counter_no = $ary["counter_no"];
	$count_num_day = $ary["count_num"];
}else{
	$count_num_day = 0;
}

$SQL = "select * from $Mart_CounterTable where mart_id='$mart_id' and substring(date,1,6)='$today_month'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$count_num_month = 0;
for($i = 0;$i < $numRows; $i++){
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$count_num = $ary["count_num"];
	$count_num_month += $count_num;
}

$SQL = "select * from $Mart_CounterTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$count_num_total = 0;
for($i = 0;$i < $numRows; $i++){
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$count_num = $ary["count_num"];
	$count_num_total += $count_num;
}
?>
				<tr>
					<td width="90%" bgcolor="#FFFFFF">
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<b>���� : <?=number_format($count_num_day)?>��&nbsp; |&nbsp;&nbsp; 
						�ݿ� : <?=number_format($count_num_month)?>��&nbsp; | 
						�ѹ湮�ڼ� : <?=number_format($count_num_total)?>��</b>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						
						<table border="0" width="320" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20"></td>
								<td width="300">
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%" bgcolor="#CCCCCC">
											
											<table border="0" width="100%" cellspacing="1" cellpadding="3">
												<tr>
												<td width="100%" bgcolor="#F7F7F7" height="20">
													
													<table border="0" width="100%" cellspacing="0" cellpadding="0">
														<tr>
															<td width="33%" height="25">���� �˻�</td>
															<td width="67%" height="25" align="right">
																<select onchange="goto_byselect(this, 'self')" size="1" style="height: 18px; border: 1px solid black">
																	<option value="visit_day.php" selected>�Ϻ� �湮��Ȳ</option>
																	<option value="visit_month.php">���� �湮��Ȳ</option>
																	<option value="visit_6month.php">�ֱ� 6������ �湮��Ȳ</option>
																</select>
															</td>
														</tr>
													</table>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
						</table><br>
						
						<table border="0" width="320" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20"></td>
								<td width="300">
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%" bgcolor="#7BBEBD">
											
											<table border="0" width="100%" cellspacing="1" cellpadding="3">
												<tr>
												<td width="100%" bgcolor="#E9F5F5" height="30">
													
													<table border="0" width="100%">
														<form method='post'>
														<input type='hidden' name='flag' value='search'>
<?
if($year == '') $year = date("Y");
if($month == '') $month = date("m");
?>			                 				
														<tr>
															<td width="50%">
																<select name="year" size="1" class="bb">
																<option value="2005" <?if($year == '2005') echo "selected"?>>2005</option>
																<option value="2006" <?if($year == '2006') echo "selected"?>>2006</option>
																<option value="2007" <?if($year == '2007') echo "selected"?>>2007</option>
																<option value="2008" <?if($year == '2008') echo "selected"?>>2008</option>
																<option value="2009" <?if($year == '2009') echo "selected"?>>2009</option>
																<option value="2010" <?if($year == '2010') echo "selected"?>>2010</option>
																<option value="2011" <?if($year == '2011') echo "selected"?>>2011</option>
																</select>�� 
																<select name='month' size="1" style="height: 18px; border: 1px solid black">
<?
for($i=1;$i<=12;$i++){
	if(strlen($i) == 1){
				$i_t = "0".$i;
	}else{
		$i_t = $i;
	}
?>
																	<option value='<?=$i_t?>' <?if($month == $i_t) echo " selected";?>><?=$i?>��</option>
<?
}
?>
																</select>&nbsp;
															</td>
															<td width="50%" align="right">
																<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="submit" value="�˻�">
															</td>
														</tr>
													</form>
													</table>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
<?
if($flag == "search"||$flag == ""){
?>						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="3">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><span class="bb"><b><font color="#FFFFFF">�Ϻ� �湮��Ȳ / <?=$year?>�� <?=$month?>��</font></b></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="18%" bgcolor="#FFFFFF" align="left"><span class="aa"><p align="center">����</td>
										<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa"><p align="center">�湮��</td>
										<td width="13%" bgcolor="#FFFFFF" align="center"><span class="aa">�׷���</td>
									</tr>
									
<?
//�״� ��ü �湮�� ���ϱ�
	$SQL = "select * from $Mart_CounterTable where mart_id='$mart_id' and substring(date,1,4) = '$year' and substring(date,5,2) = '$month'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$counter_total = 0;
	for($i=0; $i<$numRows ;$i++){
		mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$count_num_day = $ary["count_num"];
		$counter_total += $count_num_day;
	}
			
	// ���Ϻ� �湮�� ���ϱ�
	for($i = 1 ; $i <= 31 ; $i++){
		if(strlen($i) == 1){
			$i_t = "0".$i;
		}else{
			$i_t = $i;
		}
		$SQL = "select * from $Mart_CounterTable where mart_id='$mart_id' and substring(date,1,4) = '$year' and substring(date,5,2) = '$month' and substring(date,7,2) = '$i_t'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		
		if($numRows > 0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$counter_no = $ary["counter_no"];
			$count_num_day = $ary["count_num"];
		}else{
			$count_num_day = 0;	
		}
				
		if($counter_total == 0){
			$count_num_day_percent = 0;
			$count_num_day_graph = 0;
		}else{
			$count_num_day_percent = number_format($count_num_day / $counter_total * 100,2);
			$count_num_day_graph = number_format($count_num_day / $counter_total * 250);
		}
?>
									<tr height='25'>
										<td width='11%' align='center' bgcolor='#FFFFFF'><?=$i?>��</td>
										<td width='17% align='center' bgcolor='#FFFFFF'><?=$count_num_day?>��</td>
										<td width='72%' bgcolor='#FFFFFF'><img src='../images/graph1.gif' width='$count_num_day_graph' height='10'> <?=$count_num_day_percent?>%</td>
									</tr>
<?	
	}	
	$counter_ave = $counter_total / 31;
	$counter_ave = number_format($counter_ave,2);
	if($counter_total == 0){
		$counter_ave_percent = 0;
		$counter_ave_graph = 0;
	}else{
		$counter_ave_percent = number_format($counter_ave / $counter_total * 100,2);
		$counter_ave_graph = number_format($counter_ave / $counter_total * 250);;
	}
?>
									<tr height="25">
										<td width="16%" bgcolor="#FCB663" align="center"><b><font color="#FFFFFF">�հ�</font></b></td>
										<td width="18%" bgcolor="#FCB663" align="center"><b><font color="#FFFFFF"><?=number_format($counter_total)?>��</font></b></td>
										<td width="66%" bgcolor="#FCB663"><img src='../images/graph1.gif' width='250' height='10'> 100%</td>
									</tr>
									<tr height="25">
										<td width="16%" bgcolor="#FE9725" align="center"><b><font color="#FFFFFF">���</font></b></td>
										<td width="18%" bgcolor="#FE9725" align="center"><b><font color="#FFFFFF"><?=$counter_ave?>��</font></b></td>
										<td width="66%" height="25" bgcolor="#FE9725"><img src="../images/graph1.gif" width="<?=$counter_ave_graph?>" height="10"> <?=$counter_ave_percent?>%</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
<?
}
?>
					</td>
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