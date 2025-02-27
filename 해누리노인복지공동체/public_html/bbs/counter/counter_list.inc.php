<?
	$SQL_WHERE='';
	if($pure==1) {
		$SQL_WHERE.=" AND pure=1";
	}
	if($year!='') {
		$SQL_WHERE.=" AND yyyy='$year'";
	}
	if($month!='') {
		$SQL_WHERE.=" AND mm='$month'";
	}
	$data=array();
	$dbqry="
		SELECT rg_counter_log.*,rg_counter_ref.ref_url,rg_counter_ip.ip_ip
		FROM `rg_counter_log` 
		LEFT JOIN rg_counter_ref
		  ON rg_counter_log.counter_ref = rg_counter_ref.ref_num
		LEFT JOIN rg_counter_ip
		  ON rg_counter_log.counter_ip = rg_counter_ip.ip_num
 		WHERE (1=1) $SQL_WHERE
		ORDER BY counter_num DESC
		LIMIT 0,100";
	$rs=query($dbqry,$dbcon);
?>
<script language="JavaScript" type="text/JavaScript">
function ref_open(url)
{
	open(url)
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<? 
	while($r=mysql_fetch_array($rs)) {
?>
  <tr> 
    <td width="110" align="right"><?=rg_date($r['counter_date'])?>
      </td>
    <td width="110" align="center"><?=$r['ip_ip']?>
      </td>
    <td> 
      &nbsp;<a href="javascript:ref_open('<?=urlencode($r['ref_url'])?>')" title="<?=$r['ref_url']?>"><?=rg_cut_string($r['ref_url'], 100, "..")?></a></td>
    <!-- <td><img src="g1.gif" width="<?=$val[graph_per]?>%" height="16"><br>
      </td> -->
  </tr>
<? 
	}
?>
</table>