<?php
include_once("./_common.php");

// PHPExcel.php 파일 경로 지정
include_once("../lib/PHPExcel/PHPExcel.php");

ini_set('memory_limit', '1024M');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$sheet1 = $objPHPExcel->getActiveSheet();

// ===== 데이터 =====
$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";
$sql_search = ' where 1=1 ';

// 센터명 선택 시
$center = '';
if(!empty($_GET['center'])) {
    $center = $_GET['center'];
    $sql_search .= " and mb.center_code = '{$center}' ";
} else {
    $sql_search .= " and mb.center_code = '{$center}' ";
}

// 프로명 선택 시
$pro = '';
if(!empty($_GET['pro'])) {
    $pro = $_GET['pro'];
    $sql_search .= " and mb.pro_mb_no = '{$pro}' ";
}

// 당일매출 =====
$sql_search_day = '';

if(!empty($_GET['start'])) {
    $start_date = $_GET['start'];
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start_date}') ";
} else {
    $start_date = date('Y-m-d');
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start_date}') ";
}
if(!empty($_GET['end'])) {
    $end_date = $_GET['end'];
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end_date}') ";
} else {
    $end_date = date('Y-m-d');
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end_date}') ";
}

$sql = " select mb.mb_center, DATE(`pay_date`) as `date`, 
         sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, 
         card_company, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
         {$sql_common} {$sql_search} {$sql_search_date} GROUP BY `date`, mb.mb_no order by `date` asc ";
$result_date = sql_query($sql);
// 당일매출 =====


// 주간매출 =====
$sql_search_week = '';
// == 이번주 시작일, 종료일 ==
$time = explode(" ",microtime());
$s = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +0/* 시작일 기준 */, date("Y",$time[1]));
$e = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +6/* 종료일 기준 */, date("Y",$time[1]));
$start_week = date("Y-m-d", $s); // 이번주 시작일
$end_week = date("Y-m-d", $e); // 이번주 종료일
// == 이번주 시작일, 종료일 ==
if(!empty($_GET['start'])) {
    $start_week = $_GET['start'];
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start_week}') ";
} else {
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start_week}') ";
}
if(!empty($_GET['end'])) {
    $end_week = $_GET['end'];
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end_week}') ";
} else {
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end_week}') ";
}

