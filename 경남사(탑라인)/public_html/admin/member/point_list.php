<?
include "../lib/Mall_Admin_Session.php";
?>
<?
include "../stat/cal.php";

if($page == ""){
	$page = 1;
}

if( $QryFromDate ){
	$QryFromDate = substr($QryFromDate,0,7);
}else{
	$QryFromDate = date("Y-m");
}
if( $QryToDate ){
	$QryToDate = substr($QryToDate,0,7);
}else{
	$QryToDate = date("Y-m");
}

if($QryMonth == '') $QryMonth = date("Y-m");

$from_end_day = how_many_days(substr($QryFromDate,0,4), substr($QryFromDate,5,2));
$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

$QryFromDate = $QryFromDate."-01";
$QryToDate = $QryToDate."-".$to_end_day;
?>
<?
include "../admin_head.php";
?>

<script>
function fn_betdate(objname1, objname2, difvalue){	//'���س�¥�� �������� ���� ��¥ ��������
	obj1 = MM_findObj(objname1,document,form1);
	obj2 = MM_findObj(objname2,document,form1);
	var datD = new Date(<?echo date("Y")?>,<?echo date("m")?>-1,<?echo date("d")?>);
	var arrValue = new Array();
	obj2.value = fn_getdate(datD);
	arrValue = difvalue.split(":");
	if(arrValue[0] == "D"){
		datD.setDate(datD.getDate() - eval(arrValue[1]));
	}
	if(arrValue[0] == "M"){
		datD.setMonth(datD.getMonth() - eval(arrValue[1]));
	}
	obj1.value = fn_getdate(datD);
}
function fn_getdate(datArg){	//'���� ���� ��������
	var datD = datArg;
	var strTemp = "";
	strTemp = strTemp + datD.getYear() + "-";
	strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2);
	//strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2) + "-";
	//strTemp = strTemp + fn_numformat(datD.getDate(),2);
	return strTemp;
}
function fn_numformat(intNum, intLen){	//'���ڼ��� ���߾� 0�� ���� ���� ����
	var strNum = intNum + "";
	var strTemp = "";
	for(i = 0; i < (eval(intLen) - strNum.length); i++){
		strTemp = "0" + strTemp;
	}
	strTemp = strTemp + strNum;
	return strTemp;
}
function MM_findObj(n, d, f) { //'��ü�� ã��
	var p,i,x;
	if(!d) d = document;
	if((p = n.indexOf("?"))>0 && parent.frames.length) {
		d = parent.frames[n.substring(p+1)].document;
		n = n.substring(0,p);
	}
	if(!(x = d[n]) && d.all) x = d.all[n];
	for (i = 0;!x && i<d.forms.length;i++) x = d.forms[i][n];
	for(i = 0;!x && d.layers && i<d.layers.length;i++) x = MM_findObj(n,d.layers[i].document);
	if(!x  &&  document.getElementById) x = document.getElementById(n); 
	if(f) x = d.form1[n];
	return x;
}

function checkform(){
	var frm = document.form1;
	var Digit = '1234567890'
	
	if (frm.QryFromDate.value==""){
		alert("���ۿ��� �Է��ϼ���");
		frm.QryFromDate.focus();
		return false;
	}

	if (frm.QryToDate.value==""){
		alert("������� �Է��ϼ���");
		frm.QryToDate.focus();
		return false;
	}

	if (frm.QryMonth.value==""){
		alert("�ش���� �Է��ϼ���");
		frm.QryMonth.focus();
		return false;
	}

	return true;
}
</script>
<script>
function del(username){
	if(confirm("�����Ͻðڽ��ϱ�?")){
		window.location.href='<?=$PHP_SELF?>?flag=del&username='+username;
	}
	else return;
}

