<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//카테고리 현재 위치
$cur_category_name = category_navi($category_num);
$tmp_category_num = $category_num;

$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	$service_name = mysql_result($dbresult,0,0);
}

//========================================================================================
if (isset($flag) == false) {
	if (isset($prevno) == false) $prevno = 0;
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
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
			frameobj.location = "all_item_list.php?pu=<?=$pu?>&category_num=" + sel.options[index].value;
	  }
  }
}

function checkform(f){
  	if (f.category_name.value=="") {
		alert("카테고리 명을 입력해주세요.");
		f.category_name.focus();
		return false;
	}
	return true;
}
function checkform1(f){
  	if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	return true;
}
function really2(item_no, tmp_category_num, mart_id){
	if (confirm("현재상품을 삭제하시겠습니까?")){
		document.location.href='all_item_list.php?pu=<?=$pu?>&delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num+'&mart_id='+mart_id;
	}
}

function del_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 삭제하시겠습니까?")){
		f.flag.value='del_item1';
		f.submit();
	}
	return true;
}

function to_item(f){
  if (confirm("선택한 상품의 순서를 변경하시겠습니까?")){
		f.flag.value='to_item';
		f.submit();
	}
	return true;
}

function hide_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 숨기시겠습니까?")){
		f.flag.value='hide_item';
		f.submit();
	}
	return true;
}

function see_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 출력하시겠습니까?")){
		f.flag.value='see_item';
		f.submit();
	}
	return true;
}

function sold_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 품절로 하시겠습니까?")){
		f.flag.value='sold_item';
		f.submit();
	}
	return true;
}

function sale_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품의 품절을 해제하시겠습니까? \n재고량은 기본 100개로 설정됩니다.")){
		f.flag.value='sale_item';
		f.submit();
	}
	return true;
}

function update_item(f){
  if (confirm("상품을 수정 하시겠습니까?")){
		f.flag.value='update_item';
		f.submit();
}
	return true;
}

function fee_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 착불배송으로 하시겠습니까?")){
		f.flag.value='fee_item';
		f.submit();
	}
	return true;
}

function prefee_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 선불배송으로 하시겠습니까?")){
		f.flag.value='prefee_item';
		f.submit();
	}
	return true;
}

function checkitems(){
	var i;
	a_checkbox  = document.getElementsByName("checkSel[]");
	for(i=0; i<a_checkbox.length; i++)
	{
		if(a_checkbox[i].checked == true)
			break;
	}
	if(i==a_checkbox.length)
	{
		alert("상품을 선택하세요.");
		return false;
	}
	return true;
}

function move_item(f){
	if(!checkitems())
	{
		return false;
	}
  if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	f.flag.value='move_item';
	f.submit();
	return true;
}

function toggle(val) {
	dl = document.list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
}

function no_search(){
	document.search_form.searchword.value='';
	document.search_form.submit();
}

function check_ver(first_no,second_no,thirdno,category_num){
	window.location.href="./item_add.php?pu=<?=$pu?>&first_no=" + first_no + "&second_no=" + second_no + "&thirdno=" + thirdno + "&category_num=" + category_num;
}

//-->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<?
//$left_menu = "3_1";
//include "../include/left_menu03_1.php";
?>
<table width="600" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		 <td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="40" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>현재카테고리 : <?=$cur_category_name?></b></td>
				</tr>
			</table>
			<!--내용 START~~-->
			<table border="0" width="98%" cellspacing="0" cellpadding="0" align='center'>
			<!-- <tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="right">
					<span class="ee"><b>카테고리 이동</b>&nbsp;&nbsp;
					<select onchange="goto_byselect(this, 'self')" class="aa" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
