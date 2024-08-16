<?php
/***************************************
회원목록 엑셀다운
***************************************/
$sub_menu = "200100";
include_once('./_common.php');
include_once('../plugin/excel/PHPExcel.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} WHERE (1) AND mb_id not in ('lets080', 'admin') ";

// 조건절 추가하면 ./member_list.php도 추가
if ($stx && $sfl) {
	if ($sfl == "mb_route") {
		$sql_common .= " AND (mb_route LIKE '%{$stx}%' OR mb_route_input LIKE '%{$stx}%')";
	} else {
	    $sql_common .= " AND {$sfl} LIKE '%{$stx}%'";
	}
}
if (strlen($spt) > 0) {	// 입금확인
	if ($spt == "1") {
		$sql_common .= " AND mb_bank_date != '' ";
	} else {
		$sql_common .= " AND mb_bank_date = '' ";
	}
}

$sca = ($_REQUEST['sca'] != '')? $_REQUEST['sca'] : 0;
if ((int)$sca > 0) {
	$sql_common .= " AND mb_group = '{$sca}' ";
}

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

// 리스트
$sql = " select * {$sql_common} {$sql_order}";
$result = sql_query($sql);



// 증정품
$gift_list = getGiftList();
$gift = array();
foreach ($gift_list as $Key=>$val) {
	$gift[$val['idx']] = $val['gf_name'];
}

$list = array();

for ($i=0; $row=sql_fetch_array($result); $i++) {
	// 회원구분
	$mb_level = (int)$row['mb_level'];
	$mb_group = $member_group[$row['mb_group']];

	if ($mb_level == 10) {
		$mb_group = "관리자";
	} else if ($mb_level == 8) {
		$mb_group = "관리자(제휴)";
	}

	// 입금확인일
	$mb_bank_date = ($row['mb_bank_date'])? $row['mb_bank_date'] : "미입금";

	// -- 엑셀추가
	// 증정품
	$mb_gift = $gift[$row['mb_gift_idx']];

	// 주소
	$mb_addr = "(".$row['mb_zip1'].$row['mb_zip2'].") ";
	$mb_addr .= $row['mb_addr1'];
	if ($row['mb_addr2'] != "") $mb_addr .= " ".$row['mb_addr2'];
	
	// 증정품 주소
	$mb_gift_addr = "(".$row['mb_gift_zip'].") ";
	$mb_gift_addr .= $row['mb_gift_addr1'];
	if ($row['mb_gift_addr2'] != "") $mb_gift_addr .= " ".$row['mb_gift_addr2'];

	// 가입구분
	$mb_route = $row['mb_route'];
	if ($row['mb_route_input'] != "") $mb_route .= ":".$row['mb_route_input'];

	// 회사주소
	$mb_cp_addr = "";
	if ($row['mb_cp_zip'] != "") $mb_cp_addr .= "(".$row['mb_cp_zip'].") ";
	if ($row['mb_cp_addr1'] != "") $mb_cp_addr .= $row['mb_cp_addr1'];
	if ($row['mb_cp_addr2'] != "") $mb_cp_addr .= " ".$row['mb_cp_addr2'];


	$list[$i+1] = array(
		"no"=>($i+1),
		"mb_group"=>$mb_group,
		"mb_gift"=>$mb_gift,
		"mb_id"=>$row['mb_id'],
		"mb_name"=>$row['mb_name'],
		"mb_sex"=>$row['mb_sex'],
		"mb_birth"=>$row['mb_birth'],
		"mb_email"=>$row['mb_email'],
		"mb_hp"=>$row['mb_hp'],
		"mb_route"=>$mb_route,
		"mb_addr"=>$mb_addr,
		"mb_cp_addr"=>$mb_cp_addr,
		"mb_bank_amt"=>$row['mb_bank_amt'],
		"mb_bank_date"=>$mb_bank_date,
		"mb_gift_addr"=>$mb_gift_addr,
		"mb_datetime"=>$row['mb_datetime'],
		"mb_today_login"=>$row['mb_today_login']
	);
}

$sheet_title = "회원목록";
$objPHPExcel = new PHPExcel();

// 첫번째 행 지정
$objPHPExcel -> setActiveSheetIndex(0)
-> setCellValue("A1", "NO.")
-> setCellValue("B1", "가입구분")
-> setCellValue("C1", "증정품")
-> setCellValue("D1", "아이디")
-> setCellValue("E1", "이름")
-> setCellValue("F1", "성별")
-> setCellValue("G1", "생년월일")
-> setCellValue("H1", "이메일")
-> setCellValue("I1", "휴대폰")
-> setCellValue("J1", "가입경로")
-> setCellValue("K1", "주소")
-> setCellValue("L1", "회사주소")
-> setCellValue("M1", "가입비")
-> setCellValue("N1", "입금확인일")
-> setCellValue("O1", "증정품_주소")
-> setCellValue("P1", "회원가입일")
-> setCellValue("Q1", "최근접속일");

// 두번째 행부터 데이터 삽입
$count = 1;

foreach($list as $key => $val) {
	$num = 1 + $key;

	$objPHPExcel -> setActiveSheetIndex(0)
	-> setCellValue(sprintf("A%s", $num), $val['no'])
	-> setCellValue(sprintf("B%s", $num), $val['mb_group'])
	-> setCellValue(sprintf("C%s", $num), $val['mb_gift'])
	-> setCellValue(sprintf("D%s", $num), $val['mb_id'])
	-> setCellValue(sprintf("E%s", $num), $val['mb_name'])
	-> setCellValue(sprintf("F%s", $num), $val['mb_sex'])
	-> setCellValue(sprintf("G%s", $num), $val['mb_birth'])
	-> setCellValue(sprintf("H%s", $num), $val['mb_email'])
	-> setCellValue(sprintf("I%s", $num), $val['mb_hp'])
	-> setCellValue(sprintf("J%s", $num), $val['mb_route'])
	-> setCellValue(sprintf("K%s", $num), $val['mb_addr'])
	-> setCellValue(sprintf("L%s", $num), $val['mb_cp_addr'])
	-> setCellValue(sprintf("M%s", $num), $val['mb_bank_amt'])
	-> setCellValue(sprintf("N%s", $num), $val['mb_bank_date'])
	-> setCellValue(sprintf("O%s", $num), $val['mb_gift_addr'])
	-> setCellValue(sprintf("P%s", $num), $val['mb_datetime'])
	-> setCellValue(sprintf("Q%s", $num), $val['mb_today_login']);

	$count++;
}

// 시작열, 끝열 (세팅)
$all_cols = sprintf("A1:Q%s", $count);
$title_cols = "A1:Q1";

// 가로 넓이 조정
// PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
foreach(range('A','Q') as $columnID) {
	$objPHPExcel -> getActiveSheet() -> getColumnDimension($columnID) -> setWidth(20); //setAutoSize(true);
}
$set_cols = array("A"=>10, "C"=>30, "J"=>25, "F"=>10, "H"=>30, "K"=>90, "L"=>90, "O"=>90);
foreach ($set_cols as $col=>$width) {
	$objPHPExcel -> getActiveSheet() -> getColumnDimension($col) -> setWidth($width);
}

// 전체 세로 높이 조정
$objPHPExcel -> getActiveSheet() -> getDefaultRowDimension() -> setRowHeight(17);

// 전체 가운데 정렬
// $objPHPExcel -> getActiveSheet() -> getStyle($all_cols) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// 전체 왼쪽 정렬
$objPHPExcel -> getActiveSheet() -> getStyle($all_cols) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
// 부분 왼쪽 정렬
// $objPHPExcel -> setActiveSheetIndex(0) -> getStyle(sprintf("K2:K%s", $count)) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


// 전체 테두리 지정
// $objPHPExcel -> getActiveSheet() -> getStyle($all_cols) -> getBorders() -> getAllBorders() -> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// 타이틀 부분
$objPHPExcel -> getActiveSheet() -> getStyle($title_cols) -> getFont() -> setBold(true);
$objPHPExcel -> getActiveSheet() -> getStyle($title_cols) -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("CECBCA");

/*
// 내용 지정
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A2:D%s", $count)) -> getFill()
-> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("F4F4F4");
*/

// 시트 네임
$objPHPExcel -> getActiveSheet() -> setTitle($sheet_title);


// 첫번째 시트(Sheet)로 열리게 설정
$objPHPExcel -> setActiveSheetIndex(0);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", $sheet_title);

// 브라우저로 엑셀파일을 리다이렉션
header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".$filename.".xls");
header("Cache-Control:max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter -> save("php://output");

?>