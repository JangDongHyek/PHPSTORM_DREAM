<?php
/*****************************************
계육업체 등록, 수정, 삭제
*****************************************/
include_once('./_common.php');

if(!$is_admin && $member['mb_level'] < 3){
	alert('관리자 또는 임직원으로 로그인해주세요',G5_URL);
	exit;
}

if ($w == '') {
	$sql = "INSERT INTO g5_ck_company SET
			co_name = '{$co_name}',
			co_use = '{$co_use}'";

} else if ($w == 'u') {
	$sql = "UPDATE g5_ck_company SET
			co_name = '{$co_name}',
			co_use = '{$co_use}'
			WHERE idx = '{$idx}'
			";

} else if ($w == 'd') {
	$sql = "DELETE FROM g5_ck_company WHERE idx = '{$idx}';";

}

sql_query($sql);

goto_url(G5_BBS_URL.'/co_list.php');
?>