<?
/*
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
					<option value='all_item_list.php?category_num=$category_num'
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
					<option value='all_item_list.php?category_num=$category_num1'
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
						<option value='all_item_list.php?category_num=$category_num3'
			");
			if($tmp_category_num == $category_num3){
				echo "selected";
				$cur_category_name = $category_name3;
			}
			echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");
		}
	}
}
// 주고 받기 카테고리..

$SQL = "select category_num from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' order by gnt_no desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	$category_num_tmp = mysql_result($dbresult,$i,0);
	$SQL1 = "select category_num,category_name,provider_id from $CategoryTable where category_num = $category_num_tmp";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	for ($j=0; $j<$numRows1; $j++) {
		$category_num1 = mysql_result($dbresult1,$j,0);
		$category_name1 = mysql_result($dbresult1,$j,1);
		$provider_id1 = mysql_result($dbresult1,$j,2);

		$SQL2 = "select category_num,category_name from $CategoryTable where prevno=$category_num1 order by cat_order desc";
		$dbresult2 = mysql_query($SQL2, $dbconn);
		$numRows2 = mysql_num_rows($dbresult2);
							echo ("
						<option value='item_list_gnt.php?category_num=$category_num1'
							");
							if($tmp_category_num == $category_num1) {
								echo "selected";
								$cur_category_name = $category_name1;
							}
							echo (" style='color:#000000; background-color:#dddddd;'>▷$category_name1</option>
							");

							for($k=0;$k<$numRows2;$k++){
								$category_num2 = mysql_result($dbresult2,$k,0);
								$category_name2 = mysql_result($dbresult2,$k,1);

								echo ("
						<option value='item_list_gnt.php?category_num=$category_num2'
								");
								if($tmp_category_num == $category_num2){
									echo "selected";
									$cur_category_name = $category_name2;
								}
								echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name2</option>");
							}
						}
}*/
?>

					</select><br>
					<br>
					</span>
				</td>
			</tr> -->
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%">
					<form onsumbit='return checkform(this)'>
					<input type='hidden' name='pu' value='<?=$pu?>'>
					<!-- <input type='hidden' name='flag' value='addcategory'> -->
					<input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
					<input type='hidden' name='page' value='<?=$page?>'>
					<input type='hidden' name='searchword' value='<?=$searchword?>'>
					<input type='hidden' name='select_key' value='<?=$select_key?>'>
					<input type='hidden' name='category_num' value='<?=$tmp_category_num?>'>
					<tr height="20">
						<td>
<?
//=========================== 해당 상위 카테고리 정보를 불러옴 ============================
$SQL = "select prevno from $CategoryTable where category_num='$tmp_category_num' and mart_id='$mart_id'";
//echo $SQL;
$dbresult = mysql_query($SQL, $dbconn);
$prevno = mysql_result($dbresult,0,0);
if($prevno > 0)
{
	//=========================== 해당 상위 카테고리 정보를 불러옴 ============================
	$SQL = "select prevno from $CategoryTable where category_num='$prevno' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$prevno2 = mysql_result($dbresult,0,0);
	if($prevno2 > 0)
	{
		//=========================== 해당 상위 카테고리 정보를 불러옴 ============================
		$SQL = "select prevno from $CategoryTable where category_num='$prevno2' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$prevno3 = mysql_result($dbresult,0,0);
	}
}
if( $pu == 1 ){ //1차 카테고리 리스트 일때
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "firstno='$tmp_category_num'";			// 1차 상품등록
	$con1 = "a.firstno='$tmp_category_num'";
	$first_no = $tmp_category_num;
	$second_no = 0;
	$thirdno = 0;
	$category_num = $tmp_category_num;
}else if( $pu == 2 ){ //2차 카테고리 리스트 일때
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "prevno='$tmp_category_num'";			// 3차 상품등록
	$con1 = "a.prevno='$tmp_category_num'";
	$first_no = $prevno;
	$second_no = $tmp_category_num;
	$thirdno = 0;
	$category_num = $tmp_category_num;
}else if($pu == 3){ //3차 카테고리 리스트 일때
	$con = "thirdno='$tmp_category_num'";
	$con1 = "a.thirdno='$tmp_category_num'";
	$first_no = $prevno2;
	$second_no = $prevno;
	$thirdno = $tmp_category_num;
	$category_num = $tmp_category_num;
}else if($pu == 4){ //3차 카테고리 리스트 일때
	$con = "category_num='$tmp_category_num'";
	$con1 = "a.category_num='$tmp_category_num'";
	$first_no = $prevno3;
	$second_no = $prevno2;
	$thirdno = $prevno;
	$category_num = $tmp_category_num;
}


if($searchword !=''){
	if($select_key == "provider_id" ){
		$SQL = "SELECT count(item_no) FROM $ItemTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' and  $con1";
	}else{
		$SQL = "select count(item_no) from $ItemTable where $con and $select_key like '%$searchword%' and $con and mart_id='$mart_id'";
	}
}else{
	$SQL = "select count(item_no) from $ItemTable where $con and mart_id='$mart_id'";
}

$dbresult = mysql_query($SQL, $dbconn);
$numRows_tmp = mysql_result($dbresult,0,0);