$sunday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE())  -1 ) as sunday from dual " )['sunday']; // 이번주의 첫일(일요일)
$saturday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE()) + 5 ) as saturday from dual " )['saturday']; // 이번주의 마지막일(토요일)
$sql = " select DATE_FORMAT(DATE_SUB(`pay_date`, INTERVAL (DAYOFWEEK(`pay_date`)-1) DAY), '%Y-%m-%d') as start,
             DATE_FORMAT(DATE_SUB(`pay_date`, INTERVAL (DAYOFWEEK(`pay_date`)-7) DAY), '%Y-%m-%d') as end,
             DATE_FORMAT(`pay_date`, '%Y%U') AS `date`,
             DATE_FORMAT(`pay_date`, '%Y') AS `year`,
             DATE_FORMAT(`pay_date`, '%m') AS `month`,
             DATE_FORMAT(`pay_date`, '%d') AS `day`,
             FLOOR((DATE_FORMAT(pay_date,'%d')+(DATE_FORMAT(DATE_FORMAT(pay_date,'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month,
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, 
             mb.mb_center, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_search_week} GROUP BY `date`, mb.mb_no order by `date` ";
$result_week = sql_query($sql);
// 주간매출 =====


// 월간매출 =====
$sql_search_month = '';

if(!empty($_GET['start'])) {
    $start_month = substr($_GET['start'], 0, 7);
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') >= '{$start_month}') ";
} else {
    $start_month = date('Y').'-01';
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') >= '{$start_month}') ";
}
if(!empty($_GET['end'])) {
    $end_month = substr($_GET['end'], 0, 7);
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') <= '{$end_month}') ";
} else {
    $end_month = date('Y-m');
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') <= '{$end_month}') ";
}

$sql = " select MONTH(`pay_date`) AS `month`, YEAR(`pay_date`) AS 'year', 
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_center, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_search_month} GROUP BY `month`, mb.mb_no order by `month` asc ";
$result_month = sql_query($sql);
// 월간매출 =====


// 연간매출 =====
$sql_search_month = '';

if(!empty($_GET['start'])) {
    $start_year = substr($_GET['start'], 0, 4);
    $sql_search_month .= " and (date_format(pay_date, '%Y') >= '{$start_year}') ";
} else {
    $start_year = date('Y');
    $sql_search_month .= " and (date_format(pay_date, '%Y') >= '{$start_year}') ";
}
if(!empty($_GET['end'])) {
    $end_year = substr($_GET['end'], 0, 4);
    $sql_search_month .= " and (date_format(pay_date, '%Y') <= '{$end_year}') ";
} else {
    $end_year = date('Y');
    $sql_search_month .= " and (date_format(pay_date, '%Y') <= '{$end_year}') ";
}

$sql = " select YEAR(`pay_date`) AS `year`, MONTH(`pay_date`) AS `month`, sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_center, mb.mb_charge_pro, mb.pro_mb_no, sum(`pro_extra_pay`) as pro_extra_pay, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_search_month} GROUP BY `year`, mb.mb_no order by `year` asc ";
$result_year = sql_query($sql);
// 연간매출 =====
// ===== 데이터 =====

// Rename sheet
$sheet1->setTitle("당일매출");
$sheet2 = $objPHPExcel->createSheet(2);
$sheet2->setTitle('주간매출');
$sheet3 = $objPHPExcel->createSheet(3);
$sheet3->setTitle('월간매출');
$sheet4 = $objPHPExcel->createSheet(4);
$sheet4->setTitle('연간매출');

$sheet1->setCellValue('A1','당일매출 ('.$start_date.' ~ '.$end_date.')');
$sheet2->setCellValue('A1','주간매출 ('.$start_week.' ~ '.$end_week.')');
$sheet3->setCellValue('A1','월간매출 ('.$start_month.' ~ '.$end_month.')');
$sheet4->setCellValue('A1','연간매출 ('.$start_year.' ~ '.$end_year.')');

// ===== 셀 입력 =====
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:K1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L1:N1');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "센터");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "일자");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "프로명");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "회원명");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "등록일자");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "건수");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "현금");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "신용카드");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "체크카드");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "현금+카드");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K2", "카드사");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L2", "카드수수료");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M2", "프로수수료");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("N2", "매출");

for($i=1; $i<4; $i++) {
    $objPHPExcel->setActiveSheetIndex($i)->mergeCells('A1:J1');
    $objPHPExcel->setActiveSheetIndex($i)->mergeCells('K1:M1');
    
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("A2", "센터");
    if($i==1) { // 주간
        $objPHPExcel->setActiveSheetIndex($i)->setCellValue("B2", "주차");
    } else if($i==2) { // 월간
        $objPHPExcel->setActiveSheetIndex($i)->setCellValue("B2", "월");
    } else { // 연간
        $objPHPExcel->setActiveSheetIndex($i)->setCellValue("B2", "연도");
    }
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("C2", "프로명");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("D2", "회원명");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("E2", "등록일자");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("F2", "건수");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("G2", "현금");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("H2", "신용카드");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("I2", "체크카드");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("J2", "현금+카드");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("K2", "카드수수료");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("L2", "프로수수료");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("M2", "매출");
}
// ===== 셀 입력 =====

// ===== 데이터 =====
// 당일매출
$total_sales = 0;
for($i=3; $row_date=sql_fetch_array($result_date); $i++)
{
    $cash_card = $row_date['cash_price']*1 + $row_date['credit_card_price']*1 + $row_date['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_date['cash_price']*1 + $row_date['credit_card_price']*1 + $row_date['check_card_price']*1 - $row_date['fees']*1;
    $total_sales += $total*1;

    $sheet1->setCellValue('L1', '총 합계 : '.number_format($total_sales));

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A".$i, $row_date['mb_center'])
        ->setCellValue("B".$i, $row_date['date'])
        ->setCellValue("C".$i, $row_date['mb_charge_pro'])
        ->setCellValue("D".$i, $row_date['mb_name'])
        ->setCellValue("E".$i, substr($row_date['mb_reg_date'],0,10))
        ->setCellValue("F".$i, $row_date['count'])
        ->setCellValue("G".$i, !empty($row_date['cash_price']) ? number_format($row_date['cash_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_date['credit_card_price']) ? number_format($row_date['credit_card_price']*1) : '')
        ->setCellValue("I".$i, !empty($row_date['check_card_price']) ? number_format($row_date['check_card_price']*1) : '')
        ->setCellValue("J".$i, number_format($cash_card))
        ->setCellValue("K".$i, $row_date['card_company'])
        ->setCellValue("L".$i, !empty($row_date['fees']) ? number_format($row_date['fees']*1) : '')
        ->setCellValue("M".$i, !empty($row_date['pro_extra_pay']) ? number_format($row_date['pro_extra_pay']*1) : '')
        ->setCellValue("N".$i, number_format($total));
}

// 주간매출
$total_sales = 0;
for($i=3; $row_week=sql_fetch_array($result_week); $i++)
{
    $cash_card = $row_week['cash_price']*1 + $row_week['credit_card_price']*1 + $row_week['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_week['cash_price']*1 + $row_week['credit_card_price']*1 + $row_week['check_card_price']*1 - $row_week['fees']*1;
    $total_sales += $total*1;
    
    $sheet2->setCellValue('K1', '총 합계 : '.number_format($total_sales));

    $objPHPExcel->setActiveSheetIndex(1)
        ->setCellValue("A".$i, $row_week['mb_center'])
        ->setCellValue("B".$i, $row_week['year'].'년 '.$row_week['month'].'월 '.$row_week['week_of_month'].'주')
        ->setCellValue("C".$i, $row_week['mb_charge_pro'])
        ->setCellValue("D".$i, $row_week['mb_name'])
        ->setCellValue("E".$i, substr($row_week['mb_reg_date'],0,10))
        ->setCellValue("F".$i, $row_week['count'])
        ->setCellValue("G".$i, !empty($row_week['cash_price']) ? number_format($row_week['cash_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_week['credit_card_price']) ? number_format($row_week['credit_card_price']*1) : '')
        ->setCellValue("I".$i, !empty($row_week['check_card_price']) ? number_format($row_week['check_card_price']*1) : '')
        ->setCellValue("J".$i, number_format($cash_card))
        ->setCellValue("K".$i, !empty($row_week['fees']) ? number_format($row_week['fees']*1) : '')
        ->setCellValue("L".$i, !empty($row_week['pro_extra_pay']) ? number_format($row_week['pro_extra_pay']*1) : '')
        ->setCellValue("M".$i, number_format($total));
}


// 월간매출
$total_sales = 0;
for($i=3; $row_month=sql_fetch_array($result_month); $i++)
{
    $cash_card = $row_month['cash_price']*1 + $row_month['credit_card_price']*1 + $row_month['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_month['cash_price']*1 + $row_month['credit_card_price']*1 + $row_month['check_card_price']*1 - $row_month['fees']*1;
    $total_sales += $total*1;
    
    $sheet3->setCellValue('K1', '총 합계 : '.number_format($total_sales));

    $objPHPExcel->setActiveSheetIndex(2)
        ->setCellValue("A".$i, $row_month['mb_center'])
        ->setCellValue("B".$i, $row_month['month'].'월')
        ->setCellValue("C".$i, $row_month['mb_charge_pro'])
        ->setCellValue("D".$i, $row_month['mb_name'])
        ->setCellValue("E".$i, substr($row_month['mb_reg_date'],0,10))
        ->setCellValue("F".$i, $row_month['count'])
        ->setCellValue("G".$i, !empty($row_month['cash_price']) ? number_format($row_month['cash_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_month['credit_card_price']) ? number_format($row_month['credit_card_price']*1) : '')
        ->setCellValue("I".$i, !empty($row_month['check_card_price']) ? number_format($row_month['check_card_price']*1) : '')
        ->setCellValue("J".$i, number_format($cash_card))
        ->setCellValue("K".$i, !empty($row_month['fees']) ? number_format($row_month['fees']*1) : '')
        ->setCellValue("L".$i, !empty($row_month['pro_extra_pay']) ? number_format($row_month['pro_extra_pay']*1) : '')
        ->setCellValue("M".$i, number_format($total));
}

// 연간매출
$total_sales = 0;
for($i=3; $row_year=sql_fetch_array($result_year); $i++)
{
    $cash_card = $row_year['cash_price']*1 + $row_year['credit_card_price']*1 + $row_year['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_year['cash_price']*1 + $row_year['credit_card_price']*1 + $row_year['check_card_price']*1 - $row_year['fees']*1;
    $total_sales += $total*1;
    
    $sheet4->setCellValue('K1', '총 합계 : '.number_format($total_sales));

    $objPHPExcel->setActiveSheetIndex(3)
        ->setCellValue("A".$i, $row_year['mb_center'])
        ->setCellValue("B".$i, $row_year['year'].'년')
        ->setCellValue("C".$i, $row_year['mb_charge_pro'])
        ->setCellValue("D".$i, $row_year['mb_name'])
        ->setCellValue("E".$i, substr($row_year['mb_reg_date'],0,10))
        ->setCellValue("F".$i, $row_year['count'])
        ->setCellValue("G".$i, !empty($row_year['cash_price']) ? number_format($row_year['cash_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_year['credit_card_price']) ? number_format($row_year['credit_card_price']*1) : '')
        ->setCellValue("I".$i, !empty($row_year['check_card_price']) ? number_format($row_year['check_card_price']*1) : '')
        ->setCellValue("J".$i, number_format($cash_card))
        ->setCellValue("K".$i, !empty($row_year['fees']) ? number_format($row_year['fees']*1) : '')
        ->setCellValue("L".$i, !empty($row_year['pro_extra_pay']) ? number_format($row_year['pro_extra_pay']*1) : '')
        ->setCellValue("M".$i, number_format($total));
}
// ===== 데이터 =====

// 셀 너비
for ($col = 'A'; $col <= 'M'; $col++) {
    $sheet1->getColumnDimension($col)->setWidth(12);
    $sheet2->getColumnDimension($col)->setWidth(12);
    $sheet3->getColumnDimension($col)->setWidth(12);
    $sheet4->getColumnDimension($col)->setWidth(12);
}

// 스타일
for($i=0; $i<4; $i++) {
    $objPHPExcel->setActiveSheetIndex($i)->getDefaultStyle()->getFont()->setName('맑은 고딕');
    $objPHPExcel->setActiveSheetIndex($i)->getStyle('A1')->getFont()->setSize(13)->setBold(true);
    $objPHPExcel->setActiveSheetIndex($i)->getStyle('L1')->getFont()->setSize(13)->setBold(true);
    $objPHPExcel->setActiveSheetIndex($i)->getStyle('K1')->getFont()->setSize(13)->setBold(true);
    $objPHPExcel->setActiveSheetIndex($i)->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->setActiveSheetIndex($i)->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->setActiveSheetIndex($i)->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
}

// 엑셀 파일 오픈시 활성화될 시트
$objPHPExcel->setActiveSheetIndex(0);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", "매출현황");

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit;
?>