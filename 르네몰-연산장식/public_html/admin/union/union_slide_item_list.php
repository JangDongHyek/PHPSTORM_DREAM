<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($delflag=="del"){
	$SQL = "delete from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>
<script>
function really2(item_no, union_no){
	if (confirm("현재상품을 삭제하시겠습니까?")){
		document.location.href='union_slide_item_list.php?delflag=del&item_no='+item_no+'&union_no='+union_no; 
	}
}
</script>


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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>공동구매 기본정보설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" height="35"><strong>[공동구매 상품등록]</strong><br>
						공동구매 상품을 등록/관리하실 수 있습니다.</td>
					</tr>
					<?
				$SQL = "select * from $Union_ListTable where mart_id='$mart_id' order by union_no desc";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				mysql_data_seek($dbresult, $i);
				$ary=mysql_fetch_array($dbresult);
				$slide_no = $ary["slide_no"];
			
				$SQL = "select * from $Union_ItemTable where type='slide' and union_no = '$union_no' and mart_id='$mart_id' order by item_no desc";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				?>
				<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						
						<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%" bgcolor="#FFFFFF" height="30">총 <?echo $numRows?> 개의 상품이 등록되어 있습니다.</td>
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
										<td width="54%" bgcolor="#DDC5E4" align="center" colspan="6">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">&nbsp; 제 <?echo $slide_no?> 차 공동구매/ 슬라이드 
													상품리스트</td>
												<td width="50%">
													<p align="right">
													<input onclick="window.location.href='slide_item_write.php?union_no=<?echo $union_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="상품등록"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										 <td bgcolor="#F3F3F3" align="center" height="28">상품명</td>
										 <td bgcolor="#F3F3F3" align="center">최저가</td>
										 <td bgcolor="#F3F3F3" align="center">현재가</td>
										 <td bgcolor="#F3F3F3" align="center">신청수량</td>
										 <td bgcolor="#F3F3F3" align="center">관리</td>
										 <td bgcolor="#F3F3F3" align="center">신청자보기</td>
									  </tr>
									<?
									$SQL = "select * from $Union_ItemTable where type='slide' and union_no = '$union_no' and mart_id='$mart_id' order by item_no desc";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								
								for ($i=0; $i < $numRows; $i++) {
									mysql_data_seek($dbresult, $i);
									$ary=mysql_fetch_array($dbresult);
									$item_no = $ary["item_no"];
									$item_name = $ary["item_name"];
									$price3 = $ary["price3"];
									$price3_str = number_format($price3);
									$current_num = $ary["current_num"];
									$current_num_str = number_format($current_num);
									$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
									$current_price_str = number_format($current_price);
									
									echo ("
									<tr>
										<td bgcolor='#FFFFFF' align='center'>
											$item_name</td>
										<td bgcolor='#FFFFFF' align='center'>
											$price3_str 원</td>
										<td bgcolor='#FFFFFF' align='center'>
											$current_price_str 원</td>
										<td bgcolor='#FFFFFF' align='center'>
											<font color='#0000FF'>$current_num_str 개</font></td>
										<td bgcolor='#FFFFFF' align='center'>
											<input  onclick=\"window.location.href='slide_item_edit.php?item_no=$item_no&union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'> 
											<input  onClick='really2($item_no, $union_no)'  style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='삭제'></td>
										<td bgcolor='#FFFFFF' align='center'>
											<input  onclick=\"window.location.href='union_order_id_list.php?type=slide&item_no=$item_no&union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='신청자보기'></td>
									</tr>
										");
									}
									?>
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