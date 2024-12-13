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
	if($sel=='1') {
		$SQL_WHERE.=" AND rg_counter_ip.ip_ip like '$kw'";
	}	
	
	$dbqry="
		SELECT count(*) as row_count 
		FROM `rg_counter_log`
		LEFT JOIN rg_counter_ref
		  ON rg_counter_log.counter_ref = rg_counter_ref.ref_num
		LEFT JOIN rg_counter_ip
		  ON rg_counter_log.counter_ip = rg_counter_ip.ip_num
		WHERE (1=1) $SQL_WHERE
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);
	
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
<table border="0" cellspacing="0" cellpadding="0">
<form action="?" name="set_date">
<input type="hidden" name="pure" value="<?=$pure?>">
<input type="hidden" name="type" value="<?=$type?>">
  <tr>
    <td>
		<select name="sel">
			<option value="1">æ∆¿Ã««</option>
		</select>
		<input type="text" name="kw" value="<?=$kw?>">
		<input type="submit">
		</td>
  </tr>
</form>
</table>
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
<?
	$p_str = "pure=$pure&type=$type&sel=$sel&kw=$kw";
	include("navigation.php");
?>