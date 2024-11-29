<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>우편번호 찾기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>

<body>
<table width="100%" align="center" cellspacing="0" style="border-collapse:collapse;">
  <tr> 
    <td height="28" align="center" bgcolor="#D5F0BB" style="border-width:2; border-color:green; border-style:solid;"> 
      <p><b><span style="font-size:9pt;">우편번호 찾기</span></b></p></td>
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
      <td height="54" align="center" colspan="3" bgcolor="#F4F7F2" style="border-top-width:1; border-right-width:1; border-left-width:1; border-top-color:rgb(102,102,102); border-right-color:rgb(102,102,102); border-left-color:rgb(102,102,102); border-top-style:solid; border-right-style:solid; border-left-style:solid;"> 
        <p style="line-height:120%;"><b><span style="font-size:10pt;">찾고자 하는 주소의 
          동/읍/면 이름을 입력하세요.<BR>
          </span></b><font color="black"><span style="font-size:9pt;">(예:서울시 송파구 
          구의2동이라면 구의2만 입력해주세요.)</span></font><FONT color=#999999><BR>
          </FONT> </td>
    </tr>
    <tr> 
      <td width="40%" height="28" align="right" bgcolor="#F4F7F2" style="border-left-width:1; border-left-color:rgb(102,102,102); border-left-style:solid;"> 
        <p><span style="font-size:9pt;">지역명 &nbsp;</span></p></td>
      <td height="28" bgcolor="#F4F7F2"> <input name="dong" type="text" id="dong" style="border-width:2; border-color:green; border-style:solid;" size="18" value="<?=$dong?>"> 
      </td>
      <td width="40%" height="28" bgcolor="#F4F7F2" style="border-right-width:1; border-right-color:rgb(102,102,102); border-right-style:solid;"> 
        <p><span style="font-size:9pt;">&nbsp;동(읍/면/리/가)</span></p></td>
    </tr>
    <tr> 
      <td height="30" align="center" colspan="3" bgcolor="#F4F7F2" style="border-right-width:1; border-bottom-width:1; border-left-width:1; border-right-color:rgb(102,102,102); border-bottom-color:rgb(102,102,102); border-left-color:rgb(102,102,102); border-right-style:solid; border-bottom-style:solid; border-left-style:solid;" valign="top"> 
        <p><b><span style="font-size:10pt;"> 
          <input name="submit" type="submit" value=" 검색 ">
          </span></b></p></td>
    </tr>
  </form>
</table>
<?=$list_begin?>
<table style="border-collapse:collapse;" cellspacing="0" width="100%" align="center">