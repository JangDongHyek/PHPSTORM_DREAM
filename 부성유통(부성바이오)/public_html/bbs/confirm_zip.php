<?
	require_once("include/lib.inc.php");
	
	if($dong) {
		$list_begin = '';
		$list_end = '';
	}	else {
		$list_begin = '<!--';
		$list_end = '-->';
	}
	
	include($skin_site_path."confirm_zip_head.php");

	if($dong) {
		$dbqry="
			SELECT * 
			FROM `$db_table_zip`
			WHERE zp_dong like '%$dong%'
			ORDER BY zp_num
			LIMIT 0, 1000
		";
		$rs=query($dbqry,$dbcon);
		
		while($R=mysql_fetch_array($rs)) {
			$address1 = "$R[zp_sido] $R[zp_gugun] $R[zp_dong] $R[zp_bunji]";
			$address2 = "$R[zp_sido] $R[zp_gugun] $R[zp_dong]";
			$zip_code = substr($R[zp_code],0,3).'-'.substr($R[zp_code],3,3);
			include($skin_site_path."confirm_zip_main.php");
		}
	}
		
	include($skin_site_path."confirm_zip_foot.php");
	
?>