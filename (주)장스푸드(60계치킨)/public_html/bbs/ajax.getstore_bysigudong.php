<?php
include_once('./_common.php');

// 검색 조건에 따른 SQL 쿼리 생성
$sql_search = "";
if($si) {
    $sql_search .= " and  INSTR (wr_1,'$si')";
}
if($gu) {
    $sql_search .= " and  INSTR (wr_1,'$gu')";
}
if($dong) {
    $sql_search .= " and  INSTR (wr_1,'$dong')";
}

// 상호명만 선택하여 SQL 쿼리 실행
$result = sql_query(" select wr_subject from g5_write_store where 1=1 $sql_search ");

// 결과를 담을 배열 초기화
$store_names = array();

// SQL 쿼리 결과 처리
while ($row = sql_fetch_array($result)) {
    // 결과 배열에 상호명 추가
    $store_names[] = $row['wr_subject'];
}

// 결과 배열을 JSON 형식으로 변환하여 출력
echo json_encode($store_names);

?>