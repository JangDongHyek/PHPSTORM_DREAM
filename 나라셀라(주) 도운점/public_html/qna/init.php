<?php
include_once('./db.php');

if (!$is_member) {
	alert("로그인이 필요합니다.", G5_BBS_URL . "/login.php?url=".urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
} else {
	if (!$is_admin) alert("잘못된 접근입니다.", G5_URL);
}

// 매니저 프로젝트no를 입력하세요!
$mid = 18474;	
if ((int)$mid < 1) die("업체코드를 올바르게 등록해 주세요.");

// 매니저업체명호출
// $mdb = new ManagerDB(); 
// $manager = $mdb->getInfo($mid);

// qna DB호출
$db = new QnaDB();

// 첨부파일 폴더 생성
$qna_file_path = G5_DATA_PATH."/project_qna";
$qna_file_url = G5_DATA_URL."/project_qna";
if (!file_exists($qna_file_path)) {
	mkdir($qna_file_path, 0755, true);
}

// php 5.3이하 json한글인코딩 깨짐
// 5.3이하 json_encode사용 : echo to_han(json_encode($json));
$row_version = floatval(phpversion()) < 5.3;
function han ($s) { return reset(json_decode('{"s":"'.$s.'"}')); }
function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

?>