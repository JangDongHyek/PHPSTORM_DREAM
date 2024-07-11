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
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&page=$page&pu=$pu'>";
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
			frameobj.location = "item_list.php?pu=<?=$pu?>&category_num=" + sel.options[index].value;
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
		document.location.href='item_list.php?pu=<?=$pu?>&delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num+'&mart_id='+mart_id;
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
if( $pu == 1 ){ //1차 그룹 리스트 일때
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "firstno='$tmp_category_num'";			// 1차 회원등록
	$con1 = "a.firstno='$tmp_category_num'";
	$first_no = $tmp_category_num;
	$second_no = 0;
	$thirdno = 0;
	$category_num = $tmp_category_num;
}else if( $pu == 2 ){ //2차 그룹 리스트 일때
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "prevno='$tmp_category_num'";			// 3차 회원등록
	$con1 = "a.prevno='$tmp_category_num'";
	$first_no = $prevno;
	$second_no = $tmp_category_num;
	$thirdno = 0;
	$category_num = $tmp_category_num;
}else if($pu == 3){ //3차 그룹 리스트 일때
	$con = "thirdno='$tmp_category_num'";
	$con1 = "a.thirdno='$tmp_category_num'";
	$first_no = $prevno2;
	$second_no = $prevno;
	$thirdno = $tmp_category_num;
	$category_num = $tmp_category_num;
}else if($pu == 4){ //3차 그룹 리스트 일때
	$con = "category_num='$tmp_category_num'";
	$con1 = "a.category_num='$tmp_category_num'";
	$first_no = $prevno3;
	$second_no = $prevno2;
	$thirdno = $prevno;
	$category_num = $tmp_category_num;
}


if(!$category_num){
	$con = "1";
}


$today = date("Y-m-d");

$today_plus_gigan = date("Y-m-d",strtotime("+1 day"));

if($date_expire == 'bo'){
	$add_query = " and end_date >= '$today' and end_date <= '$today_plus_gigan' ";//유효기간보류
}
elseif($date_expire == 'gi'){
	$add_query = " and end_date > '$today_plus_gigan'";//유효기간완료
}
elseif($date_expire == 'now'){
	$add_query = " and end_date!='' and end_date <= '$today'";//유효기간중
}
else{
	$add_query = " ";//전체보기
}

if($searchword !=''){

		$SQL = "select count(item_no) from $ItemTable where $con and $select_key like '%$searchword%' and if_hide='0' and mart_id='$mart_id' $add_query";
	
}else{
	$SQL = "select count(item_no) from $ItemTable where $con and mart_id='$mart_id' and if_hide='0' $add_query";
}


$dbresult = mysql_query($SQL, $dbconn);
$numRows_tmp = mysql_result($dbresult,0,0);
 								
$numRows += $numRows_tmp;







if($date_expire == 'bo'){
	$add_query = " and end_date < '$today' and (date_format(date_add(end_date, interval 1 day), '%Y-%m-%d') >= '$today') ";//유효기간보류
}
elseif($date_expire == 'gi'){
	$add_query = " and (date_format(date_add(end_date, interval 1 day), '%Y-%m-%d') < '$today')";//유효기간완료
}
elseif($date_expire == 'now'){
	$add_query = " and start_date <= '$today' and end_date >= '$today'";//유효기간중
}
else{
	$add_query = " ";//전체보기
}


//유효기간수
$sql1 = "select * from $ItemTable where $con and start_date <= '$today' and end_date >= '$today'";
$result1 = mysql_query($sql1,$dbconn);
$numRows1 = mysql_num_rows($result1);

//유효기간보류수
$sql2 = "select * from $ItemTable where $con and end_date < '$today' and (date_format(date_add(end_date, interval 1 day), '%Y-%m-%d') >= '$today')";
$result2 = mysql_query($sql2,$dbconn);
$numRows2 = mysql_num_rows($result2);

//유효기간완료수
$sql3 = "select * from $ItemTable where $con and (date_format(date_add(end_date, interval 1 day), '%Y-%m-%d') < '$today')";
$result3 = mysql_query($sql3,$dbconn);
$numRows3 = mysql_num_rows($result3);



