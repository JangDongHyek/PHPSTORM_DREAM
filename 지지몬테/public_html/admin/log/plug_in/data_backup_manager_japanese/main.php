<?
####################################################################################
//					準備
####################################################################################
set_time_limit(0);
if(!$is_admin){
nalog_error("このプラグインは管理者のみ利用出来ます。");
}
?>

<?
####################################################################################
//					最初の画面
####################################################################################
if(!$pmode){?>
<table width=100% board=0 cellpadding=2 cellspacing=0 align=center bgcolor=white>
<tr><td align=center>
<br><br><br><br><br>
<img src="plug_in/<?=$plugin[dir]?>/logo.gif" border=0>
<br><br><br><br><br><br>
</td></tr>
</table>
<?}?>

<?
####################################################################################
//					バックアップ画面
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
		<form method=post action=plug_in/<?=$plugin[dir]?>/dump.php>
		<tr>
		<td>合計 <b><?=$total?></b>つのカウンタ</td>
		<td align=right>保存方法 : <input type=radio name=how value=1 checked> ダウンロード
		<input type=radio name=how value=0> サーバーに保存 (保存経路 : <?=str_replace("admin_counter.php","*.sql",$PHP_SELF)?>)</td> 
		</tr> 
		</table>
	
		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<input type=hidden name=counter value="<?=$counter?>">
		<input type=hidden name=id value="<?=$id?>">
		<input type=hidden name=pmode value="<?=$pmode?>">
		<tr bgcolor=#C9F0FF>
		<td width=1% nowrap align=center>番号</td>
		<td width=1% nowrap align=center>選択</td>
		<td width=92% align=center>カウンタ名</td>
		<td width=1% nowrap align=center>カウンタ記録</td>
		<td width=1% nowrap align=center>OS/BW記録</td>
		<td width=1% nowrap align=center>LOG記録</td>
		<td width=1% nowrap align=center>DLOG記録</td>
		<td width=1% nowrap align=center>訪問者記録</td>
		<td width=1% nowrap align=center>会員記録</td>
		</tr>
<?
		$j=0;
		for($i=$start;$i<$start+$page;$i++)
		{
		if(!$tables[$i]){break;}
		$board_name=$tables[$i];

		$total_data=mysql_fetch_array(mysql_query("select count(*) from nalog3_data where counter='$board_name'"));
		$total_os=mysql_fetch_array(mysql_query("select count(*) from nalog3_os where counter='$board_name' and os='1'"));
		$total_bw=mysql_fetch_array(mysql_query("select count(*) from nalog3_os where counter='$board_name' and os='0'"));
		$total_log=mysql_fetch_array(mysql_query("select count(*) from nalog3_log_$board_name"));
		$total_dlog=mysql_fetch_array(mysql_query("select count(*) from nalog3_dlog_$board_name"));
		$total_dlog=mysql_fetch_array(mysql_query("select count(*) from nalog3_dlog_$board_name"));
		$total_counter=mysql_fetch_array(mysql_query("select count(*) from nalog3_counter_$board_name"));
		$total_member=mysql_fetch_array(mysql_query("select count(*) from nalog3_counter_$board_name where id<>''"));


		echo"
		<tr bgcolor=white>
		<td width=1% nowrap align=center>$no</td>
		<td width=1% nowrap align=center><input type=checkbox name=name[$j] value='$board_name' checked id=name[$j]></td>
		<td width=92%><b><label for=name[$j]>$board_name</label></b></td>
		<td width=1% nowrap align=right>$total_data[0]日</td>
		<td width=1% nowrap align=right>$total_os[0]/$total_bw[0]個</td>
		<td width=1% nowrap align=right>$total_log[0]個</td>
		<td width=1% nowrap align=right>$total_dlog[0]個</td>
		<td width=1% nowrap align=right>$total_counter[0]人</td>
		<td width=1% nowrap align=right>$total_member[0]人</td>
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
		<td align=center><input type=submit class=button value=バックアップ></td>	
		</tr>
		</form>
		</table>
<?}?>

<?
####################################################################################
//					復旧画面
####################################################################################
if($pmode==2){?>

		<script language=javascript>
		function chk(){
		if(!ok.filename.value){alert('復旧対象ファイルを選択して下さい\nもし、対象ファイルがサーバーになければ、ファイルをアップロードして下さい');ok.filename.focus();return false;}
		}
		function chkup(){
		if(!up.backup.value){alert('アップロードするファイルを選んで下さい');up.backup.click();return false;}
		}
		</script>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>n@log データー バックアップ ファイル アップロード</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<form method=post action=plug_in/<?=$plugin[dir]?>/upload.php onsubmit="return chkup()" name=up enctype=multipart/form-data>
		<tr bgcolor=white>
		<td><input type=file name=backup size=32 class=input> このファイルを n@logフォルダーに転送します。</td>
		<td align=right><input type=submit class=button value=転送></td>
		</tr>
		</form>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr><td>データーを復旧するには、n@logが設置されているフォルダーに、バックアップファイル(*.sql)を入れておく必要があります。<br>
		FTPで転送するか、上記のフォームで転送するファイルを添付して下さい。<br>
		</table>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>n@log フォルダーに保存されたデーターファイル復旧</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=white>
		<form method=post action=plug_in/<?=$plugin[dir]?>/restore.php onsubmit="return chk()" name=ok>
		<td><select name=filename>
		<option value="">データーを復旧するファイルを選んで下さい。</option>
		<?
		$handle=@opendir("./");
		while ($dir = @readdir($handle))
		{
		if(!eregi("\.sql$",$dir)){continue;}
		echo "<option value=\"$dir\">$dir</option>";
		}
		?>
		</select> このファイルをサーバーのn@logに復旧します。</td>
		<td align=right><input type=submit class=button value=復旧開始></td>
		</tr>
		</table>


<?}?>

<?
####################################################################################
//					プラグイン情報
####################################################################################
if($pmode==3){?>
<table width=100% board=0 cellpadding=5 cellspacing=0 align=center bgcolor=white>
<tr>
<td width=99% valign=top>
	<table width=100% board=0 cellpadding=4 cellspacing=0 align=center bgcolor=white>
	<tr>
	<td width=1% nowrap>プラグイン名</td>
	<td width=99%> : <?=$plugin[name]?></td>
	</tr>	
	<tr>
	<td width=1% nowrap>プラグイン ID</td>
	<td width=99%> : <?=$plugin[id]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>バージョン</td>
	<td width=99%> : <?=$plugin[version]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>配布日</td>
	<td width=99%> : <?=$plugin[date]?></td>
	</tr>
	<tr>
	<td width=1% nowrap> 作者 </td>
	<td width=99%> : <?=$plugin[programmer]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>e-mail</td>
	<td width=99%> : <?=$plugin[email]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>homepage</td>
	<td width=99%> : <?=$plugin[homepage]?></td>
	</tr> 
	</table>                        
</td>
<td width=1% nowrap valign=top><img src="plug_in/<?=$plugin[dir]?>/logo.gif" border=0></td>
</tr>
</table>
<?}?>
