<?
include "../lib/Mall_Admin_Session.php";
?>


<script type="text/javascript">
<!--
	function mem_del(no){
		if(confirm("삭제된 회원은 복구할수 없습니다. 정말 삭제할까요?")){
		location.href='./mem_list.php?mode=del&item_no='+no;
		}
	}
//-->
</script>
<?
if($mode == "del"){
	$sql = "delete from item where item_no='$item_no'";
	mysql_query($sql,$dbconn);
	echo"<script>alert('선택한 회원이 삭제되었습니다.');</script>";
	echo"<script>location.href='mem_list.php';</script>";
}
?>


<?

if($_SESSION["MemberLevel"] == 3){
	$SQL = "select * from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";


	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);
	$category_num = $rows[category_num];
	$cate_sea_num = $rows[sea_num];
	$cate_sung_num = $rows[sung_num];
	$cate_khan_num = $rows[khan_num];

	$pu="3";
}

//그룹 현재 위치
if($category_num){
	if($_SESSION["MemberLevel"] == 3){
		$cur_category_name = category_navi3($category_num);
	}elseif($_SESSION["MemberLevel"] == 2){
		$cur_category_name = category_navi2($category_num);
	}elseif($_SESSION["MemberLevel"] == 1){
		$cur_category_name = category_navi1($category_num);
	}else{
		$cur_category_name = category_navi($category_num);
	}
	$tmp_category_num = $category_num;
}
$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	$service_name = mysql_result($dbresult,0,0);
}				

//보류기간
$query = "select * from boryu where seq_num='1'";
$result = mysql_query( $query, $dbconn );
$gigan_value = mysql_fetch_array($result);


