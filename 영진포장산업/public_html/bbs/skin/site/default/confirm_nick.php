<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>중복닉네임 검색</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>

<body>
<table width="332" align="center" cellspacing="0" style="border-collapse:collapse;">
  <tr> 
    <td width="326" height="28" align="center" bgcolor="#D5F0BB" style="border-width:2; border-color:green; border-style:solid;"> 
      <p><b><span style="font-size:9pt;">중복닉네임 검색</span></b></p></td>
  </tr>
</table>
<table width="331" align="center" cellspacing="0" style="border-collapse:collapse;">
  <form name="mb_form" method="post" enctype="multipart/form-data">
    <input name="frm_name" type="hidden" value="<?=$frm_name?>">
    <input name="frm_id" type="hidden" value="<?=$frm_id?>">
    <tr> 
      <td width="327" height="54" align="center" colspan="3" bgcolor="#F4F7F2" style="border-top-width:1; border-right-width:1; border-left-width:1; border-top-color:rgb(102,102,102); border-right-color:rgb(102,102,102); border-left-color:rgb(102,102,102); border-top-style:solid; border-right-style:solid; border-left-style:solid;"> 
        <p style="line-height:120%;"><b><span style="font-size:10pt;">
<?=$exist_nick_begin?>이미 등록된 닉네임입니다.<?=$exist_nick_end?>
<?=$use_nick_begin?>사용 가능한 닉네임입니다.<?=$use_nick_end?>
<?=$no_nick_input_begin?>닉네임을 입력해주세요.<?=$no_nick_input_end?>
				<br>
          </span></b></p></td>
    </tr>
    <tr> 
      <td width="105" height="38" align="right" bgcolor="#F4F7F2" style="border-left-width:1; border-left-color:rgb(102,102,102); border-left-style:solid;"> 
        <p><span style="font-size:9pt;">닉네임 &nbsp;</span></p></td>
      <td width="128" height="38" bgcolor="#F4F7F2"> <input name="nick" type="text" id="nick" style="border-width:2; border-color:green; border-style:solid;" size="16" value="<?=$nick?>"> 
      </td>
      <td width="90" height="38" bgcolor="#F4F7F2" style="border-right-width:1; border-right-color:rgb(102,102,102); border-right-style:solid;"> 
        <?=$use_nick_begin?><input name="Button" type="button" value=" 사용 " onClick="use()"><?=$use_nick_end?></td>
    </tr>
    <tr> 
      <td width="327" height="45" align="center" colspan="3" bgcolor="#F4F7F2" style="border-right-width:1; border-bottom-width:1; border-left-width:1; border-right-color:rgb(102,102,102); border-bottom-color:rgb(102,102,102); border-left-color:rgb(102,102,102); border-right-style:solid; border-bottom-style:solid; border-left-style:solid;"> 
        <p><b><span style="font-size:10pt;"> 
          <input type="submit" value=" 검색 ">
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