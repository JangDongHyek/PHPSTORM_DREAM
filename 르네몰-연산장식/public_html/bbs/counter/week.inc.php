<?
	$data=array();
	$dbqry="
		SELECT ww,count(counter_num) as counter
		FROM `rg_counter_log`
		WHERE (1=1) $SQL_WHERE
		GROUP BY ww";
	$rs=query($dbqry,$dbcon);
	$max_counter=0;
	$total_counter=0;
	while($tmp=mysql_fetch_array($rs)) {
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		$total_counter += $tmp['counter'];
		$data[$tmp['ww']]['counter']=$tmp['counter'];
	}

	foreach($data as $key => $val) {
		if($data[$key][counter]>0) {
			$data[$key][count_per] = number_format($data[$key][counter]/$total_counter*100,2,'.','');
			$data[$key][graph_per] = number_format($data[$key][counter]/$max_counter*75,0,'.','');
		} else {
			$data[$key][count_per] = 0;
			$data[$key][graph_per] = 0;
		}
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;최대hits : <?=number_format($max_counter)?>hits, 총hits : <?=number_format($total_counter)?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
	if($year!='' && $month!='') {
		$week=date('w',mktime(0,0,0,$month,1,$year));
		$weeks=array(0=>'일',1=>'월',2=>'화',3=>'수',4=>'목',5=>'금',6=>'토');
		$week_begin = '';
		$week_end = '';		
	} else {
		$week_begin = '<!--';
		$week_end = '-->';		
	}
	for($i=0;$i<7;$i++) {
		$ww=$weeks[$i];
		$w_color='black';
		if($ww=='토') $w_color='blue';
		if($ww=='일') $w_color='red';
?>
  <tr> 
    <td width="60" align="right">
      <font color='<?=$w_color?>'><?=$ww?></font>
			</td>
    <td width="80" align="right"><?=number_format($data[$i]['counter'])?>
      hits</td>
    <td><img src="g1.gif" width="<?=$data[$i][graph_per]?>%" height="16" border="0"><br>
      </td>
  </tr>
<? 
		$week+=1;
	}
?>
</table>