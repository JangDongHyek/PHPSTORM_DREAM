<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	$service_name = mysql_result($dbresult,0,0);
}				
	

if($delflag=="del_category"){
	$SQL = "select count(*) from $CategoryTable where prevno = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if (mysql_result($dbresult,0,0) > 0) {
		echo ("
			<script language=\"javascript\">
				alert(\"하위카테고리가 있어 삭제할수 없습니다\");
			</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=eachcategory.php?category_num=$category_num'>";
		exit;
	}
	$SQL = "select count(*) from $ItemTable where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if (mysql_result($dbresult,0,0) > 0) {
		echo ("
			<script language=\"javascript\">
				alert(\"하위상품이 있어 삭제할수 없습니다\");
			</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=eachcategory.php?category_num=$category_num'>";
		exit;
	}
	$SQL = "delete from $CategoryTable where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=maincategory.php'>";
	exit;
}
if($delflag=="del_item"){
	//if($Mall_Admin_ID == $mart_id){ // 내상품이면
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
function checkform(f)
{
  	if (f.category_name.value=="") {
		alert("카테고리 명을 입력해주세요.");
		f.category_name.focus();
		return false;
	}
	return true;
}
function checkform1(f)
{
  	if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	return true;
}
function really2(item_no, tmp_category_num, mart_id){
	if (confirm("현재상품을 삭제하시겠습니까?")){
		document.location.href='plan_list.php?delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num+'&mart_id='+mart_id;
	}
}

function toggle(val) {
	dl = document.list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
}
function move_item(f)
{
  if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	f.flag.value='move_item';
	f.submit();
	return true;
}
function no_search(){
	document.search_form.searchword.value='';
	document.search_form.submit();
}
<?
$SQL = "select count(*) from $ItemTable where mart_id='$mart_id' and category_num='28'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$numRows = mysql_result($dbresult,0,0);
}
if($Mall_Admin_ID == 'momozang') $limit_count = 2200;
else $limit_count = 2000;

if($service_name == 'base'&& $numRows > $limit_count){
	echo "
	 function copy_item(f){
		alert(\"상품갯수가 $limit_count 개를 넘어 더 이상의 상품을 복사할 수 없습니다.\");
		return false;
	}
	";
}
else if($service_name == 'indi_base'&& $numRows > 2000){
	echo "
	 function copy_item(f){
		alert(\"상품갯수가 2000개를 넘어 더 이상의 상품을 복사할 수 없습니다.\");
		return false;
	}
	";
}
else if($service_name == 'free_base'&& $numRows > 150){
	echo "
	 function copy_item(f){
		alert(\"상품갯수가 150개를 넘어 더 이상의 상품을 복사할 수 없습니다.\");
		return false;
	}
	"	;
}
else{
	echo "
function copy_item(f)
{
  if (f.target_category.value==\"\") {
		alert(\"카테고리를 선택하세요.\");
		f.target_category.focus();
		return false;
	}
	f.flag.value='copy_item';
	f.submit();
	return true;
}
	";
}
?>

function del_item(f)
{
  if (confirm("선택한 상품을 삭제하시겠습니까?")){
		f.flag.value='del_item';
		f.submit();
	}
	return true;
}

function check_ver(category_num,prevno){
	window.location.href='plan_add.php?category_num='+category_num+'&prevno='+prevno;
}

//-->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
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
<?
$cate_SQL = "select category_name from $CategoryTable where category_num = $category_num";
$cate_dbresult = mysql_query($cate_SQL, $dbconn);
$cate_row = mysql_fetch_array($cate_dbresult);
$category_name = $cate_row[category_name];
?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b><?=$category_name?> 관리 </b> [전체 상품수 : <?=$numRows?>개]</td>
				</tr>
			</table>

			<!--내용 START~~--><br>   	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><span class="aa"><?=$category_name?>을(를)
					관리하실 수 있습니다.<br><br>
					</span>
				</td>
			</tr>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%">
					<form onsumbit='return checkform(this)'>
					<input type='hidden' name='flag' value='addcategory'>
					<input type='hidden' name='prevno' value='<?=$category_num?>'>
					
					<tr>
						<td width="50%" height="20"><strong><span class="cc">[<?=$category_name?>]</span></strong>
							</td>
						<td width="50%" height="20">
<?
$SQL = "select prevno from $CategoryTable where category_num='$category_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$prevno = mysql_result($dbresult,0,0);

$SQL = "select count(item_no) from $ItemTable where category_num='$category_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows_tmp = mysql_result($dbresult,0,0);
 
$SQL = "select count(gnt_item_no) from $Gnt_ItemTable where category_num='$category_num' and seller_id='$Mall_Admin_ID'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_result($dbresult,0,0);
									
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
					<tr>
						<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"><span class="aa"></span></td>
					</tr>
					<tr>
						<td width="50%" bgcolor="#FFFFFF" height="0">
							<p style="padding-left:10px">
							<span class="aa">총 <?=$numRows?>개의 상품이 등록되어 있습니다.</span>
						</td>
						<td width="50%" bgcolor="#FFFFFF" height="0" align="right">
							<input class='aa' onclick="check_ver('<?=$category_num?>','<?=$prevno?>')" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' value='상품 등록'>&nbsp;
							<input class='aa' onclick="window.location.href='item_order.php?category_num=<?=$category_num?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='상품순서조정'>&nbsp;
						</td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br>
						</td>
					</tr>
					<?
					if ($cnfPagecount == "") {
						if($Mall_Admin_ID == 'ins4')
						$cnfPagecount = 50;
						else
						$cnfPagecount = 50;
					}
					if ($page == "") $page = 1;
					$skipNum = ($page - 1) * $cnfPagecount;
					
					$prev_page = $page - 1;
					$next_page = $page + 1;
					
					if($searchword !=''){
						if($Mall_Admin_ID == 'ins4'){
								$SQL = "select item_no from $ItemTable where category_num = $category_num and binary replace(lower(item_name),' ','') like replace(lower('%$searchword%'),' ','') order by item_no desc";
								//$SQL = "select item_no from $ItemTable where category_num = $category_num and binary item_name regexp '$searchword' order by item_no desc";
						}
						else
						$SQL = "select item_no from $ItemTable where category_num = $category_num and binary replace(lower(item_name),' ','') like replace(lower('%$searchword%'),' ','') UNION select T1.item_no from $Gnt_ItemTable T1, $ItemTable T2 where T1.seller_id='$Mall_Admin_ID' and T1.item_no = T2.item_no and T2.item_name like '%$searchword%' and T1.category_num = $category_num order by item_no desc";
					}	
					else{
						if($Mall_Admin_ID != 'ins4')
						$SQL = "select item_no from $ItemTable where category_num = $category_num UNION select item_no from $Gnt_ItemTable where seller_id='$Mall_Admin_ID' and category_num = $category_num order by item_no desc";
						else
						$SQL = "select item_no from $ItemTable where category_num = $category_num order by item_no desc";
					}	
					//echo "sql=$SQL";
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
						<input type='hidden' name='page' value=''>
							<td width="60%" bgcolor="#FFFFFF">
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
								<a href='plan_list.php?category_num=$category_num&page=1&searchword=$searchword'>처음</a>
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='plan_list.php?category_num=$category_num&page=$prev_start_page&searchword=$searchword'>
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
								<a href='plan_list.php?category_num=$category_num&page=$i&searchword=$searchword'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='plan_list.php?category_num=$category_num&page=$next_start_page&searchword=$searchword'>
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
								<a href='plan_list.php?category_num=$category_num&page=$total_page&searchword=$searchword'>끝</a>
								");
							}
							?>
							</span></td>
							<td width="40%" bgcolor="#FFFFFF" height="0">
				<p align="right">
				<input class="aa" name="searchword" value='<?=$searchword?>' size="14" style="width:50%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
							<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="검색">
							<input onclick="javascript:no_search()" class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="해제">
						</td>
					</form>
					</tr>
					</table>
				</td>
			</tr>
			
			<form name='list' action='plan_list.php' method='post' onsubmit='return checkform1(this)'>
			<input type='hidden' name='flag' value='move_to_category'>
			<input type='hidden' name='category_num' value='<?=$category_num?>'>
			<input type='hidden' name='prevno' value='<?=$category_num?>'>
			<input type='hidden' name='searchword' value='<?=$searchword?>'>
			
			<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					<table border="0" width="95%">
					<tr>
						<td width="90%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="100%" bgcolor="#8FBECD" colspan="6">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp;
											<strong><span class="dd">현재 카테고리에 등록된 상품 리스트</span></strong>
										</td>
										<td width="50%"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="3%" bgcolor="#C8DFEC" align="center"><span class="aa">선택</span></td>
								<td width="4%" bgcolor="#C8DFEC" align="center"><span class="aa">번호</span></td>
								<td width="18%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">상품명</span></td>
								<td width="8%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">등록일</span></td>
								<td width="8%" bgcolor="#C8DFEC" align="center"><span class="aa">수정/삭제</span></td>
								<td width="6%" bgcolor="#C8DFEC" align="center"><span class="aa">조회수</span></td>
							</tr>

							<?	
									for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
										if ($i >= $numRows) break;
										mysql_data_seek($dbresult, $i);
										$ary=mysql_fetch_array($dbresult);
										$item_no = $ary["item_no"];
										
										$SQL1 = "select mart_id,item_name,reg_date,read_num,if_hide from $ItemTable where item_no = $item_no";
										$dbresult1 = mysql_query($SQL1, $dbconn);
										$mart_id = mysql_result($dbresult1,0,0);
										$item_name = mysql_result($dbresult1,0,1);
										$reg_date = mysql_result($dbresult1,0,2);
										$read_num = mysql_result($dbresult1,0,3);
										$if_hide = mysql_result($dbresult1,0,4);
										
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
								<td width='3%' bgcolor='#FFFFFF' align='center'>
									<input type='checkbox' name='checkSel[]' value='$item_no!$mart_id'></td>
								<td width='4%' bgcolor='#FFFFFF' align='center'><span class='aa'>$j</span></td>
								<td width='19%' bgcolor='#FFFFFF' align='left'><span class='aa'><a href='plan_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num_tmp&page=$page&searchword=$searchword'>$item_name</a></span>$gnt_img $hide_str</td>
								<td width='8%' bgcolor='#FFFFFF' align='left'><p align='center'>
									<span class='aa'>$reg_date</span></td>
								<td width='8%' bgcolor='#FFFFFF' align='center'>
								");
								//내상품 이면
								//if($Mall_Admin_ID == $mart_id) 
									echo ("
									<input class='aa' onclick=\"javascript:window.location.href='plan_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num_tmp&page=$page&searchword=$searchword'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
									");
								/*else //gnt 상품이면
									echo ("	
									<input class='aa' onclick=\"javascript:window.location.href='item_view_gnt_item.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num_tmp&page=$page&searchword=$searchword'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
									");*/
								echo ("	
									<input class='aa' onClick=\"really2($item_no, $category_num, '$mart_id')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'>
								</td>
								<td width='5%' bgcolor='#FFFFFF' align='center'><span class='aa'>$read_num</span></td>
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
				<tr>
			<td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center>
				<table border="0" width="95%" cellspacing="0" cellpadding="0">
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
						<input class="aa" onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택">
						<input class="aa" onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;
						&nbsp;</td>
						<td width="70%"><p align="right"><span class="bb"><font color="#3D918A">선택한 상품을 </font>
						<select class="aa" name="target_category" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
<?
$SQL = "select category_num,category_name from $CategoryTable where prevno=0 and mart_id='$mart_id' order by category_num desc";
$dbresult = mysql_query($SQL, $dbconn);

$category_num = $category_num;
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	$category_num = mysql_result($dbresult,$i,0);
	$category_name = mysql_result($dbresult,$i,1);
	
	$SQL2 = "select category_num,category_name from $CategoryTable where prevno='$category_num' and mart_id='$mart_id' order by category_num desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$numRows2 = mysql_num_rows($dbresult2);
	
	echo ("
		<option value=''>---------------</option>
		<option value='$category_num'
	");		
	echo ("	
		>▷$category_name</option>
		<option value=''>---------------</option>
	");
				
	for($j=0;$j<$numRows2;$j++){
		$category_num1 = mysql_result($dbresult2,$j,0);
		$category_name1 = mysql_result($dbresult2,$j,1);
				
		echo ("
			<option value='$category_num1'
		");	
		echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>");

		$SQL3 = "select category_num,category_name from $CategoryTable where prevno='$category_num1' and mart_id='$mart_id' order by category_num desc";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);

		for($k=0;$k<$numRows3;$k++){
			$category_num3 = mysql_result($dbresult3,$k,0);
			$category_name3 = mysql_result($dbresult3,$k,1);
			echo ("
				<option value='$category_num3'
			");	
			echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");
		}
	}
}
?>
											</select></span> 
											<input class="aa" onclick="move_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="이동"> 
											<input class="aa" onclick="copy_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="복사">
											<input class="aa" onclick="del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="삭제"></td>
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
   		
   		<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input class="aa" onclick="javascript:window.location.href='category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="카테고리 리스트로">
        	</td>
		</tr>
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
//================== 카테고리를 추가함 ===================================================
if($flag == "addcategory"){
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	else
		$maxCategory_num = 0;
	
	$SQL = "select max(cat_order), count(*) from $CategoryTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxOrder = mysql_result($dbresult, 0, 0);
	else
		$maxOrder = 0;
		
	$category_date = date("Y-m-d H:i:s");
	
	if (isset($prevno) == false) $prevno = 0;
	
	$SQL = "insert into $CategoryTable " .
		"(mart_id, category_num, prevno, category_name, category_date, category_desc, cat_order) values " .
		"('$mart_id', $maxCategory_num+1, $prevno, '$category_name', '$category_date', '$category_desc', $maxOrder+1)";
	
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=plan_list.php?category_num=$prevno'>";
}
//========================================================================================
//================== 상품 카테고리를 이동함 ==============================================
if($flag == "move_item"){
	$SQL = "select prevno from $CategoryTable where category_num=$target_category and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$target_prevno = mysql_result($dbresult,0,0);
					
									
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		//if($Mall_Admin_ID == $mart_id){ //내상품이면
			$SQL = "update $ItemTable set prevno = '$target_prevno' , category_num = '$target_category' where item_no = '$item_no' and mart_id='$mart_id'";
			
		/*}
		else{ //gnt 상품이면
			$SQL = "update $Gnt_ItemTable set prevno = '$target_prevno' , category_num = '$target_category' where item_no = '$item_no' and seller_id='$Mall_Admin_ID'";
		}*/
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=plan_list.php?category_num=$prevno&searchword=$searchword'>";
}
//========================================================================================
//================== 상품을 삭제함 =======================================================
if($flag == "del_item"){
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		//if($Mall_Admin_ID == $mart_id){ // 내상품이면
			$SQL = "select img,img_big,img_sml from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
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
			$dbresult = mysql_query($SQL, $dbconn);
			
			//다른 상점들 gnt_item 테이블에서 삭제
			$SQL = "delete from $Gnt_ItemTable where item_no = $item_no";
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

	echo "<meta http-equiv='refresh' content='0; URL=plan_list.php?category_num=$prevno'>";
}
//========================================================================================
//================== 카테고리를 복사함 ===================================================
if($flag == "copy_item"){
	for($j=0; $j<count($checkSel); $j++) {
		$checkSels = explode("!", $checkSel[$j]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
	
		//if($Mall_Admin_ID == $mart_id){ // 내상품이면
		
			$SQL = "select * from $ItemTable where item_no='$item_no' and mart_id='$mart_id' order by item_no Asc";
			//상품데이타 가져오기
			$dbresult = mysql_query($SQL, $dbconn);
			if ($dbresult == false) echo "쿼리 실행 실패!";
			$numRows = mysql_num_rows($dbresult);
			for ($i=0; $i < $numRows; $i++) {
				mysql_data_seek($dbresult, $i);
				$ary = mysql_fetch_array($dbresult);
				$item_no = $ary["item_no"];
				$mart_id = $ary["mart_id"];
				$item_name = $ary["item_name"];
				$price = $ary["price"];
				$z_price = $ary["z_price"];
				$bonus = $ary["bonus"];
				$use_bonus = $ary["use_bonus"];
				$jaego = $ary["jaego"];
				$img = $ary["img"];
				$opt = $ary["opt"];
				$doctype = $ary["doctype"];
				$item_explain = addslashes($ary["item_explain"]);
				$reg_date = $ary["reg_date"];
				$item_company = $ary["item_company"];
				$read_num = $ary["read_num"];
				$item_code = $ary["item_code"];
				$icon_no = $ary["icon_no"];
				$use_opt1 = $ary["use_opt1"];
				$use_opt23 = $ary["use_opt23"];
				$item_order = $ary["item_order"];
				$img_big = $ary["img_big"];
				$jaego_use = $ary["jaego_use"];
				$if_strike = $ary["if_strike"];
				$if_provide_item = $ary["if_provide_item"];
				$provide_price = $ary["provide_price"];
				$img_sml = $ary["img_sml"];
				$flash_big_width = $ary["flash_big_width"];
				$flash_big_height = $ary["flash_big_height"];
				$if_hide = $ary["if_hide"];
				$member_price = $ary["member_price"];
				
				$SQL1 = "select max(item_no), count(*) from $ItemTable";
				$dbresult1 = mysql_query($SQL1, $dbconn);
				if ($dbresult1 == false) echo "쿼리 실행 실패!";
				if (mysql_result($dbresult1,0,1) > 0)
					$maxItem_no = mysql_result($dbresult1, 0, 0);
				else
					$maxItem_no = 0;
			
				$maxItem_no_1 = $maxItem_no+1;
				
				if($img_big != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_big_head = "item_big_".$item_no."_";
					$img_big_ori = str_replace($img_big_head,'',$img_big);
					$img_big_new = "item_big_".$maxItem_no_1."_".$img_big_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_big"))
						copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//업로드 파일 저장
				}
				else $img_big_new = '';
				
				if($img_sml != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_sml_head = "item_sml_".$item_no."_";
					$img_sml_ori = str_replace($img_sml_head,'',$img_sml);
					$img_sml_new = "item_sml_".$maxItem_no_1."_".$img_sml_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_sml"))
						copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//업로드 파일 저장
				}
				else $img_sml_new = '';
				
				
				if($img != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_head = "item_".$item_no."_";
					$img_ori = str_replace($img_head,'',$img);
					$img_new = "item_".$maxItem_no_1."_".$img_ori;

					if(file_exists("$Co_img_UP$mart_id/$img"))
						copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
				}
				else $img_new = '';
				
				$SQL1 = "select * from $CategoryTable where category_num=$target_category and mart_id='$mart_id'";
				//echo "sql=$SQL <br>";
				$dbresult1 = mysql_query($SQL1, $dbconn);
				$numRows1 = mysql_num_rows($dbresult1);
				if($numRows1 > 0){
					mysql_data_seek($dbresult1,0);
					$ary1 = mysql_fetch_array($dbresult1);
					$target_prevno = $ary1["prevno"];
				}				
			
				if($use_opt1 == '') $use_opt1 = 'f';
				if($use_opt23 == '') $use_opt23 = 'f';
				
				$SQL1 = "insert into $ItemTable (item_no, mart_id, prevno, category_num, item_name, price, z_price, bonus, 
				use_bonus, jaego, img, img_big, opt, doctype, item_explain, reg_date, item_company, read_num, item_code, 
				icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provide_price, img_sml, 
				flash_big_width, flash_big_height, if_hide, member_price) 
				values ('$maxItem_no_1', '$mart_id', '$target_prevno', '$target_category', '$item_name', '$price', '$z_price', '$bonus', 
				'$use_bonus','$jaego','$img_new','$img_big_new','$opt','$doctype','$item_explain','$reg_date','$item_company', 0, '$item_code',
				'$icon_no','$use_opt1','$use_opt23','100','$jaego_use','$if_strike','$if_provide_item','$provide_price',
				'$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$member_price')";
		
				$dbresult1 = mysql_query($SQL1, $dbconn);
				
				
			}
		/*}
		else { //gnt로 가져온 상품이면
		}*/
	}

	echo "<meta http-equiv='refresh' content='0; URL=plan_list.php?category_num=$prevno'>";
}
?>
<?
mysql_close($dbconn);
?>