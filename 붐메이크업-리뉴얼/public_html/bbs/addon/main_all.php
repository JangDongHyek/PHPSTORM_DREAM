<?
  // 보안상 막는다.
	if ($hours < 1 || $hours > 168) {  // 1일로 제한한다 
		$s_hour = 24;
	} else {
		$s_hour = $hours; 
	}
	$bodys=array();
	$comments=array();
	// 게시판 목록을 읽어서 최근글을 읽어온다.
	if($gr_num!='') $where_sql="where bbs_gr_num = '$gr_num'";
	$dbqry="
		SELECT *
		FROM `$db_table_bbs_cfg`
		$where_sql
		ORDER BY bbs_gr_num, bbs_title
	";
	$rs=query($dbqry,$dbcon);
	$where_str = 'AND rg_secret = 0 AND rg_reg_date >= '.(time()-($s_hour*60*60));
	$where_str1 = ' AND cmt_reg_date >= '.(time()-($s_hour*60*60));
	while($R=mysql_fetch_array($rs)) {
		$bbs_table = $db_table_prefix.$R[bbs_id].$db_table_suffix_body;
		$commant_table = $db_table_prefix.$R[bbs_id].$db_table_suffix_comment;
		// 글내용
		$dbqry="
			SELECT `$bbs_table`.*
			FROM `$bbs_table`
			WHERE (1=1) $where_str
			$order_str
			LIMIT 0,100";
		$rs1=query($dbqry,$dbcon);
		while ($data=mysql_fetch_array($rs1)) {
			$tmp['type'] = 0;
			$tmp['bbs_id'] = $R[bbs_id];
			$tmp['rg_doc_num'] = $data['rg_doc_num'];
			$tmp['rg_title'] = $data['rg_title'];
			$tmp['rg_content'] = $data['rg_content'];
			$tmp['reg_date'] = $data['rg_reg_date'];
			$bodys[] = $tmp;
			unset($tmp);
		}
		// 코멘트 뽑기
		$dbqry="
			SELECT `$commant_table`.*
			FROM `$commant_table`
			WHERE (1=1) $where_str1
			$order_str
			LIMIT 0,100";
		$rs1=query($dbqry,$dbcon);
		while ($data=mysql_fetch_array($rs1)) {
			$tmp['type'] = 1;
			$tmp['bbs_id'] = $R[bbs_id];
			$tmp['cmt_doc_num'] = $data['cmt_doc_num'];
//			$tmp['rg_title'] = $data['rg_title'];
			$tmp['cmt_comment'] = $data['cmt_comment'];
			$tmp['reg_date'] = $data['cmt_reg_date'];
			$bodys[] = $tmp;
			unset($tmp);
		}

	}
	// 정렬
	function cmp($a, $b) {   
		if ($a['reg_date'] == $b['reg_date']) return 0;
		return ($a['reg_date'] > $b['reg_date']) ? -1 : 1;
	}
	usort($bodys, "cmp");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
	foreach($bodys as $v) {
?>
	<tr>
		<td>
<?
	if($v['type']==0) {
?>
			<a href='http://lets080.com/rgboard/view.php?bbs_id=<?=$v['bbs_id']?>&doc_num=<?=$v['rg_doc_num']?>'><font color=blue>▣ <?=rg_get_text($v['rg_title'],1)?></font><br>
			<?=rg_cut_string(rg_get_text($v['rg_content'],1),255,'...')?></a>
<? } else { ?>
			<a href='http://lets080.com/rgboard/view.php?bbs_id=<?=$v['bbs_id']?>&doc_num=<?=$v['cmt_doc_num']?>'><?=rg_cut_string(rg_get_text($v['cmt_comment'],1),255,'...')?></a>
<? } ?>
<hr>
		</td>
	</tr>
<?
	}
?>
</table>
<?
	unset($bodys);
	unset($comments);
?>