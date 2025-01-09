<?
	require_once("include/bbs.lib.inc.php");
	$mode_write=true;
	$mode = 'write';
	
	if($act=='ok') {
		
		$sql = "select * from $bbs_table  where rg_ext7='$rg_ext7' and rg_name='$rg_name' and rg_password='$rg_password' and rg_ext5='$rg_ext5'";
		$result = query($sql,$dbcon);
		$count = mysql_num_rows($result);
		$rows = mysql_fetch_array($result);
		if($count > 0){
			echo"<script>location.href='./edit.php?mode=edit&doc_num=$rows[rg_doc_num]&bbs_id=$bbs_id&rg_ext7=$rg_ext7)';</script>";
			exit;
		}
		else{
			echo"<script>alert('일치하는 정보가 없습니다. 다시 확인해 주세요!');history.go(-1);exit;</script>";
			exit;			
		}
	}
	//require_once("_header.php");
	include($skin_board_path."search.php");
	//require_once("_footer.php");

?>