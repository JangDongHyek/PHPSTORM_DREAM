<?
	$site_path = '../';
	if(!isset($ss[1])) $ss[1] = '-1';
	require_once($site_path."include/admin.lib.inc.php");
/*	
	if(!empty($act) && !empty($nums)) $sel_nums=implode(",",$nums);

	switch($act) {
		case 'bg_bad' :
				$dbqry="
					UPDATE `blog_body` SET
						bg_bad = '$bg_bad_sel'
					WHERE bg_num in ($sel_nums)
				";
				query($dbqry,$dbcon);
				go_href("?$p_str&page=$page");
				break;
	}
*/
  $qstr='';
	for($i=0;$i<count($ss_key);$i++) {
    switch ($ss_key[$i]) {
			/***********************************************************************/
			// �˻���� �˻�
			case 0 : 
				if(!empty($kw)) {
					switch ($ss[$ss_key[$i]]) {
						case 0 : 
									$qstr .= " AND `gr_id` LIKE '%$kw%'";
									$doc_title = "'$kw' �˻� ���";
									break;
						case 1 : 
									$qstr .= " AND `gr_name` LIKE '%$kw%'";
									$doc_title = "'$kw' �˻� ���";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// ���� ���ǿ� ���� ���͸�
      case 1 : // ȸ������
				if($ss[$ss_key[$i]] != '-1') {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `gr_state` ";
				}
				break;
    }
	}
/*
  if (empty($ot)) $ot = 10;
  switch ($ot) {
    case 10 : $ostr .= " ORDER BY BBSNum";		break;
    case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
    case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
    case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
    case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;
  }
*/
	$dbqry="
		SELECT count(*) as row_count 
		FROM `$db_table_group_cfg`
		WHERE (1=1) $qstr
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);

?>	
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="37" valign="top" background="images/line.gif" style="padding-top:12">&nbsp;<img src="images/t03.gif" width="65" height="13"></td>
  </tr>
</table>
<br>
<table width="850" align="center" cellspacing="0" style="border-collapse:collapse;">
<form name="mb_search" method="post" enctype="multipart/form-data" onsubmit='return formcheck1()'>
<input name="act" type="hidden" value="ok">
    <tr>
        
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          <tr> 
            <td width="200" height="33"> ���� : 
              <select name="ss[1]" id="ss[1]" onChange="location='?ss[1]='+this.value">
                <?
	$ss_list = array('-1'=>'��ü',0=>'����',1=>'���δ��',2=>'���');
	while(list($key,$value)=each($ss_list)) {
    if ($key==$ss[1])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
	}
?>
              </select> </td>
            <td align="right">�˻�: 
              <select name="ss[0]" id="ss[0]">
                <?
	$ss_list = array("�׷���̵�","�׷��̸�");
	while(list($key,$value)=each($ss_list)) {
    if ($key==$ss[0])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
	}
?>
              </select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="�˻�" value="�˻�" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
              <input type="button" value="���" onclick="location.href='?'" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> &nbsp;&nbsp; 
              <input type="button" name="���ΰ�ħ" value="���ΰ�ħ" onclick="location.reload()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"></td>
          </tr>
        </table>
    </td>
    </tr>
</form>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck2()' action="?<?=$p_str?>">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td align="center">
        <table width="850" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr bgcolor="#f7f7f7"> 
            <td width="1">&nbsp; </td>
            <td width="30" height="24" align="center">NO</td>
            <td width="70" align="center">�׷���̵�</td>
            <td width="70" align="center">������</td>
            <td align="center">�̸�</td>
            <td width="60" align="center">����</td>
            <td width="40" align="center">ȸ��</td>
            <td width="40" align="center">�Խ���</td>
            <td width="130" align="center">������</td>
            <td width="40" align="center">����</td>
            <td width="40" align="center">����</td>
          </tr>
<?
// 2003-10-15 �Խ���,ȸ������ �����ؼ� ���ؿ�
// gr_total_member �� gr_total_bbs �ʵ�� ��������
	$dbqry="
		SELECT `gr_num`,`gr_id`,`gr_owner_no`,`gr_name`,`gr_state`,`gr_reg_date`,
						count(DISTINCT `$db_table_group_member`.`gm_num`) as gr_total_member,
						count(DISTINCT `$db_table_bbs_cfg`.`bbs_num`) as gr_total_bbs						
		FROM `$db_table_group_cfg` 
		  LEFT JOIN `$db_table_group_member`
			ON `$db_table_group_cfg`.`gr_num` = `$db_table_group_member`.`gm_gr_num`
		  LEFT JOIN `$db_table_bbs_cfg`
			ON `$db_table_group_cfg`.`gr_num` = `$db_table_bbs_cfg`.`bbs_gr_num`
		WHERE (1=1) $qstr
		$ostr
		GROUP BY 1,2,3,4,5,6
		LIMIT  $page_info[offset],$page_info[rows] ";
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$R[bg_title]=nl2br(htmlspecialchars($R[bg_title]));
		$R[bg_cmt_cnt]=($R[bg_cmt_cnt]>0)?"($R[bg_cmt_cnt])":"";
		$blog_link="http://{$R[mb_id]}.$main_domain/blog/blog_list.php?ss[10]=$R[bg_cat_num]#blog_$R[bg_num]";
		$no--;
		/*
		if(!empty($kw)) {
			switch ($ss[0]) {
				case 0 : 
							$R[bg_title] = str_replace($kw, "<font color=\"#FF9900\"><b>{$kw}</b></font>", $R[bg_title]);
							break;
				case 1 : 
							$R[bg_writer] = str_replace($kw, "<font color=\"#FF9900\"><b>{$kw}</b></font>", $R[bg_writer]);
							break;
			}
		}*/
?>
          <tr onmouseover='this.style.backgroundColor="#DAEDED"' onmouseout='this.style.backgroundColor=""'> 
            <td width="1" align="center"> <input name="bg_num[]" type="checkbox" id="bg_num[]2" value="<?=$R[gr_num]?>"> 
            </td>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td width="0" align="center"> 
              <?=$R[gr_id]?>
            </td>
            <td align="center"> 
              <?=$R[gr_owner_no]?>
            </td>
            <td>
              <?=$R[gr_name]?>
            </td>
            <td align="center"> 
              <?=$gr_states[$R[gr_state]]?>
            </td>
            <td align="center"> 
              <?=$R[gr_total_member]?>
            </td>
            <td align="center"> 
              <?=$R[gr_total_bbs]?>
            </td>
            <td align="center"> 
              <?=rg_date($R[gr_reg_date])?>
            </td>
            <td align="center"><a href="group_edit.php?<?=$p_str?>&page=<?=$page?>&mode=edit&gr_num=<?=$R[gr_num]?>">����</a></td>
            <td align="center"><a href="group_delete.php?<?=$p_str?>&page=<?=$page?>&mode=edit&gr_num=<?=$R[gr_num]?>">����</a> 
            </td>
          </tr>
          <?
	}
