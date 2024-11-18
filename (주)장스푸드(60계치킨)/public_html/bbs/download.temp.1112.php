<?
include_once('./_common.php');
include_once('../lib/PHPExcel/Classes/PHPExcel/IOFactory.php');


//if ($stx != "") {
	//$sql_search .= " AND {$sfl} LIKE '%{$stx}%' ";
//}


$sql = "SELECT * FROM g5_write_fran03 where wr_datetime >= '2019-01-01' and wr_datetime <='2020-08-01' ORDER BY wr_datetime DESC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

$list = array();
//echo $result_cnt;
for ($i = 0; $row = sql_fetch_array($result); $i++) {
	//$mb = get_member($row['wr_14'], "mb_name");

	$list[$i+1] = array(
		"A"=>$i+1,
		"B"=>$row['wr_name'],
		"C"=>$row['wr_subject'],
		"D"=>$row['wr_content'],
		"E"=>$row['wr_datetime'],	
	);
}



//echo "<pre>";
//print_r($list);
//echo "</pre>";
//exit;

$objPHPExcel = new PHPExcel();

// 첫번째 행 지정
$objPHPExcel -> setActiveSheetIndex(0)
-> setCellValue("A1", "NO.")
-> setCellValue("B1", "이름")
-> setCellValue("C1", "연락처")
-> setCellValue("D1", "문의내용")
-> setCellValue("E1", "등록날짜");

// 두번째 행부터 데이터 삽입
$count = 1;

foreach($list as $key => $val) {
	$num = 1 + $key;

	$objPHPExcel -> setActiveSheetIndex(0)
	-> setCellValue(sprintf("A%s", $num), $val['A'])
	-> setCellValue(sprintf("B%s", $num), $val['B'])
	-> setCellValue(sprintf("C%s", $num), $val['C'])
	-> setCellValue(sprintf("D%s", $num), $val['D'])
	-> setCellValue(sprintf("E%s", $num), $val['E']);

	$count++;
}


// 가로 넓이 조정
//$objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setWidth(6);	//setAutoSize(true);
foreach(range('A','E') as $columnID) {
	$objPHPExcel -> getActiveSheet() -> getColumnDimension($columnID) -> setWidth(15);
}
$objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setWidth(8);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("C") -> setWidth(20);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("D") -> setWidth(100);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("E") -> setWidth(30);


// 전체 세로 높이 조정
$objPHPExcel -> getActiveSheet() -> getDefaultRowDimension() -> setRowHeight(17);

// 전체 가운데 정렬
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:E%s", $count)) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// 전체 테두리 지정
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:E%s", $count)) -> getBorders() -> getAllBorders() -> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// 타이틀 부분
$objPHPExcel -> getActiveSheet() -> getStyle("A1:E1") -> getFont() -> setBold(true);
$objPHPExcel -> getActiveSheet() -> getStyle("A1:E1") -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("CECBCA");

// 시트 네임
$objPHPExcel -> getActiveSheet() -> setTitle('문의목록');


// 첫번째 시트(Sheet)로 열리게 설정
$objPHPExcel -> setActiveSheetIndex(0);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", date('Ymd')."_문의목록");

// 브라우저로 엑셀파일을 리다이렉션
header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".$filename.".xls");
header("Cache-Control:max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter -> save("php://output");


?>