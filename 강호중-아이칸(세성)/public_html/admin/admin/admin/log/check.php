<?
####################################################################################
//					�غ�
####################################################################################
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
if(!@include "nalog_language.php"){nalog_go("install.php");}
if(!@include"language/$language/language.php"){echo"<script>window.close</script>";}
echo $lang[head];

$version2=@file("http://navyism.com/version/version.php");
$version2=trim($version2[1]);
?>

<script language=javascript>
function update(){
window.open("http://navyism.com");
window.close();
}
</script>

<table width=100% height=100%>
<tr><td valign=middle>
	<table align=center width=350 cellpadding=2 cellspacing=0 border=0 bgcolor=#C9CACB>
	<form name=install method=post action=install_ing.php onsubmit="return chk()">
	<tr><td colspan=2 bgcolor=white><img src=nalog_image/logo_small.gif></td></tr>
	<tr><td colspan=2 bgcolor=white>
		<table width=100% cellpadding=5 cellspacing=0>
		<tr>
		<td><font color=#008CD6 size=4><b>&nbsp;<?=$lang[version_check_title]?></b></font></td>
		<td align=right><?=$help?></td>
		</tr>
		</table>
	</td></tr>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td colspan=2 bgcolor=#E3F1FF align=center><?=$lang[version_check_this_version]?><b><?=$nalog_info[version]?></b> / <?=$lang[version_check_latest_version]?><b><?=$version2?></b></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td></td><td align=center><input type=button value="<?=$lang[version_check_update_button]?>" class=button onclick=update()> <input type=button value="<?=$lang[version_check_close_button]?>" class=button onclick=window.close()></td></tr>
	<tr><td colspan=2 height=8></td></tr>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td colspan=2 bgcolor=white align=right><?=$lang[copy]?></td></tr>
	</table>
</td></tr>
</table>
</body>
</html>
<?
####################################################################################
//					��
####################################################################################
mysql_close($connect);
?>