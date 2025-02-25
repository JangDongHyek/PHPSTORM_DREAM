<?
	$data=array();
	$dbqry="
		SELECT hh,count(counter_num) as counter
		FROM `rg_counter_log`
		WHERE (1=1) $SQL_WHERE
		GROUP BY hh";
	$rs=query($dbqry,$dbcon);
	$max_counter=0;
	$total_counter=0;
	while($tmp=mysql_fetch_array($rs)) {
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		$total_counter += $tmp['counter'];
		$data[$tmp['hh']]['counter']=$tmp['counter'];
	}

	foreach($data as $key => $val) {
		if($data[$key][counter]>0) {
			$data[$key][count_per] = number_format($data[$key][counter]/$total_counter*100,2,'.','');
			$data[$key][graph_per] = number_format($data[$key][counter]/$max_counter*75,0,'.','');
		} else {
			$data[$key][count_per] = 0;
			$data[$key][graph_per] = 0;
		}
		$item_list[$key][vit_count]=number_format($item_list[$key][vit_count]);
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;√÷¥Îhits : <?=number_format($max_counter)?>hits, √—hits : <?=number_format($total_counter)?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<? 
	for($i=0;$i<24;$i++) {
?>
  <tr> 
    <td width="50" align="right">
      <?=$i?>
      Ω√</td>
    <td width="80" align="right"><?=number_format($data[$i]['counter'])?>
      hits</td>
    <td><img src="g1.gif" width="<?=$data[$i][graph_per]?>%" height="16"><br>
      </td>
  </tr>
<? 
	}
?>
</table>