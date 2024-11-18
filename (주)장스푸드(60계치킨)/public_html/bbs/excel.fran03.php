<?php
// 창업문의 엑셀다운
include_once('./_common.php');
include_once('../plugin/excel/PHPExcel.php');


$sql_common = (!empty($_POST['wr_id']))? "AND wr_id IN (".$_POST['wr_id'].")" : "";

// 리스트
$sql = "SELECT * FROM g5_write_fran03 WHERE wr_is_comment = 0 {$sql_common} ORDER BY wr_id DESC";
$result = sql_query($sql);
$list = array();
$list_no = sql_num_rows($result);


for ($i=0; $row=sql_fetch_array($result); $i++) {
    if(empty($row['wr_name'])){
        $mb = get_member($row['mb_id']);
        $row['wr_name'] = $mb['mb_name'];
    }

	$tmp = array();
	$tmp['A'] = $list_no;
	$tmp['B'] = $row['wr_subject'];
	$tmp['C'] = $row['wr_name'];
	$tmp['D'] = $row['wr_14'];
	$tmp['E'] = $row['wr_13'];
	$tmp['F'] = $row['wr_1']." ".$row['wr_2'];
	$tmp['G'] = $row['wr_3'];
	$tmp['H'] = $row['wr_4'];
	$tmp['I'] = $row['wr_15'];
	$tmp['J'] = $row['wr_5'];
	$tmp['K'] = $row['wr_6'];
	$tmp['L'] = $row['wr_7'];
	$tmp['M'] = $row['wr_8'];
	$tmp['N'] = $row['wr_9'];
	$tmp['O'] = $row['wr_10'];
	$tmp['P'] = $row['wr_11'];
	$tmp['Q'] = $row['wr_12'];
	$tmp['R'] = $row['wr_content'];
	$tmp['S'] = $row['wr_datetime'];
	$tmp['T'] = $row['wr_ip'];

	$list[] = $tmp;
	$list_no--;

	//if ($i==10) break;
}

//echo "<pre>";
//print_r($list);
//echo "</pre>";

$objPHPExcel = new PHPExcel();

// 첫번째 행 지정
$objPHPExcel -> setActiveSheetIndex(0)
-> setCellValue("A1", "NO.")
-> setCellValue("B1", "연락처")
-> setCellValue("C1", "이름")
-> setCellValue("D1", "성별")
-> setCellValue("E1", "연령대")
-> setCellValue("F1", "개설희망지역")
-> setCellValue("G1", "문의경로")
-> setCellValue("H1", "운영주체")
-> setCellValue("I1", "운영조달계획")
-> setCellValue("J1", "문의자주변60계운영")
-> setCellValue("K1", "지인운영매장명")
-> setCellValue("L1", "희망순이익")
-> setCellValue("M1", "창업예상비용")
-> setCellValue("N1", "창업비용출처")
-> setCellValue("O1", "창업경험")
-> setCellValue("P1", "창업예상시기")
-> setCellValue("Q1", "양도양수희망")
-> setCellValue("R1", "문의상세내용")
-> setCellValue("S1", "작성일")
-> setCellValue("T1", "아이피");

// 시트삽입
$num = 2;
$col_arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');

foreach ($list AS $k1=>$row) {
	foreach ($col_arr AS $k2=>$col) {
		//if ($col == 'C') {
			// number to string
		//	$objPHPExcel -> setActiveSheetIndex(0) -> setCellValueExplicit(sprintf($col."%s", $num), //$row[$col], PHPExcel_Cell_DataType::TYPE_STRING);
		//} else
		$objPHPExcel -> setActiveSheetIndex(0) -> setCellValue(sprintf($col."%s", $num), $row[$col]);
	}
	$num++;
}

$count = $num;

$sheet = $objPHPExcel -> getActiveSheet();

$s_prfx = "A";
$e_prfx = "T";
$all_col = "A1:T%s";
$first_col = "A1:T1";

// 가로 넓이 조정
foreach(range($s_prfx, $e_prfx) as $columnID) {
	$sheet -> getColumnDimension($columnID) -> setWidth(20);
}
$sheet -> getColumnDimension("A") -> setWidth(10);
$sheet -> getColumnDimension("D") -> setWidth(10);
$sheet -> getColumnDimension("R") -> setWidth(40);

// 전체 가운데 정렬
$sheet -> getStyle(sprintf($all_col, $count)) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet -> getStyle(sprintf($all_col, $count)) -> getAlignment() -> setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER );

// 전체 테두리 지정
$sheet -> getStyle(sprintf($all_col, $count)) -> getBorders() -> getAllBorders() -> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// 타이틀 부분
$sheet -> getStyle($first_col) -> getFont() -> setBold(true);
$sheet -> getStyle($first_col) -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("CECBCA");

/*
// 내용 지정
$sheet -> getStyle(sprintf("A2:D%s", $count)) -> getFill()
-> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("F4F4F4");
*/

// 줄바꿈
$sheet->getStyle(sprintf("R2:R%s", $count))->getAlignment()->setWrapText(true);



// 시트 네임
$sheet_name = "창업문의_".date("YmdHis");
$sheet -> setTitle($sheet_name);


// 첫번째 시트(Sheet)로 열리게 설정
$objPHPExcel -> setActiveSheetIndex(0);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", $sheet_name);

// 브라우저로 엑셀파일을 리다이렉션
header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".$filename.".xls");
header("Cache-Control:max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter -> save("php://output");


?>