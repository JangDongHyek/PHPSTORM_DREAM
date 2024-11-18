<?php
/*
$mode
	- write : 문의등록/수정
	- delete : 문의삭제
	- 없음 : 파일업로드
 */
include_once('../common.php');

// php 5.3이하 json한글인코딩 깨짐
function han ($s) { return reset(json_decode('{"s":"'.$s.'"}')); }
function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }


// 첨부파일 폴더 생성
$qna_file_path = G5_DATA_PATH."/project_qna";
$qna_file_url = G5_DATA_URL."/project_qna";
if (!file_exists($qna_file_path)) {
	mkdir($qna_file_path, 0755, true);
}

$json = array();
$json['result'] = false;
// $json['post'] = $_POST;

// 문의등록/수정
if ($mode == "write") {
    // 제목
	$qa_subject = mb_substr(trim($_POST['qa_subject']), 0, 100, 'utf-8');
    // 담당자명
	$qa_name = mb_substr(trim($_POST['qa_name']), 0, 50, 'utf-8');
    // 연락처
	$qa_tel = mb_substr(trim($_POST['qa_tel']), 0, 50, 'utf-8');

	$sql_common = " qa_subject = '{$qa_subject}',
					qa_content = '{$qa_content}',
					qa_name = '{$qa_name}',
					qa_tel = '{$qa_tel}',
					mid_name = '{$mid_name}',
					mid_in = '{$mid_in}',
					qa_regdate = '".G5_TIME_YMDHIS."',
					qa_ip = '{$_SERVER['REMOTE_ADDR']}',
					qa_domain = '".G5_URL."'
					";

	// 첨부파일 존재하면
	if (count($qa_files_json) > 0) {
		//$sql_common .= ", qa_files_json = '".json_encode($qa_files_json, JSON_UNESCAPED_UNICODE)."'";
		$sql_common .= ", qa_files_json = '".to_han(json_encode($qa_files_json))."'";
	}

	if (empty($_POST['idx'])) {
        // CS 부산?
        $is_busan = "N";
        $is_busan_id = "";
        if ($_POST['is_busan'] == "Y") {
            $is_busan = "Y";
            $is_busan_id = $member['mb_id'];
        }
        $sql_common .= ", is_busan = '{$is_busan}', is_busan_id = '{$is_busan_id}'";

		$sql = "INSERT INTO project_qna SET 
				mid = '{$mid}',
				is_notice = '{$_POST['is_notice']}',
				is_admin = '{$_POST['is_admin']}',
				qa_status = '접수완료',
				{$sql_common}
				";
		$json['result'] = sql_query($sql); //$db->getDbInsert($sql);

	} else {
		$sql = "UPDATE project_qna SET 
				{$sql_common}
				WHERE idx = '{$idx}'
				";
		$json['result'] = sql_query($sql); //$db->getDbUpdate($sql);
	}

	// 글수정 완료 후 파일삭제 확인
	if ($json['result'] && count($_POST['del_files_json']) > 0) {
		foreach ($del_files_json AS $key=>$val) {
			@unlink($qna_file_path.'/'.$val);
		}
	}
	
}
else if ($mode == "delete") {
	$sql = "DELETE FROM project_qna WHERE idx = '{$idx}'";
	$json['result'] = sql_query($sql); //$db->getDbInsert($sql);

	if ($json['result'] && count($del_file) > 0) {
		foreach ($del_file AS $key=>$val) {
			@unlink($qna_file_path.'/'.$val);
		}
	}
} 
else {
	// 파일업로드
	$file_cnt = count($_FILES['qa_upload']['tmp_name']);
	$regex = '/(?<![ ,\\\\])"(?![:,\\}])/';
	$res_file = array();	// 업로드파일
	$del_file = array();	// 삭제파일

	for ($i = 0; $i < $file_cnt; $i++) {
		$upload_dir = $qna_file_path.'/';
		$upload_file = $_FILES['qa_upload']['tmp_name'][$i];
		$del_chk = ($qa_del_file[$i]=="1")? 1 : "";

		if ($upload_file != "") {
			$ext = array_pop(explode('.', $_FILES['qa_upload']['name'][$i]));
			$file_name = time()."_{$mid}_{$i}.{$ext}";
			$upload_path = $upload_dir.$file_name;

			if (move_uploaded_file($upload_file, $upload_path)) {
				$json['test'][$i] = $file_name;

				$res_file[] = array(
					'name'=>preg_replace($regex, '\"', $_FILES['qa_upload']['name'][$i]),
					'src'=>$qna_file_url."/".$file_name,
					'file'=>$file_name,
				);
				$del_chk = 1;
			}
		}

		// 글수정시 (파일삭제여부)
		if (!empty($qa_old_file[$i])) {
			if ($del_chk != 1) {			// 파일삭제O
				$res_file[] = array(
					'name'=>$qa_old_name[$i],
					'src'=>$qna_file_url."/".$qa_old_file[$i],
					'file'=>$qa_old_file[$i],
				);
			} else {						// 파일삭제X
				$del_file[] = $qa_old_file[$i];
			}
		}
	}

	if (count($res_file) > 0 || count($del_file) > 0) {
		$json['files'] = $res_file;
		$json['del_files'] = $del_file;
		$json['result'] = true;
	}
}

// return values
echo to_han(json_encode($json));
?>