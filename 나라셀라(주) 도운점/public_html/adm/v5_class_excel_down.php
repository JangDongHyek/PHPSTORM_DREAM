<?php
include_once('./_common.php'); // 그누보드의 공통 파일을 포함
ob_start(); // 출력 버퍼링 시작

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$class_idx = $_GET['class_idx'];

$classInfo = getClassInfo($class_idx);

$sql = "
    SELECT 
        *
    FROM
        class_app_list
    WHERE
        class_idx = '{$class_idx}' 
    ORDER BY
        class_app_idx DESC;
";

$list = array();

$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {

    $row['sendMember'] = get_member($row['mb_id']);
    $row['payInfo'] = getPayInfo($row['class_app_idx']);
    $row['member'] = getClassAppMemberList($row['class_app_idx']);

    $list[] = $row;
}

require_once './lib/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("You")->setTitle("신청내역리스트");
$objPHPExcel->setActiveSheetIndex(0);

// Set column titles for basic info with style and merge
$sheet = $objPHPExcel->getActiveSheet();

$sheet->setCellValue('A1', '신청자')
    ->setCellValue('B1', '상태')
    ->setCellValue('C1', '인원')
    ->setCellValue('D1', '금액')
    ->setCellValue('E1', '관리')
    ->setCellValue('F1', '결제타입')
    ->setCellValue('G1', '신청일')
    ->setCellValue('H1', '이름')
    ->setCellValue('I1', '생년월일')
    ->setCellValue('J1', '휴대번호')
    ->setCellValue('K1', '이메일')

;

//실제 회원 데이터 불러와서 셋팅
// Starting row
$rowNumber = 2;

// Loop through the database results
foreach($list as $key => $data){
    $mbId = isset($data['sendMember']['mb_id']) ? $data['sendMember']['mb_id'] : '정보 없음';
    $mbHp = isset($data['sendMember']['mb_hp']) ? $data['sendMember']['mb_hp'] : '정보 없음';
    $mbName = isset($data['sendMember']['mb_name']) ? $data['sendMember']['mb_name'] : '정보 없음';
    $mbEmail = isset($data['sendMember']['mb_email']) ? $data['sendMember']['mb_email'] : '정보 없음';
    $mbBirthDate = isset($data['sendMember']['mb_1']) ? $data['sendMember']['mb_1'] : '정보 없음';

    $registerInfo = "신청자 아이디: $mbId\n신청자 휴대번호: $mbHp\n신청자 이름: $mbName\n신청자 이메일: $mbEmail\n신청자 생년월일: $mbBirthDate";

    $vbankExpDate = isset($data['payInfo']['VbankExpDate']) ? $data['payInfo']['VbankExpDate'] : '정보 없음';
    $vbankName = isset($data['payInfo']['VbankName']) ? $data['payInfo']['VbankName'] : '정보 없음';
    $vbankNum = isset($data['payInfo']['VbankNum']) ? $data['payInfo']['VbankNum'] : '정보 없음';
    $vBankAccountName = isset($data['payInfo']['VBankAccountName']) ? $data['payInfo']['VBankAccountName'] : '정보 없음';

    $bankInfo = "입금만료기간: $vbankExpDate\n은행: $vbankName\n계좌번호: $vbankNum\n예금주명: $vBankAccountName";

    $sheet->getRowDimension($rowNumber)->setRowHeight(71);
    //$sheet->getColumnDimension('A')->setWidth(40); // 20은 열 너비의 추정치입니다.
    //$sheet->getColumnDimension('E')->setWidth(25); // 20은 열 너비의 추정치입니다.
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);

    // 줄바꿈 스타일 적용
    $sheet->getStyle('A' . $rowNumber)->getAlignment()->setWrapText(true);
    $sheet->getStyle('E' . $rowNumber)->getAlignment()->setWrapText(true);

    $sheet->setCellValue('A' . $rowNumber, mb_convert_encoding($registerInfo, 'UTF-8'))
        ->setCellValue('B' . $rowNumber, mb_convert_encoding(CLASS_APP_STATUS[$data['status']], 'UTF-8'))
        ->setCellValue('C' . $rowNumber, mb_convert_encoding($data['person'], 'UTF-8'))
        ->setCellValue('D' . $rowNumber, mb_convert_encoding(number_format($data['payInfo']['Amt']).'원', 'UTF-8'))
        ->setCellValue('E' . $rowNumber, mb_convert_encoding($bankInfo, 'UTF-8'))
        ->setCellValue('F' . $rowNumber, mb_convert_encoding(PAY_TYPE[$data['payInfo']['payMethod']], 'UTF-8'))
        ->setCellValue('G' . $rowNumber, mb_convert_encoding(substr($data['regDate'], 2, 14), 'UTF-8'))
        ->setCellValue('H' . $rowNumber, mb_convert_encoding($data['member'][0]['name'], 'UTF-8'))
        ->setCellValue('I' . $rowNumber, mb_convert_encoding($data['member'][0]['birth'], 'UTF-8'))
        ->setCellValue('J' . $rowNumber, mb_convert_encoding($data['member'][0]['hp'], 'UTF-8'))
        ->setCellValue('K' . $rowNumber, mb_convert_encoding($data['member'][0]['email'], 'UTF-8'))
    ;




    $rowNumber++;
}

// 결과 세트를 메모리에서 해제
sql_free_result($result);

// Set title for the worksheet
$sheet->setTitle('신청내역리스트');

// 에러 메시지를 비활성화합니다.
//error_reporting(0);
//ini_set('display_errors', 0);

// Save Excel 2007 file
$filename = '신청내역리스트.xlsx';

ob_end_clean(); // 출력 버퍼를 정리하고 버퍼링 종료
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
ob_end_clean();

// Write file to the web browser
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
