<?
	require_once("include/bbs.lib.inc.php");
	$mode_write=true;
	$mode = 'write';
	
	if($act=='ok') {
		$start_date = date("Y-m-d", strtotime("$start_date"));
		$end_date = date("Y-m-d", strtotime("$end_date"));
		$start_date2 = date("Y-m-d", strtotime("$start_date2"));
		$end_date2 = date("Y-m-d", strtotime("$end_date2"));

		$sql = "update sungsugi set start_date='$start_date',end_date='$end_date',use_date='$use_date',start_date2='$start_date2',end_date2='$end_date2',use_date2='$use_date2' where seq_num='1'";
		$result = query($sql,$dbcon);

		echo"<script>alert('정보가 변경되었습니다.');location.href='./list.php?bbs_id=yeyak';</script>";
		exit;
	}
	//require_once("_header.php");
	include($skin_board_path."sungsugi.php");
	//require_once("_footer.php");

?>