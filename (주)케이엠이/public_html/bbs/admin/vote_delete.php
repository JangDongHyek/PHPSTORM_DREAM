<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	$R=rg_get_vote_cfg($vt_num);
	if($act) {
		if($vt_num!='') {
			// 테이블에 데이타 삭제
			$dbqry="
				DELETE FROM `{$db_table_vote}_cfg`
				WHERE `vt_num` = '$vt_num'
			";
			query($dbqry,$dbcon);
			
			// 항목삭제
			$qry="
				DELETE FROM `{$db_table_vote}_item`
				WHERE `vit_vt_num` = '$vt_num'
			";
			$rs=query($qry,$dbcon);
			
			// 코멘트삭제
			$qry="
				DELETE FROM `{$db_table_vote}_cmt`
				WHERE `vtc_vt_num` = '$vt_num'
			";
			$rs=query($qry,$dbcon);

			// 아이피삭제
			$qry="
				DELETE FROM `{$db_table_vote}_ip`
				WHERE `vip_vt_num` = '$vt_num'
			";
			$rs=query($qry,$dbcon);

		}
		rg_href("vote_list.php?$p_str&page=$page");
	}
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center">
<form action="" method="post" enctype="multipart/form-data" name="vote_edit" id="vote_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="<?=$mode?>">
<input name="vt_num" type="hidden" value="<?=$vt_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <br>
        <table border="1" cellpadding="0" cellspacing="0" width="70%" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="#f7f7f7"> 
              <font color=red>
              <?=$R[vt_question]?>
              </font>&nbsp;의&nbsp;투표사항을 삭제합니다 </td>
          </tr>
          <tr>
            <td height="25" align=center><span style=font-size=9pt;><font color=#404040>한번 
              삭제된 정보는 복구 할 수 없으니 정확한 판단 후 삭제해 주시기 바랍니다</font></span></td>
          </tr>
        </table>
        <br>
        <input type="submit" class="button1" value=" 삭  제 ">
        <table width="796" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td height="10"> </tr>
          <tr> 
            <td align=center><a href="javascript:history.back()"><img src="images/delmb_c.gif" width="66" height="25" border="0"></a>&nbsp;<a href="vote_list.php?<?="$p_str&page=$page"?>"><img src="images/list_mb.gif" width="66" height="25" border="0"></a></td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>