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
if($flag=="del"){
	$SQL = "delete from $MemberTable where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if($flag=="member_confirm"){
	$SQL = "update $MemberTable set is_member='$is_member' where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
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

function confirm_cancel(num){
	if(confirm("���� ������ ����Ͻðڽ��ϱ�?")){
		location.href= 'regist.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=cancel&t_uid='+num;
	}
	else return;
}

function confirm_ok(num){
	if(confirm("���� ������ �����Ͻðڽ��ϱ�?")){
		location.href= 'regist.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=ok&t_uid='+num;
	}
	else return;
}

function check(keyset, searchword){
	if(keyset == '' || searchword == ''){
		alert("���� �˻��� �ϼ���.");
		return false;
	}
	else{
		window.location.href='mail_send.php?keyset='+keyset+'&searchword='+searchword;
		return true;
	}
}
function opensub(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
function opensub1(t,w,h)
{	 
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
$left_menu = "7";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>���� ����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="97%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">
				������ ���� �ϴ� ���Դϴ�.<br>
				���� ȸ���縦 Ŭ���Ͻø� ȸ���� �� ������ �� �� �ֽ��ϴ�.<br>
				�������� Ŭ���Ͻø� ������ ���� �� ������ �� �� �ֽ��ϴ�.<br>
				�̸��� Ŭ���Ͻø� ������ ���� ȸ���� ���� �� ������ �� �� �ֽ��ϴ�.<br>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" bgColor="#ffffff"></td>
			</tr>
			<tr>
			  <td vAlign="top" bgColor="#808080" height="1"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
			  <table width="100%" border="0" align="center">
				 <tr>
					<td width="100%" colspan="2" height="20"><p align="center"><b>[���� 
					����Ʈ]</b></td>
				 </tr>
<?
if($order == '') $order = 't_regdate';
if($orderby == '') $orderby = 'desc';

$SQL = "select * from $TicketTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$total = mysql_num_rows($dbresult);
?>
				  <form action='<?=$PHP_SELF?>?mode=search' method="POST">
				  <input type='hidden' name='page' value=''>
				  <input type='hidden' name='keyset' value='<?=$keyset?>'>
				  <tr height="20">
					<td width="25%"><b>&nbsp;&nbsp; ���� 
					��������� : �� <font color="#ff0000"><?=$total?></font></b></td>
					<!-- <td width='25%'><input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="�����߰�" onclick="location.href='insert.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'"> --></td>
					<td width="50%" align="right">
						<select name="keyset" size="1">
							<option value="provider_id" <?if($keyset == "provider_id") echo " selected";?>>ȸ�����</option>
							<option value="t_title" <?if($keyset == "t_title") echo " selected";?>>������</option>
							<option value="t_name" <?if($keyset == "t_name") echo " selected";?>>�̸�</option>
							<option value="t_ok" <?if($keyset == "t_ok") echo " selected";?>>Ȯ��</option>
						</select> 
						<input type='text' name="searchword" value='<?=$searchword?>' class="input_03" size="15"> &nbsp; 
						<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="submit" value="�˻�"> <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="���" onclick="location.href='<?=$PHP_SELF?>'"></td>
				 </tr>
				 </form>
				 <tr height='28'>
				 <form id='form1' action='<?=$PHP_SELF?>' name='form1' method='post' onsubmit='checkform(); return false'>
				 <input type="hidden" name="out_form" value="months">
					<td>
						&nbsp;&nbsp; <b>�Ⱓ�� �˻�</b>
					</td>
					<td colspan='2'>
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
				</form>
				</tr>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
			  <table width="97%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					
					<table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#E1E1E1" align="center">
					<tr height="28" bgColor="#cccccc" align="center">
						<td width="7%">No</td>
						<td width="17%">����ȸ����</td>
						<td width="18%">������</td>
						<td width="10%">�� ��</td>
						<td width="15%">��ȿ�Ⱓ</td>
						<td width="10%">Ȯ��</td>
						<td width="12%">�����</td>
						<td width="11%">��������</td>
					  </tr>
<?
if($order == 'name'){
	$binary_str = 'binary';
}else{
	$order = 't_regdate';
	$orderby = ' desc';
	$binary_str = '';
}

if( ($keyset == "t_ok") && ($searchword == "����") ){
	$searchword = "y";
}else if( ($keyset == "t_ok") && ($searchword == "�ȹ���") ){
	$searchword = "n";
}

if($mode == "search"){
	if( $keyset == "provider_id" ){
		$SQL = "SELECT * FROM $TicketTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' order by a.t_regdate desc";
	}else{
		$SQL = "select * from $TicketTable where mart_id='$mart_id' and $keyset like '%$searchword%' order by $binary_str $order $orderby";
	}
}else{
	$SQL = "select * from $TicketTable where mart_id='$mart_id' order by $binary_str $order $orderby";
}

if( $out_form == months ){
	$SQL = "select * from $TicketTable where mart_id='$mart_id' and ( t_regdate >= '$QryFromDate' and t_regdate <= '$QryToDate') order by $binary_str $order $orderby";
}

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($cnfPagecount == "") $cnfPagecount = 20;
if($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

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
<?
if( $numRows == 0 ){
?>
					  <tr align='center' bgColor='#ffffff' height='25'>
						 <td colspan='8'><b>�߱޵� ������ �����ϴ�.</b></td>
					  </tr>
<?
}
?>
<?
for($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary = mysql_fetch_array($dbresult);

	$t_uid  = $ary[t_uid ];
	$provider_id = $ary[provider_id];
	$t_title = $ary[t_title];
	$t_id  = $ary[t_id ];
	$t_name = $ary[t_name];
	$t_jumin1 = $ary[t_jumin1];
	$t_date = $ary[t_date];
	$t_regdate = $ary[t_regdate];
	$t_ok = $ary[t_ok];
	$t_yes = $ary[t_yes];

	if( $t_ok == "y" ){
		$t_ok_str = "<font color='#33A6B3'>����</font>";
	}else{
		$t_ok_str = "<font color='red'>�ȹ���</font>";
	}
	/*if( $t_yes == 'y' && $t_ok == 'n' ){
		$t_yes_str = "<input type='button' value='��������' class='input' onclick='confirm_cancel($t_uid)'>";
	}else if( $t_yes == 'y' && $t_ok == 'y' ){
		$t_yes_str = "<input type='button' value='��������' class='input' onclick=\"window.alert('�������� ���޹޾ұ� ������ ����� �� �����ϴ�')\";>";
	}else{
		$t_yes_str = "<input type='button' value='�������' class='input' onclick='confirm_ok($t_uid)'>";
	}*/
	if( $t_yes == 'y' && $t_ok == 'n' ){
		$t_yes_str = "��������";
	}else if( $t_yes == 'y' && $t_ok == 'y' ){
		$t_yes_str = "��������";
	}else{
		$t_yes_str = "�������";
	}

	$t_regdate_str = substr($t_regdate,0,4)."/".substr($t_regdate,5,2)."/".substr($t_regdate,8,2);

	$j = $numRows - $i;

	//============================== ȸ���� ������ �ҷ��� ================================
	$m_sql = "select name from $MemberTable where username='$provider_id' and mart_id='$mart_id'";
	$m_res = mysql_query($m_sql, $dbconn);
	$m_row = mysql_fetch_array($m_res);
	$member_name = $m_row[name];
	//============================== ������ ���� ȸ�� ������ �ҷ��� ======================
	if( $t_id ){
		$tm_name ="<a href='../member/member_view.php?username=$t_id'><b>$t_name</b></a>";
	}else{
		$tm_name ="<b>$t_name</b>";
	}
?>
					  <tr align='center' bgColor='#ffffff' height='25'>
						 <td><?=$j?></td>
						 <td><a href='../inmember/inmember_member_view.php?username=<?=$provider_id?>'><b><?=$member_name?></b></a></td>
						 <td align='left'> <a href='view.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&t_uid=<?=$t_uid?>'><b><?=$t_title?></b></a></td>
						 <td><?=$tm_name?></td>
						 <td><?=$t_date?></td>
						 <td><?=$t_ok_str?></td>
						 <td><?=$t_regdate_str?></td>
						 <td><?=$t_yes_str?></td>
					  </tr>
<?
}
if( $m_res ){
	mysql_free_result( $m_res );
}
if( $dbresult ){
	mysql_free_result( $dbresult );
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
<?
if($page == 1){
?>
				ó��
<?
}else{
?>
				<a href='<?=$PHP_SELF?>?page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>ó��</a> 
<?
}
if($start_page > 1){
?>
				<a href='<?=$PHP_SELF?>?page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>��</a>&nbsp;
<?
}else{
?>
				��&nbsp; 
<?
}
for($i=$start_page;$i<=$end_page;$i++){
	if($i == $page){
?>
				[<b><?=$i?></b>]
<?
	}else{
?>
				<a href='<?=$PHP_SELF?>?page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'><?=$i?></a> 
<?
	}
}
if($end_page < $total_page){
?>
				&nbsp;<a href='<?=$PHP_SELF?>?page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>��</a>
<?
}else{
?>
				&nbsp;��
<?
}
if($page == $total_page){
?>
				��
<?
}else{
?>
				<a href='<?=$PHP_SELF?>?page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>��</a> 
<?
}
?>
				</td>
			</tr>
			<tr align="middle">
			  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
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
mysql_close($dbconn);
?>