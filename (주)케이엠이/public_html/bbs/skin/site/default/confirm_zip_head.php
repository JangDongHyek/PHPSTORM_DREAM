<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>�����ȣ ã��</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>

<body topmargin="0" leftmargin="0">
<table width="100%" align="center" cellspacing="0" style="border-collapse:collapse;">
  <tr> 
    <td height="28" align="center"><img src="images/zip_head.gif" width="464" height="75"></td>
  </tr>
</table>
<table width="100%" align="center" cellspacing="0" style="border-collapse:collapse;">
  <form name="mb_form" method="post" enctype="multipart/form-data">
    <input name="frm_name" type="hidden" value="<?=$frm_name?>">
    <input name="frm_zip1" type="hidden" value="<?=$frm_zip1?>">
    <input name="frm_zip2" type="hidden" value="<?=$frm_zip2?>">
    <input name="frm_addr1" type="hidden" value="<?=$frm_addr1?>">
    <input name="frm_addr2" type="hidden" value="<?=$frm_addr2?>">
    <tr> 
      <td height="54" align="center" colspan="3" bgcolor="#FFFFFF"> 
        <p style="line-height:120%;"><b><span style="font-size:10pt;">ã���� �ϴ� �ּ��� 
          ��/��/�� �̸��� �Է��ϼ���.<BR>
          </span></b><font color="black"><span style="font-size:9pt;">(��:����� ���ı� 
          ����2���̶�� ����2�� �Է����ּ���.)</span></font><FONT color=#999999><BR>
      </FONT> </td>
    </tr>
    <tr> 
      <td width="40%" height="28" align="right" bgcolor="#FFFFFF"> 
      <p><span style="font-size:9pt;">������ &nbsp;</span></p></td>
      <td height="28" bgcolor="#FFFFFF"> <input name="dong" type="text" id="dong" style="border-width:2; border-color:6096B9; border-style:solid;" size="18" value="<?=$dong?>"> 
      </td>
      <td width="40%" height="28" bgcolor="#FFFFFF"> 
      <p><span style="font-size:9pt;">&nbsp;��(��/��/��/��)</span></p></td>
    </tr>
    <tr> 
      <td height="30" align="center" colspan="3" bgcolor="#FFFFFF" valign="top"> 
        <p><b><span style="font-size:10pt;"> 
          <input name="submit" type="image" src="images/zip_confirm.gif" value=" �˻� ">
      </span></b></p></td>
    </tr>
  </form>
</table>
<?=$list_begin?>
<table style="border-collapse:collapse;" cellspacing="0" width="100%" align="center">