//==================  그룹를 삭제함 ==================================================
if($delflag=="del_category"){
	$SQL = "select count(*) from $CategoryTable where prevno='$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if (mysql_result($dbresult,0,0) > 0) {
		echo ("
			<script language=\"javascript\">
				alert(\"하위그룹가 있어 삭제할수 없습니다\");
			</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=eachcategory.php?category_num=$category_num&pu=$pu'>";
		exit;
	}
	$SQL = "select count(*) from $ItemTable where category_num='$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if (mysql_result($dbresult,0,0) > 0) {
		echo ("
			<script language=\"javascript\">
				alert(\"하위회원이 있어 삭제할수 없습니다\");
			</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=eachcategory.php?category_num=$category_num'>";
		exit;
	}
	$SQL = "delete from $CategoryTable where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
//========================================================================================
//==================  회원을 삭제함 ======================================================
if($delflag=="del_item"){
//	if($mart_id == $mart_id){ // 내회원이면
		//파일을 삭제함

		$SQL = "select img,img_big,img_sml,item_explain,img_big2,img_big3,img_big4,img_big5 from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows>0) {
			$img = mysql_result($dbresult,0,0);
			$img_big = mysql_result($dbresult,0,1);
			$img_sml = mysql_result($dbresult,0,2);
			$item_explain = mysql_result($dbresult,0,3);
			$img_big2 = mysql_result($dbresult,0,4);
			$img_big3 = mysql_result($dbresult,0,5);
			$img_big4 = mysql_result($dbresult,0,6);
			$img_big5 = mysql_result($dbresult,0,7);

		
			if($img_sml != ""&&file_exists("$Co_img_UP$mart_id/$img_sml")){ 
				unlink ("$Co_img_UP$mart_id/$img_sml");	
			}
			if($img_big != ""&&file_exists("$Co_img_UP$mart_id/$img_big")){ 
				unlink ("$Co_img_UP$mart_id/$img_big");	
			}
			if($img != ""&&file_exists("$Co_img_UP$mart_id/$img")){
				unlink ("$Co_img_UP$mart_id/$img");	
			}
			if($img_big2 != ""&&file_exists("$Co_img_UP$mart_id/$img_big2")){ 
				unlink ("$Co_img_UP$mart_id/$img_big2");	
			}
			if($img_big3 != ""&&file_exists("$Co_img_UP$mart_id/$img_big3")){ 
				unlink ("$Co_img_UP$mart_id/$img_big3");	
			}
			if($img_big4 != ""&&file_exists("$Co_img_UP$mart_id/$img_big4")){ 
				unlink ("$Co_img_UP$mart_id/$img_big4");	
			}
			if($img_big5 != ""&&file_exists("$Co_img_UP$mart_id/$img_big5")){ 
				unlink ("$Co_img_UP$mart_id/$img_big5");	
			}



			//갤러리에디터의 gm파일들도 삭제하기
			preg_match_all("/src=\"([^>]*)\"/is", $item_explain, $output); 
			for($i=0;$i<100;$i++){
				
				$output_1 = str_replace('"',"",$output[0][$i]);
				$output_2 = explode("/",$output_1);
				$oupput_3 = "../../editor/upload/".$output_2[5];
				
			
				if($output_2[5]){
					if(file_exists($oupput_3)){
						unlink($oupput_3);
					}
				}
				
			}

				






		}	

		//회원자체를 삭제
		$SQL = "delete from $ItemTable where item_no='$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		
		//다른 상점들 gnt_item 테이블에서 삭제
		$SQL = "delete from $Gnt_ItemTable where item_no='$item_no'";
		$dbresult = mysql_query($SQL, $dbconn);
		
		//내상점과 다른 상점들 신회원, 인기회원, 추천회원, 선물 에서 삭제
		//신회원에서 삭제	
		$SQL = "delete from $New_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		//인기회원에서 삭제
		$SQL = "delete from $Fav_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		//추천회원에서 삭제
		$SQL = "delete from $Rec_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		//선물회원에서 삭제
		$SQL = "delete from $Gift_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		// wishlist 회원에서 삭제
		$SQL = "delete from $Pre_SelectTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		// 회원문의에서 삭제
		$SQL = "delete from $New_BoardTable where area = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		//옵션 삭제
		$SQL = "delete from $OptionTable where item_no='$item_no'";
		$dbresult=mysql_query($SQL,$dbconn);
		$SQL = "delete from $OptionTable2 where item_no='$item_no'";
		$dbresult=mysql_query($SQL,$dbconn);
		$SQL = "delete from $OptionTable3 where item_no='$item_no'";
		$dbresult=mysql_query($SQL,$dbconn);
		$SQL = "delete from $OptionTable4 where item_no='$item_no'";
		$dbresult=mysql_query($SQL,$dbconn);
/*	}else { //gnt로 가져온 회원이면
		//gnt_item 테이블에서 삭제
		$SQL = "delete from $Gnt_ItemTable where seller_id = '$mart_id' and item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		
		//내상점의 신회원, 인기회원, 추천회원, 선물 에서 삭제
		
		//신회원에서 삭제	
		$SQL = "delete from $New_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		//인기회원에서 삭제
		$SQL = "delete from $Fav_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		//추천회원에서 삭제
		$SQL = "delete from $Rec_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		//선물회원에서 삭제
		$SQL = "delete from $Gift_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}*/
}
//================== 회원을 삭제함 =======================================================
if($flag=="del_item1"){

	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
//		if($Mall_Admin_ID == $mart_id){ // 내회원이면
			$SQL = "select img,img_big,img_sml,item_explain,img_big2,img_big3,img_big4,img_big5 from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if($numRows>0) {
				$img = mysql_result($dbresult,0,0);
				$img_big = mysql_result($dbresult,0,1);
				$img_sml = mysql_result($dbresult,0,2);
				$item_explain = mysql_result($dbresult,0,3);
				$img_big2 = mysql_result($dbresult,0,4);
				$img_big3 = mysql_result($dbresult,0,5);
				$img_big4 = mysql_result($dbresult,0,6);
				$img_big5 = mysql_result($dbresult,0,7);
			
				if($img_sml != ""&&file_exists("$Co_img_UP$mart_id/$img_sml")){ 
					unlink ("$Co_img_UP$mart_id/$img_sml");	
				}
				if($img_big != ""&&file_exists("$Co_img_UP$mart_id/$img_big")){ 
					unlink ("$Co_img_UP$mart_id/$img_big");	
				}
				if($img != ""&&file_exists("$Co_img_UP$mart_id/$img")){
					unlink ("$Co_img_UP$mart_id/$img");	
				}
				if($img_big2 != ""&&file_exists("$Co_img_UP$mart_id/$img_big2")){ 
					unlink ("$Co_img_UP$mart_id/$img_big2");	
				}
				if($img_big3 != ""&&file_exists("$Co_img_UP$mart_id/$img_big3")){ 
					unlink ("$Co_img_UP$mart_id/$img_big3");	
				}
				if($img_big4 != ""&&file_exists("$Co_img_UP$mart_id/$img_big4")){ 
					unlink ("$Co_img_UP$mart_id/$img_big4");	
				}
				if($img_big5 != ""&&file_exists("$Co_img_UP$mart_id/$img_big5")){ 
					unlink ("$Co_img_UP$mart_id/$img_big5");	
				}

				//갤러리에디터의 gm파일들도 삭제하기
				preg_match_all("/src=\"([^>]*)\"/is", $item_explain, $output); 
				for($k=0;$k<100;$k++){
					
					$output_1 = str_replace('"',"",$output[0][$k]);
					$output_2 = explode("/",$output_1);
					$oupput_3 = "../../editor/upload/".$output_2[5];
					
				
					if($output_2[5]){
						if(file_exists($oupput_3)){
							unlink($oupput_3);
						}
					}
					
				}
			}	

			//회원자체를 삭제
			$SQL = "delete from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			
		/*}
		else { //gnt로 가져온 회원이면
			//gnt_item 테이블에서 삭제
			$SQL = "delete from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//내상점의 신회원, 인기회원, 추천회원, 선물 에서 삭제
			//베스트회원에서 삭제	
			$SQL = "delete from $Best_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//특가회원에서 삭제
			$SQL = "delete from $Spe_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);			
			//신회원에서 삭제	
			$SQL = "delete from $New_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//인기회원에서 삭제
			$SQL = "delete from $Fav_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//추천회원에서 삭제
			$SQL = "delete from $Rec_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//선물회원에서 삭제
			$SQL = "delete from $Gift_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		}*/
	}
	echo "<meta http-equiv='refresh' content='0; URL=mem_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&page=$page&pu=$pu'>";
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
			frameobj.location = "mem_list.php?pu=<?=$pu?>&category_num=" + sel.options[index].value;
	  }
  }
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
		document.location.href='mem_list.php?pu=<?=$pu?>&delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num+'&mart_id='+mart_id;
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