$numRows += $numRows_tmp;
?>
						</td>
					</tr>
					</form>
					</table>
					<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
					</tr>
					<tr height='25'>
						<td width="40%" bgcolor="#FFFFFF">
							<p style="padding-left:10px">
							현재카테고리에 총 <?=$numRows_tmp?>개 상품 등록
						</td>
						<td width="60%" bgcolor="#FFFFFF" height="0">
<?
$SQL = "select count(category_num) from $CategoryTable where prevno=$tmp_category_num and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_result($dbresult,0,0);

//if($numRows == 0){
	//if( $pu == "2" ){
	//}else{
?>
							<input onclick="check_ver('<?=$first_no?>','<?=$second_no?>','<?=$thirdno?>','<?=$category_num?>')" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' value='상 품 등 록'>&nbsp;
<?
	//}
?>
							<!-- <input class='aa' onclick=\"window.location.href='item_order.php?category_num=$tmp_category_num'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='상품순서조정'>&nbsp; -->
<?
//}else{
?>
							<!-- <span class='aa'>하위 카테고리가 있어 상품을 등록할 수 없습니다.</span> -->
<?
//}
?>
						</td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" colspan="2"></td>
					</tr>
<?
if ($cnfPagecount == ""){
	$cnfPagecount = 100;
}
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

