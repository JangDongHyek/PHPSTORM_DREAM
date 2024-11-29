<?php
include_once("./_common.php");

exit;

// PHPExcel.php 파일 경로 지정
include_once("../lib/PHPExcel/PHPExcel.php");

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->getActiveSheet();

// ===== 데이터 =====
// 필요 데이터 : pro_mb_no, center_code, start, end.
$_GET['start'] = '2021-01-04'; // 임시
$_GET['end'] = '2021-01-04'; // 임시
$_REQUEST['option'] = '당일매출'; // 임시
$member['mb_level'] = 9; // 임시

$today = date('Y-m-d');

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";
$sql_search = ' where 1=1 ';

if($member['mb_level'] == 8) { // 프로
    $pro_mb_no = 5; // 임시
    $sql_search .= " and mb.pro_mb_no = '{$pro_mb_no}' ";
}
if($member['mb_level'] == 9) { // 팀장
    $center_code = 'center1'; // 임시
    $sql_search .= " and mb.center_code = '{$center_code}' ";
}

// 프로명 선택 시
$pro = '';
if(!empty($_GET['pro'])) {
    $pro = $_GET['pro'];
    $sql_search .= " and mb.pro_mb_no = '{$pro}' ";
}

// 당일매출 =====
$today = date('Y-m-d');
$sql_search_day = '';

if(!empty($_GET['start'])) {
    $start = $_GET['start'];
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
} else {
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$today}') ";
}
if(!empty($_GET['end'])) {
    $end = $_GET['end'];
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
} else {
    $sql_search_date .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$today}') ";
}

$sql = " select DATE(`pay_date`) as `date`, 
         sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, 
         card_company, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
         {$sql_common} {$sql_search} {$sql_search_date} GROUP BY `date`, mb.mb_no order by `date` asc ";
$result_date = sql_query($sql);
// 당일매출 =====


// 주간매출 =====
$today = date('Y-m-d');
$sql_search_week = '';
// == 이번주 시작일, 종료일 ==
$time = explode(" ",microtime());
$s = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +0/* 시작일 기준 */, date("Y",$time[1]));
$e = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +6/* 종료일 기준 */, date("Y",$time[1]));
$start_week = date("Y-m-d", $s); // 이번주 시작일
$end_week = date("Y-m-d", $e); // 이번주 종료일
// == 이번주 시작일, 종료일 ==
if(!empty($_GET['start'])) {
    $start = $_GET['start'];
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
} else {
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start_week}') ";
}
if(!empty($_GET['end'])) {
    $end = $_GET['end'];
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
} else {
    $sql_search_week .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end_week}') ";
}

