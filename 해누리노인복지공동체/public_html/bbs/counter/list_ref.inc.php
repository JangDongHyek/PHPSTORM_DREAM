<?
/*	$SQL_WHERE='';
	if($pure==1) {
		$SQL_WHERE.=" AND pure=1";
	}

	if($year!='') {
		$SQL_WHERE.=" AND yyyy='$year'";
	}
	if($month!='') {
		$SQL_WHERE.=" AND mm='$month'";
	} */
	switch($sel) {
		case '1' : $SQL_WHERE.=" AND rg_counter_ref.ref_url like '%$kw%'"; break;
		case '2' : $SQL_WHERE.=" AND rg_counter_page.page_url like '%$kw%'"; break;
		case '3' : $SQL_WHERE.=" AND rg_counter_ip.ip_ip like '%$kw%'"; break;
	}	
	
	$dbqry="
		SELECT count(*) as row_count 
		FROM `rg_counter_log`
		LEFT JOIN rg_counter_ref
		  ON rg_counter_log.counter_ref = rg_counter_ref.ref_num
		LEFT JOIN rg_counter_page
		  ON rg_counter_log.counter_page = rg_counter_page.page_num
		LEFT JOIN rg_counter_ip
		  ON rg_counter_log.counter_ip = rg_counter_ip.ip_num
		WHERE (1=1) $SQL_WHERE
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,100,10);
	
	$dbqry="
		SELECT rg_counter_log.*,
						rg_counter_page.page_url,
						rg_counter_ref.ref_url,
						rg_counter_ip.ip_ip
		FROM `rg_counter_log` 
		LEFT JOIN rg_counter_page
		  ON rg_counter_log.counter_page = rg_counter_page.page_num
		LEFT JOIN rg_counter_ref
		  ON rg_counter_log.counter_ref = rg_counter_ref.ref_num
		LEFT JOIN rg_counter_ip
		  ON rg_counter_log.counter_ip = rg_counter_ip.ip_num
 		WHERE (1=1) $SQL_WHERE
		ORDER BY counter_num DESC
		LIMIT $page_info[offset],$page_info[rows]";
	$rs=query($dbqry,$dbcon);
?>
<table border="0" cellspacing="0" cellpadding="0">
<form action="?" name="set_date">
<input type="hidden" name="type" value="<?=$type?>">
<input type="hidden" name="time_start" value="<?=$time_start?>">
<input type="hidden" name="time_end" value="<?=$time_end?>">
  <tr>
    <td>
		<select name="sel">
<?
	$key_list=array(1=>'접속경로',2=>'접속페이지',3=>'아이피');
	foreach($key_list as $key => $val) {
		echo "<option value=\"$key\"";
		if($key==$sel) echo " selected ";
		echo ">$val</option>";
	}
?>
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

<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolordark="#CCCCCC" bordercolorlight="#333333">
  <tr> 
    <td align="center"> 일시 </td>
    <td align="center"> 아이피</td>
    <td> 접속경로<br>
      접속페이지 </td>
    <!-- <td><img src="g1.gif" width="<?=$val[graph_per]?>%" height="16"><br>
      </td> -->
  </tr>
  <? 
$mb_function = function_exists('mb_detect_order');
if($mb_function) {
	$ary[] = "ASCII";
	$ary[] = "EUC-KR";
	$ary[] = "JIS";
	$ary[] = "EUC-JP";
	$ary[] = "UTF-8";
	mb_detect_order($ary);
}	
	while($r=mysql_fetch_array($rs)) {
?>
  <tr> 
    <td width="110">
      <?=rg_date($r['counter_date'])?>
    </td>
    <td width="110">
      <?=$r['ip_ip']?>
    </td>
    <td> <a href="javascript:ref_open('<?=open_url($r['ref_url'])?>')" title="<?=$r['ref_url']?>">
      <?
//			$tmp=$r['ref_url'];
			$tmp=urldecode($r['ref_url']);
			if($mb_function) $tmp=iconv(mb_detect_encoding($tmp),"EUC-KR",$tmp);
			echo rg_cut_string($tmp, $url_length, "..");
//			echo mb_detect_encoding($tmp)."$tmp";
			?>
      </a><br> <a href="javascript:ref_open('<?=urlencode($r['page_url'])?>')" title="<?=$r['page_url']?>">
      <? // =rg_cut_string(urldecode($r['page_url']), $url_length, "..")?>
      <?
			$tmp=urldecode($r['page_url']);
			if($mb_function) $tmp=iconv(mb_detect_encoding($tmp),"EUC-KR",$tmp);	
			echo rg_cut_string($tmp, $url_length, "..");
			?>			
      </a> </td>
    <!-- <td><img src="g1.gif" width="<?=$val[graph_per]?>%" height="16"><br>
      </td> -->
  </tr>
  <? 
	}
?>
</table>
<?
	$p_str = "type=$type&time_start=$time_start&time_end=$time_end&sel=$sel&kw=$kw";
	include("navigation.php");
?>