<?php
include_once('./_common.php'); // 그누보드의 공통 파일을 포함
ob_start(); // 출력 버퍼링 시작

require_once './lib/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("You")->setTitle("회원목록");
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();


ob_end_clean(); // 출력 버퍼를 정리하고 버퍼링 종료

// Save Excel 2007 file
$filename = '회원 목록.xls';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Write file to the web browser
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
