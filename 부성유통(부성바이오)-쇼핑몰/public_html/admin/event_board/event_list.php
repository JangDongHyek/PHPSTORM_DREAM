<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){

	$SQL = "select userfile, userfile1 from $EventboardTable where event_no = $event_no and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$userfile = mysql_result($dbresult,0,0);
	$userfile1 = mysql_result($dbresult,0,1);

	$upload = "$DownRoot";//첨부파일 경로
	if( $userfile ){ //해당번호에 파일이 있다면 파일을 삭제함
		$desc = "{$upload}{$userfile}";
		unlink($desc);
	}
	if( $userfile1 ){ //해당번호에 파일이 있다면 파일을 삭제함
		$desc1 = "{$upload}{$userfile1}";
		unlink($desc1);
	}

	//글 삭제
	$SQL = "delete from $EventboardTable where event_no = $event_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script>
function del(event_no){
	if(confirm("삭제하시겠습니까?")){
		window.location.href = 'event_list.php?flag=del&event_no='+event_no;
	}
	else return;
}
</script>
</head>

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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>이벤트 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>     
					<td width="90%" bgcolor="#FFFFFF" valign="top"><br>     
						<p style="padding-left: 10px"><span class="aa">[이벤트 관리]</span>
					</td>    
				</tr>    
   
				<tr>   
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						<table border="0" width="100%">   
							<tr>   
								<td width="100%" height="20"></td>   
							</tr>     
<?
$SQL = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_gnt_item = $ary["if_gnt_item"]; //0:일반상점 1:공급상점 2:판매상점
	$provider_id = $ary["provider_id"]; //공급받을곳 mart_id
}
?>  
<?
$SQL = "select * from $EventboardTable where mart_id='$mart_id' order by event_no desc";
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
?>				
							<tr>  
								<td width="100%" bgcolor="#FFFFFF">
									<p style="padding-left: 20px">
									<span class="aa">
<?
if($page == 1){
	echo ("
	처음
	");
}
else{
	echo ("
	<a href='event_list.php?page=1'>처음</a> 
	");
}

if($start_page > 1){
	echo ("
	<a href='event_list.php?page=$prev_start_page'>
	◁&nbsp; 
	</a>
	");
}
else{
	echo ("
	◁&nbsp; 
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
	<a href='event_list.php?page=$i'>$i</a> 
		");
	}
}
if($end_page < $total_page){
	echo ("
	<a href='event_list.php?page=$next_start_page'>
	&nbsp;▷
	</a>
	");
}
else{
	echo ("
	&nbsp;▷
	");
}
if($page == $total_page){
	echo ("
	끝
	");
}
else{
	echo ("
	<a href='event_list.php?page=$total_page'>끝</a> 
	");
}
?>      
									</span>
								</td>     
							</tr>     
						</table>  
					</td>  
				</tr>   
				<tr>  
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="97%">  
							<tr>  
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">  
									<tr>  
										<td bgcolor="#8FBECD" align="center">
											<b><span class="dd">제목</span></b></td>  
										<td bgcolor="#8FBECD" align="center">
											<b><span class="dd">이벤트대상</span></b></td>  
										<td bgcolor="#8FBECD" align="center">
											<b><span class="dd">이벤트기간</span></b></td>  
		<!-- 								<td bgcolor="#8FBECD" align="center">
											<b><span class="dd">새창여부</span></b></td>   -->
										<td bgcolor="#8FBECD" align="center">
											<b><span class="dd">리스트출력</span></b></td>  
										<td bgcolor="#8FBECD" align="center">
											<b><span class="dd">등록일</span></b></td>  
										<td bgcolor="#8FBECD" align="center">
											<b><span class="dd">관리</span></b></td>  
									</tr>  
<?
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$event_no = $ary["event_no"];
	$title = $ary["title"];
	$title1 = $ary["title1"];
	$write_date = substr($ary["write_date"],0,10);
	$from_date = $ary["from_date"];
	$to_date = $ary["to_date"];
	$content = $ary["content"];
	$readnum = $ary["readnum"];
	$open_win = $ary["open_win"];
	$list_chk = $ary["list_chk"];
	$start_date = $ary["start_date"];
	$end_date = $ary["end_date"];
	$msg_head = $ary["msg_head"];
	
	if($open_win=="Y"){
		$open_win_str = "<font color='#6666FF'>예</font>";
	}else{
		$open_win_str = "<font color='#FF6666'>아니오</font>";
	}

	if($list_chk=="Y"){
		$list_chk_str = "<font color='#6666FF'>예</font>";
	}else{
		$list_chk_str = "<font color='#FF6666'>아니오</font>";
	}
	$this_date = date("Y-m-d");
	if($this_date >= $start_date && $this_date <= $end_date){
		$date_str =  "<font color='#00CC00'>$start_date ~ $end_date</font>";
	}else{
		$date_str =  "<font color='#FF6600'>$start_date ~ $end_date</font";
	}

	echo ("	
									<tr>  
										<td bgcolor='#FFFFFF' align='center'>
											<span class='aa'><a href='event_edit.php?event_no=$event_no'>$title</a></span></td>  
										<td bgcolor='#FFFFFF' align='center'>
											<span class='aa'>$title1</span></td>  
										<td bgcolor='#FFFFFF' align='center'>
											<span class='aa'>$date_str</span></td>  
		<!-- 								<td bgcolor='#FFFFFF' align='center'>
											<span class='aa'>$open_win_str</span></td>   -->
										<td bgcolor='#FFFFFF' align='center'>
											<span class='aa'>$list_chk_str</span></td>  
										<td bgcolor='#FFFFFF' align='center'>
											<span class='aa'>$write_date</span></td>  
										<td bgcolor='#FFFFFF' align='center'><input class='aa' onclick=\"window.location.href='event_edit.php?event_no=$event_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'><input class='aa' onclick=\"del('$event_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'></td>  
									</tr>  
	");
}
?>
								</table>  
							</td>  
						</tr>  
					</table>  
				</td>  
			</tr>   
			<tr>  
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br> 
					<input class="aa" onclick="window.location.href='event_write.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="이벤트 등록">
					</p>
				</td>
			</tr>
		</table>
       
<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table> 
</body>        
</html>
<?
mysql_close($dbconn);
?>