<?php
include_once("./_common.php");

exit;

ini_set('memory_limit', '1024M');

header( "Content-type: application/vnd.ms-excel" );
//header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 매출현황.xls" );
header( "Content-Description: PHP4 Generated Data" );

// ===== 데이터 =====
$_REQUEST['option'] = '월간매출';
$today = date('Y-m-d');

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";
$sql_search = ' where 1=1 ';

if($member['mb_level'] == 8) { // 프로
    $sql_search .= " and mb.pro_mb_no = '{$member['mb_no']}' ";
}
if($member['mb_level'] == 9) { // 팀장
    $sql_search .= " and mb.center_code = '{$member['center_code']}' ";
}

if ($_REQUEST['option'] == '당일매출') {
    if(!empty($_GET['start'])) {
        $start = $_GET['start'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $start = date('Y-m-d');
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $end = date('Y-m-d');
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
    }

    $sql_group = " GROUP BY `date`, mb.mb_no ";
    $sql_order = " order by `date` asc "; // with rollup 적용 시 오류
}
else if ($_REQUEST['option'] == '월간매출') {
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 7);
        $sql_search .= " and (date_format(pay_date, '%Y-%m') >= '{$start}') ";
    } else {
        $start = date('Y').'-01';
        $sql_search .= " and (date_format(pay_date, '%Y-%m') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 7);
        $sql_search .= " and (date_format(pay_date, '%Y-%m') <= '{$end}') ";
    } else {
        $end = date('Y-m');
        $sql_search .= " and (date_format(pay_date, '%Y-%m') <= '{$end}') ";
    }

    $sql_group = " GROUP BY `month`, mb.mb_no ";
    $sql_order = " order by `month` asc ";
}
else if ($_REQUEST['option'] == '주간매출') {
    // == 이번주 시작일, 종료일 ==
    $time = explode(" ",microtime());
    $s = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +0/* 시작일 기준 */, date("Y",$time[1]));
    $e = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +6/* 종료일 기준 */, date("Y",$time[1]));
    // == 이번주 시작일, 종료일 ==
    if(!empty($_GET['start'])) {
        $start = $_GET['start'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $start = date("Y-m-d", $s); // 이번주 시작일
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $end = date("Y-m-d", $e); // 이번주 종료일
        $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
    }

    $sql_group = " GROUP BY `date`, mb.mb_no ";
    $sql_order = " order by `date` ";
}
else {
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 4);
        $sql_search .= " and (date_format(pay_date, '%Y') >= '{$start}') ";
    } else {
        $start = date('Y');
        $sql_search .= " and (date_format(pay_date, '%Y') >= '{$start}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 4);
        $sql_search .= " and (date_format(pay_date, '%Y') <= '{$end}') ";
    } else {
        $end = date('Y');
        $sql_search .= " and (date_format(pay_date, '%Y') <= '{$end}') ";
    }

    $sql_group = " GROUP BY `year`, mb.mb_no ";
    $sql_order = " order by `year` asc ";
}

if($_REQUEST['option'] == '당일매출') {
    $sql = " select DATE(`pay_date`) as `date`, 
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, 
             card_company, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else if($_REQUEST['option'] == '월간매출') {
    $sql = " select MONTH(`pay_date`) AS `month`, YEAR(`pay_date`) AS 'year', 
             sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay, mb.pro_mb_no, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
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
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else {
    $sql = " select YEAR(`pay_date`) AS `year`, MONTH(`pay_date`) AS `month`, sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
             sum(`fees`) as fees, mb.mb_charge_pro, mb.pro_mb_no, sum(`pro_extra_pay`) as pro_extra_pay, mb.mb_name, mb.mb_reg_date, count(idx) as count
             {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
//echo $sql;exit;
$result = sql_query($sql);

// ===== 데이터 =====
// 테이블 상단 만들기
$EXCEL_STR = "  
<table border='1'>
<tr>
";
if($_REQUEST['option'] == '당일매출') {
    $EXCEL_STR .= "<th>일자</th>";
} else if($_REQUEST['option'] == '주간매출') {
    $EXCEL_STR .= "<th>주차</th>";
} else if($_REQUEST['option'] == '월간매출') {
    $EXCEL_STR .= "<th>월</th>";
} else {
    $EXCEL_STR .= "<th>연도</th>";
}
if($member['mb_level'] > 8) {
    $EXCEL_STR .= "<th>프로명</th>";
}
$EXCEL_STR .= "
<th>회원명</th>
<th>등록일자</th>
<th>건수</th>
<th>현금</th>
<th>신용카드</th>
<th>체크카드</th>
<th>현금+카드</th>
";
if($_REQUEST['option'] == '당일매출') {
    $EXCEL_STR .= "<th>카드사</th>";
}
$EXCEL_STR .= "<th>카드수수료</th>";
if($member['mb_level'] > 8) {
    $EXCEL_STR .= "<th>프로수수료</th>";
}
$EXCEL_STR .= "
<th>매출</th>
</tr>
";

for($i=0; $row=sql_fetch_array($result); $i++) {
    $cash_card = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
    // * 합계 = 현금+카드-카드수수료
    $total = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1 - $row['fees']*1;
    $total_sales += $total*1;

    $EXCEL_STR .= "<tr>";
    if($_REQUEST['option'] == '당일매출') {
        $EXCEL_STR .= "<td>".$row['date']."</td>";
    } else if($_REQUEST['option'] == '주간매출') {
        $EXCEL_STR .= "<td>".$row['year']."년 ".$row['month']."월 ".$row['week_of_month']."주</td>";
    } else if($_REQUEST['option'] == '월간매출') {
        $EXCEL_STR .= "<td>".$row['month']."월</td>";
    } else {
        $EXCEL_STR .= "<td>".$row['year']."년</td>";
    }
    if($member['mb_level'] > 8) {
        $EXCEL_STR .= "<td>".$row['mb_charge_pro']."</td>";
    }
    $EXCEL_STR .= "<td>".$row['mb_name']."</td>";
    $EXCEL_STR .= "<td>".substr($row['mb_reg_date'],0,10)."</td>";
    $EXCEL_STR .= "<td>".$row['count']."</td>";
    $EXCEL_STR .= "<td>".(number_format($row['cash_price']*1))."</td>";
    $EXCEL_STR .= "<td>".(number_format($row['credit_card_price']*1))."</td>";
    $EXCEL_STR .= "<td>".(number_format($row['check_card_price']*1))."</td>";
    $EXCEL_STR .= "<td>".number_format($cash_card)."</td>";
    if($_REQUEST['option'] == '당일매출') {
        $EXCEL_STR .= "<td>".$row['card_company']."</td>";
    }
    $EXCEL_STR .= "<td>".(number_format($row['fees']*1))."</td>";
    if($member['mb_level'] > 8) {
        $EXCEL_STR .= "<td>".(number_format($row['pro_extra_pay']*1))."</td>";
    }
    $EXCEL_STR .= "<td>".number_format($total)."</td>";
    $EXCEL_STR .= "</tr>";
}
$EXCEL_STR .= "</table>";


echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;
?>