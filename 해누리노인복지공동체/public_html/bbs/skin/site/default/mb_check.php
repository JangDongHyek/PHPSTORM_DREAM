<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>회원가입여부</title>
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
      <p><b><span style="font-size:9pt;">회원가입여부 검색</span></b></p></td>
  </tr>
</table>
<table width="100%" height="150" align="center" cellspacing="0">
  <?=$wrong_jumin_begin?>
  <tr>
	<td align=center>
	  잘못된 주민등록번호입니다.
	</td>
  </tr>
  <tr>
	<td align=center> <input type="button" value="다시입력" onClick="re_input();">
	</td>
  </tr>
  <?=$wrong_jumin_end?>

  <?=$exist_jumin_begin?>
  <tr>
	<td align=center>
	  이미가입된 주민등록번호입니다.
	</td>
  </tr>
  <tr>
	<td align=center> <input type="button" value="로그인하기" onClick="go_login();"> </td>
  </tr>
  <?=$exist_jumin_end?>
	  
  <?=$use_jumin_begin?>
  <tr>
	<td align=center>
	  사용가능한 주민등록번호입니다.
	</td>
  </tr>
  <tr>
	<td align=center> <input type="button" value="가입하기" onClick="self.close();"> </td>
  </tr>
  <?=$use_jumin_end?>
</table>
</body>
</html>
