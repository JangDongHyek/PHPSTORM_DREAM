<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select if_gnt_item from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$if_gnt_item = mysql_result($dbresult,0,0); //0:일반상점 1:공급상점 2:판매상점

if($flag == "") {
	include "../admin_head.php";
?>
<script language="JavaScript">
<!-- 
function OpenWindow() {
RemindWindow = window.open( "", "mainpage","toolbar=no,width=665,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no" 
);
}
// -->
</script>
<script>
function checkform(f){
	if(f.searchword.value==''){
		alert("검색어를 입력하세요.");
		f.searchword.focus();
		return false;
	}
	else return true;
}
function update(f){
	f.flag.value='diff';
	
	var Digit = '1234567890'
	var Digit1 = '1234567890.'
	if(f.type.value=='amount'){
		if (f.amount.value==""){
			alert("금액을 입력하세요");
			f.amount.focus();
			return false;
		}
		else{
			var len =f.amount.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
			  var ch = f.amount.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("숫자만 입력 하세요");
						f.amount.focus();
						return false;
				}
				ret = false;
			}	
		}
		return true;
	}
	
	if(f.type.value=='rate'){
		var amountchk;
		amountchk = 0;
		if (f.amount.value ==""){
	  	alert("비율을 입력하세요");
			f.amount.focus()
			return false;
		}
		else {	
      for (var j=0; j < f.amount.value.length ; j++ ) {
      	var ch= f.amount.value.substring(j,j+1)
        if (ch== "." ) {
					amountchk = amountchk + 1;
      	}
	      for (var k=0;k<=Digit1.length;k++){				
					if(Digit1.substring(k,k+1) == ch){					
						ret = true;
						break;					
					}
				}	
				if (!ret){
					alert("숫자와 소숫점만 입력 하세요");
					f.amount.focus();
					return false;
				}
				ret = false;
			}
      if (amountchk > 1 ) {
       	alert("유효한 비율을 입력하세요!");
				f.amount.focus(); 
				return false;
      }
      if (amountchk == 1 ){
      	ch= f.amount.value.substring(j-2,j-1)
      	if (ch!= "."){
      		alert("소숫점하위 한자리까지만 입력 하세요");
					f.amount.focus();
					return false;
      	}	 
      }	 
  	}  
	  return true;  
	}
	
		    
}
function toggle(val) {
	dl = document.list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
}
function del_item(f)
{
  if (confirm("선택한 상품을 삭제하시겠습니까?")){
		f.flag.value='del_item';
		f.submit();
	}
	return true;
}
</script>
</head>

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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>전체상품일괄관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="97%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td vAlign="top" width="90%" bgColor="#ffffff"><b>[전체상품 일괄관리]</b>
				  상품명을 클릭하시면 해당 상품을 수정하실 수 있습니다.<br>
				  검색한 전체상품에 대해 마일리지와 판매가를 변경하실려면, 
				  하단의 정액/정률 수정을 이용하여 주세요.<br>
				  </td>
				</tr>
				<tr>
				  <td><table border="0" width="100%">
					 <tr>
						<td width="50%"></td>
						<td width="50%" align="right">
						<table border="0" width="200" cellspacing="0"
						cellpadding="0">
						  <tr>
							 <td width="100%" bgcolor="#D5D5D5">
							 <table border="0" width="100%" cellspacing="1" cellpadding="2">
							 
							 <form action='item_find.php' method='post'>
							 <input type='hidden' name='page' value='<?echo $page?>'>
							 <input type='hidden' name='keyset' value='<?echo $keyset?>'>
							<input type='hidden' name='searchword' value='<?echo $searchword?>'>
							<input type='hidden' name='order' value='<?echo $order?>'>
							<?
							if ($cnfPagecount == "") $cnfPagecount = 10;
							?>
								<tr>
								  <td width="100%" bgcolor="#F6F6F6"><p align="center">페이지당 
								  출력갯수&nbsp; 
								  <select name="cnfPagecount" onchange='this.form.submit()' style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px" size="1">
									 <option value="10"
									 <?
									 if($cnfPagecount == 10) echo " selected";
									 ?>
									 >10</option>
									 <option value="50"
									 <?
									 if($cnfPagecount == 50) echo " selected";
									 ?>
									 >50</option>
									 <option value="100"
									 <?
									 if($cnfPagecount == 100) echo " selected";
									 ?>
									 >100</option>
								  </select></td>
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
				  <td></td>
				</tr>
				<tr>
				  <td vAlign="top" width="100%" bgColor="#ffffff" align="left">
				  <table width="100%" border="0">
					 <tr>
						<td width="100%" bgColor="#cccccc">
						<table cellSpacing="0" cellPadding="0" width="100%" border="0">
						  <tr>
							 <td width="100%" bgColor="#f7f7f7" height="30">
							 <table border="0" width="103%" cellspacing="0" cellpadding="0">
								
								<form method='post' name='search' onsubmit='return checkform(this)'>
								<input type='hidden' name='keyset' value='category_num'>
								<input type='hidden' name='page' value='1'>
								<input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
								
								<tr>
								  <td width="18%" height="25">&nbsp; 카테고리별 검색</td>
								  <td width="33%" height="25">
									<select name='searchword' size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
