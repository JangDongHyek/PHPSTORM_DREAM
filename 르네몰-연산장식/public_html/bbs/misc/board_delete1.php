<?
/*
게시판아이디 없이 생성된 게시판 삭제프로그램

실행방법
admin 디렉토리 안에 올리신후
보드경로/admin/board_delete1.php 하신후
확인누르시면 됩니다.

아래 메시지가 나오면 실행할 필요가 없습니다.
===========================================
DROP TABLE `rg__body` 
테이블 'rg__body'는 알수 없음
===========================================
신경안쓰셔도 됩니다.
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	$bbs_table = $db_table_prefix;
	if($act) {
		// 테이블에 게시판 데이타 수정
		$dbqry="
			DELETE FROM `$db_table_bbs_cfg`
			WHERE `bbs_num` = '$bbs_num'
		";
			query($dbqry,$dbcon);

		// 게시판테이블 삭제
		$dbqry = "
				DROP TABLE `{$bbs_table}{$db_table_suffix_body}`
			";
			query($dbqry,$dbcon);
		// 카테고리테이블 삭제
		$dbqry = "
				DROP TABLE `{$bbs_table}{$db_table_suffix_category}`
			";
			query($dbqry,$dbcon);
		// 코멘트테이블 삭제
		$dbqry = "
				DROP TABLE `{$bbs_table}{$db_table_suffix_comment}`
		";
		query($dbqry,$dbcon);
		
		// 그룹 게시판수 감소
		$dbqry="
			UPDATE `$db_table_group_cfg` SET
				`gr_total_bbs` = `gr_total_bbs` - 1
			WHERE gr_num='$R[bbs_gr_num]'
		";
		query($dbqry,$dbcon);
			
		rg_href("../admin/index.php");
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
              게시판아이디가 없는 게시판 삭제합니다. </td>
          </tr>
        </table>
        <br>
        <input type="submit" value="삭제">
        <a href="javascript:history.back()">취소</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>