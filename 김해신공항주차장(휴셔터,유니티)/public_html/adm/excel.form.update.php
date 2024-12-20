<?php
include_once('./_common.php');
require_once "../PHPExcel/Classes/PHPExcel.php";
$PHPExcel = new PHPExcel();
require_once "../PHPExcel/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러옴.
function time_convert_EXCEL_to_PHP($time){
   $t=( $time- 25569) * 86400;
   return $t;
}

$dotIndexOf=strpos($_FILES['file']['name'],".")+1;
$imgLength=strlen($_FILES['file']['name']);
$ext=strtolower(substr($_FILES['file']['name'],$dotIndexOf,$imgLength));//확장자
$uploadPath="../data/tmp/";
$filename=date("YmdHis").".".$ext;
if(!move_uploaded_file($_FILES['file']['tmp_name'],$uploadPath.$filename)){
	$jsonArray['success']="오류";
}else{
	$jsonArray['success']="성공";
}
$filename="../data/tmp/".$filename;

try {

  // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.

    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);
    // 읽기전용으로 설정
    $objReader->setReadDataOnly(true);

    // 엑셀파일을 읽는다
    $objExcel = $objReader->load($filename);

    // 첫번째 시트를 선택
    $objExcel->setActiveSheetIndex(0);
    $objWorksheet = $objExcel->getActiveSheet();
    $rowIterator = $objWorksheet->getRowIterator();
    foreach ($rowIterator as $row) { // 모든 행에 대해서
               $cellIterator = $row->getCellIterator();
               $cellIterator->setIterateOnlyExistingCells(false); 
    }

    $maxRow = $objWorksheet->getHighestRow();
    for ($i = 3 ; $i <= $maxRow ; $i++) {

         $wr_name = $objWorksheet->getCell('B' . $i)->getValue(); // B열
         $wr_5 = $objWorksheet->getCell('C' . $i)->getValue(); // C열
         $wr_6 = $objWorksheet->getCell('D' . $i)->getValue(); // D열
         $wr_3 = $objWorksheet->getCell('E' . $i)->getValue(); // E열
		 if($objWorksheet->getCell('F' . $i)->getValue()!=""){
			 $wr_19 = date('Y-m-d H:i:s',time_convert_EXCEL_to_PHP($objWorksheet->getCell('F' . $i)->getValue())); // E열
			 $wr_20 = date('Y-m-d H:i:s',time_convert_EXCEL_to_PHP($objWorksheet->getCell('G' . $i)->getValue())); // E열
		 }
         $wr_8 = $objWorksheet->getCell('H' . $i)->getValue(); // E열
         $wr_subject = '신공항주차장';
		 $wr_content = 'db이전';
         
		$wr_num = get_next_num('b_reserv');
        $wr_reply = '';
        
        //print_r($res);
        
        $sql = " insert into g5_write_b_reserv
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '$ca_name',
                     wr_option = '$html,$secret,$mail',
                     wr_subject = '$wr_subject',
                     wr_content = '$wr_content',
                     wr_link1 = '$wr_link1',
                     wr_link2 = '$wr_link2',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = '{$member['mb_id']}',
                     wr_password = '$wr_password',
                     wr_name = '$wr_name',
                     wr_email = '$wr_email',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10',
					 wr_19 = '$wr_19',
					 wr_20 = '$wr_20'
					 {$sql_orderby} ";

    sql_query($sql);

    $wr_id = sql_insert_id();

    // 부모 아이디에 UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

    // 새글 INSERT
    sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");

    // 게시글 1 증가
    sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

    // 쓰기 포인트 부여
    if ($w == '') {
        if ($notice) {
            $bo_notice = $wr_id.($board['bo_notice'] ? ",".$board['bo_notice'] : '');
            sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}' where bo_table = '{$bo_table}' ");
        }

        insert_point($member['mb_id'], $board['bo_write_point'], "{$board['bo_subject']} {$wr_id} 글쓰기", $bo_table, $wr_id, '쓰기');
    } else {
        // 답변은 코멘트 포인트를 부여함
        // 답변 포인트가 많은 경우 코멘트 대신 답변을 하는 경우가 많음
        insert_point($member['mb_id'], $board['bo_comment_point'], "{$board['bo_subject']} {$wr_id} 글답변", $bo_table, $wr_id, '쓰기');
    }

	


  }
}catch (exception $e) {

    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';

}
goto_url("./excel.form.php");
?>