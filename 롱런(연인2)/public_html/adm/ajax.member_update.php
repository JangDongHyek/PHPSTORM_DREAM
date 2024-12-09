<?
/**********************************
회원관리 
switch	: 상태 on,off
hide	: 숨김,복귀
**********************************/
include_once('./_common.php');

if ($mode == "switch") {
	$mb_switch = ($_POST['flag'] == "on")? "off" : "on";

	$sql = "UPDATE g5_member SET
			mb_switch = '{$mb_switch}'
			WHERE mb_id = '{$_POST['mb_id']}'";
	sql_query($sql);

} else if ($mode == "hide") {
	$mb_hide = ($_POST['flag'] == "hide")? "Y" : "N";
	
	foreach ($_POST['mb_id'] as $key=>$val) {
		$sql = "UPDATE g5_member SET
				mb_hide = '{$mb_hide}'
				WHERE mb_id = '{$val}'";
		sql_query($sql);
	}
}

?>