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
  <tr>
    <td>&nbsp;</td>
    <td width="720" align="center"><table width="98%" border="0" cellpadding="20" cellspacing="20" bgcolor="#F3F3F3">
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <form name=mblogin method=post action='<?=$login_url?>' autocomplete=off>
            <input type=hidden name=act value='ok' />
            <input type=hidden name=url value='<?=$url?>' />
            <tr>
              <td><img src="<?=$skin_site_url?>images/admin_t.gif" /></td>
            </tr>
            <tr>
              <td height="112" align="center" bgcolor="#fbf7e8"><table width="50%" height="32" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                    <tr>
                      <td style="font-weight:bold">User ID</td>
                      <td><input name='mb_id' type="text" id="id" size="25" maxlength="20" minlength="2" required="required" itemname='아이디' class="input" /></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Password</td>
                      <td><input name="mb_password" type="password" id="pw" size="25" maxlength="20" required="required" itemname='암호' class="input" /></td>
                    </tr>
                  </table></td>
                  <td><input name="image" type="image" src="<?=$skin_site_url?>images/btn_login.gif"  /></td>
                </tr>
              </table></td>
            </tr>

          </form>
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
