<!--
// ȣ�������� : http://www.2000272.co.kr/onlineShop/ResultSms.php
// �޵�� �ʿ��� ��
// $_SHOPGROUP : �¶��� �׷�� (��:bluecart)
// $_SHOPID : �¶��α׷쿡�� ���̴� ����ID (��:online)
// $_USERID : ����� ID
// $cname : ����� �̸�
// $url : ���� URL
// $mode : 1:��ǰ�ֹ�, 2:��ǰ���, 3:�Ա�Ȯ��
// $hp1 : �ڵ���1
// $hp2 : �ڵ���2
// $hp3 : �ڵ���3

// ��ǰ�ֹ��� �ʿ����
// $item : ��ǰ�̸� : �ִ� �ѱ� 10���̳�

// ��ǰ���, �Ա�Ȯ�ν� �ʿ����
// $indate : �Ա��� �Ǵ� ����� (�� : 2003-01-01) ������ �ڵ����� ���� ��¥�� ����
-->
<html>
<head><title>SMS�߼ۿ���</title></head>
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

	if (form.item.value == '') {
        alert('��ǰ���� �Է��ϼ���');
        form.item.focus();
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
<form method='POST' action='http://www.2000272.co.kr/onlineShop/ResultSms.php' name=custinput onSubmit='return valid_customer();'>
<input type='hidden' name='mode' value='1'>
<input type='hidden' name='_SHOPGROUP' value='bluecart'>
<input type='hidden' name='_SHOPID' value='online'>
<input type='hidden' name='url' value='http://www.2000272.co.kr/onlineShop/test/SendSmsTestResult.php'>
	<TR><TD bgColor='#FFA633' colSpan=4 align=center height=25>
		<select name='mode'>
		<option value='1'>��ǰ�ֹ�</option>
		<option value='2'>��ǰ���</option>
		<option value='3'>�Ա�Ȯ��</option>
		</select>
	</TD></TR>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�� �� ��</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input style='text' size=15 name=cname value='' maxlength='15'>
		</td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>��ǰ�̸�</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input style='text' size=15 name=item value='�׽�Ʈ��ǰ' maxlength='15'>
		</td>
	</tr>
	</TR>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�����</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input style='text' size=10 name=indate value='2003-12-01' maxlength='10'>
		</td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>��ID</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; 	<input style='text' size=15 name='_USERID' maxlength='30'></td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>�޴���ȭ</b></td>
		<td width='85%' colspan=3 bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
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
	</tr>	<TR><TD bgColor='#FFA633' colSpan=4 height=2></TD></TR><tr>
		<td align=center colspan=4 height=30><input type=submit value=' SMS�߼� '></td>
	</tr>
</table>
</form>
</body>
</html>