//가맹점수
$sql0 = "select * from $New_BoardTable where $con and del_chk='n' and bbs_no = '13'";
$result0 = mysql_query($sql0,$dbconn);
$numRows4 = mysql_num_rows($result0);








?>
						</td>
					</tr>
					</form>
					</table>
					<table border="0" width="100%" cellspacing="0" cellpadding="0">

					<tr>
						<td width="100%" colspan="2" align=right>
						
						
							<table border="0" width="270" cellspacing="1" cellpadding="1" bgcolor=#808080>
								<tr>
									<td width="50%" bgcolor="#8FBECD" align="center" colspan="2">
										유효기간수
									</td>
									<td width="50%" bgcolor="#ffffff" align="center" colspan="2">
										<?=number_format($numRows1)?>
									</td>
								</tr>
								<tr>
									<td width="50%" bgcolor="#8FBECD" align="center" colspan="2">
										유효기간보류수
									</td>
									<td width="50%" bgcolor="#ffffff" align="center" colspan="2">
										<?=number_format($numRows2)?>
									</td>
								</tr>
								<tr>
									<td width="50%" bgcolor="#8FBECD" align="center" colspan="2">
										유효기간완료수
									</td>
									<td width="50%" bgcolor="#ffffff" align="center" colspan="2">
										<?=number_format($numRows3)?>
									</td>
								</tr>
								<?if($_SESSION["MemberLevel"] == 10){?>

								<tr>
									<td width="50%" bgcolor="#8FBECD" align="center" colspan="2">
										전체가맹점수
									</td>
									<td width="50%" bgcolor="#ffffff" align="center" colspan="2">
										<?=number_format($numRows4)?>
									</td>
								</tr>
								<?}?>

							</table>
								
						
						
						</td>
					</tr>
				</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>현재그룹 : <?=$cur_category_name?></b></td>
				</tr>
			</table>
					<table border="0" width="100%" cellspacing="0" cellpadding="0">


					<tr height='25'>
						<td width="40%" bgcolor="#FFFFFF" >
							<p style="padding-left:10px">
							
						</td>
						<td width="60%" bgcolor="#FFFFFF" align=right height="0" align=center>
						<?if($_SESSION["MemberLevel"] == 10){ //관리자?>
						<a href="#" onClick="javascript:window.open('boryu.html','','width=440,height=240,left=400,top=200');">[충전금액,보류/이용기간설정]</a>
						<?}?>


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

if($searchword !=''){

		$SQL = "select * from $ItemTable where $con and $select_key like '%$searchword%' and $con and mart_id='$mart_id' and if_hide='0' $add_query order by item_order desc, item_no desc";
	
}else{
	$SQL = "select * from $ItemTable where $con and mart_id='$mart_id' and if_hide='0' $add_query order by item_order desc, item_no desc ";
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
					<tr>
						<form method='post' name='search_form'>
						<input type='hidden' name='pu' value='<?=$pu?>'>
						<!-- <input type='hidden' name='flag' value='addcategory'> -->
						<input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
						<input type='hidden' name='page' value='<?=$page?>'>
						<input type='hidden' name='searchword' value='<?=$searchword?>'>
						<input type='hidden' name='select_key' value='<?=$select_key?>'>
						<input type='hidden' name='category_num' value='<?=$tmp_category_num?>'>
						<td width="20%" bgcolor="#FFFFFF">
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
								<a href='item_list.php?category_num=$tmp_category_num&page=1&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&pu=$pu'>처음</a>
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&pu=$pu'>
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
								<a href='item_list.php?category_num=$tmp_category_num&page=$i&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&pu=$pu'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&pu=$pu'>
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
								<a href='item_list.php?category_num=$tmp_category_num&page=$total_page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&pu=$pu'>끝</a>
								");
							}
							?>
							</span>
						</td>
						<td width="80%" bgcolor="#FFFFFF" height="0" align="right">


							<input type=radio name="date_expire" value="" <?if($date_expire==''){echo"checked";}?>>전체보기</a>&nbsp;
							<input type=radio name="date_expire" value="now" <?if($date_expire=='now'){echo"checked";}?>>유효기간</a>&nbsp;
							<input type=radio name="date_expire" value="bo" <?if($date_expire=='bo'){echo"checked";}?>>유효기간보류</a>&nbsp;
							<input type=radio name="date_expire" value="gi" <?if($date_expire=='gi'){echo"checked";}?>>유효기간완료</a>&nbsp;

							<select name="select_key">
								<option value="item_name" <?if($select_key == "item_name") echo " selected";?>>회원명</option>
								<option value="item_code" <?if($select_key == "item_code") echo " selected";?>>회원번호</option>
								<option value="co_name" <?if($select_key == "co_name") echo " selected";?>>가맹점명</option>
							</select>
							<input name="searchword" value='<?=$searchword?>' size="10" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
							<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="검색">
							<input onClick="location.href='<?=$PHP_SELF?>?pu=<?=$pu?>&category_num=<?=$category_num?>'" class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="해제">
