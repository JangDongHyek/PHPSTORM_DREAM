<?
include "../lib/Mall_Admin_Session.php";
include "../admin_head.php";
?>
<?
$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	$service_name = mysql_result($dbresult,0,0);
}
?>
<?
if ($cnfPagecount == "") {
	$cnfPagecount = 20;
}
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

if($mode == "search"){
	$SQL = "select * from search_word where $keyset like '%$searchword%' order by date desc";
}else{
	$SQL = "select * from search_word order by date desc";
}

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

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

<SCRIPT LANGUAGE='JavaScript1.1'>
<!--
function goto_byselect(sel, targetstr){
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

function no_search(){
	document.search_form.searchword.value='';
	document.search_form.submit();
}
//-->
</SCRIPT>

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
        			<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>��ǰ �˻������</b></td>
				</tr>
        	</table>

			<table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%" bgcolor="#FFFFFF" height="10" colspan="2"></td>
							</tr>
							<tr>
								<td width="50%" bgcolor="#FFFFFF" height="0"><p style="padding-left:10px">�� <?=$numRows?>���� �˻��� ����� �ֽ��ϴ�.</td>
							</tr>
							<tr>
								<td width="100%" bgcolor="#FFFFFF" colspan="2"><br></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="100%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
										<tr height='28'>
											 <td width="10%" bgcolor="#C8DFEC" align="center">��ȣ</td>
											 <td width="40%" bgcolor="#C8DFEC" align="center">�˻���</td>
											 <td width="15%" bgcolor="#C8DFEC" align="center">���̵�</td>
											 <td width="10%" bgcolor="#C8DFEC" align="center">��ȸ��</td>
											 <td width="20%" bgcolor="#C8DFEC" align="center">�� ¥</td>
										</tr>
<?
if( $numRows == 0 ){
?>
										<tr height='30' bgcolor='#FFFFFF' align='center'>
											<td colspan='5'>�˻��� ��谡 �����ϴ�.</td>
										</td>
<?
}
?>
<?	
for($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$row = mysql_fetch_array($dbresult);
	$id = $row[id];
	$search_word = $row[search_word];
	$count = $row[count];
	$date = $row[date];
	$user_id = $row[user_id];

	$j = $numRows - $i;
?>		
										<tr height='25' bgcolor='#FFFFFF' align='center'>
											<td><?=$j?></td>
											<td><b><?=$search_word?></b></td>
											<td><?=$user_id?></td>
											<td><?=$count?></td>
											<td><?=$date?></td>
										</tr>
<?
}
?>
									</table>
								</td>
							</tr>
						</table>
						<table border="0" width="100%">
							<tr height='40'>
								<td width="60%" bgcolor="#FFFFFF">
									<p style="padding-left: 20px">
								
<?
if($page == 1){
	echo ("
	ó��
	");
}
else{
	echo ("
	<a href='search_count.php?category_num=$tmp_category_num&page=1&searchword=$searchword'>ó��</a>
	");
}

if($start_page > 1){
	echo ("
	<a href='search_count.php?category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword'>
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
	<a href='search_count.php?category_num=$tmp_category_num&page=$i&searchword=$searchword'>$i</a>
		");
	}
}
if($end_page < $total_page){
	echo ("
	<a href='search_count.php?category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword'>
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
	<a href='search_count.php?category_num=$tmp_category_num&page=$total_page&searchword=$searchword'>��</a>
	");
}
?>
									</td>
									<form name='search_form' method="post" action='<?=$PHP_SELF?>?mode=search'>
									<input type="hidden" name="page" value="<?=$page?>">
									<td width="40%" align="center">
										<select name="keyset" style="font-size: 9pt; background-color: rgb(255,255,255); padding-left: 0; padding-right: 0; padding-top: -1; padding-bottom: -1" size="1">
											<option value="search_word">�˻���</option>
											<option value="user_id">���̵�</option>
											<option value="count">��ȸ��</option>
											<option value="date">�� ¥</option>
										</select>&nbsp; 
										<input type='text' name='searchword' value='<?=$searchword?>' size="20" class="input_03"> 
										<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="ã��">&nbsp;<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" onclick="location.href='<?=$PHP_SELF?>'" value="���">
									</td>
									</form>
								</tr>
							</table>

						</td>
						</tr>
					</table>

			<br>
		</td>
	</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>