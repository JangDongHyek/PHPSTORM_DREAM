<?
####################################################################################
//			Getting ready
####################################################################################
set_time_limit(0);
if(!$is_admin){
nalog_error("Permission Denied");
}
?>

<?
####################################################################################
//			Plug-in main screen
####################################################################################
if(!$pmode){?>
<table width=100% border=0 cellpadding=2 cellspacing=0 align=center bgcolor=white>
<tr><td align=center>
<br><br><br><br><br>
<img src="plug_in/<?=$plugin[dir]?>/logo.gif" border=0>
<br><br><br><br><br><br>
</td></tr>
</table>
<?}?>

<?
####################################################################################
//			Menu 1: Backup
####################################################################################
if($pmode==1){?>
<?
$tables=nalog_list_bd();
$total=count($tables);

$page=10;
$pageviewsu=10;
$pagesu=ceil($total/$page);
$start=($page*$pagenum);
$no=$total-$start;
$pagegroup=ceil(($pagenum+1)/$pageviewsu);
$pagestart=($pageviewsu*($pagegroup-1))+1;
$pageend=$pagestart+$pageviewsu-1;
$nowpage=$pagenum+1;
$send="&page=$page&";
?>
		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<form method=post action="plug_in/<?=$plugin[dir]?>/dump.php">
		<tr>
		<td nowrap>Total <b><?=$total?></b> counter(s)</td>
		<td align=right>Please choose a backup method:
		<input type=radio name=how value=1 checked> download
		<input type=radio name=how value=0> save in server
		(path: <?=str_replace("admin_counter.php","*.sql",$PHP_SELF)?>)</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<input type=hidden name=counter value="<?=$counter?>">
		<input type=hidden name=id value="<?=$id?>">
		<input type=hidden name=pmode value="<?=$pmode?>">
		<tr bgcolor=#C9F0FF>
		<td width=1% nowrap align=center>No.</td>
		<td width=1% nowrap align=center>Select</td>
		<td width=92% align=center>Counter Name</td>
		<td width=1% nowrap align=center>How long have<br>been recorded</td>
		<td width=1% nowrap align=center>OS/Browser<br>recorded</td>
		<td width=1% nowrap align=center>Host(s)<br>recorded</td>
		<td width=1% nowrap align=center>URL(s)<br>recorded</td>
		<td width=1% nowrap align=center>Visitor(s)<br>recorded</td>
		<td width=1% nowrap align=center>Member(s)<br>recorded</td>
		</tr>
<?
		$j=0;
		for($i=$start;$i<$start+$page;$i++)
		{
		if(!$tables[$i]){break;}
		$board_name=$tables[$i];

		$total_data	= mysql_fetch_array(mysql_query("select count(*) from nalog3_data where counter='$board_name'"));
		$total_os	= mysql_fetch_array(mysql_query("select count(*) from nalog3_os where counter='$board_name' and os='1'"));
		$total_bw	= mysql_fetch_array(mysql_query("select count(*) from nalog3_os where counter='$board_name' and os='0'"));
		$total_log	= mysql_fetch_array(mysql_query("select count(*) from nalog3_log_$board_name"));
		$total_dlog	= mysql_fetch_array(mysql_query("select count(*) from nalog3_dlog_$board_name"));
		$total_counter	= mysql_fetch_array(mysql_query("select count(*) from nalog3_counter_$board_name"));
		$total_member	= mysql_fetch_array(mysql_query("select count(*) from nalog3_counter_$board_name where id<>''"));


		echo"
		<tr bgcolor=white>
		<td width=1% nowrap align=center>$no</td>
		<td width=1% nowrap align=center><input type=checkbox name=name[$j] value='$board_name' checked id=name[$j]></td>
		<td width=92%><b><label for=name[$j]>$board_name</label></b></td>
		<td width=1% nowrap align=right>$total_data[0] day(s)</td>
		<td width=1% nowrap align=right>$total_os[0] / $total_bw[0]</td>
		<td width=1% nowrap align=right>$total_log[0]</td>
		<td width=1% nowrap align=right>$total_dlog[0]</td>
		<td width=1% nowrap align=right>$total_counter[0]</td>
		<td width=1% nowrap align=right>$total_member[0]</td>
		</tr>
		";
		$no--;
		$j++;
		}
?>
		</table>
		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr>
		<td align=center><?nalog_index()?></td>
		</tr>
		<tr bgcolor=white>
		<td align=center><input type=submit class=button value="Backup NOW"></td>
		</tr>
		</form>
		</table>
<?}?>

<?
####################################################################################
//			Menu 2: Restore
####################################################################################
if($pmode==2){?>

		<script language=javascript>
		function chk(){
		if(!ok.filename.value){alert('Please select an .sql file from the pulldown menu to be restored.\nIf there is no .sql file existing in n@log root folder, you have to upload it first.');ok.filename.focus();return false;}
		}
		function chkup(){
		if(!up.backup.value){alert('Please specify an .sql file to be uploaded.');up.backup.click();return false;}
		}
		</script>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>Upload a backup file of n@log data</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<form method=post action="plug_in/<?=$plugin[dir]?>/upload.php" onsubmit="return chkup()" name=up enctype="multipart/form-data">
		<tr bgcolor=white>
		<td><input type=file name=backup size=32 class=input><br>(Please specify a n@log backup file with 'sql' as the extension)</td>
		<td align=right><input type=submit class=button value="Upload NOW"></td>
		</tr>
		</form>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr><td>
		If you want to restore an .sql file, firstly you have to upload it to n@log root folder.<br>
		We suggest you to upload it via FTP, since in some cases you cannot manually delete a file which was uploaded by a script.
		</td></tr>
		</table>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>Restore n@log data by an existing backup file on server</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=white>
		<form method=post action="plug_in/<?=$plugin[dir]?>/restore.php" onsubmit="return chk()" name=ok>
		<td><select name=filename>
		<option value="">Please select an .sql file to be restored</option>
		<?
		$handle=@opendir("./");
		while ($dir = @readdir($handle))
		{
		if(!eregi("\.sql$",$dir)){continue;}
		echo "<option value=\"$dir\">$dir</option>";
		}
		?>
		</select><br>(This pulldown menu shows currently the available .sql file(s) in n@log root folder on the server)</td>
		<td align=right><input type=submit class=button value="Restore NOW"></td>
		</tr>
		</table>


<?}?>

<?
####################################################################################
//			Menu 3: Information
####################################################################################
if($pmode==3){?>
<table width=100% border=0 cellpadding=5 cellspacing=0 align=center bgcolor=white>
<tr>
<td width=99% valign=top>
	<table width=100% border=0 cellpadding=4 cellspacing=0 align=center bgcolor=white>
	<tr>
	<td width=1% nowrap>Plug-in Name</td>
	<td width=99%>: <?=$plugin[name]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>Plug-in ID</td>
	<td width=99%>: <?=$plugin[id]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>Version</td>
	<td width=99%>: <?=$plugin[version]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>Date</td>
	<td width=99%>: <?=$plugin[date]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>Author</td>
	<td width=99%>: <?=$plugin[programmer]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>E-mail</td>
	<td width=99%>: <?=$plugin[email]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>Homepage</td>
	<td width=99%>: <?=$plugin[homepage]?></td>
	</tr>
	</table>
</td>
<td width=1% nowrap valign=top><img src="plug_in/<?=$plugin[dir]?>/logo.gif" border=0></td>
</tr>
</table>
<?}?>
