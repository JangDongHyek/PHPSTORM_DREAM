<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
	$SQL = "select * from $Gift_ItemTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$gift_item_no = $ary["gift_item_no"];
		$item_no_ori = $ary["item_no"];
		$message = $ary["message"];
		$message = htmlspecialchars($message);
		$provider_id = $ary["provider_id"];
	}
	include "../admin_head.php";
?>
<script>
function checkform(f){
	if(f.message == ""){
		alert ("코멘트를 입력하세요.");
		f.message.focus();
		return false;
	}
	return true;
}
</script>


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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>선물코너</b> </td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">선물코너란 등록되어진 상품들 중 선물로 추천할 상품을 
					선택합니다.<br>
					등록되어진 선물코너의 상품들은 언제든지 상점주가 원하는 
					상품으로 변경하실 수 있습니다.<br>
					등록한 선물코너상품은 메인화면의 선물코너영역에 출력됩니다.<br>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%">
						<tr>
							<td width="100%"><strong>[선물코너 상품등록]</strong></td>
						</tr>
					</table>
				</td>
				</tr>
<form action='gift_item.php' method="post" name="writeform" onsubmit='return checkform(this)'>
<input type="hidden" name="flag" value='update'>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><div align="center"><center>
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#ffffff">
							<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#a7a7a7" align="center">
								<tr>
									<td width="10%" bgcolor="#e7e7e7" align="left">
										<p align="center">상품명</td>
									<td width="36%" bgcolor="#FFFFFF" align="left"><p align="left">&nbsp; 
										<select name="item_no" size="1">
										<?
									$SQL = "select item_no, item_name, T1.mart_id 
									from $ItemTable T1,$CategoryTable T2 
							where T1.mart_id='$mart_id' and T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'";
								//echo "sql=$SQL";
									$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
									for ($i=0; $i<$numRows; $i++) {
										mysql_data_seek($dbresult,$i);
										$ary = mysql_fetch_array($dbresult);
										$item_no = $ary["item_no"];
										$item_name = $ary["item_name"];
										$mart_id = $ary["mart_id"];
										
										echo "<option value='$item_no#' ";
										if($item_no_ori == $item_no) echo " selected";
										echo ">$item_name$gnt_str</option>";
									}
									
									$SQL = "select item_no from $Gnt_ItemTable where seller_id='$Mall_Admin_ID' order by item_no desc";
									//echo "sql=$SQL";
									$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
									for ($i=0; $i<$numRows; $i++) {
										$item_no = mysql_result($dbresult,$i);
									
										$SQL1 = "select item_name from $ItemTable where item_no='$item_no'";
										//echo "sql1=$SQL1";
										$dbresult1 = mysql_query($SQL1, $dbconn);
										$item_name = mysql_result($dbresult1,0);
										$gnt_str = "(gnt)";
											
										echo "<option value='$item_no#' ";
										if($item_no_ori == $item_no) echo " selected";
										echo ">$item_name$gnt_str</option>";
									}
									
									/*
									//상품 gnt
									$SQL = "select T1.item_no, T1.item_name, T1.mart_id from $ItemTable T1, $Gnt_ItemTable T2
									where T2.seller_id='$Mall_Admin_ID'  and T2.item_no=T1.item_no order by item_no desc";
									$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
									for ($i=0; $i<$numRows; $i++) {
										mysql_data_seek($dbresult,$i);
										$ary = mysql_fetch_array($dbresult);
										$item_no = $ary["item_no"];
										$item_name = $ary["item_name"];
										$mart_id = $ary["mart_id"];
										
										$provider_id = "";
										if($Mall_Admin_ID == $mart_id){
											$gnt_str = "";
										}
										else{ 
											$gnt_str = "(gnt)";
										}	
											
										echo "<option value='$item_no#$provider_id' ";
										if($item_no_ori == $item_no) echo " selected";
										echo ">$item_name$gnt_str</option>";
									}
									*/
									 // 주고 받기 상품 가지고 오기
							  $SQL = "select * from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' and state1='2' order by gnt_no desc";
									$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
									for ($i=0; $i<$numRows; $i++) {
										mysql_data_seek($dbresult,$i);
										$ary = mysql_fetch_array($dbresult);
										$category_num = $ary["category_num"];
									
										$SQL1 = "select * from $ItemTable where (category_num = $category_num or prevno = $category_num) order by item_no desc";
										//echo "sql1=$SQL1";
										$dbresult1 = mysql_query($SQL1, $dbconn);
										$numRows1 = mysql_num_rows($dbresult1);
										for ($j=0; $j<$numRows1; $j++) {
											mysql_data_seek($dbresult1,$j);
											$ary1 = mysql_fetch_array($dbresult1);
											$provider_id = $ary1["mart_id"];
											$item_no = $ary1["item_no"];
											$item_name = $ary1["item_name"];
											echo "<option value='$item_no#$provider_id' ";
											if($item_no_ori == $item_no) echo " selected";
											echo ">$item_name(gnt)</option>";
										}
									}
									?>
										</select>
									</td>
								</tr>
								<tr>
									<td width="10%" bgcolor="#e7e7e7" align="center">코멘트</td>
									<td width="360%" bgcolor="#FFFFFF" align="center"><p align="left">&nbsp; 
										
										<input name="message" size="80" value='<?echo $message?>' maxlength='25' class="input_03">
								</td>
								</tr>
								<tr>
									<td width="46%" bgcolor="#FFFFFF" align="left" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
										선물코너에 등록할 제품을 선택하시고, 문구를 입력하세요.(25자이내)</td>
								</tr>
								
								</table>
							</td>
						</tr>
					</table>
					</center></div></div>
				</td>
				</tr>
				<tr align="center">
				<td width="100%" bgcolor="#FFFFFF" valign="top" height="35">
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료"> 
					<input onclick='re_init()' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="재입력">
				</td>
				</tr>
</form>
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
elseif ($flag == "update") {
	$item_nos = explode("#", $item_no);
	$item_no = $item_nos[0];
	$provider_id = $item_nos[1];
		
	$SQL1 = "select * from $Gift_ItemTable where mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	
	if ($dbresult1 == false) echo "쿼리 실행 실패!";

	$numRows1 = mysql_num_rows($dbresult1);
	
	if($numRows1 <= 0){
		$SQL = "insert into $Gift_ItemTable " .
		"(mart_id, item_no, message, provider_id) values " .
		"('$mart_id', $item_no, '$message', '$provider_id')";
	}else{
		$SQL = "update $Gift_ItemTable set item_no = '$item_no' , message = '$message', provider_id = '$provider_id' where mart_id='$mart_id'";	
	}

	$dbresult = mysql_query($SQL, $dbconn); 

	if ($dbresult == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=gift_item.php'>";
}
?>
<?
mysql_close($dbconn);
?>