<?php
include_once('./_common.php');

$si = $_GET["si"];
$gu = $_GET["gu"];
$addr = $_GET["addr"];
$mode = $_GET["mode"];

// 1) 구/군 찾기
if ($mode == "findGu") {
	echo "<option value=''>구/군(전체)</option>";

	// 매장없는 '구/군' 제외
	for ($i = 0; $i < count($addr); $i++) {

		//where 검색시 띄어쓰기 넣기; 달서구/서구 이런것들 걸림
		$sql = "SELECT COUNT(*) as cnt FROM g5_write_store 
				WHERE wr_1 LIKE '".$si."%' AND wr_1 LIKE '% ".$addr[$i]." %'
				ORDER BY wr_1 ASC";	
		$row = sql_fetch($sql);
		$r_cnt = $row["cnt"];

		if ((int)$r_cnt > 0) echo "<option value='{$addr[$i]}'>{$addr[$i]}</option>";
	}

// 2) 매장 찾기
} else if ($mode == "findStore") {
	echo "<option value=''>매장</option>";

	$sql = "SELECT wr_subject FROM g5_write_store
			WHERE wr_1 LIKE '".$si."%' AND wr_1 LIKE '% ".$gu." %'
			ORDER BY wr_subject ASC";
	$result = sql_query($sql);

	while($row = sql_fetch_array($result)){
		echo "<option value='{$row[wr_subject]}'>{$row['wr_subject']}</option>";
	}


}

?>