function check(keyset, searchword){
	if(keyset == '' || searchword == ''){
		alert("���� �˻��� �ϼ���.");
		return false;
	}else{
		window.location.href='mail_send.php?keyset='+keyset+'&searchword='+searchword;
		return true;
	}
}
function opensub(t,w,h){	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
function opensub1(t,w,h){	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>����Ʈ ����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">������ ����Ʈ�� ��ȯ�� ȸ������ ����Ʈ�� ���/�����ϴ� ���Դϴ�. <br>ȸ������ Ŭ���Ͻø� ����Ʈ�� �߰� �Ǵ� �谨�Ͻ� �� �ֽ��ϴ�.</td>
			</tr>
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#808080" height="1"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
			  <table width="95%" border="0" align="center">
				 <tr>
					<td width="100%" colSpan="2" height="20"><p align="center"><b>[����Ʈ 
					����Ʈ]</b></td>
				 </tr>

<?
if($order == '') $order = 'date';
if($orderby == '') $orderby = 'desc';


?>
					<!-- <form action='<?=$PHP_SELF?>' method="POST">
					<input type='hidden' name='page' value='<?=$page?>'>
					<input type='hidden' name='keyset' value='<?=$keyset?>'>
					<tr height="30">
						<td width='15%'>&nbsp;&nbsp; <b>�� ��</b></td>
						<td width="85%">
							<select name="keyset" size="1">
								<option value="username" <?if($keyset == "username") echo " selected";?>>���̵�</option>
								<option value="name" <?if($keyset == "name") echo " selected";?>>�̸�</option>
								<option value="address" <?if($keyset == "address") echo " selected";?>>�ּ�</option>
								<option value="email" <?if($keyset == "email") echo " selected";?>>�̸���</option>
							</select> 
						<input type='text' name='searchword' value='<?=$searchword?>' class="input_03" size="15"> &nbsp; 
						<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="�˻�"> <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="���" onclick="location.href='<?=$PHP_SELF?>'"></td>
					</tr>
					</form> -->

					<form id='form1' action='<?=$PHP_SELF?>' name='form1' method='post' onsubmit='checkform(); return false'>
					<tr height='30'>
					 <input type="hidden" name="out_form" value="months">
						<td>&nbsp;&nbsp; <b>�Ⱓ�� �˻�</b></td>
						<td>
							<input name="QryFromDate" value="<?=$QryFromDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="8"> 
							<font color="#3d918a">~</font> 
							<input name="QryToDate" value="<?=$QryToDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="7">
							<input type='button' class='butt_none' style='width:40' value='1����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:1')">&nbsp; 
							<input type='button' class='butt_none' style='width:40' value='2����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:2')">&nbsp; 
							<input type='button' class='butt_none' style='width:40' value='3����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:3')">&nbsp; 
							<input type='button' class='butt_none' style='width:40' value='4����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:4')">&nbsp; 
							<input type='button' class='butt_none' style='width:40' value='5����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:5')">&nbsp; 
							<input type='button' class='butt_none' style='width:40' value='6����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:6')">&nbsp; 
							<input type='button' class='butt_none' style='width:40' value='12����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:12')">&nbsp;&nbsp;&nbsp;<input type='image' onfocus='blur();' src="../images/ggo.gif" border="0" width="39" height="18" style='cursor:hand'  align='absmiddle'>
						</td>
					</tr>
					</form>
				</table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
			  <table width="97%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					<table border="0" cellpadding="1" cellspacing="1" width="100%" bordercolordark="white" align="center">
					<tr bgColor="#CCCCCC" height="28" align="center">
						<td width='10%'><b>No</b></td>
						<td width="10%"><b>ȸ�� ID</b></td>
						<td width="15%"><b>ȸ����</b></td>
						<td width="19%"><b>�����߱�ȸ����</b></td>
						<td width="15%"><b>����Ʈ������</b></td>
						<td width='15%'><b>���� ����Ʈ</b></td>
						<td width="15%"><b>�ܿ� ����Ʈ</b></td>
					  </tr>
<?
if($page == ""){
	$page = 1;
}

if($order == 'name') $binary_str = 'binary';
else $binary_str = '';

if( $keyset ){
	if( $out_form == months ){
		$SQL = "select * from $BonusTable where mart_id='$mart_id' and (t_title != 'null') and ($keyset like '%$searchword%') and ( write_date >= '$QryFromDate' and write_date <= '$QryToDate') order by num desc";
	}else{
		$SQL = "select * from $BonusTable where mart_id='$mart_id' and (t_title != 'null') and ($keyset like '%$searchword%') order by num desc";
	}
}else{
	if( $out_form == months ){
		$SQL = "select * from $BonusTable where mart_id='$mart_id' and (t_title != 'null') and ( write_date >= '$QryFromDate' and write_date <= '$QryToDate') order by num desc";
	}else{
		$SQL = "select * from $BonusTable where mart_id='$mart_id' and t_title != 'null' order by num desc";
	}
}

$result = mysql_query($SQL, $dbconn);
$total = mysql_num_rows($result);