<?
$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno=0 and if_hide='0' order by category_num desc";
$dbresult = mysql_query($SQL, $dbconn);

$tmp_category_num = $category_num;
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$category_num = $ary["category_num"];
	$category_name = $ary["category_name"];
	
	$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno=$category_num and if_hide='0' order by category_num desc";
	$dbresult2 = mysql_query($SQL, $dbconn);
	$numRows1 = mysql_num_rows($dbresult2);
	
	echo ("
	<option value='$category_num'>▷$category_name</option>
	");
				
	for($j=0;$j<$numRows1;$j++){
		mysql_data_seek($dbresult2,$j);
		$ary1 = mysql_fetch_array($dbresult2);
		$category_num1 = $ary1["category_num"];
		$category_name1 = $ary1["category_name"];

		$SQL3 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num1' order by category_num desc";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);
		
		echo ("
			<option value='$category_num1'> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>
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
		}
	}
}
?>
									</select>
								  </td>
								  <td width="13%" height="25"><p align="center">정렬순서</td>
								  <td width="18%" height="25">
									<select name='order' size="1" style="height: 18px; border: 1px solid black">
										<option value="item_name"
										<?
										if($keyset=='category_num'&& $order == 'item_name') echo " selected";
										?>
										>상품명</option>
										<option value="item_company"
										<?
										if($keyset=='category_num'&& $order == 'item_company') echo " selected";
										?>
										>제조사순</option>
										<option value="z_price"
										<?
										if($keyset=='category_num'&& $order == 'z_price') echo " selected";
										?>
										>가격순</option>
										<option value="reg_date"
										<?
										if($keyset=='category_num'&& $order == 'reg_date') echo " selected";
										?>
										>등록순</option>
									</select>
								  </td>
								  <td width="21%" height="25">
								  <input  style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"></td>
								</tr>
								</form>
								<tr>
								  <td width="18%" height="3"></td>
								  <td width="33%" height="3"></td>
								  <td width="13%" height="3"></td>
								  <td width="18%" height="3"></td>
								  <td width="21%" height="3"></td>
								</tr>
								<form method='post' name='search' onsubmit='return checkform(this)'>
								<input type='hidden' name='page' value='1'>
								<input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
								<tr>
								  <td width="18%" height="25">&nbsp; 상품 검색</td>
								  <td width="33%" height="25">
									<select name="keyset" size="1">
										<option value="item_name" <?if($keyset == "item_name") echo " selected";?>>상품명</option>
										<!-- <option value="provider_id" <?if($keyset == "provider_id") echo " selected";?>>입점몰명</option> -->
									</select>
									<input name="searchword" value='<?if(($keyset=='item_name')||$keyset=='provider_id') echo $searchword?>' class="input_03" size="20">
								  </td>
								  <td width="13%" height="25"><p align="center">정렬순서</td>
								  <td width="18%" height="25">
									<select name='order' size="1" style="height: 18px; border: 1px solid black">
										<option value="item_name" <?if($order == 'item_name') echo " selected";?>>상품명</option>
										<option value="item_company" <?if($order == 'item_company') echo " selected";?>>제조사순</option>
										<option value="z_price" <?if($order == 'z_price') echo " selected";?>>가격순</option>
										<option value="reg_date" <?if($order == 'reg_date') echo " selected";?>>등록순</option>
									</select>
								  </td>
								  <td width="21%" height="25">
								  <input  style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"></td>
								</tr>
								</form>
							 </table>
							 </td>
						  </tr>
						</table>
						</td>
					 </tr>
					 <tr>
						<td width="100%" bgColor="#ffffff"></td>
					 </tr>
					 <tr>
						<td width="100%" bgColor="#cccccc">
						<table cellSpacing="1" cellPadding="3" width="100%" bgColor="#f7f7f7" border="0">
						  <tr bgColor="#FCB663" height="25" align='center'>
							 <td width="5%"><b><font color="#ffffff"></font></b></td>
							 <td width="7%"><b><font color="#ffffff">No</font></b></td>
							 <td width="40%"><b><font color="#ffffff">상품명</font></b></td>
							 <!-- <td width="15%"><b><font color="#ffffff">입점몰명</font></b></td> -->
							 <td width="12%"><b><font color="#ffffff">판매가</font></b></td>
							 <td width="12%"><b><font color="#ffffff">공급가</font></b></td>
							 <td width="12%"><b><font color="#ffffff">마일리지</font></b></td>
							 <td width="12%"><b><font color="#ffffff">출력여부</font></b></td>
						  </tr>
						  
						  <form name='list' action='item_find.php' method='post'>
						  <input type='hidden' name='flag' value='update'>
						  <input type='hidden' name='page' value='<?echo $page?>'>
						  <input type='hidden' name='keyset' value='<?echo $keyset?>'>
						  <input type='hidden' name='searchword' value='<?echo $searchword?>'>
						  <input type='hidden' name='order' value='<?echo $order?>'>
						  <input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
