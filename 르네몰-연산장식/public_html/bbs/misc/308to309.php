<?
/*
보드 3.0.8 에서 3.0.9 로 디비 변환 프로그램

실행방법
admin 디렉토리 안에 올리신후
보드경로/admin/308to309.php 하신후
확인누르시면 됩니다.
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	if($act) {
		// 보드 테이블 변환

		$dbqry="ALTER TABLE `$db_table_bbs_cfg` CHANGE `bbs_upload_ext` `bbs_file1_ext` VARCHAR( 255 ) NOT NULL";
		query($dbqry,$dbcon);
		$dbqry="ALTER TABLE `$db_table_bbs_cfg` ADD `bbs_file2_ext` VARCHAR( 255 ) NOT NULL AFTER `bbs_file1_ext`";
		query($dbqry,$dbcon);
		$dbqry="ALTER TABLE `$db_table_bbs_cfg` CHANGE `bbs_max_file_size` `bbs_file1_size` INT( 20 ) DEFAULT '0' NOT NULL ";
		query($dbqry,$dbcon);
		$dbqry="ALTER TABLE `$db_table_bbs_cfg` ADD `bbs_file2_size` INT( 20 ) NOT NULL AFTER `bbs_file1_size`";
		query($dbqry,$dbcon);

		rg_href("/","데이타베이스 변환이 완료되었습니다.");
	}

?>
<? include("../admin/admin.header.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <table width="100%" cellspacing="0" style="border-collapse:collapse;">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="silver" class="line1"> 
              보드 데이타베이스를 3.0.8 에서 3.0.9로 변환합니다..<br>
							에러및 데이타 유실에대한 책임을 지지 않사오니 미리 백업해주시기 바랍니다.</td>
          </tr>
        </table>
        <br>
        <input type="submit" value=" 확 인 ">
        <a href="javascript:history.back()">취소</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>