<?php
include_once("./_common.php");

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

if ($_REQUEST['option'] == '당일매출') {
    $today = date('Y-m-d');
    if(!empty($_GET['start'])) {
        $start = $_GET['start'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$today}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$today}') ";
    }

    $sql_group = " GROUP BY `date`, mb.mb_no ";
    $sql_order = " order by `date` asc "; // with rollup 적용 시 오류
}
else if ($_REQUEST['option'] == '월간매출') {
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 7);
        $sql_search .= " and (date_format(pay_date, '%Y-%m') >= '{$start}') ";
    } else {
        $today = date('Y').'-01';
        $sql_search .= " and (date_format(pay_date, '%Y-%m') >= '{$today}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 7);
        $sql_search .= " and (date_format(pay_date, '%Y-%m') <= '{$end}') ";
    } else {
        $today = date('Y-m');
        $sql_search .= " and (date_format(pay_date, '%Y-%m') <= '{$today}') ";
    }

    $sql_group = " GROUP BY `month`, mb.mb_no ";
    $sql_order = " order by `month` asc ";
}
else if ($_REQUEST['option'] == '주간매출') {
    $today = date('Y-m-d');
    // == 이번주 시작일, 종료일 ==
    $time = explode(" ",microtime());
    $s = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +0/* 시작일 기준 */, date("Y",$time[1]));
    $e = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +6/* 종료일 기준 */, date("Y",$time[1]));
    $start_week = date("Y-m-d", $s); // 이번주 시작일
    $end_week = date("Y-m-d", $e); // 이번주 종료일
    // == 이번주 시작일, 종료일 ==
    if(!empty($_GET['start'])) {
        $start = $_GET['start'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start_week}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end_week}') ";
    }

    $sql_group = " GROUP BY `date`, mb.mb_no ";
    $sql_order = " order by `date` ";
}
else {
    $today = date('Y');
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 4);
        $sql_search .= " and (date_format(pay_date, '%Y') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(pay_date, '%Y') >= '{$today}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 4);
        $sql_search .= " and (date_format(pay_date, '%Y') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(pay_date, '%Y') <= '{$today}') ";
    }

    $sql_group = " GROUP BY `year`, mb.mb_no ";
    $sql_order = " order by `year` asc ";
}

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if($member['mb_level'] == 8) {
    $colspan = 10; // 합계 추가 시 11으로 변경
} else {
    $colspan = 12; // 합계 추가 시 13으로 변경
}

if($_REQUEST['option'] == '당일매출') {
    $sql = " select DATE(`pay_date`) as `date`, 
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, 
             card_company, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";

    if($member['mb_level'] == 8) {
        $colspan = 11; // 합계 추가 시 12으로 변경
    } else {
        $colspan = 13; // 합계 추가 시 14으로 변경
    }
}
else if($_REQUEST['option'] == '월간매출') {
    $sql = " select MONTH(`pay_date`) AS `month`, YEAR(`pay_date`) AS 'year', 
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
}
else if($_REQUEST['option'] == '주간매출') {
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
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
}
else {
    $sql = " select YEAR(`pay_date`) AS `year`, MONTH(`pay_date`) AS `month`, sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_charge_pro, mb.pro_mb_no, sum(`pro_extra_pay`) as pro_extra_pay, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
}
//echo $sql;exit;
$result = sql_query($sql);

// ===== 데이터 =====


// 셀 입력
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

// Rename sheet
$sheet->setTitle("당일매출");

// ===== 데이터 =====
for($i=2; $row=sql_fetch_array($result); $i++)
{
    $cash_card = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1 - $row['fees']*1;
    $total_sales += $total*1;

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A".$i, $row['date'])
        ->setCellValue("B".$i, $row['mb_charge_pro'])
        ->setCellValue("C".$i, $row['mb_name'])
        ->setCellValue("D".$i, substr($row['mb_reg_date'],0,10))
        ->setCellValue("E".$i, $row['count'])
        ->setCellValue("F".$i, !empty($row['cash_price']) ? number_format($row['cash_price']*1) : '')
        ->setCellValue("G".$i, !empty($row['credit_card_price']) ? number_format($row['credit_card_price']*1) : '')
        ->setCellValue("H".$i, !empty($row['check_card_price']) ? number_format($row['check_card_price']*1) : '')
        ->setCellValue("I".$i, number_format($cash_card))
        ->setCellValue("J".$i, $row['card_company'])
        ->setCellValue("K".$i, !empty($row['fees']) ? number_format($row['fees']*1) : '')
        ->setCellValue("L".$i, !empty($row['pro_extra_pay']) ? number_format($row['pro_extra_pay']*1) : '')
        ->setCellValue("M".$i, number_format($total));
}
// ===== 데이터 =====

$objPHPExcel2 = $objPHPExcel->createSheet(2);
$objPHPExcel2->setTitle('주간매출');

// 셀 너비
for ($col = 'A'; $col <= 'M'; $col++) {
    $sheet->getColumnDimension($col)->setWidth(10);
}

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", "매츌");

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