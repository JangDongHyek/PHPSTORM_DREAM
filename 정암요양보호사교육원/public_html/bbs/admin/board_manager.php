<?
	$site_path = '../';
	require_once($site_path."include/bbs.lib.inc.php");

	if(!$auth[admin]) {
		echo '권한이 없습니다.';
		exit;
	}

	if($act) {
		sort($chk_rg_num);
		$chk_rg_nums=implode(",",$chk_rg_num);
		switch($mode) {
			case 'copy' : 
				while(list($key,$value)=each($chk_rg_num)) {
					rg_bbs_doc_copy($target_bbs_id,$bbs_id,$value);
				}
				break;
			case 'move' : 
				while(list($key,$value)=each($chk_rg_num)) {
					rg_bbs_doc_copy($target_bbs_id,$bbs_id,$value);
					rg_bbs_doc_del($bbs_id,$value);
				}
				break;
			case 'delete' :
				while(list($key,$value)=each($chk_rg_num)) {
					rg_bbs_doc_del($bbs_id,$value);
				}
				break;
			case 'category' :
				$dbqry="
					UPDATE `$bbs_table` SET
						rg_cat_num = '$rg_cat_num'
					WHERE rg_doc_num in ($chk_rg_nums)
				";
				query($dbqry,$dbcon);
				break;
		}
		echo '
<script language="JavaScript" type="text/JavaScript">
opener.location.reload();
self.close();
</script>
'; 
		exit;
	}
	
	// 그룹정보읽기
	$dbqry="
		SELECT *
		FROM `$db_table_group_cfg`
	";
	$rs=query($dbqry,$dbcon);
	$group_count = mysql_num_rows($rs);
	while($R=mysql_fetch_array($rs)) {
		$group_list[$R[gr_num]]=$R;
	}

	// 게시판 정보읽기
	$dbqry="
		SELECT *
		FROM `$db_table_bbs_cfg`
		WHERE bbs_id <> '$bbs_id' 
	";
	$rs=query($dbqry,$dbcon);
	$bbs_count = mysql_num_rows($rs);
	while($R=mysql_fetch_array($rs)) {
		$bbs_list[$R[bbs_num]]=$R;
	}
	
	// 카테고리 사용여부
	if($bbs_cfg[$C_USE_CATEGORY]==1) {
		$dbqry="
			SELECT *
			FROM `$category_table`
			ORDER BY cat_order
		";
		
		$rs=query($dbqry,$dbcon);
		while ($R=mysql_fetch_array($rs)) {
			$category_list[$R[cat_num]] = $R;
		}
		mysql_free_result($rs);
		unset($R);
		$show_category_begin = '';
		$show_category_end = '';
	} else {
		$show_category_begin = '<!--';
		$show_category_end = '-->';
	}
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Let's080 ver <?=$C_RGBOARD_VERSION?> - 관리자</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../admin/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" cellspacing="0" style="border-collapse:collapse;">
  <form name="form_1" method="post" enctype="multipart/form-data">
    <input name="act" type="hidden" value="ok">
    <input type=hidden name=bbs_id value='<?=$bbs_id?>'>
    <input type=hidden name=page value='<?=$page?>'>
    <input name="mode" type="hidden">
    <?
	while(list($key,$value)=each($chk_rg_num)) {
		echo "<input name=\"chk_rg_num[]\" type=\"hidden\" value=\"$value\">\n";
	}
?>
    <? if($bbs_count>0) { ?>
    <tr> 
      <td height="40" align="center" class="line1">게시판 선택: 
        <select name="target_bbs_id" id="select">
          <?
	while(list($key,$R)=each($bbs_list)) {
		echo "<option value=\"$R[bbs_id]\">$R[bbs_id]</option>";
	}
?>
        </select>
        <input name="submit" type="submit" onClick="form_1.mode.value='copy'" value=" 복 사 "> 
        <input name="submit" type="submit" onClick="form_1.mode.value='move'" value=" 이 동 ">
      </td>
    </tr>
    <? } ?>
<? if($bbs_cfg[$C_USE_CATEGORY]==1) { ?>
    <tr>
      <td height="50" align="center" class="line1">카테고리 선택: 
        <select name="rg_cat_num" id="rg_cat_num">
          <?
	while(list($key,$R)=each($category_list)) {
		echo "<option value=\"$R[cat_num]\">$R[cat_name]</option>";
	}
?>
        </select> 
        <input type="submit" onClick="form_1.mode.value='category'" value=" 변 경 "> 
      </td>
    </tr>
<? } ?>
    <tr> 
      <td height="50" align="center" class="line1"> <input type="submit" value=" 삭 제 " onClick="form_1.mode.value='delete'"> 
      </td>
    </tr>
  </form>
</table>
</body>
</html>