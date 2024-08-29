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

if($category_num=="" || $category_num== "0") {
	$category_num = 0;
	$cur_category_name = "전체 카테고리";
}

if (isset($prevno) == false) $prevno = 0;
?>

<SCRIPT LANGUAGE='JavaScript1.1'>
<!--
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

function no_search(){
	document.search_form.searchword.value='';
	document.search_form.submit();
}
//-->
</SCRIPT>

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

			<!-- 타이틀이랑 로그아웃, 쇼핑몰가기 버튼테이블-->
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
        	<tr>
        		<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>상품 조회수</b></td>
        	</table>
			<!-- 타이틀이랑 로그아웃, 쇼핑몰가기 버튼테이블 END-->
			<!--내용넣으세요~~-->

					<table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
						<tr>
						<td width="90%" bgcolor="#FFFFFF" valign="top"><br><p align="right"><b>☞
							카테고리 이동</b>&nbsp;&nbsp;
							<select onchange="goto_byselect(this, 'self')" class="aa" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
							<option value='item_count.php?category_num=0'>▷전체 카테고리</option>
<?
$SQL = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='0' order by category_num desc";
$dbresult = mysql_query($SQL, $dbconn);
$tmp_category_num = $category_num;
$numRows = mysql_num_rows($dbresult);
for($i=0; $i<$numRows; $i++){
	$category_num = mysql_result($dbresult,$i,0);
	$category_name = mysql_result($dbresult,$i,1);
	
	$SQL2 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' order by category_num desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$numRows1 = mysql_num_rows($dbresult2);

	echo ("
					<option value='$PHP_SELF?category_num=$category_num'
	");		
	if($tmp_category_num == $category_num){
		echo "selected";
		$cur_category_name = $category_name;
	}
	echo (" style='color:#000000; background-color:#dddddd;'>▷$category_name</option>");
				
	for($j=0;$j<$numRows1;$j++){
		$category_num1 = mysql_result($dbresult2,$j,0);
		$category_name1 = mysql_result($dbresult2,$j,1);

		$SQL3 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num1' order by category_num desc";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);
				
		echo ("
					<option value='$PHP_SELF?category_num=$category_num1'
		");	
		if($tmp_category_num == $category_num1){
			echo "selected";
			$cur_category_name = $category_name1;
		}
		echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>");

		for($k=0;$k<$numRows3;$k++){
			$category_num3 = mysql_result($dbresult3,$k,0);
			$category_name3 = mysql_result($dbresult3,$k,1);

			echo ("
						<option value='$PHP_SELF?category_num=$category_num3'
			");	
			if($tmp_category_num == $category_num3){
				echo "selected";
				$cur_category_name = $category_name3;
			}
			echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");
		}
	}
}
?>
							</select><br>
							<br>
							
						</td>
						</tr>
						<tr>
						<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
						</tr>
						<tr>
						<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
							<table border="0" width="100%">
								<tr><td width="50%" height="20"><b>[현재 카테고리 : <?echo $cur_category_name?>]</b></td></tr>
							</table>
<?
if ($cnfPagecount == "") {
	$cnfPagecount = 50;
}
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

if($tmp_category_num == '0' ){
	$SQL = "select item_no from $ItemTable  order by read_num desc";
}	
else{
	$SQL = "select item_no from $ItemTable where category_num = $tmp_category_num order by read_num desc";
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

							<table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
									<td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"></td>
								</tr>
								<tr>
									<td width="50%" bgcolor="#FFFFFF" height="0">
										<p style="padding-left:10px">
										총 <?echo $numRows?>개의 상품이 등록되어 있습니다.</td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br>
									</td>
								</tr>

							<tr>
									<td width="60%" bgcolor="#FFFFFF">
								<p style="padding-left: 20px">
								
									<?
									if($page == 1){
										echo ("
										처음
										");
									}
									else{
										echo ("
										<a href='item_count.php?category_num=$tmp_category_num&page=1&searchword=$searchword'>처음</a>
										");
									}
								
									if($start_page > 1){
										echo ("
										<a href='item_count.php?category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword'>
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
										<a href='item_count.php?category_num=$tmp_category_num&page=$i&searchword=$searchword'>$i</a>
											");
										}
									}
									if($end_page < $total_page){
										echo ("
										<a href='item_count.php?category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword'>
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
										<a href='item_count.php?category_num=$tmp_category_num&page=$total_page&searchword=$searchword'>끝</a>
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
							<table border="0" width="100%">
								<tr>
									<td width="90%" bgcolor="#999999">
										<table border="0" width="100%" cellspacing="1" cellpadding="3">
										<tr>
											<td width="100%" bgcolor="#8FBECD" colspan="6">
												<table border="0" width="100%" cellspacing="0" cellpadding="0">
													<tr>
													<td width="50%">&nbsp;
														<b><span class="dd">현재 카테고리에 등록된 상품 리스트</b>
													</td>
													<td width="50%"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											 <td width="4%" bgcolor="#C8DFEC" align="center">번호</td>
											 <td width="18%" bgcolor="#C8DFEC" align="left"><p align="center">카테고리명</td>
											 <td width="18%" bgcolor="#C8DFEC" align="left"><p align="center">상품명</td>
											 <td width="8%" bgcolor="#C8DFEC" align="left"><p align="center">등록일</td>
											 <td width="6%" bgcolor="#C8DFEC" align="center">조회수</td>
										</tr>

										<?	
											for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
												if ($i >= $numRows) break;
												mysql_data_seek($dbresult, $i);
												$ary=mysql_fetch_array($dbresult);
												$item_no = $ary["item_no"];
												
												
												$SQL1 = "select mart_id,item_name,reg_date,read_num,if_hide,category_num from $ItemTable where item_no = $item_no";
												$dbresult1 = mysql_query($SQL1, $dbconn);
												$mart_id = mysql_result($dbresult1,0,0);
												$item_name = mysql_result($dbresult1,0,1);
												$reg_date = mysql_result($dbresult1,0,2);
												$read_num = mysql_result($dbresult1,0,3);
												$if_hide = mysql_result($dbresult1,0,4);
												$item_category_num  = mysql_result($dbresult1,0,5);

													$SQL3 = "select category_name from $CategoryTable where mart_id='$mart_id' and category_num=$item_category_num limit 1";
													$dbresult3 = mysql_query($SQL3, $dbconn);
													$category_name3 = mysql_result($dbresult3,0,0);

												//if($Mall_Admin_ID == $mart_id) {
													$gnt_img = "";
													if($if_hide == '1') $hide_str = "<img src='../images/hide.gif'>";
													else $hide_str = "";
												/*}
												else { 
													$gnt_img = "<img src='../images/gnt.gif' height='12' width='25'>";
													$hide_str = "";
												}*/
												$j = $numRows - $i;
												echo ("		
											<tr>
												<td width='4%' bgcolor='#FFFFFF' align='center'>$j</td>
												<td width='10%' bgcolor='#FFFFFF' align='center'>$category_name3</td>
												<td width='19%' bgcolor='#FFFFFF' align='left'>&nbsp;$item_name$gnt_img $hide_str</td>
												<td width='8%' bgcolor='#FFFFFF' align='left'><p align='center'>$reg_date</td>
												<td width='5%' bgcolor='#FFFFFF' align='center'>$read_num</td>
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
		</td>
	</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>