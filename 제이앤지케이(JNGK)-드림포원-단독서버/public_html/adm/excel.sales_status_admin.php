<?php
include_once("./_common.php");

// PHPExcel.php 파일 경로 지정
include_once("../lib/PHPExcel/PHPExcel.php");

ini_set('memory_limit', '1024M');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->getActiveSheet();

// ===== 데이터 =====
$today = date('Y-m-d');

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";
$sql_search = " where 1=1 and mb.use_yn = 'Y' and mb.center_code != 'center10' "; // center10 : 테스트

// 센터명 선택 시
$center = '';
if(!empty($_GET['center'])) {
    $center = $_GET['center'];
    $sql_search .= " and mb.center_code = '{$center}' ";
} else {
    $sql_search .= " and sa.unpaid != 'Y' ";
}

// 프로명 선택 시
$pro = '';
if(!empty($_GET['pro'])) {
    $pro = $_GET['pro'];
    $sql_search .= " and sa.pro_mb_no = '{$pro}' ";
}

if ($_REQUEST['option'] == '당일매출') {
    if(!empty($_GET['start'])) {
        $start = $_GET['start'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $start = date('Y-m-d');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $end = date('Y-m-d');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    }

    $sql_group = " group by mb.center_code ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , date, sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}
else if ($_REQUEST['option'] == '월간매출') {
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 7);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') >= '{$start}') ";
    } else {
        $start = date('Y-m');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 7);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') <= '{$end}') ";
    } else {
        $end = date('Y-m');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') <= '{$end}') ";
    }

    $sql_group = " group by mb.center_code ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , month, sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}
else if ($_REQUEST['option'] == '주간매출') {
    // == 이번주 시작일, 종료일 ==
    $time = explode(" ",microtime());
    $s = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +0/* 시작일 기준 */, date("Y",$time[1]));
    $e = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +6/* 종료일 기준 */, date("Y",$time[1]));
    // == 이번주 시작일, 종료일 ==
    if(!empty($_GET['start'])) {
        $start = $_GET['start'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $start = date("Y-m-d", $s); // 이번주 시작일
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $end = date("Y-m-d", $e); // 이번주 종료일
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    }

    $sql_group = " group by mb.center_code ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , date, sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}
else {
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 4);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') >= '{$start}') ";
    } else {
        $start = date('Y');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 4);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') <= '{$end}') ";
    } else {
        $end = date('Y');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') <= '{$end}') ";
    }

    $sql_group = " group by mb.center_code, year ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}

