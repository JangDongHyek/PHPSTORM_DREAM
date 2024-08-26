<?
	$site_path = '../';
 	if(!isset($url)) $url='admin/';
?>
<? include("admin.header.php"); ?>
<form name=form_login method=post action='<?=$site_path?>mb_login.php' autocomplete=off>
  <table align="center" cellpadding="0" cellspacing="0" width="500">
    <input type=hidden name=act2 value='ok'>
    <input type=hidden name=url2 value='<?=$url?>'>
    <tr> 
      <td width="500"><p><img src="images/intro.gif" width="500" height="60" border="0"></p></td>
    </tr>
  </table>
  <br>
  <table align="center" border="1" cellpadding="0" cellspacing="0" width="400" bordercolordark="white" bordercolorlight="#E1E1E1">
    <input type=hidden name=act value='ok'>
    <input type=hidden name=url value='<?=$url?>'>
    <tr> 
      <td width="130" height=30 align="right" bgcolor="#F7F7F7"><span class=subject>관리자 아이디&nbsp;:&nbsp;</span></td>
      <td width="264"><input type=text name='mb_id' size=20 maxlength=20 minlength=2 required itemname='아이디' class=input></td>
    </tr>
    <tr> 
      <td height=30 align="right" bgcolor="#F7F7F7"><span class=subject>관리자 암호&nbsp;:&nbsp;</span></td>
      <td><input type=password name='mb_password' size=20 maxlength=20 required itemname='암호' class=input></td>
    </tr>
  </table>
  <table align="center" border="1" cellpadding="10" cellspacing="0" width="400" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr> 
      <td width="286"> <p align="left"><span style="font-size: 9pt">부당한 방법으로 접속시 
          불이익을 받을수 있사오니 <br>
          주의하시기 바랍니다.</span></p></td>
    </tr>
  </table>
  <p>
<div align=center>
<input type=submit value='   확   인   ' class=button1>
    &nbsp; 
    <input type=button value=' 뒤 로 ' onclick='history.go(-1);' class=button1>
</div>
</form>

<script language='Javascript'>
    var f = document.form_login;

    f.mb_id.focus();
</script>

<? include("admin.footer.php"); ?>