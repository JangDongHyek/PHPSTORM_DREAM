<?
include "../lib/Mall_Admin_Session.php";
?>
<?
include "../admin_head.php";
include "../stat/cal.php";
?>
<?
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
</script>
<script>
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

function checkform(){
	var frm = document.form1;
	var Digit = '1234567890'
	
	if (frm.QryFromDate.value==""){
		alert("���ۿ��� �Է��ϼ���");
		frm.QryFromDate.focus();
		return false;
	}
	else{
		var len =frm.QryFromDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryFromDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("���Ŀ� �°� �Է� �ϼ���");
				frm.QryFromDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryToDate.value==""){
		alert("������� �Է��ϼ���");
		frm.QryToDate.focus();
		return false;
	}
	else{
		var len =frm.QryToDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryToDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("���Ŀ� �°� �Է� �ϼ���");
				frm.QryToDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryMonth.value==""){
		alert("�ش���� �Է��ϼ���");
		frm.QryMonth.focus();
		return false;
	}
	else{
		var len =frm.QryMonth.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryMonth.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("���Ŀ� �°� �Է� �ϼ���");
				frm.QryMonth.focus();
				return false;
			}
			ret = false;
		}	
	}
	return true;
}

function item_search(){
	if(checkform() == false) return false;
	var f=document.form1;
	if(f.item_name.value == ''){
		alert("�˻�� �Է��� �ּ���.");
		f.item_name.focus();
		return false;
	}
	f.search_flag.value = 'item';
	f.submit();
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

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">���� ���θ��� ������ ��� ȸ����鿡 ���� ������ ���/�����ϴ� ���Դϴ�.<br>������ ȸ������ ���������� ���޵� ��츸 ���꿡 ���Ե˴ϴ�.</td>
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
					<td width="100%" colSpan="2" height="20"><p align="center"><b>[����
					����Ʈ]</b></td>
				 </tr>
				 <tr>
					<td colSpan="2">
						<form id='form1' action='<?=$PHP_SELF?>' name='form1' method='post'>
						<input type='hidden' name='flag' value='search'>
						<input type='hidden' name='search_flag' value=''>
						<input type='hidden' name='page' value='<?=$page?>'>
						<table border="0" width="100%" cellspacing="1" cellpadding="3">				
							<tr>
								<td width="100%" bgcolor="#E9F5F5" height="30">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
                      				<tr>
										<td width="100%" height="25" colspan="5">
											<table border="0" width="98%" cellspacing="1" cellpadding="2">
												<tr>
													<td width="3%">
														<input type="radio" value="months" name="out_form" <?if($out_form == 'months'||$out_form == '') echo "checked"?>>
													</td>
													<td width="164%" colspan="2">�Ⱓ�� ���Ͽ� �˻��մϴ�.</td>
												</tr>
												<tr>
													<td width="3%"></td>
													<td width="30%">
														<input name="QryFromDate" value="<?=$QryFromDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="8"> 
														<font color="#3d918a">~</font> 
														<input name="QryToDate" value="<?=$QryToDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="7">
													</td>
													<td width="67%" valign="top">
														<input type='button' class='butt_none' style='width:40' value='1����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:1')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='2����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:2')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='3����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:3')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='4����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:4')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='5����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:5')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='6����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:6')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='12����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:12')">&nbsp;&nbsp;&nbsp;<input type='image' onfocus='blur();' src="../images/ggo.gif" border="0" width="39" height="18" style='cursor:hand'  align='absmiddle'>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</form>
					</td>
				 </tr>
<?
if($order == '') $order = 'date';
if($orderby == '') $orderby = 'desc';

$SQL = "select * from $MemberTable where mart_id='$mart_id' and perms='4'";
$dbresult = mysql_query($SQL, $dbconn);
$total = mysql_num_rows($dbresult);
?>
				 <form action='<?=$PHP_SELF?>' method="POST">
				 <input type='hidden' name='page' value=''>
				 <tr>
					<td width="50%" height="20"><b>&nbsp;&nbsp; ���� 
					ȸ����� : �� <font color="#ff0000"><?=$total?></font></b></td>
					<td width="50%" height="20" align="right">
					<select name="keyset" size="1">
						<option value="name" <?if($keyset == "name") echo " selected";?>>ȸ�����</option>
						<option value="username" <?if($keyset == "username") echo " selected";?>>���̵�</option>
						<option value="address" <?if($keyset == "address") echo " selected";?>>�ּ�</option>
						<option value="email" <?if($keyset == "email") echo " selected";?>>�̸���</option>
					</select> 
					<input type='text' name="searchword" value='<?=$searchword?>' class="input_03" size="15"> &nbsp; 
					<input class='butt_none' style='width:40' type="submit" value="�� ��"> <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="���" onclick="location.href='<?=$PHP_SELF?>'"></td>
				 </tr>
				 </form>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center>
			  <table width="97%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					
					<table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#E1E1E1" align="center">
					<tr align="middle" height="30">
						<td width="10%" bgColor="#cccccc"><b>�� ȣ</b></td>
						<td width="20%" bgColor="#cccccc"><b>ȸ�����</b></td>
						<td width="20%" bgColor="#cccccc"><b>����ó</b></td>
						<td width="20%" bgColor="#cccccc"><b>�̸���</b></td>
						<td width="30%" bgColor="#cccccc"><b>���ұݾ�</b></td>
					  </tr>
