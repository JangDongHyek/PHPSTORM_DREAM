<?
####################################################################################
//					�غ�
####################################################################################
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
if(!@include "nalog_language.php"){nalog_go("install.php");}
if(!@include"language/$language/language.php"){nalog_go("install.php");}
echo $lang[head];


####################################################################################
//					üũ
####################################################################################
nalog_admin_check("login.php?go=admin.php");

####################################################################################
//					������
####################################################################################
$tables=nalog_list_bd();
$total=count($tables);

####################################################################################
//					���̺� ��Ƽ����¡
####################################################################################
mysql_query("OPTIMIZE TABLE nalog3_os") or die(mysql_error());
mysql_query("OPTIMIZE TABLE nalog3_data") or die(mysql_error());

####################################################################################
//					ī���ͼ�
####################################################################################
if($page){nalog_chk_num($page,0,$lang[counter_manager_view_error],0);}
else{$page=10;}


####################################################################################
//					��ϼ�
####################################################################################
$pageviewsu=10; 


####################################################################################
//					�ε���
####################################################################################
$pagesu=ceil($total/$page); 
$start=($page*$pagenum); 
$no=$total-$start;
$pagegroup=ceil(($pagenum+1)/$pageviewsu); 
$pagestart=($pageviewsu*($pagegroup-1))+1; 
$pageend=$pagestart+$pageviewsu-1;
$nowpage=$pagenum+1; 
?>

<script language=javascript>

function chk_drop(){
if(!confirm('warning : \n\n<?=$lang[counter_manager_warning_drop]?>')){return false;}
}
function chk_del(){
if(!confirm('warning : \n\n<?=$lang[counter_manager_warning_clean]?>')){return false;}
}
function chk_new(){
if(!chk.new_board.value){alert('error : \n\n<?=$lang[counter_manager_error_create]?>');chk.new_board.focus();return false;}
}

</script>

