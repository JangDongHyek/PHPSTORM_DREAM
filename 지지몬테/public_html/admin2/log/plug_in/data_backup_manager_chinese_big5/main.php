<?
####################################################################################
//			準備就緒
####################################################################################
set_time_limit(0);
if(!$is_admin){
nalog_error("您沒有足夠權限");
}
?>

<?
####################################################################################
//			插件主畫面
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
//			第 1 頁 - 備份資料
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
		<td nowrap>總共 <b><?=$total?></b> 個計數器</td>
		<td align=right>請選擇備份方式:
		<input type=radio name=how value=1 checked> 下載到自己電腦
		<input type=radio name=how value=0> 儲存在伺服器端
		(路徑: <?=str_replace("admin_counter.php","*.sql",$PHP_SELF)?>)</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<input type=hidden name=counter value="<?=$counter?>">
		<input type=hidden name=id value="<?=$id?>">
		<input type=hidden name=pmode value="<?=$pmode?>">
		<tr bgcolor=#C9F0FF>
		<td width=1% nowrap align=center>編號</td>
		<td width=1% nowrap align=center>選取</td>
		<td width=92% align=center>計數器名稱</td>
		<td width=1% nowrap align=center>已記錄天數</td>
		<td width=1% nowrap align=center>OS/瀏覽器記錄</td>
		<td width=1% nowrap align=center>來源主機記錄</td>
		<td width=1% nowrap align=center>來源網址記錄</td>
		<td width=1% nowrap align=center>訪客記錄</td>
		<td width=1% nowrap align=center>會員記錄</td>
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
		<td width=1% nowrap align=right>$total_data[0]天</td>
		<td width=1% nowrap align=right>$total_os[0]種 / $total_bw[0]種</td>
		<td width=1% nowrap align=right>$total_log[0]個</td>
		<td width=1% nowrap align=right>$total_dlog[0]個</td>
		<td width=1% nowrap align=right>$total_counter[0]筆</td>
		<td width=1% nowrap align=right>$total_member[0]筆</td>
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
		<td align=center><input type=submit class=button value="立即備份"></td>
		</tr>
		</form>
		</table>
<?}?>

<?
####################################################################################
//			第 2 頁 - 還原資料
####################################################################################
if($pmode==2){?>

		<script language=javascript>
		function chk(){
		if(!ok.filename.value){alert('請在備份檔案下拉選單選擇一個 .sql 檔案以作備份。\n假如在 n@log 主資料夾裡沒有任何 .sql 檔案存在，請先上傳檔案。');ok.filename.focus();return false;}
		}
		function chkup(){
		if(!up.backup.value){alert('請先指定一個 .sql 檔案以作上傳');up.backup.click();return false;}
		}
		</script>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>上傳 n@log 備份資料檔案</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<form method=post action="plug_in/<?=$plugin[dir]?>/upload.php" onsubmit="return chkup()" name=up enctype="multipart/form-data">
		<tr bgcolor=white>
		<td><input type=file name=backup size=32 class=input><br>(請指定一個以 'sql' 為副檔名的 n@log 備份資料檔案)</td>
		<td align=right><input type=submit class=button value="立即上傳"></td>
		</tr>
		</form>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr><td>
		如果您想要還原先前備份的 .sql 檔案，第一件事要做的是將這個檔案上傳到 n@log 主資料夾。<br>
		我們建議您使用 FTP 的方式上傳，因為在某些情況下，您可能無法利用手動的方法刪除使用腳本上傳的檔案。
		</td></tr>
		</table>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>還原 n@log 備份資料檔案</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=white>
		<form method=post action="plug_in/<?=$plugin[dir]?>/restore.php" onsubmit="return chk()" name=ok>
		<td><select name=filename>
		<option value="">請選擇一個備份資料檔案以作還原</option>
		<?
		$handle=@opendir("./");
		while ($dir = @readdir($handle))
		{
		if(!eregi("\.sql$",$dir)){continue;}
		echo "<option value=\"$dir\">$dir</option>";
		}
		?>
		</select><br>(這個下拉選單列出儲存在伺服器中 n@log 主資料夾裡所有可用的 .sql 檔案)</td>
		<td align=right><input type=submit class=button value="立即還原"></td>
		</tr>
		</table>


<?}?>

<?
####################################################################################
//			第 3 頁 - 插件相關資訊
####################################################################################
if($pmode==3){?>
<table width=100% border=0 cellpadding=5 cellspacing=0 align=center bgcolor=white>
<tr>
<td width=99% valign=top>
	<table width=100% border=0 cellpadding=4 cellspacing=0 align=center bgcolor=white>
	<tr>
	<td width=1% nowrap>插件名稱</td>
	<td width=99%>：　 <?=$plugin[name]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>插件英文ID</td>
	<td width=99%>：　 <?=$plugin[id]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>版本編號</td>
	<td width=99%>：　 <?=$plugin[version]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>發表日期</td>
	<td width=99%>：　 <?=$plugin[date]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>作者</td>
	<td width=99%>：　 <?=$plugin[programmer]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>電子郵件</td>
	<td width=99%>：　 <?=$plugin[email]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>個人網站</td>
	<td width=99%>：　 <?=$plugin[homepage]?></td>
	</tr>
	</table>
</td>
<td width=1% nowrap valign=top><img src="plug_in/<?=$plugin[dir]?>/logo.gif" border=0></td>
</tr>
</table>
<?}?>
