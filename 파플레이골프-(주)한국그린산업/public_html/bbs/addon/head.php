<?
	if(realpath($_SERVER[SCRIPT_FILENAME]) == realpath(__FILE__)) exit;

	// �׷������б�
	$dbqry="
		SELECT *
		FROM `$db_table_group_cfg`
	";
	$rs=query($dbqry,$dbcon);
	while($R=mysql_fetch_array($rs)) {
		$group_list[$R[gr_num]]=$R;
	}
	$gr_name='';
?>	
<!-- // ��ܸ޴� -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				  <td>&nbsp; <a href="<?=$site_url?>addon.php?file=main.php">home</a>&nbsp;| 
            <a href="<?=$site_url?>vote_main.php">��ǥ</a>&nbsp; 
            <?
	foreach($group_list as $key => $val) {
?>
            |&nbsp;<a href="<?=$site_url?>addon.php?file=main.php&gr_num=<?=$val[gr_num]?>"><?=$val[gr_name]?></a>&nbsp; 
            <?
	}
?></td>  
          <td width="150" align="right">&nbsp;</td>
			</tr>
		</table>

		</td>
  </tr>
</table>
<!-- ��ܸ޴� // -->
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr> 
    <td width="180" align="center" valign="top">
<!-- // ���ʸ޴� -->
		<img width=1 height=10><br>
    <?=rg_outlogin('rgro')?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<img width=1 height=10><br>
<?
	// �Խ��� ����� �о �޴��� ����� ������.
	$dbqry="
		SELECT *
		FROM `$db_table_bbs_cfg`
		ORDER BY bbs_gr_num, bbs_title
	";
	$rs=query($dbqry,$dbcon);
	while($R=mysql_fetch_array($rs)) {
		if($gr_name != $group_list[$R[bbs_gr_num]][gr_name]) {
			$gr_name = $group_list[$R[bbs_gr_num]][gr_name];
?>
<table width="100%" border="0" cellspacing="6" cellpadding="0">
	<td align="center">
		<b><a href="<?=$site_url?>addon.php?file=main.php&gr_num=<?=$group_list[$R[bbs_gr_num]][gr_num]?>">[<?=$gr_name?>]</a></b>
	</td>
</table>
<?
		}
?>
�� <a href="<?=$site_url?>list.php?bbs_id=<?=$R[bbs_id]?>"><?=$R[bbs_title]?></a><br>
<?
	}
?>
				</td>
			</tr>
		</table>
			<!-- ������Ȳ -->
    	<? // include($site_path."addon/connect_state.php")?>
			<br>
			<!-- ������� -->
			<? require_once($site_path.'counter/counter.lib.php')?>
			<? include($site_path."addon/count_stat.php")?>
			<br>
			<!-- �����ڸ�� -->
			<? include($site_path."addon/connect_list.php")?>
			<br>
    
    <!-- ���ʸ޴� // -->
  </td>
  <td valign="top" align="center">