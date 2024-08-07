<?php
include_once('./_common.php'); // 그누보드의 공통 파일을 포함
ob_start(); // 출력 버퍼링 시작

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$sql_search = "";
//$sql_search .= " mb_id = '{$member['mb_id']}'";
$sql_search .= " and refund_status not in ('Y') ";

$sql = " select * from stocks where (1=1) {$sql_search} order by id desc ";
$result = sql_query($sql);

require_once './lib/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("You")->setTitle("주식 지급 내역");
$objPHPExcel->setActiveSheetIndex(0);

// Set column titles for basic info with style and merge
$sheet = $objPHPExcel->getActiveSheet();

$sheet->setCellValue('A1', '아이디')
    ->setCellValue('B1', '지급내용')
    ->setCellValue('C1', '지급주식')
    ->setCellValue('D1', '일시')
    ->setCellValue('E1', '보유주식');

//실제 회원 데이터 불러와서 셋팅
// Starting row
$rowNumber = 2;

// Loop through the database results
while ($stock = sql_fetch_array($result)) {
    $getTotalHoldingCount = getTotalHoldingCount($stock['mb_id']);

    $sheet->setCellValue('A' . $rowNumber, mb_convert_encoding($stock['mb_id'], 'UTF-8'))
        ->setCellValue('B' . $rowNumber, mb_convert_encoding($stock['payment_reason'], 'UTF-8'))
        ->setCellValue('C' . $rowNumber, mb_convert_encoding($stock['holding_count'], 'UTF-8'))
        ->setCellValue('D' . $rowNumber, mb_convert_encoding($stock['issuance_date'], 'UTF-8'))
        ->setCellValue('E' . $rowNumber, mb_convert_encoding($getTotalHoldingCount, 'UTF-8'));
    $rowNumber++;
}

// 결과 세트를 메모리에서 해제
sql_free_result($result);

// Set title for the worksheet
$sheet->setTitle('주식 지급 내역');

ob_end_clean(); // 출력 버퍼를 정리하고 버퍼링 종료

// 에러 메시지를 비활성화합니다.
error_reporting(0);
ini_set('display_errors', 0);

// Save Excel 2007 file
$filename = '주식지급내역.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Write file to the web browser
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
