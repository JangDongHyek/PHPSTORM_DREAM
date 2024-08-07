<?php
	//금액이 넘었을때 안되도록 추가해야함

	//wr 추가변수
	$wr_cnt = 50;

	//변수 배열지정
	$var_array = array();
	//wr 변수 $wr_cnt 까지 늘림
	for($i=11; $i<=$wr_cnt; $i++){
		array_push($var_array, "wr_{$i}");
	}

	//특수 변수 추가
	array_push($var_array, "wr_lat", "wr_lng");

	//lets080 관리자 및 게시판 첫글이 없을 경우, 디비 쿼리문 추가
	if($member['mb_id']=="lets080"){
		for($i=0; $i<count($var_array); $i++){
			$row = sql_fetch("SELECT table_name, column_name from information_schema.columns WHERE column_name = '".$var_array[$i]."' AND TABLE_NAME LIKE '{$write_table}'");
			if(!$row){ 
				sql_query("ALTER TABLE {$write_table} ADD ".$var_array[$i]." VARCHAR( 255 ) NOT NULL DEFAULT ''");
			}
		}
	}

	//property 추가 변수
	for($i=0; $i<count($var_array); $i++){
		$var = $var_array[$i];
		$$var = "";

		if (isset($_POST[$var_array[$i]]) && settype($_POST[$var_array[$i]], 'string')) {
			$$var = trim($_POST[$var_array[$i]]);
		}
		
		$sql_common .= ", {$var} = '{$$var}' ";
	}

?>