function modify_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 회원을 수정요청하시겠습니까??")){
		f.flag.value='modify_item';
		f.submit();
	}
	return true;
}

function delete_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 회원을 삭제요청하시겠습니까?")){
		f.flag.value='delete_item';
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

<table width=900 height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		 <td>
			<!--내용 START~~-->
			<table border="0" width="98%" cellspacing="0" cellpadding="0" align='center'>
	
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
					<input type='hidden' name='date_expire' value='<?=$date_expire?>'>

					<tr height="20">
						<td>
<?
//=========================== 해당 상위 그룹 정보를 불러옴 ============================

if($category_num){
$SQL = "select prevno from $CategoryTable where category_num='$tmp_category_num' and mart_id='$mart_id'";
//echo $SQL;
$dbresult = mysql_query($SQL, $dbconn);
$prevno = mysql_result($dbresult,0,0);
}
if($prevno > 0)
{
	//=========================== 해당 상위 그룹 정보를 불러옴 ============================
	$SQL = "select prevno from $CategoryTable where category_num='$prevno' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$prevno2 = mysql_result($dbresult,0,0);
	if($prevno2 > 0)
	{
		//=========================== 해당 상위 그룹 정보를 불러옴 ============================
		$SQL = "select prevno from $CategoryTable where category_num='$prevno2' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$prevno3 = mysql_result($dbresult,0,0);		
	}
}




$SQL = "select count(item_no) from $ItemTable where mart_id='$mart_id' and if_hide='0' and sea_num='$cate_sea_num' and sung_num='$cate_sung_num' and khan_num='$cate_khan_num'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows_tmp = mysql_result($dbresult,0,0);
 								
$numRows += $numRows_tmp;


//총회원수
$SQL1 = "select count(item_no) from $ItemTable where mart_id='$mart_id' and if_hide='0' and sea_num='$cate_sea_num' and sung_num='$cate_sung_num' and khan_num='$cate_khan_num'";


$dbresult1 = mysql_query($SQL1, $dbconn);
$numRows1 = mysql_result($dbresult1,0,0);



?>
						</td>
					</tr>
					</form>
					</table>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="stitle"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>대기회원 리스트</b></td>
				</tr>
			</table>
					<table border="0" width="100%" cellspacing="0" cellpadding="0">



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


