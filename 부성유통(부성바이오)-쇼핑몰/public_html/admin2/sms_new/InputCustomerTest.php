<!--
// ȣ�������� : http://www.2000272.co.kr/onlineShop/ResultCustomer.php
// �޵�� �ʿ��� ��
// $_SHOPGROUP : �¶��� �׷�� (��:bluecart)
// $_SHOPID : �¶��α׷쿡�� ���̴� ����ID (��:online)
// $_USERID : ����� ID
// $url : ���� URL
// $mode : 1:���߰�,2:������,3:����������

// ���߰� �� ������ �޵�� �ʿ��� ��
// $cname : ����
// $hp1 : �ڵ���1
// $hp2 : �ڵ���2
// $hp3 : �ڵ���3

// ���߰��� �߰�����
// $sex : ���� 1:����,2:����
// $bdate1 : ����
// $bdate2 : ����
// $bdate3 : ����
// $bdate_gub : ���ϱ��� 1:���,2:����
// $memorial1 : �����1 �̸�
// $m_year1 : �����1 ��
// $m_month1 : �����1 ��
// $m_day1 : �����1 ��
// $memorial2 : �����2 �̸�
// $m_year2 : �����2 ��
// $m_month2 : �����2 ��
// $m_day2 : �����2 ��
-->
<html>
<head><title>ȸ����� ����</title></head>
<body bgcolor=white>
<SCRIPT LANGUAGE='JavaScript'>
<!--
function valid_customer ()
{
	var form = document.custinput;
	var cname = form.cname.value ;
	var hp1 = form.hp1.value ;
	var hp2 = form.hp2.value ;
	var hp3 = form.hp3.value ;
	var bdate1 = form.bdate1.value ;
	var bdate2 = form.bdate2.value ;
	var bdate3 = form.bdate3.value ;

	if (cname == '') {
        alert('������ �Է��ϼ���');
        form.cname.focus();
        return false;
    }
	if (form._USERID.value == '') {
        alert('ID�� �Է��ϼ���');
        form._USERID.focus();
        return false;
    }

    if ((hp1 == '')||(hp2 == '')||(hp3 == '')) {
        alert('�ڵ�����ȣ�� �Է��ϼ���');
        form.hp1.focus();
        return false;
    }
	return true;
}

//-->
</SCRIPT>

<table width='100%' border='0' cellpadding='0' cellspacing='0' align=center>
<form method='POST' action='http://www.2000272.co.kr/onlineShop/ResultCustomer.php' name=custinput onSubmit='return valid_customer();'>
<input type='hidden' name='mode' value='1'>
<input type='hidden' name='_SHOPGROUP' value='bluecart'>
<input type='hidden' name='_SHOPID' value='online'>
<input type='hidden' name='url' value='http://www.2000272.co.kr/onlineShop/test/InputCustomerResult.php'>
	<TR><TD bgColor='#FFA633' colSpan=4 align=center height=25>
		<select name='mode'>
		<option value='1'>���߰�</option>
		<option value='2'>������</option>
		<option value='3'>������</option>
		</select>
	</TD></TR>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�� �� ��</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; <input style='text' size=15 name=cname value='' maxlength='15'></td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>��  ��</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input type='radio' name='sex' value='1' checked>�� <input type='radio' name='sex' value='2'>��
		</td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>��ID</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; 	<input style='text' size=15 name='_USERID' maxlength='30'></td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�޴���ȭ</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<select name=hp1>
			<option value=''>����</option>
			<option value=010>010</option>
			<option value=011>011</option>
			<option value=016>016</option>
			<option value=017>017</option>
			<option value=018>018</option>
			<option value=019>019</option>
			</select>
			- 
			<input style='text' size=4 name=hp2 value='' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;'  maxlength='4'>
			- 
			<input style='text' size=4 name=hp3 value='' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;'  maxlength='4'>
		</td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�������</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; 
			<input type=text name=bdate1 value='1990' size=4 maxlength=4>��
			<input type=text name=bdate2 value='1' size=2 maxlength=2>��
			<input type=text name=bdate3 value='1' size=2 maxlength=2>��
		</td>
		<td width='50%' bgColor='#F7F7F7' colspan=2 align='left' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
		  <input type='radio' name='bdate_gub' value='1' checked>��� 
		  <input type='radio' name='bdate_gub' value='2'>����
		</td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�����1</b></td>
		<td width='85%' colspan=3 bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			������̸� : <input style='text' size=15 name=memorial1 maxlength='15'>
			&nbsp;&nbsp;<input type=text name='m_year1' size=4 maxlength=4>��
			<input type=text name='m_month1' size=2 maxlength=2>��
			<input type=text name='m_day1' size=2 maxlength=2>��
		</td>
	</tr><tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�����2</b></td>
		<td width='85%' colspan=3 bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			������̸� : <input style='text' size=15 name=memorial2 maxlength='15'>
			&nbsp;&nbsp;<input type=text name='m_year2' size=4 maxlength=4>��
			<input type=text name='m_month2' size=2 maxlength=2>��
			<input type=text name='m_day2' size=2 maxlength=2>��
		</td>
	</tr>	<TR><TD bgColor='#FFA633' colSpan=4 height=2></TD></TR><tr>
		<td align=center colspan=4 height=30><input type=submit value=' ȸ����� '></td>
	</tr>
</table>
</form>
</body>
</html>