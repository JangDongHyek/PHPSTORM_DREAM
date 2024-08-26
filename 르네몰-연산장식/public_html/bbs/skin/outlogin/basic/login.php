<link href="<?=$skin_lastest_url?>style.css" rel="stylesheet" type="text/css">
<table width="191" height="152" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<form name=form_outlogin action="<?=$login_url?>" method="post">
<input type=hidden name=act value='ok'>
<input type=hidden name=url value='<?=$url?>'>
  <tr> 
    <td height="36" colspan="3"><img src="<?=$skin_lastest_url?>images/login_1.gif" width="191" height="36"></td>
  </tr>
  <tr> 
    <td width="1" rowspan="3" bgcolor="DEDEDE"><img src="<?=$skin_lastest_url?>images/spacer.gif"></td>
    <td width="189" height="54" align="center" valign="middle"> 
      <table width="156" height="38" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="50" align="left"><img src="<?=$skin_lastest_url?>images/login_2.gif" width="37" height="10"></td>
          <td><input name=mb_id type="text" class="input" size="12" itemname='아이디' required></td>
        </tr>
        <tr> 
          <td width="50" align="left"><img src="<?=$skin_lastest_url?>images/login_3.gif" width="48" height="10"></td>
          <td><input name="mb_password" type="password" class="input" size="12"  itemname='암호' required></td>
        </tr>
      </table>
    </td>
    <td width="1" rowspan="3" bgcolor="DEDEDE"><img src="<?=$skin_lastest_url?>images/spacer.gif"></td>
  </tr>
  <tr> 
    <td height="11" align="center"><a href="<?=$password_url?>" class="login"><img src="<?=$skin_lastest_url?>images/login_4.gif" width="103" height="11" border="0"></a></td>
  </tr>
  <tr> 
    <td height="39" align="center" valign="bottom"> 
      <table width="162" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="79"><input type="image" src="<?=$skin_lastest_url?>images/login_5.gif" width="79" height="27"></td>
          <td align="right"><a href="<?=$member_join_url?>" class="login"><img src="<?=$skin_lastest_url?>images/login_6.gif" width="79" height="27" border="0"></a></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td height="12" colspan="3"><img src="<?=$skin_lastest_url?>images/login_7.gif" width="191" height="12"></td>
  </tr>
</table>