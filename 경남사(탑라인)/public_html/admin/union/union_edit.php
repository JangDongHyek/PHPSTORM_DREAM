<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($delflag=="del"){
	$SQL = "delete from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if (isset($flag) == false) {
	$SQL = "select * from $Union_ListTable where union_no = '$union_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$limit_chk = $ary["limit_chk"];
		$limit_no = $ary["limit_no"];
		$limit_order_date = $ary["limit_order_date"];
		$limit_order_date1 = $ary["limit_order_date1"];
		$limit_pay_date = $ary["limit_pay_date"];
		$limit_pay_date1 = $ary["limit_pay_date1"];
		$limit_send_date = $ary["limit_send_date"];
		$limit_send_date1 = $ary["limit_send_date1"];
		$slide_chk = $ary["slide_chk"];
		$slide_no = $ary["slide_no"];
		$slide_order_date = $ary["slide_order_date"];
		$slide_order_date1 = $ary["slide_order_date1"];
		$slide_pay_date = $ary["slide_pay_date"];
		$slide_pay_date1 = $ary["slide_pay_date1"];
		$slide_send_date = $ary["slide_send_date"];
		$slide_send_date1 = $ary["slide_send_date1"];
		$date = $ary["date"];
		$limit_view = $ary["limit_view"];
		$slide_view = $ary["slide_view"];
		
		$limit_order_year = substr($limit_order_date,0,4);
		$limit_order_month = substr($limit_order_date,4,2);
		$limit_order_day = substr($limit_order_date,6,4);
		
		$limit_order_year1 = substr($limit_order_date1,0,4);
		$limit_order_month1 = substr($limit_order_date1,4,2);
		$limit_order_day1 = substr($limit_order_date1,6,2);
		
		$limit_pay_year = substr($limit_pay_date,0,4);
		$limit_pay_month = substr($limit_pay_date,4,2);
		$limit_pay_day = substr($limit_pay_date,6,2);
		
		$limit_pay_year1 = substr($limit_pay_date1,0,4);
		$limit_pay_month1 = substr($limit_pay_date1,4,2);
		$limit_pay_day1 = substr($limit_pay_date1,6,2);
		
		$limit_send_year = substr($limit_send_date,0,4);
		$limit_send_month = substr($limit_send_date,4,2);
		$limit_send_day = substr($limit_send_date,6,2);
		
		$limit_send_year1 = substr($limit_send_date1,0,4);
		$limit_send_month1 = substr($limit_send_date1,4,2);
		$limit_send_day1 = substr($limit_send_date1,6,2);
		
		$slide_order_year = substr($slide_order_date,0,4);
		$slide_order_month = substr($slide_order_date,4,2);
		$slide_order_day = substr($slide_order_date,6,2);
		
		$slide_order_year1 = substr($slide_order_date1,0,4);
		$slide_order_month1 = substr($slide_order_date1,4,2);
		$slide_order_day1 = substr($slide_order_date1,6,2);
		
		$slide_pay_year = substr($slide_pay_date,0,4);
		$slide_pay_month = substr($slide_pay_date,4,2);
		$slide_pay_day = substr($slide_pay_date,6,2);
		
		$slide_pay_year1 = substr($slide_pay_date1,0,4);
		$slide_pay_month1 = substr($slide_pay_date1,4,2);
		$slide_pay_day1 = substr($slide_pay_date1,6,2);
		
		$slide_send_year = substr($slide_send_date,0,4);
		$slide_send_month = substr($slide_send_date,4,2);
		$slide_send_day = substr($slide_send_date,6,2);
		
		$slide_send_year1 = substr($slide_send_date1,0,4);
		$slide_send_month1 = substr($slide_send_date1,4,2);
		$slide_send_day1 = substr($slide_send_date1,6,2);
	}

	include "../admin_head.php";