<?
if($_SESSION["MemberLevel"] == 3){
?>
						&nbsp;&nbsp;&nbsp;	<input onClick="check_ver('<?=$first_no?>','<?=$second_no?>','<?=$thirdno?>','<?=$category_num?>')" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' value='회 원 등 록'>&nbsp;
<?
}
?>
						</td>
					</form>
					</tr>
					</table>
				</td>
			</tr>
			
			<form name='list' action='item_list.php' method='post' onsubmit='return checkform1(this)'>
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
								<td width="100%" bgcolor="#8FBECD" colspan="9">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp;
											<b><span class="dd">현재 그룹에 등록된 회원 리스트</span></b>
										</td>
										<td width="50%"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#C8DFEC" align="center">
								<td width="5%">선택</td>
								<td width="5%">번호</td>
								<td width="10%">고유번호</td>
								<td width="7%">회원번호</td>
								<td width="10%">회원명</td>
								<td width="18%">회원기간</td>
								<td >핸드폰</td>					
								<td width="13%">등록일</td>
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
	$start_date = $row1[start_date];
	$end_date = $row1[end_date];
	$sea_num = $row1[sea_num];
	$sung_num = $row1[sung_num];
	$khan_num = $row1[khan_num];
	$last_num = $row1[last_num];
	$sudong_num = $row1[sudong_num];

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
		$link_str = "<a href='item_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num&page=$page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&pu=$pu'>$item_name</a> $icon_str $hide_str";
		$link_str2 = "<a href='item_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num&page=$page&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&pu=$pu'>$co_name</a> $icon_str $hide_str";
//	}
?>
							<tr onMouseOver="this.style.backgroundColor='#DDF0FF'" onMouseOut="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF" align='center'>
								<input type='hidden' name='itemno[]' value='<?=$item_no?>'>
								<td><input type='checkbox' name='checkSel[]' value='<?=$item_no?>!<?=$mart_id?>'></td>
								<td><?=$j?></td>
								<td><a href='item_edit.php?item_no=<?=$item_no?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>&select_key=<?=$select_key?>&date_expire=<?=$date_expire?>&date_expire2=<?=$date_expire2?>&pu=<?=$pu?>'><?=$sea_num?><?=$sung_num?><?=$khan_num?><?=$sudong_num?></a></td>
								<td><a href='item_edit.php?item_no=<?=$item_no?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>&select_key=<?=$select_key?>&date_expire=<?=$date_expire?>&date_expire2=<?=$date_expire2?>&pu=<?=$pu?>'><?=$item_code?></a></td>
								<td><?=$link_str?></td>
								<td><?=$start_date?>~<?=$end_date?></td>
								<td><?=$mobile?></td>
								<td><?=$reg_date?></td>
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
	if($_SESSION["MemberLevel"] == 3){
?>

				<input type="button" value="수정요청" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' onClick="modify_item(this.form)">&nbsp; &nbsp; 
        		<input type="button" value="삭제요청" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' onClick="delete_item(this.form)"> &nbsp; &nbsp; 
<?}?>		
			
			
			
			
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
//========================================================================================
//================== 그룹를 추가함 ===================================================
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

	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&page=$page&pu=$pu'>";
}
//========================================================================================
//수정요청
if($flag == "modify_item"){		
	
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];

		$sql  = "select * from item where item_no='$item_no'";
		$res  = mysql_query($sql,$dbconn);
		$rows = mysql_fetch_array($res);

		$m_firstno = $rows[firstno];
		$m_prevno = $rows[prevno];
		$m_thirdno = $rows[thirdno];
		$m_category_num = $rows[category_num];
		
		$m_regdate = date("Y-m-d H:i:s");
		//회원기간도 추출해서 insert하기
		$sql = "insert into request_update (seq_num,firstno,prevno,thirdno,category_num,item_no,content,update_yn,regdate) values ('','$m_firstno','$m_prevno','$m_thirdno','$m_category_num','$item_no','$content','n','$m_regdate')";
		$res = mysql_query($sql,$dbconn);

	}
		echo "
			<script>
				alert('수정요청을 하였습니다.');window.close();
			</script>
		";
		
		echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&page=$page&pu=$pu'>";
}
//삭제요청
if($flag == "delete_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];

		$sql  = "select * from item where item_no='$item_no'";
		$res  = mysql_query($sql,$dbconn);
		$rows = mysql_fetch_array($res);

		$m_firstno = $rows[firstno];
		$m_prevno = $rows[prevno];
		$m_thirdno = $rows[thirdno];
		$m_category_num = $rows[category_num];
		
		$m_regdate = date("Y-m-d H:i:s");
		$sql = "insert into request_delete (seq_num,firstno,prevno,thirdno,category_num,item_no,update_yn,regdate) values ('','$m_firstno','$m_prevno','$m_thirdno','$m_category_num','$item_no','n','$m_regdate')";
		$res = mysql_query($sql,$dbconn);

	}
		echo "
			<script>
				alert('삭제요청을 하였습니다.');window.close();
			</script>
		";
		
		echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&page=$page&pu=$pu'>";
}

