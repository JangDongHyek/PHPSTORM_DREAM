<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	$mem=rg_get_member_info($mb_num,1);
	$dbqry="
		SELECT count(*) as gm_gr_count
		FROM `$db_table_group_member`
		WHERE `gm_mb_num` = '$mem[mb_num]'
	";
	$rs=query($dbqry,$dbcon);
	$tmp = mysql_fetch_array($rs);
	if($tmp[0]>0) {
		rg_href('','�׷�ȸ������ ������ �Ǿ� �ֽ��ϴ�.\n�׷���� Ż�����ּ���.','','back');		
	}
		
	if($act) {
		// ȸ�����ϻ��� 
		@unlink($member_photo_path.$login[mb_photo]);
		@unlink($member_icon_path.$login[mb_icon]);
		
		$dbqry = "
			DELETE FROM $db_table_member
			WHERE mb_num = '$mb_num'
		";
		$rs=query($dbqry,$dbcon);
		// �޸����
		$dbqry="
			DELETE FROM `$db_table_memo`
			WHERE mo_recv_mb_num='$mb_num'
				 OR mo_send_mb_num='$mb_num'
		";
		query($dbqry,$dbcon);
		rg_href("member_list.php?$p_str");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
<input name="mb_num" type="hidden" value="<?=$mb_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <br>
        <table width="796" border="1" cellpadding="0" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" bgcolor=#f7f7f7 valign="middle"> <font color=red>
              <?=$mem[mb_id]?>
              </font>&nbsp;ȸ���� �����մϴ�</td>
          </tr>
          <tr> 
            <td height="25"><p align="center"><span style=font-size=9pt;><font color=#404040>�ѹ� 
                ������ ȸ���� ���� �� �� ������ ��Ȯ�� �Ǵ� �� ������ �ֽñ� �ٶ��ϴ�</font></span></p></td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" ��     �� ">
        <table width="796" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td height="10"> </tr>
          <tr> 
            <td align=center><a href="javascript:history.back()" title="�������"><img src="images/delmb_c.gif" border="0"></a>&nbsp;<a href="member_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/list_mb.gif" border="0"></a></td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>