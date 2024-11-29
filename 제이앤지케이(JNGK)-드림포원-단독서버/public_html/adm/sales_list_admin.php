<?php
$sub_menu = "210100";
include_once('./_common.php');

// ***** 현재 페이지 수정 시 adm/sales_list.php, adm/pro_view_sales.php 같이 수정 *****

/** 관리자 - 매출관리 **/

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";

$sql_search = " where 1=1 and mb.use_yn = 'Y' and mb.center_code != 'center10' "; // center10 : 테스트

if ($_REQUEST['option'] == '당일매출') {
    $today = date('Y-m-d');
    if(!empty($_GET['start'])) {
        $start = $_GET['start'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$today}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$today}') ";
    }
} else if ($_REQUEST['option'] == '월간매출') {
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 7);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') >= '{$start}') ";
    } else {
        $today = date('Y-m');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') >= '{$today}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 7);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') <= '{$end}') ";
    } else {
        $today = date('Y-m');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') <= '{$today}') ";
    }
} else if ($_REQUEST['option'] == '주간매출') {
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
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start_week}') ";
    }
    if(!empty($_GET['end'])) {
        $end = $_GET['end'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end_week}') ";
    }
} else {
    $today = date('Y');
    if(!empty($_GET['start'])) {
        $start = substr($_GET['start'], 0, 4);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') >= '{$today}') ";
    }
    if(!empty($_GET['end'])) {
        $end = substr($_GET['end'], 0, 4);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') <= '{$today}') ";
    }
}

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
    $sql_ = " DATE(sa.mb_reg_date) as date "; // count 용

    $sql_group = " group by mb.center_code ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , date, sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}
