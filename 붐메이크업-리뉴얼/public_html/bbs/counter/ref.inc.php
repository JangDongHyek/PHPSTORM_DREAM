<?
/*
	if($pure==1) {
		$dbqry="
			SELECT ref_num,ref_url,ref_pure_hit as counter
			FROM `rg_counter_ref`
			WHERE ref_pure_hit > 0
			ORDER BY ref_pure_hit DESC, ref_url
			LIMIT 0,100";
	} else {
		$dbqry="
			SELECT ref_num,ref_url,ref_hit as counter
			FROM `rg_counter_ref`
			ORDER BY ref_hit DESC, ref_url
			LIMIT 0,100";
	}
*/
	$dbqry="
		SELECT ref_num,ref_url,count(counter_num) as counter
		FROM `rg_counter_log` left join `rg_counter_ref`
		  ON `rg_counter_log`.counter_ref = `rg_counter_ref`.ref_num
		WHERE (1=1) $SQL_WHERE
		GROUP BY counter_ref
		ORDER BY counter DESC
		LIMIT 0,100
	";
	
	$rs=query($dbqry,$dbcon);
	$max_counter=0;
	$total_counter=0;
	while($tmp=mysql_fetch_array($rs)) {
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		$total_counter += $tmp['counter'];
		$data[$tmp['ref_num']]['name']=$tmp['ref_url'];
		$data[$tmp['ref_num']]['counter']=$tmp['counter'];
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
<script language="JavaScript" type="text/JavaScript">
function ref_open(url)
{
	open(url)
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<? 
	foreach($data as $key => $val) {
?>
  <tr> 
    <td width="80" align="right"><?=number_format($val['counter'])?>
      hits</td>
    <td> 
      &nbsp;<a href="javascript:ref_open('<?=urlencode($val['name'])?>')" title="<?=$val['name']?>"><?=rg_cut_string($val['name'], 100, "..")?></a></td>
    <!-- <td><img src="g1.gif" width="<?=$val[graph_per]?>%" height="16"><br>
      </td> -->
  </tr>
<? 
	}
?>
</table>