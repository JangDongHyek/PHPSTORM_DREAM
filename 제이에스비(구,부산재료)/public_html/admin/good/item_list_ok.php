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

//==================  ��ǰ�� ������ ======================================================
if($delflag=="del_item"){
	if($mart_id == $mart_id){ // ����ǰ�̸�
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
	}else { //gnt�� ������ ��ǰ�̸�
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
	}
}
//================== ��ǰ�� ������ =======================================================
if($flag=="del_item"){
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
	//	if($Mall_Admin_ID == $mart_id){ // ����ǰ�̸�
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
         frameobj.location = sel.options[index].value;
     }
  }
}
function checkform(f)
{
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
function really2(item_no, mart_id){
	if (confirm("�����ǰ�� �����Ͻðڽ��ϱ�?")){
		document.location.href='item_list_ok.php?page=<?=$page?>&delflag=del_item&item_no='+item_no+'&mart_id='+mart_id;
	}
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
<?
$SQL = "select count(*) from $ItemTable where mart_id='$mart_id'";
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
		alert(\"��ǰ������ $limit_count ���� �Ѿ� �� �̻��� ��ǰ�� ������ �� �����ϴ�.\");
		return false;
	}
	";
}
else if($service_name == 'indi_base'&& $numRows > 2000){
	echo "
	 function copy_item(f){
		alert(\"��ǰ������ 2000���� �Ѿ� �� �̻��� ��ǰ�� ������ �� �����ϴ�.\");
		return false;
	}
	";
}
else if($service_name == 'free_base'&& $numRows > 150){
	echo "
	 function copy_item(f){
		alert(\"��ǰ������ 150���� �Ѿ� �� �̻��� ��ǰ�� ������ �� �����ϴ�.\");
		return false;
	}
	"	;
}
else{
	echo "
function copy_item(f){
  if (f.target_category.value==\"\") {
		alert(\"ī�װ��� �����ϼ���.\");
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

function del_item(f){
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='del_item';
		f.submit();
	}
	return true;
}
function item_ok(f){
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='item_ok';
		f.submit();
	}
	return true;
}

 function check_ver(category_num,prevno){
	window.location.href='item_add.php?category_num='+category_num+'&prevno='+prevno;
}

//-->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "3";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		 <td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�űԵ�ϻ�ǰ ���� </b> [��ü �űԵ�ϻ�ǰ�� : <?=$numRows?>��]</td>
				</tr>
			</table>

			<!--���� START~~--><br>   	
			<table border="0" width="97%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
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
							<span class="aa">�� <?=$numRows?>���� ��ǰ�� ���� ��� �߿� �ֽ��ϴ�.</span></td>
						<td width="50%" bgcolor="#FFFFFF" height="0"></td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br></td>
					</tr>
<?
if ($cnfPagecount == ""){
	$cnfPagecount = 50;
}
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

if($searchword != ''){
	$SQL = "select item_no from $ItemTable where binary replace(lower(item_name),' ','') like replace(lower('%$searchword%'),' ','') and z_price='0' order by reg_date desc";
}else{
	$SQL = "select item_no from $ItemTable where z_price='0' order by reg_date desc";
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
						<input type='hidden' name='page' value=''>
						<td width="60%" bgcolor="#FFFFFF">
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
								<a href='item_list_ok.php?page=1&searchword=$searchword'>ó��</a>
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='item_list_ok.php?page=$prev_start_page&searchword=$searchword'>
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
								<a href='item_list_ok.php?page=$i&searchword=$searchword'>$i</a>
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='item_list_ok.php?page=$next_start_page&searchword=$searchword'>
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
								<a href='item_list_ok.php?page=$total_page&searchword=$searchword'>��</a>
								");
							}
							?>
							</span>
						</td>
						<td width="40%" bgcolor="#FFFFFF" height="0" align="right">
							��ǰ�� <input  name="searchword" value='<?=$searchword?>' size="14" style="width:50%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
							<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�˻�">
							<input onclick="javascript:no_search()" class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����">
						</td>
					</form>
					</tr>
					  <tr>
						<td width="100%" bgcolor="#7BBEBD" colspan='2'>
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#E9F5F5" height="30">
										<table border="0" width="100%">
										  <tr>
											<td width='200'><input class="aa" name='item_permission' onclick="location.href='../good/excel.php?table=item'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="�ű� ��ǰ ���� �ٿ��"></td>
											<td><input class="aa" name='item_permission' onclick="location.href='../good/excel_all.php?table=item'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü ��ǰ ���� �ٿ�"></td>
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
			
			<form name='list' action='item_list_ok.php' method='post' onsubmit='return checkform1(this)'>
			<input type='hidden' name='flag' value='move_to_category'>			
			<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
					<table border="0" width="100%">
					<tr>
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="100%" bgcolor="#8FBECD" colspan="8"></td>
							</tr>
							<tr bgcolor="#C8DFEC" align="center">
								<td width="5%">����</td>
								<td width="5%">��ȣ</td>
								<td width="30%">ī�װ�</td>
								<td width="24%">��ǰ��</td>
								<!-- <td width="12%">��������</td> -->
								<td width="9%">�����</td>
								<td width="5%">�� ��</td>
								<td width="12%">����/����</td>
							</tr>

<?	
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$item_no = $ary["item_no"];
	
	$SQL1 = "select * from $ItemTable where item_no='$item_no'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$item_row = mysql_fetch_array( $dbresult1 );

	$mart_id = $item_row[mart_id];
	$prevno = $item_row[prevno];
	$category_num = $item_row[category_num];
	$item_name = $item_row[item_name];
	$reg_date = $item_row[reg_date];
	$read_num = $item_row[read_num];
	$if_hide = $item_row[if_hide];
	$provider_id = $item_row[provider_id];

	//================== 3�� ī�װ� ������ �ҷ��� ======================================
	$sql2 = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
	$res2 = mysql_query($sql2, $dbconn);
	$row2 = mysql_fetch_array( $res2 );
	$category_degree2 =  $row2[category_degree];
	$category_prevno2 = $row2[prevno];
	$category_name2 = $row2[category_name];

	//================== 2�� ī�װ� ������ �ҷ��� ======================================
	if( $category_degree2 > 0 ){
		$sql1 = "select * from $CategoryTable where category_num='$prevno' and if_hide='0' and mart_id='$mart_id'";
		$res1 = mysql_query($sql1, $dbconn);
		$row1 = mysql_fetch_array( $res1 );
		$category_degree1 =  $row1[category_degree];
		$category_prevno1 = $row1[prevno];
		$category_name1 = $row1[category_name];

	//================== 1�� ī�װ� ������ �ҷ��� ======================================
		if( $category_degree1 > 0 ){
			$sql = "select * from $CategoryTable where category_num='$category_prevno1' and if_hide='0' and mart_id='$mart_id'";
			$res = mysql_query($sql, $dbconn);
			$row = mysql_fetch_array( $res );
			$category_prevno = $row[prevno];
			$category_name = $row[category_name];
		}
	}

	//============================== �������� ������ =====================================
	$me_sql = "select name from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
	$me_res = mysql_query($me_sql, $dbconn);
	$me_row = mysql_fetch_array($me_res);
	$name = $me_row[name];

	if( $name ){
		$membername = $name;
	}else{
		$membername = "����";
	}

	if( $if_hide == "0" ){
		$if_hide_str = "�� ��";
	}else if( $if_hide == "1" ){
		$if_hide_str = "�� ��";
	}

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
							<tr bgcolor='#FFFFFF' align='center'>
								<td><input type='checkbox' name='checkSel[]' value='$item_no!$mart_id'></td>
								<td>$j</td>
								<td align='left'>$category_name > $category_name1 > $category_name2</td>
								<td align='left'><a href='item_edit_back.php?back=ok&item_no=$item_no&prevno=$category_prevno1&prevno2=$category_prevno&category_num=$category_num&page=$page&searchword=$searchword'><b>$item_name</b></a>$gnt_img $hide_str</td>
								<td>$membername</td>
								<td>$reg_date</td>
								<td>$if_hide_str</td>
								<td>
									<input class='aa' onclick=\"javascript:window.location.href='item_edit_back.php?back=ok&item_no=$item_no&prevno=$category_prevno1&prevno2=$category_prevno&category_num=$category_num&page=$page&searchword=$searchword'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'>
									<input class='aa' onClick=\"really2($item_no, '$mart_id')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'>
								</td>
							</tr>
	");
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
						<td width="30%">
						<input class="aa" onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">
						<input class="aa" onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;
						&nbsp;</td>
						<td width="70%"><p align="right"><span class="bb"><font color="#3D918A">������ ��ǰ�� </font> <input class="aa" name='item_permission' onclick="item_ok(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="�� ��">
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
//================== ��ǰ�� ������ =======================================================
if($flag == "item_ok"){
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$mart_id = $checkSels[1];
		
		//if($Mall_Admin_ID == $mart_id){ // ����ǰ�̸�
			$SQL = "update $ItemTable set if_hide='0' where item_no='$item_no' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		//}
	}

	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL=item_list_ok.php'>";
	}else{
		echo "
		<script>
			window.alert('��ǰ ������ ������ �߻��߽��ϴ�.');
		</script>
		";
		echo "<meta http-equiv='refresh' content='0; URL=item_list_ok.php'>";
	}
}
//========================================================================================
?>
<?
mysql_close($dbconn);
?>