$line = 20;
$list = 10;
$total_page = ceil($total/$line);
$total_list = intval($total_page/$list);

if($total_page%$list == 0){
	$total_list--;
}

$curr_list = intval($page/$list);

if($page%$list == 0){
	$curr_list--;
}

$start_page = $curr_list*$list+1;
$prev_list = $start_page - $list;
$next_list = $start_page + $list;
$olds = $line*($page-1);

$i = 0;
while( $row = mysql_fetch_array($result) ){
	$idx = $total - ($olds + $i);
	$i++;

	$id = $row[id];
	$t_title = $row[t_title];
	$bonus = $row[bonus];
	$bonus_str = number_format($bonus);
	$provider_id = $row[provider_id];//������ ������ ȸ����
	$write_date = $row[write_date];
	$write_date_str = substr($write_date,0,10);
	if( !$write_date ){
		$write_date_str = "";
	}

	//========================= ȸ������� ������ ========================================
	$mem_sql = "select name from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
	$mem_res = mysql_query($mem_sql, $dbconn);
	$mem_row = mysql_fetch_array( $mem_res );
	$mem_name = $mem_row[name];
	if( !$mem_name ){
		$mem_name = "...";
	}

	//========================= ȸ������ ������ ==========================================
	$mem_sql1 = "select name from $Mart_Member_NewTable where mart_id='$mart_id' and username='$id'";
	$mem_res1 = mysql_query($mem_sql1, $dbconn);
	$mem_row1 = mysql_fetch_array( $mem_res1 );
	$name = $mem_row1[name];
	if( !$name ){
		$name = "...";
	}

	//========================= ����Ʈ �հ踦 ������ =====================================
	$bo_sql = "select * from $BonusTable where id='$id' order by num desc";
	$bo_res = mysql_query($bo_sql, $dbconn);
	$sum = 0;
	while( $bo_row = mysql_fetch_array($bo_res) ){
		$bonus = $bo_row[bonus];
		$sum = $sum + $bonus;
	}
	$bonus_total_str = number_format($sum);
?>
					  <tr height='25' bgColor='#F3F3F3' align='center'>
						 <td><?=$idx?></td>
						 <td><a href="javascript:opensub('bonus.php?username=<?=$id?>&mode=point&provider_id=<?=$provider_id?>', 665, 400)"><b><?=$id?></b></a></td>
						 <td><a href="javascript:opensub('bonus.php?username=<?=$id?>&mode=point&provider_id=<?=$provider_id?>', 665, 400)"><b><?=$name?></b></a></td>
						 <td><?=$mem_name?></td>
						 <td><?=$write_date_str?></td>
						 <td><?=$bonus_str?></td>
						 <td><?=number_format($sum)?></td>
					  </tr>
<?
}
if( $dbresult ){
	mysql_free_result( $dbresult );
}						 
if( $mem_res ){
	mysql_free_result( $mem_res );
}
?>
					</table>
					</td>
				 </tr>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff"><p align="right">
<!----------------------------------- ����¡ ���� --------------------------------------->
<? 
if($prev_list <= 0){ 
?>
				ó��
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&page=<?=$prev_list?>&sort=<?=$sort?>&sort2=<?=$sort2?>">ó��</a>
<? 
} 
?>
<? 
if($page-1 <= 0){ 
?>
				��
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&page=<?=$page-1?>&sort=<?=$sort?>&sort2=<?=$sort2?>">��</a>
<? 
} 
?>
				&nbsp;
<? 
for($i=$start_page;$i<$start_page+$list;$i++){ 
?>
<? 
	if($i == $page){ 
?>
				<b><?=$i?></b>
<? 
	}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&page=<?=$i?>&sort=<?=$sort?>&sort2=<?=$sort2?>"><?=$i?></a>
<? 
	} 
?>
				&nbsp;
<?
	if($i>=$total_page)
	break
?>
<? 
} 
?>
<? 
if($page+1 > $total_page){ 
?>
				��
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&page=<?=$page+1?>&sort=<?=$sort?>&sort2=<?=$sort2?>">��</a>
<? 
} 
?>
<? 
if($next_list>$total_page){ 
?>
				��
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&page=<?=$next_list?>&sort=<?=$sort?>&sort2=<?=$sort2?>">��</a>
<? 
} 
?>
<!----------------------------------- ����¡ �� ----------------------------------------->
				</td>
			</tr>
			<tr align="middle">
			  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
			</tr>
		 </table>

			<!--���� END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>