<?
	require_once("include/bbs.lib.inc.php");
	$mode_write=true;
	$mode = 'write';
	
	if($act=='ok') {
		$sql = "update rg_member set mb_password=password('$mb_password') where mb_level='10'";
		$result = query($sql,$dbcon);

		echo"<script>alert('비밀번호가 변경되었습니다.');location.href='./list.php?bbs_id=yeyak';</script>";
		exit;
	}
	//require_once("_header.php");
	include($skin_board_path."password_change.htm");
	//require_once("_footer.php");

?>