//========================================================================================
//================== 선불 배송 ===========================================================
if($flag == "prefee_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set fee='' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&page=$page&pu=$pu'>";
}
//========================================================================================

//================== 회원 그룹를 이동함 ==============================================
if($flag == "move_item"){
	$SQL = "select prevno, category_degree from $CategoryTable where category_num='$target_category' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$target_prevno = mysql_result($dbresult,0,0);
	$target_degree = mysql_result($dbresult,0,1);

	//echo "$SQL<br>";

	if($target_degree == 3)												// 4차일 때 
	{
		$target_thirdno = $target_prevno;					// 3차
		$SQL = "select prevno from $CategoryTable where category_num='$target_thirdno' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$target_prevno = mysql_result($dbresult,0,0);		// 2차그룹
		$SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$target_firstno = mysql_result($dbresult,0,0);	// 1차그룹
	}
	elseif($target_degree == 2)									// 3차일 때 
	{
		$SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";		
		$dbresult = mysql_query($SQL, $dbconn);
		$target_firstno = mysql_result($dbresult,0,0);		// 1차그룹
		$target_thirdno = $target_category;
	}elseif($target_degree == 1)								// 2차일 때
	{
		$target_firstno = $target_prevno;
		$target_prevno = $target_category;
	}else												// 1차일 때
	{
		$target_firstno = $target_category;
	}

	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
//		if($Mall_Admin_ID == $mart_id){ //내회원이면
			$SQL = "update $ItemTable set firstno = '$target_firstno' , prevno = '$target_prevno', thirdno='$target_thirdno', category_num = '$target_category' where item_no = '$item_no' and mart_id='$mart_id'";

			//echo "$SQL<br>";
			//exit;

			$dbresult = mysql_query($SQL, $dbconn);

			//============== 관리자일경우 하위몰 회원 이동 ======================//
			/*if($Mall_Admin_ID == $mart_id){
				$SQL1 = "select * from $MemberTable where perms = '2'";  //회원사 목록
				$dbresult1 = mysql_query($SQL1, $dbconn);
				while($ary1 = mysql_fetch_array($dbresult1)){
					$SQL = "select * from $CategoryTable where mart_id='$ary1[username]' and gnt_category_num = $target_category";
					$dbresult = mysql_query($SQL, $dbconn);
					$numRows = mysql_num_rows($dbresult);
					if($numRows >= 0){
						mysql_data_seek($dbresult, 0);
						$ary = mysql_fetch_array($dbresult);
						$firstno_tmp = $ary[firstno];
						$prevno_tmp = $ary[prevno];
						$category_num_tmp = $ary[category_num];
					}
					$SQL = "update $Gnt_ItemTable set firstno = '$firstno_tmp' , prevno = '$prevno_tmp' , category_num = '$category_num_tmp' where item_no = '$item_no' and seller_id='$ary1[username]'";

					$dbresult = mysql_query($SQL, $dbconn);
				}
			}*/
			//============== 관리자일경우 하위몰 회원 이동 ======================//
	/*	}else{ //gnt 회원이면
			//$SQL = "update $Gnt_ItemTable set prevno = '$target_prevno' , category_num = '$target_category' where item_no = '$item_no' and seller_id='$Mall_Admin_ID'";
			//act_href("","공급받은 회원은 이동 할수없습니다.","","back",$charset='euc-kr');
			//exit;
		}*/
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 그룹를 복사함 ===================================================
if($flag == "copy_item"){
	for($j=0; $j<count($checkSel); $j++) {
		$checkSels = explode("!", $checkSel[$j]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
	
//		if($Mall_Admin_ID == $mart_id){ // 내회원이면
		
			$SQL = "select * from $ItemTable where item_no='$item_no' and mart_id='$mart_id' order by item_no Desc";
			//회원데이타 가져오기
			$dbresult = mysql_query($SQL, $dbconn);
			if ($dbresult == false) echo "쿼리 실행 실패!";
			$numRows = mysql_num_rows($dbresult);
			for ($i=0; $i < $numRows; $i++) {
				mysql_data_seek($dbresult, $i);
				$ary = mysql_fetch_array($dbresult);
				$firstno = $ary["firstno"];
				$item_no = $ary["item_no"];
				$mart_id = $ary["mart_id"];
				$provider_id = $ary["provider_id"];
				$item_name = $ary["item_name"];
				$tel = $ary["tel"];
				$z_price = $ary["z_price"];
				$bonus = $ary["bonus"];
				$use_bonus = $ary["use_bonus"];
				$address = $ary["address"];
				$img = $ary["img"];
				$opt = $ary["opt"];
				$doctype = $ary["doctype"];
				$short_explain = $ary["short_explain"];
				$item_explain = $ary["item_explain"];
				$reg_date = $ary["reg_date"];
				$item_code = $ary["item_code"];
				$read_num = $ary["read_num"];
				$mobile = $ary["mobile"];
				$email = $ary["email"];
				$use_opt1 = $ary["use_opt1"];
				$use_opt23 = $ary["use_opt23"];
				$item_order = $ary["item_order"];
				$img_big = $ary["img_big"];
				$img_big2 = $ary["img_big2"];
				$img_big3 = $ary["img_big3"];
				$img_big4 = $ary["img_big4"];
				$img_big5 = $ary["img_big5"];
				$jaego_use = $ary["jaego_use"];
				$if_strike = $ary["if_strike"];
				$if_provide_item = $ary["if_provide_item"];
				$provide_price = $ary["provide_price"];
				$img_sml = $ary["img_sml"];
				$flash_big_width = $ary["flash_big_width"];
				$flash_big_height = $ary["flash_big_height"];
				$if_hide = $ary["if_hide"];
				$img_high = $ary["img_high"];
				$member_price = $ary["member_price"];
				$fee = $ary["fee"];
				$thumbnail = $ary["thumbnail"];

				//갤러리에디터의 gm파일들도 복사하기
				preg_match_all("/src=\"([^>]*)\"/is", $item_explain, $output); 
				for($k=0;$k<100;$k++){
					
					$output_1 = str_replace('"',"",$output[0][$k]);
					$output_2 = explode("/",$output_1);
					$oupput_3 = "../../editor/upload/".$output_2[5];
					$oupput_3_c = "../../editor/upload/".$output_2[5].".jpg";	
									
					if($output_2[5]){
						if(file_exists($oupput_3)){							
							copy ("$oupput_3","$oupput_3_c");	//업로드 파일 저장
							$item_explain = str_replace($output_2[5],$output_2[5].".jpg",$item_explain);
						}
					}					
				}

				$SQL1 = "select max(item_no), count(*) from $ItemTable";
				$dbresult1 = mysql_query($SQL1, $dbconn);
				if ($dbresult1 == false) echo "쿼리 실행 실패!";
				if (mysql_result($dbresult1,0,1) > 0)
					$maxItem_no = mysql_result($dbresult1, 0, 0);
				else
					$maxItem_no = 0;
			
				$maxItem_no_1 = $maxItem_no+1;
				####################img_big##########################
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

								if($img_big2 != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_big2_head = "item_big_".$item_no."_";
					$img_big2_ori = str_replace($img_big2_head,'',$img_big2);
					$img_big2_new = "item_big_".$maxItem_no_1."_".$img_big2_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_big2"))
						copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//업로드 파일 저장
				}
				else $img_big2_new = '';


				if($img_big3 != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_big3_head = "item_big_".$item_no."_";
					$img_big3_ori = str_replace($img_big3_head,'',$img_big3);
					$img_big3_new = "item_big_".$maxItem_no_1."_".$img_big3_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_big3"))
						copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//업로드 파일 저장
				}
				else $img_big3_new = '';


				if($img_big4 != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_big4_head = "item_big_".$item_no."_";
					$img_big4_ori = str_replace($img_big4_head,'',$img_big4);
					$img_big4_new = "item_big_".$maxItem_no_1."_".$img_big4_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_big4"))
						copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//업로드 파일 저장
				}
				else $img_big4_new = '';


				if($img_big5 != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_big5_head = "item_big_".$item_no."_";
					$img_big5_ori = str_replace($img_big5_head,'',$img_big5);
					$img_big5_new = "item_big_".$maxItem_no_1."_".$img_big5_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_big5"))
						copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//업로드 파일 저장
				}
				else $img_big5_new = '';

				#################img_big_end###########################
				
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

				if($img_high != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_high_head = "item_high_".$item_no."_";
					$img_high_ori = str_replace($img_high_head,'',$img_high);
					$img_high_new = "item_high_".$maxItem_no_1."_".$img_high_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_high"))
						copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//업로드 파일 저장
				}
				else $img_high_new = '';







				
	$SQL = "select prevno, category_degree from $CategoryTable where category_num='$target_category' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$target_prevno = mysql_result($dbresult,0,0);
	$target_degree = mysql_result($dbresult,0,1);


	if($target_degree == 3)												// 4차일 때 
	{
		$target_thirdno = $target_prevno;					// 3차
		$SQL = "select prevno from $CategoryTable where category_num='$target_thirdno' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$target_prevno = mysql_result($dbresult,0,0);		// 2차그룹
		$SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$target_firstno = mysql_result($dbresult,0,0);	// 1차그룹
	}
	elseif($target_degree == 2)									// 3차일 때 
	{
		$SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";		
		$dbresult = mysql_query($SQL, $dbconn);
		$target_firstno = mysql_result($dbresult,0,0);		// 1차그룹
		$target_thirdno = $target_category;
	}elseif($target_degree == 1)								// 2차일 때
	{
		$target_firstno = $target_prevno;
		$target_prevno = $target_category;
	}else												// 1차일 때
	{
		$target_firstno = $target_category;
	}


				if($use_opt1 == '') $use_opt1 = 'f';
				if($use_opt23 == '') $use_opt23 = 'f';
				
				$SQL1 = "insert into $ItemTable (item_no, mart_id, provider_id, firstno, prevno, thirdno, category_num, item_name, price, z_price, bonus, 
				use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_code, read_num, mobile, 
				email, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provide_price, img_sml, 
				flash_big_width, flash_big_height, if_hide, img_high, member_price, fee, thumbnail) 
				values ('$maxItem_no_1', '$mart_id', '$provider_id', '$target_firstno', '$target_prevno', '$target_thirdno', '$target_category', '$item_name', '$price', '$z_price', '$bonus', 
				'$use_bonus','$jaego','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$opt','$doctype','$item_explain','$short_explain','$reg_date', '$item_code', 0, '$mobile',
				'$email','$use_opt1','$use_opt23','9999','$jaego_use','$if_strike','$if_provide_item','$provide_price',
				'$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new','$member_price', '$fee', '$thumbnail')";
		
				$dbresult1 = mysql_query($SQL1, $dbconn);
				
				
			}
		/*}
		else { //gnt로 가져온 회원이면
		}*/
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&date_expire=$date_expire&date_expire2=$date_expire2&page=$page&pu=$pu'>";
}
?>
<?
mysql_close($dbconn);
?>