if($_REQUEST['option'] == '당일매출') {
    $sql = " select mb.mb_center, DATE(sa.mb_reg_date) as date, 
             sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
             card_company, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
             sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else if($_REQUEST['option'] == '월간매출') {
    $sql = " select MONTH(sa.mb_reg_date) AS month, YEAR(sa.mb_reg_date) AS 'year', 
             sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, 
             sum(fees) as fees, mb.mb_center, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
             sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else if($_REQUEST['option'] == '주간매출') {
    $sunday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE())  -1 ) as sunday from dual " )['sunday']; // 이번주의 첫일(일요일)
    $saturday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE()) + 5 ) as saturday from dual " )['saturday']; // 이번주의 마지막일(토요일)
    $sql = " select DATE_FORMAT(DATE_SUB(sa.mb_reg_date, INTERVAL (DAYOFWEEK(sa.mb_reg_date)-1) DAY), '%Y-%m-%d') as start,
             DATE_FORMAT(DATE_SUB(sa.mb_reg_date, INTERVAL (DAYOFWEEK(sa.mb_reg_date)-7) DAY), '%Y-%m-%d') as end,
             DATE_FORMAT(sa.mb_reg_date, '%Y%U') AS date,
             DATE_FORMAT(sa.mb_reg_date, '%Y') AS year,
             DATE_FORMAT(sa.mb_reg_date, '%m') AS month,
             DATE_FORMAT(sa.mb_reg_date, '%d') AS day,
             FLOOR((DATE_FORMAT(mb_reg_date,'%d')+(DATE_FORMAT(DATE_FORMAT(mb_reg_date,'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month,
             sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
             mb.mb_center, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
             sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else {
    $sql = " select YEAR(sa.mb_reg_date) AS year, MONTH(sa.mb_reg_date) AS month, sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, 
             sum(fees) as fees, mb.mb_center, mb.mb_charge_pro, sa.pro_mb_no, sum(pro_extra_pay) as pro_extra_pay, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
             sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
//echo $sql;exit;
//if($private) { echo $sql;exit; }
$result = sql_query($sql);

// ===== 데이터 =====
//$sheet->setCellValue('A1',$_REQUEST['option'].' ('.$start.' ~ '.$end.')');

// 셀 입력
if(empty($_GET['center'])) // 전체
{
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "센터");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "현금");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "신용카드");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "체크카드");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "현금+카드");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "카드수수료");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "프로수수료");
    /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "본사지급액");*/
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "매출");
}
else // 아카데미별
{
    if ($_REQUEST['option'] == '당일매출') {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "센터");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "일자");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "프로명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "현금");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "신용카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "체크카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "현금+카드");
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "카드사");*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "카드수수료");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "프로수수료");
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K2", "본사지급액");*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "매출");
    }
    else {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "센터");
        if ($_REQUEST['option'] == '주간매출') {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "주차");
        } else if ($_REQUEST['option'] == '월간매출') {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "월");
        } else if ($_REQUEST['option'] == '연간매출') {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "연도");
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "프로명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "현금");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "신용카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "체크카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "현금+카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "카드수수료");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "프로수수료");
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "본사지급액");*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "매출");
    }
}

// Rename sheet
$sheet->setTitle($_REQUEST['option']);

// ===== 데이터 =====
for($i=3; $row=sql_fetch_array($result); $i++)
{
    $cash_card = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1 - $row['fees']*1;

    $total_cash += $row['cash_price']*1;
    $total_credit += $row['credit_card_price']*1;
    $total_check += $row['check_card_price']*1;
    $total_cash_card += $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
    $total_card_fees += $row['fees']*1;
    /*$total_pro_fees += $row['pro_extra_pay']*1;*/
    $total_pro_fees += $row['cash_price']*1 - ($row['pro_extra_pay']*1 + ($row['cash_price'] * $row['pay_percent'] / 100)); // 프로수수료(합계) = 현금(합계) - (프로수수료(합계)+(현금(합계)*프로수수료율))
    $total_headoffice_pay += $row['headoffice_pay']*1;
    $total_sales += $total*1;

    if(empty($_GET['center'])) // 전체
    {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A".$i, $row['mb_center'])
            ->setCellValue("B".$i, !empty($row['cash_price']) ? number_format($row['cash_price']*1) : '')
            ->setCellValue("C".$i, !empty($row['credit_card_price']) ? number_format($row['credit_card_price']*1) : '')
            ->setCellValue("D".$i, !empty($row['check_card_price']) ? number_format($row['check_card_price']*1) : '')
            ->setCellValue("E".$i, number_format($cash_card))
            ->setCellValue("F".$i, !empty($row['fees']) ? number_format($row['fees']*1) : '')
            ->setCellValue("G".$i, !empty($row['pro_extra_pay']) ? number_format($row['pro_extra_pay']*1) : '')
            /*->setCellValue("H".$i, !empty($row['headoffice_pay']) ? number_format($row['headoffice_pay']*1) : '')*/
            ->setCellValue("H".$i, number_format($total));
    }
    else // 아카데미별
    {
        if ($_REQUEST['option'] == '당일매출') {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A".$i, $row['mb_center'])
                ->setCellValue("B".$i, $row['date'])
                ->setCellValue("C".$i, $row['mb_charge_pro'])
                ->setCellValue("D".$i, !empty($row['cash_price']) ? number_format($row['cash_price']*1) : '')
                ->setCellValue("E".$i, !empty($row['credit_card_price']) ? number_format($row['credit_card_price']*1) : '')
                ->setCellValue("F".$i, !empty($row['check_card_price']) ? number_format($row['check_card_price']*1) : '')
                ->setCellValue("G".$i, number_format($cash_card))
                /*->setCellValue("H".$i, $row['card_company'])*/
                ->setCellValue("H".$i, !empty($row['fees']) ? number_format($row['fees']*1) : '')
                ->setCellValue("I".$i, !empty($row['pro_extra_pay']) ? number_format($row['pro_extra_pay']*1) : '')
                /*->setCellValue("K".$i, !empty($row['headoffice_pay']) ? number_format($row['headoffice_pay']*1) : '')*/
                ->setCellValue("J".$i, number_format($total));
        } else {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$i, $row['mb_center']);
            if ($_REQUEST['option'] == '주간매출') {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$i, $row['year'].'년 '.$row['month'].'월 '.$row['week_of_month'].'주');
            } else if ($_REQUEST['option'] == '월간매출') {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$i, $row['month'].'월');
            } else {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$i, $row['year'].'년');
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("C".$i, $row['mb_charge_pro'])
                ->setCellValue("D".$i, !empty($row['cash_price']) ? number_format($row['cash_price']*1) : '')
                ->setCellValue("E".$i, !empty($row['credit_card_price']) ? number_format($row['credit_card_price']*1) : '')
                ->setCellValue("F".$i, !empty($row['check_card_price']) ? number_format($row['check_card_price']*1) : '')
                ->setCellValue("G".$i, number_format($cash_card))
                ->setCellValue("H".$i, !empty($row['fees']) ? number_format($row['fees']*1) : '')
                ->setCellValue("I".$i, !empty($row['pro_extra_pay']) ? number_format($row['pro_extra_pay']*1) : '')
                /*->setCellValue("J".$i, !empty($row['headoffice_pay']) ? number_format($row['headoffice_pay']*1) : '')*/
                ->setCellValue("J".$i, number_format($total));
        }
    }
}

