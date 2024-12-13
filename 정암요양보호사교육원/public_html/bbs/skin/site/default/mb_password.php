<style type="text/css">
<!--
input {
	border: solid 1px #cccccc;
}
-->
</style>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<form name=mblogin method=post action='' autocomplete=off>
<input type=hidden name=act value='ok'>
<input type=hidden name=url value='<?=$url?>'>
  <tr>
    <td><table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="<?=$skin_site_url?>images/bar01_01.gif" width="380" height="10"></td>
              </tr>
              <tr> 
                <td background="<?=$skin_site_url?>images/bar01_02.gif"><table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td height="35"><img src="<?=$skin_site_url?>images/pw.gif" width="318" height="25"></td>
                    </tr>
                    <tr> 
                      <td><table width="360" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td><img src="<?=$skin_site_url?>images/bg02_01.gif" width="360" height="10"></td>
                          </tr>
                          <tr> 
                            <td height="120" background="<?=$skin_site_url?>images/bg02_02.gif"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><table border="0" align="center" cellpadding="2" cellspacing="0">
                                      <tr> 
                                        <td><img src="<?=$skin_site_url?>images/txt_01.gif" width="44" height="17"></td>
                                        <td><input name="mb_id" type="text" id="id" size="16" required itemname='아이디'></td>
                                      </tr>
                                      <tr> 
                                        <td><img src="<?=$skin_site_url?>images/txt_03.gif" width="44" height="17"></td>
                                        <td><input name="mb_email" type="text" id="pw" size="16" required="required" itemname="이메일" email="email"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td height="10"></td>
                                </tr>
                                <tr> 
                                  <td height="1" bgcolor="dddddd"></td>
                                </tr>
                                <tr> 
                                  <td height="1" bgcolor="#FFFFFF"></td>
                                </tr>
                                <tr> 
                                  <td height="10"></td>
                                </tr>
                                <tr> 
                                  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td><input type="image" src="<?=$skin_site_url?>images/btn_submit.gif" width="61" height="24"></td>
                                        <td width="5">&nbsp;</td>
                                        <td><img src="<?=$skin_site_url?>images/btn_cancel.gif" width="61" height="24" onClick="mblogin.reset();mblogin.mb_id.focus();" style="cursor:hand;"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td><img src="<?=$skin_site_url?>images/bg02_03.gif" width="360" height="10"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td><img src="<?=$skin_site_url?>images/bar01_03.gif" width="380" height="10"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="2"></td>
        </tr>
        <tr> 
          <td><img src="<?=$skin_site_url?>images/bar.gif" width="380" height="30"></td>
        </tr>
      </table></td>
  </tr>
</form>
</table>

<script language='Javascript'>
    var f = document.mblogin;

    f.mb_id.focus();
</script>