if($searchword !=''){
	if($select_key == "provider_id" ){
		$SQL = "SELECT * FROM $ItemTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' and  $con1 order by a.item_order asc, a.item_no desc";
	}else{
		$SQL = "select * from $ItemTable where $con and $select_key like '%$searchword%' and $con and mart_id='$mart_id' order by item_order asc, item_no desc";
	}
}else{
	$SQL = "select * from $ItemTable where $con and mart_id='$mart_id' order by item_order asc, item_no desc ";
}
//echo $SQL;

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
					<tr>
						<form method='post' name='search_form'>
						<input type='hidden' name='pu' value='<?=$pu?>'>
						<!-- <input type='hidden' name='flag' value='addcategory'> -->
						<input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
						<input type='hidden' name='page' value='<?=$page?>'>
						<input type='hidden' name='searchword' value='<?=$searchword?>'>
						<input type='hidden' name='select_key' value='<?=$select_key?>'>
						<input type='hidden' name='category_num' value='<?=$tmp_category_num?>'>
						<td width="50%" bgcolor="#FFFFFF">
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
								<a href='all_item_list.php?category_num=$tmp_category_num&page=1&searchword=$searchword&select_key=$select_key&pu=$pu'>처음</a>
								");
							}

							if($start_page > 1){
								echo ("
								<a href='all_item_list.php?category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
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
								<a href='all_item_list.php?category_num=$tmp_category_num&page=$i&searchword=$searchword&select_key=$select_key&pu=$pu'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='all_item_list.php?category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
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
								<a href='all_item_list.php?category_num=$tmp_category_num&page=$total_page&searchword=$searchword&select_key=$select_key&pu=$pu'>끝</a>
								");
							}
							?>
							</span>
						</td>
						<td width="50%" bgcolor="#FFFFFF" height="0" align="center">
							<select name="select_key">
								<option value="item_name" <?if($select_key == "item_name") echo " selected";?>>상품명</option>
								<option value="opt" <?if($select_key == "opt") echo " selected";?>>세부 규격 및 상품코드</option>
								<option value="item_code" <?if($select_key == "item_code") echo " selected";?>>대표 상품코드</option>
								<option value="item_kyukyuk" <?if($select_key == "item_kyukyuk") echo " selected";?>>대표 상품규격</option>
								</select>
							<input name="searchword" value='<?=$searchword?>' size="15" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
							<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="검색">
							<input onclick="location.href='<?=$PHP_SELF?>?pu=<?=$pu?>&category_num=<?=$category_num?>'" class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="해제">
						</td>
					</form>
					</tr>
					</table>
				</td>
			</tr>

			<form name='list' action='all_item_list.php' method='post' onsubmit='return checkform1(this)'>
			<input type='hidden' name='flag' value='<?=$flag?>'>
			<input type='hidden' name='pu' value='<?=$pu?>'>
			<input type='hidden' name='category_num' value='<?=$category_num?>'>
			<input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
			<input type='hidden' name='searchword' value='<?=$searchword?>'>
			<input type='hidden' name='select_key' value='<?=$select_key?>'>

			<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
					<table border="0" width="100%">
					<tr>
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="100%" bgcolor="#8FBECD" colspan="8">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp;
											<b><span class="dd">현재 카테고리에 등록된 상품 리스트</span></b>
										</td>
										<td width="50%"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#C8DFEC" align="center">
								<td width="8%">번호</td>
								<td>상품명</td>
								<td>상품규격</td>
								<td>상품코드</td>
								<td>공급가</td>
								<td>판매가</td>
								<td>최소구매수량</td>
								<td>옵션</td>
							</tr>
<?
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$row = mysql_fetch_array($dbresult);
	$item_no = $row[item_no];

	$SQL1 = "select * from $ItemTable where item_no='$item_no'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$row1 = mysql_fetch_array($dbresult1);

	$category_num_tmp = $row1[category_num];
	$mart_id = $row1[mart_id];
	$item_order_old = $row1[item_order];
	$item_name = $row1[item_name];

	$item_kyukyuk = $row1[item_kyukyuk];
	$item_code = $row1[item_code];
	$member_price = $row1[member_price];
	$z_price = $row1[z_price];
	$min_buy = $row1[min_buy];
	$opt = $row1[opt];



	if( $provider_id ){
		$sql5 = "select * from $MemberTable where username='$provider_id'";
		$res5 = mysql_query( $sql5, $dbconn );
		$row5 = mysql_fetch_array( $res5 );
		$membername = $row5[name];
	}else{
		$membername = '없음';
	}

	//if($Mall_Admin_ID == $mart_id) {
		$gnt_img = "";
		if($if_hide == '1') $hide_str = "<img src='../images/hide.gif'>";
		else $hide_str = "";
	/*}else {
		$gnt_img = "<img src='../images/gnt.gif' height='12' width='25'>";
		$hide_str = "";
	}*/


	if($jaego_use == 1 && $jaego == 0){
		$icon_str = "<img src='../images/soldout_icon_s.gif' width='25' height='12'>";
	}else{
		$icon_str = "";
	}

	$j = $numRows - $i;

//	if( $pu == "2" ){
		//$link_str = "<a onclick=\"window.open('item_edit_old.php?item_no=$item_no', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');\" style='cursor:hand'><b>$item_name</b></a> $icon_str $hide_str";
//	}else{
		$link_str = "<a href='item_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num_tmp&page=$page&searchword=$searchword&select_key=$select_key&pu=$pu'><b>$item_name</b></a> $icon_str $hide_str";
//	}
?>

							<tr bgcolor='#FFFFFF' align='center'>
							<input type='hidden' name='itemno[]' value='<?=$item_no?>'>
								<td><?=$j?></td>
								<td align='left'> <!--상품명-->
									<input type=text name="item_name[]" value="<?=$item_name?>" size=30>
								</td>
								<td align='left'> <!--상품규격-->
									<input type=text name="item_kyukyuk[]" value="<?=$item_kyukyuk?>" size=10>
								</td>
								<td align='left'> <!--상품코드-->
									<input type=text name="item_code[]" value="<?=$item_code?>" size=13>
								</td>
								<td align='left'> <!--공급가-->
									<input type=text name="member_price[]" value="<?=$member_price?>" size=10>
								</td>
								<td align='left'> <!--판매가-->
									<input type=text name="z_price[]" value="<?=$z_price?>" size=10>
								</td>
								<td align='left'> <!--최소구매수량-->
									<input type=text name="min_buy[]" value="<?=$min_buy?>" size=10>
								</td>
								<td align='left'> <!--옵션-->
									<input type=text name="opt[]" value="<?=$opt?>" size=150>
								</td>
							</tr>
<?
}
?>
							</table>
						</td>
					</tr>
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
						<td>
						&nbsp;상품을 <input onclick="update_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="수정하기">
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
   		</form>


    	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
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
}
//========================================================================================
//================== 상품수정 ===========================================================


if($flag == "update_item"){			
	for($i=0; $i<count($itemno); $i++) {

		
		$SQL = "update $ItemTable set
		item_name='$item_name[$i]'
		,item_kyukyuk='$item_kyukyuk[$i]'
		,item_code='$item_code[$i]'
		,member_price='$member_price[$i]'
		,z_price='$z_price[$i]'
		,min_buy='$min_buy[$i]'
		,opt='$opt[$i]'
		where item_no = '$itemno[$i]'";
		


		$dbresult = mysql_query($SQL, $dbconn);


	}
	echo "<meta http-equiv='refresh' content='0; URL=all_item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
?>
<?
mysql_close($dbconn);
?>
