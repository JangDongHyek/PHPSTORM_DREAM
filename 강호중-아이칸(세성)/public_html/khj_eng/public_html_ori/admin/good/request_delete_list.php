<?
include "../lib/Mall_Admin_Session.php";
?>
<?

if($_SESSION["MemberLevel"] == 3){
	$SQL = "select category_num from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);
	$category_num = $rows[category_num];
	$pu="3";
}

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
			frameobj.location = "request_delete_list.php?pu=<?=$pu?>&category_num=" + sel.options[index].value;
	  }
  }
}




function modify_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 회원을 삭제하시겠습니까??")){
		f.flag.value='modify_item';
		f.submit();
	}
	return true;
}

function checkform(f){
  	if (f.category_name.value=="") {
		alert("그룹 명을 입력해주세요.");
		f.category_name.focus();
		return false;
	}
	return true;
}
function checkform1(f){
  	if (f.target_category.value=="") {
		alert("그룹를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	return true;
}
function really2(item_no, tmp_category_num, mart_id){
	if (confirm("현재회원을 삭제하시겠습니까?")){
		document.location.href='request_delete_list.php?pu=<?=$pu?>&delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num+'&mart_id='+mart_id;
	}
}

function del_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 회원을 삭제하시겠습니까?")){
		f.flag.value='del_item1';
		f.submit();
	}
	return true;
}

