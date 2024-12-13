<?
// 전체회원수를 표시하고 싶을경우 아래 주석을 풀어주세요.
/*

	$dbqry="
		SELECT count(*) as member_count 
		FROM `$db_table_member`
		WHERE (1=1) AND mb_state=0
	";
	$rs = query($dbqry,$dbcon);
	extract(mysql_fetch_array($rs));
?>
회원수 : <?=$member_count?>
			<br>
<?
*/
?>				
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td align="center">
      <strong>[접속현황]</strong>
		</td>
  </tr>
  <tr>
    <td>
회원 : <?=rg_get_connect_count('login')?><br>
손님 : <?=rg_get_connect_count('nologin')?><br>
전체 : <?=rg_get_connect_count()?><br>
		</td>
  </tr>
</table>