if($_SESSION["MemberLevel"] != 10){
	$ckhan_qry = " and sea_num='$cate_sea_num' and sung_num='$cate_sung_num' and khan_num='$cate_khan_num'";
}

$SQL = "select * from $ItemTable where mart_id='$mart_id' and provider_id='' and if_hide='0' $ckhan_qry order by item_order desc, item_no desc ";


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
						<input type='hidden' name='date_expire' value='<?=$date_expire?>'>
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
								<a href='mem_list.php?category_num=$tmp_category_num&page=1&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&pu=$pu'>처음</a>
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='mem_list.php?category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&pu=$pu'>
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
								<a href='mem_list.php?category_num=$tmp_category_num&page=$i&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&pu=$pu'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='mem_list.php?category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&pu=$pu'>
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
								<a href='mem_list.php?category_num=$tmp_category_num&page=$total_page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&pu=$pu'>끝</a>
								");
							}
							?>
							</span>
						</td>
						<td width="50%" bgcolor="#FFFFFF" height="0" align="center">&nbsp;</td>
					</form>
					</tr>
					</table>
				</td>
			</tr>
			
			<form name='list' action='mem_list.php' method='post' onsubmit='return checkform1(this)'>
			<input type='hidden' name='flag' value='<?=$flag?>'>
			<input type='hidden' name='pu' value='<?=$pu?>'>
			<input type='hidden' name='category_num' value='<?=$category_num?>'>
			<input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
			<input type='hidden' name='searchword' value='<?=$searchword?>'>
			<input type='hidden' name='select_key' value='<?=$select_key?>'>
			<input type='hidden' name='date_expire' value='<?=$date_expire?>'>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100%">
							<table border="0" width="100%" cellspacing="0" cellpadding="0" class="box2">
							<tr>
								<td width="100%" height="40" colspan="9" bgcolor="#8FBECD" class="title3">
									대기회원 리스트								</td>
							</tr>
							<tr align="center">
								
								<td width="5%" class="title">번호</td>
								<td width="10%" class="title">회원명</td>
								<td width="34%" class="title">주소</td>
								<td class="title">핸드폰</td>					
								<td width="13%" class="title">등록일</td>
								<td width="13%" class="title">삭제</td>
							</tr>
<?	
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$row = mysql_fetch_array($dbresult);
	$item_no = $row[item_no];
	
	$SQL1 = "select * from $ItemTable where item_no='$item_no' and if_hide='0'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$row1 = mysql_fetch_array($dbresult1);

	$category_num_tmp = $row1[category_num];
	$mart_id = $row1[mart_id];
	$item_order_old = $row1[item_order];
	$item_name = $row1[item_name];
	$co_name = $row1[co_name];
	$item_code = $row1[item_code];
	$mobile = $row1[mobile];
	$reg_date = $row1[reg_date];
	$tel = $row1[tel];
	$read_num = $row1[read_num];
	$if_hide = $row1[if_hide];
	$provider_id = $row1[provider_id];
	$jaego_use = $row1[jaego_use];
	$jaego = $row1[jaego];
	$img_sml = $row1[img_sml];
	$address = $row1[address];
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
		//$link_str = "<a onclick=\"window.open('mem_edit_old.php?item_no=$item_no', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');\" style='cursor:hand'><b>$item_name</b></a> $icon_str $hide_str";
//	}else{
		$link_str = "<a href='mem_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num&page=$page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&pu=$pu'>$item_name</a> $icon_str $hide_str";
		$link_str2 = "<a href='mem_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num&page=$page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&pu=$pu'>$address</a> $icon_str $hide_str";
//	}
?>

							<tr onMouseOver="this.style.backgroundColor='#DDF0FF'" onMouseOut="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF" align='center'>
								<input type='hidden' name='itemno[]' value='<?=$item_no?>'>
								
								<td><?=$j?></td>
								<td><?=$link_str?></td>
								<td><?=$link_str2?></td>
								<td><?=$mobile?></td>
								<td><?=$reg_date?></td>
								
								
								
								
								<td><img src='../images/bu_delete.gif' onClick="mem_del('<?=$item_no?>');" style='cursor:hand;'></td>
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


   		</form>
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
?>
<?
mysql_close($dbconn);
?>
