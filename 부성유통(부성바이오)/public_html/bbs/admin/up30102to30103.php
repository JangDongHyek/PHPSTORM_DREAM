<?
/*
보드 3.1.2 에서 3.1.2 로 디비 변환 프로그램
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	if($act) {
		// 보드 테이블 변환
		$dbqry="ALTER TABLE `{$db_table_prefix}vote_cfg`
		        ADD `vt_cmt_count` INT UNSIGNED NOT NULL";
		query($dbqry,$dbcon);
		rg_href("admin.sub_menu2.php","데이타베이스 변환이 완료되었습니다.");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <br>
        <table width="70%" border="1" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="f7f7f7"><p><br>
                보드 데이타베이스를 3.1.2 에서 3.1.3로 변환합니다..<br>
                에러및 데이타 유실에대한 책임을 지지 않사오니 미리 백업해주시기 바랍니다.<br>
                <br>
                변환 내역<br>
                1. 투표테이블 변환<br>
                <br>
              </p>
              </td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" 확     인 ">
        <br>
        <br>
        <a href="admin.sub_menu2.php"><img src="images/list_mb.gif" border="0"></a> 
        <br>
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>