<?
// ��üȸ������ ǥ���ϰ� ������� �Ʒ� �ּ��� Ǯ���ּ���.
/*

	$dbqry="
		SELECT count(*) as member_count 
		FROM `$db_table_member`
		WHERE (1=1) AND mb_state=0
	";
	$rs = query($dbqry,$dbcon);
	extract(mysql_fetch_array($rs));
?>
ȸ���� : <?=$member_count?>
			<br>
<?
*/
?>				
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td align="center">
      <strong>[������Ȳ]</strong>
		</td>
  </tr>
  <tr>
    <td>
ȸ�� : <?=rg_get_connect_count('login')?><br>
�մ� : <?=rg_get_connect_count('nologin')?><br>
��ü : <?=rg_get_connect_count()?><br>
		</td>
  </tr>
</table>