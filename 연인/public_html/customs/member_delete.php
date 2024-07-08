<?
/**************************
회원삭제시 관련 DB삭제
1. 이미지 DB
2. 이상형 DB
**************************/
$img_tbl = "g5_member_img";
$ideal_tbl = "g5_member_ideal";

// 1. 이미지DB 삭제 & 파일삭제
$sql = "SELECT idx, mi_img FROM {$img_tbl} WHERE mb_id = '{$mb_id}' ORDER BY idx ASC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

if ($result_cnt > 0) {
	for ($i = 0; $row = sql_fetch_array($result); $i++) {
		$img_path = MB_IMG_PATH."/".$row["mi_img"];
		$img_idx = $row['idx'];

		if (file_exists($img_path)) {
			@unlink($img_path);
			sql_query(" DELETE FROM {$img_tbl} WHERE mb_id = '{$mb_id}' ");
		}
	}
}


// 2. 이상형DB 삭제
$sql = " DELETE FROM {$ideal_tbl} WHERE mb_id = '{$mb_id}' ";
sql_query($sql);