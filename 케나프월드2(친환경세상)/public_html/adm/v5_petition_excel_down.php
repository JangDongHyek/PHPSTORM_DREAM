<?php
include_once('./_common.php'); // 그누보드의 공통 파일을 포함
ob_start(); // 출력 버퍼링 시작

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$sql = " select p.*, m.mb_recommend, (select mb_name from g5_member where mb_id = m.mb_recommend) as mb_recommend_name from petition as p inner join g5_member as m where p.mb_id = m.mb_id order by p.idx desc; ";
$result = sql_query($sql);

require_once './lib/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("You")->setTitle("청원서 내역");
$objPHPExcel->setActiveSheetIndex(0);

// Set column titles for basic info with style and merge
$sheet = $objPHPExcel->getActiveSheet();

$sheet->setCellValue('A1', '아이디')
    ->setCellValue('B1', '성명')
    ->setCellValue('C1', '전화번호')
    ->setCellValue('D1', '생년월일')
    ->setCellValue('E1', '소속')
    ->setCellValue('F1', '주소')
    ->setCellValue('G1', '작성일')
    ->setCellValue('H1', '추천인이름')
    ->setCellValue('I1', '추천인전화번호')
;

//실제 회원 데이터 불러와서 셋팅
// Starting row
$rowNumber = 2;

// Loop through the database results
while ($petition = sql_fetch_array($result)) {
    $sheet->setCellValue('A' . $rowNumber, mb_convert_encoding($petition['mb_id'], 'UTF-8'))
        ->setCellValue('B' . $rowNumber, mb_convert_encoding($petition['name'], 'UTF-8'))
        ->setCellValue('C' . $rowNumber, mb_convert_encoding($petition['mb_hp'], 'UTF-8'))
        ->setCellValue('D' . $rowNumber, mb_convert_encoding($petition['birthdate'], 'UTF-8'))
        ->setCellValue('E' . $rowNumber, mb_convert_encoding($petition['organization'], 'UTF-8'))
        ->setCellValue('F' . $rowNumber, mb_convert_encoding($petition['address'], 'UTF-8'))
        ->setCellValue('G' . $rowNumber, mb_convert_encoding($petition['created_at'], 'UTF-8'))
        ->setCellValue('H' . $rowNumber, mb_convert_encoding($petition['mb_recommend'], 'UTF-8'))
        ->setCellValue('I' . $rowNumber, mb_convert_encoding($petition['mb_recommend_name'], 'UTF-8'))
    ;
    $rowNumber++;
}

// 각 열의 너비를 내용에 맞게 자동으로 조정
foreach (range('A', $sheet->getHighestColumn()) as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

// 결과 세트를 메모리에서 해제
sql_free_result($result);

// Set title for the worksheet
$sheet->setTitle('청원서 내역');

ob_end_clean(); // 출력 버퍼를 정리하고 버퍼링 종료

// 에러 메시지를 비활성화합니다.
error_reporting(0);
ini_set('display_errors', 0);

// Save Excel 2007 file
$filename = '청원서내역.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Write file to the web browser
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
