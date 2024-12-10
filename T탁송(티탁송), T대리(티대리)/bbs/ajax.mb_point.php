<?php
/**********************
회원 보유 포인트 조회
다르면 업데이트
**********************/
include_once('./_common.php');

$srch_mb_point = point_calc($_POST['mb_id']);

// 포인트 테이블의 합산포인트와 멤버 테이블의 포인트 정보가 다르면 업데이트 후 리턴
if ((int)$srch_mb_point != (int)$member['mb_point']) {
	$sql = "UPDATE g5_member SET mb_point = '{$srch_mb_point}'
			WHERE mb_id = '{$_POST['mb_id']}'
			";
	sql_query($sql);
}

echo number_format($srch_mb_point);

?>