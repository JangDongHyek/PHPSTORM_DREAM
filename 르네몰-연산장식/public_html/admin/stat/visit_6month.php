<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
?>

<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
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
			<!--왼쪽부분시작-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>방문통계 > 최근 6개월간 방문현황</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="90%" bgcolor="#FFFFFF" height="35">총 방문한 통계를 조건별로 검색하실 수 있습니다. 조건별 통계를 이용하여 이동하세요.</td>
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
						<b>오늘 : <?=number_format($count_num_day)?>명&nbsp; |&nbsp;&nbsp; 
						금월 : <?=number_format($count_num_month)?>명&nbsp; | 
						총방문자수 : <?=number_format($count_num_total)?>명</b></td>
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
															<td width="33%" height="25">조건 검색</td>
															<td width="67%" height="25"><p align="right">
																<select class="bb" onchange="goto_byselect(this, 'self')" size="1" style="height: 18px; border: 1px solid black">
																	<option value="visit_day.php">일별 방문현황</option>
																	<option value="visit_month.php">월별 방문현황</option>
																	<option value="visit_6month.php" selected>최근 6개월간 방문현황</option>
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
						</table>
						<br>
						<table border="0" width="320" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20"></td>
								<td width="300">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%" bgcolor="#7BBEBD">
											<table border="0" width="100%" cellspacing="1" cellpadding="3">
												<form method='post'>
												<input type='hidden' name='flag' value='search'>
												<tr>
												<td width="100%" bgcolor="#E9F5F5" height="30">
													<table border="0" width="100%">
														<tr>
															<td width="50%">최근 6개월간 방문현황</td>
															<td width="50%" align="right">
																<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="submit" value="검색">
															</td>
														</tr>
													</table>
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
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
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
												<td width="50%"><span class="bb"><b><font color="#FFFFFF">검색결과 : 최근 6개월간 
													방문현황</font></b></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr align="center">
										<td width="18%" bgcolor="#FFFFFF">월</td>
										<td width="22%" bgcolor="#FFFFFF">방문수</td>
										<td width="13%" bgcolor="#FFFFFF">그래프</td>
									</tr>
<?
	$current_year = date("Y");
	$current_month = date("n");
	if($current_month < 6){
		$start_year = $current_year - 1;
		$start_month = 12 + $current_month - 5;
	}else{
		$start_year = $current_year;
		$start_month = $current_month - 5;
	}

	$counter_total = 0;
	$turn = 0;
	for($i = $start_month ; ; $i++){
		if($i == 13) {
			$i = 1;
			$start_year++;
		}	
		$turn++;
		if($turn > 6) break;

		if(strlen($i) == 1){
			$i_t = "0".$i;
		}else{
			$i_t = $i;
		}

		$SQL = "select * from $Mart_CounterTable where mart_id='$mart_id' and substring(date,1,4) = '$start_year' and substring(date,5,2) = '$i_t'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		$counter_month = 0;
		for($j = 0;$j < $numRows; $j++){
			mysql_data_seek($dbresult,$j);
			$ary = mysql_fetch_array($dbresult);
			$count_num = $ary["count_num"];
			$counter_month += $count_num;
		}
		$counter_total += $counter_month;
	}
	
	$current_year = date("Y");
	$current_month = date("n");
	if($current_month < 6){
		$start_year = $current_year - 1;
		$start_month = 12 + $current_month - 5;
	}else{
		$start_year = $current_year;
		$start_month = $current_month - 5;
	}

	$turn = 0;
	for($i = $start_month ; ; $i++){
		if($i == 13) {
			$i = 1;
			$start_year++;
		}	
		$turn++;
		if($turn > 6) break;
		
		if(strlen($i) == 1){
			$i_t = "0".$i;
		}else{
			$i_t = $i;
		}
		
		$SQL = "select * from $Mart_CounterTable where mart_id='$mart_id' and substring(date,1,4) = '$start_year' and substring(date,5,2) = '$i_t'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		$counter_month = 0;
		for($j = 0;$j < $numRows; $j++){
			mysql_data_seek($dbresult,$j);
			$ary = mysql_fetch_array($dbresult);
			$count_num = $ary["count_num"];
			$counter_month += $count_num;
		}
	
		if($counter_total == 0){
			$counter_month_percent = 0;
			$counter_month_graph = 0; 
		}else{
			$counter_month_percent = number_format($counter_month / $counter_total * 100,2);
			$counter_month_graph = number_format($counter_month / $counter_total * 250);
		}

		$counter_month = number_format($counter_month);
?>
									<tr height='25' align='center'>
										<td width='11%' bgcolor='#FFFFFF'><?=$i?>월</td>
										<td width='17%' bgcolor='#FFFFFF'><?=$counter_month?>명</td>
										<td width='72%' align='left' bgcolor='#FFFFFF'><img src='../images/graph1.gif' width='$counter_month_graph' height='10'> <?=$counter_month_percent?>%</td>
									</tr>
<?
	}
	
	$counter_ave = $counter_total / 6;
	if($counter_total == 0){
		$counter_ave_percent = 0;
		$counter_ave_graph = 0;
	}else{
		$counter_ave_percent = number_format($counter_ave / $counter_total * 100,2);
		$counter_ave_graph = number_format($counter_ave / $counter_total * 250);
	}
?>
									<tr height="25" align="center">
										<td width="16%" bgcolor="#FCB663"><b><font color="#FFFFFF">합계</font></b></td>
										<td width="18%" bgcolor="#FCB663"><b><font color="#FFFFFF"><?=number_format($counter_total)?>명</font></b></td>
										<td width="66%" bgcolor="#FCB663" align="left"><img src='../images/graph1.gif' width='250' height='10'> 100 %</td>
									</tr>
									<tr height="25" align="center">
										<td bgcolor="#FE9725"><b><font color="#FFFFFF">평균</font></b></td>
										<td bgcolor="#FE9725"><b><font color="#FFFFFF"><?=number_format($counter_ave,2)?> 명</font></b></td>
										<td bgcolor="#FE9725" align="left"><img src="../images/graph1.gif" width="<?=$counter_ave_graph?>" height="10"> <?=$counter_ave_percent?>%</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
<?
}
?>
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