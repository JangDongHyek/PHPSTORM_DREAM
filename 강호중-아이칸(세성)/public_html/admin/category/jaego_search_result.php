<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "3";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>재고관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						
						<table border="0" width="100%">
							<tr>
								<td width="100%" height="20" align="center">
									<?
									if($search_type == 1){
										echo ("
									<input onclick=\"window.location.href='jaego_search_result.php?search_type=2'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='위험상품 검색결과로 가기'>
										");
									}
									if($search_type == 2){
										echo ("
									<input onclick=\"window.location.href='jaego_search_result.php?search_type=1'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='품절상품 검색결과로 가기'>
										");
									}
									?>
									</td>
							</tr>
						</table>
						
						<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%" bgcolor="#FFFFFF" height="35" colspan="2" align="center">검색 결과내에서 재고량을 수정하실 수 있습니다.</td>
							</tr>
					
<form method='post'>
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='search_type' value='<?echo $search_type?>'>
					
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						<table border="0" width="90%">
							<tr>
								<td width="100%" bgcolor="#999999">
								
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="4">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">&nbsp; <strong>상품별 재고현황</strong></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="center">상태</td>
										<td bgcolor="#C8DFEC" align="center">번호(item_no)</td>
										<td  bgcolor="#C8DFEC" align="center">상품명</td>
										<td bgcolor="#C8DFEC" align="center">재고량</td>
									</tr>
									<?	
								for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
									if ($i >= $numRows) break;
									mysql_data_seek($dbresult, $i);
									
									$ary=mysql_fetch_array($dbresult);
									$item_no = $ary["item_no"];
									$item_name = $ary["item_name"];
									$jaego = $ary["jaego"];
									$reg_date = $ary["reg_date"];
									$read_num = $ary["read_num"];
									$j = $numRows - $i;
									if($jaego == 0){
										$status_color = "#FF0000";
										$status_str = "품절";
									}
									if($jaego >= 1 && $jaego <= 5){
										$status_color = "#FFC821";
										$status_str = "위험";
									}
									if($jaego > 5){
										$status_color = "#0080C0";
										$status_str = "여유";
									}
									
									
									echo ("		
								<tr>
										<input type='hidden' name='item_no[]' value='$item_no'>
										<td bgcolor='$status_color' align='center'>
											<strong>$status_str</strong></td>
										<td bgcolor='#FFFFFF' align='center'>
											$j($item_no)</td>
										<td bgcolor='#FFFFFF' align='center'>
											$item_name</td>
										<td bgcolor='#FFFFFF' align='center'>
											<input name='jaego[]' size='4' style='border: 1px solid rgb(136,136,136)' value='$jaego'></td>
									</tr>
										");
									}
									?>
									</table>
								</td>
							</tr>
						</table>
						</center></div></td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<p align="right">
						
							<?
						if($page == 1){
							echo ("
							처음
							");
						}
						else{
							echo ("
							<a href='jaego_search_result.php?search_type=$search_type&page=1'>처음</a>
							");
						}
					
						if($start_page > 1){
							echo ("
							<a href='jaego_search_result.php?search_type=$search_type&page=$prev_start_page'>
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
							<a href='jaego_search_result.php?search_type=$search_type&page=$i'>$i</a>
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='jaego_search_result.php?search_type=$search_type&page=$next_start_page'>
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
							<a href='jaego_search_result.php?search_type=$search_type&page=$total_page'>끝</a>
							");
						}
						?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정완료">&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
						<input onclick="window.location.href='jaego_category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="이전화면"></td>
					</tr>
					</form>
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
}
if($flag == 'update'){
	for($i=0; $i<count($item_no); $i++) {
		$SQL = "update $ItemTable set jaego = '$jaego[$i]' where mart_id='$mart_id' and item_no = '$item_no[$i]'";

		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=jaego_search_result.php?search_type=$search_type'>";
}
?>
<?
mysql_close($dbconn);
?>