?>
<script>
function delete_item(item_no){
	if(confirm("������ �輼�Ͻðڽ��ϱ�?")){
		window.location.href='unionlist.php?delflag=del_item&item_no='+item_no
	}
	else return;
}
function checkform(f){
	var slide_pay_date,slide_order_date1;
	if(f.limit_chk.checked == false && f.slide_chk.checked == false){
		alert("�������ų� �����̵屸�� �̿뿩�θ� ýũ�� �ּ���.");
		return false;
	}
	if(f.limit_chk.checked == true){
		if(f.limit_no.value==""){
			alert("�������� ������ �Է����ּ���.");
			f.limit_no.focus();
			return false;
		}
	}
	if(f.slide_chk.checked == true){
		if(f.slide_no.value==""){
			alert("�����̵屸�� ������ �Է����ּ���.");
			f.slide_no.focus();
			return false;
		}
		slide_pay_date = f.slide_pay_year.value+f.slide_pay_month.value+f.slide_pay_day.value;
		slide_order_date1 = f.slide_order_year1.value+f.slide_order_month1.value+f.slide_order_day1.value;
		if(parseInt(slide_pay_date) <= parseInt(slide_order_date1)){
			alert("\n�����̵屸���� �Աݽ��۳�¥�� \n\n�ֹ����ᳯ¥���� �ڿ� �־�� �մϴ�.");
			return false;
		}
	}
	return true;
}
function really2(item_no, union_no){
	if (confirm("�����ǰ�� �����Ͻðڽ��ϱ�?")){
		document.location.href='union_edit.php?delflag=del&item_no='+item_no+'&union_no='+union_no; 
	}
}

</script>
<script language="JavaScript">
<!-- 
function OpenWindow() {
RemindWindow = window.open( "", "mainpage","toolbar=no,width=558,height=500,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no" 
);
}
// -->
</script>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�������� �⺻��������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF">[�������� �̿��� �� 
						�⺻���� ����]<br>
						</strong><br>
						�������Ŵ� �����Ǹ� �������ſ� �����̵� �������ŷ� 
						���������ϴ�.<br>
						<br>
						<strong>�����Ǹ�</strong>�� �Ⱓ�� ������ �̸� ������ �ְ� 
						��ǰ������ �����Ǿ� �ֽ��ϴ�. ���� ��� ���߰� 3,000����<br>
						��ǰ�� 100���� ���� 2,500���� �Ǹ��ϴ� ���Դϴ�.<br>
						<br>
						<strong>�����̵� ��������</strong>�� ������ �Ⱓ�ȿ� ����� ���̸� 
						���ϼ��� ������ �������� ����Դϴ�.<br>
						������ �����ڰ� �̸� ���س��� 3�ܰ�� �������ϴ�.<br>
						<br>
						�����Ͻ� �������Ÿ� üũ�Ͻ� �� ����ϼ���. (�ߺ�üũ ����)<br>
					</td>
					</tr>