<?
if($order == 'name') $binary_str = 'binary';
else $binary_str = '';
$SQL1 = "select * from $MemberTable where mart_id='$mart_id' and perms='4'";
$SQL2 = " and $keyset like '%$searchword%' ";
$SQL3 = " order by $binary_str $order $orderby";

if(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!=""))
	$SQL=$SQL1.$SQL2.$SQL3;
else
	$SQL=$SQL1.$SQL3;

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
if( $numRows == '0' ){
?>
					  <tr align='center' height='30' colspan='5'>
						 <td bgColor='#ffffff' align='center'>���� ����� �����ϴ�</td>
					  </tr>
<?
}
?>
<?
$from_end_day = how_many_days(substr($QryFromDate,0,4), substr($QryFromDate,5,2));
$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

//$QryFromDate = str_replace( "-", "", $QryFromDate );
//$QryToDate = str_replace( "-", "", $QryToDate );
$QryFromDate1 = $QryFromDate."-01";
$QryToDate =
$QryToDate1 = $QryToDate."-".$to_end_day;

for($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary = mysql_fetch_array($dbresult);
	$username = $ary[username];
	$password = $ary[password];
	$name = $ary[name];
	$email = $ary[email];
	$tel1 = $ary[tel1];

	$c_sql = "select * from $TicketTable where mart_id='$mart_id' and provider_id='$username' and t_ok='y' and ( t_getdate >= '$QryFromDate1' and t_getdate <= '$QryToDate1') order by t_uid desc";
	$c_res = mysql_query($c_sql, $dbconn);
	$c_tot = mysql_num_rows( $c_res );

	$sum = 0;
	while( $c_row = mysql_fetch_array($c_res) ){
		$t_uid = $c_row[t_uid];
		$t_title = $c_row[t_title];
		$t_id  = $c_row[t_id ];
		$t_name = $c_row[t_name];
		$t_money = $c_row[t_money];
		$t_date = $c_row[t_date];
		$t_regdate = $c_row[t_regdate];

		$sum_tot += $t_money;
	}
	$j = $numRows - $i;
	$sum_str = number_format($sum_tot);
?>
					  <tr align='center' height="25">
						 <td bgColor='#ffffff'><?=$j?></td>
						 <td bgColor='#ffffff'><a href='cal_view.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&provider_id=<?=$username?>&QryFromDate=<?=$QryFromDate1?>&QryToDate=<?=$QryToDate1?>'><b><?=$name?></b></a></td>
						 <td bgColor='#ffffff'><?=$tel1?></td>
						 <td bgColor='#ffffff'><?=$email?></td>
						 <td bgColor='#ffffff'><b><?=$sum_str?>��</b></td>
					  </tr>
<?								
}
?>
					</table>
					</td>
				 </tr>
			  </table>
			  </center></div></td>
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
				<a href='<?=$PHP_SELF?>?page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate1?>&QryToDate=<?=$QryToDate1?>'>ó��</a> 
<?
}
if($start_page > 1){
?>
				<a href='<?=$PHP_SELF?>?page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate1?>&QryToDate=<?=$QryToDate1?>'>��</a>&nbsp;
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
				<a href='<?=$PHP_SELF?>?page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate1?>&QryToDate=<?=$QryToDate1?>'><?=$i?></a> 
<?
	}
}
if($end_page < $total_page){
?>
				&nbsp;<a href='<?=$PHP_SELF?>?page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate1?>&QryToDate=<?=$QryToDate1?>'>��</a>
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
				<a href='<?=$PHP_SELF?>?page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate1?>&QryToDate=<?=$QryToDate1?>'>��</a> 
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