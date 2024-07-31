<?php
ini_set('memory_limit','1024M');
include_once("./_common.php");
header("Content-Type: text/html; charset=UTF-8");
include_once('../../lib/PHPExcel/Classes/PHPExcel/IOFactory.php');
$excel_file = $_FILES["excel_file"];
for($sheetnum =0; $sheetnum<3; $sheetnum++){
$filetype = PHPExcel_IOFactory::identify($excel_file['tmp_name']);
$reader = PHPExcel_IOFactory::createReader($filetype);
$php_excel = $reader->load($excel_file['tmp_name']);
$sheet = $php_excel->getSheet($sheetnum);           // 첫번째 시트
$maxRow = $sheet->getHighestRow();          // 마지막 라인
$maxColumn = $sheet->getHighestColumn();    // 마지막 칼럼
$target = "A"."1".":"."$maxColumn"."$maxRow";
$datenow = date("Y-m-d");
$lines = $sheet->rangeToArray($target, NULL, TRUE, FALSE);
$array_column = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$itemperrow = array();
$date_rownum = array();
	//행 -> 열로 변경 배열 초기화

$now_column = array_search($maxColumn,$array_column);
$now_line = 0;
//echo $now_column;
for($i=0; $i<=$now_column; $i++){
			$itemperrow[$array_column[$i]] = array();				
}

foreach ($lines as $key => $line){
	
		$col = 0;		
		$item=array();
		for($k=0; $k<26; $k++){
		
			if(in_array("Day",$line) && $col>0 && $col%2==0){
				if(count($date_rownum) ==0 || end($date_rownum) != $now_line)
					array_push($date_rownum,$now_line);

				array_push($item,PHPExcel_Style_NumberFormat::toFormattedString($line[$col++], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2));	
			}

			else{
				array_push($item,$line[$col++]);		
			}
			
			if($maxColumn == $array_column[$k])
			break;

		}
	//	print_r($item);
	
		for($i=0; $i<count($item); $i++){					
			array_push($itemperrow[$array_column[$i]],$item[$i]);
		}
			$now_line++;

}
//print_r($date_rownum);

$time_cate = $itemperrow["A"][2];
$menu_cate =  str_replace(array("\r\n","\r","\n"),' ',$itemperrow["B"][$i]);
$row_date = $itemperrow["C"][0];

/*$sql="select count(*) as cnt from g5_write_carte where wr_3 = '{$row_date}' ";
$chk_exist  = sql_fetch($sql);

if($chk_exist['cnt']>0)
	echo 'exist';
	exit;
	*/	
	$date_now = date('Y-m-d H:i:s');
	
	if($sheetnum==2)
		print_r($date_rownum);

	for($k=2; $k<=$now_column; $k+=2){		
		for($i=2; $i<count($itemperrow["A"]); $i+=2){
			
			
			if($i==2){
					$row_date = $itemperrow[$array_column[$k]][0];
			}
			if($itemperrow["B"][$i] != $menu_cate && $itemperrow["B"][$i]!='Day' && !empty($itemperrow["B"][$i])){
					$menu_cate =  str_replace(array("\r\n","\r","\n"),' ',$itemperrow["B"][$i]);
			}
			if($time_cate!=$itemperrow["A"][$i] && $itemperrow["A"][$i]!='Menu' && !empty($itemperrow["A"][$i])){
					$time_cate = $itemperrow["A"][$i];
			}
			
			if(in_array($i,$date_rownum)){					
					$row_date = $itemperrow[$array_column[$k]][$i];
			}
			else{

				$menu_array = array();

				if(!empty($itemperrow[$array_column[$k]][$i]))
					array_push($menu_array,$itemperrow[$array_column[$k]][$i]);
				if(!empty($itemperrow[$array_column[$k]][$i+1]))
					array_push($menu_array,$itemperrow[$array_column[$k]][$i+1]);
				if(!empty($itemperrow[$array_column[$k+1]][$i]))
					array_push($menu_array,$itemperrow[$array_column[$k+1]][$i]);
				

				if(count($menu_array)>0)
					$string_menu = implode("|",$menu_array);
				else
					$string_menu = "";
					
					$string_menu = str_replace("'","\'",$string_menu);
				//	echo $string_menu;
					
					
			/*	if($time_cate=='' || empty($time_cate))
					echo "empty_time";*/		
					if(strpos($itemperrow["A"][$i],"Salad Bar") !==false){

							if($k==2){
									$row_date_cut  = substr($row_date,0,7);
									for($l=$i; $l<count($itemperrow["A"]); $l++){
										
										$sql="insert into g5_write_carte set wr_1 = '{$itemperrow['A'][$l]}' , wr_5 = '{$itemperrow['E'][$l]}' , wr_4 = '{$date_now}' , wr_3='{$row_date_cut}', wr_6 = {$sheetnum}";
										sql_query($sql);

										$sql ="delete from g5_write_carte where wr_1 = '{$time_cate}' and wr_4<'{$date_now}' and wr_3='{$row_date_cut}' and wr_6 = {$sheetnum}";
										sql_query($sql);

									}
							}
							break;
						}

						$sql ="insert into g5_write_carte set wr_1 = '{$time_cate}' ,wr_2 = '{$menu_cate}', wr_3 = '{$row_date}', wr_4 = '{$date_now}', wr_5 = '{$string_menu}' , wr_6 = {$sheetnum}";
						if($sheetnum==2  && $time_cate=='Snack')
								echo $sql;
						sql_query($sql);				
						
						$sql ="delete from g5_write_carte where wr_1 = '{$time_cate}' and wr_2 = '{$menu_cate}' and wr_3 = '{$row_date}' and wr_4<'{$date_now}' and wr_6 = {$sheetnum}";
						//echo $sql;
						if($sheetnum==2  && $time_cate=='Snack')
								echo $sql;
						sql_query($sql);
					
				/*	$sql="select count(*) as cnt, wr_id from g5_write_carte where wr_1 = '{$time_cate}' and wr_2 = '{$menu_cate}' and wr_3 = '{$row_date}' and wr_6 = {$sheetnum}";
					echo $sql;
					exit;
					$chk_exist = sql_fetch($sql);
					
							$sql ="insert into g5_write_carte set wr_1 = '{$time_cate}' ,wr_2 = '{$menu_cate}', wr_3 = '{$row_date}', wr_4 = '{$date_now}', wr_5 = '{$string_menu}' , wr_6 = {$sheetnum}";
							sql_query($sql);*/
			}
			//날짜 시간 메뉴 메뉴이름
		}
	}
}