function to_item(f){
  if (confirm("선택한 회원의 순서를 변경하시겠습니까?")){
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
  if (confirm("선택한 회원을 숨기시겠습니까?")){
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
  if (confirm("선택한 회원을 출력하시겠습니까?")){
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
  if (confirm("선택한 회원을 품절로 하시겠습니까?")){
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
  if (confirm("선택한 회원의 품절을 해제하시겠습니까? \n재고량은 기본 100개로 설정됩니다.")){
		f.flag.value='sale_item';
		f.submit();
	}
	return true;
}

function free_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 회원을 무료배송으로 하시겠습니까?")){
		f.flag.value='free_item';
		f.submit();
	}
	return true;
}

function fee_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 회원을 착불배송으로 하시겠습니까?")){
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
  if (confirm("선택한 회원을 선불배송으로 하시겠습니까?")){
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
		alert("회원을 선택하세요.");
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
		alert("그룹를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	f.flag.value='move_item';
	f.submit();
	return true;
}
function copy_item(f){
	if(!checkitems())
	{
		return false;
	}
  if (f.target_category.value=="") {
		alert("그룹를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	f.flag.value='copy_item';
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
<?include '../inc/menu3.html'; ?>
			<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>삭제요청 리스트 </b> </td>
				</tr>
		  </table>
<table width="60%" height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		 <td>
			<!--내용 START~~-->
			<table border="0" width="98%" cellspacing="0" cellpadding="0" align='center'>
	
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%">


					<table border="0" width="100%" cellspacing="0" cellpadding="0">


					<tr height='25'>
						<td width="40%" bgcolor="#FFFFFF">
							<p style="padding-left:10px">
							
						</td>
						<td width="60%" bgcolor="#FFFFFF" align=right height="0">

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
	$cnfPagecount = 50;
}
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

if(!$update_yn){
	$update_yn = "n";
}


$SQL1 = "select category_num from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";
$dbresult1 = mysql_query($SQL1, $dbconn);
$rows1 = mysql_fetch_array($dbresult1);
$me_category_num = $rows1[category_num];
if($_SESSION["MemberLevel"] == 1){
	$add_query=" and firstno='$me_category_num' ";
}
elseif($_SESSION["MemberLevel"] == 2){
	$add_query=" and prevno='$me_category_num' ";
}
elseif($_SESSION["MemberLevel"] == 3){
	$add_query=" and thirdno='$me_category_num' ";
}

$SQL = "select * from request_delete where update_yn='$update_yn' $add_query order by seq_num desc";
	

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
								<a href='request_delete_list.php?update_yn=$update_yn&category_num=$tmp_category_num&page=1&searchword=$searchword&select_key=$select_key&pu=$pu'>처음</a>
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='request_delete_list.php?update_yn=$update_yn&category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
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
								<a href='request_delete_list.php?update_yn=$update_yn&category_num=$tmp_category_num&page=$i&searchword=$searchword&select_key=$select_key&pu=$pu'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='request_delete_list.php?update_yn=$update_yn&category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
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
								<a href='request_delete_list.php?update_yn=$update_yn&category_num=$tmp_category_num&page=$total_page&searchword=$searchword&select_key=$select_key&pu=$pu'>끝</a>
								");
							}
							?>
							</span>
						</td>
			<?
			if($update_yn == "n"){
				$font_bold1 = "<b>";
				$font_bold2 = "</b>";
				$list_title = "<b>삭제대기자 리스트</b>";
			}else{
				$font_bold3 = "<b>";
				$font_bold4 = "</b>";
				$list_title = "<b>삭제완료내역 리스트</b>";
			}
			?>
							<td width="50%" bgcolor="#FFFFFF" height="0" align="center">
							<a href="./request_delete_list.php?page=<?=$page?>&update_yn=n"><?=$font_bold1?>삭제대기자보기<?=$font_bold2?></a>  |  <a href="./request_delete_list.php?page=<?=$page?>&update_yn=y"><?=$font_bold3?>삭제완료내역보기<?=$font_bold4?></a>
						</td>
					</form>
					</tr>
					</table>
				</td>
			</tr>

			<form name='list' action='request_delete_list.php' method='post' onsubmit='return checkform1(this)'>
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
							<table border="0" width="100%" cellspacing="1" cellpadding="1">
							<tr>
								<td width="100%" bgcolor="#8FBECD" colspan="8">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp;
											
											<?=$list_title?>

										<td width="50%"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#C8DFEC" align="center">
							<?
							if($update_yn == "n"){
							?>
								<td width="8%">선택</td>
							<?
							}
							?>
								<td width="8%">번호</td>
								<td width="20%">회원번호</td>
								<td width="10%">회원명</td>
								<td >회원기간</td>
							<?
							if($update_yn == "y"){
							?>
								<td width="13%">삭제일시</td>
							<?}else{?>
								<td width="13%">요청일시</td>
							   <?}?>
							</tr>
<?	
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$row = mysql_fetch_array($dbresult);
	$seq_num = $row[seq_num];
	$item_no = $row[item_no];
	$content = $row[content];
	$regdate = $row[regdate];
	$old_start_date = $row[old_start_date];
	$old_end_date = $row[old_end_date];


	$SQL1 = "select * from $ItemTable where item_no='$item_no'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$row1 = mysql_fetch_array($dbresult1);

	$item_code = $row1[item_code];
	$item_name = $row1[item_name];
	$start_date = $row1[start_date];
	$end_date = $row1[end_date];
	$mart_id = $row1[mart_id];
	$category_num = $row1[category_num];


	if($jaego_use == 1 && $jaego == 0){
		$icon_str = "<img src='../images/soldout_icon_s.gif' width='25' height='12'>";
	}else{
		$icon_str = "";
	}

	$j = $numRows - $i;


?>
							<tr onmouseover="this.style.backgroundColor='#DDF0FF'" onmouseout="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF" align='center'>
								<input type='hidden' name='itemno[]' value='<?=$seq_num?>'>
							<?
							if($update_yn == "n"){
							?>								
								<td><input type='checkbox' name='checkSel[]' value='<?=$seq_num?>!<?=$item_no?>'></td>
							<?}?>
								<td><?=$j?></td>
								<td><span style="cursor:hand;" onclick="window.open('./request_item_edit.php?item_no=<?=$item_no?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&pu=<?=$pu?>','','width=900,height=550,top=50,left=100,scrollbars=yes');"><?=$item_code?></span></td>
								<td><span style="cursor:hand;" onclick="window.open('./request_item_edit.php?item_no=<?=$item_no?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&pu=<?=$pu?>','','width=900,height=550,top=50,left=100,scrollbars=yes');"><?=$item_name?></span></td>

								<td><?=$start_date?> ~ <?=$end_date?></td>
								<td><?=$regdate?></td>
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
    	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
			
			<?			
			if($_SESSION["MemberLevel"] == 1){
			?>
							<?
							if($update_yn == "n"){
							?>
			<input type="button" value="선택한 회원 삭제하기" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' onClick="modify_item(this.form)">&nbsp; 
							<?}?>
			<?}?>		
			
			
			
			
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
<?




if($flag == "modify_item"){		
	

	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$seq_num = $checkSels[0];
		$item_no = $checkSels[1];

		
		//실제로 삭제안하고 삭제회원은 구분만 시키기
		$sql  = "update item set if_hide='1' where item_no='$item_no'";
		$res  = mysql_query($sql,$dbconn);	
		

		//삭제회원은 삭제했다고 기록하기
		$update_date = date("Y-m-d H:i:s");
		$sql = "update request_delete set update_yn='y', regdate='$update_date' where seq_num='$seq_num'";
		$res = mysql_query($sql,$dbconn);

	
	}
		echo "
			<script>
				alert('회원삭제를 하였습니다.');
			</script>
		";
		
		echo "<meta http-equiv='refresh' content='0; URL=request_delete_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&page=$page&pu=$pu'>";
}






mysql_close($dbconn);
?>
</html>
