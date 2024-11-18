<?php
// 답변등록
include_once("../common.php");

$json = array();
$json['result'] = false;
$json['err_msg'] = "";
$json['post'] = $_POST;

// php 5.3이하 json한글인코딩 깨짐
function han ($s) { return reset(json_decode('{"s":"'.$s.'"}')); }
function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

if($isIn == "T"){
	// 내부 답변
	switch ($mode) {
		case "regist" :	// 답변 등록
			$sql = "INSERT INTO project_qna_reply2 SET 
					pidx = '{$pidx}',
					reply = '{$reply2}',
					mb_id = '{$member['mb_id']}',
					mb_ip = '{$_SERVER['REMOTE_ADDR']}',
					regdate = '".G5_TIME_YMDHIS."'";
			break;

		case "status" :	// 문의 상태변경
			$sql = "UPDATE project_qna2 SET qa_status = '{$val}' WHERE idx = '{$idx}'";
			break;

		case "delete" : // 답변 삭제
			$sql = "DELETE FROM project_qna_reply2 WHERE idx = '{$idx}'";
			break;

		case "modify" :	// 답변 수정
			$sql = "UPDATE project_qna_reply2 SET reply = '{$reply2}' WHERE idx = '{$idx}'";
			break;

		case "wrkr" :	// 작업담당 지정
			$qa_dsgr = mb_substr($qa_dsgr, 0, 30, 'utf-8');
			$qa_prgr = mb_substr($qa_prgr, 0, 30, 'utf-8');
			$sql = "UPDATE project_qna2 SET qa_dsgr = '{$qa_dsgr}', qa_prgr = '{$qa_prgr}' WHERE idx = '{$idx}'";
			break;

		case "checked" : // 확인요망 체크
			$sql = "UPDATE project_qna2 SET rep_check = '{$_POST['rep_check']}' WHERE idx = '{$idx}'";
			break;

		case "workChecked" : // 작업검수요청 체크
			$sql = "UPDATE project_qna2 SET work_check = '{$_POST['work_check']}' WHERE idx = '{$idx}'";
			break;
	}
} else {
	// 외부업체 답변
	switch ($mode) {
		case "regist" :	// 답변 등록
			$sql = "INSERT INTO project_qna_reply SET 
					pidx = '{$pidx}',
					reply = '{$reply}',
					mb_id = '{$member['mb_id']}',
					mb_ip = '{$_SERVER['REMOTE_ADDR']}',
					regdate = '".G5_TIME_YMDHIS."'";
			break;

		case "status" :	// 문의 상태변경
			$sql = "UPDATE project_qna SET qa_status = '{$val}' WHERE idx = '{$idx}'";
			break;

		case "delete" : // 답변 삭제
			$sql = "DELETE FROM project_qna_reply WHERE idx = '{$idx}'";
			break;

		case "modify" :	// 답변 수정
			$sql = "UPDATE project_qna_reply SET reply = '{$reply}' WHERE idx = '{$idx}'";
			break;

		case "wrkr" :	// 작업담당 지정
			$qa_dsgr = mb_substr($qa_dsgr, 0, 30, 'utf-8');
			$qa_prgr = mb_substr($qa_prgr, 0, 30, 'utf-8');
			$sql = "UPDATE project_qna SET qa_dsgr = '{$qa_dsgr}', qa_prgr = '{$qa_prgr}' WHERE idx = '{$idx}'";
			break;

		case "checked" : // 확인요망 체크
			$sql = "UPDATE project_qna SET rep_check = '{$_POST['rep_check']}' WHERE idx = '{$idx}'";
			break;

		case "workChecked" : // 작업검수요청 체크
			$sql = "UPDATE project_qna SET work_check = '{$_POST['work_check']}' WHERE idx = '{$idx}'";
			break;
	}
}




if (!empty($sql) && sql_query($sql)) $json['result'] = true;

die(to_han(json_encode($json)));