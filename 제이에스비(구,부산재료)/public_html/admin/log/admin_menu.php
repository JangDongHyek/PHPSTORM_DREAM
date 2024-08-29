<?
####################################################################################
//					?
####################################################################################
if($mode==1){$bgcolor0="bgcolor=#e7e7e7";$b0="<b>";}
if($mode==2){$bgcolor1="bgcolor=#e7e7e7";$b1="<b>";}
if($mode==3){$bgcolor2="bgcolor=#e7e7e7";$b2="<b>";}
if($mode==4){$bgcolor3="bgcolor=#e7e7e7";$b3="<b>";}
if($mode==5){$bgcolor4="bgcolor=#e7e7e7";$b4="<b>";}
if($mode==6){$bgcolor5="bgcolor=#e7e7e7";$b5="<b>";}
if($mode==7){$bgcolor6="bgcolor=#e7e7e7";$b6="<b>";}
if($mode==8){$bgcolor7="bgcolor=#e7e7e7";$b7="<b>";}
if($mode==9){$bgcolor8="bgcolor=#e7e7e7";$b8="<b>";}
if($mode==10){$bgcolor10="bgcolor=#e7e7e7";$b10="<b>";}
?>

<table align=center width=100% cellpadding=2 cellspacing=0 border=1 bordercolor=white bgcolor=#f8f8f8>
<tr>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_time]){?> <td width=9% align=center <?=$bgcolor0?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=1"><?=$b0?><?=$lang[counter_main_menu_hour]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_day]){?> <td width=9% align=center <?=$bgcolor1?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=2"><?=$b1?><?=$lang[counter_main_menu_day]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_week]){?> <td width=9% align=center <?=$bgcolor2?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=3"><?=$b2?><?=$lang[counter_main_menu_week]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_month]){?> <td width=9% align=center <?=$bgcolor3?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=4"><?=$b3?><?=$lang[counter_main_menu_month]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_year]){?> <td width=9% align=center <?=$bgcolor4?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=5"><?=$b4?><?=$lang[counter_main_menu_year]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_log]){?> <td width=9% align=center <?=$bgcolor5?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=6"><?=$b5?><?=$lang[counter_main_menu_refer]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_dlog]){?> <td width=10% align=center <?=$bgcolor6?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=7"><?=$b6?><?=$lang[counter_main_menu_refer_detail]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_os]){?> <td width=9% align=center <?=$bgcolor7?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=8"><?=$b7?><?=$lang[counter_main_menu_os]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin] || !$set[auth_member]){?> <td width=9% align=center <?=$bgcolor8?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=9"><?=$b8?><?=$lang[counter_main_menu_visitor]?></a>&nbsp;</td><?}?>
<?if($HTTP_COOKIE_VARS[nalog_admin]){?> <td width=9% align=center <?=$bgcolor10?> nowrap>&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&mode=10"><?=$b10?><?=$lang[counter_main_menu_config]?></a>&nbsp;</td><?}?>
</tr>
</table>

<?
$handle=@opendir("plug_in");
while ($dir = @readdir($handle))
{
if($dir=="." || $dir==".."){continue;}
unset($plugin);
@include"plug_in/$dir/info.php";
if($plugin[language]==$language){$number++;}
}

if($number){
$handle=@opendir("plug_in");
?>

<table align=center width=100% cellpadding=2 cellspacing=0 border=1 bordercolor=white bgcolor=white>
<tr>
<form name=plugins action="admin_counter.php">
<input type=hidden name=counter value="<?=$counter?>">
<td width=1% nowrap>
<select name=id onchange=plugins.submit()>
<option value=''><?=$lang[counter_main_plug_in]?></option>
<option value=''></option>
<?
while ($dir = @readdir($handle))
{
if($dir=="." || $dir==".."){continue;}
unset($plugin);
@include"plug_in/$dir/info.php";
if($plugin[language]!=$language){continue;}
if(!trim($plugin[name])){continue;}
else{$dir="plug_in/$dir";}

if($id==$plugin[id]){$sel="selected";}
else{unset($sel);}

echo"<option value=\"$plugin[id]\" $sel>$plugin[name]</option>";
}
?>
</select> <?if($id){?><font size=1>&#9654;</font><?}?>
</td>
<td align=right width=99%>
<?
$plugin=$plugin_temp;
if($id){@include"plug_in/$plugin[dir]/menu.php";}
?>
</td>
</form>
</tr>
</table>

<?
}
?>