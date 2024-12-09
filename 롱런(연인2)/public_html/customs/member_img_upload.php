<?
// 회원이미지 업로드
$img_count = count($_FILES['mi_img']['tmp_name']);

for ($i = 0; $i < $img_count; $i++) {
	$upload_dir = MB_IMG_PATH.'/';
	$ext = "";
	$file_name = "";
	$table_name = "g5_member_img";

	if ($mi_idx[$i] == "") {				//====> 신규등록

		// 이미지 업로드
		$upload_file = $_FILES['mi_img']['tmp_name'][$i];

		if ($upload_file != "") {
			$ext = array_pop(explode('.', $_FILES['mi_img']['name'][$i]));
			$file_name = "{$mb_id}_{$i}_".strtotime(G5_TIME_YMDHIS).".{$ext}";
			$upload_path = $upload_dir.$file_name;

			move_uploaded_file($upload_file, $upload_path);
		}

		$sql = "INSERT INTO {$table_name} SET 
				mb_id = '{$mb_id}',
				mi_img = '{$file_name}',
				mi_regdate = '".G5_TIME_YMDHIS."'
				";

	} else {							//====> 수정

		// 이미지 업로드
		$upload_file = $_FILES['mi_img']['tmp_name'][$i];
		$old_file_del = ($mi_del[$i] == "1")? true : false;

		if ($upload_file != "") {
			$ext = array_pop(explode('.', $_FILES['mi_img']['name'][$i]));
			$file_name = "{$mb_id}_{$i}_".strtotime(G5_TIME_YMDHIS).".{$ext}";
			$upload_path = $upload_dir.$file_name;

			move_uploaded_file($upload_file, $upload_path);
			$old_file_del = true;

		} else {
			$file_name = $mi_old_img[$i];
		}

		// 이전이미지 삭제
		if ($old_file_del) {
			@unlink($upload_dir.$mi_old_img[$i]);
			if ($file_name == $mi_old_img[$i]) $file_name = "";
		}

		$sql = "UPDATE {$table_name} SET 
				mi_img = '{$file_name}',
				mi_regdate = '".G5_TIME_YMDHIS."'
				WHERE mb_id = '{$mb_id}' AND idx = '{$mi_idx[$i]}'
				";
	}

	sql_query($sql);
}
?>