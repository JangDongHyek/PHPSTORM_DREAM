<?
####################################################################################
//					ÁØºñ
####################################################################################
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
if(!@include "nalog_language.php"){nalog_go("install.php");}
if(!@include"language/$language/language.php"){echo"<script>window.close</script>";}
echo $lang[head];

nalog_admin_check2();
?>

<script language=javascript>
function on(){document.install.admin_passx.focus();}
function chk(){
if(!document.install.admin_idx.value){alert('error : \n\n<?=$lang[change_admin_error_admin_id]?>');document.install.admin_idx.focus();return false;}
if(!document.install.admin_passx.value){alert('error : \n\n<?=$lang[change_admin_error_admin_pass]?>');document.install.admin_passx.focus();return false;}
if(!document.install.admin_pass2x.value){alert('error : \n\n<?=$lang[change_admin_error_admin_repass]?>');document.install.admin_pass2x.focus();return false;}
if(document.install.admin_passx.value!=document.install.admin_pass2x.value){alert('error : \n\n<?=$lang[change_admin_error_admin_match]?>');document.install.admin_pass2x.value="";document.install.admin_passx.select();return false;}
}
</script>

<body onload=on()>
<table width=100% height=100%>
<tr><td valign=middle>
	<table align=center width=350 cellpadding=2 cellspacing=0 border=0 bgcolor=#C9CACB>
	<form name=install method=post action=change_ing.php onsubmit="return chk()">
	<tr><td colspan=2 bgcolor=white><img src=nalog_image/logo_small.gif></td></tr>
	<tr><td colspan=2 bgcolor=white>
		<table width=100% cellpadding=0 cellspacing=0>
		<tr>
		<td><font color=#008CD6 size=4><b>&nbsp;<?=$lang[change_admin_title]?></b></font></td>
		<td align=right><?=$help?></td>
		</tr>
		</table>
	</td></tr>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td colspan=2 bgcolor=#E3F1FF align=center><b><?=$lang[change_admin_text]?></b></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td align=right><font color=#008CD6><?=$lang[change_admin_id]?>&nbsp;&nbsp;</td><td><input type=text class=input name=admin_idx size=15 value='<?=$admin_id?>'></td></tr>
	<tr><td align=right><font color=#008CD6><?=$lang[change_admin_pass]?>&nbsp;&nbsp;</td><td><input type=password class=input name=admin_passx size=15></td></tr>
	<tr><td align=right><font color=#008CD6><?=$lang[change_admin_repass]?>&nbsp;&nbsp;</td><td><input type=password class=input name=admin_pass2x size=15></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td></td><td><input type=submit value="<?=$lang[change_admin_change_button]?>" class=button> <input type=button value="<?=$lang[change_admin_close_button]?>" class=button onclick=window.close()></td></tr>
	<tr><td colspan=2 height=8></td></tr>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td colspan=2 bgcolor=white align=right><?=$lang[copy]?></td></tr>
	</table>
</td></tr>
</table>
</body>
</html>
<?@mysql_clode($connect)?>