// 프로수수료(합계)가 현금(합계)보다 작을 시 '-' 붙이고 빨간색
if($total_pro_fees < $total_cash) {
    if($total_pro_fees > 0) { $total_pro_fees = '-'.$total_pro_fees; }
}
// 현금이 0일 경우는 '-' 붙이지 않고 검은색
if($total_cash == 0) {
    if($total_pro_fees < 0) { $total_pro_fees = abs($total_pro_fees); }
}

if(!empty($center)) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", '합 계');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", number_format($total_cash));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", number_format($total_credit));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", number_format($total_check));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", number_format($total_cash_card));
    if($_REQUEST['option'] == '당일매출') {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", number_format($total_card_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", number_format($total_pro_fees));
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", number_format($total_headoffice_pay));*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", number_format($total_sales));
    } else {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", number_format($total_card_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", number_format($total_pro_fees));
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", number_format($total_headoffice_pay));*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", number_format($total_sales));
    }
}
else {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", '합 계');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", number_format($total_cash));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", number_format($total_credit));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", number_format($total_check));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", number_format($total_cash_card));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", number_format($total_card_fees));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", number_format($total_pro_fees));
    /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", number_format($total_headoffice_pay));*/
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", number_format($total_sales));
}
// ===== 데이터 =====

// 스타일
$sheet->getDefaultStyle()->getFont()->setName('맑은 고딕');

// 셀 너비
for ($col = 'A'; $col <= 'L'; $col++) {
    $sheet->getColumnDimension($col)->setWidth(12);
    $sheet->getStyle($col.'2')->getFont()->setBold(true);
    $sheet->getStyle($col.'1')->getFont()->setSize(13)->setBold(true);
}

//$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// 문서 열어볼 시 미리 선택되어지는 셀
$sheet->setSelectedCellByColumnAndRow(0, 1);

if(empty($center)) { $center_name = '전체'; }
else { $center_name = sql_fetch(" select center_name from g5_center where center_code = '{$center}' ")['center_name']; }

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", $_REQUEST['option'].'('.$start.'~'.$end.')'.'_'.$center_name);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit;
?>