<form name=f  method=post onsubmit="return checkform(this)">
<input type=hidden name='flag' value='update' >
<input type=hidden name='union_no' value='<?echo $union_no?>' >
				
				<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
								
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#B584C6" colspan="2">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="100%">&nbsp; 
													
													<input name="limit_chk" type="checkbox" value="1"
													<?
													if($limit_chk == 1) echo " checked"
													?>
													>
													<strong>�����Ǹ� �������� ����</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="2%" bgcolor="#DDC5E4" align="center">����</td>
										<td width="66%" bgcolor="#FFFFFF" align="left">
											
											<input name="limit_no" size="9" value='<?echo $limit_no?>' class="input_03"> 
											<font color="#0000FF">�Է¿�) �� 1��&nbsp; ���������̸� &quot;1&quot;�� �Է�</font></td>
									</tr>
									<tr>
										<td width="54%" bgcolor="#FFFFFF" align="center" colspan="2"><p align="left">�����Ǹ� �������Ŵ� ������ �Ⱓ���� 
											������ ������ ���� ���ſ� ���ÿ� �Ա��� �ϰ� �Ա�Ȯ�ΰ� ���ÿ� 
											����� �Ǵ� ���������Դϴ�. �׷��Ƿ� �Ⱓ ������ ��û�Ⱓ/�ԱݱⰣ/��۱Ⱓ�� 
											�Ȱ��� ��¥�� �Է��Ͻø� �˴ϴ�.<font color="#0000FF"><br>
											<br>
											�Է¿�) ��û�Ⱓ 2001/01/01~2001/01/10, �ԱݱⰣ 2001/01/01~2001/01/10, <br>
											��۱Ⱓ 2001/01/01~2001/01/10</font></td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center">�ɼ�</td>
										<td width="49%" bgcolor="#FFFFFF" align="center"><p align="left">
										<input type="checkbox" name="limit_view" value="1" 
										<?
										if($limit_view == '1') echo " checked"
										?>
										>
										��û�ں���� ��û���� ���� 
										<a href="09.html" target="mainpage" onclick="OpenWindow()">
										<img src="../images/09-icon.gif" border="0" align="absmiddle" WIDTH="89" HEIGHT="19"></a></td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center"><p align="center">�Ⱓ�Է�</td>
										<td width="49%" bgcolor="#FFFFFF" align="center"><p align="left"><br>
											&nbsp; ��û�Ⱓ&nbsp;&nbsp; 
											<select name="limit_order_year" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $limit_order_year) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											<select name="limit_order_month" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_order_month) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											<select name="limit_order_day" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_order_day) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� ~ 
											<select name="limit_order_year1" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $limit_order_year1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_order_month1" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_order_month1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_order_day1" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_order_day1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>��<br>
											
											&nbsp; �ԱݱⰣ&nbsp;&nbsp; 
											<select name="limit_pay_year" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $limit_pay_year) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_pay_month" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_pay_month) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_pay_day" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_pay_day) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� ~ 
											
											<select name="limit_pay_year1" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $limit_pay_year1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_pay_month1" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_pay_month1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_pay_day1" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_pay_day1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>��<br>
											
											&nbsp; ��۱Ⱓ&nbsp;&nbsp; 
											<select name="limit_send_year" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $limit_send_year) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_send_month" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_send_month) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_send_day" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_send_day) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� ~ 
											
											<select name="limit_send_year1" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $limit_send_year1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_send_month1" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_send_month1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="limit_send_day1" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $limit_send_day1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>��<br>
											<br>
											
										</td>
									</tr>
									<tr>
										<td width="54%" bgcolor="#B584C6" align="center" colspan="2">
											
											<table border="0" width="100%" cellspacing="1" cellpadding="0">
												<tr>
												<td width="100%">&nbsp; 
													<input name="slide_chk" type="checkbox" value="1"
													<?
													if($slide_chk == 1) echo " checked"
													?>
													>
													<strong>�����̵� �������� ����</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="2%" bgcolor="#DDC5E4" align="center">����</td>
										<td width="66%" bgcolor="#FFFFFF" align="left">
											
											<input name="slide_no" size="9" value='<?echo $slide_no?>' class="input_03"> 
											<font color="#0000FF">�Է¿�) �� 1��&nbsp; ���������̸� &quot;1&quot;�� �Է�</font></td>
									</tr>
									<tr>
										<td width="54%" bgcolor="#FFFFFF" align="center" colspan="2"><p align="left">�����̵� �������Ŵ� ��û�ڰ� 
											�þ���� ������ �������� ���������Դϴ�. �׷��Ƿ� �Աݰ� 
											����� �������űⰣ�� ����ɶ� �̷�����ϴ�. ���� �Ⱓ�� 
											��û�Ⱓ/�ԱݱⰣ/��۱Ⱓ�� �ٸ� ��¥�� �Է��Ͻø� �˴ϴ�.<font color="#0000FF"><br>
											<br>
											�Է¿�) ��û�Ⱓ 2001/01/01~2001/01/10, �ԱݱⰣ 2001/01/11~2001/01/15, <br>
											��۱Ⱓ 2001/01/16~2001/01/20</font></td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center">�ɼ�</td>
										<td width="49%" bgcolor="#FFFFFF" align="center"><p align="left">
										<input type="checkbox" name="slide_view" value="1" 
										<?
										if($slide_view == '1') echo " checked"
										?>
										>
										��û�ں���� ��û���� ���� 
										<a href="09.html" target="mainpage" onclick="OpenWindow()">
										<img src="../images/09-icon.gif" border="0" align="absmiddle" WIDTH="89" HEIGHT="19"></a></td>
									</tr>
									<tr>
										<td width="5%" bgcolor="#DDC5E4" align="center"><p align="center">�Ⱓ�Է�</td>
										<td width="49%" bgcolor="#FFFFFF" align="center"><p align="left"><br>
											&nbsp; ��û�Ⱓ&nbsp;&nbsp; 
											<select name="slide_order_year" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $slide_order_year) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
												
												<select name="slide_order_month" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_order_month) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_order_day" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_order_day) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� ~ 
											
											<select name="slide_order_year1" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $slide_order_year1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_order_month1" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_order_month1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_order_day1" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_order_day1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>��<br>
											
											&nbsp; �ԱݱⰣ&nbsp;&nbsp; 
											<select name="slide_pay_year" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $slide_pay_year) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_pay_month" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_pay_month) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_pay_day" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_pay_day) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� ~ 
											
											<select name="slide_pay_year1" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $slide_pay_year1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_pay_month1" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_pay_month1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_pay_day1" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_pay_day1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>��<br>
											
											&nbsp; ��۱Ⱓ&nbsp;&nbsp; 
											<select name="slide_send_year" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $slide_send_year) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_send_month" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_send_month) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_send_day" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_send_day) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� ~ 
											
											<select name="slide_send_year1" size="1">
												<?
											for($i=2001;$i<=2005;$i++){
												echo ("<option value='$i'");
												if($i == $slide_send_year1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_send_month1" size="1">
												<?
											for($i=1;$i<=12;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_send_month1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>�� 
											
											<select name="slide_send_day1" size="1">
												<?
											for($i=1;$i<=31;$i++){
												if(strlen($i)==1) $i_temp='0'.$i;
												else $i_temp = $i;
												echo ("<option value='$i_temp'");
												if($i_temp == $slide_send_day1) echo " selected";
												echo (">$i</option>");
											}
										?>
											</select>��<br>
											<br>
											</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="35" align="center">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="submit" value="����">&nbsp;
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="reset" value="���Է�">&nbsp;
						<input onclick="window.location.href='union_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="����Ʈ��"></td>
					</tr>
</form>

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
elseif ($flag == "update") {
	$limit_order_date = $limit_order_year.$limit_order_month.$limit_order_day;
	$limit_order_date1 = $limit_order_year1.$limit_order_month1.$limit_order_day1;
	$limit_pay_date = $limit_pay_year.$limit_pay_month.$limit_pay_day;
	$limit_pay_date1 = $limit_pay_year1.$limit_pay_month1.$limit_pay_day1;
	$limit_send_date = $limit_send_year.$limit_send_month.$limit_send_day;
	$limit_send_date1 = $limit_send_year1.$limit_send_month1.$limit_send_day1;
	
	$slide_order_date = $slide_order_year.$slide_order_month.$slide_order_day;
	$slide_order_date1 = $slide_order_year1.$slide_order_month1.$slide_order_day1;
	$slide_pay_date = $slide_pay_year.$slide_pay_month.$slide_pay_day;
	$slide_pay_date1 = $slide_pay_year1.$slide_pay_month1.$slide_pay_day1;
	$slide_send_date = $slide_send_year.$slide_send_month.$slide_send_day;
	$slide_send_date1 = $slide_send_year1.$slide_send_month1.$slide_send_day1;
	
	$SQL = "update $Union_ListTable set limit_chk = '$limit_chk', limit_no  = '$limit_no', limit_order_date = '$limit_order_date', limit_order_date1 = '$limit_order_date1', limit_pay_date = '$limit_pay_date', limit_pay_date1 = '$limit_pay_date1', limit_send_date = '$limit_send_date', limit_send_date1 = '$limit_send_date1', slide_chk = '$slide_chk', slide_no = '$slide_no', slide_order_date = '$slide_order_date', slide_order_date1 = '$slide_order_date1', slide_pay_date = '$slide_pay_date', slide_pay_date1 = '$slide_pay_date1', slide_send_date = '$slide_send_date', slide_send_date1  = '$slide_send_date1', limit_view='$limit_view', slide_view='$slide_view' where union_no = '$union_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL= union_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>