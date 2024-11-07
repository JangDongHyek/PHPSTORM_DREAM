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
	
	include G5_PLUGIN_PATH."/php-image-resize-master/lib/ImageResize.php";//플러그인 경로를 확인하세요 

	$width   = 900;  //  너비 px
	$height  = 448; //  높이 px (포토샵에서 지원하는 최대 높이값)
	$quality = 100;   //  선명도 %

	//use \Eventviva\ImageResize; 
	use \Gumlet\ImageResize;

	for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) { 
		//이미지 내용 확인 
		$tmp_file  = $_FILES['bf_file']['tmp_name'][$i]; 
		$filename  = $_FILES['bf_file']['name'][$i]; 
		
		//이미지 확장자 검사 
		if($filename && preg_match("/\.({$config['cf_image_extension']})$/i", $filename)){ 
			// image type 검사 
			$timg = @getimagesize($tmp_file); 
			if ($timg['2'] < 1 || $timg['2'] > 16){ 
				continue; 
			} 
			//이미지 변경 
			$image = new ImageResize($tmp_file); 
			$image->resizeToBestFit($width, $height); 
			$image->save($tmp_file, null, $quality); 
			$_FILES['bf_file']['size'][$i]=filesize($tmp_file); 
			unset($image); 
		} 
	} 
?>