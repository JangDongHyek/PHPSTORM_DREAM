<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	$R=rg_get_group_cfg($gr_num,1);
	
	$dbqry="
		SELECT count(`bbs_num`) as gr_total_bbs						
		FROM `$db_table_bbs_cfg`
		WHERE bbs_gr_num = $gr_num
	";
	$rs=query($dbqry,$dbcon);
	$tmp=mysql_fetch_array($rs);
	$R['gr_total_bbs'] = $tmp['gr_total_bbs'];
	unset($tmp);
	
	if($R[gr_total_bbs] > 0) {
		rg_href('','�׷쳻 �Խ����� �����Ұ�� ������ �Ҽ� �����ϴ�.\n�Խ����� �����Ͻ��� �׷��� �����ϼ���.','','back');
	}
	if($act) {
		// �׷����� ����
		$dbqry="
			DELETE FROM `$db_table_group_cfg`
			WHERE `gr_num` = '$gr_num'
		";
		query($dbqry,$dbcon);
		// �׷�ȸ�� ����
		$dbqry="
			DELETE FROM `$db_table_group_member`
			WHERE `gm_gr_num` = '$gr_num'
		";
		query($dbqry,$dbcon);
		rg_href("group_list.php?$p_str");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="<?=$mode?>">
<input name="gr_num" type="hidden" value="<?=$gr_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <br>
        <table border="1" cellpadding="0" cellspacing="0" width="70%" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="#f7f7f7"> 
              <font color=red>
              <?=$R[gr_id]?>
              </font>&nbsp;�׷��� �����մϴ� </td>
          </tr>
          <tr> 
            <td height="25"><p align="center"><span style=font-size=9pt;><font color="#404040">�ѹ� 
                ������ �׷��� ���� �� �� ������ ��Ȯ�� �Ǵ� �� ������ �ֽñ� �ٶ��ϴ�</font></span></p></td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" ��     �� ">
        <table width="796" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td height="10"></td>
          </tr>
          <tr>
            <td align=center><a href="javascript:history.back()" title="�������"><img src="images/delmb_c.gif" width="66" height="25" border="0"></a>&nbsp;<a href="group_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/list_mb.gif" width="66" height="25" border="0"></a> 
            </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>