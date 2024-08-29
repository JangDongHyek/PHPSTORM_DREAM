<?
####################################################################################
//					준비
####################################################################################
set_time_limit(0);
if(!$is_admin){
nalog_error("이 플러그인은 관리자만 사용할 수 있습니다.");
}
?>

<?
####################################################################################
//					첫화면
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
//					검색엔진순위
####################################################################################
if($pmode==1){?>
<?
$engine	= @explode("\n", $engine);

unset($report);

for($i=0; $i<sizeof($engine); $i++) 
{
	if(!$engine[$i]=trim($engine[$i]))
	{
		continue;
	}

	$thisEngine	= @explode("@", $engine[$i]);
	$thisHost	= trim($thisEngine[0]);


	$result=mysql_query("select sum(hit) from nalog3_log_$counter where log like '%$thisHost%'");
	$data=mysql_fetch_array($result);

		if($data=(int)$data[0])
		{
		$thisHost		= @explode(".", $thisHost);
		$resHost[]	= $thisHost[0];
		$resHit[]	= $data;
		}
}

arsort($resHit);

$total	= array_sum($resHit);
$max	= max($resHit);

if($total)
{
?>


	<table align=center width=98% cellpadding=0 cellspacing=0 border=0>
	<tr><td>
	<b><?=number_format(sizeof($resHit))?></b> Engines, <b><?=number_format($total)?></b> Hits 
	</td></tr>
	</table>

	<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
	<?
	foreach($resHit as $key => $val) 
	{
	$per	= round($val / $total * 100, 2);

	$width	= round(100 * $val / $max);

	echo"
	<tr>
	<td width=1% nowrap>$resHost[$key]</td>
	<td width=99%><img src='nalog_image/block.gif' border=0 align=absmiddle height=10 width=$width%></td>
	<td width=1% nowrap align=right>$per%</td>
	<td width=1% nowrap align=right>".number_format($val)."</td>
	</tr>
	";			
	}
	?>
	</table>
	
<?
}
}
?>

<?
####################################################################################
//					검색어순위
####################################################################################
if($pmode==2){?>
<?
$engine	= @explode("\n", $engine);

for($i=0; $i<sizeof($engine); $i++) 
{
	if(!$engine[$i]=trim($engine[$i]))
	{
		continue;
	}

	$thisEngine	= @explode("@", $engine[$i]);
	$thisHost	= trim($thisEngine[0]);
	$thisVar	= trim($thisEngine[1]);


	$result=mysql_query("select * from nalog3_dlog_$counter where log like '%$thisHost%' and log like '%$thisVar=%'");
	while($data=mysql_fetch_array($result))
	{
		$log	= @split("$thisVar=", $data[log]);
		$log	= @split("&|;", $log[1]);
		$log	= trim(urldecode($log[0]));

		if(!$log) continue;

		$res	= array_search($log, $resWord);

		if($res == '')
		{
			$resWord[]	= $log;
			$resHit[]	= 1;
		}
		else 
		{
			$resHit[$res]	++;					
		}

	}
}

arsort($resHit);

$total	= array_sum($resHit);
$max	= max($resHit);


if($resHit)
{
?>


	<table align=center width=98% cellpadding=0 cellspacing=0 border=0>
	<tr><td>
	<b><?=number_format(sizeof($resHit))?></b> Words, <b><?=number_format($total)?></b> Hits 
	</td></tr>
	</table>

	<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
	<?
	foreach($resHit as $key => $val) 
	{
	$per	= round($val / $total * 100, 2);

	$width	= round(400 * $val / $max);

	echo"
	<tr>
	<td style='word-break:break-all'>".htmlspecialchars($resWord[$key])."</td>
	<td width=400 nowrap><img src='nalog_image/block.gif' border=0 align=absmiddle height=10 width=$width></td>
	<td width=1% nowrap align=right>$per%</td>
	<td width=1% nowrap align=right>".number_format($val)."</td>
	</tr>
	";			
	}
	?>
	</table>
<?
}
}
?>

<?
####################################################################################
//					플러그인정보
####################################################################################
if($pmode==3){?>
<table width=100% board=0 cellpadding=5 cellspacing=0 align=center bgcolor=white>
<tr>
<td width=99% valign=top>
	<table width=100% board=0 cellpadding=4 cellspacing=0 align=center bgcolor=white>
	<tr>
	<td width=1% nowrap>플러그인이름</td>
	<td width=99%> : <?=$plugin[name]?></td>
	</tr>	
	<tr>
	<td width=1% nowrap>플러그인 ID</td>
	<td width=99%> : <?=$plugin[id]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>배포버전</td>
	<td width=99%> : <?=$plugin[version]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>배포일자</td>
	<td width=99%> : <?=$plugin[date]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>제 작 자</td>
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