<table width=100% height=100%>
<tr><td valign=top><br><br>
	<table align=center width=600 cellpadding=2 cellspacing=0 border=0 bgcolor=#C9CACB>
	<tr><td colspan=2 bgcolor=white><a href=http://navyism.com target=_blank><img src=nalog_image/logo_small.gif border=0></a></td></tr>
	<tr><td colspan=2 bgcolor=white>
		<table width=100% cellpadding=0 cellspacing=0>
		<tr>
		<td><font color=#008CD6 size=4><b>&nbsp;<a href=root.php><?=$lang[root_title]?></a> > <?=$lang[counter_manager_title]?></b></font></td>
		<td align=right><?=$logout?> <?=$help?> <?=$manual?></td>
		</tr>
		</table>
	</td></tr>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td colspan=2>
		<table align=center width=98% cellpadding=0 cellspacing=0 border=0>
		<form method=get action=admin.php>
		<tr>
		<td><?=$lang[counter_manager_paging1]?><b><?=$total?></b><?=$lang[counter_manager_paging2]?><b><?=$nowpage?></b><?=$lang[counter_manager_paging3]?><b><?=$pagesu?></b><?=$lang[counter_manager_paging4]?></td>
		<td align=right><?=$lang[counter_manager_view]?> <input type=text size=3 class=input maxlength=3 name=page value=<?=$page?> onKeyPress="if((event.keyCode>57||event.keyCode<48)) event.returnValue=false;"> <input type=submit class=button value="<?=$lang[counter_manager_view_button]?>"></td>
		</tr>
		</form>
		</table>
		<table align=center width=98% cellpadding=2 cellspacing=0 border=1 bordercolor=white>
		<form method=post action=admin_ing.php name=chk onsubmit="return chk_new()">
		<input type=hidden name=mode value=make>
		<tr bgcolor=#F4F4F4>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_no]?></td>
		<td width=91% align=center><?=$lang[counter_manager_table_name]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_config]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_example]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_drop]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_clean]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_total]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_today]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_today_peak]?></td>
		<td width=1% nowrap align=center><?=$lang[counter_manager_table_peak]?></td>
		</tr>
		<?
		
		####################################################################################
		//					�Ѱ�������
		####################################################################################
		$send="&page=$page&";
	

		####################################################################################
		//					��°�
		####################################################################################
		for($i=$start;$i<$start+$page;$i++)
		{
		if(!$tables[$i]){break;}
		$board_name=$tables[$i];


		####################################################################################
		//					���
		####################################################################################
		$yy=date(Y);
		$mm=date(m);
		$dd=date(d);

		$query="select * from nalog3_data where counter='$board_name' and yy=$yy and mm=$mm and dd=$dd"; 
		$counter_today=mysql_fetch_array(mysql_query($query)); 
		$counter_today=$counter_today[hit];

		$set=nalog_config("$board_name");
		$counter_max=$set[peak];
		$counter_total=$set[total];

		$query="select max(hit) from nalog3_data where counter='$board_name'"; 
		$counter_today_peak=mysql_fetch_array(mysql_query($query)); 
		$counter_today_peak=$counter_today_peak[0];
				

		echo"
		<tr bgcolor=white>
		<td width=1% nowrap align=center>$no</td>
		<td width=91%><a href=admin_counter.php?counter=$board_name target=_blank>$board_name</a></td>
		<td width=1% nowrap align=center><a href=admin_counter.php?counter=$board_name&mode=10 target=_blank>$lang[counter_manager_table_config]</a></td>
		<td width=1% nowrap align=center><a href=example.php?counter=$board_name target=_blank>$lang[counter_manager_tablecell_view]</a></td>
		<td width=1% nowrap align=center><a href=admin_ing.php?new_board=$board_name&mode=drop onclick=\"return chk_drop()\">$lang[counter_manager_tablecell_drop]</a></td>
		<td width=1% nowrap align=center><a href=admin_ing.php?new_board=$board_name&mode=del onclick=\"return chk_del()\">$lang[counter_manager_tablecell_clean]</a></td>
		<td width=1% nowrap align=right>".number_format($counter_total)."</td>
		<td width=1% nowrap align=right>".number_format($counter_today)."</td>
		<td width=1% nowrap align=right>".number_format($counter_today_peak)."</td>
		<td width=1% nowrap align=right>".number_format($counter_max)."</td>
		</tr>
		";

		$no--;

		####################################################################################
		//					���̺� ��Ƽ����¡
		####################################################################################
		mysql_query("OPTIMIZE TABLE nalog3_counter_$board_name") or die(mysql_error());
		mysql_query("OPTIMIZE TABLE nalog3_config_$board_name") or die(mysql_error());
		mysql_query("OPTIMIZE TABLE nalog3_log_$board_name") or die(mysql_error());
		mysql_query("OPTIMIZE TABLE nalog3_dlog_$board_name") or die(mysql_error());
		mysql_query("OPTIMIZE TABLE nalog3_now_$board_name") or die(mysql_error());

		####################################################################################
		//					�ε��� ���� :: 5.0.4 to 5.0.5
		####################################################################################
		@mysql_query("ALTER TABLE `nalog3_counter_$board_name` ADD INDEX `idx` (`id`,`time`)",$connect);
		@mysql_query("ALTER TABLE `nalog3_log_$board_name` ADD INDEX `idx` (`bookmark`,`time`,`log`,`hit`,`no`)",$connect);
		@mysql_query("ALTER TABLE `nalog3_dlog_$board_name` ADD INDEX `idx` (`bookmark`,`time`,`log`,`hit`,`no`)",$connect);
		@mysql_query("ALTER TABLE `nalog3_now_$board_name` ADD INDEX `idx` (`time`)",$connect);

		}

		####################################################################################
		//					�Ѱ���
		####################################################################################
		echo"<input type=hidden name=count value=$i>";
		?>
		</table>
	</td></tr>
	<tr><td colspan=2 align=center><?nalog_index()?>
	</td></tr>
	<tr><td colspan=2 height=5></td></tr>
	<tr><td colspan=2>
		<table align=center width=98% cellpadding=2 cellspacing=0 border=0 bordercolor=white bgcolor=#F4F4F4>
		<tr>	
		<td>
		<input type=hidden name=pagenum value=<?=$pagenum?>>
		<input type=input class=input name=new_board size=20 value='<?=$word?>' onclick=select()> <input type=submit value="<?=$lang[counter_manager_create_button]?>" class=button> 
		</td></tr>
		</table>
	</td></tr></form>
	<tr><td colspan=2 height=3 bgcolor=#B2B3B5></td></tr>
	<tr><td bgcolor=white><a href=admin.php>List</a></td><td bgcolor=white align=right><?=$lang[copy]?></td></tr>
	</table>
</td></tr>
</table>
</body>
</html>
<?@mysql_close($connect);?>