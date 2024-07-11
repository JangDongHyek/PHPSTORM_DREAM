<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''||$flag=='search') {
?>
<?
	include "../admin_head.php";
?>
<script>
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
function checkform(f){
	if(f.searchword.value==''){
		alert("검색어를 입력하세요.");
		f.searchword.focus();
		return false;
	}
	else return true;
}
function toggle(val){
	dl = document.list;

	 for (i = 0; i < dl.elements.length; i++) {
		if (dl.elements[i].name == 'checkSel[]')
		  dl.elements[i].checked = val;
	 }
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "10";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>관리자 지정상품 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>


			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
									<tr>
								<td  colspan="5">
								<?
																	
											$SQL = "select * from $AdminMainTable where mart_id='$mart_id' and banner_no='$banner_no'";
															$dbresult = mysql_query($SQL, $dbconn);
															$numRows = mysql_num_rows($dbresult);
															for ($i=0; $i<$numRows; $i++) {
																mysql_data_seek($dbresult,$i);
																$ary = mysql_fetch_array($dbresult);
																$banner_no = $ary["banner_no"];
																$img = $ary["img"];
																$img_width = $ary["img_width"];
																$img_height =$ary["img_height"];

																if($img_width > 699){
																	$img_width = "500";
																}
															}
								?>
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td width="50%">
													<?
									echo"<img src='$Co_img_DOWN$mart_id/$img' width='$img_width' height='$img_height' border='0'>";
													?>
													<td>
												</tr>
										</table>
								</td>
								</tr>
								<tr>
				<td width="90%" bgcolor="#FFFFFF" height="35">
					등록한 관리자 지정상품은 메인화면의 관리자 지정상품영역에 출력됩니다</td>
				</tr>

				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="left">
					<table border="0" width="100%">
						<tr>
							<td width="91%" bgcolor="#FFFFFF">검색창을 통하여 검색하신 후 등록하세요.</td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#CCCCCC">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#F7F7F7" height="30">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											
											<form method='post' name='search' onsubmit='return checkform(this)'>
										<input type='hidden' name='flag' value='search'>
										<input type='hidden' name='keyset' value='item_name'>
											<input type='hidden' name='banner_no' value='<?=$banner_no?>'>
									
										<tr>
											<td width="18%" height="25">&nbsp; 상품명 검색</td>
											<td width="30%" height="25">
												<input name="searchword" class="input_03" size="30"></td>
											<td width="13%" height="25"><p align="left">정렬순서</td>
											<td width="20%" height="25">
												
												<select name='order' size="1" style="height: 18px; border: 1px solid black">
													<option value="item_name">상품명</option>
													<option value="item_company">제조사순</option>
													<option value="z_price">가격순</option>
													<option value="reg_date">등록순</option>
												</select></td>
											<td width="19%" height="25">
												<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid; BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; COLOR: #929292; HEIGHT: 18px" type="submit" value="검색"></td>
											</tr>
											</form>
											<form method='post' name='search' onsubmit='return checkform(this)'>
										<input type='hidden' name='flag' value='search'>
										<input type='hidden' name='keyset' value='item_company'>
										<input type='hidden' name='banner_no' value='<?=$banner_no?>'>
										<tr>
											<td width="18%" height="25">&nbsp; 제조사별 검색</td>
											<td width="30%" height="25">
												<input name="searchword" class="input_03" size="30"></td>
											<td width="13%" height="25">정렬순서</td>
											<td width="20%" height="25">
												<select name='order' size="1" style="height: 18px; border: 1px solid black">
													<option value="item_name">상품명</option>
													<option value="item_company">제조사순</option>
													<option value="z_price">가격순</option>
													<option value="reg_date">등록순</option>
												</select></td>
											<td width="19%" height="25">
												<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid; BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; COLOR: #929292; HEIGHT: 18px" type="submit" value="검색"></td>
											</tr>
											</form>
											<form method='post' name='search' onsubmit='return checkform(this)'>
										<input type='hidden' name='flag' value='search'>
										<input type='hidden' name='keyset' value='category_num'>
										<input type='hidden' name='banner_no' value='<?=$banner_no?>'>
										<tr>
											<td width="18%" height="25">&nbsp; 카테고리별 검색</td>
											<td width="30%" height="25">
												<select name='searchword' size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
<?
$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno=0 and if_hide='0' order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);

$tmp_category_num = $searchword;
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$category_num = $ary["category_num"];
	$category_name = $ary["category_name"];
	
	$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno=$category_num and if_hide='0' order by cat_order desc";
	$dbresult2 = mysql_query($SQL, $dbconn);
	$numRows1 = mysql_num_rows($dbresult2);
	
	echo ("
	<option value='$category_num'");
	if($tmp_category_num == $category_num){
		echo "selected";
		$cur_category_name = $category_num;
	}
	echo (">▷$category_name</option>
	");
				
	for($j=0;$j<$numRows1;$j++){
		mysql_data_seek($dbresult2,$j);
		$ary1 = mysql_fetch_array($dbresult2);
		$category_num1 = $ary1["category_num"];
		$category_name1 = $ary1["category_name"];

		$SQL3 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num1' order by cat_order desc";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);
		
		echo ("
			<option value='$category_num1'");
		if($tmp_category_num == $category_num1){
				echo "selected";
				$cur_category_name = $category_num1;
		}
		echo ("> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>
		");

		for($k=0;$k<$numRows3;$k++){
			$category_num3 = mysql_result($dbresult3,$k,0);
			$category_name3 = mysql_result($dbresult3,$k,1);

			echo ("
						<option value='$category_num3'
			");	
			if($tmp_category_num == $category_num3){
				echo "selected";
				$cur_category_name = $category_name3;
			}
			echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");

			$SQL4 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num3' order by cat_order desc";
			$dbresult4 = mysql_query($SQL4, $dbconn);
			$numRows4 = mysql_num_rows($dbresult4);
			for($l=0;$l<$numRows4;$l++){
				$category_num4 = mysql_result($dbresult4,$l,0);
				$category_name4 = mysql_result($dbresult4,$l,1);
				echo ("
						<option value='$category_num4'
				");	
				if($tmp_category_num == $category_num4){
					echo "selected";
					$cur_category_name = $category_name4;
				}
				echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name4</option>");
			}
		}
	}
}
// 주고 받기 카테고리..

$SQL = "select * from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' and state1='2' order by gnt_no desc";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);

$numRows = mysql_num_rows($dbresult);
//echo "numRows=$numRows";
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$category_num_tmp = $ary["category_num"];

	$SQL1 = "select * from $CategoryTable where category_num = $category_num_tmp";
	//echo "sql=$SQL";
	$dbresult1 = mysql_query($SQL1, $dbconn);

	$numRows1 = mysql_num_rows($dbresult1);
	//echo "numRows=$numRows";
	for ($j=0; $j<$numRows1; $j++) {
		mysql_data_seek($dbresult1,$j);
		$ary1 = mysql_fetch_array($dbresult1);
		$category_num1 = $ary1["category_num"];
		$category_name1 = $ary1["category_name"];
		$provider_id1 = $ary1["provider_id"];
		
		$SQL2 = "select * from $CategoryTable where prevno=$category_num1 order by category_num desc";
		//echo "sql=$SQL";
		$dbresult2 = mysql_query($SQL2, $dbconn);
		$numRows2 = mysql_num_rows($dbresult2);

		echo ("
	<option value='$category_num1'>▷$category_name1</option>
		");
				
		for($k=0;$k<$numRows2;$k++){
			mysql_data_seek($dbresult2,$k);
			$ary2 = mysql_fetch_array($dbresult2);
			$category_num2 = $ary2["category_num"];
			$category_name2 = $ary2["category_name"];
				
			echo ("
	<option value='$category_num2'> &nbsp;&nbsp;&nbsp;&nbsp- $category_name2</option>");
		}
	}
}
?>
												</select></td>
											<td width="13%" height="25">정렬순서</td>
											<td width="20%" height="25">
												<select name='order' size="1" style="height: 18px; border: 1px solid black">
													<option value="item_name">상품명</option>
													<option value="item_company">제조사순</option>
													<option value="z_price">가격순</option>
													<option value="reg_date">등록순</option>
												</select></td>
											<td width="19%" height="25">
												<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid; BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; COLOR: #929292; HEIGHT: 18px" type="submit" value="검색"></td>
											</tr>
											</form>
											</table>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td width="91%" bgcolor="#FFFFFF"></td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#CCCCCC">
								<table border="0" width="100%" bgcolor="#F7F7F7" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#FE9725" align="center" colspan="6" height="25">
										<b><font color="#FFFFFF"><p align="left">검색결과</font></b></td>
								</tr>
								<tr>
									<td width="7%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">선택</font></b></td>
									<td width="7%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">번호</font></b></td>
									<td width="35%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">상품명</font></b></td>
									<td width="8%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">선택</font></b></td>
									<td width="7%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">번호</font></b></td>
									<td width="38%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">상품명</font></b></td>
								</tr>
								<form action='adminmain_item_new.php' method='post' name='list'>
								<input type='hidden' name='flag' value='to_adminmain_item'>
								<input type='hidden' name='banner_no' value='<?=$banner_no?>'>
								<?
								if($flag == 'search'){
									if($keyset != 'category_num'){
										$SQL = "select item_no, item_name, item_company, z_price, reg_date 
										from $ItemTable T1,$CategoryTable T2 
										where T1.mart_id='$mart_id' and T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'
										and T1.$keyset like '%$searchword%' 
										UNION 
										select T1.item_no, T1.item_name, T1.item_company, T1.z_price, T1.reg_date 
										from $ItemTable T1, $Gnt_ItemTable T2 
										where T2.seller_id='$Mall_Admin_ID' and T1.item_no= T2.item_no and T1.$keyset like '%$searchword%' order by $order Asc";
									}else if($keyset == 'category_num'){
										$cate_SQL = "select category_degree from $CategoryTable where category_num = $searchword";
										$cate_dbresult = mysql_query($cate_SQL, $dbconn);
										$cate_row = mysql_fetch_array($cate_dbresult);
										$category_degree = $cate_row[category_degree];

												if($category_degree == 0)
													$item_keyset = "firstno";
												elseif($category_degree == 1)
													$item_keyset = "prevno";
												elseif($category_degree == 2)
													$item_keyset = "thirdno";
												else
													$item_keyset = "category_num";

													$SQL = "select T1.mart_id, item_no, item_name, z_price, item_company, reg_date 
													from $ItemTable T1,$CategoryTable T2 
													where T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'
													and T1.$item_keyset ='$searchword'
													UNION 
													select T1.mart_id, T1.item_no, T1.item_name, T1.z_price, T1.item_company, T1.reg_date 
													from $ItemTable T1, $Gnt_ItemTable T2 
													where T2.seller_id = '$Mall_Admin_ID' and T1.item_no = T2.item_no and T2.$keyset ='$searchword' 
													order by $order Asc";
									}
										//echo "sql=$SQL";
										$dbresult = mysql_query($SQL, $dbconn);
										$numRows = mysql_num_rows($dbresult);
												
												if($numRows == 0){
													echo ("
											<td width='100%' height='5' align='center' colspan='6'>
													검색된 상품이 없습니다.</td>
													");
										}
												else{
													for ($i=0; $i<$numRows; $i++) {
														mysql_data_seek($dbresult, $i);
														$ary = mysql_fetch_array($dbresult);
														$mart_id_tmp = $ary["mart_id"];
														$item_no = $ary["item_no"];
														$item_name = $ary["item_name"];
														
														if($keyset == 'category_num'){
															$SQL1= "select * from $CategoryTable where mart_id='$mart_id' and $keyset ='$searchword'";
															$dbresult1 = mysql_query($SQL1, $dbconn);
															$numRows1 = mysql_num_rows($dbresult1);
															if($numRows1 > 0) $provider_id = "";
															else $provider_id = $mart_id_tmp;	
														}
														
														$j =  $i + 1;
												if($i % 4 == 0 || $i % 4 == 1)
													$bgcolor = '';
												else $bgcolor = '#FFFFFF'; 	  
												echo ("
									<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										<input name='checkSel[]' type='checkbox' value='$item_no#$provider_id#$item_name'>
									</td>
									<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										$j</td>
									<td width='38%' height='10' bgcolor='$bgcolor'>
										$item_name</td>
												");
												if($i % 2 == 1)
													echo ("</tr><tr>");
										
												if($i + 1 == $numRows && $i % 2 == 0){
													echo ("
									<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										</td>
									<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										</td>
									<td width='38%' height='10' bgcolor='$bgcolor'>
										</td>
													");
												}
											}
										}
									}
									if($flag == 'search' && $keyset != 'category_num'){
								?>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FE9725" align="center" colspan="6" height="25">
										<b><font color="#FFFFFF"><p align="left">검색결과(gnt)</font></b></td>
								</tr>
								<tr>
									<td width="7%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">선택</font></b></td>
									<td width="7%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">번호</font></b></td>
									<td width="35%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">상품명</font></b></td>
									<td width="8%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">선택</font></b></td>
									<td width="7%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">번호</font></b></td>
									<td width="38%" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">상품명</font></b></td>
								</tr>
								<tr>
								<?
									// 주고 받기 상품 전체 갯수구하기
									$total = 0;
									$SQL = "select * from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' and state1='2' order by gnt_no desc";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								for ($i=0; $i<$numRows; $i++) {
									mysql_data_seek($dbresult,$i);
									$ary = mysql_fetch_array($dbresult);
									$category_num = $ary["category_num"];
								
									$SQL1 = "select * from $ItemTable where (category_num = $category_num or prevno = $category_num) and $keyset like '%$searchword%' order by $order Asc";
									//echo "sql1=$SQL1";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									for ($j=0; $j<$numRows1; $j++) {
										mysql_data_seek($dbresult1,$j);
										$ary1 = mysql_fetch_array($dbresult1);
										$item_no = $ary1["item_no"];
										$total++;
									}
								}
								
								$k = 0;
									// 주고 받기 상품 가지고 오기
									$SQL = "select * from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' and state1='2' order by gnt_no desc";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								for ($i=0; $i<$numRows; $i++) {
									mysql_data_seek($dbresult,$i);
									$ary = mysql_fetch_array($dbresult);
									$category_num = $ary["category_num"];
								
									$SQL1 = "select * from $ItemTable where (category_num = $category_num or prevno = $category_num) and $keyset like '%$searchword%' order by $order Asc";
									//echo "sql1=$SQL1";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									for ($j=0; $j<$numRows1; $j++) {
										mysql_data_seek($dbresult1,$j);
										$ary1 = mysql_fetch_array($dbresult1);
										$item_no = $ary1["item_no"];
										$item_name = $ary1["item_name"];
										$provider_id = $ary1["mart_id"];
										$l = $k + 1;
										if($k % 4 == 0 || $k % 4 == 1)
												$bgcolor = '';
											else $bgcolor = '#FFFFFF'; 	  
											echo ("
								<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										<input name='checkSel[]' type='checkbox' value='$item_no#$provider_id#$item_name'>
									</td>
									<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										$l</td>
									<td width='38%' height='10' bgcolor='$bgcolor'>
										$item_name</td>
										");
											if($k % 2 == 1)
												echo ("</tr><tr>");
										
											if($k + 1 == $total && $k % 2 == 0){
												echo ("
									<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										</td>
									<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
										</td>
									<td width='38%' height='10' bgcolor='$bgcolor'>
										</td>
												");
											}
											$k++;
									}
									}
								}
							?>
							</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<td width="100%">
								<table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
									<td width="100%" bgcolor="#7BBEBD">
										<table border="0" width="100%" cellspacing="1" cellpadding="3">
											<tr>
											<td width="100%" bgcolor="#E9F5F5" height="30">
												
												<table border="0" width="100%">
													<tr>
														<td width="100%">
															<input onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택"><strong> </strong>
															<input onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;<font color="#3D918A">하여 
															&nbsp;관리자 지정상품으로 </font>
															<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="submit" value="등록"></td>
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
					</div>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					<input onclick="window.location.href='adminmain_item.php?banner_no=<?=$banner_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로"></td>
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
if ($flag == "to_adminmain_item"){
	for($i=0; $i<count($checkSel); $i++) {
		$check_values = explode("#", $checkSel[$i]);
		$item_no = $check_values[0];
		$provider_id = $check_values[1];
		$item_name = $check_values[2];

		$sql0 = "select prevno, category_num from $ItemTable where item_no='$item_no'";
		$res0 = mysql_query($sql0, $dbconn);
		$row0 = mysql_fetch_array( $res0 );
		$prevno = $row0[prevno];
		$category_num = $row0[category_num];

		//1차 카테고리
		$sql1 = "select prevno from $CategoryTable where category_num='$prevno'";
		$res1 = mysql_query($sql1, $dbconn);
		$row1 = mysql_fetch_array( $res1 );
		$firstno = $row1[prevno];
		
		$SQL = "select count(*) from $Admin_ItemTable where mart_id='$mart_id' and item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);

		if ($dbresult == false) echo "쿼리 실행 실패!";

		if (mysql_result($dbresult,0,0) > 0){
			echo ("
			<script language='javascript'>
				alert(\"$item_name 은 이미 등록하신 상품입니다.\");
			</script>
			");
			continue;
		} 
		
		$SQL = "select max(adminmain_item_order), count(*) from $Admin_ItemTable";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";

		if (mysql_result($dbresult,0,1) > 0) 
			$maxadminmain_item_order = mysql_result($dbresult, 0, 0);
		else
			$maxadminmain_item_order = 0;
		
		$maxadminmain_item_order = $maxadminmain_item_order + 1;

		$SQL = "insert into $Admin_ItemTable (adminmain_item_no,item_no, firstno, prevno, category_num, mart_id, provider_id, adminmain_item_order, adminmain_parent) values ('', '$item_no', '$firstno', '$prevno', '$category_num', '$mart_id', '$provider_id', $maxadminmain_item_order, '$banner_no')";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=adminmain_item.php?banner_no=$banner_no'>";
	
}

if($flag=="del"){

	if($target == 'fav'){
		$SQL = "delete from $Admin_ItemTable where adminmain_item_no = $adminmain_item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	if ($dbresult == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=adminmain_item_new.php?banner_no=$banner_no'>";
}
if($flag == "up"){
	if(!empty($adminmain_item_no)&&!empty($adminmain_item_order)){
		$SQL = "select adminmain_item_order from $Admin_ItemTable where adminmain_item_order > $adminmain_item_order and mart_id='$mart_id' order by adminmain_item_order Asc";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";
		$up_adminmain_item_order = mysql_result($dbresult,0,0);
		
		$SQL = "select adminmain_item_no from $Admin_ItemTable where adminmain_item_order = $up_adminmain_item_order and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";
		$up_adminmain_item_no = mysql_result($dbresult,0,0);

		$SQL = "update $Admin_ItemTable set adminmain_item_order = $up_adminmain_item_order where adminmain_item_no = $adminmain_item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";

		$SQL = "update $Admin_ItemTable set adminmain_item_order = $adminmain_item_order where adminmain_item_no = $up_adminmain_item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";
	}

	echo "<meta http-equiv='refresh' content='0; URL=adminmain_item_new.php?banner_no=$banner_no'>";
}

	

	

?>
<?
mysql_close($dbconn);
?>