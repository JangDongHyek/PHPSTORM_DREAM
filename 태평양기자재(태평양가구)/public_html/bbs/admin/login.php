<?
	$site_path = '../';
 	if(!isset($url)) $url='admin/';
?>
<? include("admin.header.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50">&nbsp;</td>
  </tr>
</table>
<form name=form_login method=post action='<?=$site_path?>mb_login.php' autocomplete=off>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="bottom"><img src="images/admin_t.gif" width="381" height="64" /></td>
        <td align="right" valign="bottom"><img src="images/w_text.gif" width="346" height="24" /></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="F3F3F3">&nbsp;</td>
    <td width="800" height="160" align="center" bgcolor="0E84C2"><table width="80%" border="0" cellspacing="0" cellpadding="0">
       <input type=hidden name=act value='ok'>
    <input type=hidden name=url value='<?=$url?>'>
	  
	  <tr>
        <td width="61%" align="right"><table width="256" border="0" cellpadding="0" cellspacing="0" >
            <input type=hidden name=act value='ok'>
            <input type=hidden name=url value='<?=$url?>'>
            <tr>
              <td width="113" height=30 align="right"><img src="images/id.gif" width="61" height="19"></td>
              <td width="193">&nbsp;
                  <input name='mb_id' type=text  itemname='아이디' style="width:150; height:20" ></td>
            </tr>
            <tr>
              <td height=30 align="right"><img src="images/ps.gif" width="61" height="19"></td>
              <td>&nbsp;
                  <input name='mb_password' type=password itemname='암호' style="width:150; height:20"></td>
            </tr>
        </table></td>
        <td width="39%"><input name="image" type=image src="images/btn_login.gif"  >        </td>
      </tr>
    </table></td>
    <td bgcolor="F3F3F3">&nbsp;</td>
  </tr>
</table>
</form>

<script language='Javascript'>
    var f = document.form_login;

    f.mb_id.focus();
</script>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="800"><a href="http://lets080.com" target="_blank"><img src="images/copy.gif" width="501" height="49" border="0"></a></td>
    <td>&nbsp;</td>
  </tr>
</table>
