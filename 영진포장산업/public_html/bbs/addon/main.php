<table width="100%" border="0" cellspacing="5" cellpadding="5">
<?
	// �Խ��� ����� �о �ֱٱ��� �о�´�.
	if($gr_num!='') $where_sql="where bbs_gr_num = '$gr_num'";
	$dbqry="
		SELECT *
		FROM `$db_table_bbs_cfg`
		$where_sql
		ORDER BY bbs_gr_num, bbs_title
	";
	$rs=query($dbqry,$dbcon);
	$i = 0;
	$gallery = '';
	while($R=mysql_fetch_array($rs)) {
		// �Խ��� ���̵� gallery��� ��ŵ
		if('gallery' == $R[bbs_id]) {
			$gallery = 'gallery';
			continue;
		}
		
		// ù��° �ֱٱ� ������ ��ǥ�� �����ش�
		if($i==1) {
/*
 <?=rg_vote_preview('default','1')?> 
 <?=rg_vote_preview('��Ų��','�˾�����')?> 
1�ΰ�� �˾�, �ƴѰ�� ���� â��
*/		$tmp=rg_vote_preview('default','1');
			if($tmp!='') {
?>
		<td width="50%" valign="top">
			<?=$tmp?>
		</td>
<?
				$i++;
			}
			unset($tmp);
		}

		if($i%2==0)
			echo "<tr>";
?>
		<td width="50%" valign="top">
			<?=rg_lastest('default',$R[bbs_id],'',5)?>
		</td>
<?
		if($i%2==1) echo "</tr>";
		$i++;
	}

	if($i<2) {
?>	
		<td width="50%" valign="top">
			<?=rg_vote_preview('default','1')?>
		</td>	
<?		
	}
?>
</table>
<?
	// �Խ��� �Ƶ� gallery�� �ִٸ�
	if($gallery!='') {
?>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
	<td width="100%">
<? // �����ϱ���� �̿��Ҽ� ������� default_gallery��Ų���� �ٲ۴�. ?>
		<?=rg_lastest('default_gallery_thumbnail','gallery','',4)?>
	</td>
</table>
<?
	}
?>
