<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td align="center"><strong>[현재접속자명단]</strong></td>
  </tr>
  <tr>
    <td>
<?
	$dbqry = "
		SELECT `$db_table_connect`.*,
		        mb_id,mb_homepage,mb_open_info,mb_icon,mb_nick,
						mb_level, mb_point, mb_log_count
		FROM `$db_table_connect` LEFT JOIN `$db_table_member`
			ON con_mb_id = mb_id
		ORDER BY con_date DESC
	";
	$rs = query($dbqry,$dbcon);
	while($R=mysql_fetch_array($rs)) {
		if($R[mb_icon]) { // 아이콘이 있다면 
			$R[mb_icon] = "<img src=\"$member_icon_url$R[mb_icon]\" border=0 align=absbottom>";
		} else {
			$R[mb_icon] = '';
		}

		if(!$R[con_mb_id]) {
			if(!$auth[admin])
				$R[con_ip] = rg_hidden_ip($R[con_ip]);
?>
<?=$R[con_ip]?><br>
<?
		} else {
?>
<span onClick="rg_layer('<?=$site_url?>', '','<?=$R[mb_id]?>', '', '', '<?=$R[mb_homepage]?>', '<?=$R[mb_open_info]?>','<?=$skin_site_url?>')" style='cursor:hand;' title="아이디 : <?=$R[con_mb_id]?>

레벨 : <?=$R[mb_level]?> 
포인트 : <?=$R[mb_point]?> 
접속횟수 : <?=$R[mb_log_count]?>"><?=$R[mb_icon]?> <?=$R[mb_nick]?></span><br>
<?
		}
	}
?>		</td>
  </tr>
</table>