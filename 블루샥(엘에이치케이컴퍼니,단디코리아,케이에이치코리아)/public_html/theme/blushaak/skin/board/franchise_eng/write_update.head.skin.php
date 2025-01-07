<?php
	//게시판 첫글일 경우, 디비 쿼리문 추가
	$fild_exist = sql_fetch(" SHOW COLUMNS FROM $write_table LIKE 'wr_text1' ");
	if (empty($fild_exist)) { 
		sql_query(" ALTER TABLE $write_table ADD wr_text1 text NOT NULL ");    
	}
	$fild_exist = sql_fetch(" SHOW COLUMNS FROM $write_table LIKE 'wr_text2' ");
	if (empty($fild_exist)) { 
		sql_query(" ALTER TABLE $write_table ADD wr_text2 text NOT NULL ");    
	}
	$fild_exist = sql_fetch(" SHOW COLUMNS FROM $write_table LIKE 'wr_text3' ");
	if (empty($fild_exist)) { 
		sql_query(" ALTER TABLE $write_table ADD wr_text3 text NOT NULL ");    
	}
	$fild_exist = sql_fetch(" SHOW COLUMNS FROM $write_table LIKE 'wr_11' ");
	if (empty($fild_exist)) { 
		sql_query(" ALTER TABLE $write_table ADD wr_11 text NOT NULL ");    
	}

	$sql_common = " , wr_text1 = '$wr_text1' ";
	$sql_common .= " , wr_text2 = '$wr_text2' ";
	$sql_common .= " , wr_text3 = '$wr_text3' ";
	$sql_common .= " , wr_11 = '$wr_11' ";
	

?>