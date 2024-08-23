<table width="100%" border="0" cellspacing="5" cellpadding="5">
<?
	// 게시판 목록을 읽어서 최근글을 읽어온다.
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
		// 게시판 아이디가 gallery라면 스킵
		if('gallery' == $R[bbs_id]) {
			$gallery = 'gallery';
			continue;
		}
		
		// 첫번째 최근글 다음에 투표를 보여준다
		if($i==1) {
/*
 <?=rg_vote_preview('default','1')?> 
 <?=rg_vote_preview('스킨명','팝업여부')?> 
1인경우 팝업, 아닌경우 현재 창에
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
	// 게시판 아디가 gallery이 있다면
	if($gallery!='') {
?>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
	<td width="100%">
<? // 섬네일기능을 이용할수 없을경우 default_gallery스킨으로 바꾼다. ?>
		<?=rg_lastest('default_gallery_thumbnail','gallery','',4)?>
	</td>
</table>
<?
	}
?>