/*

	// 상태 (1:배정완료, 2:배송불가지역, 3:기타-매칭안됨 등)
	$item['stt'] = 3;
	
	// 카카오 API
	$path = '/v2/local/search/address'; 
	$content_type = 'json';
	$params = http_build_query(array(
		'query' => get_text($item['J'])
	));

	// 행정동 구하기
	$res = kakaoRestApi($path, $params, $content_type);
	$decode = json_decode($res,true);
	$address = $decode['documents'][0];

	if ($address != "") {
		$item['si'] = preg_replace("/\s+/","", $address['address']['region_1depth_name']);
		$item['gu'] = preg_replace("/\s+/","", $address['address']['region_2depth_name']);
		$item['r_dong'] = preg_replace("/\s+/","", $address['address']['region_3depth_name']);	// 법정동
		$item['dong'] = preg_replace("/\s+/","", $address['address']['region_3depth_h_name']);	// 행정동
		$item['lng'] = $address['address']['x'];
		$item['lat'] = $address['address']['y'];

		$sql = "SELECT idx FROM g5_map_code WHERE map_dong = '{$item['dong']}' ";
		if ($item['si'] != "세종특별자치시") $sql .= "AND map_gu = '{$item['gu']}'";
		$rs = sql_fetch($sql);
		$item['dong_idx'] = $rs['idx'];

		// 1) 배송불가지역 확인
		$result = sql_query("SELECT dong_idx FROM g5_undeli_area ORDER BY idx ASC");
		$result_cnt = sql_num_rows($result);
		$undeli_list = array();
		if ((int)$result_cnt > 0) {
			while($row = sql_fetch_array($result)) {
				$undeli_list[] = $row['dong_idx'];
			}
		}

		if (in_array($item['dong_idx'], $undeli_list)) {
			// 배송불가지역
			$item['stt'] = 2;

		} else {
			// 2) 담당지역 배송기사 자동매칭
			if ($item['dong_idx'] != "") {
				$row = sql_fetch("SELECT A.mb_area_code, B.mb_id FROM g5_member_area A INNER JOIN g5_member B ON A.mb_area_code = B.mb_area_code WHERE A.dong_idx = '{$item['dong_idx']}' ORDER BY A.idx ASC LIMIT 0, 1");
				if ($row) {
					$item['driver_id'] = $row['mb_id'];
					$item['stt'] = 1;
				}
			}
		}
	}

	//print_r($item);
	//print_r($address);
	//print_r($decode);
	//echo "\n-----------------\n";

    if(isset($item['A'])){
		$sql = "insert into g5_write_order set 
				wr_subject = '{$item['E']}',
				wr_content = '{$item['K']}',
				wr_status = '{$item['stt']}',
				wr_lat = '{$item['lat']}',
				wr_lng = '{$item['lng']}',
				mb_id = '{$member['mb_id']}',
				wr_datetime = '".G5_TIME_YMDHIS."',
				wr_1 = '{$item['B']}',
				wr_2 = '{$item['C']}',
				wr_3 = '',
				wr_4 = '{$item['D']}',
				wr_5 = '{$item['F']}',
				wr_6 = '',
				wr_7 = '{$item['H']}',
				wr_8 = '{$item['J']}',
				wr_9 = '',
				wr_10 = '{$item['M']}',
				wr_11 = '{$item['L']}',
				wr_12 = '{$item['A']}',
				wr_13 = '0',
				wr_14 = '{$item['driver_id']}',
				wr_15 = '{$item['G']}',
				addr_si = '{$item['si']}',
				addr_gu = '{$item['gu']}',
				addr_r_dong = '{$item['r_dong']}',
				addr_dong = '{$item['dong']}',
				addr_dong_idx = '{$item['dong_idx']}'
				";
			//echo $sql."\n";
			sql_query($sql);

			/*
			insert into g5_write_order set 
			wr_datetime = '{$datenow}',
			wr_1 = '{$item['B']}',
			wr_2 = '{$item['C']}',
			wr_3 = '{$item['D']}',
			wr_4 = '{$item['E']}',
			wr_subject = '{$item['F']}',
			wr_5='{$item['G']}',
			wr_6='{$item['H']}',
			mb_id='{$member['mb_id']}',
			wr_7='{$item['I']}',
			wr_8='{$item['J']}',
			wr_content='{$item['K']}',
			wr_9='{$item['L']}',
			wr_10='{$item['M']}',
			wr_11='{$item['N']}',
			wr_12 = '{$item['A']}'";
			

		
		$item['A'] = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($item['A'])); 
		$sql = "insert into g5_write_order set wr_datetime = '{$datenow}', wr_1 = '{$item['B']}', wr_2 = '{$item['C']}', wr_3 = '{$item['D']}', wr_4 = '{$item['E']}', wr_subject = '{$item['F']}', wr_5='{$item['G']}', wr_6='{$item['H']}',mb_id='{$member['mb_id']}', wr_7='{$item['I']}', wr_8='{$item['J']}', wr_content='{$item['K']}', wr_9='{$item['L']}', wr_10='{$item['M']}', wr_11='{$item['N']}', wr_12 = '{$item['A']}'";
		sql_query($sql);
		echo $sql;        
		
    }
}*/

?>