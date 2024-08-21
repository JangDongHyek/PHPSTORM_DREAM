<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''){
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu3.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="310"><img src="../img/page_title3.gif" width="326" height="81"></td>
        <td valign="top" background="../img/top_2_bg.gif"><div align="right">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">상품관리 &gt; 테마상품 관리 </span> </div></td>
            </tr>
            <tr>
              <td height="28">&nbsp;</td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="990"><img src="../img/item_tab_3.gif" width="990" height="55" border="0" usemap="#Map" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<map name="Map" id="Map">
  <area shape="rect" coords="2,16,109,44" href="../good/item_frame.html" />
  <area shape="rect" coords="110,16,263,45" href="../good/item_find_jaego.php" />
</map>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>테마상품관리</b></td>
				</tr>
			</table>
<script type="text/javascript">
<!--
function new_del_item(f){
	var f = document.new_list;
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
function fav_del_item(f){
	var f = document.fav_list;
  if(!checkitems2())
  {
	return false;
  }
  if (confirm("선택한 상품을 삭제하시겠습니까?")){
		f.flag.value='del_item2';
		f.submit();
	}
	return true;
}
function rec_del_item(f){
	var f = document.rec_list;
  if(!checkitems4())
  {
	return false;
  }
  if (confirm("선택한 상품을 삭제하시겠습니까?")){
		f.flag.value='del_item4';
		f.submit();
	}
	return true;
}
function toggle(val) {
	dl = document.new_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'new_checkSel[]')
        dl.elements[i].checked = val;
    }
}
function toggle2(val) {
	dl = document.fav_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'fav_checkSel[]')
        dl.elements[i].checked = val;
    }
}
function toggle3(val) {
	dl = document.fav_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'fav_checkSel[]')
        dl.elements[i].checked = val;
    }
}
function toggle4(val) {
	dl = document.rec_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'rec_checkSel[]')
        dl.elements[i].checked = val;
    }
}
function checkitems(){
	var i;
	a_checkbox  = document.getElementsByName("new_checkSel[]");
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
function checkitems2(){
	var i;
	a_checkbox  = document.getElementsByName("fav_checkSel[]");
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
function checkitems3(){
	var i;
	a_checkbox  = document.getElementsByName("fav_checkSel[]");
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
function checkitems4(){
	var i;
	a_checkbox  = document.getElementsByName("rec_checkSel[]");
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
}//-->
</script>
			<!--내용 START~~-->
<br>

					<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
						<tr>
							<td width="90%" bgcolor="#ffffff">
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#a7a7a7" align="center">
<!---------------------------- 신상품 관리 시작 ----------------------------------------->
									<form name='new_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='new_item'>
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="5">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="30%"><b>락카 1/10단 분류별 제품 </b></td>
												<td width="70%"><p align="right">
																		<input onClick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택">&nbsp;<input onClick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;<input onClick="new_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택삭제">&nbsp;
													<input onClick="window.location.href='new_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="등록하기">
													&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="순서변경">
												</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= 신상품 관리 ==============================================
$sql0 = "select * from $New_ItemTable where mart_id='$mart_id' order by new_item_order asc";
$res0 = mysql_query($sql0, $dbconn);
$tot0 = mysql_num_rows($res0);
?>
									<tr>
										<td bgcolor="#FFFFFF" colspan="5" align="center">총 <?=$tot0?>										  개의 락카 1/10단 분류별 제품이 등록되어 있습니다.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">번호</td>
										<td width="10%">순서</td>
										<td width="60%" colspan='2'>상품명</td>
										<!-- <td width="10%">메인상품</td> -->
										<td width="10%">삭제</td>
									</tr>
<?
for($i=0; $i < $tot0; $i++){
	mysql_data_seek($res0, $i);
	$ary0=mysql_fetch_array($res0);

	$new_item_no = $ary0[new_item_no];
	$item_no = $ary0[item_no];
	$provider_id = $ary0[provider_id];
	$new_item_order = $ary0[new_item_order];
	$new_main =  $ary0[new_main];

	if( $new_main == 'y' ){
		$new_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new&target=main&new_item_no=$new_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='메인상품'>";
	}else{
		$new_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new&target=list&new_item_no=$new_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='일반상품'>";
	}
	
	$sql1 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no='$item_no'";
	$res1 = mysql_query($sql1, $dbconn);
	$tot1 = mysql_num_rows($res1);
	if($tot1 > 0){
		$item_name = mysql_result($res1, 0, 0);
		$price = mysql_result($res1, 0, 1);
		$mart_id = mysql_result($res1, 0, 2);
		$firstno = mysql_result($res1, 0, 3);
		$prevno = mysql_result($res1, 0, 4);
		$category_num = mysql_result($res1, 0, 5);

		//================== 카테고리 정보를 불러옴 ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");
		
		$j = $i + 1; 
	}else{
		$item_name = "제품이 삭제되었습니다.";
	} 

	if($i < $tot0 - 1){
		$down_str = "<a href='theme_item.php?new_item_no=$new_item_no&new_item_order=$new_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?new_item_no=$new_item_no&new_item_order=$new_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}

?>
									<tr bgcolor='#FFFFFF' align='center'>
									<input type='hidden' name='new_no[]' value='<?=$new_item_no?>'>
										<td><?=$j?><input type='checkbox' name='new_checkSel[]' value='<?=$new_item_no?>'></td>
										<td><input type='text' name='new_item_order[]' value='<?=$new_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>		
										<td align='left' colspan='2'><?=$upperclass_str?> &gt; <a onClick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<!-- <td><?=$new_main_str?></td> -->
										<td><input onClick="document.location.href='theme_item.php?flag=del&target=new&new_item_no=<?=$new_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'></td>
									</tr>
<?
}
?>
									</form>
<!---------------------------- 신상품 관리 끝 ------------------------------------------->
<!---------------------------- 추천상품 관리 시작 --------------------------------------->
									<form name='rec_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='rec_item'>
									<tr>
										<td width="58%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>도어(문짝) 색상보기 관리 </b></td>
												<td width="50%" align="right"><input onClick="javascript:toggle4(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택">&nbsp;<input onClick="javascript:toggle4(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;<input onClick="rec_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택삭제">&nbsp;
													<input onClick="window.location.href='rec_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="등록하기">
													&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="순서변경">
												  </td>
												</tr>
											</table>
										</td>
									</tr>
<?
$sql4 = "select * from $Rec_ItemTable where mart_id='$mart_id' order by rec_item_order asc";
$res4 = mysql_query($sql4, $dbconn);
$tot4 = mysql_num_rows($res4);
?>
									<tr>
										<td width="58%" bgcolor="#FFFFFF" colspan="5" align="center">총 <?=$tot4?>개의 도어(문짝) 색상보기가 등록되어 있습니다.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="8%">번호</td>
										<td width="10%">순서</td>
										<td width="72%" colspan='2'>상품명</td>
										<td width="10%">삭제</td>
									</tr>
<?
for($i=0; $i < $tot4; $i++){
	mysql_data_seek($res4, $i);
	$ary4 = mysql_fetch_array($res4);

	$rec_item_no = $ary4[rec_item_no];
	$item_no = $ary4[item_no];
	$provider_id = $ary4[provider_id];
	$rec_item_order = $ary4[rec_item_order];
	$rec_main =  $ary4[rec_main];

	if( $rec_main == 'y' ){
		$rec_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec&target=main&rec_item_no=$rec_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='메인상품'>";
	}else{
		$rec_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec&target=list&rec_item_no=$rec_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='일반상품'>";
	}
			
	$sql5 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no=$item_no";
	$res5 = mysql_query($sql5, $dbconn);
	$tot5 = mysql_num_rows($res5);
	if($tot5 > 0){
		$item_name = mysql_result($res5, 0, 0);
		$price = mysql_result($res5, 0, 1);
		$mart_id = mysql_result($res5, 0, 2);
		$firstno = mysql_result($res5, 0, 3);
		$prevno = mysql_result($res5, 0, 4);
		$category_num = mysql_result($res5, 0, 5);

		//================== 카테고리 정보를 불러옴 ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");

		if($Mall_Admin_ID != $mart_id)
			$gnt_str = "<img src='../images/gnt.gif' height='12' width='25'>";
		else
			$gnt_str = "";

		$j = $i + 1;
	}
	else $item_name = "제품이 삭제되었습니다.";

	if($i < $tot4 - 1){
		$down_str = "<a href='theme_item.php?rec_item_no=$rec_item_no&rec_item_order=$rec_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?rec_item_no=$rec_item_no&rec_item_order=$rec_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	
	if($provider_id == "" ){
?>
									<tr bgcolor='#FFFFFF' align='center'>
									<input type='hidden' name='checkSel[]' value='<?=$rec_item_no?>'>
										<td><?=$j?><input type='checkbox' name='rec_checkSel[]' value='<?=$rec_item_no?>'></td>
										<td><input type='text' name='rec_item_order[]' value='<?=$rec_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>
										<td align='left' colspan='2'><?=$upperclass_str?> &gt;  <a onClick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><input onClick="document.location.href='theme_item.php?flag=del&target=rec&rec_item_no=<?=$rec_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'></td>
									</tr>
<?
	}else {
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td>
<?
		if($i < $tot4 - 1){
?>
											<a href='theme_item.php?rec_item_no=<?=$rec_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
		if($i > 0){	
?>
											<a href='theme_item.php?rec_item_no=<?=$rec_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
?>
										</td>
										<td align='left' colspan='2'><a href='../category/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onClick="document.location.href='theme_item.php?flag=del&target=rec&rec_item_no=<?=$rec_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'></td>
									</tr>
<?
	}
}
?>
									</form>
<!---------------------------- 추천상품 관리 끝 ----------------------------------------->
<!---------------------------- 베스트상품 관리 시작 ------------------------------------->
									<form name='fav_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='fav_item'>
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="5">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>베스트상품 관리</b></td>
												<td width="50%"><p align="right">
													<input onClick="javascript:toggle3(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택">&nbsp;<input onClick="javascript:toggle3(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;<input onClick="fav_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택삭제">&nbsp;<input onClick="window.location.href='fav_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="베스트상품 등록">&nbsp;&nbsp;
													<input type='submit'  style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="베스트상품 순서 변경">
												</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= 베스트상품 관리 ==========================================
$sql6 = "select * from $Fav_ItemTable where mart_id='$mart_id' order by fav_item_order asc";
$res6 = mysql_query($sql6, $dbconn);
$tot6 = mysql_num_rows($res6);
?>
									<tr>
										<td bgcolor="#FFFFFF" colspan="5" align="center">총 <?=$tot6?>개의 베스트상품이 등록되어 있습니다.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">번호</td>
										<td width="10%">순서</td>
										<td width="60%" colspan="2">상품명</td>
										<!-- <td width="10%">메인상품</td> -->
										<td width="10%">삭제</td>
									</tr>
<?
for($i=0; $i < $tot6; $i++){
	mysql_data_seek($res6, $i);
	$ary6 = mysql_fetch_array($res6);

	$fav_item_no = $ary6[fav_item_no];
	$item_no = $ary6[item_no];
	$provider_id = $ary6[provider_id];
	$fav_item_order = $ary6[fav_item_order];
	$fav_main =  $ary6[fav_main];

	if( $fav_main == 'y' ){
		$fav_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav&target=main&fav_item_no=$fav_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='메인상품'>";
	}else{
		$fav_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav&target=list&fav_item_no=$fav_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='일반상품'>";
	}
	$sql7 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no='$item_no'";
	$res7 = mysql_query($sql7, $dbconn);
	$tot7 = mysql_num_rows($res7);
	if($tot7 > 0){
		$item_name = mysql_result($res7, 0, 0);
		$price = mysql_result($res7, 0, 1);
		$mart_id = mysql_result($res7, 0, 2);
		$firstno = mysql_result($res7, 0, 3);
		$prevno = mysql_result($res7, 0, 4);
		$category_num = mysql_result($res7, 0, 5);

		//================== 카테고리 정보를 불러옴 ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");

		$j = $i + 1;
	}else{
		$item_name = "제품이 삭제되었습니다.";
	}


	if($i < $tot6 - 1){
		$down_str = "<a href='theme_item.php?fav_item_no=$fav_item_no&fav_item_order=$fav_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?fav_item_no=$fav_item_no&fav_item_order=$fav_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}

?>
									<tr bgcolor='#FFFFFF' align='center'>
									<input type='hidden' name='fav_no[]' value='<?=$fav_item_no?>'>
										<td><?=$j?><input type='checkbox' name='fav_checkSel[]' value='<?=$fav_item_no?>'></td>
										<td><input type='text' name='fav_item_order[]' value='<?=$fav_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>		
										<td align='left' colspan='2'><?=$upperclass_str?> &gt; <a onClick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<!-- <td><?=$fav_main_str?></td> -->
										<td><input onClick="document.location.href='theme_item.php?flag=del&target=fav&fav_item_no=<?=$fav_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'></td>
									</tr>
<?
}
?>
									</form>
<!---------------------------- 베스트상품 관리 끝 --------------------------------------->

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
//================== 신상품 체크박스 삭제 =================================

if($flag=="del_item1"){
	for($i=0; $i<count($new_checkSel); $i++) {
			//신상품에서 삭제	
			$sql = "delete from $New_ItemTable where new_item_no = '$new_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//================== 히트상품 체크박스 삭제 =================================

if($flag=="del_item2"){
	for($i=0; $i<count($fav_checkSel); $i++) {
			$sql = "delete from $Fav_ItemTable where fav_item_no = '$fav_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//================== 베스트상품 체크박스 삭제 =================================

if($flag=="del_item3"){
	for($i=0; $i<count($fav_checkSel); $i++) {
			$sql = "delete from $fav_ItemTable where fav_item_no = '$fav_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//================== 추천상품 체크박스 삭제 =================================

if($flag=="del_item4"){
	for($i=0; $i<count($rec_checkSel); $i++) {
			$sql = "delete from $Rec_ItemTable where rec_item_no = '$rec_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

//================== 히트상품 상품 순서를 변경함 =================================
if($flag == "fav_item"){							
	for($i=0; $i<count($fav_no); $i++) {
		$fav_item_no = $fav_no[$i];
		
		$SQL = "update $Fav_ItemTable set fav_item_order = '$fav_item_order[$i]' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================

//================== 베스트상품 상품 순서를 변경함 ===========================================
if($flag == "fav_item"){						
	for($i=0; $i<count($fav_no); $i++) {
		$fav_item_no = $fav_no[$i];
		
		$SQL = "update $fav_ItemTable set fav_item_order = '$fav_item_order[$i]' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================

//================== 추천 상품 순서를 변경함 =============================================
if($flag == "rec_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$rec_item_no = $checkSel[$i];
		
		$SQL = "update $Rec_ItemTable set rec_item_order = '$rec_item_order[$i]' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================

//================== 신상품 순서를 변경함 ================================================
if($flag == "new_item"){						
	for($i=0; $i<count($new_no); $i++) {
		$new_item_no = $new_no[$i];
		
		$SQL = "update $New_ItemTable set new_item_order = '$new_item_order[$i]' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================

if($flag=="del"){
	if($target == 'new'){
		$sql = "delete from $New_ItemTable where new_item_no = $new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'fav'){
		$sql = "delete from $Fav_ItemTable where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'rec'){
		$sql = "delete from $Rec_ItemTable where rec_item_no = $rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'spe'){
		$sql = "delete from $Spe_ItemTable where spe_item_no = $spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if ($res == false) echo "쿼리 실행 실패!";
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "fav"){
	if($target == 'main'){
		$sql = "update $fav_ItemTable set fav_main='n' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	if($target == 'list'){
		$sql = "update $fav_ItemTable set fav_main='y' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "new"){
	if($target == 'main'){
		$sql = "update $New_ItemTable set new_main='n' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	if($target == 'list'){
		$sql = "update $New_ItemTable set new_main='y' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "rec"){
	if($target == 'main'){
		$sql = "update $Rec_ItemTable set rec_main='n' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	if($target == 'list'){
		$sql = "update $Rec_ItemTable set rec_main='y' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "fav"){
	if($target == 'main'){
		$sql = "update $Fav_ItemTable set fav_main='n' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	if($target == 'list'){
		$sql = "update $Fav_ItemTable set fav_main='y' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "spe"){
	if($target == 'main'){
		$sql = "update $Spe_ItemTable set spe_main='n' where spe_item_no='$spe_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	if($target == 'list'){
		$sql = "update $Spe_ItemTable set spe_main='y' where spe_item_no='$spe_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "up"){
	if(!empty($new_item_no)&&!empty($new_item_order)){
		$sql = "select new_item_order from $New_ItemTable where new_item_order > $new_item_order and mart_id='$mart_id' order by new_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_new_item_order = mysql_result($res,0,0);
		
		$sql = "select new_item_no from $New_ItemTable where new_item_order = $up_new_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_new_item_no = mysql_result($res,0,0);

		$sql = "update $New_ItemTable set new_item_order = $up_new_item_order where new_item_no = $new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";

		$sql = "update $New_ItemTable set new_item_order = $new_item_order where new_item_no = $up_new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($fav_item_no)&&!empty($fav_item_order)){
		$sql = "select fav_item_order from $Fav_ItemTable where fav_item_order > $fav_item_order and mart_id='$mart_id' order by fav_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_fav_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $Fav_ItemTable where fav_item_order = $up_fav_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_fav_item_no = mysql_result($res,0,0);
		
		$sql = "update $Fav_ItemTable set fav_item_order = $up_fav_item_order where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $Fav_ItemTable set fav_item_order = $fav_item_order where fav_item_no = $up_fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($rec_item_no)&&!empty($rec_item_order)){
		$sql = "select rec_item_order from $Rec_ItemTable where rec_item_order > $rec_item_order and mart_id='$mart_id' order by rec_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_rec_item_order = mysql_result($res,0,0);
		
		$sql = "select rec_item_no from $Rec_ItemTable where rec_item_order = $up_rec_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_rec_item_no = mysql_result($res,0,0);
		
		$sql = "update $Rec_ItemTable set rec_item_order = $up_rec_item_order where rec_item_no = $rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $Rec_ItemTable set rec_item_order = $rec_item_order where rec_item_no = $up_rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($fav_item_no)&&!empty($fav_item_order)){
		$sql = "select fav_item_order from $fav_ItemTable where fav_item_order > $fav_item_order and mart_id='$mart_id' order by fav_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_fav_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $fav_ItemTable where fav_item_order = $up_fav_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_fav_item_no = mysql_result($res,0,0);
		
		$sql = "update $fav_ItemTable set fav_item_order = $up_fav_item_order where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $fav_ItemTable set fav_item_order = $fav_item_order where fav_item_no = $up_fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($spe_item_no)&&!empty($spe_item_order)){
		$sql = "select spe_item_order from $Spe_ItemTable where spe_item_order > $spe_item_order and mart_id='$mart_id' order by spe_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_spe_item_order = mysql_result($res,0,0);
		
		$sql = "select spe_item_no from $Spe_ItemTable where spe_item_order = $up_spe_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$up_spe_item_no = mysql_result($res,0,0);
		
		$sql = "update $Spe_ItemTable set spe_item_order = $up_spe_item_order where spe_item_no = $spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $Spe_ItemTable set spe_item_order = $spe_item_order where spe_item_no = $up_spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
/*
if($flag == "down"){
	if(!empty($new_item_no)&&!empty($new_item_order)){
		$sql = "select new_item_order from $New_ItemTable where new_item_order < $new_item_order and mart_id='$mart_id' order by new_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_new_item_order = mysql_result($res,0,0);
		
		$sql = "select new_item_no from $New_ItemTable where new_item_order = $down_new_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_new_item_no = mysql_result($res,0,0);
		
		$sql = "update $New_ItemTable set new_item_order = $down_new_item_order where new_item_no = $new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $New_ItemTable set new_item_order = $new_item_order where new_item_no = $down_new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($fav_item_no)&&!empty($fav_item_order)){
		$sql = "select fav_item_order from $Fav_ItemTable where fav_item_order < $fav_item_order and mart_id='$mart_id' order by fav_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_fav_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $Fav_ItemTable where fav_item_order = $down_fav_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_fav_item_no= mysql_result($res,0,0);
		
		$sql = "update $Fav_ItemTable set fav_item_order = $down_fav_item_order where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $Fav_ItemTable set fav_item_order = $fav_item_order where fav_item_no = $down_fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($rec_item_no)&&!empty($rec_item_order)){
		$sql = "select rec_item_order from $Rec_ItemTable where rec_item_order < $rec_item_order and mart_id='$mart_id' order by rec_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_rec_item_order = mysql_result($res,0,0);
		
		$sql = "select rec_item_no from $Rec_ItemTable where rec_item_order = $down_rec_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_rec_item_no= mysql_result($res,0,0);
		
		$sql = "update $Rec_ItemTable set rec_item_order = $down_rec_item_order where rec_item_no = $rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $Rec_ItemTable set rec_item_order = $rec_item_order where rec_item_no = $down_rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($fav_item_no)&&!empty($fav_item_order)){
		$sql = "select fav_item_order from $fav_ItemTable where fav_item_order < $fav_item_order and mart_id='$mart_id' order by fav_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_fav_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $fav_ItemTable where fav_item_order = $down_fav_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_fav_item_no= mysql_result($res,0,0);
		
		$sql = "update $fav_ItemTable set fav_item_order = $down_fav_item_order where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $fav_ItemTable set fav_item_order = $fav_item_order where fav_item_no = $down_fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}
	
	if(!empty($spe_item_no)&&!empty($spe_item_order)){
		$sql = "select spe_item_order from $Spe_ItemTable where spe_item_order < $spe_item_order and mart_id='$mart_id' order by spe_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_spe_item_order = mysql_result($res,0,0);
		
		$sql = "select spe_item_no from $Spe_ItemTable where spe_item_order = $down_spe_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		$down_spe_item_no= mysql_result($res,0,0);
		
		$sql = "update $Spe_ItemTable set spe_item_order = $down_spe_item_order where spe_item_no = $spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
		
		$sql = "update $Spe_ItemTable set spe_item_order = $spe_item_order where spe_item_no = $down_spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "쿼리 실행 실패!";
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
*/
?>
<?
mysql_close($dbconn);
?>