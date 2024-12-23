<?
####################################################################################
//					ÁØºñ
####################################################################################
include"lib.php";
if(!$step){?>
<?include"header.inc";?>
<table align=center border=0 width=100% height=100%><tr><td align=center valign=middle>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0" width="300" height="200">
<param name="movie" value="nalog_image/logo.swf">
<param name="play" value="true">
<param name="loop" value="false">
<param name="quality" value="high">
<embed src="nalog_image/logo.swf" play="true" loop="true" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="300" height="200"></embed>
</object>
</td></tr></table>
</body>
</html>
<?}if($step==1){?>
<?include"header.inc";?>
<table align=center border=0 width=100% height=100%>
<tr><td align=center valign=middle><a href=install.php?step=2&mode=<?=$mode?> onfocus=this.blur()><img src=nalog_image/logo.gif border=0 alt="Click here to install"></a><br><br><img src=nalog_image/powered.gif alt="powered by"></td></tr>
</table>
<?}if($step==2){?>
<?include"header.inc";?>
<script language=javascript>
function chk(){
if(!install.language.value){alert('error :\n\nselect language');return false;}
}
</script>
<br><br>
<table align=center width=500 cellpadding=2 cellspacing=0 border=0 bgcolor=#C9CACB>
<form name=install method=post action=install.php onsubmit="return chk()">
<input type=hidden name=step value=3>
<input type=hidden name=mode value=<?=$mode?>>
<tr><td colspan=2 bgcolor=white><a href=http://navyism.com target=_blank><img src=nalog_image/logo_small.gif border=0></a></td></tr>
<tr><td colspan=2 bgcolor=white>
	<table width=100% cellpadding=0 cellspacing=0>
	<tr>
	<td><font color=#008CD6 size=4><b>&nbsp;Language Selection</b></font></td>
	<td align=right><?=$help?></td>
	</tr>
	</table>
</td></tr>
<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
<tr><td colspan=2 height=8></td></tr>
<tr><td colspan=2 align=center>Please select the default language of your 5 as listed below.<br><br>
<select size=10 style="width:95%" class=input name=language>
<?
$handle=@opendir("language");
if(!$handle){nalog_msg("couldn`t find language pack directory `lanugage`\\nAll processing will stop");exit;}
$i=0;
while ($dir = @readdir($handle))
{
if($dir=="." || $dir==".."){continue;}
if(!@include"language/$dir/language.php"){nalog_msg("language/$dir/language.php have an error");continue;}
if($lang[name]){echo"<option value=\"$dir\">$lang[name]</option>\n";$i++;}
}
if(!$i){nalog_msg("couldn`t find language pack directory\\nAll processing will stop");}
?>
</select>
</td></tr>
<tr><td colspan=2 height=5></td></tr>
<tr><td colspan=2 bgcolor=#E3F1FF>
	<table width=90% cellpadding=2 cellspacing=0 align=center>
	<tr><td align=center><input type=submit value=" NEXT " class=button></td></tr>
	</table>
<tr><td colspan=2 height=8></td></tr>
<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
<tr><td colspan=2 bgcolor=white align=right><font size=1 face=tahoma>analyzer <?=$nalog_info[version]?> &copy;2001-2003 </font><a href=http://navyism.com target=_blank><font size=1><b>navyism</b></font></a></td></tr>
</table>
<?}if($step==3){?>
<?if(!@include"language/$language/language.php"){nalog_go("install.php");}?>
<?=$lang[head]?>
<?
if($mode=="upgrade"){$action="upgrader.php";}
else{$action="install_er.php";}
?>
<br><br>
	<table align=center width=500 cellpadding=2 cellspacing=0 border=0 bgcolor=#C9CACB>
	<form name=install method=post action=<?=$action?>>
	<input type=hidden name=language value="<?=$language?>">
	<tr><td colspan=2 bgcolor=white><a href=http://navyism.com target=_blank><img src=nalog_image/logo_small.gif border=0></a></td></tr>
	<tr><td colspan=2 bgcolor=white>
		<table width=100% cellpadding=0 cellspacing=0>
		<tr>
		<td><font color=#008CD6 size=4><b>&nbsp;<?=$lang[install_license_title]?></b></font></td>
		<td align=right><?=$help?></td>
		</tr>
		</table>
	</td></tr>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td colspan=2 height=8></td></tr>
	<tr><td colspan=2 align=center><?=$lang[install_license_agreement]?><br><br>
	<textarea style="width:95%" cols=92 rows="<?=$lang[install_license_textarea_rows]?>" class=input readonly><?=$lang[install_license_text]?></textarea></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td colspan=2 bgcolor=#E3F1FF>
		<table width=90% cellpadding=2 cellspacing=0 align=center>
		<tr><td><?=$lang[install_license_ask]?></td></tr>
		<tr><td align=center><input type=submit value="<?=$lang[install_license_agree]?>" class=button> <input type=button class=button value="<?=$lang[install_license_decline]?>" onclick=location.href="http://navyism.com"></td></tr>
		</table>
	<tr><td colspan=2 height=8></td></tr>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td colspan=2 bgcolor=white align=right><?=$lang[copy]?></td></tr>
	</table>
<?}?>
</body>
</html>