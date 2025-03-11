<?
/*
보드 데이타베이스 삭제프로그램

실행방법
admin 디렉토리 안에 올리신후
보드경로/admin/drop_rg_tables.php 하신후
확인누르시면 됩니다.
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	if($act) {
		// 보드 관련테이블 삭제

		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		while($tmp = mysql_fetch_array($rs)) {
			if(eregi("^($db_table_prefix)",$tmp[0])) {
				query("drop table $tmp[0] ",$dbcon);
			}
		}
		rg_delete_board_file($data_path);
		rg_href("/","보드 관련 테이블을 전부 삭제하였습니다.");
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
              보드의 모든 게시판을 삭제합니다.<br>
							계정안의 파일은 직접 지우셔야 합니다.</td>
          </tr>
        </table>
        <br>
        <input type="submit" value="삭제">
        <a href="javascript:history.back()">취소</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>