<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''){
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�׸���ǰ����</b></td>
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
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
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
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='del_item4';
		f.submit();
	}
	return true;
}


function new2_del_item(f){
	var f = document.new2_list;
  if(!checkitems11())
  {
	return false;
  }
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='del_item11';
		f.submit();
	}
	return true;
}
function fav2_del_item(f){
	var f = document.fav2_list;
  if(!checkitems12())
  {
	return false;
  }
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='del_item12';
		f.submit();
	}
	return true;
}
function rec2_del_item(f){
	var f = document.rec2_list;
  if(!checkitems13())
  {
	return false;
  }
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='del_item13';
		f.submit();
	}
	return true;
}



function best_del_item(f){
	var f = document.best_list;
  if(!checkitems3())
  {
	return false;
  }
  if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?")){
		f.flag.value='del_item3';
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

function toggle4(val) {
	dl = document.rec_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'rec_checkSel[]')
        dl.elements[i].checked = val;
    }
}

function toggle11(val) {
	dl = document.new2_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'new2_checkSel[]')
        dl.elements[i].checked = val;
    }
}
function toggle12(val) {
	dl = document.fav2_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'fav2_checkSel[]')
        dl.elements[i].checked = val;
    }
}

function toggle13(val) {
	dl = document.rec2_list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'rec2_checkSel[]')
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
		alert("��ǰ�� �����ϼ���.");
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
		alert("��ǰ�� �����ϼ���.");
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
		alert("��ǰ�� �����ϼ���.");
		return false;
	}
	return true;
}


