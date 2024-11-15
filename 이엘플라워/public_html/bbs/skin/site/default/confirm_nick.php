<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>중복닉네임 검색</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>

<body topmargin="0" leftmargin="0">
<table width="332" align="center" cellspacing="0" style="border-collapse:collapse;">
  <tr> 
    <td width="332" height="28" align="center" valign="top" bgcolor="#FFFFFF"><img src="images/nick_head.gif" width="332" height="75"></td>
  </tr>
</table>
<table width="332" align="center" cellspacing="0" style="border-collapse:collapse;">
  <form name="mb_form" method="post" enctype="multipart/form-data">
    <input name="frm_name" type="hidden" value="<?=$frm_name?>">
    <input name="frm_id" type="hidden" value="<?=$frm_id?>">
    <tr> 
      <td width="327" height="30" align="center" colspan="3"> 
        <p style="line-height:120%;"><b><span style="font-size:11px;letter-spacing:-1px;">
<?=$exist_nick_begin?>이미 등록된 닉네임입니다.<?=$exist_nick_end?>
<?=$use_nick_begin?>사용 가능한 닉네임입니다.<?=$use_nick_end?>
<?=$no_nick_input_begin?>닉네임을 입력해주세요.<?=$no_nick_input_end?>
				<br>
      </span></b></p></td>
    </tr>
    <tr> 
      <td width="105" height="38" align="right" bgcolor="#ffffff"> 
        <p><span style="font-size:9pt;">닉네임 &nbsp;</span></p></td>
      <td width="128" height="38"> <input name="nick" type="text" id="nick" style="border-width:2; border-color:6096B9; border-style:solid;" size="16" value="<?=$nick?>">      </td>
      <td width="90" height="38"> 
        <?=$use_nick_begin?>
      <input name="Button" type="image" src="images/zip_use.gif" value=" 사용 " onClick="use()"><?=$use_nick_end?></td>
    </tr>
    <tr> 
      <td width="327" height="45" align="center" colspan="3" bgcolor="#ffffff""> 
        <p><b><span style="font-size:10pt;"> 
          <input name="submit" type="image" src="images/zip_confirm.gif" value=" 검색 ">
          </span></b></p></td>
    </tr>
  </form>
</table>
</body>
</html>
<script language="JavaScript" type="text/JavaScript">
	function use()
	{	
		opener.<?=$frm_name?>.<?=$frm_nick?>.value='<?=$nick?>';
		self.close();
	}
</script>