<?
$searchword = trim($searchword);
if(!empty($keyset)&&!empty($searchword)){
	if($keyset == 'item_name'){
		$SQL = "select mart_id, item_no, item_name, item_company, z_price, reg_date ,bonus, member_price, price, provider_id from $ItemTable where mart_id='$mart_id' and binary lower($keyset) like lower('%$searchword%') UNION select T1.mart_id, T1.item_no, T1.item_name, T1.item_company, T1.z_price, T1.reg_date, T1.bonus, T1.member_price, T1.price, T1.provider_id from $ItemTable T1, $Gnt_ItemTable T2 where T2.seller_id='$Mall_Admin_ID' and T1.item_no= T2.item_no and binary lower(T1.$keyset) like lower('%$searchword%') order by $order asc";
	}
	if($keyset == 'category_num'){
		$SQL = "select mart_id, item_no, item_name, item_company, z_price, reg_date ,bonus, member_price, price, provider_id from $ItemTable where mart_id='$mart_id' and $keyset= '$searchword' UNION select T1.mart_id, T1.item_no, T1.item_name, T1.item_company, T1.z_price, T1.reg_date, T1.bonus, T1.member_price, T1.price, T1.provider_id from $ItemTable T1, $Gnt_ItemTable T2 where T2.seller_id='$Mall_Admin_ID' and T1.item_no= T2.item_no and T2.$keyset ='$searchword' order by $order asc";
	}
	if($keyset == 'provider_id' ){
		$SQL = "SELECT * FROM $ItemTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' order by $order Asc";
	}

	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);

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

	for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
		if ($i >= $numRows) break;
		mysql_data_seek($dbresult, $i);
		$ary = mysql_fetch_array($dbresult);

		$mart_id_tmp = $ary[mart_id];
		$item_no = $ary[item_no];
		$item_name = $ary[item_name];
		$z_price = $ary[z_price];
		$bonus = $ary[bonus];
		$price = $ary[price];
		$member_price = $ary[member_price];
		$provider_id = $ary[provider_id];

		if( $provider_id ){
			$sql5 = "select * from $MemberTable where username='$provider_id'";
			$res5 = mysql_query( $sql5, $dbconn );
			$row5 = mysql_fetch_array( $res5 );
			$membername = $row5[name];
		}else{
			$membername = '없음';
		}
	
		if($mart_id_tmp == $Mall_Admin_ID){//내상품
			$SQL1 = "select if_hide from $ItemTable where mart_id='$mart_id' and item_no=$item_no"; 
			$dbresult1 = mysql_query($SQL1, $dbconn);
			$if_hide = mysql_result($dbresult1,0,0);
		}else{
			$SQL1 = "select seller_price,seller_bonus from $Gnt_ItemTable where item_no = $item_no and seller_id='$Mall_Admin_ID'";
			$dbresult1 = mysql_query($SQL1, $dbconn);
			$seller_price = mysql_result($dbresult1,0,0);
			$seller_bonus = mysql_result($dbresult1,0,1);
			
			if($seller_price > 0) $z_price = $seller_price;
			if($seller_bonus > 0) $bonus = $seller_bonus;
			
		}
		$j = $numRows - $i;
		if($i%2==0) $bgcolor='#EFEFEF';
		else $bgcolor='#FFFFFF';
		echo "					
						  <input type='hidden' name='item_no[]' value='$item_no'>
						  <tr align='center' bgcolor='$bgcolor'>
							 <td><input type='checkbox' name='checkSel[]' value='$item_no!$mart_id_tmp'></td>
							 <td>$j</td>
							 <td align='left'><a href='win_item_edit.php?item_no=$item_no' onfocus='this.blur()' target='mainpage' onclick='OpenWindow()'>$item_name</a></td>
							 <td>$membername</td>
							 <td><input name='z_price[]' value='$z_price' class='input_03' size='10'></td>
							 <td><input name='member_price[]' value='$member_price' class='input_03' size='10'></td>
							 <td><input name='bonus[]' value='$bonus'  class='input_03' size='10'></td>
							 <td>
								 <select name='if_hide[]' class='bb' style='BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px' size='1' $disabled>
								 <option value='0'
										";
										if($if_hide == '0') echo " selected";
										echo ">Yes</option>
								 <option value='1'
										";
										if($if_hide == '1') echo " selected";
										echo "
									>No</option>
								 </select>
							 </td>
						  </tr>
								";
							}
						  }	
						  ?>
						  </table>
						</td>
					 </tr>
					 <tr>
						  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
							<table border="0" width="100%" cellspacing="0" cellpadding="0">
							 <tr>
								<td width="100%" height="10"></td>
							 </tr>
							 <tr>
								<td width="100%" bgcolor="#7BBEBD">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
								  <tr>
									 <td width="100%" bgcolor="#E9F5F5" height="30">
									 <table border="0" width="100%">
										<tr>
										  <td width="30%">
										  <input  onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택">
										  <input  onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;
										  &nbsp;</td>
										  <td width="70%"><p align="right">
										  <input  onclick="del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="삭제"></td>
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
						<td width="91%" bgColor="#ffffff"><p align="right"><br>
								<?
							if($page == 1){
								echo ("
								처음
								");
							}
							else{
								echo ("
								<a href='item_find.php?page=1&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>처음</a> 
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='item_find.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>
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
								<a href='item_find.php?page=$i&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>$i</a> 	
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='item_find.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>
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
								<a href='item_find.php?page=$total_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>끝</a> 
								");
							}
							?></td>
					 </tr>
					 <tr>
						<td width="91%" bgColor="#ffffff"><p align="center">&nbsp; 
						<input  style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="저장하기"></p>
						</td>
					 </tr>
					 
					 <tr>
						<td width="100%" bgColor="#cccccc">
						<table cellSpacing="1" cellPadding="3" width="100%" bgColor="#f7f7f7" border="0">
						  <tr>
							 <td align="middle" width="100%" bgColor="#FCB663" height="25"><p align="left">
							 <b><font color="#ffffff">정액(정률)으로 수정하기</font></b>
							 (현재페이지에 출력된 상품에 대해서만 수정됩니다.)</td>
						  </tr>
						  <tr>
							 <td align="center" width="100%" bgcolor="#EFEFEF"><p align="left">
							 <select  size="1" name="target">
								<option value="z_price" selected>판매가</option>
								<option value='member_price'>공급가</option>
								<option value="bonus">마일리지</option>
							 </select>
							 를 
							 <select  size="1" name="p_m">
								<option value="+" selected>+</option>
								<option value="-">-</option>
							 </select> 
							 
							 <input name="amount"  class="input_03" size="16">
							 <select  size="1" name="type">
								<option value="amount" selected>원</option>
								<option value="rate">%</option>
							 </select> 
							 만큼 
							 <input onclick='return update(this.form)'  style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="적용">합니다.</td>
						  </tr>
						</table>
						</td>
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
		$SQL = "select mart_id from $ItemTable where item_no = $item_no[$i]";
		$dbresult = mysql_query($SQL, $dbconn);
		$mart_id_tmp = mysql_result($dbresult,0,0);
		if($mart_id_tmp == $Mall_Admin_ID){//내상품
			if($if_gnt_item == '1')
				$SQL = "update $ItemTable set z_price = $z_price[$i], bonus = $bonus[$i], if_hide='$if_hide[$i]', member_price='$member_price[$i]' where item_no = $item_no[$i] and mart_id='$mart_id'";
			else
				$SQL = "update $ItemTable set z_price = $z_price[$i], bonus = $bonus[$i], if_hide='$if_hide[$i]', member_price='$member_price[$i]' where item_no = $item_no[$i] and mart_id='$mart_id'";
		}
		else{//gnt 사품
			$SQL = "update $Gnt_ItemTable set seller_price = '$z_price[$i]', seller_bonus='$bonus[$i]' 
			where seller_id = '$Mall_Admin_ID' and item_no = $item_no[$i]";
		}	

 		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_find.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>";
}
if($flag == 'diff'){
	for($i=0; $i<count($item_no); $i++) {
		
		$SQL0 = "select mart_id from $ItemTable where item_no = $item_no[$i]";
		//echo "sql=$SQL";
		$dbresult0 = mysql_query($SQL0, $dbconn);
		$mart_id_tmp = mysql_result($dbresult0,0,0);
		
		if($mart_id_tmp == $Mall_Admin_ID){//내상품
			if($target == 'z_price'){
				if($type == 'amount')
					$SQL = "update $ItemTable set z_price = z_price $p_m $amount where item_no = $item_no[$i] and mart_id='$mart_id'";
				if($type == 'rate')
					$SQL = "update $ItemTable set z_price = TRUNCATE(z_price $p_m (z_price * $amount /100),-2) where item_no = $item_no[$i] and mart_id='$mart_id'";
			}
			if($target == 'bonus'){
				if($type == 'amount')
					$SQL = "update $ItemTable set bonus = bonus $p_m $amount where item_no = $item_no[$i] and mart_id='$mart_id'";
				if($type == 'rate')
					$SQL = "update $ItemTable set bonus = bonus $p_m (bonus * $amount /100) where item_no = $item_no[$i] and mart_id='$mart_id'";
			}
			if($target == 'member_price'){
				if($type == 'amount')
					$SQL = "update $ItemTable set member_price = member_price $p_m $amount where item_no = $item_no[$i] and mart_id='$mart_id'";
				if($type == 'rate')
					$SQL = "update $ItemTable set member_price = TRUNCATE(member_price $p_m (member_price * $amount /100),-2) where item_no = $item_no[$i] and mart_id='$mart_id'";
			}	
		}
		else{//gnt 사품
			if($target == 'z_price'){
				//현재 gnt_item테이블에 가격이 0보다 큰지 확인 하여 크면 gnt_item 테이블 그대로 수정.
				//아니면 item테이블에서 가격 가져와서 수정
				$SQL = "select seller_price from $Gnt_ItemTable where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
				$dbresult = mysql_query($SQL, $dbconn);
				$seller_price = mysql_result($dbresult,0,0);
				if($seller_price > 0){
					if($type == 'amount')
						$SQL = "update $Gnt_ItemTable set seller_price = seller_price $p_m $amount where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
					if($type == 'rate')
						$SQL = "update $Gnt_ItemTable set seller_price = TRUNCATE(seller_price $p_m (seller_price * $amount /100),-2) where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
				}
				else{
					$SQL = "select z_price from $ItemTable where item_no = $item_no[$i]";
					$dbresult = mysql_query($SQL, $dbconn);
					$z_price = mysql_result($dbresult,0,0);
					//echo "sql=$SQL";
					if($type == 'amount')
						$SQL = "update $Gnt_ItemTable set seller_price = $z_price $p_m $amount where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
					if($type == 'rate')
						$SQL = "update $Gnt_ItemTable set seller_price = TRUNCATE($z_price $p_m ($z_price * $amount /100),-2) where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
				}	
			}
			if($target == 'bonus'){
				
				//현재 gnt_item테이블에 마일리지가 0보다 큰지 확인 하여 크면 gnt_item 테이블 그대로 수정.
				//아니면 item테이블에서 마일리지 가져와서 수정
				$SQL = "select seller_bonus from $Gnt_ItemTable where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
				$dbresult = mysql_query($SQL, $dbconn);
				$seller_bonus = mysql_result($dbresult,0,0);
				if($seller_bonus > 0){
					if($type == 'amount')
						$SQL = "update $Gnt_ItemTable set seller_bonus = seller_bonus $p_m $amount where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
					if($type == 'rate')
						$SQL = "update $Gnt_ItemTable set seller_bonus = seller_bonus $p_m (seller_bonus * $amount /100) where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
				}
				else{
					$SQL = "select bonus from $ItemTable where item_no = $item_no[$i]";
					$dbresult = mysql_query($SQL, $dbconn);
					$bonus = mysql_result($dbresult,0,0);
					
					if($type == 'amount')
						$SQL = "update $Gnt_ItemTable set seller_bonus = $bonus $p_m $amount where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
					if($type == 'rate')
						$SQL = "update $Gnt_ItemTable set seller_bonus = $bonus $p_m ($bonus * $amount /100) where item_no = $item_no[$i] and seller_id='$Mall_Admin_ID'";
						
				}		
			}	
		}	

 		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_find.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>";
}
if ($flag == "del_item") {
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		//if($Mall_Admin_ID == $mart_id){ // 내상품이면
		
			$SQL = "select img,img_big,img_sml from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if($numRows>0) {
				$img = mysql_result($dbresult,0,0);
				$img_big = mysql_result($dbresult,0,1);
				$img_sml = mysql_result($dbresult,0,2);
			
				if($img_sml != ""&&file_exists("$Co_img_UP$mart_id/$img_sml")){ 
					unlink ("$Co_img_UP$mart_id/$img_sml");	
				}
				if($img_big != ""&&file_exists("$Co_img_UP$mart_id/$img_big")){ 
					unlink ("$Co_img_UP$mart_id/$img_big");	
				}
				if($img != ""&&file_exists("$Co_img_UP$mart_id/$img")){
					unlink ("$Co_img_UP$mart_id/$img");	
				}
			}	

			//상품자체를 삭제
			$SQL = "delete from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//다른 상점들 gnt_item 테이블에서 삭제
			$SQL = "delete from $Gnt_ItemTable where item_no = $item_no";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//내상점과 다른 상점들 신상품, 인기상품, 추천상품, 선물 에서 삭제
			//신상품에서 삭제	
			$SQL = "delete from $New_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//인기상품에서 삭제
			$SQL = "delete from $Fav_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//추천상품에서 삭제
			$SQL = "delete from $Rec_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//선물상품에서 삭제
			$SQL = "delete from $Gift_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
		/*}
		else { //gnt로 가져온 상품이면
			//gnt_item 테이블에서 삭제
			$SQL = "delete from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and item_no = $item_no";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//내상점의 신상품, 인기상품, 추천상품, 선물 에서 삭제
			
			//신상품에서 삭제	
			$SQL = "delete from $New_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//인기상품에서 삭제
			$SQL = "delete from $Fav_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//추천상품에서 삭제
			$SQL = "delete from $Rec_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//선물상품에서 삭제
			$SQL = "delete from $Gift_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		}*/
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_find.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>";
}
?>		
<?
mysql_close($dbconn);
?>