$sunday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE())  -1 ) as sunday from dual " )['sunday']; // 이번주의 첫일(일요일)
$friday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE()) + 5 ) as friday from dual " )['friday']; // 이번주의 마지막일(토요일)
$sql = " select DATE_FORMAT(DATE_SUB(`pay_date`, INTERVAL (DAYOFWEEK(`pay_date`)-1) DAY), '%Y-%m-%d') as start,
             DATE_FORMAT(DATE_SUB(`pay_date`, INTERVAL (DAYOFWEEK(`pay_date`)-7) DAY), '%Y-%m-%d') as end,
             DATE_FORMAT(`pay_date`, '%Y%U') AS `date`,
             DATE_FORMAT(`pay_date`, '%Y') AS `year`,
             DATE_FORMAT(`pay_date`, '%m') AS `month`,
             DATE_FORMAT(`pay_date`, '%d') AS `day`,
             FLOOR((DATE_FORMAT(pay_date,'%d')+(DATE_FORMAT(DATE_FORMAT(pay_date,'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month,
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, 
             mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_search_week} GROUP BY `date`, mb.mb_no order by `date` ";
$result_week = sql_query($sql);
// 주간매출 =====


// 월간매출 =====
$sql_search_month = '';

if(!empty($_GET['start'])) {
    $start = substr($_GET['start'], 0, 7);
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') >= '{$start}') ";
} else {
    $today = date('Y').'-01';
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') >= '{$today}') ";
}
if(!empty($_GET['end'])) {
    $end = substr($_GET['end'], 0, 7);
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') <= '{$end}') ";
} else {
    $today = date('Y-m');
    $sql_search_month .= " and (date_format(pay_date, '%Y-%m') <= '{$today}') ";
}

$sql = " select MONTH(`pay_date`) AS `month`, YEAR(`pay_date`) AS 'year', 
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_search_month} GROUP BY `month`, mb.mb_no order by `month` asc ";
$result_month = sql_query($sql);
// 월간매출 =====


// 연간매출 =====
$today = date('Y');
$sql_search_month = '';

if(!empty($_GET['start'])) {
    $start = substr($_GET['start'], 0, 4);
    $sql_search_month .= " and (date_format(pay_date, '%Y') >= '{$start}') ";
} else {
    $sql_search_month .= " and (date_format(pay_date, '%Y') >= '{$today}') ";
}
if(!empty($_GET['end'])) {
    $end = substr($_GET['end'], 0, 4);
    $sql_search_month .= " and (date_format(pay_date, '%Y') <= '{$end}') ";
} else {
    $sql_search_month .= " and (date_format(pay_date, '%Y') <= '{$today}') ";
}

$sql = " select YEAR(`pay_date`) AS `year`, MONTH(`pay_date`) AS `month`, sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_charge_pro, mb.pro_mb_no, sum(`pro_extra_pay`) as pro_extra_pay, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_search_month} GROUP BY `year`, mb.mb_no order by `year` asc ";
$result_year = sql_query($sql);
// 연간매출 =====
// ===== 데이터 =====

// Rename sheet
$sheet->setTitle("당일매출");
$sheet2 = $objPHPExcel->createSheet(2);
$sheet2->setTitle('주간매출');
$sheet3 = $objPHPExcel->createSheet(3);
$sheet3->setTitle('월간매출');
$sheet4 = $objPHPExcel->createSheet(4);
$sheet4->setTitle('연간매출');

// === 셀 입력 ===
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "일자");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", "프로명");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", "회원명");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", "등록일자");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", "건수");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", "현금");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", "신용카드");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", "체크카드");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", "현금+카드");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", "카드사");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", "카드수수료");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L1", "프로수수료");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M1", "매출");

for($i=1; $i<4; $i++) {
    if($i==1) { // 주간
        $objPHPExcel->setActiveSheetIndex($i)->setCellValue("A1", "주차");
    } else if($i==2) { // 월간
        $objPHPExcel->setActiveSheetIndex($i)->setCellValue("A1", "월");
    } else { // 연간
        $objPHPExcel->setActiveSheetIndex($i)->setCellValue("A1", "연도");
    }
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("B1", "프로명");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("C1", "회원명");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("D1", "등록일자");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("E1", "건수");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("F1", "현금");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("G1", "신용카드");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("H1", "체크카드");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("I1", "현금+카드");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("J1", "카드수수료");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("K1", "프로수수료");
    $objPHPExcel->setActiveSheetIndex($i)->setCellValue("L1", "매출");
}

