<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>중복아이디 검색</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_site_url?>style.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0" leftmargin="0">
<table width="332" align="center" cellspacing="0" style="border-collapse:collapse;">
  <tr> 
    <td width="326" height="28" align="center"> 
    <p><img src="images/id_head.gif" width="332" height="75"></p></td>
  </tr>
</table>
<table width="331" align="center" cellspacing="0" style="border-collapse:collapse;">
  <form name="mb_form" method="post" enctype="multipart/form-data">
    <input name="frm_name" type="hidden" value="<?=$frm_name?>">
    <input name="frm_id" type="hidden" value="<?=$frm_id?>">
    <tr> 
      <td width="327" height="30" align="center" colspan="3" bgcolor="#FFFFFF" > 
        <p style="line-height:120%;"><b><span style="font-size:11px;letter-spacing:-1px;" >
<?=$exist_id_begin?>이미 등록된 아이디입니다.<?=$exist_id_end?>
<?=$use_id_begin?>사용 가능한 아이디입니다.<?=$use_id_end?>
<?=$no_id_input_begin?>아이디를 입력해주세요.<?=$no_id_input_end?>
				<br>
      </span></b></p></td>
    </tr>
    <tr> 
      <td width="105" height="38" align="right" bgcolor="#FFFFFF"> 
      <p><span style="font-size:9pt;">아이디 &nbsp;</span></p></td>
      <td width="128" height="38" bgcolor="#FFFFFF"> <input name="id" type="text" id="id" style="border-width:2; border-color:6096B9; border-style:solid;" size="16" value="<?=$id?>">      </td>
      <td width="90" height="38" bgcolor="#FFFFFF"> 
        <?=$use_id_begin?>
      <input name="Button" type="image" src="images/zip_use.gif" value=" 사용 " onClick="use()"><?=$use_id_end?></td>
    </tr>
    <tr> 
      <td width="327" height="45" align="center" colspan="3" bgcolor="#ffffff"> 
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
		opener.<?=$frm_name?>.<?=$frm_id?>.value='<?=$id?>';
		self.close();
	}
</script>