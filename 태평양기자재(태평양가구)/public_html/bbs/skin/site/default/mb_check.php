<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ȸ�����Կ���</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_site_url?>style.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!--
	function go_login()
	{
		opener.location.href="./mb_login.php";
		self.close();
	}

	function re_input()
	{
		opener.mb_check.mb_jumin1.value="";
		opener.mb_check.mb_jumin2.value="";
		opener.mb_check.mb_jumin1.focus();
		self.close();
	}
//-->
</SCRIPT>
</head>
<body>
<table width="100%" align="center" cellspacing="0">
  <tr> 
    <td height="28" align="center"> 
      <p><b><span style="font-size:9pt;">ȸ�����Կ��� �˻�</span></b></p></td>
  </tr>
</table>
<table width="100%" height="150" align="center" cellspacing="0">
  <?=$wrong_jumin_begin?>
  <tr>
	<td align=center>
	  �߸��� �ֹε�Ϲ�ȣ�Դϴ�.
	</td>
  </tr>
  <tr>
	<td align=center> <input type="button" value="�ٽ��Է�" onClick="re_input();">
	</td>
  </tr>
  <?=$wrong_jumin_end?>

  <?=$exist_jumin_begin?>
  <tr>
	<td align=center>
	  �̹̰��Ե� �ֹε�Ϲ�ȣ�Դϴ�.
	</td>
  </tr>
  <tr>
	<td align=center> <input type="button" value="�α����ϱ�" onClick="go_login();"> </td>
  </tr>
  <?=$exist_jumin_end?>
	  
  <?=$use_jumin_begin?>
  <tr>
	<td align=center>
	  ��밡���� �ֹε�Ϲ�ȣ�Դϴ�.
	</td>
  </tr>
  <tr>
	<td align=center> <input type="button" value="�����ϱ�" onClick="self.close();"> </td>
  </tr>
  <?=$use_jumin_end?>
</table>
</body>
</html>
