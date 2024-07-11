<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){
	$SQL = "select * from $CatalogTable where catalog_no = $catalog_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$img = $ary["img"];
		if(file_exists("$Co_img_UP$mart_id/$img") && $img != '')
			unlink("$Co_img_UP$mart_id/$img");
	}
	
	$SQL = "delete from $CatalogTable where catalog_no = $catalog_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$flag = '';
}

if($flag == ""){
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$if_catalog = $ary["if_catalog"];
	}
	
	$SQL = "select * from $Catalog_ConfTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$catalog_name = $ary["catalog_name"];
	}

	include "../admin_head.php";
?>
<script>
function del(catalog_no){
	if(confirm("삭제하시겠습니까?")){
		window.location.href = 'catalog_list.php?flag=del&catalog_no='+catalog_no;
	}
	else return;
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>카탈로그</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">온라인 카탈로그는 갤러리, 앨범, 
					상품 카탈로그, 슬라이드 강좌등으로 이용이 가능한 
					프로그램입니다. <br>
					<br>
					예를들어 성인사이트에서는 갤러리로 활용이 가능하고 
					뷰티샵에서는 메이크업 강좌등을 만들때 <br>
					이용하실 수 있습니다. <br>
					온라인 카탈로그는 현재 1개까지 개설가능하며 이미지는 150개까지 
					올릴 수 있습니다. <br>
					이후 업그레이드 일정에 맞춰 개설가능한 카탈로그 게시판의 수를 
					늘릴 예정입니다.
				</td>
				</tr>

				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%" cellspacing="0" cellpadding="0">
<form>
<input type='hidden' name='flag' value='update'>
						
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="0" colspan="2">
								<strong>온라인 카탈로그 기능을 이용하시겠습니까?&nbsp;&nbsp; </strong>
								<input name="if_catalog" type="radio" value="t" 
								<?
								if($if_catalog == 't') echo " checked";
								?>
								>Yes&nbsp;&nbsp; 
								<input name="if_catalog" type="radio" value="f"
								<?
								if($if_catalog == 'f') echo " checked";
								?>
								>No<br>

								<strong>카탈로그의 이름을 무엇으로 하시겠습니까? &nbsp;&nbsp; </strong>
								
								<input name="catalog_name" value='<?echo $catalog_name?>' size="25" class="input_03">
								<br>
								<font color="#0000FF">(입력예 : 미소녀 자료실, 메이크업 
								강좌, 카탈로그)</font>
							</td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"></td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"><center>
								<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정">&nbsp;
								<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">&nbsp;
								</center>
							</td>
						</tr>
</form>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br>
							</td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
						</tr>
<?
	$SQL = "select * from $CatalogTable where mart_id='$mart_id' order by catalog_no desc";
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
							<td width="50%" bgcolor="#FFFFFF">
								<p style="padding-left: 10px"><br>
								총 <?echo $numRows?>개의 게시물이 등록되어 있습니다.
							</td>
							<td width="50%" bgcolor="#FFFFFF"><p align="right"><br>
								<input onclick="window.location.href='catalog_write.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="게시물 등록">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								
							</td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" colspan="2">
								<p style="padding-left: 20px">
								
								<?
							if($page == 1){
								echo ("
								처음
								");
							}
							else{
								echo ("
								<a href='catalog_list.php?page=1'>처음</a>
								");
							}
						
							if($start_page >1){
								echo ("
								<a href='catalog_list.php?page=$prev_start_page'>
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
								<a href='catalog_list.php?page=$i'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='catalog_list.php?page=$next_start_page'>
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
								<a href='catalog_list.php?page=$total_page'>끝</a>
								");
							}
							?>
								
							</td>
						</tr>
					</table>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#94C652" colspan="5">
										<strong>&quot;카탈로그이름&quot;에 
										등록된 게시물 리스트</strong>
									</td>
								</tr>
								<tr>
									<td width="6%" bgcolor="#C8DCA9" align="center">번호</td>
									<td width="24%" bgcolor="#C8DCA9" align="left"><p align="center">제목</td>
									<td width="9%" bgcolor="#C8DCA9" align="left"><p align="center">등록일</td>
									<td width="9%" bgcolor="#C8DCA9" align="center">수정/삭제</td>
									<td width="5%" bgcolor="#C8DCA9" align="center">조회수</td>
								</tr>
							  <?
								for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
								if ($i >= $numRows) break;
								mysql_data_seek($dbresult, $i);
								$ary=mysql_fetch_array($dbresult);
								$catalog_no = $ary["catalog_no"];
								$title = $ary["title"];
								$date = $ary["date"];
								$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
								$content = $ary["content"];
								$readnum = $ary["readnum"];
								$img = $ary["img"];
								$j = $numRows - $i;
								echo ("	
							<tr>
									<td width='6%' bgcolor='#FFFFFF' align='center'>
										$j</td>
									<td width='25%' bgcolor='#FFFFFF' align='left'>
										$title</td>
									<td width='9%' bgcolor='#FFFFFF' align='left'>
										<p align='center'>
										$date_str</td>
									<td width='9%' bgcolor='#FFFFFF' align='center'>
										<input onclick=\"window.location.href='catalog_edit.php?catalog_no=$catalog_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
										<input onclick=\"return del('$catalog_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'>
									</td>
									<td width='5%' bgcolor='#FFFFFF' align='center'>
										0
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
if($flag == "update"){
	$SQL = "update $MartMngInfoTable set if_catalog = '$if_catalog' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 
	
	$SQL = "select * from $Catalog_ConfTable where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	if(mysql_num_rows($dbresult)>0){
		$SQL = "update $Catalog_ConfTable set catalog_name='$catalog_name' where mart_id='$mart_id'";
	}
	else{
		$SQL = "insert into $Catalog_ConfTable (mart_id, catalog_name) values ".
		"('$mart_id', '$catalog_name')";
	}
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=catalog_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>