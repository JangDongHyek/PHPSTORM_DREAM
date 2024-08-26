<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	$chk = false;
	$dbqry="
		SHOW TABLES
	";
	$rs=query($dbqry,$dbcon);
	while($tmp = mysql_fetch_array($rs)) {
		if($tmp[0] == $db_table_zip) {
			rg_href('','이미 우편번호 테이블이 있습니다.','','back');		
		}
	}
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<?
	if($act) {
?>
<br>
<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td height="30" align="center" valign="middle" bgcolor="#f7f7f7">우편번호테이블과 
      데이타를 생성중입니다.</td>
  </tr>
</table>
      <?
		// 테이블 생성 
		$dbqry = "
			CREATE TABLE `{$db_table_zip}`
			$mysql_schema_zip
		";
		query($dbqry,$dbcon);
/*		
		Header("Content-Type: application/octet-stream"); 
		Header("Content-Disposition: attachment; filename=$file_name"); 
		
		// 데이타 추가.
		$fd = fopen ($site_path."include/zip.dat", "r");
		while (!feof ($fd)) {
				$buffer = fgets($fd, 4096);
				$tmp = eregi ( "\((.*)\)", $buffer,$tt);
				echo $tt[0]."\n";
		}
		fclose ($fd);
*/

		$fd = fopen ($site_path."include/zip.dat", "r");
		$i = 0;
		while (!feof ($fd)) {
			$data = fgets($fd, 4096);
			$data = trim($data);
			if($data) {
				$dbqry = "INSERT INTO `{$db_table_zip}` VALUES ".$data;
				query($dbqry,$dbcon);
				$i++;
				if(($i % 100) == 0) {
?>
<!-- <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="middle">
			<?=$i?> 건을 입력하였습니다.
		</td>
  </tr>
</table> -->
<?				fn_progress_bar($i, 44338);

				}
			}
		}
		fclose ($fd);
?>
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="30" valign="middle">
우편번호테이블 생성완료<br>
      <?=$i?> 건 입력 완료 하였습니다.<br>
      우편번호 테이블과 데이타를 정상적으로 생성하였습니다.		</td>
  </tr>
</table>
<br>
<?
//			query($dbqry,$dbcon);
	} else {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <br>
        <table width="70%" border="1" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="f7f7f7">우편번호테이블과 
              데이타를 생성합니다</td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" 확     인 ">
        <br>
        <p align=center><a href="admin.sub_menu2.php"><img src="images/list_mb.gif" border="0"></a></p>
</form></td>
  </tr>
</table>
<?
	}
?>
<? include("admin.footer.php"); ?>