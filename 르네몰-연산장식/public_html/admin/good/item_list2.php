<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//ī�װ� ���� ��ġ
$cur_category_name = category_navi($category_num);
$tmp_category_num = $category_num;

$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	$service_name = mysql_result($dbresult,0,0);
}				

//==================  ī�װ��� ������ ==================================================
if($delflag=="del_category"){
	$SQL = "select count(*) from $CategoryTable where prevno='$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if (mysql_result($dbresult,0,0) > 0) {
		echo ("
			<script language=\"javascript\">
				alert(\"����ī�װ��� �־� �����Ҽ� �����ϴ�\");
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
				alert(\"������ǰ�� �־� �����Ҽ� �����ϴ�\");
			</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=eachcategory.php?category_num=$category_num'>";
		exit;
	}
	$SQL = "delete from $CategoryTable where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
//========================================================================================
//==================  ��ǰ�� ������ ======================================================
if($delflag=="del_item"){
//	if($mart_id == $mart_id){ // ����ǰ�̸�
		//������ ������
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

		//��ǰ��ü�� ����
		$SQL = "delete from $ItemTable where item_no='$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		
		//�ٸ� ������ gnt_item ���̺��� ����
		$SQL = "delete from $Gnt_ItemTable where item_no='$item_no'";
		$dbresult = mysql_query($SQL, $dbconn);
		
		//�������� �ٸ� ������ �Ż�ǰ, �α��ǰ, ��õ��ǰ, ���� ���� ����
		//�Ż�ǰ���� ����	
		$SQL = "delete from $New_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		//�α��ǰ���� ����
		$SQL = "delete from $Fav_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		//��õ��ǰ���� ����
		$SQL = "delete from $Rec_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		//������ǰ���� ����
		$SQL = "delete from $Gift_ItemTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		// wishlist ��ǰ���� ����
		$SQL = "delete from $Pre_SelectTable where item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		// ��ǰ���ǿ��� ����
		$SQL = "delete from $New_BoardTable where area = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
/*	}else { //gnt�� ������ ��ǰ�̸�
		//gnt_item ���̺��� ����
		$SQL = "delete from $Gnt_ItemTable where seller_id = '$mart_id' and item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);
		
		//�������� �Ż�ǰ, �α��ǰ, ��õ��ǰ, ���� ���� ����
		
		//�Ż�ǰ���� ����	
		$SQL = "delete from $New_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		//�α��ǰ���� ����
		$SQL = "delete from $Fav_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		//��õ��ǰ���� ����
		$SQL = "delete from $Rec_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		//������ǰ���� ����
		$SQL = "delete from $Gift_ItemTable where item_no = $item_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}*/
}
//================== ��ǰ�� ������ =======================================================
if($flag=="del_item1"){
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
//		if($Mall_Admin_ID == $mart_id){ // ����ǰ�̸�
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

			//��ǰ��ü�� ����
			$SQL = "delete from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//�ٸ� ������ gnt_item ���̺��� ����
			$SQL = "delete from $Gnt_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//�������� �ٸ� ������ �Ż�ǰ, �α��ǰ, ��õ��ǰ, ���� ���� ����
			//����Ʈ��ǰ���� ����	
			$SQL = "delete from $Best_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//Ư����ǰ���� ����
			$SQL = "delete from $Spe_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//�Ż�ǰ���� ����	
			$SQL = "delete from $New_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//�α��ǰ���� ����
			$SQL = "delete from $Fav_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//��õ��ǰ���� ����
			$SQL = "delete from $Rec_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			//������ǰ���� ����
			$SQL = "delete from $Gift_ItemTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			// wishlist ��ǰ���� ����
			$SQL = "delete from $Pre_SelectTable where item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			// ��ǰ���ǿ��� ����
			$SQL = "delete from $New_BoardTable where area = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
		/*}
		else { //gnt�� ������ ��ǰ�̸�
			//gnt_item ���̺��� ����
			$SQL = "delete from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and item_no = $item_no";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//�������� �Ż�ǰ, �α��ǰ, ��õ��ǰ, ���� ���� ����
			//����Ʈ��ǰ���� ����	
			$SQL = "delete from $Best_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//Ư����ǰ���� ����
			$SQL = "delete from $Spe_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);			
			//�Ż�ǰ���� ����	
			$SQL = "delete from $New_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//�α��ǰ���� ����
			$SQL = "delete from $Fav_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//��õ��ǰ���� ����
			$SQL = "delete from $Rec_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			//������ǰ���� ����
			$SQL = "delete from $Gift_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		}*/
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
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
		alert("ī�װ� ���� �Է����ּ���.");
		f.category_name.focus();
		return false;
	}
	return true;
}
function checkform1(f){
  	if (f.target_category.value=="") {
		alert("ī�װ��� �����ϼ���.");
		f.target_category.focus();
		return false;
	}
	return true;
}
function really2(item_no, tmp_category_num, mart_id){
	if (confirm("�����ǰ�� �����Ͻðڽ��ϱ�?")){
		document.location.href='item_list.php?pu=<?=$pu?>&delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num+'&mart_id='+mart_id;
	}
}

function del_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='del_item1';
		f.submit();
	}
	return true;
}

