<?
/*
	if($pure==1) {
		$dbqry="
			SELECT ip_num,ip_ip,ip_pure_hit as counter
			FROM `rg_counter_ip`
			ORDER BY ip_pure_hit DESC
			LIMIT 0,100";
	} else {
		$dbqry="
			SELECT ip_num,ip_ip,ip_hit as counter
			FROM `rg_counter_ip`
			ORDER BY ip_hit DESC
			LIMIT 0,100";
	}
*/
	$dbqry="
		SELECT ip_num,ip_ip,count(counter_num) as counter
		FROM `rg_counter_log` left join `rg_counter_ip`
		  ON `rg_counter_log`.counter_ip = `rg_counter_ip`.ip_num
		WHERE (1=1) $SQL_WHERE
		GROUP BY counter_ip
		ORDER BY counter DESC
		LIMIT 0,100
	";
	
	$rs=query($dbqry,$dbcon);
	$max_counter=0;
	$total_counter=0;
	while($tmp=mysql_fetch_array($rs)) {
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		$total_counter += $tmp['counter'];
		$data[$tmp['ip_num']]['name']=$tmp['ip_ip'];
		$data[$tmp['ip_num']]['counter']=$tmp['counter'];
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
	foreach($data as $key => $val) {
?>
  <tr> 
    <td width="130"> 
      <?=$val['name']?></td>
    <td><img src="g1.gif" width="<?=$val[graph_per]?>%" height="16"><br>
      </td>
    <td width="100" align="right"><?=number_format($val['counter'])?>
      hits</td>
  </tr>
<? 
	}
?>
</table>