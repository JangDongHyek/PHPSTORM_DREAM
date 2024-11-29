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
$sql_search = " where 1=1 and mb.use_yn = 'Y' ";

if($member['mb_level'] == 8) { // 프로
    $sql_search .= " and sa.pro_mb_no = '{$member['mb_no']}' ";
}
if($member['mb_level'] == 9) { // 팀장
    $sql_search .= " and mb.center_code = '{$member['center_code']}' ";
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

    $sql_group = " GROUP BY date, mb.mb_no ";
    $sql_order = " order by date asc "; // with rollup 적용 시 오류
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

    $sql_group = " GROUP BY month, mb.mb_no ";
    $sql_order = " order by date asc ";
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

    $sql_group = " GROUP BY date, mb.mb_no ";
    $sql_order = " order by DATE(sa.mb_reg_date) asc ";
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

    $sql_group = " GROUP BY year, mb.mb_no ";
    $sql_order = " order by date asc ";
}

if($_REQUEST['option'] == '당일매출') {
    $sql = " select DATE(sa.mb_reg_date) as date, 
             sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
             card_company, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else if($_REQUEST['option'] == '월간매출') {
    $sql = " select MONTH(sa.mb_reg_date) AS month, YEAR(sa.mb_reg_date) AS 'year', DATE(sa.mb_reg_date) as date,
             sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, 
             sum(fees) as fees, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent
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
             FLOOR((DATE_FORMAT(sa.mb_reg_date,'%d')+(DATE_FORMAT(DATE_FORMAT(sa.mb_reg_date,'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month,
             sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
             mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else {
    $sql = " select YEAR(sa.mb_reg_date) AS year, MONTH(sa.mb_reg_date) AS month, DATE(sa.mb_reg_date) as date, sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, 
             sum(fees) as fees, mb.mb_charge_pro, sa.pro_mb_no, sum(pro_extra_pay) as pro_extra_pay, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
//echo $sql;exit;
$result = sql_query($sql);

// ===== 데이터 =====
//$sheet->setCellValue('A1',$_REQUEST['option'].' ('.$start.' ~ '.$end.')');

// 셀 입력
if ($_REQUEST['option'] == '당일매출') {

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "일자");
    if($member['mb_level'] == 8) { // 프로
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "회원명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "등록일자");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "건수");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "현금");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "신용카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "체크카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "현금+카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "카드사");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "카드수수료");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K2", "프로수수료");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L2", "매출");
    }
    else if($member['mb_level'] == 9) { // 팀장
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "프로명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "회원명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "등록일자");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "건수");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "현금");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "신용카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "체크카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "현금+카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "카드사");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K2", "카드수수료");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L2", "프로수수료");
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M2", "본사지급액");*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("M2", "매출");
    }

}
else {
    if ($_REQUEST['option'] == '주간매출') {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "주차");
    } else if ($_REQUEST['option'] == '월간매출') {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "월");
    } else if ($_REQUEST['option'] == '연간매출') {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", "연도");
    }

    if($member['mb_level'] == 8) { // 프로
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "회원명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "등록일자");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "건수");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "현금");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "신용카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "체크카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "현금+카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "카드수수료");
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "프로수수료");*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "매출");
    }
    else if($member['mb_level'] == 9) { // 팀장
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B2", "프로명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C2", "회원명");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D2", "등록일자");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2", "건수");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F2", "현금");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "신용카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "체크카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "현금+카드");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "카드수수료");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K2", "프로수수료");
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L2", "본사지급액");*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L2", "매출");
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

    if ($_REQUEST['option'] == '당일매출') {

        if($member['mb_level'] == 8) { // 프로
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A".$i, $row['date'])
                ->setCellValue("B".$i, $row['mb_name'])
                ->setCellValue("C".$i, substr($row['mb_reg_date'],0,10))
                ->setCellValue("D".$i, $row['count'])
                ->setCellValue("E".$i, !empty($row['cash_price']) ? number_format($row['cash_price']*1) : '')
                ->setCellValue("F".$i, !empty($row['credit_card_price']) ? number_format($row['credit_card_price']*1) : '')
                ->setCellValue("G".$i, !empty($row['check_card_price']) ? number_format($row['check_card_price']*1) : '')
                ->setCellValue("H".$i, number_format($cash_card))
                ->setCellValue("I".$i, $row['card_company'])
                ->setCellValue("J".$i, !empty($row['fees']) ? number_format($row['fees']*1) : '')
                ->setCellValue("K".$i, !empty($row['pro_extra_pay']) ? number_format($row['pro_extra_pay']*1) : '')
                ->setCellValue("L".$i, number_format($total));
        }
        else if($member['mb_level'] == 9) { // 팀장
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
                /*->setCellValue("M".$i, !empty($row['headoffice_pay']) ? number_format($row['headoffice_pay']*1) : '')*/
                ->setCellValue("M".$i, number_format($total));
        }

    } else {
        if ($_REQUEST['option'] == '주간매출') {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$i, $row['year'].'년 '.$row['month'].'월 '.$row['week_of_month'].'주');
        } else if ($_REQUEST['option'] == '월간매출') {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$i, $row['month'].'월');
        } else {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$i, $row['year'].'년');
        }
        if($member['mb_level'] == 8) { // 프로
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("B".$i, $row['mb_name'])
                ->setCellValue("C".$i, substr($row['mb_reg_date'],0,10))
                ->setCellValue("D".$i, $row['count'])
                ->setCellValue("E".$i, !empty($row['cash_price']) ? number_format($row['cash_price']*1) : '')
                ->setCellValue("F".$i, !empty($row['credit_card_price']) ? number_format($row['credit_card_price']*1) : '')
                ->setCellValue("G".$i, !empty($row['check_card_price']) ? number_format($row['check_card_price']*1) : '')
                ->setCellValue("H".$i, number_format($cash_card))
                ->setCellValue("I".$i, !empty($row['fees']) ? number_format($row['fees']*1) : '')
                ->setCellValue("J".$i, !empty($row['pro_extra_pay']) ? number_format($row['pro_extra_pay']*1) : '')
                ->setCellValue("K".$i, number_format($total));
        }
        else if($member['mb_level'] == 9) { // 팀장
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("B".$i, $row['mb_charge_pro'])
                ->setCellValue("C".$i, $row['mb_name'])
                ->setCellValue("D".$i, substr($row['mb_reg_date'],0,10))
                ->setCellValue("E".$i, $row['count'])
                ->setCellValue("F".$i, !empty($row['cash_price']) ? number_format($row['cash_price']*1) : '')
                ->setCellValue("G".$i, !empty($row['credit_card_price']) ? number_format($row['credit_card_price']*1) : '')
                ->setCellValue("H".$i, !empty($row['check_card_price']) ? number_format($row['check_card_price']*1) : '')
                ->setCellValue("I".$i, number_format($cash_card))
                ->setCellValue("J".$i, !empty($row['fees']) ? number_format($row['fees']*1) : '')
                ->setCellValue("K".$i, !empty($row['pro_extra_pay']) ? number_format($row['pro_extra_pay']*1) : '')
                /*->setCellValue("L".$i, !empty($row['headoffice_pay']) ? number_format($row['headoffice_pay']*1) : '')*/
                ->setCellValue("L".$i, number_format($total));
        }
    }
}