function checkitems11(){
	var i;
	a_checkbox  = document.getElementsByName("new2_checkSel[]");
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
function checkitems12(){
	var i;
	a_checkbox  = document.getElementsByName("fav2_checkSel[]");
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
function checkitems13(){
	var i;
	a_checkbox  = document.getElementsByName("rec2_checkSel[]");
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








//-->
</script>
			<!--���� START~~-->
<br>

					<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
						<tr>
							<td width="90%" bgcolor="#ffffff">
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#a7a7a7" align="center">
<tr>
<td width="100%" bgcolor="ffffff" colspan="5">
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
		<td align=center>
		<b>���̽�</b>
		</td>
		</tr>
	</table>
</td>
</tr>

<!---------------------------- �Ż�ǰ ���� ���� ----------------------------------------->
									<form name='new_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='new_item'>
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="5">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="30%"><b>�Ż�ǰ ����</b></td>
												<td width="70%"><p align="right">
																		<input onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">&nbsp;<input onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;<input onclick="new_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="���û���">&nbsp;
													<input onclick="window.location.href='new_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Ż�ǰ ���">&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="�Ż�ǰ ���� ����">
												</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= �Ż�ǰ ���� ==============================================
$sql0 = "select * from $New_ItemTable where mart_id='$mart_id' order by new_item_order asc";
$res0 = mysql_query($sql0, $dbconn);
$tot0 = mysql_num_rows($res0);
?>
									<tr>
										<td bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot0?>���� �Ż�ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">��ȣ</td>
										<td width="10%">����</td>
										<td width="60%" colspan='2'>��ǰ��</td>
										<!-- <td width="10%">���λ�ǰ</td> -->
										<td width="10%">����</td>
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
		$new_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new&target=main&new_item_no=$new_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$new_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new&target=list&new_item_no=$new_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
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

		//================== ī�װ� ������ �ҷ��� ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");
		
		$j = $i + 1; 
	}else{
		$item_name = "��ǰ�� �����Ǿ����ϴ�.";
	} 

	if($i < $tot0 - 1){
		$down_str = "<a href='theme_item.php?new_item_no=$new_item_no&new_item_order=$new_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?new_item_no=$new_item_no&new_item_order=$new_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}

?>
									<tr bgcolor='#FFFFFF' align='center'>
									<input type='hidden' name='new_no[]' value='<?=$new_item_no?>'>
										<td><?=$j?><input type='checkbox' name='new_checkSel[]' value='<?=$new_item_no?>'></td>
										<td><input type='text' name='new_item_order[]' value='<?=$new_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>		
										<td align='left' colspan='2'><?=$upperclass_str?> &gt; <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<!-- <td><?=$new_main_str?></td> -->
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=new&new_item_no=<?=$new_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
}
?>
									</form>
<!---------------------------- �Ż�ǰ ���� �� ------------------------------------------->

<!---------------------------- �α��ǰ ���� ���� ------------------------------->
									<form name='fav_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='fav_item'>
									<tr>
										<td width="53%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td width="50%"><b>�α��ǰ ����</b></td>
													<td width="50%" align="right"><input onclick="javascript:toggle2(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">&nbsp;<input onclick="javascript:toggle2(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;<input onclick="fav_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="���û���">&nbsp;<input onclick="window.location.href='fav_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�α��ǰ ���">&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="�α��ǰ ���� ����">
													</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= �α��ǰ ���� ============================================
$sql2 = "select * from $Fav_ItemTable where mart_id='$mart_id' order by fav_item_order asc";
$res2 = mysql_query($sql2, $dbconn);
$tot2 = mysql_num_rows($res2);
?>
									<tr>
										<td width="53%" bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot2?>���� �α��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="8%">��ȣ</td>
										<td width="10%">����</td>
										<td width="72%" colspan='2'>��ǰ��</td>
										<td width="10%">����</td>
									</tr>
<?
for ($i=0; $i < $tot2; $i++){
	mysql_data_seek($res2, $i);
	$ary2 = mysql_fetch_array($res2);

	$fav_item_no = $ary2[fav_item_no];
	$item_no = $ary2[item_no];
	$provider_id = $ary2[provider_id];
	$fav_item_order = $ary2[fav_item_order];
	$fav_main =  $ary2[fav_main];

	if( $fav_main == 'y' ){
		$fav_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav&target=main&fav_item_no=$fav_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$fav_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav&target=list&fav_item_no=$fav_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
	}
			
	$sql3 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no=$item_no";
	$res3 = mysql_query($sql3, $dbconn);
	$tot3 = mysql_num_rows($res3);
	if($tot3 > 0){
		$item_name = mysql_result($res3, 0, 0);
		$price = mysql_result($res3, 0, 1);
		$mart_id = mysql_result($res3, 0, 2);
		$firstno = mysql_result($res3, 0, 3);
		$prevno = mysql_result($res3, 0, 4);
		$category_num = mysql_result($res3, 0, 5);

		//================== ī�װ� ������ �ҷ��� ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");

		$j = $i + 1;
	}else{
		$item_name = "��ǰ�� �����Ǿ����ϴ�.";
	}

	if($i < $tot2 - 1){
		$down_str = "<a href='theme_item.php?fav_item_no=$fav_item_no&fav_item_order=$fav_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?fav_item_no=$fav_item_no&fav_item_order=$fav_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	

?>								
									<tr>
									<input type='hidden' name='fav_no[]' value='<?=$fav_item_no?>'>
										<td bgcolor='#FFFFFF' align='center'><?=$j?><input type='checkbox' name='fav_checkSel[]' value='<?=$fav_item_no?>'></td>
										<td align="center"><input type='text' name='fav_item_order[]' value='<?=$fav_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>
										<td align='left' colspan='2'><?=$upperclass_str?> &gt; <a onclick="javascript:window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td align="center"><input onclick="document.location.href='theme_item.php?flag=del&target=fav&fav_item_no=<?=$fav_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
}
?>
									</form>
<!---------------------------- �α��ǰ ���� �� --------------------------------->
<!---------------------------- ��õ��ǰ ���� ���� --------------------------------------->
									<form name='rec_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='rec_item'>
									<tr>
										<td width="58%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>��õ��ǰ ����</b></td>
												<td width="50%" align="right"><input onclick="javascript:toggle4(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">&nbsp;<input onclick="javascript:toggle4(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;<input onclick="rec_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="���û���">&nbsp;
													<input onclick="window.location.href='rec_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="��õ��ǰ ���">&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="��õ��ǰ ���� ����">
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
										<td width="58%" bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot4?>���� ��õ��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="8%">��ȣ</td>
										<td width="10%">����</td>
										<td width="72%" colspan='2'>��ǰ��</td>
										<td width="10%">����</td>
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
		$rec_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec&target=main&rec_item_no=$rec_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$rec_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec&target=list&rec_item_no=$rec_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
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

		//================== ī�װ� ������ �ҷ��� ======================================
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
	else $item_name = "��ǰ�� �����Ǿ����ϴ�.";

	if($i < $tot4 - 1){
		$down_str = "<a href='theme_item.php?rec_item_no=$rec_item_no&rec_item_order=$rec_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?rec_item_no=$rec_item_no&rec_item_order=$rec_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	
	if($provider_id == "" ){
?>
									<tr bgcolor='#FFFFFF' align='center'>
									<input type='hidden' name='checkSel[]' value='<?=$rec_item_no?>'>
										<td><?=$j?><input type='checkbox' name='rec_checkSel[]' value='<?=$rec_item_no?>'></td>
										<td><input type='text' name='rec_item_order[]' value='<?=$rec_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>
										<td align='left' colspan='2'><?=$upperclass_str?> &gt;  <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=rec&rec_item_no=<?=$rec_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
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
											<a href='theme_item.php?rec_item_no=<?=$rec_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
		if($i > 0){	
?>
											<a href='theme_item.php?rec_item_no=<?=$rec_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
?>
										</td>
										<td align='left' colspan='2'><a href='../category/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=rec&rec_item_no=<?=$rec_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}
}
?>
									</form>
<!---------------------------- ��õ��ǰ ���� �� ----------------------------------------->

<?
#########################################################  ��� ######################################################
?>
<tr>
<td width="100%" bgcolor="ffffff" colspan="5">
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
		<td align=center>
		&nbsp;
		</td>
		</tr>
	</table>
</td>
</tr>
<tr>
<td width="100%" bgcolor="ffffff" colspan="5">
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
		<td align=center>
		<b>���</b>
		</td>
		</tr>
	</table>
</td>
</tr>

<!---------------------------- �Ż�ǰ ���� ���� ----------------------------------------->
									<form name='new2_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='new2_item'>
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="5">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="30%"><b>�Ż�ǰ ����</b></td>
												<td width="70%"><p align="right">
																		<input onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">&nbsp;<input onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;<input onclick="new2_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="���û���">&nbsp;
													<input onclick="window.location.href='new2_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Ż�ǰ ���">&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="�Ż�ǰ ���� ����">
												</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= �Ż�ǰ ���� ==============================================
$sql0 = "select * from $New2_ItemTable where mart_id='$mart_id' order by new_item_order asc";
$res0 = mysql_query($sql0, $dbconn);
$tot0 = mysql_num_rows($res0);
?>
									<tr>
										<td bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot0?>���� �Ż�ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">��ȣ</td>
										<td width="10%">����</td>
										<td width="60%" colspan='2'>��ǰ��</td>
										<!-- <td width="10%">���λ�ǰ</td> -->
										<td width="10%">����</td>
									</tr>
<?
for($i=0; $i < $tot0; $i++){
	mysql_data_seek($res0, $i);
	$ary0=mysql_fetch_array($res0);

	$new2_item_no = $ary0[new_item_no];
	$item_no = $ary0[item_no];
	$provider_id = $ary0[provider_id];
	$new_item_order = $ary0[new_item_order];
	$new2_main =  $ary0[new_main];

	if( $new2_main == 'y' ){
		$new2_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new2&target=main&new2_item_no=$new2_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$new2_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new2&target=list&new2_item_no=$new2_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
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

		//================== ī�װ� ������ �ҷ��� ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");
		
		$j = $i + 1; 
	}else{
		$item_name = "��ǰ�� �����Ǿ����ϴ�.";
	} 

	if($i < $tot0 - 1){
		$down_str = "<a href='theme_item.php?new2_item_no=$new2_item_no&new_item_order=$new_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?new2_item_no=$new2_item_no&new_item_order=$new_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}

?>
									<tr bgcolor='#FFFFFF' align='center'>
									<input type='hidden' name='new2_no[]' value='<?=$new2_item_no?>'>
										<td><?=$j?><input type='checkbox' name='new2_checkSel[]' value='<?=$new2_item_no?>'></td>
										<td><input type='text' name='new_item_order[]' value='<?=$new_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>		
										<td align='left' colspan='2'><?=$upperclass_str?> &gt; <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,direc2tories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<!-- <td><?=$new2_main_str?></td> -->
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=new2&new2_item_no=<?=$new2_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
}
?>
									</form>
<!---------------------------- �Ż�ǰ ���� �� ------------------------------------------->

<!---------------------------- �α��ǰ ���� ���� ------------------------------->
									<form name='fav2_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='fav2_item'>
									<tr>
										<td width="53%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td width="50%"><b>�α��ǰ ����</b></td>
													<td width="50%" align="right"><input onclick="javascript:toggle2(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">&nbsp;<input onclick="javascript:toggle2(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;<input onclick="fav2_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="���û���">&nbsp;<input onclick="window.location.href='fav2_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�α��ǰ ���">&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="�α��ǰ ���� ����">
													</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= �α��ǰ ���� ============================================
$sql2 = "select * from $Fav2_ItemTable where mart_id='$mart_id' order by fav_item_order asc";
$res2 = mysql_query($sql2, $dbconn);
$tot2 = mysql_num_rows($res2);
?>
									<tr>
										<td width="53%" bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot2?>���� �α��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="8%">��ȣ</td>
										<td width="10%">����</td>
										<td width="72%" colspan='2'>��ǰ��</td>
										<td width="10%">����</td>
									</tr>
<?
for ($i=0; $i < $tot2; $i++){
	mysql_data_seek($res2, $i);
	$ary2 = mysql_fetch_array($res2);

	$fav2_item_no = $ary2[fav_item_no];
	$item_no = $ary2[item_no];
	$provider_id = $ary2[provider_id];
	$fav_item_order = $ary2[fav_item_order];
	$fav2_main =  $ary2[fav_main];

	if( $fav2_main == 'y' ){
		$fav2_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav2&target=main&fav2_item_no=$fav2_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$fav2_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav2&target=list&fav2_item_no=$fav2_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
	}
			
	$sql3 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no=$item_no";
	$res3 = mysql_query($sql3, $dbconn);
	$tot3 = mysql_num_rows($res3);
	if($tot3 > 0){
		$item_name = mysql_result($res3, 0, 0);
		$price = mysql_result($res3, 0, 1);
		$mart_id = mysql_result($res3, 0, 2);
		$firstno = mysql_result($res3, 0, 3);
		$prevno = mysql_result($res3, 0, 4);
		$category_num = mysql_result($res3, 0, 5);

		//================== ī�װ� ������ �ҷ��� ======================================
		$cate_sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id' order by cat_order asc";
		$cate_res = mysql_query($cate_sql, $dbconn);
		$cate_row = mysql_fetch_array( $cate_res );
		$category_degree = $cate_row[category_degree]+1;

		$arr_upperclass = make_upperclass($category_num, $category_degree);
		$upperclass_str = make_upperclass_str($arr_upperclass, "print");

		$j = $i + 1;
	}else{
		$item_name = "��ǰ�� �����Ǿ����ϴ�.";
	}

	if($i < $tot2 - 1){
		$down_str = "<a href='theme_item.php?fav2_item_no=$fav2_item_no&fav_item_order=$fav_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?fav2_item_no=$fav2_item_no&fav_item_order=$fav_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	

?>								
									<tr>
									<input type='hidden' name='fav2_no[]' value='<?=$fav2_item_no?>'>
										<td bgcolor='#FFFFFF' align='center'><?=$j?><input type='checkbox' name='fav2_checkSel[]' value='<?=$fav2_item_no?>'></td>
										<td align="center"><input type='text' name='fav_item_order[]' value='<?=$fav_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>
										<td align='left' colspan='2'><?=$upperclass_str?> &gt; <a onclick="javascript:window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,direc2tories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td align="center"><input onclick="document.location.href='theme_item.php?flag=del&target=fav2&fav2_item_no=<?=$fav2_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
}
?>
									</form>
<!---------------------------- �α��ǰ ���� �� --------------------------------->
<!---------------------------- ��õ��ǰ ���� ���� --------------------------------------->
									<form name='rec2_list' action='theme_item.php' method='post'>
									<input type='hidden' name='flag' value='rec2_item'>
									<tr>
										<td width="58%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>��õ��ǰ ����</b></td>
												<td width="50%" align="right"><input onclick="javascript:toggle4(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����">&nbsp;<input onclick="javascript:toggle4(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;<input onclick="rec2_del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="���û���">&nbsp;
													<input onclick="window.location.href='rec2_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="��õ��ǰ ���">&nbsp;&nbsp;
													<input type='submit' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" value="��õ��ǰ ���� ����">
													</td>
												</tr>
											</table>
										</td>
									</tr>
<?
$sql4 = "select * from $Rec2_ItemTable where mart_id='$mart_id' order by rec_item_order asc";
$res4 = mysql_query($sql4, $dbconn);
$tot4 = mysql_num_rows($res4);
?>
									<tr>
										<td width="58%" bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot4?>���� ��õ��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="8%">��ȣ</td>
										<td width="10%">����</td>
										<td width="72%" colspan='2'>��ǰ��</td>
										<td width="10%">����</td>
									</tr>
<?
for($i=0; $i < $tot4; $i++){
	mysql_data_seek($res4, $i);
	$ary4 = mysql_fetch_array($res4);

	$rec2_item_no = $ary4[rec_item_no];
	$item_no = $ary4[item_no];
	$provider_id = $ary4[provider_id];
	$rec_item_order = $ary4[rec_item_order];
	$rec2_main =  $ary4[rec_main];

	if( $rec2_main == 'y' ){
		$rec2_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec2&target=main&rec2_item_no=$rec2_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$rec2_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec2&target=list&rec2_item_no=$rec2_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
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

		//================== ī�װ� ������ �ҷ��� ======================================
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
	else $item_name = "��ǰ�� �����Ǿ����ϴ�.";

	if($i < $tot4 - 1){
		$down_str = "<a href='theme_item.php?rec2_item_no=$rec2_item_no&rec_item_order=$rec_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?rec2_item_no=$rec2_item_no&rec_item_order=$rec_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	
	if($provider_id == "" ){
?>
									<tr bgcolor='#FFFFFF' align='center'>
									<input type='hidden' name='rec2_no[]' value='<?=$rec2_item_no?>'>
										<td><?=$j?><input type='checkbox' name='rec2_checkSel[]' value='<?=$rec2_item_no?>'></td>
										<td><input type='text' name='rec_item_order[]' value='<?=$rec_item_order?>' size='7' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></td>
										<td align='left' colspan='2'><?=$upperclass_str?> &gt;  <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,direc2tories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=rec2&rec2_item_no=<?=$rec2_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
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
											<a href='theme_item.php?rec2_item_no=<?=$rec2_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
		if($i > 0){	
?>
											<a href='theme_item.php?rec2_item_no=<?=$rec2_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
?>
										</td>
										<td align='left' colspan='2'><a href='../category/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=rec2&rec2_item_no=<?=$rec2_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}
}
?>
									</form>
<!---------------------------- ��õ��ǰ ���� �� ----------------------------------------->



								</table>
							</td>
						</tr>
					</table>

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
//================== �Ż�ǰ üũ�ڽ� ���� =================================

if($flag=="del_item1"){
	for($i=0; $i<count($new_checkSel); $i++) {
			//�Ż�ǰ���� ����	
			$sql = "delete from $New_ItemTable where new_item_no = '$new_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//================== �α��ǰ üũ�ڽ� ���� =================================

if($flag=="del_item2"){
	for($i=0; $i<count($fav_checkSel); $i++) {
			$sql = "delete from $Fav_ItemTable where fav_item_no = '$fav_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

//================== ��õ��ǰ üũ�ڽ� ���� =================================

if($flag=="del_item4"){
	for($i=0; $i<count($rec_checkSel); $i++) {
			$sql = "delete from $Rec_ItemTable where rec_item_no = '$rec_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}











if($flag=="del_item11"){
	for($i=0; $i<count($new2_checkSel); $i++) {
			//�Ż�ǰ���� ����	
			$sql = "delete from $New2_ItemTable where new_item_no = '$new2_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//================== �α��ǰ üũ�ڽ� ���� =================================

if($flag=="del_item12"){
	for($i=0; $i<count($fav2_checkSel); $i++) {
			$sql = "delete from $Fav2_ItemTable where fav_item_no = '$fav2_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

//================== ��õ��ǰ üũ�ڽ� ���� =================================

if($flag=="del_item13"){
	for($i=0; $i<count($rec2_checkSel); $i++) {
			$sql = "delete from $Rec2_ItemTable where rec_item_no = '$rec2_checkSel[$i]'";
			$res = mysql_query($sql, $dbconn);

	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}








//================== �Ż�ǰ ������ ������ ================================================
if($flag == "new_item"){						
	for($i=0; $i<count($new_no); $i++) {
		$new_item_no = $new_no[$i];
		
		$SQL = "update $New_ItemTable set new_item_order = '$new_item_order[$i]' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================


//================== �α��ǰ ��ǰ ������ ������ =================================
if($flag == "fav_item"){							
	for($i=0; $i<count($fav_no); $i++) {
		$fav_item_no = $fav_no[$i];
		
		$SQL = "update $Fav_ItemTable set fav_item_order = '$fav_item_order[$i]' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================

//================== ��õ ��ǰ ������ ������ =============================================
if($flag == "rec_item"){							
	for($i=0; $i<count($checkSel); $i++) {
		$rec_item_no = $checkSel[$i];
		
		$SQL = "update $Rec_ItemTable set rec_item_order = '$rec_item_order[$i]' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================








//================== �Ż�ǰ ������ ������ ================================================
if($flag == "new2_item"){						
	for($i=0; $i<count($new2_no); $i++) {
		$new2_item_no = $new2_no[$i];
		
		$SQL = "update $New2_ItemTable set new_item_order = '$new2_item_order[$i]' where new_item_no='$new2_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================


//================== �α��ǰ ��ǰ ������ ������ =================================
if($flag == "fav2_item"){							
	for($i=0; $i<count($fav2_no); $i++) {
		$fav2_item_no = $fav2_no[$i];
		
		$SQL = "update $Fav2_ItemTable set fav_item_order = '$fav2_item_order[$i]' where fav_item_no='$fav2_item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
//========================================================================================

//================== ��õ ��ǰ ������ ������ =============================================
if($flag == "rec2_item"){							
	for($i=0; $i<count($rec2_no); $i++) {
		$rec2_item_no = $rec2_no[$i];
		
		$SQL = "update $Rec2_ItemTable set rec_item_order = '$rec2_item_order[$i]' where rec_item_no='$rec2_item_no' and mart_id='$mart_id'";
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


	if($target == 'new2'){
		$sql = "delete from $New2_ItemTable where new_item_no = $new2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'fav2'){
		$sql = "delete from $Fav2_ItemTable where fav_item_no = $fav2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'rec2'){
		$sql = "delete from $Rec2_ItemTable where rec_item_no = $rec2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}



	if ($res == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "best"){
	if($target == 'main'){
		$sql = "update $Best_ItemTable set best_main='n' where best_item_no='$best_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Best_ItemTable set best_main='y' where best_item_no='$best_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "new"){
	if($target == 'main'){
		$sql = "update $New_ItemTable set new_main='n' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $New_ItemTable set new_main='y' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
if($flag == "fav"){
	if($target == 'main'){
		$sql = "update $Fav_ItemTable set fav_main='n' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Fav_ItemTable set fav_main='y' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "rec"){
	if($target == 'main'){
		$sql = "update $Rec_ItemTable set rec_main='n' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Rec_ItemTable set rec_main='y' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}




if($flag == "new2"){
	if($target == 'main'){
		$sql = "update $New2_ItemTable set new_main='n' where new_item_no='$new2_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $New2_ItemTable set new_main='y' where new_item_no='$new2_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
if($flag == "fav2"){
	if($target == 'main'){
		$sql = "update $Fav2_ItemTable set fav_main='n' where fav_item_no='$fav2_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Fav2_ItemTable set fav_main='y' where fav_item_no='$fav2_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "rec2"){
	if($target == 'main'){
		$sql = "update $Rec2_ItemTable set rec_main='n' where rec_item_no='$rec2_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Rec2_ItemTable set rec_main='y' where rec_item_no='$rec2_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}




if($flag == "up"){
	if(!empty($new_item_no)&&!empty($new_item_order)){
		$sql = "select new_item_order from $New_ItemTable where new_item_order > $new_item_order and mart_id='$mart_id' order by new_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_new_item_order = mysql_result($res,0,0);
		
		$sql = "select new_item_no from $New_ItemTable where new_item_order = $up_new_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_new_item_no = mysql_result($res,0,0);

		$sql = "update $New_ItemTable set new_item_order = $up_new_item_order where new_item_no = $new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";

		$sql = "update $New_ItemTable set new_item_order = $new_item_order where new_item_no = $up_new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($fav_item_no)&&!empty($fav_item_order)){
		$sql = "select fav_item_order from $Fav_ItemTable where fav_item_order > $fav_item_order and mart_id='$mart_id' order by fav_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_fav_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $Fav_ItemTable where fav_item_order = $up_fav_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_fav_item_no = mysql_result($res,0,0);
		
		$sql = "update $Fav_ItemTable set fav_item_order = $up_fav_item_order where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Fav_ItemTable set fav_item_order = $fav_item_order where fav_item_no = $up_fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($rec_item_no)&&!empty($rec_item_order)){
		$sql = "select rec_item_order from $Rec_ItemTable where rec_item_order > $rec_item_order and mart_id='$mart_id' order by rec_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_rec_item_order = mysql_result($res,0,0);
		
		$sql = "select rec_item_no from $Rec_ItemTable where rec_item_order = $up_rec_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_rec_item_no = mysql_result($res,0,0);
		
		$sql = "update $Rec_ItemTable set rec_item_order = $up_rec_item_order where rec_item_no = $rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Rec_ItemTable set rec_item_order = $rec_item_order where rec_item_no = $up_rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	

	
	
	
	
	
	
	
	
	
	if(!empty($new2_item_no)&&!empty($new2_item_order)){
		$sql = "select new_item_order from $New2_ItemTable where new_item_order > $new2_item_order and mart_id='$mart_id' order by new_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_new2_item_order = mysql_result($res,0,0);
		
		$sql = "select new_item_no from $New2_ItemTable where new_item_order = $up_new2_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_new2_item_no = mysql_result($res,0,0);

		$sql = "update $New2_ItemTable set new_item_order = $up_new2_item_order where new_item_no = $new2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";

		$sql = "update $New2_ItemTable set new_item_order = $new2_item_order where new_item_no = $up_new2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($fav2_item_no)&&!empty($fav2_item_order)){
		$sql = "select fav_item_order from $Fav2_ItemTable where fav_item_order > $fav2_item_order and mart_id='$mart_id' order by fav_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_fav2_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $Fav2_ItemTable where fav_item_order = $up_fav2_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_fav2_item_no = mysql_result($res,0,0);
		
		$sql = "update $Fav2_ItemTable set fav_item_order = $up_fav2_item_order where fav_item_no = $fav2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Fav2_ItemTable set fav_item_order = $fav2_item_order where fav_item_no = $up_fav2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($rec2_item_no)&&!empty($rec2_item_order)){
		$sql = "select rec_item_order from $Rec2_ItemTable where rec_item_order > $rec2_item_order and mart_id='$mart_id' order by rec_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_rec2_item_order = mysql_result($res,0,0);
		
		$sql = "select rec_item_no from $Rec2_ItemTable where rec_item_order = $up_rec2_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_rec2_item_no = mysql_result($res,0,0);
		
		$sql = "update $Rec2_ItemTable set rec_item_order = $up_rec2_item_order where rec_item_no = $rec2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Rec2_ItemTable set rec_item_order = $rec2_item_order where rec_item_no = $up_rec2_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
?>
<?
mysql_close($dbconn);
?>