?>
        </table>
        <? include("navigation.php"); ?> 
        <table width="850" align="center">
          <tr> 
            <td width="796"> <a href="group_edit.php?<?=$p_str?>&page=<?=$page?>" title="�űԱ׷���"><img src="images/plus_group.gif" width="90" height="25" border="0"></a></td>
          </tr>
        </table>
        <!--				
        <p align="center"> 
          <select name="bg_bad_sel" size="1" id="bg_bad_sel">
            <option value="0">����ī�װ��� ���̰� �ϱ�</option>
            <option value="1">����ī�װ��� �Ⱥ��̰� �ϱ�</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='bg_bad'" value="Ȯ��">
          &nbsp; 
          <select name="mb_type_sel" id="mb_type_sel">
            <option value="0">�Ϲ�ȸ������</option>
            <option value="1">������ȸ������</option>
            <option value="2">������ȸ������</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='mb_type'" value="Ȯ��">
          &nbsp; 
          <select name="bg_tag_sel" id="bg_tag_sel">
            <option value="0">�Ϲݱ�</option>
            <option value="1">�����ֿ��</option>
          </select>
          <input name="submit2" type="submit" onclick="document.mb_list.act.value='bg_tag'" value="Ȯ��">
        &nbsp; 
        <select name="bg_cat_sel" id="bg_cat_sel">
<?
	reset($cat_info);
	while (list ($key, $R) = each ($cat_info)) {
		echo "<option value=\"$R[bg_cat_num]\">$R[bg_cat_name]</option>";		
	}
?>
        </select>
        <input name="submit22" type="submit" onclick="document.mb_list.act.value='bg_cat'" value="Ȯ��">
        </p> -->
  	</td>
  </tr>
 </form>
</table>
<script language="JavaScript" type="text/JavaScript">
	var f = document.mb_form;
	function formcheck2()
	{
		if(!list_checkbox(document.mb_list,'bg_num[]')) {
			alert('�ϳ� �̻������ּ���.');
			return false;
		}
		return true;
	}
</script>
<? include("admin.footer.php"); ?>