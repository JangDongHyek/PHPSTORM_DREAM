<?
	$site_path = '../';
	$site_url = '../';
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
			// "���̵�","�̸�","�̸���","�г���","�ֹι�ȣ"
			case 0 : 
				if(!empty($kw)) {
					switch ($ss[$ss_key[$i]]) {
						case 0 : 
									$qstr .= " AND `mb_id` LIKE '%$kw%'";
									break;
						case 1 : 
									$qstr .= " AND `mb_name` LIKE '%$kw%'";
									break;
						case 2 : 
									$qstr .= " AND `mb_email` LIKE '%$kw%'";
									break;
						case 3 : 
									$qstr .= " AND `mb_nick` LIKE '%$kw%'";
									break;
						case 4 : 
									$jumin = get_password_str($kw);
									$qstr .= " AND `mb_jumin` LIKE '$jumin'";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// ���� ���ǿ� ���� ���͸�
      case 1 : // ȸ������
				if($ss[$ss_key[$i]] != '-1') {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `mb_state` ";
				}
				break;
    }
	}

  if (empty($ot)) $ot = 10;
  switch ($ot) {
    case 10 : $ostr .= " ORDER BY mb_num DESC";		break;
    case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
    case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
    case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
    case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;
  }

	$dbqry="
		SELECT count(*) as row_count 
		FROM `$db_table_member`
		WHERE (1=1) $qstr
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);

?>	
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">ȸ������</font></td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;">
<form name="mb_search" method="post" enctype="multipart/form-data">
<input name="act" type="hidden" value="ok">
    <tr>
        
    <td> 
      <table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="200"> ȸ������ : 
              <select name="ss[1]" id="ss[1]" onChange="location='?ss[1]='+this.value">
                <?
	$ss_list = array('-1'=>'��ü',0=>'����',1=>'���δ��',2=>'����',3=>'Ż��');
	while(list($key,$value)=each($ss_list)) {
    if ($key==$ss[1])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
	}
?>
              </select> </td>
            <td align="center">�˻�: 
              <select name="ss[0]" id="ss[0]">
                <?
	$ss_list = array("���̵�","�̸�","�̸���","�г���","�ֹι�ȣ");
	while(list($key,$value)=each($ss_list))
    if ($key==$ss[0])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
?>
              </select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="�˻�" value="�˻�" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
              <input type="button" value="���" onclick="location.href='?'" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> &nbsp;&nbsp; 
              <input type="button" name="���ΰ�ħ" value="���ΰ�ħ" onclick="location.reload()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"></td>
            <td width="141" align="right">&nbsp;Total : &nbsp;&nbsp;
              <?=$page_info[total_rows]?>
              &nbsp;&nbsp;(1/1)</td>
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
    <td>
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr bgcolor="#f7f7f7"> 
            <td width="20">&nbsp; </td>
            <td width="30" height="24" align="center">NO</td>
            <td align="center">���̵�</td>
            <td width="50" align="center">����Ʈ</td>
            <td width="50" align="center">����</td>
            <td width="55" align="center">����</td>
            <td width="70" align="center">������</td>
            <td width="70" align="center">�α���</td>
            <td width="100" align="center">�α��ξ�����</td>
            <td width="40" align="center">����</td>
            <td width="35" align="center">����</td>
            <td width="35" align="center">����</td>
          </tr>
          <?
	$dbqry="
		SELECT *
		FROM `$db_table_member`
		WHERE (1=1) $qstr
		$ostr
		LIMIT $page_info[offset],$page_info[rows] ";
	
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$no--;
?>
          <tr onmouseover='this.style.backgroundColor="#DAEDED"' onmouseout='this.style.backgroundColor=""'> 
            <td width="20" height="24" align="center"> <input name="bg_num[]" type="checkbox" id="bg_num[]2" value="<?=$R[bg_num]?>"> 
            </td>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td width="153"> 
						&nbsp;<span onClick="rg_layer('<?=$site_url?>', '','<?=$R[mb_id]?>', '<?=$R[mb_name]?>', '<?=$R[mb_email]?>', '<?=$R[mb_homepage]?>', '1','<?=$site_url?>admin/images/')" style='cursor:hand;'><?=$rg_mb_icon?> <?=$R[mb_id]?></span>
            </td>
            <td align="center"> 
              <?=$R[mb_point]?>
            </td>
            <td align="center"> 
              <?=$R[mb_level]?>
            </td>
            <td align="center"> 
              <?=$mb_states[$R[mb_state]]?>
            </td>
            <td align="center"> 
              <?=rg_date($R[mb_reg_date],'%Y-%m-%d')?>
            </td>
            <td align="center"> 
              <?=($R[mb_login_date]==0)?'-':rg_date($R[mb_login_date],'%Y-%m-%d')?>
            </td>
            <td align="center"> 
              <?=$R[mb_login_ip]?>
            </td>
            <td align="center"> 
              <?=$R[mb_log_count]?>
            </td>
            <td align="center"><a href="member_edit.php?<?=$p_str?>&mode=edit&mb_num=<?=$R[mb_num]?>">����</a></td>
            <td align="center"><a href="member_delete.php?<?=$p_str?>&page=<?=$page?>&mb_num=<?=$R[mb_num]?>">����</a></td>
          </tr>
          <?

	}
?>
        </table>
        <div align="center"> 
<? include("navigation.php"); ?>
        </div>
        <table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td> <a href="member_edit.php?<?=$p_str?>&page=<?=$page?>" title="�ű�ȸ�����"><img src="images/plus_mb.gif" width="90" height="25" border="0"></a>&nbsp;<a href="#" onClick="javascript:window.open('member_mail.php','mailing', 'left=50,top=50,width=650,height=650,scrollbars=1');">[ȸ�����Ϻ�����]</a>&nbsp;<a href="#" onClick="javascript:window.open('member_mail.php?condition=<?=urlencode("SELECT * FROM $db_table_member WHERE (1=1) ".$qstr)?>','mailing', 'left=50,top=50,width=650,height=650,scrollbars=1');">[���ǿ� 
              �ش��ϴ� ȸ������ ���Ϻ�����]</a></td>
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