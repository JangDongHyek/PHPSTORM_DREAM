<html>
<head>
<title>비밀번호를 입력해 주세요</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<LINK href="../style.css" type=text/css rel=stylesheet>
<script language="javascript">
<!--
    function allblur() {
         for (i = 0; i < document.links.length; i++)
              document.links[i].onfocus = document.links[i].blur;
    }
	function passChkSubmit() {
		if(document.frmChk.passwd.value == "") {
			alert("비밀번호를 입력하세요");
			document.frmChk.passwd.focus();
		} else {
			document.frmChk.target = "ifmPassChk";
			document.frmChk.action = "booking_pass_chk.php?search=<?=$search?>&keyword=<?=$keyword?>&page=<?=$page?>&search=<?=$search?>&word=<?=$word?>&no=<?=$no?>";
			document.frmChk.submit();  
		}
	}
//-->
</script>
</HEAD>

<body onLoad="allblur();" bgcolor="D1D1D1" leftmargin="0" topmargin="0">

<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" height="50"><img src="img/pass_tit.gif" width="400" height="50"></td>
  </tr>
  <tr>
    <td valign="top" align="center" bgcolor="7D7D7D">
      <table width="385" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="top" style="margin:5pt;">

            <table width="385" border="0" cellpadding="2">
              <tr>
                <td bgcolor="white" align="center" width="377"><p style="margin:5pt;"><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<form name="frmChk" method="post">
<TBODY>
<TR>
<TD align=middle width="8%"><IMG height=11 
src="img/com_arrow.gif" width=11></TD>
<TD width="50%"><SPAN class=body>작성자만 볼 수 있습니다.</SPAN><BR></TD>
<TD width="4%" rowSpan=2><IMG height=40 src="img/gray_ver.gif" 
width=8></TD>
<TD align=middle width="38%"><IMG height=16 
src="img/gray_pass.gif" width=64></TD></TR>
<TR>
<TD align=middle><IMG height=11 src="img/com_arrow.gif" 
width=11></TD>
<TD class=body>비밀번호를 입력해 주세요.</TD>
<TD align=middle><INPUT type=password maxLength=8 size=12 name="passwd" onKeypress="if(event.keyCode==13){passChkSubmit();}"> </TD></TR></TBODY>
</form>
</TABLE></td>
              </tr>
              <tr>
                <td bgcolor="E8E8E8" align="center" height="40" width="377">
<TABLE cellSpacing=0 cellPadding=0 border=0>
<TBODY>
<TR>
<TD><p align="center"><IMG height=30 width=60 src="img/gray_ok.gif" border=0 onClick="passChkSubmit();" style="cursor:hand"></TD>
<TD><p align="center"><IMG height=30 width=60 src="img/gray_cancel.gif" border=0 onClick="self.close();" style="cursor:hand"></TD>
</TR></TBODY></TABLE>                </td>
              </tr>
            </table>

          </td>
        </tr>
                <td>&nbsp;    </td>
  </tr>
</table>
    </td>
    </tr>
</table>
</body>
<iframe name="ifmPassChk" id="ifmPassChk" height="0"></iframe>
</html>
