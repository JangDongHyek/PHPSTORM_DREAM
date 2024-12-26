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

	$sql_common = " , wr_text1 = '$wr_text1' ";
	$sql_common .= " , wr_text2 = '$wr_text2' ";
	$sql_common .= " , wr_text3 = '$wr_text3' ";


	$option_count = 4;
	$spec_text = array("모델명","상선식","전압","전류","주파수","정밀도","계기정수");
	$spec_file = array("사용설명서","조건표","도면치수");


	for($i=1;$i<=$option_count; $i++){
		for($j=0; $j<count($spec_text); $j++) {
			$k = $j+1;

			${'wr_'.$k} .= ${'wr_'.$i.'_'.$k};
			
			if($i != $option_count){
				${'wr_'.$k} .= "|";
			}
		}
	}
?>