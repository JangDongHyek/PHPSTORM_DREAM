<?php

include_once("./_common.php");
require_once G5_PATH."/PHPExcel/Classes/PHPExcel.php";


function column_char($i) { return chr( 65 + $i ); }

/*첫번째시트 헤더*/
$headers = array('no','예약상황', '이름', '아이디/등급/조합원번호', '휴대폰', '입금확인', '접수일' );

$widths  = array(5, 10, 10, 25, 20, 10, 15,); //칸 넓이
$header_bgcolor = 'FFDDEBF7'; //헤더 배경색

$last_char = column_char(count($headers) - 1);


$wr_id = $_REQUEST['wr_id'];

$sql = "select * from new_enrolment where wr_id = '{$wr_id}' and e_is_wait = 'N' order by e_idx desc ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $no = $i+1;

    $mb = get_member($row["mb_id"]);

    $e_proc = ($row['e_proc'] == "comp") ? "접수완료" : "취소";
    $payment_chk = ($row['payment_chk'] == "Y") ? "완료" : "입금전";

    $rows[] = array($no, $e_proc,$mb['mb_name'],$mb["mb_id"]."/".$level_arr[$mb["mb_level"]-1]."/".$mb["mb_1"],$mb['mb_hp'],$payment_chk,substr($row['wr_datetime'],2,8));//첫번째 시트 데이터
}


$data1 = array_merge(array($headers), $rows);


$excel = new PHPExcel();

/*sheet1*/
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data1,NULL,'A1');
//$excel->getActiveSheet()->setTitle("");

$excel->setActiveSheetIndex(0);

$filename = "[".$config['cf_title']."]접수인원리스트_".date('Ymd',strtotime(G5_TIME_YMD)).".xls";

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-type: application/x-msexcel; charset=utf-8");
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$writer->save('php://output');


?>

