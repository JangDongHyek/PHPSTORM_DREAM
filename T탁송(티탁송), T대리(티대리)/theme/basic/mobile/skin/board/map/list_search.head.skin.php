<?php
// 시
if ($map_si != "") {
	$sql_search .= " AND wr_2 = '{$map_si}'";

	// 구 (서울 선택시)
	if (in_array($map_si, $depth_local_list) && $map_gu != "") {
		$sql_search .= " AND wr_2 = '{$map_si}' AND wr_3 = '{$map_gu}' ";
	}
}

?>