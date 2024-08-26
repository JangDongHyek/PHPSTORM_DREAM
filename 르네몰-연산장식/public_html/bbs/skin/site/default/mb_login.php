<style type="text/css">
<!--
.input {
	font-family: "verdana", "Helvetica", "sans-serif", "돋움";
	font-size: 9pt;
	color: #333333;
	text-decoration: none;
	line-height: 14pt;
	background-color: #ffffff;
	border: solid 1px #cccccc;
	height: 18px;
}
-->
</style>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<form name=mblogin method=post action='<?=$login_url?>' autocomplete=off>
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
                      <td height="35"><img src="<?=$skin_site_url?>images/login.gif" width="255" height="25"></td>
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
                                        <td><input name='mb_id' type="text" id="id" size="16" maxlength=20 minlength=2 required itemname='아이디' class=input></td>
                                      </tr>
                                      <tr> 
                                        <td><img src="<?=$skin_site_url?>images/txt_02.gif" width="44" height="17"></td>
                                        <td><input name="mb_password" type="password" id="pw" size="16" maxlength=20 required itemname='암호' class=input></td>
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
                                  <td align="center"><input type="image" src="<?=$skin_site_url?>images/btn_login.gif" width="61" height="24"> 
                                    <img src="<?=$skin_site_url?>images/btn_cancel.gif" width="61" height="24" onClick="mblogin.reset();mblogin.mb_id.focus();" style="cursor:hand;"></td>
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
</body>
</html>
