<?
/**********************************
회원관리 - 소개이력, 매칭에 관리자 코멘트 등록

p_idx			= 원댓글의 인덱스
co_is_parent	= 1:원댓글, 0:원댓의 대댓글
co_is_del		= 1:삭제, 0:기본
**********************************/
include_once('./_common.php');

if ($_POST['mode'] == "delete") { // json return
    $json = array();
    //$json['post'] = $_POST;

    $idx = $_POST['idx'];

    $sql = "DELETE FROM g5_helper_comment WHERE idx = '{$idx}' ";
    if ($_POST['is_reply']=="0") {  // 원댓글이면 대댓글까지 삭제
        $sql .= "OR p_idx = '{$idx}'";
    }
    $json['result'] = sql_query($sql);
    die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}

$p_idx = "";
$co_is_parent = "1";

// 대댓글이면
if ($mode == "r") {
	$p_idx = $_POST['p_idx'];
	$co_is_parent = $_POST['co_is_parent'];
}

// 댓글등록
$sql = "INSERT INTO g5_helper_comment SET
		co_page = '{$_POST['page']}',
		helper_id = '{$_POST['helper_id']}',
		mb_id = '{$_POST['mb_id']}',
		p_idx = '{$p_idx}',
		co_is_parent = '{$co_is_parent}',
		co_regdate = '".G5_TIME_YMDHIS."',
		co_is_del = '0',
		co_txt = '{$_POST['co_txt']}',
		co_fix_date = '{$_POST['co_fix_date']}'
		";
$result = sql_query($sql);

if ($result) {
	if ($mode == "w") {
		$sql = "SELECT idx FROM g5_helper_comment 
				WHERE helper_id = '{$_POST['helper_id']}' AND mb_id = '{$_POST['mb_id']}' ORDER BY idx DESC LIMIT 0, 1; ";
		$row = sql_fetch($sql);
		$p_idx = $row['idx'];

		$sql = "UPDATE g5_helper_comment SET p_idx = '{$p_idx}' WHERE idx = '{$p_idx}'";
		sql_query($sql);
	}
	die("T");

} else {
	die("F");
}




?>