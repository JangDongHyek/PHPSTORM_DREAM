<?
	// 통계정보를 읽어온다 
	$dbqry = "
		SELECT * 
		FROM `{$db_table_prefix}count_stat`
	";
	$rs=query($dbqry,$dbcon);

	// 레코드가 없다면(최소한1개의 레코드가 있어야 함) 
	if(mysql_num_rows($rs)==0) {
		$dbqry = "
				INSERT INTO `{$db_table_prefix}count_stat` 
					( `num` , `today_count` , `yesterday_count` , `total_count` ,
					  `max_conn_count` , `max_count` , `today_date` , `ip` ) 
				VALUES 
					( '', '1', '0', '1', 
						'$conn_count', '1', '$today_date', '$REMOTE_ADDR')
		";
		query($dbqry,$dbcon);		
		$dbqry = "
			SELECT * 
			FROM `{$db_table_prefix}count_stat`
		";
		$rs=query($dbqry,$dbcon);
	}
	$count_stat=mysql_fetch_array($rs);
?>
			  <table width="200" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC">
				<tr>
					<td height="1" colspan="2" bgcolor="#CCCCCC"></td>
				</tr>
				<tr height="25">
					<td width="100" bgcolor="f5f5f5"><div align="center">오늘</div></td>
					<td bgcolor="#FFFFFF" align=right><?=number_format($count_stat['today_count'])?></td>
				</tr>
				<tr>
					<td height="1" colspan="2" bgcolor="#CCCCCC"></td>
				</tr>
				<tr height="25">
					<td bgcolor="f5f5f5"><div align="center">어제</div></td>
					<td bgcolor="#FFFFFF" align=right><?=number_format($count_stat['yesterday_count'])?></td>
				</tr>
				<tr>
					<td height="1" colspan="2" bgcolor="#CCCCCC"></td>
				</tr>
				<tr height="25">
					<td bgcolor="f5f5f5"><div align="center">전체</div></td>
					<td bgcolor="#FFFFFF" align=right><?=number_format($count_stat['total_count'])?></td>
				</tr>
				<tr>
					<td height="1" colspan="2" bgcolor="#CCCCCC"></td>
				</tr>
				<tr height="25">
					<td bgcolor="f5f5f5"><div align="center">최대방문자</div></td>
					<td bgcolor="#FFFFFF" align=right><?=number_format($count_stat['max_count'])?></td>
				</tr>
				<tr>
					<td height="1" colspan="2" bgcolor="#CCCCCC"></td>
				</tr>
			</table>			