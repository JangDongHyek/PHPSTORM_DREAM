<?
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
if(!@include "nalog_language.php"){nalog_go("install.php");}
if(!@include"language/$language/language.php"){echo"<script>window.close</script>";}
echo $lang[head];
?>

<body>
<br><br>
<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
<tr><td clospan=2><a href=http://navyism.com target=_blank><img src=nalog_image/logo.gif border=0></a></td></tr>
<tr><td clospan=2><font size=5>&nbsp;<b><?=$lang[check_ip_title]?><?=$ip?></b></font></td></tr>
<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
</table>
<br>
<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
<tr><td colspan=2>
<a href=http://www.apnic.net/apnic-bin/whois.pl?searchtext=<?=$ip?>><font size=4><b>CLICK HERE</b></font></a><br>
<br>

<?
$info=@file_get_contents("http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip");

if(!$info){echo"<meta http-equiv='refresh' content='2;url=http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip'>";
echo"<br><center>$lang[check_ip_false_msg]</center><br>";
}

$info=strip_tags($info);
$info=eregi_replace("^.+% \[","% [",$info);
$info=eregi_replace("search for.+$","",$info);
$info=nl2br(trim($info));
echo $info;
?>
<br><br>
powered by &copy;1999-2003 APNIC Pty. Ltd. <a href=http://www.apnic.net target=_blank><b>www.apnic.net</b></a><br><br>
</td></tr>
<tr><td colspan=2 height=1 bgcolor=#B2B3B5></td></tr>
</table>

<table width=600 cellpadding=0 cellspacing=0 border=0 align=center>
<tr><td><?=$lang[copy]?></td>
<td align=right><?=$lang[check_ip_right_arrow]?> <a href=http://navyism.com target=_blank><?=$lang[check_ip_support]?></a> <?=$lang[check_ip_right_arrow]?> <a href=javascript:window.close()><?=$lang[check_ip_close]?></a></td></tr>
</table>
<br><br>
</body>
</html>
<?@mysql_close($connect);?>