if($member['mb_level'] == 8) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", '합 계');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", number_format($total_cash));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", number_format($total_credit));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", number_format($total_check));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", number_format($total_cash_card));
    if ($_REQUEST['option'] == '당일매출') {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", number_format($total_card_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", number_format($total_pro_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L1", number_format($total_sales));
    }
    else {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", number_format($total_card_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", number_format($total_pro_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", number_format($total_sales));
    }
}
else if($member['mb_level'] == 9) {
    // 프로수수료(합계)가 현금(합계)보다 작을 시 '-' 붙이고 빨간색
    if($total_pro_fees < $total_cash) {
        if($total_pro_fees > 0) { $total_pro_fees = '-'.$total_pro_fees; }
    }
    // 현금이 0일 경우는 '-' 붙이지 않고 검은색
    if($total_cash == 0) {
        if($total_pro_fees < 0) { $total_pro_fees = abs($total_pro_fees); }
    }

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", '합 계');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", number_format($total_cash));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", number_format($total_credit));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", number_format($total_check));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", number_format($total_cash_card));
    if ($_REQUEST['option'] == '당일매출') {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", number_format($total_card_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L1", number_format($total_pro_fees));
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M1", number_format($total_headoffice_pay));*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("M1", number_format($total_sales));
    }
    else {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", number_format($total_card_fees));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", number_format($total_pro_fees));
        /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L1", number_format($total_headoffice_pay));*/
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L1", number_format($total_sales));
    }
}

// ===== 데이터 =====

// 스타일
$sheet->getDefaultStyle()->getFont()->setName('맑은 고딕');

// 셀 너비
for ($col = 'A'; $col <= 'N'; $col++) {
    $sheet->getColumnDimension($col)->setWidth(12);
    $sheet->getStyle($col.'1')->getFont()->setSize(13)->setBold(true);
}

//$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// 문서 열어볼 시 미리 선택되어지는 셀
$sheet->setSelectedCellByColumnAndRow(0, 1);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", $_REQUEST['option'].'('.$start.'~'.$end.')');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit;
?>