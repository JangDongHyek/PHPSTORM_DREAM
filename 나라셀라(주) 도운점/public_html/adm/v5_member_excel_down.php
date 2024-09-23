<?php
include_once('./_common.php'); // 그누보드의 공통 파일을 포함
//ob_start(); // 출력 버퍼링 시작

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$sql_search = "";
//$sql_search .= " mb_id = '{$member['mb_id']}'";
$sql_search .= " and mb_level not in ('10') ";

$sql = " select * from g5_member where (1=1) {$sql_search} order by mb_no desc ";
$result = sql_query($sql);

//echo $sql;
//echo "\n";

require_once './lib/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("You")->setTitle("회원목록");
$objPHPExcel->setActiveSheetIndex(0);

// Set column titles for basic info with style and merge
$sheet = $objPHPExcel->getActiveSheet();

$sheet->setCellValue('A1', '아이디')
    ->setCellValue('B1', '이름')
    ->setCellValue('C1', '휴대폰')
    ->setCellValue('D1', '생년월일')
    ->setCellValue('E1', '이메일')
    ->setCellValue('F1', '마케팅 정보동의')
    ->setCellValue('G1', '가입일')
    ->setCellValue('H1', '최근접속일')
    ->setCellValue('I1', '가입경로')
    ->setCellValue('J1', '직업')
    ;

//실제 회원 데이터 불러와서 셋팅
// Starting row
$rowNumber = 2;

// Loop through the database results
while ($row = sql_fetch_array($result)) {
    //echo "진입";
    //echo "\n";
    //echo mb_convert_encoding($row['mb_id'], 'UTF-8');

    $sheet->setCellValue('A' . $rowNumber, $row['mb_id'])
        ->setCellValue('B' . $rowNumber, $row['mb_name'])
        ->setCellValue('C' . $rowNumber, $row['mb_hp'])
        ->setCellValue('D' . $rowNumber, $row['mb_1'])
        ->setCellValue('E' . $rowNumber, $row['mb_email'])
        ->setCellValue('F' . $rowNumber, $row['mb_sms'] == '1'? 'Y' : 'N')
        ->setCellValue('G' . $rowNumber, substr($row['mb_datetime'], 2, 14))
        ->setCellValue('H' . $rowNumber, substr($row['mb_today_login'], 2, 14))
        ->setCellValue('I' . $rowNumber, $row['mb_route'])
        ->setCellValue('J' . $rowNumber, $row['mb_job'])
    ;
    $rowNumber++;
}

// 결과 세트를 메모리에서 해제
sql_free_result($result);

// Set title for the worksheet
$sheet->setTitle('회원목록');

// Save Excel 2007 file
$filename = '회원 목록.xlsx';

ob_end_clean();

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

ob_end_clean(); // 출력 버퍼를 정리하고 버퍼링 종료

// Write file to the web browser
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
