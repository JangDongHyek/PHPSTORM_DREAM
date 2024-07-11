<?
include "../lib/Mall_Admin_Session.php";
?>
<?
####################################################################################
//					헤더
####################################################################################
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

####################################################################################
//					준비
####################################################################################
if($set_language){setcookie("nalog_my_language",$set_language,0,"/");$language=$set_language;}
elseif($HTTP_COOKIE_VARS[nalog_my_language]){$language=$HTTP_COOKIE_VARS[nalog_my_language];}
if(!@include"nalog_connect.php"){
	echo"<script lanugage=javascript>alert('Please install first :)')</script>
	<meta http-equiv='refresh' content='0;url=install.php'>";
	exit;
}
include "lib.php";
if(!$language){include "nalog_language.php";}
if(!@include"language/$language/language.php"){nalog_go("install.php");}
echo $lang[head];

####################################################################################
//					체크
####################################################################################
$is_admin=nalog_admin_check4();
$set=nalog_config("$counter");

if($set[time_zone2]){
	if($set[time_zone1]){$time_zone=$set[time_zone2]*3600;}
	else{$time_zone=$set[time_zone2]*3600*(-1);}
}else{
$time_zone=0;
}

####################################################################################
//					갯수제한
####################################################################################
if($set[counter_limit])
{
$limit=nalog_total("nalog3_counter_".$counter,"");
$limit=$limit-$set[counter_limit];
	if($limit>0)	
	{
	$query="select no from nalog3_counter_$counter order by no limit 1";
	$min=mysql_fetch_array(mysql_query($query,$connect));
	$min=$min[no];

	$query="select no from nalog3_counter_$counter order by no limit $limit,1";
	$max=mysql_fetch_array(mysql_query($query,$connect));
	$max=$max[no]-1;

	$query="delete from nalog3_counter_$counter where no between $min and $max";
	@mysql_query($query,$connect);
	}
}

if($set[log_limit])
{
$limit2=nalog_total("nalog3_log_".$counter,"");
$limit2=$limit2-$set[log_limit];
	if($limit2>0)
	{
	$query="select time from nalog3_log_$counter where bookmark='0' order by time limit 1";
	$min=mysql_fetch_array(mysql_query($query,$connect));
	$min=$min[time];

	$query="select time from nalog3_log_$counter where bookmark='0' order by time limit $limit2,1";
	$max=mysql_fetch_array(mysql_query($query,$connect));
	$max=$ax[time]-1;

	$query="delete from nalog3_log_$counter where time between $min and $max";
	@mysql_query($query,$connect);
	}
}

if($set[log_limit])
{
$limit3=nalog_total("nalog3_dlog_".$counter,"");
$limit3=$limit3-$set[log_limit];
	if($limit3>0)
	{
	$query="select time from nalog3_dlog_$counter where bookmark='0' order by time limit 1";
	$min=mysql_fetch_array(mysql_query($query,$connect));
	$min=$min[time];

	$query="select time from nalog3_dlog_$counter where bookmark='0' order by time limit $limit3,1";
	$max=mysql_fetch_array(mysql_query($query,$connect));
	$max=$max[time]-1;

	$query="delete from nalog3_dlog_$counter where time between $min and $max";
	@mysql_query($query,$connect);
	}
}

####################################################################################
//					권한검사
####################################################################################
if($mode==1 && $set[auth_time]){$admin=1;}
if($mode==2 && $set[auth_day]){$admin=1;}
if($mode==3 && $set[auth_week]){$admin=1;}
if($mode==4 && $set[auth_month]){$admin=1;}
if($mode==5 && $set[auth_year]){$admin=1;}
if($mode==6 && $set[auth_log]){$admin=1;}
if($mode==7 && $set[auth_dlog]){$admin=1;}
if($mode==8 && $set[auth_os]){$admin=1;}
if($mode==9 && $set[auth_member]){$admin=1;}
if($mode==10){$admin=1;}

//if($admin){nalog_admin_check("login.php?go=print.php?counter=$counter");}
if(!$set){nalog_error($lang[counter_main_not_exist]);}

if($mode==0){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a>";}
if($mode==1){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_hour]";}
if($mode==2){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_day]";}
if($mode==3){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_week]";}
if($mode==4){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_month]";}
if($mode==5){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_year]";}
if($mode==6){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_refer]";}
if($mode==7){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_refer_detail]";}
if($mode==8){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_os]";}
if($mode==9){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_visitor]";}
if($mode==10){$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $lang[counter_main_title_config] : $counter";}

$handle=@opendir("plug_in");
if($handle && $id){
	while ($dir = @readdir($handle))
	{
	if($dir=="." || $dir==".."){continue;}
	@include"plug_in/$dir/info.php";
	if(!trim($plugin[name])){continue;}
	
		if($id==$plugin[id] && $language==$plugin[language])
		{
		$title="<a href=print.php?counter=$counter>$lang[counter_main_title]</a> > $plugin[name]";
		$plugin[dir]=$dir;
		$found=1;
		break;
		}
	}
}

if(!$found){unset($id);}
$plugin_temp=$plugin;
?>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>방문통계</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>
<!----------------------------------- 내용 시작 ----------------------------------------->

				<table width="720" border="0" cellspacing="0" cellpadding="0">
					<tr><td valign=top>
					<table align=center width=98% cellpadding=2 cellspacing=0 border=0 bgcolor=#C9CACB>

					<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
					<tr><td colspan=2><?include"print_menu.php"?></td></tr>
					<tr><td colspan=2>
					<?
					$plugin=$plugin_temp;
					if(!$id){@include"admin_main.php";}
					else{@include"plug_in/$plugin[dir]/main.php";}
					?>
					</td></tr>
					<tr><td colspan=2 height=5></td></tr>
					<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>

					<script language=javascript>
					function move_page(){language.submit();}
					</script>

					<form method=post name=language>
					<tr bgcolor=white><td nowrap><font size=1><?=date($lang[counter_main_date_format1],time()+$time_zone)?> : <?=number_format($set[total])?> Visitors : Counter <b><?=$counter?></b></font>
					<br><select name=set_language onchange=move_page()>
					<?
					$handle=@opendir("language");
					if(!$handle){nalog_msg("couldn`t find language pack directory `lanugage`\\nAll processing will stop");exit;}
					$i=0;
					while ($dir = @readdir($handle))
					{
					if($dir=="." || $dir==".."){continue;}
					@include"language/$dir/language.php";
					($dir==$language)?$sel="selected":$sel="";
					if($lang[english_name]){echo"<option value=\"$dir\" $sel>$lang[english_name]</option>\n";$i++;}
					}
					if(!$i){nalog_msg("couldn`t find language pack directory\\nAll processing will stop");}
					include "language/$language/language.php";
					?>
					</select> <input type=submit class=button value="<?=$lang[root_change_language_button]?>"></td>
					<td align=right valign=top nowrap><?=$lang[copy]?></td></tr>
					</form>
					</table>
				</td></tr>
				</table>
				<br><br><br>
<!----------------------------------- 내용 끝 ------------------------------------------->
<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>
<script>
	window.print();
</script>