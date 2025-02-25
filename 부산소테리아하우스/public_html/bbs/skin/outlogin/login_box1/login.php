<link href="<?=$skin_lastest_url?>style.css" rel="stylesheet" type="text/css">
<table width="143" border="0" cellspacing="0" cellpadding="0">
<form name=form_outlogin action="<?=$login_url?>" method="post">
<input type=hidden name=act value='ok'>
<input type=hidden name=url value='<?=$url?>'>
<table width="143" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><table width="143" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="53"><img src="<?=$skin_lastest_url?>images/login_13.jpg" width="53" height="23"></td>
          <td><input name=mb_id type="text" class="input" size="12" itemname='아이디' required></td>
        </tr>
        <tr>
          <td><img src="<?=$skin_lastest_url?>images/login_16.jpg" width="53" height="25"></td>
          <td><input name="mb_password" type="password" class="input" size="12"  itemname='암호' required></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><img src="<?=$skin_lastest_url?>images/login_17.jpg" width="143" height="5"></td>
  </tr>
  <tr>
    <td><table width="143" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="42"><input type="image" src="<?=$skin_lastest_url?>images/login_18.jpg" width="42" height="42"></td>
          <td width="14"><img src="<?=$skin_lastest_url?>images/login_19.jpg" width="14" height="42"></td>
          <td><table width="87" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="<?=$member_join_url?>" class="login"><img src="<?=$skin_lastest_url?>images/login_20.jpg" width="87" height="20"></a></td>
              </tr>
              <tr>
                <td><a href="<?=$password_url?>" class="login"><img src="<?=$skin_lastest_url?>images/login_21.jpg" width="87" height="22"></a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
 </form>
</table>