// ===== 데이터 =====
// 당일매출
for($i=2; $row_date=sql_fetch_array($result_date); $i++)
{
    $cash_card = $row_date['cash_price']*1 + $row_date['credit_card_price']*1 + $row_date['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_date['cash_price']*1 + $row_date['credit_card_price']*1 + $row_date['check_card_price']*1 - $row_date['fees']*1;
    $total_sales += $total*1;

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A".$i, $row_date['date'])
        ->setCellValue("B".$i, $row_date['mb_charge_pro'])
        ->setCellValue("C".$i, $row_date['mb_name'])
        ->setCellValue("D".$i, substr($row_date['mb_reg_date'],0,10))
        ->setCellValue("E".$i, $row_date['count'])
        ->setCellValue("F".$i, !empty($row_date['cash_price']) ? number_format($row_date['cash_price']*1) : '')
        ->setCellValue("G".$i, !empty($row_date['credit_card_price']) ? number_format($row_date['credit_card_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_date['check_card_price']) ? number_format($row_date['check_card_price']*1) : '')
        ->setCellValue("I".$i, number_format($cash_card))
        ->setCellValue("J".$i, $row_date['card_company'])
        ->setCellValue("K".$i, !empty($row_date['fees']) ? number_format($row_date['fees']*1) : '')
        ->setCellValue("L".$i, !empty($row_date['pro_extra_pay']) ? number_format($row_date['pro_extra_pay']*1) : '')
        ->setCellValue("M".$i, number_format($total));
}

// 주간매출
for($i=2; $row_week=sql_fetch_array($result_week); $i++)
{
    $cash_card = $row_week['cash_price']*1 + $row_week['credit_card_price']*1 + $row_week['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_week['cash_price']*1 + $row_week['credit_card_price']*1 + $row_week['check_card_price']*1 - $row_week['fees']*1;
    $total_sales += $total*1;

    $objPHPExcel->setActiveSheetIndex(1)
        ->setCellValue("A".$i, $row_week['year'].'년 '.$row_week['month'].'월 '.$row_week['week_of_month'].'주')
        ->setCellValue("B".$i, $row_week['mb_charge_pro'])
        ->setCellValue("C".$i, $row_week['mb_name'])
        ->setCellValue("D".$i, substr($row_week['mb_reg_date'],0,10))
        ->setCellValue("E".$i, $row_week['count'])
        ->setCellValue("F".$i, !empty($row_week['cash_price']) ? number_format($row_week['cash_price']*1) : '')
        ->setCellValue("G".$i, !empty($row_week['credit_card_price']) ? number_format($row_week['credit_card_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_week['check_card_price']) ? number_format($row_week['check_card_price']*1) : '')
        ->setCellValue("I".$i, number_format($cash_card))
        ->setCellValue("J".$i, !empty($row_week['fees']) ? number_format($row_week['fees']*1) : '')
        ->setCellValue("K".$i, !empty($row_week['pro_extra_pay']) ? number_format($row_week['pro_extra_pay']*1) : '')
        ->setCellValue("L".$i, number_format($total));
}

// 월간매출
for($i=2; $row_month=sql_fetch_array($result_month); $i++)
{
    $cash_card = $row_month['cash_price']*1 + $row_month['credit_card_price']*1 + $row_month['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_month['cash_price']*1 + $row_month['credit_card_price']*1 + $row_month['check_card_price']*1 - $row_month['fees']*1;
    $total_sales += $total*1;

    $objPHPExcel->setActiveSheetIndex(2)
        ->setCellValue("A".$i, $row_month['month'].'월')
        ->setCellValue("B".$i, $row_month['mb_charge_pro'])
        ->setCellValue("C".$i, $row_month['mb_name'])
        ->setCellValue("D".$i, substr($row_month['mb_reg_date'],0,10))
        ->setCellValue("E".$i, $row_month['count'])
        ->setCellValue("F".$i, !empty($row_month['cash_price']) ? number_format($row_month['cash_price']*1) : '')
        ->setCellValue("G".$i, !empty($row_month['credit_card_price']) ? number_format($row_month['credit_card_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_month['check_card_price']) ? number_format($row_month['check_card_price']*1) : '')
        ->setCellValue("I".$i, number_format($cash_card))
        ->setCellValue("J".$i, !empty($row_month['fees']) ? number_format($row_month['fees']*1) : '')
        ->setCellValue("K".$i, !empty($row_month['pro_extra_pay']) ? number_format($row_month['pro_extra_pay']*1) : '')
        ->setCellValue("L".$i, number_format($total));
}

// 연간매출
for($i=2; $row_year=sql_fetch_array($result_year); $i++)
{
    $cash_card = $row_year['cash_price']*1 + $row_year['credit_card_price']*1 + $row_year['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row_year['cash_price']*1 + $row_year['credit_card_price']*1 + $row_year['check_card_price']*1 - $row_year['fees']*1;
    $total_sales += $total*1;

    $objPHPExcel->setActiveSheetIndex(3)
        ->setCellValue("A".$i, $row_year['year'].'년')
        ->setCellValue("B".$i, $row_year['mb_charge_pro'])
        ->setCellValue("C".$i, $row_year['mb_name'])
        ->setCellValue("D".$i, substr($row_year['mb_reg_date'],0,10))
        ->setCellValue("E".$i, $row_year['count'])
        ->setCellValue("F".$i, !empty($row_year['cash_price']) ? number_format($row_year['cash_price']*1) : '')
        ->setCellValue("G".$i, !empty($row_year['credit_card_price']) ? number_format($row_year['credit_card_price']*1) : '')
        ->setCellValue("H".$i, !empty($row_year['check_card_price']) ? number_format($row_year['check_card_price']*1) : '')
        ->setCellValue("I".$i, number_format($cash_card))
        ->setCellValue("J".$i, !empty($row_year['fees']) ? number_format($row_year['fees']*1) : '')
        ->setCellValue("K".$i, !empty($row_year['pro_extra_pay']) ? number_format($row_year['pro_extra_pay']*1) : '')
        ->setCellValue("L".$i, number_format($total));
}
// ===== 데이터 =====

// 셀 너비
for ($col = 'A'; $col <= 'M'; $col++) {
    $sheet->getColumnDimension($col)->setWidth(12);
    $sheet2->getColumnDimension($col)->setWidth(12);
    $sheet3->getColumnDimension($col)->setWidth(12);
    $sheet4->getColumnDimension($col)->setWidth(12);
}

// 폰트
$sheet->getDefaultStyle()->getFont()->setName('맑은 고딕');
$sheet2->getDefaultStyle()->getFont()->setName('맑은 고딕');
$sheet3->getDefaultStyle()->getFont()->setName('맑은 고딕');
$sheet4->getDefaultStyle()->getFont()->setName('맑은 고딕');

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", "매출현황");

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit;


//$sql = " select * from g5_member where mb_category = '프로' ";
//$result = sql_query($sql);
//
//for($i=0; $row=sql_fetch_array($result); $i++) {
//    for($k=1; $k<=35; $k++) {
//        $sql = " insert into g5_lesson_time_set_pro set mb_no = {$row['mb_no']}, time_set_idx = {$k}, use_yn = 'Y', reg_date = now(); ";
//        sql_query($sql);
//    }
//}




//$sql = " select * from g5_member where mb_category = '회원' ";
//$result = sql_query($sql);
//
//for($i=0; $row=sql_fetch_array($result); $i++) {
//    $idx = sql_fetch(" select idx from g5_lesson where lesson_code = '{$row['lesson_code']}' and center_code = '{$row['center_code']}' ")['idx'];
//
//    $sql = " update g5_member set lesson_idx = {$idx} where mb_no = {$row['mb_no']} ";
//    sql_query($sql);
//}




//$mb_no = $member['mb_no'];
//$mb = get_member_no($mb_no);
//
//$lesson = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' and center_code = '{$mb['center_code']}' "); // 레슨정보
//
//// === 21.01.14 레슨 기간 제한, 예) 2020-10-22일 3개월 레슨 등록, 2021-02-01일까지 예약 가능 (3개월+10(유예기간))
//$pattern = '/([a-zA-Z0-9])+/';
//$lesson_count = explode('/', $lesson['lesson_count'])[1];
//preg_match_all($pattern, $lesson_count, $match);
//$num = implode('', $match[0]);
//
//if(strpos($lesson_count, '주') !== false) {
//    $term = 'week';
//} else if(strpos($lesson_count, '개월') !== false) {
//    $term = 'months';
//} else if(strpos($lesson_count, '년') !== false) {
//    $term = 'years';
//}
//
//$mb_reg_date = '2021-01-04';
//$timestamp = strtotime($mb['mb_reg_date'] . " +" . $num . $term . " +10 days");
//$available = date('Y-m-d', $timestamp);
//echo $available;
?>