function to_item(f){
  if (confirm("������ ��ǰ�� ������ �����Ͻðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� ����ðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� ����Ͻðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� ǰ���� �Ͻðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� ǰ���� �����Ͻðڽ��ϱ�? \n����� �⺻ 100���� �����˴ϴ�.")){
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
  if (confirm("������ ��ǰ�� ���������� �Ͻðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� ���ҹ������ �Ͻðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� ���ҹ������ �Ͻðڽ��ϱ�?")){
		f.flag.value='prefee_item';
		f.submit();
	}
	return true;
}
function baesongbi_edit(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("������ ��ǰ�� ��ۺ� ���� �Ͻðڽ��ϱ�?")){
		f.flag.value='baesongbi_edit';
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
		alert("��ǰ�� �����ϼ���.");
		return false;
	}
	return true;
}
function copy_item(f){
	if(!checkitems())
	{
		return false;
	}
  if (f.target_category.value=="") {
		alert("ī�װ��� �����ϼ���.");
		f.target_category.focus();
		return false;
	}
	f.flag.value='copy_item';
	f.submit();
	return true;
}

function move_item(f){
	if(!checkitems())
	{
		return false;
	}
  if (f.target_category.value=="") {
		alert("ī�װ��� �����ϼ���.");
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

function check_ver(first_no,second_no,category_num){
	window.location.href="./item_add.php?pu=<?=$pu?>&first_no=" + first_no + "&second_no=" + second_no + "&category_num=" + category_num;
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
				<td width="100%" height="40" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>����ī�װ� : <?=$cur_category_name?></b></td>
				</tr>
			</table>
			<!--���� START~~-->
			<table border="0" width="98%" cellspacing="0" cellpadding="0" align='center'>
			<!-- <tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="right">
					<span class="ee"><b>ī�װ� �̵�</b>&nbsp;&nbsp;
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
					<option value='item_list.php?category_num=$category_num'
	");		
	if($tmp_category_num == $category_num){
		echo "selected";
		$cur_category_name = $category_name;
	}
	echo (" style='color:#000000; background-color:#dddddd;'>��$category_name</option>");
				
	for($j=0;$j<$numRows1;$j++){
		$category_num1 = mysql_result($dbresult2,$j,0);
		$category_name1 = mysql_result($dbresult2,$j,1);

		$SQL3 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num1' order by category_num desc";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);
				
		echo ("
					<option value='item_list.php?category_num=$category_num1'
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
						<option value='item_list.php?category_num=$category_num3'
			");	
			if($tmp_category_num == $category_num3){
				echo "selected";
				$cur_category_name = $category_name3;
			}
			echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");
		}
	}
}
// �ְ� �ޱ� ī�װ�..

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
							echo (" style='color:#000000; background-color:#dddddd;'>��$category_name1</option>
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
//=========================== �ش� 2�� ī�װ� ������ �ҷ��� ============================
$SQL = "select prevno from $CategoryTable where category_num='$tmp_category_num' and mart_id='$mart_id'";
//echo $SQL;
$dbresult = mysql_query($SQL, $dbconn);
$prevno = mysql_result($dbresult,0,0);
if($prevno > 0)
{
	//=========================== �ش� 1�� ī�װ� ������ �ҷ��� ============================
	$SQL = "select prevno from $CategoryTable where category_num='$prevno' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$prevno2 = mysql_result($dbresult,0,0);
}
if( $pu == 1 ){ //1�� ī�װ� ����Ʈ �϶�
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "firstno='$tmp_category_num'";			// 1�� ��ǰ���
	$con1 = "a.firstno='$tmp_category_num'";
	$first_no = $tmp_category_num;
	$second_no = 0;
	$category_num = $tmp_category_num;
}else if( $pu == 2 ){ //2�� ī�װ� ����Ʈ �϶�
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "prevno='$tmp_category_num'";			// 3�� ��ǰ���
	$con1 = "a.prevno='$tmp_category_num'";
	$first_no = $prevno;
	$second_no = $tmp_category_num;
	$category_num = $tmp_category_num;
}else{ //3�� ī�װ� ����Ʈ �϶�
	$con = "category_num='$tmp_category_num'";
	$con1 = "a.category_num='$tmp_category_num'";
	$first_no = $prevno2;
	$second_no = $prevno;
	$category_num = $tmp_category_num;
}

if($searchword !=''){
	if($select_key == "provider_id" ){
		$SQL = "SELECT count(item_no) FROM $ItemTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' and  $con1";
	}else{
		$SQL = "select count(item_no) from $ItemTable where $con and item_name like '%$searchword%' and $con and mart_id='$mart_id'";
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
							����ī�װ��� �� <?=$numRows_tmp?>�� ��ǰ ���
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
		
							
							
							
							
						
							<input onclick="check_ver('<?=$first_no?>','<?=$second_no?>','<?=$category_num?>')" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' value='�� ǰ �� ��'>&nbsp;






<?
	//}
?>
							<!-- <input class='aa' onclick=\"window.location.href='item_order.php?category_num=$tmp_category_num'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='��ǰ��������'>&nbsp; -->
<?
//}else{
?>
							<!-- <span class='aa'>���� ī�װ��� �־� ��ǰ�� ����� �� �����ϴ�.</span> -->
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
	$cnfPagecount = 50;
}
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

if($searchword !=''){
	if($select_key == "provider_id" ){
		$SQL = "SELECT * FROM $ItemTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' and  $con1 order by a.item_order asc, a.item_no desc";
	}else{
		$SQL = "select * from $ItemTable where $con and item_name like '%$searchword%' and $con and mart_id='$mart_id' order by item_order asc, item_no desc";
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
								ó��
								");
							}
							else{
								echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=1&searchword=$searchword&select_key=$select_key&pu=$pu'>ó��</a>
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
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
								<a href='item_list.php?category_num=$tmp_category_num&page=$i&searchword=$searchword&select_key=$select_key&pu=$pu'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
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
								<a href='item_list.php?category_num=$tmp_category_num&page=$total_page&searchword=$searchword&select_key=$select_key&pu=$pu'>��</a>
								");
							}
							?>
							</span>
						</td>
						<td width="50%" bgcolor="#FFFFFF" height="0" align="center">
							<select name="select_key">
								<option value="item_name" <?if($select_key == "item_name") echo " selected";?>>��ǰ��</option>
								<!-- <option value="provider_id" <?if($select_key == "provider_id") echo " selected";?>>��������</option> -->
							</select>
							<input name="searchword" value='<?=$searchword?>' size="15" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
							<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�˻�">
							<input onclick="location.href='<?=$PHP_SELF?>?pu=<?=$pu?>&category_num=<?=$category_num?>'" class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����">
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
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="100%" bgcolor="#8FBECD" colspan="9">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp;
											<b><span class="dd">���� ī�װ��� ��ϵ� ��ǰ ����Ʈ</span></b>
										</td>
										<td width="50%"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#C8DFEC" align="center">
								<td width="8%">����</td>
								<td width="8%">��ȣ</td>
								<td width="10%">����</td>
								<td width="38%">��ǰ��</td>
								<td width="10%">���</td>
								<!-- <td width="20%">��������</td> -->
								<td width="8%">�� ��</td>
								<td width="13%">�����</td>
								<td width="5%">����</td>
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
	$reg_date = $row1[reg_date];
	$read_num = $row1[read_num];
	$if_hide = $row1[if_hide];
	$provider_id = $row1[provider_id];
	$jaego_use = $row1[jaego_use];
	$jaego = $row1[jaego];

	if( $provider_id ){
		$sql5 = "select * from $MemberTable where username='$provider_id'";
		$res5 = mysql_query( $sql5, $dbconn );
		$row5 = mysql_fetch_array( $res5 );
		$membername = $row5[name];
	}else{
		$membername = '����';
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
								<td><input type='checkbox' name='checkSel[]' value='<?=$item_no?>!<?=$mart_id?>'></td>
								<td>

<a href='item_edit.php?item_no=<?=$item_no?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num_tmp?>&page=<?=$page?>&searchword=<?=$searchword?>&select_key=<?=$select_key?>&pu=<?=$pu?>'><?=$j?></a></td>
								<td><input type='text' name='item_order[]' value='<?=$item_order_old?>' size='3' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid;'></td>
								<td align='left'><?=$link_str?></td>
								<td><?=$jaego?></td>
								<!-- <td><?=$membername?></td> -->
								<td><?=$row1[fee]?></td>
								<td><?=$reg_date?></td>
								<td>
									<input class='aa' onClick="really2('<?=$item_no?>', '<?=$tmp_category_num?>', '<?=$mart_id?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'>
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
						<input onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">
						<input onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;
						&nbsp;
						</td>
					  </tr>
					  <tr>
						<td>
						<font color="#3D918A">������ ��ǰ�� </font>
							<select name="target_category" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
							<?=Make_select_category($mart_id, $tmp_category_num)?>
							</select><br>
							
							 <input onclick="copy_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="����"> 
							

							<input onclick="move_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="�̵�"> 
							<input onclick="del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="����">
							<input  onclick="to_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">
							<input onclick="hide_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="����">
							<input onclick="see_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="���">
							<input onclick="sold_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="ǰ��">
							<input onclick="sale_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="ǰ������">
							<input onclick="free_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="������">
							<input onclick="fee_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="����">
							<input onclick="prefee_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="����">


<BR>

							��ۺ�:<input onclick="baesongbi_edit(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="3000">��



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
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
//========================================================================================
//================== ī�װ��� �߰��� ===================================================
if($flag == "addcategory"){
	$SQL = "select max(category_num), count(*) from $CategoryTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxCategory_num = mysql_result($dbresult, 0, 0);
	else
		$maxCategory_num = 0;
	
	$SQL = "select max(cat_order), count(*) from $CategoryTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
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

	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ��ǰ ������ ������ ==================================================
if($flag == "to_item"){							
	for($i=0; $i<count($itemno); $i++) {
		$item_no = $itemno[$i];
		//$item_order = "$item_order[$i]";

		$SQL = "update $ItemTable set item_order='$item_order[$i]' where item_no = '$item_no' and mart_id='$mart_id'";;
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ��ǰ�� ���� =========================================================
if($flag == "hide_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set if_hide = '1' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ��ǰ�� ��� =========================================================
if($flag == "see_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set if_hide = '0' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ��ǰ ǰ�� ===========================================================
if($flag == "sold_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set jaego_use='1', jaego='0' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ��ǰ ǰ�� ���� ======================================================
if($flag == "sale_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set jaego_use='1', jaego='100' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ���� ��� ===========================================================
if($flag == "free_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set fee='������' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ���� ��� ===========================================================
if($flag == "fee_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set fee='����' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================

//========================================================================================
//================== ���� ��� ===========================================================
if($flag == "prefee_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set fee='' where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ��ۺ񺯰� ===========================================================
if($flag == "baesongbi_edit"){							
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		$SQL = "update $ItemTable set parcel_price='3000' where item_no = '$item_no' and mart_id='$mart_id'";

echo $SQL;
exit;

		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list2.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================


//================== ��ǰ ī�װ��� �̵��� ==============================================
if($flag == "move_item"){
	$SQL = "select prevno, category_degree from $CategoryTable where category_num='$target_category' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$target_prevno = mysql_result($dbresult,0,0);
	$target_degree = mysql_result($dbresult,0,1);

	if($target_degree == 2)						// 3���� �� 
	{
		$SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$target_firstno = mysql_result($dbresult,0,0);		// 1��ī�װ�
	}elseif($target_degree == 1)				// 2���� ��
	{
		$target_firstno = $target_prevno;
		$target_prevno = $target_category;
	}else												// 1���� ��
	{
		$target_firstno = $target_category;
	}

	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
//		if($Mall_Admin_ID == $mart_id){ //����ǰ�̸�
			$SQL = "update $ItemTable set firstno = '$target_firstno' , prevno = '$target_prevno' , category_num = '$target_category' where item_no = '$item_no' and mart_id='$mart_id'";

			$dbresult = mysql_query($SQL, $dbconn);

			//============== �������ϰ�� ������ ��ǰ �̵� ======================//
			/*if($Mall_Admin_ID == $mart_id){
				$SQL1 = "select * from $MemberTable where perms = '2'";  //ȸ���� ���
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
			//============== �������ϰ�� ������ ��ǰ �̵� ======================//
	/*	}else{ //gnt ��ǰ�̸�
			//$SQL = "update $Gnt_ItemTable set prevno = '$target_prevno' , category_num = '$target_category' where item_no = '$item_no' and seller_id='$Mall_Admin_ID'";
			//act_href("","���޹��� ��ǰ�� �̵� �Ҽ������ϴ�.","","back",$charset='euc-kr');
			//exit;
		}*/
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== ī�װ��� ������ ===================================================
if($flag == "copy_item"){
	for($j=0; $j<count($checkSel); $j++) {
		$checkSels = explode("!", $checkSel[$j]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
	
//		if($Mall_Admin_ID == $mart_id){ // ����ǰ�̸�
		
			$SQL = "select * from $ItemTable where item_no='$item_no' and mart_id='$mart_id' order by item_no Asc";
			//��ǰ����Ÿ ��������
			$dbresult = mysql_query($SQL, $dbconn);
			if ($dbresult == false) echo "���� ���� ����!";
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
				$member_price = $ary["member_price"];
				$parcel_price = $ary["parcel_price"];
				$gibon = $ary["gibon"];

				$SQL1 = "select max(item_no), count(*) from $ItemTable";
				$dbresult1 = mysql_query($SQL1, $dbconn);
				if ($dbresult1 == false) echo "���� ���� ����!";
				if (mysql_result($dbresult1,0,1) > 0)
					$maxItem_no = mysql_result($dbresult1, 0, 0);
				else
					$maxItem_no = 0;
			
				$maxItem_no_1 = $maxItem_no+1;
				



//�������������� gm���ϵ鵵 �����ϱ�
				preg_match_all("/src=\"([^>]*)\"/is", $item_explain, $output); 
				for($k=0;$k<100;$k++){
					
					$output_1 = str_replace('"',"",$output[0][$k]);
					$output_2 = explode("/",$output_1);
					$output_3 = "../../smarteditor/upload/".$output_2[6];
					$output_3_c = "../../smarteditor/upload/".$output_2[6].".jpg";	
									
					if($output_2[6]){
						if(file_exists($output_3)){							
							copy ("$output_3","$output_3_c");	//���ε� ���� ����
							$item_explain = str_replace($output_2[6],$output_2[6].".jpg",$item_explain);
						}
					}					
				}


				if($img_big != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_big_head = "item_big_".$item_no."_";
					$img_big_ori = str_replace($img_big_head,'',$img_big);
					$img_big_new = "item_big_".$maxItem_no_1."_".$img_big_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_big"))
						copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//���ε� ���� ����
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
						copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//���ε� ���� ����
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
						copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//���ε� ���� ����
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
						copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//���ε� ���� ����
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
						copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//���ε� ���� ����
				}
				else $img_big5_new = '';

				if($img_sml != ""){
					if(!file_exists("$Co_img_UP$mart_id")){
						mkdir ("$Co_img_UP$mart_id", 0755 );
					}
					$img_sml_head = "item_sml_".$item_no."_";
					$img_sml_ori = str_replace($img_sml_head,'',$img_sml);
					$img_sml_new = "item_sml_".$maxItem_no_1."_".$img_sml_ori;

					if(file_exists("$Co_img_UP$mart_id/$img_sml"))
						copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//���ε� ���� ����
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
						copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//���ε� ���� ����
				}
				else $img_new = '';
				
	$SQL = "select prevno, category_degree from $CategoryTable where category_num='$target_category' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$target_prevno = mysql_result($dbresult,0,0);
	$target_degree = mysql_result($dbresult,0,1);


	if($target_degree == 3)												// 4���� �� 
	{
		$target_thirdno = $target_prevno;					// 3��
		$SQL = "select prevno from $CategoryTable where category_num='$target_thirdno' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$target_prevno = mysql_result($dbresult,0,0);		// 2��ī�װ�
		$SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$target_firstno = mysql_result($dbresult,0,0);	// 1��ī�װ�
	}
	elseif($target_degree == 2)									// 3���� �� 
	{
		$SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";		
		$dbresult = mysql_query($SQL, $dbconn);
		$target_firstno = mysql_result($dbresult,0,0);		// 1��ī�װ�
		$target_thirdno = $target_category;
	}elseif($target_degree == 1)								// 2���� ��
	{
		$target_firstno = $target_prevno;
		$target_prevno = $target_category;
	}else												// 1���� ��
	{
		$target_firstno = $target_category;
	}			
			
				if($use_opt1 == '') $use_opt1 = 'f';
				if($use_opt23 == '') $use_opt23 = 'f';
				
				/*
				$SQL1 = "insert into $ItemTable (item_no, mart_id, prevno, category_num, item_name, price, z_price, bonus, 
				use_bonus, jaego, img, img_big, opt, doctype, item_explain, reg_date, item_company, read_num, item_code, 
				icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provide_price, img_sml, 
				flash_big_width, flash_big_height, if_hide, member_price,parcel_price,gibon) 
				values ('$maxItem_no_1', '$mart_id', '$target_prevno', '$target_category', '$item_name', '$price', '$z_price', '$bonus', 
				'$use_bonus','$jaego','$img_new','$img_big_new','$opt','$doctype','$item_explain','$reg_date','$item_company', 0, '$item_code',
				'$icon_no','$use_opt1','$use_opt23','100','$jaego_use','$if_strike','$if_provide_item','$provide_price',
				'$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$member_price','$parcel_price','$gibon')";
		*/


	$SQL1="insert into $ItemTable (item_no,mart_id,firstno,prevno,category_num,item_name,price,z_price,g_margin,member_price,bonus,use_bonus,jaego,img,img_big,img_big2,img_big3,img_big4,img_big5,opt,doctype,item_explain,short_explain,reg_date,item_company,read_num,item_code,icon_no,use_opt1,use_opt23,item_order,jaego_use,if_strike,if_provide_item,provider_id,provide_price,img_sml,flash_big_width,flash_big_height,if_hide,img_high,if_cash,fee,parcel_price,update_time,update_type,gibon,search_word) values ('$maxItem_no_1','$ary[mart_id]','$target_firstno', '$target_prevno', '$target_category','$ary[item_name]','$ary[price]','$ary[z_price]','$ary[g_margin]','$ary[member_price]','$ary[bonus]','$ary[use_bonus]','$ary[jaego]','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$ary[opt]','$ary[doctype]','$ary[item_explain]','$ary[short_explain]','$ary[reg_date]','$ary[item_company]',$ary[read_num],'$ary[item_code]','$ary[icon_no]','$ary[use_opt1]','$ary[use_opt23]','$ary[item_order]','$ary[jaego_use]','$ary[if_strike]','$ary[if_provide_item]','$ary[provider_id]','$ary[provide_price]','$img_sml_new','$ary[flash_big_width]','$ary[flash_big_height]','$ary[if_hide]','$ary[img_high_new]','$ary[if_cash]','$ary[fee]','$ary[parcel_price]','$ary[update_time]','$ary[update_type]','$ary[gibon]','$ary[search_word]')";


				$dbresult1 = mysql_query($SQL1, $dbconn);
				
				
			}
		/*}
		else { //gnt�� ������ ��ǰ�̸�
		}*/
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
?>
<?
mysql_close($dbconn);
?>