else if($_REQUEST['option'] == '주간매출') {
    $sql_ = " DATE_FORMAT(sa.mb_reg_date, '%Y%U') AS date "; // count 용

    $sql_group = " group by mb.center_code ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , date, sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}
else if ($_REQUEST['option'] == '월간매출') {
    $sql_ = " MONTH(sa.mb_reg_date) as month "; // count 용

    $sql_group = " group by mb.center_code ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , month, sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}
else { // 연간매출
    $sql_ = " YEAR(sa.mb_reg_date) as year "; // count 용

    $sql_group = " group by mb.center_code ";
    if(!empty($_GET['center'])) {
        $sql_group .= " , year, sa.pro_mb_no ";
    }
    $sql_order = " order by total_sales desc ";
}

$sql = " select {$sql_} {$sql_common} {$sql_search} {$sql_group} ";
$result = sql_query($sql);
$total_count = sql_num_rows($result);
//$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
//$row = sql_fetch($sql);
//$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$colspan = 10; // 합계 추가 시 11로 변경

if ($_REQUEST['option'] == '당일매출') {
    $sql_select = " select mb.mb_center, DATE(sa.mb_reg_date) as date, 
                    sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
                    card_company, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
                    sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";

    $colspan = 10; // 합계 추가 시 11로 변경
}
else if ($_REQUEST['option'] == '월간매출') {
    $sql_select = " select MONTH(sa.mb_reg_date) AS month, YEAR(sa.mb_reg_date) AS year,
                    sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price,
                    sum(fees) as fees, mb.mb_center, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
                    sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else if ($_REQUEST['option'] == '주간매출') {
    $sunday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE())  -1 ) as sunday from dual " )['sunday']; // 이번주의 첫일(일요일)
    $saturday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE()) + 5 ) as saturday from dual " )['saturday']; // 이번주의 마지막일(토요일)
    $sql_select = " select DATE_FORMAT(DATE_SUB(sa.mb_reg_date, INTERVAL (DAYOFWEEK(sa.mb_reg_date)-1) DAY), '%Y-%m-%d') as start,
             DATE_FORMAT(DATE_SUB(sa.mb_reg_date, INTERVAL (DAYOFWEEK(sa.mb_reg_date)-7) DAY), '%Y-%m-%d') as end,
             DATE_FORMAT(sa.mb_reg_date, '%Y%U') AS date,
             DATE_FORMAT(sa.mb_reg_date, '%Y') AS year,
             DATE_FORMAT(sa.mb_reg_date, '%m') AS month,
             FLOOR((DATE_FORMAT(sa.mb_reg_date,'%d')+(DATE_FORMAT(DATE_FORMAT(sa.mb_reg_date,'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month,
             sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees,
             mb.mb_center, mb.mb_charge_pro, sum(pro_extra_pay) as pro_extra_pay, sa.pro_mb_no, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
             sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else { // 연간매출
    $sql_select = " select YEAR(sa.mb_reg_date) AS year, MONTH(sa.mb_reg_date) AS month, sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price,
                    sum(fees) as fees, mb.mb_center, mb.mb_charge_pro, sa.pro_mb_no, sum(pro_extra_pay) as pro_extra_pay, mb.mb_name, sa.mb_reg_date, count(sa.idx) as count,
                    sum(cash_price) + sum(credit_card_price) + sum(check_card_price) - sum(fees) as total_sales, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
//echo $sql;
$result = sql_query($sql);
$result2 = sql_query($sql2);

// 총 합계 == 페이징 때문에 쿼리 따로 처리
$total_cash = 0;
$total_credit = 0;
$total_check = 0;
$total_cash_card = 0;
$total_card_fees = 0;
$total_pro_fees = 0;
$total_headoffice_pay = 0;
$total_sales = 0;
for($k=0; $row2=sql_fetch_array($result2); $k++) {
    $total_cash += $row2['cash_price']*1;
    $total_credit += $row2['credit_card_price']*1;
    $total_check += $row2['check_card_price']*1;
    $total_cash_card += $row2['cash_price']*1 + $row2['credit_card_price']*1 + $row2['check_card_price']*1;
    $total_card_fees += $row2['fees']*1;
    /*$total_pro_fees += $row2['pro_extra_pay']*1;*/
    $total_pro_fees += $row2['cash_price']*1 - ($row2['pro_extra_pay']*1 + ($row2['cash_price'] * $row2['pay_percent'] / 100)); // 프로수수료(합계) = 현금(합계) - (프로수수료(합계)+(현금(합계)*프로수수료율))
    $total_headoffice_pay += $row2['headoffice_pay']*1;
    $total_sales += $row2['cash_price']*1 + $row2['credit_card_price']*1 + $row2['check_card_price']*1 - $row2['fees']*1;
}

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'?option='.$_REQUEST['option'].'&center='.$_REQUEST['center'].'" class="ov_listall" style="padding-right: 15px;">전체 프로 조회</a>';

if(empty($center)) {
    $colspan = 8;
}

$g5['title'] = '매출현황';
include_once('./admin.head.php');
?>

<style>
.mb_tbl table {text-align: center;}
#fsearch .lre_ldate .input_ldate {
    height: 33px;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 0 10px;
}
#fsearch .lre_ldate .btn_ldate {
    height: 33px;
    border: 1px solid #444;
    border-radius: 3px;
    padding: 0 10px;
    background: #444;
    color: #fff;
    margin-left: 5px;
}
.les_sdate {
    font-size: 15px;
    font-weight: 500;
    color: #999;
    margin-bottom: 10px;
}
/*#state_div ul.tabs {margin: 0;padding: 0;float: left;list-style: none;height: 40px;border-left: 1px solid #eee;width: 100%;font-size:15px;}
#state_div ul.tabs li {float: left; text-align:center; cursor: pointer; width:120px; height: 40px; line-height: 35px;border: 1px solid #eee; border-left: none; background: #fafafa; overflow: hidden; position: relative;}
#state_div ul.tabs li.active {background: #FFFFFF; border-bottom: 1px solid #FFFFFF;}*/
.mb_tbl table tr td a:hover {text-decoration: underline;color:#000;cursor:pointer;}

/* 합계 표시줄 */
.tbl_head02 {position: relative; bottom: 20px; }
.total_tr th { background-color: unset !important; }
<?php if(empty($center)) { ?>
/*.total_tr { border: none !important; }
.total_tr th { visibility: hidden; }*/
.all { display: none; }
<?php } ?>
</style>

<div id="tab_box">
    <ul class="tab">
        <li class="<?php echo $_REQUEST['option'] == '당일매출' ? 'current' : '' ?>" id="tab1"><a href="javascript:void(0);" onclick="tabClick('당일매출');">당일매출</a></li>
        <li class="<?php echo $_REQUEST['option'] == '주간매출' ? 'current' : '' ?>" id="tab3"><a href="javascript:void(0);" onclick="tabClick('주간매출');">주간매출</a></li>
        <li class="<?php echo $_REQUEST['option'] == '월간매출' ? 'current' : '' ?>" id="tab2"><a href="javascript:void(0);" onclick="tabClick('월간매출');">월간매출</a></li>
        <li class="<?php echo $_REQUEST['option'] == '연간매출' ? 'current' : '' ?>" id="tab3"><a href="javascript:void(0);" onclick="tabClick('연간매출');">연간매출</a></li>
    </ul>
</div><!--#tab_box-->

<div id="state_div">
    <ul class="tabs" style="margin-bottom: 10px;">
        <li <?php if (empty($center)) echo 'class="active"'; ?> data-lv="">전체</li>
        <?php
        $sql = " select * from g5_center where (close_date is null or close_date = '0000-00-00') and center_code != 'center8' and center_code != 'center10' "; // 폐쇄일 입력한 아카데미는 조회하지 않음 / center10 : 테스트
        $center_result = sql_query($sql);

        for($k=0; $center_row=sql_fetch_array($center_result); $k++) {
            $center_name = explode(' 아카데미', $center_row['center_name'])[0];
        ?>
        <li <?php if ($center == $center_row['center_code']) echo 'class="active"'; ?> data-lv="<?=$center_row['center_code']?>"><?=$center_name?></li>
        <?php
        }
        ?>
    </ul>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="text-align: right;">
<!--기간검색-->
<div class="lre_ldate">
    <?/*=$listall*/?>
    <input type="button" class="btn_ldate" value="엑셀다운로드" onclick="excel_down();">
    <?php if($_REQUEST['option'] == '주간매출') { ?>
    <input type="date" name="start" id="start" value="<?php echo empty($_GET['start']) ? $sunday : $_GET['start'] ?>" class="input_ldate"/> ~ <input type="date" name="end" id="end" value="<?php echo empty($_GET['end']) ? $saturday : $_GET['end'] ?>" class="input_ldate"/>
    <?php } else if($_REQUEST['option'] != '당일매출') { ?>
    <input type="date" name="start" id="start" value="<?php echo empty($_GET['start']) ? '' : $_GET['start'] ?>" class="input_ldate"/> ~ <input type="date" name="end" id="end" value="<?php echo empty($_GET['end']) ? '' : $_GET['end'] ?>" class="input_ldate"/>
    <?php } else { ?>
    <input type="date" name="start" id="start" value="<?php echo empty($_GET['start']) ? date('Y-m-d') : $_GET['start'] ?>" class="input_ldate"/> ~ <input type="date" id="end" name="end" value="<?php echo empty($_GET['end']) ? date('Y-m-d') : $_GET['end'] ?>" class="input_ldate"/>
    <?php } ?>
    <input type="hidden" id="option" name="option" value="<?=$_REQUEST['option']?>">
    <input type="hidden" id="center" name="center" value="<?=$_REQUEST['center']?>">
    <input type="hidden" id="pro" name="pro" value="<?=$_REQUEST['pro']?>">
    <input type="submit" class="btn_ldate" value="검색">
</div><!--.lre_ldate-->
</form>

<div class="local_ov01 local_ov">
    <div class="lre_list_tit">
        <?=$_REQUEST['option']?>
        <span class="les_sdate">
            기간 :
            <?php
            if(!empty($_GET['start']) && !empty($_GET['end'])) {
                if($_REQUEST['option'] == '월간매출') { echo substr($_GET['start'],0,7).' ~ '.substr($_GET['end'],0,7); }
                else if($_REQUEST['option'] == '연간매출') { echo substr($_GET['start'],0,4).' ~ '.substr($_GET['end'],0,4); }
                else { echo $_GET['start'].' ~ '.$_GET['end']; }
            }
            else if(!empty($_GET['start'])) {
                if($_REQUEST['option'] == '월간매출') { echo substr($_GET['start'],0,7).' ~ '; }
                else if($_REQUEST['option'] == '연간매출') { echo substr($_GET['start'],0,4).' ~ '; }
                else { echo $_GET['start'].' ~ ';  }
            }
            else if(!empty($_GET['end'])) {
                if($_REQUEST['option'] == '월간매출') { echo ' ~ '.substr($_GET['end'],0,7); }
                else if($_REQUEST['option'] == '연간매출') { echo ' ~ '.substr($_GET['end'],0,4); }
                else { echo ' ~ '.$_GET['end'];   }
            }
            else {
                if($_REQUEST['option'] == '당일매출') {
                    echo date('Y-m-d').' ~ '.date('Y-m-d');
                } else if($_REQUEST['option'] == '주간매출') {
                    echo $sunday.' ~ '.$saturday;
                } else if($_REQUEST['option'] == '월간매출') {
                    echo date('Y-m').' ~ '.date('Y-m');
                } else {
                    echo date('Y');
                }
            }
            ?>
            <?/*=date('Y-m-d')*/?><!-- ~ --><?/*=date('Y-m-d')*/?>
            <?/*=date('Y').'-01'*/?><!-- ~ --><?/*=date('Y-m')*/?>
            <?/*=$sunday*/?><!-- ~ --><?/*=$saturday*/?>
            <?/*=date('Y')*/?>
        </span>
    </div>

    <!--당일매출 기간 : <?/*=date('Y-m-d')*/?> ~ --><?/*=date('Y-m-d')*/?>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table id="static" style="margin-bottom: 15px;border-top: unset !important;">
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <colgroup>
        </colgroup>
        <thead>
        <tr class="total_tr">
            <th></th>
            <?php if($_REQUEST['option'] == '당일매출') { ?>
            <th class="all"></th>
            <?php } else if($_REQUEST['option'] == '주간매출') { ?>
            <th class="all"></th>
            <?php } else if($_REQUEST['option'] == '월간매출') { ?>
            <th class="all"></th>
            <?php } else { ?>
            <th class="all"></th>
            <?php } ?>
            <!--<th class="all"></th>
            <th class="all"></th>
            <th class="all"></th>-->
            <th class="all"><span>합 계</span></th>
            <th><span id="total_cash"></span></th>
            <th><span id="total_credit"></span></th>
            <th><span id="total_check"></span></th>
            <th><span id="total_cash_card"></span></th>
            <?php if($_REQUEST['option'] == '당일매출') { ?>
            <!--<th class="all"></th>-->
            <?php } ?>
            <th><span id="total_card_fees"></span></th>
            <th><span id="total_pro_fees"></span></th>
            <!--<th><span id="total_headoffice_pay"></span></th>-->
            <th><span id="total_sales"></span></th>
            <!--<th>합계</th>-->
        </tr>
        <tr style="border-top: 1px solid #444 !important;">
            <th>센터</th>
            <?php if($_REQUEST['option'] == '당일매출') { ?>
            <th class="all">일자</th>
            <?php } else if($_REQUEST['option'] == '주간매출') { ?>
            <th class="all">주차</th>
            <?php } else if($_REQUEST['option'] == '월간매출') { ?>
            <th class="all">월</th>
            <?php } else { ?>
            <th class="all">연도</th>
            <?php } ?>
            <th class="all">프로명</th>
            <!--<th class="all">회원명</th>
            <th class="all">등록일자</th>
            <th class="all">건수</th>-->
            <th>현금</th>
            <th>신용카드</th>
            <th>체크카드</th>
            <th>현금+카드</th>
            <?php if($_REQUEST['option'] == '당일매출') { ?>
            <!--<th class="all">카드사</th>-->
            <?php } ?>
            <th>카드수수료</th>
            <th>프로수수료</th>
            <!--<th>본사지급액</th>-->
            <th>매출</th>
            <!--<th>합계</th>-->
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            //$bg = 'bg'.($i%2);

            // * 합계 = 현금+카드-카드수수료
            $cash_card = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
            $total = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1 - $row['fees']*1;
            //$cash_credit = $row['cash_price']*1 + $row['credit_card_price']*1;
            //$cash_check = $row['cash_price']*1 + $row['check_card_price']*1;

            // 당일 ==> 마지막 열에 합계 표시 시 사용
            /*$search = $row['date'];
            $sql_search2 = " WHERE 1 = 1 AND mb.center_code = '{$center}' and DATE_FORMAT(sa.mb_reg_date, '%Y-%m-%d') = '{$search}' "
            $sql_having2 = " having date is not null and cnt > 1 ";
            $sql2 = " select DATE(sa.mb_reg_date) as date, sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price
                      card_company, mb.mb_charge_pro, sum(1) as cnt
                      {$sql_common} {$sql_search2} {$sql_group} with rollup {$sql_having2} ";
            $temp = sql_fetch($sql2);
            $sum = $temp['cash_price']*1 + $temp['credit_card_price']*1 + $temp['check_card_price']*1;*/
            // 월간
            /*$search = $row['date'];
            $sql_search2 = " WHERE 1 = 1 AND mb.center_code = '{$center}' and DATE_FORMAT(sa.mb_reg_date, '%Y-%m-%d') = '{$search}' ";
            $sql_having2 = " having month is not null and cnt > 1 ";
            $sql2 = " select MONTH(sa.mb_reg_date) AS 'month',
                      sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, mb.mb_center, mb.mb_charge_pro, sum(1) as cnt
                      {$sql_common} {$sql_search2} {$sql_group} with rollup {$sql_having2} ";
            $temp = sql_fetch($sql2);
            $sum = $temp['cash_price']*1 + $temp['credit_card_price']*1 + $temp['check_card_price']*1;*/
            // 주간
            /*$sql_group2 = " GROUP BY mb.center_code, date, sa.pro_mb_no with rollup ";
            $sql_having2 = " having date is not null and cnt > 1 ";*/
            // 연간
            /*$sql_group2 = " GROUP BY mb.center_code, year, sa.pro_mb_no with rollup ";
            $sql_having2 = " having year is null ";*/

            $link = G5_ADMIN_URL.'/sales_list_admin.php?option='.$option.'&start='.$start.'&end='.$end.'&center='.$center.'&pro='.$row['pro_mb_no'];
        ?>
            <tr class="<?php echo $bg; ?>">
                <td><?=$row['mb_center']?></td>
                <?php if($_REQUEST['option'] == '당일매출') { ?>
                <td class="all"><?=$row['date']?></td>
                <?php } else if($_REQUEST['option'] == '주간매출') { ?>
                <td class="all"><?=$row['year']?>년 <?=$row['month']?>월 <?=$row['week_of_month']?>주</td>
                <?php } else if($_REQUEST['option'] == '월간매출') { ?>
                <td class="all"><?=$row['month']?>월</td>
                <?php } else { ?>
                <td class="all"><?=$row['year']?>년</td>
                <?php } ?>
                <td class="all"><a href="<?=$link?>"><?=$row['mb_charge_pro']?></a></td>
                <!--<td class="all"><?/*=$row['mb_name']*/?></td>
                <td class="all"><?/*=substr($row['mb_reg_date'],0,10)*/?></td>
                <td class="all"><?/*=$row['count']*/?></td>-->
                <td><?php if(!empty($row['cash_price'])) { echo number_format($row['cash_price']*1); }?></td>
                <td><?php if(!empty($row['credit_card_price'])) { echo number_format($row['credit_card_price']*1); }?></td>
                <td><?php if(!empty($row['check_card_price'])) { echo number_format($row['check_card_price']*1); }?></td>
                <!--<td><?php /*if(!empty($row['cash_price']) && !empty($row['credit_card_price'])) { echo number_format($cash_credit); } */?></td>
                <td><?php /*if(!empty($row['cash_price']) && !empty($row['check_card_price'])) { echo number_format($cash_check); } */?></td>-->
                <td><?=number_format($cash_card)?></td>
                <?php if($_REQUEST['option'] == '당일매출') { ?>
                <!--<td class="all"><?/*=$row['card_company']*/?></td>-->
                <?php } ?>
                <td><?php if(!empty($row['fees'])) { echo number_format($row['fees']*1); }?></td>
                <td><?php if(!empty($row['pro_extra_pay'])) { echo number_format($row['pro_extra_pay']*1); }?></td>
                <!--<td><?php /*if(!empty($row['headoffice_pay'])) { echo number_format($row['headoffice_pay']*1); }*/?></td>-->
                <td><?=number_format($total)?></td>
                <!--<td><?php /*if(!empty($sum)) { echo number_format($sum).'_'.$row['date']; } else { echo number_format($total).'_'.$row['date']; } */?></td>-->
            </tr>
        <?php
        }
        if ($i == 0)
            echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
        ?>
        </tbody>
    </table>
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&option=".$_REQUEST['option']."&start=".$_REQUEST['start']."&end=".$_REQUEST['end']."&center=".$_REQUEST['center']."&pro=".$_REQUEST['pro'].'&amp;page='); ?>

<script>
$(function() {
    $('#total_cash').text('<?=number_format($total_cash)?>');
    $('#total_credit').text('<?=number_format($total_credit)?>');
    $('#total_check').text('<?=number_format($total_check)?>');
    $('#total_cash_card').text('<?=number_format($total_cash_card)?>');
    $('#total_card_fees').text('<?=number_format($total_card_fees)?>');
    $('#total_pro_fees').text('<?=number_format($total_pro_fees)?>');
    $('#total_headoffice_pay').text('<?=number_format($total_headoffice_pay)?>');
    $('#total_sales').text('<?=number_format($total_sales)?>');

    // 프로수수료(합계)가 현금(합계)보다 작을 시 '-' 붙이고 빨간색
    if($('#total_pro_fees').text().replace(/,/gi,'')*1 < $('#total_cash').text().replace(/,/gi, '')*1) {
        $('#total_pro_fees').text('<?php echo $total_pro_fees < 0 ? number_format($total_pro_fees) : number_format(-$total_pro_fees) ?>');
        $('#total_pro_fees').attr('style', 'color:red;');
    }

    // 현금이 0일 경우는 '-' 붙이지 않고 검은색
    if($('#total_cash').text().replace(/,/gi, '')*1 == 0) {
        $('#total_pro_fees').text('<?php echo $total_pro_fees < 0 ? number_format(-$total_pro_fees) : number_format($total_pro_fees) ?>');
        $('#total_pro_fees').attr('style', 'color:black;');
    }

    // 마지막 열에 합계 표시 시 사용 -- option마다 숫자 변경 필요
    /*$('#static').rowspan(0); // 같은 값을 가진 열 병합 (0 : colIdx)
    $('#static').rowspan(1); // 같은 값을 가진 열 병합 (1 : colIdx)
    $('#static').rowspan(9); // 같은 값을 가진 열 병합 (9 : colIdx)

    // 다른 일자의 같은 값을 가진 합계 때문에 처리
    // * 일자가 달라도 합계 열이 병합되는 문제 *
    // * 처리방법* 1. 일자를 붙여서 합계 데이터 표기 2. 열 병합 3. 일자 제거
    $('td:nth-child(10)').each(function() {
        $(this).html($(this).html().split('_')[0]);
    });*/
});

// 탭선택
function tabClick(value) {
    location.replace('<?=G5_ADMIN_URL?>/sales_list_admin.php?option='+value+'&center=<?=$center?>');
    // fsearch.submit();
}

// 같은 값을 가진 열 병합
$.fn.rowspan = function (colIdx, isStats) {
    return this.each(function () {
        var that;
        $('tr', this).each(function (row) {
            $('td:eq(' + colIdx + ')', this).filter(':visible').each(function (col) {

                if ($(this).html() == $(that).html() && (!isStats || isStats && $(this).prev().html() == $(that).prev().html() )) {
                    rowspan = $(that).attr("rowspan") || 1;
                    rowspan = Number(rowspan) + 1;

                    $(that).attr("rowspan", rowspan);

                    // do your action for the colspan cell here
                    $(this).hide();

                    //$(this).remove();
                    // do your action for the old cell here

                } else {
                    that = this;
                }

                // set the that if not already set
                that = (that == null) ? this : that;
            });
        });
    });
};

// 센터 선택
$("#state_div .tabs li").on("click", function() {
    var lv = $(this).data("lv")
    var option = $('#option').val();
    var start = $('#start').val();
    var end = $('#end').val();
    var para = document.location.href.split("?");
    var params = ""
    // if (lv != "") {
        params += "?option=" + option + "&start=" + start + "&end=" + end + "&center=" + lv;
    // }

    location.replace(g5_admin_url + "/sales_list_admin.php" + params)
});

// 엑셀 다운로드
function excel_down() {
    var start = '<?=$start?>';
    var end = '<?=$end?>';
    var option = '<?=$_REQUEST['option']?>';
    var center = '<?=$center?>';
    var pro = '<?=$pro?>';
    location.href = g5_admin_url + '/excel.sales_status_admin.php?start='+start+'&end='+end+'&option='+option+'&center='+center+'&pro='+pro;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
