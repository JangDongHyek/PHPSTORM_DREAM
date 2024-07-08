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
		rg_href('','그룹회원으로 가입이 되어 있습니다.\n그룹부터 탈퇴해주세요.','','back');		
	}
		
	if($act) {
		// 회원파일삭제 
		@unlink($member_photo_path.$login[mb_photo]);
		@unlink($member_icon_path.$login[mb_icon]);
		
		$dbqry = "
			DELETE FROM $db_table_member
			WHERE mb_num = '$mb_num'
		";
		$rs=query($dbqry,$dbcon);
		// 메모삭제
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
              </font>&nbsp;회원을 삭제합니다</td>
          </tr>
          <tr> 
            <td height="25"><p align="center"><span style=font-size=9pt;><font color=#404040>한번 
                삭제된 회원은 복구 할 수 없으니 정확한 판단 후 삭제해 주시기 바랍니다</font></span></p></td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" 삭     제 ">
        <table width="796" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td height="10"> </tr>
          <tr> 
            <td align=center><a href="javascript:history.back()" title="삭제취소"><img src="images/delmb_c.gif" border="0"></a>&nbsp;<a href="member_list.php?<?="$p_str&page=$page"?>" title="목록보기"><img src="images/list_mb.gif" border="0"></a></td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>