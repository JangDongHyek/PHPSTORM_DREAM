<?
/**********************************
회원관리 - 진행여부 on, off

<진행여부 등록시>
1. 진행여부 조회 (남자는 동시진행 가능, 여자는 불가)	-- g5_member_match
2. 진행등록/실패

<진행여부 해제시>
1. 본인등록 확인
2. 본인/관리자면
	: 진행여부DB 수정 (상태 = 0)
3. 본인아니면
	: 진행여부 해제불가
**********************************/

include_once('./_common.php');
if ($member['mb_level'] != "10") exit;


$stt = $_POST['stt'];				// 0:진행등록, 1:해제
$mb_id = $_POST['mb_id'];			// 회원아이디
$idx = $_POST['idx'];				// 진행DB idx

$helper_id = ($member['mb_status'] == "관리자")? $_POST['helper_id'] : $member['mb_id'];		// 카운슬러 아이디
if ($helper_id == "") $helper_id = $member['mb_id'];

// 기본값
$json_arr = array();
$json_arr['result'] = "F";


// <1> 진행여부 등록시
if ($stt == "0") {
	// 진행여부 DB조회
	$sql = "SELECT idx, match_status FROM g5_member_match WHERE mb_id = '{$mb_id}' AND helper_id = '{$helper_id}' ";
	$row = sql_fetch($sql);

	// 진행불구분 (기존/신규)
	$match_type = ($_POST['match_type'] == 1)? 1 : 0;

	if ($row) {
		$match_status = ($row['match_status'] == "1")? "0" : "1";
		
		// 진행등록 되어있는데 다시 등록을 누른경우
		if ($idx == "" && $row['match_status'] == "1") {
			$sql = "";
			$json_arr['msg'] = "이미 진행여부를 등록하셨습니다.";

		} else {
			// DB등록 (update)
			$sql = "UPDATE g5_member_match SET 
					match_status = '{$match_status}',
					match_type = '{$match_type}',
					match_regdate = '".G5_TIME_YMDHIS."'
					WHERE idx = '{$row['idx']}'
					";
		}

	} else {
		$match_status = "1"; 

		// DB등록 (insert)
		$sql = "INSERT INTO g5_member_match SET 
				mb_id = '{$mb_id}',
				helper_id = '{$helper_id}',
				match_status = '{$match_status}',
				match_type = '{$match_type}',
				match_regdate = '".G5_TIME_YMDHIS."'
				";
	}

	$json_arr['sql'] = $sql;

	if ($sql != "") {
		$result = sql_query($sql);
		
		if ($result) {
			$json_arr['result'] = "T";
		}

		$json_arr['match_status'] = $match_status;
	}


// <2> 진행여부 해제시
} else {
	// 1. 본인등록확인
	$sql = "SELECT COUNT(*) AS cnt FROM g5_member_match 
			WHERE idx = '{$idx}' AND helper_id = '{$helper_id}'";
	$row = sql_fetch($sql);
	$regist_chk = $row['cnt'];
	
	if ($regist_chk > 0) {
		// 2. 본인/관리자면 진행여부 DB 해제
		$sql = "UPDATE g5_member_match SET
				match_status = 0
				WHERE idx = '{$idx}' AND helper_id = '{$helper_id}'";
		sql_query($sql);
		$json_arr['result'] = "T";

	} else {
		// 3. 본인아니면 해제불가
		$json_arr['msg'] = "본인의 진행만 해제가 가능합니다.";
	}
}


echo json_encode($json_arr, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>
